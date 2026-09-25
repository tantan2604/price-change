<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('price_changes', function (Blueprint $table) {

            // Primary Key
            $table->id();

            // Document Information
            $table->string('document_id');
            $table->string('document_status');
            $table->string('created_by');

            // Date/Time Information
            $table->dateTime('created_at');

            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();

            // Memo Information
            $table->string('memo_title');
            $table->string('supplier_name');

            $table->date('start_date');
            $table->date('end_date');

            $table->date('memo_received_date');

            $table->string('promotion_type');

            // Product Information
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_brand');

            // Product Status
            $table->boolean('act')->default(false);
            $table->string('freebies')->nullable();

            // Cost / Profit Information
            $table->decimal('vatr', 10, 3);
            $table->decimal('pflfov', 10, 2);
            $table->decimal('nwf', 10, 2);
            $table->decimal('gp', 10, 3);
            $table->decimal('nwfr', 10, 2);

            // Price Change Information
            $table->decimal('pc_pf', 10, 2);
            $table->decimal('pc_pfl', 10, 2);
            $table->decimal('pc_rp', 10, 2);
            $table->decimal('pc_pa', 10, 2);

            // LSRP
            $table->decimal('pc_plsrp', 10, 2);
            $table->decimal('pc_lsrp', 10, 2);

            // LP
            $table->decimal('pc_ppa2lp', 10, 2);
            $table->decimal('pc_lp', 10, 2);

            // WA
            $table->decimal('pc_ppa2wa', 10, 2);
            $table->decimal('pc_wa', 10, 2);

            // WB
            $table->decimal('pc_ppa2wb', 10, 2);
            $table->decimal('pc_wb', 10, 2);

            // WC
            $table->decimal('pc_ppa2wc', 10, 2);
            $table->decimal('pc_wc', 10, 2);

            // LC
            $table->decimal('pc_ppa2lc', 10, 2);
            $table->decimal('pc_lc', 10, 2);

            // PG
            $table->decimal('pc_ppa2pg', 10, 2);
            $table->decimal('pc_pg', 10, 2);

            // PH
            $table->decimal('pc_ppa2ph', 10, 2);
            $table->decimal('pc_ph', 10, 2);

            // PB
            $table->decimal('pc_ppa2pb', 10, 2);
            $table->decimal('pc_pb', 10, 2);

            // PD
            $table->decimal('pc_ppa2pd', 10, 3);
            $table->decimal('pc_pd', 10, 2);

            // PC Amount / Reference
            $table->decimal('pc_amt', 10, 2);
            $table->string('pc_ref');

            // PC
            $table->decimal('pc_ppa2pc', 10, 2);
            $table->decimal('pc_pc', 10, 2);

            // Claims
            $table->decimal('claim', 10, 2);
            $table->decimal('claim2', 10, 2);

            $table->string('claim_k')->nullable();
            $table->string('claim_k2')->nullable();

            // Percentage / Remarks
            $table->decimal('percentage', 10, 3);
            $table->text('remarks')->nullable();

            // Active Status
            $table->boolean('is_active')->default(false);

            // Last Modification
            $table->string('last_modified_by');
            $table->dateTime('last_modified_at');

            // Optional indexes
            $table->index('document_id');
            $table->index('document_status');
            $table->index('product_code');
            $table->index('supplier_name');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_changes');
    }
};