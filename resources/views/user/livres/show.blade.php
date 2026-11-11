@extends('layouts.user')

@section('title', $livre->titre)

@section('content')
<div class="mb-6">
    <a href="{{ route('livres.index') }}" class="text-amber-600 hover:text-amber-800 font-medium">
        ← Retour aux livres
    </a>
</div>

<div class="parchment-card rounded-lg overflow-hidden elegant-shadow">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-8">
       <!-- Book Cover -->
<div class="md:col-span-1">
    @if($livre->image)
        @if(str_starts_with($livre->image, 'http'))
            <!-- External URL -->
            <img src="{{ $livre->image }}" alt="{{ $livre->titre }}" class="w-full rounded-lg shadow-2xl">
        @else
            <!-- Uploaded file -->
            <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full rounded-lg shadow-2xl">
        @endif
    @else
        <div class="w-full h-96 bg-gradient-to-br from-amber-100 to-yellow-100 rounded-lg flex items-center justify-center shadow-2xl">
            <span class="text-9xl">📖</span>
        </div>
    @endif

            <!-- Average Rating Display -->
            <div class="mt-6 text-center">
                <div class="flex justify-center items-center mb-2">
                    @php
                        $avgRating = $livre->averageRating();
                        $fullStars = floor($avgRating);
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $fullStars)
                            <span class="text-yellow-500 text-3xl">★</span>
                        @else
                            <span class="text-gray-300 text-3xl">★</span>
                        @endif
                    @endfor
                </div>
                <p class="text-gray-600">{{ number_format($avgRating, 1) }} / 5 ({{ $livre->ratings->count() }} avis)</p>
            </div>
        </div>

        <!-- Book Details -->
        <div class="md:col-span-2">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $livre->titre }}</h1>
                    <p class="text-xl text-gray-600">par {{ $livre->auteur }}</p>
                </div>
                @if($livre->disponible)
                    <span class="px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                        Disponible
                    </span>
                @else
                    <span class="px-4 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                        Non disponible
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
                    <p class="mt-1 text-lg text-gray-900">{{ $livre->categorie->nom }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500">Date de Publication</h3>
                    <p class="mt-1 text-lg text-gray-900">{{ $livre->date_publication->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                <p class="text-gray-700 leading-relaxed">{{ $livre->description ?? 'Aucune description disponible.' }}</p>
            </div>

            <!-- Rate This Book -->
            <div class="border-t pt-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">⭐ Évaluer ce livre</h3>
                <form action="{{ route('ratings.store', $livre) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    <div class="flex space-x-2">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" {{ $userRating && $userRating->rating == $i ? 'checked' : '' }} required>
                                <span class="text-4xl text-gray-300 peer-checked:text-yellow-500 hover:text-yellow-400">★</span>
                            </label>
                        @endfor
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-2 px-6 rounded-lg">
                        {{ $userRating ? 'Modifier mon avis' : 'Évaluer' }}
                    </button>
                </form>
            </div>

            @if($livre->disponible)
                <!-- Reservation Form -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📖 Réserver ce livre</h3>
                    
                    <form action="{{ route('reservations.store') }}" method="POST" class="max-w-md">
                        @csrf
                        <input type="hidden" name="livre_id" value="{{ $livre->id }}">

                        <div class="mb-4">
                            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut" required min="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            @error('date_debut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                            <input type="date" name="date_fin" id="date_fin" required min="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            @error('date_fin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-3 px-4 rounded-lg">
                            Réserver ce livre
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t pt-6">
                    <p class="text-red-600 font-medium">Ce livre n'est pas disponible actuellement.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Comments Section -->
<div class="mt-8 parchment-card rounded-lg p-8 elegant-shadow">
    <h3 class="text-2xl font-bold text-gray-900 mb-6">💬 Commentaires ({{ $livre->comments->count() }})</h3>

    <!-- Add Comment Form -->
    <form action="{{ route('comments.store', $livre) }}" method="POST" class="mb-8">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Laisser un commentaire</label>
            <textarea name="comment" id="comment" rows="3" required placeholder="Partagez votre avis sur ce livre..."
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
            @error('comment')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-2 px-6 rounded-lg">
            Publier
        </button>
    </form>

    <!-- Comments List -->
    <div class="space-y-6">
        @forelse($livre->comments()->latest()->get() as $comment)
            <div class="parchment-card rounded-lg p-6 border border-amber-200">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @if($comment->user_id === auth()->id() || auth()->user()->isAdmin())
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Supprimer ce commentaire ?')">
                                Supprimer
                            </button>
                        </form>
                    @endif
                </div>
                <p class="text-gray-700">{{ $comment->comment }}</p>
            </div>
        @empty
            <p class="text-gray-500 text-center py-8">Aucun commentaire pour l'instant. Soyez le premier à commenter !</p>
        @endforelse
    </div>
</div>

@endsection