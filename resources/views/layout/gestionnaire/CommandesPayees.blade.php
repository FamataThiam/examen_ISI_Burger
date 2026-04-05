@extends('template')

@section('content')
    <style>
        .finance-container { max-width: 1000px; margin: 40px auto; font-family: 'Inter', sans-serif; }
        .stats-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white; padding: 30px; border-radius: 16px; margin-bottom: 30px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .stats-header h2 { margin: 0; font-size: 1.5rem; opacity: 0.9; }
        .stats-header .amount { font-size: 2.2rem; font-weight: 800; color: #f97316; }

        .table-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; padding: 15px 20px; text-align: left; color: #64748b; font-size: 0.75rem; text-transform: uppercase; }
        td { padding: 18px 20px; border-top: 1px solid #f1f5f9; font-size: 0.9rem; }

        .pay-badge {
            background: #dcfce7; color: #15803d; padding: 4px 10px;
            border-radius: 6px; font-weight: 700; font-size: 0.7rem;
        }
    </style>

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
