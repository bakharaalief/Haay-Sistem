<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    public function getOrder()
    {
        return $this->hasMany(Order::class, 'order_delivery', 'id');
    }
}
