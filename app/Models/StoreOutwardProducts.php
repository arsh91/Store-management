<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreOutwardProducts extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'store_product_id',
        'store_outward_vendor_id',
        'stock_outward',
        'outward_by',
        'outward_image',
        'approve_by',
        'outward_person',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function storeproduct()
    {
        return $this->belongsTo(StoreProducts::class, 'store_product_id');
    }

    public function storeoutwardvendors()
    {
        return $this->belongsTo(StoreOutwardVendors::class, 'store_outward_vendor_id');
    }

    public function outwardby()
    {
        return $this->belongsTo(Users::class, 'outward_by');
    }
}