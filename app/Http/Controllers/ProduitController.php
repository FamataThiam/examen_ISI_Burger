<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Afficher la liste des produits
     */
    public function index()
    {
        $categories = Categorie::all();

        // On affiche seulement les produits non archivés
        $produits = Produit::where('statut', '!=', 'archive')->get();

        return view('layout.gestionnaire.GestionProduits', compact('categories', 'produits'));
    }

    /**
     * Enregistrer un produit
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'libelle'      => 'required|string|max:255|unique:produits,libelle',
            'prix'         => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'description'  => 'nullable|string|min:10',
            'image'        => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('produits', 'public');
            $validated['image'] = $path;
        }

        // Ajouter le statut et la date de création
        $validated['statut'] = 'actif';
        $validated['date_creation'] = now();

        // Création du produit
        $produit = Produit::create($validated);

        return redirect()->back()->with('success', 'Burger ajouté avec succès !');
    }

    /**
     * Modifier un produit
     */
    public function update(Request $request, string $id)
    {
        $produit = Produit::findOrFail($id);

        $validated = $request->validate([
            'libelle'      => 'required|string|max:255|unique:produits,libelle,' . $id,
            'prix'         => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'description'  => 'nullable|string|min:10',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Si nouvelle image
        if ($request->hasFile('image')) {

            // Supprimer ancienne image
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }

            $path = $request->file('image')->store('produits', 'public');
            $validated['image'] = $path;
        }

        $produit->update($validated);

        return redirect()->back()->with('success', 'Produit modifié avec succès');
    }

    /**
     * Archiver un produit (soft delete logique)
     */
    public function archiver(string $id)
    {
        $produit = Produit::findOrFail($id);

        $produit->update([
            'statut' => 'archive' // correspond à la migration
        ]);

        return redirect()->back()->with('success', 'Produit archivé');
    }

    /**
     * Supprimer définitivement un produit
     */
    public function destroy(string $id)
    {
        $produit = Produit::findOrFail($id);

        // Supprimer image
        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->back()->with('success', 'Produit supprimé ');
    }

    public function catalogue(Request $request)
    {
        // 1. On récupère toutes les catégories pour afficher les boutons de filtre
        $categories = Categorie::all();

        // 2. On commence la requête sur les produits actifs et en stock
        $query = Produit::with('categorie')
            ->where('statut', 'actif')
            ->where('stock', '>', 0);

        // 3. Filtre par catégorie (si présent dans l'URL)
        if ($request->has('categorie') && $request->categorie != 'all') {
            $query->whereHas('categorie', function($q) use ($request) {
                $q->where('libelle', $request->categorie);
            });
        }

        // 4. Filtre par recherche textuelle (si présent dans l'URL)
        if ($request->has('search') && !empty($request->search)) {
            $query->where('libelle', 'LIKE', '%' . $request->search . '%');
        }

        // 5. On récupère les résultats
        $produits = $query->get();

        return view('layout.Produits.Catalogue', compact('categories', 'produits'));
    }
}
