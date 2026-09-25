<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImportService
{
    private const CHUNK_SIZE = 200;

    /**
     * Reads $absolutePath and upserts every row into products.
     * Returns the number of rows imported (rows with no product code
     * are skipped, since that's what upsert() matches on).
     */
    public function import(string $absolutePath): int
    {
        $ext = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));

        return match ($ext) {
            'csv'         => $this->importCsv($absolutePath),
            'xlsx', 'xls' => $this->importSpreadsheet($absolutePath),
            default       => throw new \InvalidArgumentException("Unsupported file type: {$ext}"),
        };
    }

    /**
     * Native fgetcsv — no library overhead, streams the file line by
     * line so memory stays flat regardless of row count. This is the
     * fast path and what handles files like billpTMP.csv.
     */
    private function importCsv(string $path): int
    {
        $handle = fopen($path, 'r');

        if ($handle === false) {
            throw new \RuntimeException("Unable to open file: {$path}");
        }

        $header = fgetcsv($handle, 0, ',', '"');

        if ($header === false) {
            fclose($handle);
            return 0;
        }

        // Strip a UTF-8 BOM if present on the first header cell.
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0] ?? '');

        $slugs = array_map(fn ($h) => $this->slug((string) $h), $header);

        $count  = 0;
        $buffer = [];

        while (($row = fgetcsv($handle, 0, ',', '"')) !== false) {
            if (count($row) === 1 && trim((string) ($row[0] ?? '')) === '') {
                continue; // blank line
            }

            $insert = $this->mapRow($slugs, $row);

            if ($insert === null) {
                continue; // no product code, can't upsert
            }

            $buffer[] = $insert;
            $count++;

            if (count($buffer) >= self::CHUNK_SIZE) {
                $this->upsertChunk($buffer);
                $buffer = [];
            }
        }

        if (! empty($buffer)) {
            $this->upsertChunk($buffer);
        }

        fclose($handle);

        return $count;
    }

    /**
     * PhpSpreadsheet for xlsx/xls. Iterates rows (doesn't build one
     * giant array of the whole sheet) and upserts in the same chunk
     * size as the CSV path.
     */
    private function importSpreadsheet(string $path): int
    {
        $reader = IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $count   = 0;
        $buffer  = [];
        $slugs   = [];
        $isFirst = true;

        foreach ($sheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $values = [];
            foreach ($cellIterator as $cell) {
                $values[] = $cell->getValue();
            }

            if ($isFirst) {
                $slugs = array_map(fn ($h) => $this->slug((string) $h), $values);
                $isFirst = false;
                continue;
            }

            $insert = $this->mapRow($slugs, $values);

            if ($insert === null) {
                continue;
            }

            $buffer[] = $insert;
            $count++;

            if (count($buffer) >= self::CHUNK_SIZE) {
                $this->upsertChunk($buffer);
                $buffer = [];
            }
        }

        if (! empty($buffer)) {
            $this->upsertChunk($buffer);
        }

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return $count;
    }

    /**
     * Builds one products row: product_code/product_name/product_brand
     * from PROD_C/PROD_N/PRODBRANDN, everything else (all 238 raw
     * columns) prefixed rc_ so it lines up with the migration.
     */
    private function mapRow(array $slugs, array $values): ?array
    {
        $assoc = [];
        foreach ($slugs as $i => $slug) {
            if ($slug === '') {
                continue;
            }
            $assoc[$slug] = $values[$i] ?? null;
        }

        $code = trim((string) ($assoc['prod_c'] ?? ''));

        if ($code === '') {
            return null;
        }

        $now = now();

        $insert = [
            'product_code'  => $code,
            'product_name'  => trim((string) ($assoc['prod_n'] ?? '')),
            'product_brand' => trim((string) ($assoc['prodbrandn'] ?? '')) ?: null,
            // 'price' => (float) ($assoc['pc_lp'] ?? 0), // <- uncomment once you confirm which raw column this should be
            'created_at' => $now,
            'updated_at' => $now,
        ];

        foreach ($assoc as $slug => $value) {
            $insert['rc_' . $slug] = ($value === '' ? null : $value);
        }

        return $insert;
    }

    private function upsertChunk(array $rows): void
    {
        DB::table('products')->upsert(
            $rows,
            ['product_code'],
            array_diff(array_keys($rows[0]), ['product_code', 'created_at'])
        );
    }

    private function slug(string $h): string
    {
        $s = preg_replace('/[^A-Za-z0-9]+/', '_', $h);
        $s = trim($s, '_');

        return strtolower($s);
    }
}