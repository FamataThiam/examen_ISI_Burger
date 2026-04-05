<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class CommandeRefuseeStock extends Mailable
{
    use Queueable;

    public $produitNom;
    public $clientPrenom;

    public function __construct($produitNom, $clientPrenom)
    {
        $this->produitNom = $produitNom;
        $this->clientPrenom = $clientPrenom;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Information sur votre commande ISI Burger',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.commande_refusee',
        );
    }
}
