<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produit extends Model
{
    protected $fillable=[
        'libelle',
        'prix',
        'image',
        'description',
        'stock',
        'date_creation',
        'statut',
        'categorie_id',
    ];


    protected $casts = [
        'prix'           => 'decimal:2',
        'stock'          => 'integer',
        'date_creation'  => 'date',
        'statut'         => 'string',
    ];

    public function categorie(): BelongsTo{
        return $this->belongsTo(Categorie::class);
    }
}
