<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'cashier_id',
        'product_id',
        'quantity',
        'selling_price',
        'total_amount',
        'sale_date',
        'payment_method',
    ];
}
