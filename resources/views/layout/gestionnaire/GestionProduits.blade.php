@extends('template')

@section('title', 'ISI Burger — Gestion Produits & Catégories')

@section('content')
    <div class="flex min-h-screen bg-slate-50">

        <aside class="w-64 bg-white shadow-sm hidden md:block border-r border-slate-100">
            <div class="p-6">
                <a href="{{ route('dashboardGestionnaire') }}" class="text-orange-500 font-bold flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Retour au Menu
                </a>
            </div>
            <nav class="space-y-1 px-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Statistiques</span>
                </a>

                <a href="{{ route('gestion.produits') }}" class="flex items-center space-x-3 bg-orange-50 text-orange-600 px-4 py-3 rounded-xl font-bold">
                    <i class="fa-solid fa-burger"></i>
                    <span>Produits / Stocks</span>
                </a>

                <a href="#" class="flex items-center space-x-3 text-slate-600 hover:bg-slate-100 px-4 py-3 rounded-xl">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Commandes</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-8">

            <div class="flex flex-col md:flex-row justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-800">Catalogue de Gestion</h1>
                    <p class="text-slate-500">Gérez vos produits et vos catégories de menu.</p>
                </div>

                <div class="flex gap-3">
                    <button onclick="toggleModal('modal-category')"
                            class="bg-white border-2 border-orange-500 text-orange-500 px-5 py-3 rounded-2xl font-bold hover:bg-orange-50 flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-folder-plus"></i> Catégorie
                    </button>

                    <button onclick="toggleModal('modal-burger')"
                            class="bg-orange-500 text-white px-6 py-3 rounded-2xl font-bold shadow-lg hover:bg-orange-600 flex items-center gap-2 transition-all hover:-translate-y-1">
                        <i class="fa-solid fa-plus"></i> Nouveau Burger
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-xl flex items-center justify-between">
                    <span class="font-bold">{{ session('success') }}</span>
                    <i class="fa-solid fa-check-circle"></i>
                </div>
            @endif

            <div class="bg-white p-4 rounded-2xl shadow-sm border mb-8">
                <h2 class="text-sm font-bold text-slate-400 uppercase mb-4">Filtres par catégories</h2>
                <div class="flex flex-wrap gap-2">
                    <button class="px-5 py-2 rounded-xl bg-orange-500 text-white font-bold shadow-md shadow-orange-100">Tous</button>
                    @foreach($categories as $categorie)
                        <button class="px-5 py-2 rounded-xl bg-slate-100 text-slate-600 hover:bg-orange-100 hover:text-orange-600 transition-all font-semibold">
                            {{ $categorie->libelle }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($produits as $produit)
                    <div class="bg-white rounded-3xl p-5 shadow-sm border group hover:shadow-xl transition-all relative overflow-hidden">

                        <div class="absolute top-4 right-4 bg-slate-100 px-3 py-1 rounded-full text-[10px] font-bold text-slate-500">
                            Stock: {{ $produit->stock }}
                        </div>

                        <div class="flex gap-4">
                            <div class="w-24 h-24 bg-slate-100 rounded-2xl overflow-hidden shadow-inner">
                                <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->libelle }}" class="w-full h-full object-cover">
                            </div>

                            <div class="flex-1">
                                <span class="text-[10px] uppercase tracking-wider text-orange-500 font-extrabold">{{ $produit->categorie->libelle ?? 'Non classé' }}</span>
                                <h3 class="font-bold text-slate-800 text-lg leading-tight">{{ $produit->libelle }}</h3>
                                <p class="text-sm text-slate-400 mt-1">{{ Str::limit($produit->description, 35) }}</p>
                                <p class="font-black text-orange-600 mt-2 text-md">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-slate-50 gap-2">

                            <button onclick="openEditModal({{ json_encode($produit) }})"
                                    class="flex-1 flex items-center justify-center gap-2 py-2 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all text-sm font-bold">
                                <i class="fa-solid fa-pen-to-square"></i> Modifier
                            </button>

                            <form action="{{ route('produits.archiver', $produit->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" onclick="return confirm('Archiver ce burger ?')"
                                        class="p-2 w-10 h-10 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white transition-all"
                                        title="Archiver">
                                    <i class="fa-solid fa-box-archive"></i>
                                </button>
                            </form>

                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer définitivement ce produit ?')"
                                        class="p-2 w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all"
                                        title="Supprimer">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-slate-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-burger text-slate-300 text-3xl"></i>
                        </div>
                        <p class="text-slate-400 font-medium">Aucun produit actif trouvé dans le catalogue.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    @include('composants.add_categorie')
    @include('composants.ajoutproduit')

@endsection
