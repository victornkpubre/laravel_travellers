<?php

namespace App\Models;

use App\Models\Place;
use App\Models\Activity;
use App\Models\Festival;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emotion extends Model
{
    use HasFactory;
    protected $fillable = [
        "img",
        "festival_id",
        "place_id",
        "activity_id"
    ];

    public function place() : BelongsTo
    {

        return $this->belongsTo(Place::class);
    }

    public function festival() : BelongsTo
    {
        return $this->belongsTo(Festival::class);
    }

    public function activity() : BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

}
