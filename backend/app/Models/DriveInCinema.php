<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DriveInCinema extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "location",
        "description"
    ];

    public $timestamps = false;

    public $table = "drive_in_cinemas";

    public function screenings():HasMany {
        return $this->hasMany(Screening::class);
    }

    // public function parkingSpots():HasMany {
    //     return $this->hasMany(Parkingspot::class);
    // }
}
