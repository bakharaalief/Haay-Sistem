<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $fillable = [
        'type',
        'visible',
        'delete'
    ];

    use HasFactory;
}
