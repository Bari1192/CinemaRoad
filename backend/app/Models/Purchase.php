<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'location_id',
        'screening_id',
        'movie_id',
        'ticket_code',
        'guest_email',
        'parkingspot',
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function screening(): BelongsTo
    {
        return $this->belongsTo(Screening::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(DriveInCinema::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
