<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ISIBurger')</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">


    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@include('composants.navbar')

<div class="container mx-auto mt-4">
    @yield('content')
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("menu-btn");
        const menu = document.getElementById("mobile-menu");
        if (btn) {
            btn.addEventListener("click", function () {
                menu.classList.toggle("hidden");
            });
        }
    });
</script>

</body>
</html>


