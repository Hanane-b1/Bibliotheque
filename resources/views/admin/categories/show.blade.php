@extends('layouts.admin')

@section('title', 'Détails de la Catégorie')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Détails de la Catégorie</h1>
    <div class="space-x-2">
        <a href="{{ route('admin.categories.edit', $category) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
            Modifier
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Retour
        </a>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="grid grid-cols-1 gap-6">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Nom</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $category->nom }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Description</h3>
            <p class="mt-1 text-gray-900">{{ $category->description ?? 'Aucune description' }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Nombre de Livres</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $category->livres->count() }}</p>
        </div>
    </div>
</div>

<!-- Books in Category -->
<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Livres dans cette Catégorie</h3>
    
    @if($category->livres->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($category->livres as $livre)
                <div class="border rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900">{{ $livre->titre }}</h4>
                    <p class="text-sm text-gray-600">{{ $livre->auteur }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $livre->date_publication->format('d/m/Y') }}</p>
                    <a href="{{ route('admin.livres.show', $livre) }}" class="text-indigo-600 hover:text-indigo-900 text-sm mt-2 inline-block">
                        Voir les détails →
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Aucun livre dans cette catégorie.</p>
    @endif
</div>
@endsection