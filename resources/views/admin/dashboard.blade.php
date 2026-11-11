@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-bold subtle-gold mb-2">Tableau de Bord</h1>
    <p class="text-gray-600">Bienvenue, {{ auth()->user()->name }} 👋</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <!-- Total Books -->
    <div class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl">📚</span>
            </div>
        </div>
        <h3 class="text-3xl font-bold subtle-gold mb-1">{{ $stats['total_livres'] }}</h3>
        <p class="text-sm text-gray-600">Livres Totaux</p>
    </div>

    <!-- Users -->
    <div class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl">👥</span>
            </div>
        </div>
        <h3 class="text-3xl font-bold subtle-gold mb-1">{{ $stats['total_users'] }}</h3>
        <p class="text-sm text-gray-600">Utilisateurs</p>
    </div>

    <!-- Reservations -->
    <div class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl">📋</span>
            </div>
        </div>
        <h3 class="text-3xl font-bold subtle-gold mb-1">{{ $stats['total_reservations'] }}</h3>
        <p class="text-sm text-gray-600">Réservations</p>
    </div>

    <!-- Pending -->
    <div class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl">⏳</span>
            </div>
        </div>
        <h3 class="text-3xl font-bold subtle-gold mb-1">{{ $stats['reservations_en_attente'] }}</h3>
        <p class="text-sm text-gray-600">En Attente</p>
    </div>

    <!-- Categories -->
    <div class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-400 to-pink-500 rounded-xl flex items-center justify-center">
                <span class="text-3xl">🏷️</span>
            </div>
        </div>
        <h3 class="text-3xl font-bold subtle-gold mb-1">{{ $stats['total_categories'] }}</h3>
        <p class="text-sm text-gray-600">Catégories</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <a href="{{ route('admin.livres.create') }}" class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1 text-center group">
        <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 refined-hover">
            <span class="text-3xl">➕</span>
        </div>
        <h4 class="font-bold text-gray-900">Ajouter un Livre</h4>
    </a>

    <a href="{{ route('admin.categories.create') }}" class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1 text-center group">
        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 refined-hover">
            <span class="text-3xl">🏷️</span>
        </div>
        <h4 class="font-bold text-gray-900">Nouvelle Catégorie</h4>
    </a>

    <a href="{{ route('admin.users.create') }}" class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1 text-center group">
        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 refined-hover">
            <span class="text-3xl">👤</span>
        </div>
        <h4 class="font-bold text-gray-900">Nouvel Utilisateur</h4>
    </a>

    <a href="{{ route('admin.reservations.index') }}" class="parchment-card rounded-2xl p-6 elegant-shadow refined-hover hover:shadow-2xl hover:-translate-y-1 text-center group">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 refined-hover">
            <span class="text-3xl">📋</span>
        </div>
        <h4 class="font-bold text-gray-900">Voir Réservations</h4>
    </a>
</div>

<!-- Recent Reservations -->
<div class="parchment-card rounded-2xl elegant-shadow">
    <div class="px-6 py-5 border-b border-amber-200">
        <h3 class="text-2xl font-bold subtle-gold flex items-center">
            <span class="text-3xl mr-3">📋</span>
            Réservations Récentes
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-amber-50 to-yellow-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Utilisateur</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Livre</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Statut</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-amber-100">
                @forelse($reservations_recentes as $reservation)
                <tr class="refined-hover hover:bg-amber-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">{{ substr($reservation->user->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm text-gray-900 font-medium">{{ $reservation->livre->titre }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $reservation->created_at->format('d/m/Y') }}
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
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        Aucune réservation récente
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection