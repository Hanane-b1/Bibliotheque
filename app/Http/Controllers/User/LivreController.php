<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\CategoriesLivre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $query = Livre::with('categorie')->where('disponible', true);

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('auteur', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('categorie') && $request->categorie != '') {
            $query->where('categories_livre_id', $request->categorie);
        }

        $livres = $query->latest()->paginate(12);
        $categories = CategoriesLivre::all();

        return view('user.livres.index', compact('livres', 'categories'));
    }

   
    public function show(Livre $livre)
{
    $livre->load([
        'categorie',
        'ratings',
        'comments.user'
    ]);
    
    $userRating = null;
    if (auth()->check()) {
        $userRating = $livre->ratings()->where('user_id', auth()->id())->first();
    }
    
    return view('user.livres.show', compact('livre', 'userRating'));
}
}