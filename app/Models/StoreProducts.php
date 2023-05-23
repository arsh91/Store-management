<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProducts extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'product_code',
        'product_name',
        'product_description',
        'product_image',
        'product_category_id',
        'current_stock',
        'min_price',
        'max_price',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function productcategory()
    {
        return $this->belongsTo(StoreProductCategories::class, 'product_category_id');
    }
}