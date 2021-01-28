<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCommandes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$produits,$commande,$commerce)
    {
        //récupère parametres pour envoie de mail
        $this->user = $user;
        $this->commande = $commande;
        $this->commerce = $commerce;
        $this->articles = $produits;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //envoie par mail la vue commandeCommerce au commerce qui a reçu la commande
        return $this->view('Emails.commandeCommerce',['user' => $this->user,'commande' => $this->commande, 'articles' => $this->articles, 'commerce' => $this->commerce]);
    }
}
