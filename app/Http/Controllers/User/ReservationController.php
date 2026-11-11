<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Livre;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()
            ->with('livre.categorie')
            ->latest()
            ->paginate(10);

        return view('user.reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Check if user already has an active reservation
        $activeReservation = Reservation::where('user_id', auth()->id())
            ->whereIn('statut', ['en_attente', 'validee'])
            ->exists();

        if ($activeReservation) {
            return redirect()->back()
                ->with('error', 'Vous avez déjà une réservation active. Vous ne pouvez réserver qu\'un livre à la fois.');
        }

        $validated = $request->validate([
            'livre_id' => 'required|exists:livres,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $livre = Livre::findOrFail($validated['livre_id']);

        if (!$livre->disponible) {
            return redirect()->back()
                ->with('error', 'Ce livre n\'est pas disponible actuellement.');
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'livre_id' => $validated['livre_id'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'statut' => 'en_attente',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Votre réservation a été soumise et est en attente de validation.');
    }

    public function destroy(Reservation $reservation)
    {
        // Check if the reservation belongs to the authenticated user
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($reservation->statut === 'validee') {
            $reservation->livre->update(['disponible' => true]);
        }

        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès.');
    }
}