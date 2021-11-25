<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'food_category',
        'food_size',
        'link_image'
    ];

    use HasFactory;

    public function getCategory()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category', 'id');
    }

    public function getSize()
    {
        return $this->belongsTo(FoodSize::class, 'food_size', 'id');
    }
}
