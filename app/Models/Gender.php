<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'visible'
    ];

    public function getUser()
    {
        return $this->hasMany(User::class, 'gender', 'id');
    }
}