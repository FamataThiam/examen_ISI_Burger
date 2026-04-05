<?php

namespace App\Mail;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FactureCommande extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande->load(['client', 'produits.produit']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre Facture ISI Burger - Commande #' . $this->commande->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.facture_notification',
        );
    }

    public function attachments(): array
    {
        // Traitement du logo en Base64 pour DomPDF
        $path = public_path('images/logo.png');
        $logoBase64 = '';

        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        // Génération du PDF
        $pdf = Pdf::loadView('pdf.facture', [
            'commande' => $this->commande,
            'logo' => $logoBase64
        ]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Facture_ISI_Burger.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
