@extends('layouts.admin')

@section('title', 'Détails du Livre')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Détails du Livre</h1>
    <div class="space-x-2">
        <a href="{{ route('admin.livres.edit', $livre) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
            Modifier
        </a>
        <a href="{{ route('admin.livres.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Retour
        </a>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Titre</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $livre->titre }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Auteur</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $livre->auteur }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Catégorie</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $livre->categorie->nom }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Date de Publication</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $livre->date_publication->format('d/m/Y') }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Disponibilité</h3>
            <p class="mt-1">
                @if($livre->disponible)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Disponible
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Non disponible
                    </span>
                @endif
            </p>
        </div>

        <div class="col-span-2">
            <h3 class="text-sm font-medium text-gray-500">Description</h3>
            <p class="mt-1 text-gray-900">{{ $livre->description ?? 'Aucune description' }}</p>
        </div>
    </div>
</div>

<!-- Reservations History -->
<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Historique des Réservations</h3>
    
    @if($livre->reservations->count() > 0)
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Début</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Fin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($livre->reservations as $reservation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $reservation->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $reservation->date_debut->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $reservation->date_fin->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($reservation->statut === 'en_attente')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                En attente
                            </span>
                        @elseif($reservation->statut === 'validee')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Validée
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Annulée
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500">Aucune réservation pour ce livre.</p>
    @endif
</div>
@endsection