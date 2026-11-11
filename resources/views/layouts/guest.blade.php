<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    </style>
</head>
<body class="elegant-bg antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8">
            <a href="/" class="flex items-center space-x-4">
                <div class="text-5xl gentle-float">📚</div>
                <h1 class="text-4xl font-bold subtle-gold">
                    Bibliothèque de Hanane
                </h1>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 parchment-card rounded-2xl">
            {{ $slot }}
        </div>
    </div>
</body>
</html>