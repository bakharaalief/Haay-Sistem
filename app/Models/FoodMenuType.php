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

    // public function getFoodMenu()
    // {
    //     return $this->belongsToMany(FoodMenu::class);
    // }

    // public function getFoodType()
    // {
    //     return $this->belongsToMany(FoodType::class);
    // }
}
