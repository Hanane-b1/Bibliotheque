<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'livre']);

        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }

        $reservations = $query->latest()->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function valider(Reservation $reservation)
    {
        $reservation->update(['statut' => 'validee']);
        $reservation->livre->update(['disponible' => false]);

        return redirect()->back()
            ->with('success', 'Réservation validée avec succès.');
    }

    public function annuler(Reservation $reservation)
    {
        $reservation->update(['statut' => 'annulee']);
        $reservation->livre->update(['disponible' => true]);

        return redirect()->back()
            ->with('success', 'Réservation annulée avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->statut === 'validee') {
            $reservation->livre->update(['disponible' => true]);
        }

        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}