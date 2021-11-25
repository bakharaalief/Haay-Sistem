<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $fillable = [
        'category',
        'visible',
        'delete'
    ];

    use HasFactory;

    public function getMenu()
    {
        return $this->hasMany(FoodMenu::class, 'food_category', 'id');
    }
}
