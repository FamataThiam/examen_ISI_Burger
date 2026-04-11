<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandeProduit extends Model
{
    protected $fillable=[
        'commande_id',
        'produit_id',
        'quantite',
        'prixUnitaire',
        'prixTotal',
    ];

    protected $casts = [
        'quantite'     => 'integer',
        'prixUnitaire' => 'decimal:2',  /// deux chiffres après la virgule
        'prixTotal'    => 'decimal:2',
    ];
    /// Chaque ligne appartient à une commande
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }
    /// Chaque ligne appartient à une produit
    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

}
