@extends('layouts.admin')

@section('title', 'Détails de l\'Utilisateur')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-900">Détails de l'Utilisateur</h1>
    <div class="space-x-2">
        <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
            Modifier
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
            Retour
        </a>
    </div>
</div>

<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Nom</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $user->name }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Email</h3>
            <p class="mt-1 text-lg text-gray-900">{{ $user->email }}</p>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500">Rôle</h3>
            <p class="mt-1">
                @if($user->role === 'admin')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                        Administrateur
                        </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    Utilisateur
                </span>
            @endif
        </p>
    </div>

    <div>
        <h3 class="text-sm font-medium text-gray-500">Date d'inscription</h3>
        <p class="mt-1 text-lg text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>
</div>
<!-- User Reservations -->
<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Réservations de l'Utilisateur</h3>
    @if($user->reservations->count() > 0)
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Livre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Début</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Fin</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($user->reservations as $reservation)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">
                    {{ $reservation->livre->titre }}
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
    <p class="text-gray-500">Aucune réservation pour cet utilisateur.</p>
@endif
</div>
@endsection
