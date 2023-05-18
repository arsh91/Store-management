<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreInwardVendors extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'store_id',
        'vendor_name',
        'vendor_description',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}