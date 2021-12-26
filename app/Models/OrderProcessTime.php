<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProcessTime extends Model
{
    use HasFactory;

    public function getProcessOrder()
    {
        return $this->hasMany(Order::class, 'order_process_time', 'id');
    }
}
