<?php

namespace App\Models;

use App\Models\Place;
use App\Models\Festival;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        "name"
    ];

    public function places() {
        return $this->hasMany(Place::class);
    }
    public function festivals() {
        return $this->hasMany(Festival::class);
    }
}
