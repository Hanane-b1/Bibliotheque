@extends('layouts.admin')

@section('title', 'Gestion des Livres')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-4xl font-bold subtle-gold">Gestion des Livres</h1>
    <a href="{{ route('admin.livres.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
        Ajouter un Livre
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Auteur</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Publication</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Disponible</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($livres as $livre)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $livre->titre }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $livre->auteur }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $livre->categorie->nom }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $livre->date_publication->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($livre->disponible)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Oui
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Non
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.livres.show', $livre) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Voir</a>
                    <a href="{{ route('admin.livres.edit', $livre) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Modifier</a>
                    <form action="{{ route('admin.livres.destroy', $livre) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $livres->links() }}
</div>
@endsection
