@extends('template')

@section('title', 'ISIBurger — Statistiques')

@section('content')
    <div class="flex min-h-screen bg-slate-50">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg hidden md:block">
            <div class="p-6">
                <h2 class="text-xs font-semibold text-slate-400 uppercase">Menu Gestion</h2>
            </div>

            <nav class="space-y-1 px-3">
                <a href="{{ route('dashboardGestionnaire') }}" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-100">
                    <i class="fa-solid fa-chart-pie mr-2"></i> Dashboard
                </a>

                <a href="{{ route('gestion.statistiques') }}" class="flex items-center px-4 py-3 rounded-xl bg-orange-50 text-orange-600 font-bold">
                    <i class="fa-solid fa-chart-line mr-2"></i> Statistiques
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-8">

            <h1 class="text-3xl font-bold mb-8">Statistiques</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- 📈 Commandes -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="font-bold mb-4">Commandes par mois</h3>
                    <canvas id="commandesChart"></canvas>
                </div>

                <!-- 📊 Produits -->
                <div class="bg-white p-6 rounded-2xl shadow">
                    <h3 class="font-bold mb-4">Produits par catégorie</h3>
                    <canvas id="produitsChart"></canvas>
                </div>

            </div>

        </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 📈 Commandes par mois
        const commandesChart = new Chart(document.getElementById('commandesChart'), {
            type: 'line',
            data: {
                labels: @json($labelsMois),
                datasets: [{
                    label: 'Commandes',
                    data: @json($dataCommandes),
                    borderWidth: 2,
                    fill: true
                }]
            }
        });

        // 📊 Produits par catégorie
        const produitsChart = new Chart(document.getElementById('produitsChart'), {
            type: 'bar',
            data: {
                labels: @json($labelsCategories),
                datasets: [{
                    label: 'Produits',
                    data: @json($dataProduits),
                    borderWidth: 1
                }]
            }
        });
    </script>

@endsection
