@extends('template')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/commandespayes.css') }}">

    <div class="finance-container">
        <div class="stats-header">
            <div>
                <h2>Total des Recettes</h2>
                <p>Commandes encaissées avec succès</p>
            </div>
            <div class="amount">
                {{ number_format($totalEncaisse, 0, ',', ' ') }} FCFA
            </div>
        </div>

        <div class="table-card">
            <table>
                <thead>
                <tr>
                    <th>Réf</th>
                    <th>Date de Paiement</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                @forelse($commandes as $commande)
                    <tr>
                        <td><b>#{{ $commande->id }}</b></td>
                        <td>{{ $commande->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <b>{{ $commande->client->prenom }} {{ $commande->client->nom }}</b><br>
                            <small style="color: #64748b;">{{ $commande->client->email }}</small>
                        </td>
                        <td style="font-weight: 700;">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                        <td><span class="pay-badge">PAYÉE</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                            Aucun encaissement enregistré pour le moment.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
