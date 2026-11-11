@extends('layouts.user')

@section('title', 'Mes Réservations')

@section('content')
<div class="mb-6">
    <h1 class="text-4xl font-bold subtle-gold">Mes Réservations</h1>
</div>

<div class="parchment-card rounded-lg overflow-hidden elegant-shadow">
    @if($reservations->count() > 0)
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Livre</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date Début</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date Fin</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-amber-100">
                @foreach($reservations as $reservation)
                <tr class="refined-hover hover:bg-amber-50">
                    <td class="px-6 py-4">
                        <a href="{{ route('livres.show', $reservation->livre) }}" class="text-amber-700 hover:text-amber-900 font-medium">
                            {{ $reservation->livre->titre }}
                        </a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $reservation->livre->categorie->nom }}
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
                        @if($reservation->statut !== 'annulee')
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                    Annuler
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-yellow-50">
            {{ $reservations->links() }}
        </div>
    @else
        <div class="p-12 text-center">
            <div class="text-6xl mb-4">📚</div>
            <p class="text-gray-600 text-lg mb-4">Vous n'avez aucune réservation.</p>
            <a href="{{ route('livres.index') }}" class="inline-block bg-gradient-to-r from-amber-600 to-yellow-600 hover:from-amber-700 hover:to-yellow-700 text-white font-bold py-3 px-8 rounded-lg elegant-shadow">
                Parcourir les livres
            </a>
        </div>
    @endif
</div>
@endsection