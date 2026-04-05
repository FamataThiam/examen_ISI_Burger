<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    protected $fillable=[
        'date_commande',
        'total',
        'etat',
        'client_id'
    ];

    protected $casts = [
        'date_commande' => 'date',
        'total'         => 'decimal:2',
        'etat'          => 'string',
    ];
    public function client(): BelongsTo{
        return $this->belongsTo(Client::class);

    }


    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }

    public function produits(): HasMany
    {
        return $this->hasMany(CommandeProduit::class);
    }
}
