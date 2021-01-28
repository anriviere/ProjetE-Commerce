<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\User;


class MessageController extends Controller
{
    //fonction envoie de message, chat entre deux user
    public function envoiMessage(){

        //récupère grâce aux id en request le user qui a envoyé le message et
        //celui qui le reçoit
        $destinataire = User::where('id',request('destinataire_id'))->firstOrFail();
        $expediteur = User::where('id',request('expediteur_id'))->firstOrFail();


        //cré relation (nommée corespondants) entre les users qui ont une corespoondance
        //(au moins un des deux a déja envoyé un message à l'autre)
        $relation = Messages::where([['destinataire_id', request('destinataire_id')],['expediteur_id',request('expediteur_id')]])
        ->orWhere([['destinataire_id',request('expediteur_id')],['destinataire_id', request('expediteur_id')]])->exists();
        if(!$relation){
             $destinataire->corespondants()->attach($expediteur);
             $expediteur->corespondants()->attach($destinataire);
        }

        request()->validate([
            'contenu'=>['required'],
            'destinataire_id'=>['required'],
            'expediteur_id'=>['required'],
            
        ]);

        //Un nouveau message est créé en bdd
        Messages::create([
            'contenu'=>request('contenu'),
            'destinataire_id' =>request('destinataire_id'),
            'expediteur_id'=>request('expediteur_id'),
        ]);
        
        //le user est averti que son message a été envoyé
        flash("Votre message a bien été envoyé!")->success();

        return back();


    }
}
