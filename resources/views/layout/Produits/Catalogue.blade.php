@extends('template')

@section('title', 'ISIBurger — Catalogue')

@section('content')

    <style>
        .card-hover { transition: all .3s ease; }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        @keyframes badge-pop {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.5); }
            70%  { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        .badge-pop { animation: badge-pop 0.35s ease; }

        .btn-added {
            background-color: #16a34a !important;
            box-shadow: 0 8px 20px rgba(22,163,74,.3) !important;
            transition: background-color 0.3s ease;
        }
    </style>

    {{-- HERO --}}
    <section class="py-16 px-6 bg-orange-50 text-center">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-3">Notre Catalogue </h1>
        <p class="text-slate-500">Découvrez tous nos produits frais et faits maison.</p>
    </section>

    {{-- FILTRES --}}
    <section class="px-6 py-6 bg-white sticky top-0 z-10 shadow-sm">
        <div class="max-w-6xl mx-auto">
            <input type="text" id="search"
                   placeholder="Rechercher un burger, une boisson..."
                   class="w-full mb-6 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-orange-300 outline-none transition-all">

            <div class="flex flex-wrap gap-2 py-4">
                <button onclick="CatalogueManager.filter('all')"
                        class="px-5 py-2 rounded-xl border text-sm font-bold transition-all
            {{ !request('categorie') || request('categorie') == 'all'
                ? 'bg-orange-500 border-orange-500 text-white shadow-md'
                : 'bg-white border-slate-200 text-slate-600 hover:border-orange-500 hover:text-orange-500' }}">
                    Tous
                </button>

                @foreach($categories as $categorie)
                    <button onclick="CatalogueManager.filter('{{ $categorie->libelle }}')"
                            class="px-5 py-2 rounded-xl border text-sm font-bold transition-all
                {{ request('categorie') == $categorie->libelle
                    ? 'bg-orange-500 border-orange-500 text-white shadow-md'
                    : 'bg-white border-slate-200 text-slate-600 hover:border-orange-500 hover:text-orange-500' }}">
                        {{ $categorie->libelle }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUITS --}}
    <section class="py-12 px-6 bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="grid">

            @forelse($produits as $produit)
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 product"
                     data-cat="{{ strtolower($produit->categorie->libelle ?? '') }}"
                     data-name="{{ strtolower($produit->libelle) }}">

                    <div class="h-48 bg-slate-200 overflow-hidden">
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->libelle }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-slate-400">
                                <i class="fa-solid fa-image text-4xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-xl text-slate-800">{{ $produit->libelle }}</h3>
                            <span class="text-[10px] px-2 py-1 bg-orange-100 text-orange-600 rounded-lg font-black uppercase">
                                {{ $produit->categorie->libelle ?? 'Menu' }}
                            </span>
                        </div>

                        <p class="text-sm text-slate-500 mb-6 h-10 overflow-hidden">
                            {{ Str::limit($produit->description, 60) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="font-black text-2xl text-slate-900">
                                {{ number_format($produit->prix, 0, ',', ' ') }} <small class="text-xs">FCFA</small>
                            </span>

                            @auth('client')
                                {{-- data-* contient toutes les infos du produit --}}
                                <button
                                    onclick="Cart.add(this)"
                                    data-id="{{ $produit->id }}"
                                    data-libelle="{{ $produit->libelle }}"
                                    data-prix="{{ $produit->prix }}"
                                    data-categorie="{{ $produit->categorie->libelle ?? 'Menu' }}"
                                    data-image="{{ $produit->image ?? '' }}"
                                    class="bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-xl shadow-lg shadow-orange-200 transition-all active:scale-95">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="text-xs font-bold text-orange-500 hover:underline">
                                    Connectez-vous pour commander
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-slate-400">Aucun produit disponible pour le moment.</p>
                </div>
            @endforelse

        </div>
    </section>

    <script>
        /* =============================================
           GESTIONNAIRE DU PANIER
           Stocke les produits dans localStorage['cart_items']
           Format : [{ id, libelle, prix, categorie, image, quantite }]
           ============================================= */
        const Cart = {

            add(btn) {
                const product = {
                    id:        parseInt(btn.dataset.id),
                    libelle:   btn.dataset.libelle,
                    prix:      parseFloat(btn.dataset.prix),
                    categorie: btn.dataset.categorie,
                    image:     btn.dataset.image,
                };

                let items = JSON.parse(localStorage.getItem('cart_items') || '[]');

                const existing = items.find(i => i.id === product.id);
                if (existing) {
                    existing.quantite += 1;
                } else {
                    items.push({ ...product, quantite: 1 });
                }

                localStorage.setItem('cart_items', JSON.stringify(items));

                const totalQty = items.reduce((sum, i) => sum + i.quantite, 0);
                localStorage.setItem('cart_count', totalQty);
                Cart.updateBadge(totalQty);

                btn.classList.add('btn-added');
                btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                setTimeout(() => {
                    btn.classList.remove('btn-added');
                    btn.innerHTML = '<i class="fa-solid fa-cart-plus"></i>';
                }, 1200);
            },

            updateBadge(count) {
                document.querySelectorAll('.isi-nav__badge').forEach(badge => {
                    badge.textContent = count;
                    badge.style.display = count > 0 ? 'flex' : 'none';
                    badge.classList.remove('badge-pop');
                    void badge.offsetWidth;
                    badge.classList.add('badge-pop');
                });
            },

            init() {
                const items = JSON.parse(localStorage.getItem('cart_items') || '[]');
                const total = items.reduce((sum, i) => sum + i.quantite, 0);
                Cart.updateBadge(total);
            }
        };

        document.addEventListener('DOMContentLoaded', Cart.init);

        const CatalogueManager = {
            filter(catName) {
                const url = new URL(window.location.href);
                catName === 'all'
                    ? url.searchParams.delete('categorie')
                    : url.searchParams.set('categorie', catName);
                window.location.href = url.toString();
            },
            search() {
                const searchTerm = document.getElementById("search").value;
                const url = new URL(window.location.href);
                searchTerm.length > 0
                    ? url.searchParams.set('search', searchTerm)
                    : url.searchParams.delete('search');
                window.location.href = url.toString();
            }
        };

        document.getElementById("search")?.addEventListener("keypress", e => {
            if (e.key === "Enter") CatalogueManager.search();
        });
    </script>
@endsection
