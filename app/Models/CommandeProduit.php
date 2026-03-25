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
        'prixUnitaire' => 'decimal:2',
        'prixTotal'    => 'decimal:2',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }

}
