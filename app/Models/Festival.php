<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Booking;
use App\Models\Emotion;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Festival extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img',
        'description',
        'price',
        'people',
        'location_id'
    ];

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function emotions()
    {
        return $this->hasMany(Emotion::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
