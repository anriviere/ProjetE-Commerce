<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConnexionsController extends Controller
{
    //renvoie la page de connexion
    public function formulaire(){
        return view('connexion');
    }

    //fonction de connexion
    public function formConnexion(){
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //compare le password et l'id
        $resultat = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);

        //si les deux corespondent:
        //si l'user est admin il est rédirigé vers le dashboard admin
        //sinon il est redirigé vers son profil
        if($resultat) {
            if(auth()->user()->status == 3){
                return redirect('/dashboardAdmin');
    
            }else{
                return redirect('/profil');
            }
            
        }

        //Si l'id échou, message d'erreur.
        return back()->withErrors([
            'email' => "L'id et le mot de passe ne corespondent pas",
        ]);

    }
}
