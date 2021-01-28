<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;

class AvisController extends Controller
{
    //On enregistre les avis des clients sur les produits
    public function avisProduit(){
        //on récupère les données
        request()->validate([
            'note'=>['required'],
            'commentaire',
            'articles_id'=>['required'],
            
        ]);

        $user = auth()->user();
        //on insère en bdd
        Avis::create([
            'note'=>request('note'),
            'commentaire' =>request('commentaire'),
            'articles_id'=>request('articles_id'),
            'user_id'=> $user->id,
            'nom'=> $user->nom,
            'prenom'=>$user->prenom,
        ]);
        

        return back();

    }

    
}
