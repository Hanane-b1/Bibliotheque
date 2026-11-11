<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Bibliothèque de Hanane</title>
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
    </style>
</head>
<body class="elegant-bg">
   <!-- Navigation -->
<nav class="parchment-card nav-border sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between items-center h-24">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <div class="text-4xl gentle-float">📚</div>
                <a href="{{ url('/') }}" class="text-3xl font-bold subtle-gold">
                    Bibliothèque de Hanane
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:space-x-8">
                <a href="{{ route('livres.index') }}" class="border-amber-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium refined-hover">
                    Livres
                </a>
                <a href="{{ route('reservations.index') }}" class="border-transparent text-gray-600 hover:text-amber-700 hover:border-amber-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium refined-hover">
                    Mes Réservations
                </a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium refined-hover">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 parchment-card border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg elegant-shadow">
                    <p class="font-medium">✅ {{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 parchment-card border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg elegant-shadow">
                    <p class="font-medium">❌ {{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>