<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
