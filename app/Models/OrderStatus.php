<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public function getOrder()
    {
        return $this->hasMany(Order::class, 'order_status', 'id');
    }
}
