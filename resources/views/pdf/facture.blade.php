<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { border-bottom: 2px solid #f97316; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { width: 120px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background: #f8fafc; text-align: left; padding: 10px; border-bottom: 1px solid #e2e8f0; }
        .table td { padding: 10px; border-bottom: 1px solid #f1f5f9; }
        .total-section { text-align: right; margin-top: 30px; font-size: 1.2rem; }
        .orange { color: #f97316; font-weight: bold; }
    </style>
</head>
<body>
<div class="header">
    <table style="width: 100%">
        <tr>
            <td>
                @if($logo)
                    <img src="{{ $logo }}" class="logo">
                @else
                    <h1 class="orange">ISI BURGER</h1>
                @endif
            </td>
            <td style="text-align: right">
                <h2 style="margin:0">FACTURE</h2>
                <p style="margin:0">N° #{{ $commande->id }}</p>
                <p style="margin:0">Date: {{ $commande->created_at->format('d/m/Y') }}</p>
            </td>
        </tr>
    </table>
</div>

<div>
    <strong>Client :</strong> {{ $commande->client->prenom }} {{ $commande->client->nom }}<br>
    <strong>Email :</strong> {{ $commande->client->email }}
</div>

<table class="table">
    <thead>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix Unit.</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commande->produits as $item)
        <tr>
            <td>{{ $item->produit->nom }}</td>
            <td>{{ $item->quantite }}</td>
            <td>{{ number_format($item->prixUnitaire, 0) }} FCFA</td>
            <td>{{ number_format($item->prixTotal, 0) }} FCFA</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="total-section">
    Total Payé : <span class="orange">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
</div>
</body>
</html>
