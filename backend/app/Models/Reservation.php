<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "created_at"
    ];

    public $timestamps = true;

    public function screening()
    {
        return $this->belongsTo(Screening::class);
    }

    public function location()
    {
        return $this->belongsTo(DriveInCinema::class);
    }
}
