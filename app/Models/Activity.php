<?php

namespace App\Models;

use App\Models\Emotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "img",
    ];

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function festivals()
    {
        return $this->belongsToMany(Festival::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function emotions()
    {
        return $this->hasMany(Emotion::class);
    }

}
