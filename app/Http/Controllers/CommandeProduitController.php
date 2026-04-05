<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommandeProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // Dans ton CommandeController.php
    public function storeDetails(Request $request)
    {

        $produitsAEnregistrer = $request->input('produits');

        foreach ($produitsAEnregistrer as $item) {
            // C'est ici qu'on utilise le modèle CommandeProduit
            \App\Models\CommandeProduit::create([
                'commande_id'  => $request->input('commande_id'),
                'produit_id'   => $item['id'],
                'quantite'     => $item['quantite'],
                'prixUnitaire' => $item['prix'],
                'prixTotal'    => $item['prix'] * $item['quantite'],
            ]);
        }

        return response()->json(['message' => 'Détails enregistrés avec succès']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
