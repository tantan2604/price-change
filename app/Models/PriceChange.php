<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceChange extends Model
{
    protected $fillable = [
        'document_id',
        'document_status',
        'created_by',
        'created_at',
        'approved_by',
        'approved_at',
        'memo_title',
        'supplier_name',
        'start_date',
        'end_date',
        'promotion_type',
        'product_code',
        'product_name',
        'product_brand',
        'is_active',
        'last_modified_by',
        'last_modified_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'approved_at' => 'datetime',
        'last_modified_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
