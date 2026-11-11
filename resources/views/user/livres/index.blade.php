@extends('layouts.user')

@section('title', 'Livres Disponibles')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold subtle-gold">Livres Disponibles</h1>
</div>

<!-- Search and Filter -->
<div class="parchment-card rounded-lg p-6 mb-6 elegant-shadow">
    <form action="{{ route('livres.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Titre ou auteur..."
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
        </div>

       <div>
    <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
    <select name="categorie" id="categorie"
        class="block w-full rounded-lg border-2 border-amber-200 bg-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4 text-gray-700 font-medium">
        <option value="">🏷️ Toutes les catégories</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                📚 {{ $categorie->nom }}
            </option>
        @endforeach
    </select>
</div>

        <div class="flex items-end">
            <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-3 px-6 rounded-lg elegant-shadow refined-hover">
                Rechercher
            </button>
        </div>
    </form>
</div>

<!-- Books Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($livres as $livre)
        <div class="parchment-card rounded-lg overflow-hidden elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
            <!-- Book Image -->
@if($livre->image)
    @if(str_starts_with($livre->image, 'http'))
        <!-- External URL -->
        <img src="{{ $livre->image }}" alt="{{ $livre->titre }}" class="w-full h-80 object-cover">
    @else
        <!-- Uploaded file -->
        <img src="{{ asset('storage/' . $livre->image) }}" alt="{{ $livre->titre }}" class="w-full h-80 object-cover">
    @endif
@else
    <div class="w-full h-80 bg-gradient-to-br from-amber-100 to-yellow-100 flex items-center justify-center">
        <span class="text-6xl">📖</span>
    </div>
@endif

            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $livre->titre }}</h3>
                        <p class="text-sm text-gray-600 mb-1">{{ $livre->auteur }}</p>
                    </div>
                    @if($livre->disponible)
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Disponible
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            Réservé
                        </span>
                    @endif
                </div>

                <p class="text-sm text-gray-500 mb-2">
                    <span class="font-medium">Catégorie:</span> {{ $livre->categorie->nom }}
                </p>

                <p class="text-sm text-gray-500 mb-4">
                    <span class="font-medium">Publié:</span> {{ $livre->date_publication->format('d/m/Y') }}
                </p>

                <!-- Star Rating Display -->
                <div class="flex items-center mb-4">
                    @php
                        $avgRating = round($livre->averageRating());
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $avgRating)
                            <span class="text-yellow-500 text-xl">★</span>
                        @else
                            <span class="text-gray-300 text-xl">★</span>
                        @endif
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">({{ $livre->ratings->count() }} avis)</span>
                </div>

                <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                    {{ Str::limit($livre->description, 100) }}
                </p>

                <a href="{{ route('livres.show', $livre) }}" class="block w-full text-center bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-3 px-4 rounded-lg refined-hover">
                    Voir les détails
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 text-lg">Aucun livre trouvé.</p>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $livres->links() }}
</div>
@endsection