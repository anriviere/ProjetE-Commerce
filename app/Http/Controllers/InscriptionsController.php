<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;

class InscriptionsController extends Controller
{
    //retourne la vue avec le formulaire d'inscription
    public function formulaire(){
        return view('inscription');
    }

    //fonction d'inscription = enregistre le nouvel user
    public function form(){
        //vérifie les données
        request()->validate([
            'email'=>['required', 'email'],
            'password'=>['required','confirmed','min:8'],
            'password_confirmation'=>['required'],
            'nom'=>['required'],
            'prenom'=>['required'],
            'telephone'=>['required'],
            'status' => ['required'],
            'adresse'=>['required'],
            'code'=>['required'],
            'ville'=>['required'],
            
        ]);
    
    //création du nouvel user en bdd
        $user = User::create([
            'adresse'=> request('adresse'),
            'code' => request('code'),
            'ville'=> request('ville'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'telephone' => request('telephone'),
            'status' => request('status'),

        ]);

        //une fois le profil créé, l'user doit se connecté, il est redirigé vers la page connexion
        return view('\connexion');
    }

    

}
