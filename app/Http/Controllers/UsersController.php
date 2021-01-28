<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerces as Commerces;

class UsersController extends Controller
{
    //retourne le formulaire de création de commerce
    public function formulaireCommerce(){
        return view('commerceForm');
    }

    //fonction d'ajout de commerce
    public function addCommerce(){
        //récupère les données du formulaire
        request()->validate([
            'email'=>['required', 'email'],
            'telephone'=>['required'],
            'nomCommerce'=>['required'],
            'type'=>['required'],
            'adresse'=>['required'],
            'code'=>['required'],
            'ville'=>['required'],
            'description'=>['required'],
            'file'=>['required'],
            
        ]);

        //cré un nouveau commerce, relié au user qui l'a ajouté
        auth()->user()->commerces()->create([
            'email'=> request('email'),
            'telephone' =>request('telephone'),
            'nomCommerce'=> request('nomCommerce'),
            'type' =>request('type'),
            'adresse'=> request('adresse'),
            'code' =>request('code'),
            'ville'=> request('ville'),
            'description'=>request('description'),
            'url_image' => cloudinary()->upload(request()->file('file')->getRealPath())->getSecurePath()
            

            
        ]);
        return redirect('/profil');
    }

    

    

}



