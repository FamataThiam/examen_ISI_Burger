<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<nav class="isi-nav">
    <div class="isi-nav__inner">

        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}"
                 alt="ISIBurger Logo"
                 class="h-10 w-auto">
        </a>

        {{-- MENU DESKTOP --}}
        <div class="isi-nav__links">

            @if(auth('client')->check())
                @php $user = auth('client')->user(); @endphp

                @if($user->role === 'gestionnaire')
                    <a href="{{ route('dashboardGestionnaire') }}" class="isi-nav__mobile-link">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                    <a href="{{ route('gestion.produits') }}" class="isi-nav__link">
                        <i class="fa-solid fa-burger"></i> Produits
                    </a>
                    <a href="{{ route('commandes.index') }}" class="isi-nav__link">
                        <i class="fa-solid fa-cart-shopping"></i> Commandes
                    </a>
                    <a href="{{ route('gestion.recettes') }}" class="isi-nav__link">
                        <i class="fa-solid fa-credit-card"></i> Paiements
                    </a>
                    <a href="{{ route('gestion.statistiques') }}" class="isi-nav__link">
                        <i class="fa-solid fa-chart-line"></i> Statistiques
                    </a>

                @elseif($user->role === 'client')
                    <a href="{{ route('catalogue') }}" class="isi-nav__link">
                        <i class="fa-solid fa-burger"></i> Catalogue
                    </a>
                    <a href="{{ route('panier') }}" class="isi-nav__link">
                        <i class="fa-solid fa-box"></i> Mes Commandes
                    </a>

                    {{-- ICÔNE PANIER avec badge dynamique --}}
                    <a href="{{ route('panier') }}" class="isi-nav__cart" style="position: relative; display: inline-flex; align-items: center;">
                        <i class="fa-solid fa-cart-shopping"></i>
                        {{-- Le badge : caché par défaut, mis à jour par Cart.updateBadge() --}}
                        <span class="isi-nav__badge"
                              style="display: none;
                                     position: absolute;
                                     top: -8px;
                                     right: -10px;
                                     min-width: 18px;
                                     height: 18px;
                                     padding: 0 4px;
                                     border-radius: 999px;
                                     background: #f97316;
                                     color: white;
                                     font-size: 11px;
                                     font-weight: 800;
                                     align-items: center;
                                     justify-content: center;">
                            0
                        </span>
                    </a>
                @endif

                {{-- PROFIL --}}
                <div class="isi-nav__user">
                    <i class="fa-solid fa-user"></i>
                    <span>{{ $user->prenom }}</span>

                    @if($user->role === 'gestionnaire')
                        <span class="isi-nav__role-badge isi-nav__role-badge--gestionnaire">Gestionnaire</span>
                    @else
                        <span class="isi-nav__role-badge isi-nav__role-badge--client">Client</span>
                    @endif
                </div>

                {{-- DÉCONNEXION --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="isi-nav__logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                    </button>
                </form>

            @else
                <a href="{{ route('login') }}" class="isi-nav__link">
                    <i class="fa-solid fa-right-to-bracket"></i> Connexion
                </a>
            @endif

        </div>

        {{-- BOUTON MOBILE --}}
        <button id="menu-btn" class="isi-nav__hamburger">
            <span></span><span></span><span></span>
        </button>

    </div>

    {{-- MENU MOBILE --}}
    <div id="mobile-menu" class="isi-nav__mobile hidden">
        @if(auth('client')->check())
            @php $user = auth('client')->user(); @endphp

            @if($user->role === 'gestionnaire')
                <a href="{{ route('dashboardGestionnaire') }}"  class="isi-nav__mobile-link"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a href="{{ route('gestion.produits') }}"  class="isi-nav__mobile-link"><i class="fa-solid fa-burger"></i> Produits</a>
            @else
                <a href="{{ route('catalogue') }}" class="isi-nav__mobile-link"><i class="fa-solid fa-burger"></i> Catalogue</a>
                <a href="#" class="isi-nav__mobile-link"><i class="fa-solid fa-box"></i> Mes Commandes</a>
            @endif

            <div class="isi-nav__mobile-user">
                <i class="fa-solid fa-user"></i> {{ $user->prenom }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="isi-nav__mobile-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                </button>
            </form>
        @else
            <a href="{{ route('catalogue') }}" class="isi-nav__mobile-link">Catalogue</a>
            <a href="{{ route('login') }}" class="isi-nav__mobile-link">Connexion</a>
        @endif
    </div>
</nav>

</body>
</html>
