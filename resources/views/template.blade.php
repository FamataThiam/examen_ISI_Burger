<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ISIBurger')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&family=Fredoka+One&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --orange: #f97316;
            --orange-dark: #ea580c;
            --red: #ef4444;
            --yellow: #fbbf24;
            --bg: #f1f5f9;
            --card: #ffffff;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Nunito', sans-serif;
            background: white;
            color: #1e293b;
            overflow-x: hidden;
        }

        .brand-font { font-family: 'Fredoka One', cursive; }

        /* ── NAVBAR ── */
        .navbar {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky; top: 0; z-index: 100;
        }

        /* ── ORANGE BTN ── */
        .btn-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white; font-weight: 800; border: none; cursor: pointer;
            transition: transform 0.22s cubic-bezier(.34,1.56,.64,1), box-shadow 0.22s ease;
            box-shadow: 0 6px 24px rgba(249,115,22,0.38);
        }
        .btn-orange:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 12px 36px rgba(249,115,22,0.52);
        }
        .btn-orange:active { transform: scale(0.97); }

        .btn-ghost {
            background: white; color: #f97316;
            border: 2px solid #fed7aa; font-weight: 800; cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }
        .btn-ghost:hover { background: #fff7ed; transform: translateY(-2px); }

        /* ── MENU CARDS ── */
        .menu-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            overflow: hidden;
            transition: transform 0.35s cubic-bezier(.34,1.56,.64,1), box-shadow 0.3s ease;
        }
        .menu-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 28px 56px rgba(249,115,22,0.2);
        }
        .card-emoji {
            font-size: 80px; line-height: 1;
            display: block;
            transition: transform 0.4s cubic-bezier(.34,1.56,.64,1);
        }
        .menu-card:hover .card-emoji { transform: scale(1.15) rotate(-5deg); }

        /* ── STAT CARDS ── */
        .stat-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(249,115,22,0.14);
        }

        /* ── PROMO BAND ── */
        .promo-band {
            background: linear-gradient(90deg, #ef4444 0%, #f97316 40%, #fbbf24 70%, #f97316 100%);
            background-size: 300% 100%;
            animation: gradShift 4s linear infinite;
        }

        /* ── TICKER ── */
        .ticker-track {
            display: flex; width: max-content;
            animation: ticker 18s linear infinite;
        }
        @keyframes ticker {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        @keyframes gradShift {
            0%   { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }

        /* ── SCROLL REVEAL ── */
        .sr {
            opacity: 0; transform: translateY(36px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .sr.in { opacity: 1; transform: none; }
        .sr-delay-1 { transition-delay: 0.1s; }
        .sr-delay-2 { transition-delay: 0.2s; }
        .sr-delay-3 { transition-delay: 0.3s; }

        /* ── BADGE PULSE ── */
        .badge-pulse {
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%,100% { transform: scale(1); }
            50%      { transform: scale(1.12); }
        }

        /* ── FOOTER ── */
        footer {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #94a3b8;
            position: relative;
            overflow: hidden;
        }
        footer::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #ef4444, #f97316, #fbbf24, #f97316, #ef4444);
            background-size: 300% 100%;
            animation: gradShift 4s linear infinite;
        }
        footer::after {
            content: '';
            position: absolute; bottom: -200px; right: -150px;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(249,115,22,0.06) 0%, transparent 65%);
            pointer-events: none;
        }

        .footer-link {
            transition: color 0.2s ease, transform 0.2s ease;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .footer-link:hover { color: #f97316; transform: translateX(5px); }

        .social-icon {
            width: 42px; height: 42px; border-radius: 50%;
            border: 1.5px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            transition: background 0.25s, border-color 0.25s, transform 0.25s;
            cursor: pointer;
        }
        .social-icon:hover {
            background: rgba(249,115,22,0.22);
            border-color: #f97316;
            transform: translateY(-4px);
        }

        .badge-hot {
            background: #ef4444; color: white;
            font-size: 10px; font-weight: 800;
            padding: 3px 8px; border-radius: 999px;
            letter-spacing: 0.5px; text-transform: uppercase;
        }

        /* ── ISI NAV (CSS externe intégré ici) ── */
        .isi-nav {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky; top: 0; z-index: 100;
        }
        .isi-nav__inner {
            max-width: 72rem;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .isi-nav__links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .isi-nav__link {
            font-size: 0.875rem;
            font-weight: 700;
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s;
        }
        .isi-nav__link:hover { color: #f97316; }
        .isi-nav__cart {
            position: relative;
            font-size: 1.2rem;
            color: #64748b;
            transition: color 0.2s;
        }
        .isi-nav__cart:hover { color: #f97316; }
        .isi-nav__badge {
            position: absolute;
            top: -8px; right: -10px;
            background: #f97316;
            color: white;
            font-size: 10px;
            font-weight: 800;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .isi-nav__user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #1e293b;
        }
        .isi-nav__role-badge {
            font-size: 10px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .isi-nav__role-badge--gestionnaire {
            background: #fef3c7;
            color: #d97706;
        }
        .isi-nav__role-badge--client {
            background: #dcfce7;
            color: #16a34a;
        }
        .isi-nav__logout {
            font-size: 0.875rem;
            font-weight: 700;
            color: #ef4444;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.2s;
        }
        .isi-nav__logout:hover { color: #dc2626; }
        .isi-nav__hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }
        .isi-nav__hamburger span {
            display: block;
            width: 24px; height: 2px;
            background: #334155;
            border-radius: 2px;
            transition: all 0.3s;
        }
        .isi-nav__mobile {
            background: white;
            border-top: 1px solid rgba(0,0,0,0.06);
            padding: 1rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        .isi-nav__mobile-link {
            font-size: 0.9rem;
            font-weight: 700;
            color: #475569;
            text-decoration: none;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f1f5f9;
            transition: color 0.2s;
        }
        .isi-nav__mobile-link:hover { color: #f97316; }
        .isi-nav__mobile-user {
            font-size: 0.875rem;
            font-weight: 700;
            color: #1e293b;
            padding: 0.5rem 0;
        }
        .isi-nav__mobile-logout {
            font-size: 0.875rem;
            font-weight: 700;
            color: #ef4444;
            background: none;
            border: none;
            cursor: pointer;
            text-align: left;
            padding: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .isi-nav__links { display: none; }
            .isi-nav__hamburger { display: flex; }
        }
    </style>
</head>
<body>

@include('composants.navbar')

<div class="container mx-auto mt-4 flex-grow">
    @yield('content')
</div>

@include('composants.footer')

<script>
    // Mobile menu toggle
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("menu-btn");
        const menu = document.getElementById("mobile-menu");
        if (btn) {
            btn.addEventListener("click", function () {
                menu.classList.toggle("hidden");
            });
        }
    });

    // Scroll reveal
    const srEls = document.querySelectorAll('.sr');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    srEls.forEach(el => io.observe(el));
</script>

</body>
</html>
