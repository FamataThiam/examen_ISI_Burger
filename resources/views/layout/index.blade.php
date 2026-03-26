@extends('template')
@section('title', 'IsiBurger — Commandez en ligne')
@section('content')

    {{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
    <section class="py-20 px-6" style="background: linear-gradient(145deg, #fff7ed 0%, #fef9f0 40%, #fff1e6 100%); position: relative; overflow: hidden;">

        {{-- Blobs décoratifs --}}
        <div style="position:absolute; top:-120px; right:-120px; width:500px; height:500px; border-radius:50%; background:radial-gradient(circle, rgba(249,115,22,0.13) 0%, transparent 70%); animation: blobDrift 8s ease-in-out infinite alternate;"></div>
        <div style="position:absolute; bottom:-80px; left:-80px; width:350px; height:350px; border-radius:50%; background:radial-gradient(circle, rgba(251,191,36,0.18) 0%, transparent 70%); animation: blobDrift 10s ease-in-out infinite alternate-reverse;"></div>

        <style>
            @keyframes blobDrift {
                from { transform: scale(1) translate(0,0); }
                to   { transform: scale(1.15) translate(20px, 20px); }
            }
            @keyframes floatBurger {
                0%,100% { transform: translateY(0) rotate(-3deg); }
                50%      { transform: translateY(-20px) rotate(3deg); }
            }
            .burger-float {
                animation: floatBurger 3.5s ease-in-out infinite;
                filter: drop-shadow(0 30px 40px rgba(249,115,22,0.28));
            }
        </style>

        <div class="max-w-6xl mx-auto relative z-10 flex flex-col lg:flex-row items-center gap-16">

            {{-- Texte --}}
            <div class="flex-1 max-w-xl">
                <div class="inline-flex items-center gap-2 bg-orange-100 text-orange-600 text-xs font-extrabold px-4 py-2 rounded-full uppercase tracking-wider mb-6 sr">
                    <span class="w-2 h-2 bg-orange-500 rounded-full animate-ping inline-block"></span>
                    Disponible · Livraison 7j/7
                </div>
                <h1 class="brand-font text-5xl lg:text-6xl text-slate-800 leading-tight mb-6 sr sr-delay-1">
                    Le Burger qui<br/>
                    <span class="text-orange-500">enflamme</span><br/>
                    tout Dakar <i class="fa-solid fa-fire text-orange-500"></i>
                </h1>
                <p class="text-slate-500 text-lg leading-relaxed mb-8 sr sr-delay-2">
                    Burgers 100% artisanaux, viande halal certifiée, livrés chauds en moins de 30 minutes. Commandez en quelques clics.
                </p>
                <div class="flex flex-wrap gap-4 sr sr-delay-3">
                    <button class="btn-orange rounded-2xl px-8 py-4 text-base">
                        Commander maintenant <i class="fa-solid fa-arrow-right ml-1"></i>
                    </button>
                    <button class="btn-ghost rounded-2xl px-7 py-4 text-base">
                        Voir le menu <i class="fa-solid fa-stroopwafel ml-1"></i>
                    </button>
                </div>

                {{-- Social proof --}}
                <div class="flex items-center gap-6 mt-10 pt-8 border-t border-orange-100 sr sr-delay-3">
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-slate-800">4.9 <i class="fa-solid fa-star text-yellow-400 text-xl"></i></div>
                        <div class="text-xs text-slate-400 font-semibold mt-0.5">Note clients</div>
                    </div>
                    <div class="w-px h-10 bg-slate-200"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-slate-800">+15K</div>
                        <div class="text-xs text-slate-400 font-semibold mt-0.5">Commandes</div>
                    </div>
                    <div class="w-px h-10 bg-slate-200"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-slate-800">&lt;30 min</div>
                        <div class="text-xs text-slate-400 font-semibold mt-0.5">Livraison</div>
                    </div>
                </div>
            </div>

            {{-- Visuel --}}
            <div class="flex-1 flex justify-center items-center relative">
                <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; pointer-events:none;">
                    <div style="width:18rem; height:18rem; border-radius:50%; background:radial-gradient(circle, rgba(249,115,22,0.18) 0%, transparent 70%); filter:blur(30px);"></div>
                </div>
                <img src="{{ asset('images/burger1.png') }}" alt="IsiBurger" class="burger-float relative z-10" style="width: 320px; height: 320px; object-fit: contain;">
                <div class="badge-pulse absolute top-6 right-4 bg-white rounded-2xl shadow-xl px-4 py-2.5 flex items-center gap-2 text-sm font-extrabold text-slate-700 border border-orange-100">
                    <i class="fa-solid fa-fire text-orange-500"></i> <span>Bestseller</span>
                </div>
                <div class="absolute bottom-10 left-0 bg-white rounded-2xl shadow-xl px-4 py-2.5 flex items-center gap-2 text-sm font-extrabold text-slate-700 border border-green-100">
                    <i class="fa-solid fa-check-circle text-green-500"></i> <span>Halal certifié</span>
                </div>
                <div class="absolute bottom-0 right-6 bg-orange-500 text-white rounded-2xl shadow-xl px-4 py-2.5 text-sm font-extrabold">
                    à partir de 3 500 FCFA
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ STATS ═══════════════════════════════ --}}
    <section class="py-10 px-6 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4 sr">
            <div class="stat-card p-6 text-center">
                <i class="fa-solid fa-bolt text-4xl text-orange-500 mb-3 block"></i>
                <div class="text-xl font-extrabold text-slate-800">30 min</div>
                <div class="text-xs text-slate-400 font-semibold mt-1">Livraison express</div>
            </div>
            <div class="stat-card p-6 text-center">
                <i class="fa-solid fa-hat-chef text-4xl text-orange-500 mb-3 block"></i>
                <div class="text-xl font-extrabold text-slate-800">Artisanal</div>
                <div class="text-xs text-slate-400 font-semibold mt-1">100% fait maison</div>
            </div>
            <div class="stat-card p-6 text-center">
                <i class="fa-solid fa-drumstick-bite text-4xl text-orange-500 mb-3 block"></i>
                <div class="text-xl font-extrabold text-slate-800">Halal</div>
                <div class="text-xs text-slate-400 font-semibold mt-1">Viande certifiée</div>
            </div>
            <div class="stat-card p-6 text-center">
                <i class="fa-solid fa-gift text-4xl text-orange-500 mb-3 block"></i>
                <div class="text-xl font-extrabold text-slate-800">Fidélité</div>
                <div class="text-xs text-slate-400 font-semibold mt-1">Points & cadeaux</div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ MENU ═══════════════════════════════ --}}
    <section id="menu" class="py-24 px-6" style="background:#f8fafc;">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14 sr">
                <span class="text-xs font-extrabold uppercase tracking-widest text-orange-500 block mb-3">— Notre sélection —</span>
                <h2 class="brand-font text-4xl text-slate-800">Les Incontournables <i class="fa-solid fa-fire text-orange-500"></i></h2>
                <p class="text-slate-400 mt-3 font-medium">Ce que tout Dakar commande en ce moment</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="menu-card sr sr-delay-1">
                    <div class="p-8 flex flex-col items-center text-center" style="background: linear-gradient(135deg,#fff7ed,#fef3c7);">
                        <i class="fa-solid fa-burger" style="font-size:80px; color:#f97316; transition: transform 0.4s cubic-bezier(.34,1.56,.64,1);"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Classic Burger</h3>
                            <span class="badge-hot"><i class="fa-solid fa-star text-yellow-300 mr-1"></i>Best</span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Bœuf, cheddar fondu, salade fraîche, tomate, sauce secrète maison</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">3 500 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="menu-card sr sr-delay-2">
                    <div class="p-8 flex flex-col items-center text-center relative" style="background: linear-gradient(135deg,#fef2f2,#fff7ed);">
                        <i class="fa-solid fa-pepper-hot" style="font-size:80px; color:#ef4444;"></i>
                        <span class="badge-hot absolute top-4 right-4"><i class="fa-solid fa-fire mr-1"></i>Spicy</span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Flambé XXL</h3>
                            <span class="badge-hot">Nouveau</span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Double steak, jalapeños, sauce piment maison, bacon, cheddar triple</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">4 800 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="menu-card sr sr-delay-3">
                    <div class="p-8 flex flex-col items-center text-center" style="background: linear-gradient(135deg,#fffbeb,#ecfdf5);">
                        <i class="fa-solid fa-stroopwafel" style="font-size:80px; color:#f97316;"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Maxi Combo</h3>
                            <span class="badge-pulse inline-block bg-yellow-400 text-slate-800 text-xs font-extrabold px-2 py-1 rounded-full">
                            <i class="fa-solid fa-coins mr-1"></i>Deal
                        </span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">1 burger au choix + frites maison + 1 boisson</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">5 500 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="menu-card sr sr-delay-1">
                    <div class="p-8 flex flex-col items-center text-center" style="background: linear-gradient(135deg,#f0fdf4,#fffbeb);">
                        <i class="fa-solid fa-seedling" style="font-size:80px; color:#22c55e;"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Veggie Burger</h3>
                            <span class="bg-green-100 text-green-600 text-xs font-extrabold px-2 py-1 rounded-full">
                            <i class="fa-solid fa-leaf mr-1"></i>Vegan
                        </span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Galette de légumes grillés, avocat, sauce yogurt, pain complet</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">3 200 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="menu-card sr sr-delay-2">
                    <div class="p-8 flex flex-col items-center text-center" style="background: linear-gradient(135deg,#fff0f6,#fff7ed);">
                        <i class="fa-solid fa-drumstick-bite" style="font-size:80px; color:#f97316;"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Crispy Chicken</h3>
                            <span class="badge-hot">Chaud</span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">Poulet pané croustillant, coleslaw maison, pickles, sauce ranch</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">4 000 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="menu-card sr sr-delay-3">
                    <div class="p-8 flex flex-col items-center text-center" style="background: linear-gradient(135deg,#fef3c7,#fce7f3);">
                        <i class="fa-solid fa-cake-candles" style="font-size:80px; color:#ec4899;"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-extrabold text-slate-800">Dessert Box</h3>
                            <span class="bg-pink-100 text-pink-500 text-xs font-extrabold px-2 py-1 rounded-full">
                            <i class="fa-solid fa-cookie mr-1"></i>Sweet
                        </span>
                        </div>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">2 cookies choco, 1 brownie fondant, sauce caramel maison</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-extrabold text-orange-500">2 500 FCFA</span>
                            <button class="btn-orange rounded-xl px-4 py-2 text-sm">
                                <i class="fa-solid fa-plus mr-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-center mt-12 sr">
                <button class="btn-ghost rounded-2xl px-10 py-4 text-base">
                    Voir tout le menu <i class="fa-solid fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ HOW IT WORKS ═══════════════════════════════ --}}
    <section class="py-24 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-14 sr">
                <h2 class="brand-font text-4xl text-slate-800">Comment ça marche ? <i class="fa-solid fa-bolt text-yellow-400"></i></h2>
                <p class="text-slate-400 mt-3 font-medium">Commander n'a jamais été aussi simple</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center sr sr-delay-1">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-5 shadow-lg text-white" style="background: linear-gradient(135deg,#f97316,#ea580c);">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="font-extrabold text-slate-800 text-lg mb-2">1. Choisissez</div>
                    <p class="text-slate-400 text-sm leading-relaxed">Parcourez notre menu et ajoutez vos burgers préférés à votre panier.</p>
                </div>
                <div class="text-center sr sr-delay-2">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-5 shadow-lg text-white" style="background: linear-gradient(135deg,#fbbf24,#f97316);">
                        <i class="fa-solid fa-credit-card"></i>
                    </div>
                    <div class="font-extrabold text-slate-800 text-lg mb-2">2. Payez</div>
                    <p class="text-slate-400 text-sm leading-relaxed">Paiement sécurisé en ligne ou à la livraison. Wave, Orange Money acceptés.</p>
                </div>
                <div class="text-center sr sr-delay-3">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-5 shadow-lg text-white" style="background: linear-gradient(135deg,#ef4444,#f97316);">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <div class="font-extrabold text-slate-800 text-lg mb-2">3. Régalez-vous</div>
                    <p class="text-slate-400 text-sm leading-relaxed">Votre commande arrive chaude en moins de 30 minutes à votre porte.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ CTA BAND ═══════════════════════════════ --}}
    <section class="py-20 px-6 sr" style="background: linear-gradient(135deg, #f97316 0%, #ef4444 100%);">
        <div class="max-w-3xl mx-auto text-center">
            <i class="fa-solid fa-party-horn text-6xl text-white mb-5 block"></i>
            <h2 class="brand-font text-4xl text-white mb-4">-20% sur votre 1ère commande</h2>
            <p class="text-orange-100 text-lg mb-8">Inscrivez-vous et profitez de votre réduction de bienvenue immédiatement.</p>
            <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" placeholder="exemple@email.com"
                       class="flex-1 rounded-2xl px-5 py-4 text-slate-700 font-semibold outline-none border-2 border-transparent focus:border-white transition-all placeholder-slate-400"/>
                <button class="bg-white text-orange-500 font-extrabold px-6 py-4 rounded-2xl hover:bg-orange-50 transition-colors whitespace-nowrap">
                    J'en profite <i class="fa-solid fa-fire ml-1"></i>
                </button>
            </div>
            <p class="text-orange-200 text-xs mt-4 font-medium">Aucun spam. Désinscription à tout moment.</p>
        </div>
    </section>

@endsection
