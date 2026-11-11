<?php

namespace Database\Seeders;

use App\Models\Livre;
use Illuminate\Database\Seeder;

class LivreSeeder extends Seeder
{
    public function run(): void
    {
        $livres = [
            [
                'titre' => 'Le Petit Prince',
                'auteur' => 'Antoine de Saint-Exupéry',
                'description' => 'Un conte poétique et philosophique sous l\'apparence d\'un conte pour enfants.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1367545443i/157993.jpg',
                'date_publication' => '1943-04-06',
                'categories_livre_id' => 1,
                'disponible' => true,
            ],
            [
                'titre' => '1984',
                'auteur' => 'George Orwell',
                'description' => 'Un roman dystopique sur un régime totalitaire qui surveille et contrôle tout.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1657781256i/61439040.jpg',
                'date_publication' => '1949-06-08',
                'categories_livre_id' => 2,
                'disponible' => true,
            ],
            [
                'titre' => 'Le Seigneur des Anneaux',
                'auteur' => 'J.R.R. Tolkien',
                'description' => 'Une épopée fantasy légendaire dans la Terre du Milieu.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1566425108i/33.jpg',
                'date_publication' => '1954-07-29',
                'categories_livre_id' => 2,
                'disponible' => true,
            ],
            [
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'description' => 'Un roman historique sur la justice, la rédemption et l\'amour.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1411852091i/24280.jpg',
                'date_publication' => '1862-01-01',
                'categories_livre_id' => 1,
                'disponible' => true,
            ],
            [
                'titre' => 'Pride and Prejudice',
                'auteur' => 'Jane Austen',
                'description' => 'Un roman classique sur l\'amour, la société et les préjugés.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1320399351i/1885.jpg',
                'date_publication' => '1813-01-28',
                'categories_livre_id' => 1,
                'disponible' => true,
            ],
            [
                'titre' => 'Harry Potter',
                'auteur' => 'J.K. Rowling',
                'description' => 'Les aventures magiques d\'un jeune sorcier à Poudlard.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1474154022i/3.jpg',
                'date_publication' => '1997-06-26',
                'categories_livre_id' => 2,
                'disponible' => true,
            ],
            [
                'titre' => 'Sapiens',
                'auteur' => 'Yuval Noah Harari',
                'description' => 'Une brève histoire de l\'humanité, de l\'âge de pierre à nos jours.',
                'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1703329310i/23692271.jpg',
                'date_publication' => '2011-01-01',
                'categories_livre_id' => 4,
                'disponible' => true,
            ],
        ];

        foreach ($livres as $livre) {
            Livre::create($livre);
        }
    }
}