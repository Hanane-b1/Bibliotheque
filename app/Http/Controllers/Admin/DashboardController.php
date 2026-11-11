<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\User;
use App\Models\Reservation;
use App\Models\CategoriesLivre;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_livres' => Livre::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_reservations' => Reservation::count(),
            'reservations_en_attente' => Reservation::where('statut', 'en_attente')->count(),
            'total_categories' => CategoriesLivre::count(),
        ];

        $reservations_recentes = Reservation::with(['user', 'livre'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'reservations_recentes'));
    }
}