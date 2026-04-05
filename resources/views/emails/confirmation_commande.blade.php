<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { padding: 20px; border: 1px solid #f97316; border-radius: 8px; }
        .header { color: #f97316; font-size: 20px; font-weight: bold; }
        .details { margin-top: 15px; background: #fff7ed; padding: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">Merci pour votre commande chez ISI BURGER !</div>

    <p>Bonjour {{ $commande->client->prenom }},</p>

    <p>Nous vous informons que votre commande <strong>#{{ $commande->id }}</strong> a bien été enregistrée et est actuellement <strong>en attente</strong> de préparation.</p>

    <div class="details">
        <strong>Résumé :</strong><br>
        Montant total : {{ number_format($commande->total, 0, ',', ' ') }} FCFA <br>
        Date : {{ $commande->date_commande }}
    </div>

    <p>Vous recevrez un nouvel e-mail avec votre facture dès que la commande sera prête.</p>

    <p>À bientôt !<br>L'équipe ISI BURGER</p>
</div>
</body>
</html>
