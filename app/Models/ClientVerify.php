<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientVerify extends Model
{
    use HasFactory;

    protected $table = 'client_verify';
    protected $fillable = [
        'client_id',
        'token',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
