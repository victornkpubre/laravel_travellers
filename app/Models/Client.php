<?php

namespace App\Models;

use App\Models\Place;
use App\Models\Booking;
use App\Models\Festival;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        "first_name",
        "last_name",
        'password',
        "email",
        "phone",
        'otp',
        'is_phone_verified'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function festivals()
    {
        return $this->belongsToMany(Festival::class);
    }

}
