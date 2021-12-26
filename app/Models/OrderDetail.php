<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'cart',
        'price_now'
    ];

    public function getOrder()
    {
        return $this->belongsTo(Order::class, 'order', 'id');
    }

    public function getCart()
    {
        return $this->belongsTo(Cart::class, 'cart', 'id');
    }
}
