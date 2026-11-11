<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Livre;
use App\Models\CategoriesLivre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::with('categorie')->latest()->paginate(10);
        return view('admin.livres.index', compact('livres'));
    }

    public function create()
    {
        $categories = CategoriesLivre::all();
        return view('admin.livres.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_publication' => 'required|date',
            'categories_livre_id' => 'required|exists:categories_livres,id',
            'disponible' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        Livre::create($validated);

        return redirect()->route('admin.livres.index')
            ->with('success', 'Livre ajouté avec succès.');
    }

    public function show(Livre $livre)
    {
        $livre->load('categorie', 'reservations.user');
        return view('admin.livres.show', compact('livre'));
    }

    public function edit(Livre $livre)
    {
        $categories = CategoriesLivre::all();
        return view('admin.livres.edit', compact('livre', 'categories'));
    }

    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_publication' => 'required|date',
            'categories_livre_id' => 'required|exists:categories_livres,id',
            'disponible' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $validated['image'] = $request->file('image')->store('books', 'public');
        }

        $livre->update($validated);

        return redirect()->route('admin.livres.index')
            ->with('success', 'Livre modifié avec succès.');
    }

    public function destroy(Livre $livre)
    {
        // Delete image
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }

        $livre->delete();

        return redirect()->route('admin.livres.index')
            ->with('success', 'Livre supprimé avec succès.');
    }
}