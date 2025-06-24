<?php

namespace App\Models;

use App\Http\Controllers\DriveInCinemaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        "movie_id",
        "drive_in_cinema_id",
        "start_time"
    ];

    public $timestamps = false;
    public $table = "screenings";

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function DriveInCinema(): BelongsTo
    {
        return $this->belongsTo(DriveInCinema::class, "drive_in_cinema_id");
    }
}
