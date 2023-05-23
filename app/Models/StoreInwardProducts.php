<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreInwardProducts extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'store_product_id',
        'store_inward_vendor_id',
        'stock_inward',
        'inward_by',
        'product_price',
        'total_amount',
        'bill_no',
        'bill_image',
        'inward_person_from',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function storeproduct()
    {
        return $this->belongsTo(StoreProducts::class, 'store_product_id');
    }

    public function storeinwardvendors()
    {
        return $this->belongsTo(StoreInwardVendors::class, 'store_inward_vendor_id');
    }

    public function inwardby()
    {
        return $this->belongsTo(Users::class, 'inward_by');
    }
}