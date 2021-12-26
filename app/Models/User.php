<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // get gender
    public function getGender()
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }

    // get level
    public function getLevel()
    {
        return $this->belongsTo(Level::class, 'level', 'id');
    }

    //get phone
    public function getPhone()
    {
        return $this->hasMany(Phone::class, 'user', 'id');
    }

    //get level
    public function getAddress()
    {
        return $this->hasMany(Address::class, 'user', 'id');
    }

    //get Cart
    public function getCart()
    {
        return $this->hasMany(Cart::class, 'user', 'id');
    }

    //get Order
    public function getOrder()
    {
        return $this->hasMany(Order::class, 'user', 'id');
    }
}
