<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'auteur',
        'description',
        'image',
        'date_publication',
        'categories_livre_id',
        'disponible',
    ];

    protected $casts = [
        'date_publication' => 'date',
        'disponible' => 'boolean',
    ];

    public function categorie()
    {
        return $this->belongsTo(CategoriesLivre::class, 'categories_livre_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Get average rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    // Check if book is available
    public function estDisponible()
    {
        return $this->disponible;
    }
}