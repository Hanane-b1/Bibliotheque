@extends('layouts.admin')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="mb-6">
    <h1 class="text-4xl font-bold subtle-gold">Gestion des Réservations</h1>
</div>

<!-- Filter -->
<div class="parchment-card rounded-lg p-6 mb-6 elegant-shadow">
    <form action="{{ route('admin.reservations.index') }}" method="GET" class="flex items-end space-x-4">
        <div class="flex-1">
            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">Filtrer par Statut</label>
            <select name="statut" id="statut" class="block w-full rounded-lg border-2 border-amber-200 bg-white shadow-sm focus:border-amber-500 focus:ring-amber-500 py-3 px-4 text-gray-700 font-medium">
                <option value="">📋 Tous les statuts</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                <option value="validee" {{ request('statut') == 'validee' ? 'selected' : '' }}>✅ Validée</option>
                <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>❌ Annulée</option>
            </select>
        </div>
        <button type="submit" class="bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-3 px-8 rounded-lg elegant-shadow">
            Filtrer
        </button>
    </form>
</div>

<div class="parchment-card rounded-lg overflow-hidden elegant-shadow">
    <table class="min-w-full">
        <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Utilisateur</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Livre</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date Début</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date Fin</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Statut</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-amber-100">
            @foreach($reservations as $reservation)
            <tr class="refined-hover hover:bg-amber-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold">{{ substr($reservation->user->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                    {{ $reservation->livre->titre }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ $reservation->date_debut->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ $reservation->date_fin->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($reservation->statut === 'en_attente')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            ⏳ En attente
                        </span>
                    @elseif($reservation->statut === 'validee')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            ✅ Validée
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            ❌ Annulée
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex space-x-2">
                        @if($reservation->statut === 'en_attente')
                            <form action="{{ route('admin.reservations.valider', $reservation) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-100 hover:bg-green-200 text-green-800 font-medium py-1 px-3 rounded">
                                    ✅ Valider
                                </button>
                            </form>
                            <form action="{{ route('admin.reservations.annuler', $reservation) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-800 font-medium py-1 px-3 rounded">
                                    ❌ Refuser
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-1 px-3 rounded" onclick="return confirm('Êtes-vous sûr ?')">
                                🗑️ Supprimer
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-yellow-50">
        {{ $reservations->links() }}
    </div>
</div>
@endsection