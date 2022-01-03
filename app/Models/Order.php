<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'phone',
        'address',
        'order_process_time',
        'order_process_price_now',
        'order_delivery',
        'order_delivery_price_now',
        'bukti_transfer',
        'order_status',
        'total_price'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function getPhone()
    {
        return $this->belongsTo(Phone::class, 'phone', 'id');
    }

    public function getAddress()
    {
        return $this->belongsTo(Address::class, 'address', 'id');
    }

    public function getOrderProcess()
    {
        return $this->belongsTo(OrderProcessTime::class, 'order_process_time', 'id');
    }

    public function getKurir()
    {
        return $this->belongsTo(OrderDelivery::class, 'order_delivery', 'id');
    }

    public function getStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }

    public function getDetailOrder()
    {
        return $this->hasMany(OrderDetail::class, 'order', 'id');
    }
}
