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
        'discount',
        'tax',
        'total_amount',
        'sale_date',
        'payment_method',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}