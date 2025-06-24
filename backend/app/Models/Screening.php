<?php

namespace App\Models;

use App\Http\Controllers\DriveinCinemaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screening extends Model
{
    use HasFactory;

    protected $fillable = [
        "movie_id",
        "driveincinema_id",
        "start_time"
    ];

    public $timestamps = false;

    public $table = "screenings";

    // public function movie():BelongsTo {
    //     return $this->belongsTo(Movie::class);
    // }

    public function driveinCinema():BelongsTo {
        return $this->belongsTo(DriveinCinema::class, "driveincinema_id");
    }
}
