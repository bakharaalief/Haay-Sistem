<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenuType extends Model
{
    protected $fillable = [
        'food_menu',
        'food_type',
        'price',
        'visible',
        'delete'
    ];

    use HasFactory;

    public function getCart()
    {
        return $this->hasMany(Cart::class, 'food_menu_type', 'id');
    }

    public function getFoodMenu()
    {
        return FoodMenu::where('id', $this->food_menu)->first();
    }

    public function getFoodType()
    {
        return FoodType::where('id', $this->food_type)->first();
    }
}
