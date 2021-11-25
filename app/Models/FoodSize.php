<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodSize extends Model
{
    protected $fillable = [
        'size',
        'visible',
        'delete'
    ];

    use HasFactory;

    public function getMenu()
    {
        return $this->hasMany(FoodMenu::class, 'food_size', 'id');
    }
}
