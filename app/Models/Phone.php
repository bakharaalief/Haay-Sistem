<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function getOrder()
    {
        return $this->hasMany(Order::class, 'phone', 'id');
    }
}
