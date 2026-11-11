@extends('layouts.admin')

@section('title', 'Ajouter un Livre')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold subtle-gold">Ajouter un Nouveau Livre</h1>
</div>

<div class="parchment-card rounded-lg p-6">
    <form action="{{ route('admin.livres.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
            @error('titre')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="auteur" class="block text-sm font-medium text-gray-700">Auteur</label>
            <input type="text" name="auteur" id="auteur" value="{{ old('auteur') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
            @error('auteur')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image de Couverture</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date_publication" class="block text-sm font-medium text-gray-700">Date de Publication</label>
            <input type="date" name="date_publication" id="date_publication" value="{{ old('date_publication') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
            @error('date_publication')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categories_livre_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select name="categories_livre_id" id="categories_livre_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categories_livre_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categories_livre_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="disponible" value="1" {{ old('disponible', true) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-amber-600 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                <span class="ml-2 text-sm text-gray-600">Disponible</span>
            </label>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.livres.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Annuler
            </a>
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-2 px-4 rounded">
                Ajouter
            </button>
        </div>
    </form>
</div>
@endsection