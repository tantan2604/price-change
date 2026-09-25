<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceChangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('price_changes')->insert([

            /*
            |--------------------------------------------------------------------------
            | PRICE CHANGE 001 - APPROVED
            |--------------------------------------------------------------------------
            */
            [
                'document_id' => 'PC-2026-0001',
                'document_status' => 'Approved',

                'created_by' => 'admin',
                'created_at' => '2026-09-01 09:00:00',

                'approved_by' => 'manager',
                'approved_at' => '2026-09-02 10:30:00',

                'memo_title' => 'September Price Adjustment',
                'supplier_name' => 'ABC Trading',

                'start_date' => '2026-09-01',
                'end_date' => '2026-09-30',

                'memo_received_date' => '2026-08-30',
                'promotion_type' => 'Regular',

                'product_code' => 'PRD001',
                'product_name' => 'Sample Product 1',
                'product_brand' => 'Sample Brand',

                'act' => true,
                'freebies' => 'None',

                'vatr' => 12.000,
                'pflfov' => 100.00,
                'nwf' => 90.00,
                'gp' => 10.000,
                'nwfr' => 90.00,

                'pc_pf' => 100.00,
                'pc_pfl' => 105.00,
                'pc_rp' => 120.00,
                'pc_pa' => 95.00,

                'pc_plsrp' => 0.00,
                'pc_lsrp' => 120.00,

                'pc_ppa2lp' => 0.00,
                'pc_lp' => 100.00,

                'pc_ppa2wa' => 0.00,
                'pc_wa' => 105.00,

                'pc_ppa2wb' => 0.00,
                'pc_wb' => 110.00,

                'pc_ppa2wc' => 0.00,
                'pc_wc' => 115.00,

                'pc_ppa2lc' => 0.00,
                'pc_lc' => 118.00,

                'pc_ppa2pg' => 0.00,
                'pc_pg' => 119.00,

                'pc_ppa2ph' => 0.00,
                'pc_ph' => 120.00,

                'pc_ppa2pb' => 0.00,
                'pc_pb' => 121.00,

                'pc_ppa2pd' => 0.000,
                'pc_pd' => 122.00,

                'pc_amt' => 5.00,
                'pc_ref' => 'REF-001',

                'pc_ppa2pc' => 0.00,
                'pc_pc' => 123.00,

                'claim' => 2.00,
                'claim2' => 1.00,

                'claim_k' => 'CLAIM-A',
                'claim_k2' => 'CLAIM-B',

                'percentage' => 5.000,

                'remarks' => 'Sample price change record',

                'is_active' => true,

                'last_modified_by' => 'admin',
                'last_modified_at' => '2026-09-02 10:30:00',
            ],


            /*
            |--------------------------------------------------------------------------
            | PRICE CHANGE 002 - FOR APPROVAL
            |--------------------------------------------------------------------------
            */
            [
                'document_id' => 'PC-2026-0002',
                'document_status' => 'For Approval',

                'created_by' => 'user1',
                'created_at' => '2026-09-05 09:15:00',

                // Not yet approved
                'approved_by' => null,
                'approved_at' => null,

                'memo_title' => 'Supplier Promotional Price',
                'supplier_name' => 'XYZ Suppliers',

                'start_date' => '2026-09-01',
                'end_date' => '2026-09-30',

                'memo_received_date' => '2026-09-04',
                'promotion_type' => 'Promo',

                'product_code' => 'PRD002',
                'product_name' => 'Sample Product 2',
                'product_brand' => 'Demo Brand',

                'act' => true,
                'freebies' => 'Buy 10 Take 1',

                'vatr' => 12.000,
                'pflfov' => 200.00,
                'nwf' => 180.00,
                'gp' => 20.000,
                'nwfr' => 180.00,

                'pc_pf' => 200.00,
                'pc_pfl' => 210.00,
                'pc_rp' => 250.00,
                'pc_pa' => 190.00,

                'pc_plsrp' => 0.00,
                'pc_lsrp' => 250.00,

                'pc_ppa2lp' => 0.00,
                'pc_lp' => 200.00,

                'pc_ppa2wa' => 0.00,
                'pc_wa' => 205.00,

                'pc_ppa2wb' => 0.00,
                'pc_wb' => 210.00,

                'pc_ppa2wc' => 0.00,
                'pc_wc' => 215.00,

                'pc_ppa2lc' => 0.00,
                'pc_lc' => 220.00,

                'pc_ppa2pg' => 0.00,
                'pc_pg' => 225.00,

                'pc_ppa2ph' => 0.00,
                'pc_ph' => 230.00,

                'pc_ppa2pb' => 0.00,
                'pc_pb' => 235.00,

                'pc_ppa2pd' => 0.000,
                'pc_pd' => 240.00,

                'pc_amt' => 10.00,
                'pc_ref' => 'REF-002',

                'pc_ppa2pc' => 0.00,
                'pc_pc' => 245.00,

                'claim' => 5.00,
                'claim2' => 2.00,

                'claim_k' => 'CLAIM-C',
                'claim_k2' => 'CLAIM-D',

                'percentage' => 10.000,

                'remarks' => 'Pending approval',

                'is_active' => true,

                'last_modified_by' => 'user1',
                'last_modified_at' => '2026-09-05 09:15:00',
            ],


            /*
            |--------------------------------------------------------------------------
            | PRICE CHANGE 003 - REJECTED
            |--------------------------------------------------------------------------
            */
            [
                'document_id' => 'PC-2026-0003',
                'document_status' => 'Rejected',

                'created_by' => 'user2',
                'created_at' => '2026-09-10 08:45:00',

                'approved_by' => 'manager',
                'approved_at' => '2026-09-11 14:00:00',

                'memo_title' => 'Rejected Price Change',
                'supplier_name' => 'DEF Corporation',

                'start_date' => '2026-09-01',
                'end_date' => '2026-09-30',

                'memo_received_date' => '2026-09-09',
                'promotion_type' => 'Regular',

                'product_code' => 'PRD003',
                'product_name' => 'Sample Product 3',
                'product_brand' => 'Test Brand',

                'act' => false,
                'freebies' => 'None',

                'vatr' => 12.000,
                'pflfov' => 300.00,
                'nwf' => 270.00,
                'gp' => 30.000,
                'nwfr' => 270.00,

                'pc_pf' => 300.00,
                'pc_pfl' => 310.00,
                'pc_rp' => 350.00,
                'pc_pa' => 290.00,

                'pc_plsrp' => 0.00,
                'pc_lsrp' => 350.00,

                'pc_ppa2lp' => 0.00,
                'pc_lp' => 300.00,

                'pc_ppa2wa' => 0.00,
                'pc_wa' => 310.00,

                'pc_ppa2wb' => 0.00,
                'pc_wb' => 320.00,

                'pc_ppa2wc' => 0.00,
                'pc_wc' => 330.00,

                'pc_ppa2lc' => 0.00,
                'pc_lc' => 340.00,

                'pc_ppa2pg' => 0.00,
                'pc_pg' => 345.00,

                'pc_ppa2ph' => 0.00,
                'pc_ph' => 350.00,

                'pc_ppa2pb' => 0.00,
                'pc_pb' => 355.00,

                'pc_ppa2pd' => 0.000,
                'pc_pd' => 360.00,

                'pc_amt' => 15.00,
                'pc_ref' => 'REF-003',

                'pc_ppa2pc' => 0.00,
                'pc_pc' => 365.00,

                'claim' => 8.00,
                'claim2' => 3.00,

                'claim_k' => 'CLAIM-E',
                'claim_k2' => 'CLAIM-F',

                'percentage' => 15.000,

                'remarks' => 'Rejected due to incorrect pricing',

                'is_active' => false,

                'last_modified_by' => 'manager',
                'last_modified_at' => '2026-09-11 14:00:00',
            ],

        ]);
    }
}