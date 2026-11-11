<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Livre;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Livre $livre)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'livre_id' => $livre->id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return redirect()->back()->with('success', 'Merci pour votre évaluation !');
    }
}