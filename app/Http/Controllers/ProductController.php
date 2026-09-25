<?php

namespace App\Http\Controllers;

use App\Services\ProductImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function import(Request $request)
    {
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '300');
        set_time_limit(300);

        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:102400',
            ],
        ]);

        try {
            $file = $request->file('file');

            // Store uploaded file
            $path = $file->store('imports');

            $absolutePath = Storage::path($path);

            $count = (new ProductImportService())->import($absolutePath);

            return response()->json([
                'success' => true,
                'message' => "Imported {$count} products successfully.",
                'path'    => $path,
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Product import failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}