@extends('template')

@section('title', 'ISIBurger — Dashboard Gestionnaire')

@section('content')
    <div class="flex min-h-screen bg-slate-50">

        <aside class="w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6">
                <h2 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Menu Gestion</h2>
            </div>
            <nav class="space-y-1 px-3">
                <a href="#" class="flex items-center space-x-3 bg-orange-50 text-orange-600 px-4 py-3 rounded-xl font-bold">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Vue d'ensemble</span>
                </a>

                <a href="{{ route('gestion.produits') }}"  class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-burger"></i>
                    <span>Produits / Stocks</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Commandes</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>Paiements Espèces</span>
                </a>
                <hr class="my-4 border-slate-100">
                <a href="#" class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl transition-all">
                    <i class="fa-solid fa-file-pdf"></i>
                    <span>Rapports Journaliers</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800">Tableau de bord</h1>
                    <p class="text-slate-500">Bienvenue, {{ auth('client')->user()->prenom }}. Voici l'état de ISI BURGER aujourd'hui.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl font-semibold hover:bg-slate-50 transition-all">
                        <i class="fa-solid fa-download mr-2"></i>Exporter PDF
                    </button>
                    <button class="bg-orange-500 text-white px-4 py-2 rounded-xl font-semibold shadow-lg shadow-orange-200 hover:bg-orange-600 transition-all">
                        <i class="fa-solid fa-plus mr-2"></i>Nouveau Produit
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-coins text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Recettes du jour</h3>
                    <p class="text-2xl font-bold text-slate-800">145.000 <span class="text-sm font-normal">FCFA</span></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Commandes en cours</h3>
                    <p class="text-2xl font-bold text-slate-800">12</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-check-double text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Validées (Aujourd'hui)</h3>
                    <p class="text-2xl font-bold text-slate-800">48</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fa-solid fa-box-archive text-xl"></i>
                    </div>
                    <h3 class="text-slate-500 text-sm font-medium">Produits épuisés</h3>
                    <p class="text-2xl font-bold text-slate-800">3</p>
                </div>

            </div>

            <h2 class="text-xl font-bold text-slate-800 mb-6">Actions prioritaires</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h3 class="font-bold text-slate-700">Dernières Commandes</h3>
                        <a href="#" class="text-orange-500 text-sm font-semibold hover:underline">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-slate-400 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3">Statut</th>
                                <th class="px-6 py-3 text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm">
                            <tr>
                                <td class="px-6 py-4 font-medium">Jean Dupont</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-bold">En préparation</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-orange-500"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium">Marie Fall</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">Prête</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-orange-500"><i class="fa-solid fa-eye"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="font-bold text-slate-700 mb-6">Volume Mensuel</h3>
                    <div class="h-48 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                        <i class="fa-solid fa-chart-line text-4xl mb-2"></i>
                        <p class="text-sm">Espace réservé pour Chart.js</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
@endsection
