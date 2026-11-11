<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesLivre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

    // Relationships
    public function livres()
    {
        return $this->hasMany(Livre::class, 'categories_livre_id');
    }
}