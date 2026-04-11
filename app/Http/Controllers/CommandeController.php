<?php

namespace App\Http\Controllers;

use App\Mail\FactureCommande;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\CommandeProduit;
use App\Models\Paiement;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('client')->user();

        if (!$user) {
            return redirect()->route('login');
        }


        if ($user->isGestionnaire()) {
            $commandes = Commande::with('client')->latest()->get();
            return view('layout.gestionnaire.ListCommande', compact('commandes'));
        }


        $commandes = $user->commandes()->latest()->get();
        return view('layout.Commandes.index', compact('commandes'));
    }

    public function store(Request $request)
    {
        $client = Auth::guard('client')->user();
        $produits = $request->input('produits');
        $total = $request->input('total');

        if (empty($produits)) {
            return response()->json(['success' => false, 'error' => 'Le panier est vide.'], 400);
        }

        DB::beginTransaction();
        try {

            foreach ($produits as $item) {
                $produit = Produit::find($item['id']);
                if (!$produit || $produit->stock < $item['quantite']) {
                    // Mail de refus
                    try {
                        Mail::to('famatat3@gmail.com')->send(new \App\Mail\CommandeRefuseeStock($produit->nom, $client->prenom));
                    } catch (\Exception $e) {}

                    throw new \Exception("Stock insuffisant pour {$item['nom']}.");
                }
            }


            $commande = Commande::create([
                'date_commande' => now(),
                'total'         => $total,
                'etat'          => 'en_attente',
                'client_id'     => $client->id
            ]);


            PaiementController::enregistrerPaiement($commande->id, $total);


            foreach ($produits as $item) {
                $produit = Produit::find($item['id']);

                CommandeProduit::create([
                    'commande_id'  => $commande->id,
                    'produit_id'   => $item['id'],
                    'quantite'     => $item['quantite'],
                    'prixUnitaire' => $item['prix'],
                    'prixTotal'    => $item['prix'] * $item['quantite'],
                ]);

                $produit->decrement('stock', $item['quantite']);
            }

            DB::commit();


            try {
                Mail::to('famatat3@gmail.com')->send(new \App\Mail\ConfirmationCommande($commande));
            } catch (\Exception $e) {}

            return response()->json(['success' => true, 'message' => 'Commande et paiement validés !']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Méthode spécifique pour le bouton du gestionnaire
     */
    // CommandeController.php

    public function marquerPrete($id)
    {
        $commande = Commande::with('client')->findOrFail($id);

        if ($commande->etat === 'payee') {
            return back()->with('info', 'Commande déjà payée.');
        }

        if ($commande->etat === 'prete') {
            // Deuxième clic
            $commande->etat = 'payee';
            $commande->save();

            return redirect()->route('commandes.index')
                ->with('success', 'Commande marquée comme payée !');
        }

        // Premier clic
        $commande->etat = 'prete';
        $commande->save();

        try {
            Mail::to('famatat3@gmail.com')->send(new \App\Mail\FactureCommande($commande));


        } catch (\Exception $e) {
            return back()->with('error', 'Commande prête mais erreur mail : ' . $e->getMessage());
        }

        return redirect()->route('commandes.index')
            ->with('success', 'Commande prête + facture envoyée !');
    }

    public function show(Commande $commande)
    {
        $commande->load('produits.produit');
        return view('layout.Commandes.show', compact('commande'));
    }

    public function commandesPayees()
    {
        $user = Auth::guard('client')->user();

        // Sécurité : seul le gestionnaire peut voir
        if (!$user || !$user->isGestionnaire()) {
            return redirect()->route('login');
        }

        // Récupérer uniquement les commandes payées
        $commandes = Commande::with('client')
            ->whereRaw("LOWER(TRIM(etat)) = ?", ['payee'])
            ->latest()
            ->get();

        // Calcul du total encaissé
        $totalEncaisse = $commandes->sum('total');

        return view('layout.gestionnaire.CommandesPayees', compact('commandes', 'totalEncaisse'));
    }



    public function tableaudeboard()
    {
        // Récupération des données réelles pour le dashboard [cite: 34, 35, 36]
        $recettesJour = Paiement::whereDate('date_paiement', Carbon::today())->sum('montant');
        $commandesEnCours = Commande::whereDate('created_at', Carbon::today())
            ->whereIn('etat', ['en_attente', 'en_preparation'])
            ->count();
        $commandesValidees = Commande::whereDate('created_at', Carbon::today())
            ->whereIn('etat', ['prete', 'payee'])
            ->count();
        $produitsEpuises = Produit::where('stock', '<=', 0)->count();

        // Récupération des 5 dernières commandes pour le tableau [cite: 17]
        $dernieresCommandes = Commande::with('client')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Envoi de TOUTES les variables à la vue
        return view('layout.gestionnaire.dashboardGestionnaire', compact(
            'recettesJour',
            'commandesEnCours',
            'commandesValidees',
            'produitsEpuises',
            'dernieresCommandes'
        ));
    }


    public function statistiques()
    {

        $commandesParMois = DB::table('commandes')
            ->select(
                DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [Carbon::now()->year])
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->get();

        $labelsMois = [];
        $dataCommandes = [];

        foreach ($commandesParMois as $item) {
            $labelsMois[] = Carbon::create()
                ->month((int)$item->mois)
                ->locale('fr')
                ->translatedFormat('F');

            $dataCommandes[] = $item->total;
        }


        $categories = Categorie::withCount('produits')->get();

        $labelsCategories = [];
        $dataProduits = [];

        foreach ($categories as $cat) {
            $labelsCategories[] = $cat->libelle;
            $dataProduits[] = $cat->produits_count;
        }

        return view('layout.gestionnaire.statistiques', compact(
            'labelsMois',
            'dataCommandes',
            'labelsCategories',
            'dataProduits'
        ));
    }
}
