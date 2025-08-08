<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public $table = "reservations";

    protected $fillable = [
        "user_id",
        "screening_id",
        "location_id",
        "reserved_at",
        "parkingspot",
    ];

    public $timestamps = true;

    public function screening(): BelongsTo
    {
        return $this->belongsTo(Screening::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(DriveInCinema::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
