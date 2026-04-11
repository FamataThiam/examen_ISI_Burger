<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - ISIBurger</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍔</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

@php

    if (session('active_tab')) {
        $activeTab = session('active_tab');
    } elseif ($errors->has('login_error')) {
        $activeTab = 'login';
    } else {
        $activeTab = 'login';
    }
@endphp

<div class="wrapper">


    <div class="panel-left">
        <img src="{{ asset('images/logo.png') }}" alt="IsiBurger" class="burger-float relative z-10" style="width: 320px; height: 320px; object-fit: contain;">
        <div class="brand-tag">Authentique &amp; Savoureux</div>
        <div class="divider-h"></div>
        <p class="panel-tagline">
            Bienvenue dans votre espace.<br>
            Gérez vos <strong>commandes</strong> et suivez<br>vos <strong>favoris</strong> en un clic.
        </p>
    </div>


    <div class="panel-right">
        <h1 class="form-title">Bon retour</h1>
        <p class="form-subtitle">Accédez à votre espace ISIBurger</p>


        <div class="tabs">
            <button class="tab-btn {{ $activeTab === 'login' ? 'active' : '' }}" onclick="switchTab(this, 'login')">Se connecter</button>
            <button class="tab-btn {{ $activeTab === 'register' ? 'active' : '' }}" onclick="switchTab(this, 'register')">S'inscrire</button>
        </div>

        @if(session('success'))
            <div class="success-box">{{ session('success') }}</div>
        @endif


        <input type="text"    name="fake_user_login"    style="display:none" tabindex="-1" aria-hidden="true">
        <input type="password" name="fake_pass_login"   style="display:none" tabindex="-1" aria-hidden="true">

        <form id="form-login"
              method="POST"
              action="{{ route('login.submit') }}"
              autocomplete="off"
              style="{{ $activeTab === 'login' ? '' : 'display:none;' }}">
            @csrf

            @if($errors->has('login_error'))
                <div class="error-box">{{ $errors->first('login_error') }}</div>
            @endif

            <div class="field">
                <label>Adresse e-mail</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>

                    <input
                        type="email"
                        name="email"
                        value=""
                        placeholder="vous@exemple.com"
                        autocomplete="new-password"
                        required
                    >
                </div>
            </div>

            <div class="field">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" value="" placeholder="••••••••" autocomplete="new-password" required>
                </div>
            </div>

            <div class="forgot"><a href="#">Mot de passe oublié ?</a></div>
            <button type="submit" class="btn-submit">Se connecter →</button>
        </form>


        <form id="form-register"
              method="POST"
              action="{{ route('register') }}"
              autocomplete="off"
              style="{{ $activeTab === 'register' ? '' : 'display:none;' }}">
            @csrf

            @if($activeTab === 'register' && $errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <div class="field">
                <label>Nom</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>

                    <input type="text" name="nom"
                           value="{{ $activeTab === 'register' ? old('nom') : '' }}"
                           placeholder="Diallo" required>
                </div>
            </div>

            <div class="field">
                <label>Prénom</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <input type="text" name="prenom"
                           value="{{ $activeTab === 'register' ? old('prenom') : '' }}"
                           placeholder="Moussa" required>
                </div>
            </div>

            <div class="field">
                <label>Adresse</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 21s-6-4.35-6-10a6 6 0 1 1 12 0c0 5.65-6 10-6 10z"/>
                        <circle cx="12" cy="11" r="2"/>
                    </svg>
                    <input type="text" name="adresse"
                           value="{{ $activeTab === 'register' ? old('adresse') : '' }}"
                           placeholder="Dakar, Rufisque..."
                           required>
                </div>
            </div>

            <div class="field">
                <label>Adresse e-mail</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input type="email" name="email"
                           value="{{ $activeTab === 'register' ? old('email') : '' }}"
                           placeholder="vous@exemple.com" required>
                </div>
            </div>

            <div class="field">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" autocomplete="new-password" required>
                </div>
            </div>


            <div class="field">
                <label>Confirmer le mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="••••••••" autocomplete="new-password" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Créer mon compte →</button>
        </form>

    </div>
</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
