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

        <!-- Logo -->
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}"
                 alt="ISIBurger Logo"
                 class="h-10 w-auto">
        </a>

        {{-- MENU DESKTOP --}}
        <div class="isi-nav__links">

            @auth
                @if(auth()->user()->role === 'gestionnaire')
                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>

                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-burger"></i> Produits
                    </a>

                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-cart-shopping"></i> Commandes
                    </a>

                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-credit-card"></i> Paiements
                    </a>

                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-chart-line"></i> Statistiques
                    </a>

                @elseif(auth()->user()->role === 'client')
                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-burger"></i> Catalogue
                    </a>

                    <a href="#" class="isi-nav__link">
                        <i class="fa-solid fa-box"></i> Mes Commandes
                    </a>

                    <a href="#" class="isi-nav__cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="isi-nav__badge">0</span>
                    </a>
                @endif

                {{-- PROFIL --}}
                <div class="isi-nav__user">
                    <i class="fa-solid fa-user"></i>
                    <span>{{ auth()->user()->name }}</span>

                    @if(auth()->user()->role === 'gestionnaire')
                        <span class="isi-nav__role-badge isi-nav__role-badge--gestionnaire">Gestionnaire</span>
                    @else
                        <span class="isi-nav__role-badge isi-nav__role-badge--client">Client</span>
                    @endif
                </div>

                {{-- DÉCONNEXION --}}
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="isi-nav__logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                    </button>
                </form>

            @else
                <a href="login" class="isi-nav__link">
                    <i class="fa-solid fa-right-to-bracket"></i> Connexion
                </a>
            @endauth

        </div>

        {{-- BOUTON MOBILE --}}
        <button id="menu-btn" class="isi-nav__hamburger">
            <span></span><span></span><span></span>
        </button>

    </div>

    {{-- MENU MOBILE --}}
    <div id="mobile-menu" class="isi-nav__mobile hidden">
        @auth
            @if(auth()->user()->role === 'gestionnaire')
                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-burger"></i> Produits
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-cart-shopping"></i> Commandes
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-credit-card"></i> Paiements
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-chart-line"></i> Statistiques
                </a>
            @else
                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-burger"></i> Catalogue
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-box"></i> Mes Commandes
                </a>

                <a href="#" class="isi-nav__mobile-link">
                    <i class="fa-solid fa-cart-shopping"></i> Panier
                </a>
            @endif

            <div class="isi-nav__mobile-user">
                <i class="fa-solid fa-user"></i> {{ auth()->user()->name }}
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="isi-nav__mobile-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
                </button>
            </form>
        @else
            <a href="/login" class="isi-nav__mobile-link">
                <i class="fa-solid fa-right-to-bracket"></i> Connexion
            </a>
        @endauth
    </div>
</nav>


</body>
</html>
