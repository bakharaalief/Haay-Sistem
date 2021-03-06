<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user',
        'food_menu_type',
        'amount',
        'notes',
        'photo_referensi'
    ];

    use HasFactory;

    public function getFoodMenuType()
    {
        return $this->belongsTo(FoodMenuType::class, 'food_menu_type', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function getOrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'cart', 'id');
    }
}
