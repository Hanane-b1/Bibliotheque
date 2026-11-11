<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque de Hanane</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=Lato:wght@300;400;700&display=swap');

        body {
            font-family: 'Lato', sans-serif;
            color: #4a4a4a;
        }

        h1, h2, h3, h4 {
            font-family: 'Crimson Text', serif;
        }

        @keyframes gentle-float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .gentle-float {
            animation: gentle-float 6s ease-in-out infinite;
        }

        .elegant-bg {
            background: linear-gradient(135deg, #faf8f2 0%, #f0e9d2 50%, #e6d7c3 100%);
        }

        .parchment-card {
            background: rgba(250, 248, 242, 0.95);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(230, 215, 195, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .subtle-gold {
            background: linear-gradient(45deg, #c9a96e, #f4e87c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .elegant-shadow {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }

        .refined-hover {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .nav-border {
            border-bottom: 1px solid rgba(201, 169, 110, 0.2);
        }

        /* CAROUSEL ANIMATION */
        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .carousel-container {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding: 60px 0;
            min-height: 500px;
        }

        .carousel-track {
            display: flex;
            animation: scroll-left 40s linear infinite;
            width: max-content;
        }

        .carousel-container:hover .carousel-track {
            animation-play-state: paused;
        }

        .book-card {
            flex-shrink: 0;
            width: 250px;
            margin: 0 20px;
            transition: all 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .book-cover {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="elegant-bg min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="parchment-card sticky top-0 z-50 nav-border">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-10">
            <div class="flex justify-between items-center h-24">
                <div class="flex items-center space-x-4">
    <div class="text-4xl gentle-float">📚</div>
    <h1 class="text-3xl font-bold subtle-gold">
        Bibliothèque de Hanane
    </h1>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <span class="text-gray-700 font-medium">Bonjour, {{ auth()->user()->name }}!</span>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-8 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-xl elegant-shadow refined-hover hover:shadow-xl hover:scale-105">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('livres.index') }}" class="px-8 py-3 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-semibold rounded-xl elegant-shadow refined-hover hover:shadow-xl hover:scale-105">
                                Voir les Livres
                            </a>
                            <a href="{{ route('reservations.index') }}" class="px-8 py-3 parchment-card text-amber-700 font-semibold rounded-xl border-2 border-amber-200 refined-hover hover:bg-amber-50">
                                Mes Réservations
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium refined-hover">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 text-amber-700 font-semibold refined-hover hover:text-amber-900">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="px-10 py-4 bg-gradient-to-r from-amber-600 to-yellow-600 text-white font-bold rounded-xl elegant-shadow refined-hover hover:shadow-2xl hover:scale-105">
                            Inscription Gratuite
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- MOVING BOOKS CAROUSEL (CENTERED) -->
    <div class="flex-1 flex items-center justify-center py-8">
        <div class="w-full">
            <div class="carousel-container">
                <div class="carousel-track">
                  @php
    $books = [
        ['title' => 'Le Petit Prince', 'author' => 'Antoine de Saint-Exupéry', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1367545443i/157993.jpg'],
        ['title' => '1984', 'author' => 'George Orwell', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1657781256i/61439040.jpg'],
        ['title' => 'Le Seigneur des Anneaux', 'author' => 'J.R.R. Tolkien', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1566425108i/33.jpg'],
        ['title' => 'Les Misérables', 'author' => 'Victor Hugo', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1411852091i/24280.jpg'],
        ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1320399351i/1885.jpg'],
        ['title' => 'Harry Potter', 'author' => 'J.K. Rowling', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1474154022i/3.jpg'],
        ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'img' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1703329310i/23692271.jpg'],
    ];
@endphp

                    <!-- First set -->
                    @foreach($books as $book)
                        <div class="book-card parchment-card rounded-2xl overflow-hidden">
                            <img src="{{ $book['img'] }}" alt="{{ $book['title'] }}" class="book-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $book['title'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $book['author'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Duplicate set for seamless loop -->
                    @foreach($books as $book)
                        <div class="book-card parchment-card rounded-2xl overflow-hidden">
                            <img src="{{ $book['img'] }}" alt="{{ $book['title'] }}" class="book-cover">
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $book['title'] }}</h4>
                                <p class="text-sm text-gray-600">{{ $book['author'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-16 mt-auto">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-10">
            <div class="text-center">
                <div class="text-4xl mb-6 gentle-float">📚</div>
                <h4 class="text-3xl font-bold mb-4">Bibliothèque de Hanane</h4>
                <p class="text-gray-400 mb-8 font-light">Votre portail vers un monde de connaissances</p>
                <div class="border-t border-gray-700 pt-7">
                    <p class="text-gray-500 font-light">© 2025 Bibliothèque de Hanane. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>