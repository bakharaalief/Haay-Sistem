<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTopping extends Model
{
    protected $fillable = [
        'topping',
        'price',
        'visible'
    ];

    use HasFactory;
}
