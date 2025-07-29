<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'type',
        'duration_min',
        'poster_url',
    ];
    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}
