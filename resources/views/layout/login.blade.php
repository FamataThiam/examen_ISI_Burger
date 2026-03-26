<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - ISIBurger</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🍔</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* ---- Le CSS que tu avais déjà ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --orange: #F04E23; --orange-deep: #C93B14; --cream: #FDF6EC;
            --charcoal: #1A1208; --warm-gray: #8C7B6B; --card-bg: #FFFFFF; --border: #EDE5D8;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            background-image:
                radial-gradient(ellipse 80% 60% at 20% 10%, rgba(240,78,35,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 90%, rgba(240,78,35,0.06) 0%, transparent 60%);
            overflow: hidden;
        }
        /* Floating food elements */
        .float-el { position: fixed; font-size: 2rem; opacity: 0.12; animation: floatUp linear infinite; pointer-events: none; user-select: none; }
        @keyframes floatUp { 0% { transform: translateY(110vh) rotate(0deg); opacity: 0; } 10% { opacity: 0.12; } 90% { opacity: 0.12; } 100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; } }
        .wrapper { display: flex; width: min(900px, 95vw); min-height: 520px; border-radius: 24px; overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04),0 20px 60px rgba(26,18,8,0.14),0 0 0 1px var(--border);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0;
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        /* LEFT panel */
        .panel-left { flex: 1; background: var(--orange); background-image:
            radial-gradient(ellipse at 30% 70%, rgba(255,255,255,0.15) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 20%, var(--orange-deep) 0%, transparent 50%);
            display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px 40px; position: relative; overflow: hidden;
        }
        .panel-left::before { content: ''; position: absolute; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
        .panel-right { width: 420px; flex-shrink: 0; background: var(--card-bg); padding: 52px 44px; display: flex; flex-direction: column; justify-content: center; }
        .form-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.75rem; color: var(--charcoal); margin-bottom: 6px; }
        .form-subtitle { font-size: 0.88rem; color: var(--warm-gray); margin-bottom: 36px; font-weight: 300; }
        .tabs { display: flex; background: var(--cream); border-radius: 10px; padding: 4px; margin-bottom: 32px; gap: 2px; }
        .tab-btn { flex: 1; padding: 9px 12px; border: none; background: transparent; border-radius: 7px; font-family: 'DM Sans', sans-serif; font-size: 0.875rem; font-weight: 500; color: var(--warm-gray); cursor: pointer; transition: all 0.25s ease; }
        .tab-btn.active { background: var(--card-bg); color: var(--charcoal); box-shadow: 0 1px 4px rgba(0,0,0,0.1); }
        .field { margin-bottom: 18px; } label { display: block; font-size: 0.82rem; font-weight: 500; color: var(--charcoal); margin-bottom: 7px; letter-spacing: 0.3px; }
        .input-wrap { position: relative; } .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--warm-gray); pointer-events: none; }
        input[type="email"], input[type="password"], input[type="text"] { width: 100%; border: 1.5px solid var(--border); border-radius: 10px; padding: 11px 14px 11px 40px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; color: var(--charcoal); background: var(--cream); transition: all 0.2s; outline: none; }
        input::placeholder { color: #C0B5A8; } input:focus { border-color: var(--orange); background: white; box-shadow: 0 0 0 3px rgba(240,78,35,0.1); }
        .forgot { text-align: right; margin-top: -10px; margin-bottom: 18px; } .forgot a { font-size: 0.78rem; color: var(--orange); text-decoration: none; font-weight: 500; } .forgot a:hover { text-decoration: underline; }
        .btn-submit { width: 100%; padding: 13px; background: var(--orange); color: white; font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 600; letter-spacing: 0.3px; border: none; border-radius: 10px; cursor: pointer; transition: all 0.2s; position: relative; overflow: hidden; }
        .btn-submit::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(255,255,255,0.1), transparent); border-radius: inherit; }
        .btn-submit:hover { background: var(--orange-deep); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(240,78,35,0.35); } .btn-submit:active { transform: translateY(0); }
        .error-box { background: #FEF2F2; border: 1px solid #FCA5A5; border-radius: 8px; color: #DC2626; font-size: 0.85rem; padding: 10px 14px; margin-bottom: 20px; }
        .bottom-note { text-align: center; margin-top: 20px; font-size: 0.78rem; color: var(--warm-gray); } .bottom-note a { color: var(--orange); text-decoration: none; font-weight: 500; }
        @media (max-width: 660px) { .panel-left { display: none; } .panel-right { width: 100%; padding: 40px 28px; } }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- LEFT: Branding -->
    <div class="panel-left">
        <img src="{{ asset('images/logo.png') }}" alt="IsiBurger" class="burger-float relative z-10" style="width: 320px; height: 320px; object-fit: contain;">
        <div class="brand-tag">Authentique &amp; Savoureux</div>
        <div class="divider-h"></div>
        <p class="panel-tagline">
            Bienvenue dans votre espace.<br>
            Gérez vos <strong>commandes</strong> et suivez<br>vos <strong>favoris</strong> en un clic.
        </p>
    </div>

    <!-- RIGHT: Form -->
    <div class="panel-right">
        <h1 class="form-title">Bon retour</h1>
        <p class="form-subtitle">Accédez à votre espace ISIBurger</p>

        <!-- Tabs -->
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab(this, 'login')">Se connecter</button>
            <button class="tab-btn" onclick="switchTab(this, 'register')">S'inscrire</button>
        </div>

        <!-- LOGIN FORM -->
        <form id="form-login" method="POST" action="{{ route('login') }}">
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
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required>
                </div>
            </div>

            <div class="field">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="forgot"><a href="#">Mot de passe oublié ?</a></div>
            <button type="submit" class="btn-submit">Se connecter →</button>
        </form>

        <!-- REGISTER FORM -->
        <form id="form-register" method="POST" action="{{ route('register') }}" style="display:none;">
            @csrf

            @if($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
            @endif

            <div class="field">
                <label>Nom complet</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Moussa Diallo" required>
                </div>
            </div>

            <div class="field">
                <label>Adresse e-mail</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required>
                </div>
            </div>

            <div class="field">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Créer mon compte →</button>
        </form>

    </div>
</div>

<script>
    function switchTab(btn, tab) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('form-login').style.display   = tab === 'login'    ? '' : 'none';
        document.getElementById('form-register').style.display = tab === 'register' ? '' : 'none';
    }
</script>

</body>
</html>
