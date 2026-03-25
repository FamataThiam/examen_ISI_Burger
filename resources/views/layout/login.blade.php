<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - ISIBurger</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}"
             alt="ISIBurger Logo"
             class="h-16 w-auto">
    </div>
    <p class="text-center text-gray-500 mb-6">Connectez-vous à votre compte</p>

    {{-- Erreurs --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="exemple@email.com">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-1">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
                   placeholder="••••••••">
        </div>

        <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition">
            Se connecter
        </button>
    </form>

</div>

</body>
</html>
