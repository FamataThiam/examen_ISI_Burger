@extends('template')

@section('title', 'ISIBurger — Dashboard Gestionnaire')

@section('content')
    <div class="flex min-h-screen bg-slate-50">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6">
                <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                    Menu Gestion
                </h2>
            </div>

            <nav class="space-y-1 px-3">
                <!-- ✅ ROUTE CORRIGÉE -->
                <a href="{{ route('dashboardGestionnaire') }}"
                   class="flex items-center space-x-3 bg-orange-50 text-orange-600 px-4 py-3 rounded-xl font-bold">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Vue d'ensemble</span>
                </a>

                <a href="{{ route('gestion.produits') }}"
                   class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-burger"></i>
                    <span>Produits / Stocks</span>
                </a>

                <a href="{{ route('commandes.index') }}"
                   class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Commandes</span>
                </a>

                <hr class="my-4 border-slate-100">

                <a href="#"
                   class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Statistiques</span>
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-8">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800">Tableau de bord</h1>

                    <!-- ✅ SÉCURISATION AUTH -->
                    <p class="text-slate-500">
                        Bienvenue,
                        {{ auth('client')->check() ? auth('client')->user()->prenom : 'Gestionnaire' }}.
                        État actuel d'ISI BURGER.
                    </p>
                </div>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-coins text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Recettes du jour</h3>
                    <p class="text-2xl font-bold text-slate-800">
                        {{ number_format($recettesJour ?? 0, 0, ',', ' ') }}
                        <span class="text-sm font-normal">FCFA</span>
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Commandes en cours</h3>
                    <p class="text-2xl font-bold text-slate-800">
                        {{ $commandesEnCours ?? 0 }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-check-double text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Validées (Aujourd'hui)</h3>
                    <p class="text-2xl font-bold text-slate-800">
                        {{ $commandesValidees ?? 0 }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-box-archive text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Produits épuisés</h3>
                    <p class="text-2xl font-bold text-red-600">
                        {{ $produitsEpuises ?? 0 }}
                    </p>
                </div>

            </div>

            <!-- TABLE -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-700">Dernières Commandes</h3>
                        <a href="{{ route('commandes.index') }}"
                           class="text-orange-500 text-sm font-semibold hover:underline">
                            Voir tout
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-slate-400 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3">Statut</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-50 text-sm">
                            @forelse($dernieresCommandes ?? [] as $commande)
                                <tr>
                                    <!-- ✅ SÉCURISATION CLIENT -->
                                    <td class="px-6 py-4 font-medium">
                                        {{ optional($commande->client)->prenom ?? 'N/A' }}
                                        {{ optional($commande->client)->nom ?? '' }}
                                    </td>

                                    <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-lg text-xs font-bold
                                        {{ $commande->etat == 'en_attente'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst(str_replace('_', ' ', $commande->etat)) }}
                                    </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-slate-400">
                                        Aucune commande aujourd'hui.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- INFO -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col items-center justify-center text-slate-400 text-center">
                    <i class="fa-solid fa-chart-line text-5xl mb-4 text-slate-200"></i>
                    <p class="font-medium">
                        Les graphiques analytiques (Chart.js)<br>
                        seront disponibles sur la page Statistiques.
                    </p>
                </div>

            </div>

        </main>
    </div>
@endsection
