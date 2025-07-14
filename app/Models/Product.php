<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'buying_price',
        'selling_price',
        'quantity_in_stock',
        'reorder_level',
        'barcode',
        'image',
    ];
}