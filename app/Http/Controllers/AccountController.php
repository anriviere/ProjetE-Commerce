<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\User;
use App\Models\Commerces;
use Gloudemans\Shoppingcart\Facades\Cart;

class AccountController extends Controller
{
    public function profil(){

        
        //renvoie la page profil 
        return view('Utilisateur/profil', [
            'user' => auth()->user(),
            
        ]);

        
    }
    
    public function profilMessage($id){


        //récupère l'user connecté
        $user = auth()->user();
        
        //récupère tous les messages ou l'user envoyé en request est soit destinataire soit expéditeur
        //et les tri par ordre de création;
        $messages = Messages::where([['destinataire_id', $id],['expediteur_id', $user->id]])
        ->orWhere([['expediteur_id', $id],['destinataire_id', $user->id]])
        ->orderBy('created_at')
        ->get();
        
        //récupère l'user (le corespondant de l'user connecté)
        //qui à été passé en request
        $dest = User::find($id);


        //renvoie la vue
        return view('Utilisateur/profil', [
            'user' => auth()->user(),
            'messages' => $messages,
            'dest' => $dest,
        ]);

    }

    // public function test()
    // {
    //     //on récupère tous les commerces
    //     $commerces = Commerces::all();
    //     //On vérifie si les commerces on des paniers en cours
    //     //On détruit chaque instance de panier
    //     foreach($commerces as $commerce){
    //         if(Cart::instance($commerce->id)){
    //             Cart::instance($commerce->id)->destroy();
    //         }
    //     }
            
        
    //     return back();
    // }

    //lors de la déconnexion on vide toute les instances de panier
    public function signout(){

        //on récupère tous les commerces
        $commerces = Commerces::all();
        //On vérifie si les commerces on des paniers en cours
        //On détruit chaque instance de panier
        foreach($commerces as $commerce){
            if(Cart::instance($commerce->id)){
                Cart::instance($commerce->id)->destroy();
            }
        }

        //pour se déconnecter
        auth()->logout();

        return redirect('/');
    }

    public function form_user_modification(){
        return view('Utilisateur/modification_profil', [
            'user' => auth()->user(),
        ]);
    }

    public function user_modification(){
        //validation des request
        request()->validate([
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' =>['required'],
            'nom'=>['required'],
            'prenom'=>['required'],
            'telephone'=>['required'],
            'email' => ['required'],
            'adresse'=>['required'],
            'code'=>['required'],
            'ville'=>['required'],


        ]);

        //met a jour la table user
        auth()->user()->update([
            'password'=> bcrypt(request('password')),
            'nom' =>request('nom'),
            'prenom' =>request('prenom'),
            'telephone' => request('telephone'),
            'email' => request('email'),
            'adresse'=> request('adresse'),
            'code' => request('code'),
            'ville'=> request('ville'),
        ]);

        return redirect('/profil');

    }
}
