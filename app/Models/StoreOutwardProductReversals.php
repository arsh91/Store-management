<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreOutwardProductReversals extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'store_product_id',
        'outward_id',
        'reversal_quantity',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function storeproduct()
    {
        return $this->belongsTo(StoreProducts::class, 'store_product_id');
    }
}