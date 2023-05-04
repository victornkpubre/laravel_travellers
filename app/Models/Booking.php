<?php

namespace App\Models;

use App\Models\Place;
use App\Models\Client;
use App\Models\Festival;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function festivals()
    {
        return $this->belongsToMany(Festival::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }



}
