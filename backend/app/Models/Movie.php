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

    protected $casts = [
        'release_date' => 'date',
        'actors' => 'array',
    ];

    protected $fillable = [
        'title',
        'description',
        'type',
        'release_date',
        'age_limit',
        'director',
        'duration_min',
        'poster_url',
        'actors',
        'created_at',
        'updated_at',
    ];
    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}
