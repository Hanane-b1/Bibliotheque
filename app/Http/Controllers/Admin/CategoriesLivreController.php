<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriesLivre;
use Illuminate\Http\Request;

class CategoriesLivreController extends Controller
{
    public function index()
    {
        $categories = CategoriesLivre::withCount('livres')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories_livres',
            'description' => 'nullable|string',
        ]);

        CategoriesLivre::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function show(CategoriesLivre $category)
    {
        $category->load('livres');
        return view('admin.categories.show', compact('category'));
    }

    public function edit(CategoriesLivre $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, CategoriesLivre $category)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories_livres,nom,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(CategoriesLivre $category)
    {
        if ($category->livres()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer une catégorie contenant des livres.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}