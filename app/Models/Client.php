<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Authenticatable
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'adresse',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];



    /**
     * Vérifie si l'utilisateur est un gestionnaire.
     */
    public function isGestionnaire(): bool
    {
        return $this->role === 'gestionnaire';
    }

    /**
     * Vérifie si l'utilisateur est un simple client.
     */
    public function isClient(): bool
    {
        return $this->role === 'client';
    }



    /**
     * Un client (ou gestionnaire) peut avoir plusieurs commandes.
     * Pour un gestionnaire, on peut filtrer via ->whereHas() si nécessaire.
     */
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }
}
