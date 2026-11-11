<?php

namespace Database\Seeders;

use App\Models\CategoriesLivre;
use Illuminate\Database\Seeder;

class CategoriesLivreSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Roman', 'description' => 'Romans et littérature générale'],
            ['nom' => 'Science-Fiction', 'description' => 'Romans de science-fiction et fantasy'],
            ['nom' => 'Policier', 'description' => 'Romans policiers et thrillers'],
            ['nom' => 'Histoire', 'description' => 'Livres d\'histoire et biographies'],
            ['nom' => 'Science', 'description' => 'Livres scientifiques et techniques'],
            ['nom' => 'Philosophie', 'description' => 'Ouvrages de philosophie'],
        ];

        foreach ($categories as $categorie) {
            CategoriesLivre::create($categorie);
        }
    }
}