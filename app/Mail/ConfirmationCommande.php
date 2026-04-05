<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationCommande extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
        // Sujet du mail
            subject: 'Confirmation de votre commande ISI Burger #' . $this->commande->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation_commande',
        );
    }
}
