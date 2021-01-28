<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
  
    public function dashboardAdmin(){

        //récupère les commerces de chaque utilisateurs
        $commerces = User::all()->map(function($utilisateur){
            return $utilisateur->commerces;
        })
        ->flatten();

        //récupère les commandes de chaque utilisateurs
        $commandes = User::all()->map(function($utilisateur){
            return $utilisateur->commandes;
        })
        ->flatten();

        //récupère les users "simple" (non-commerçants)
        $utilisateurs = User::where('status', 1)->get();
        //récupère les users commerçants
        $commercants = User::where('status', 2)->get();

        //vérifie que la personne connéctée est admin
        //renvoie le dashboard admin
        if(auth()->user()->status == 3){
            return view('Admin/dashboard_admin', [
                'commerces' => $commerces,
                'commandes' => $commandes,
                'utilisateurs' => $utilisateurs,
                'commercants' => $commercants,
                    
            ]);
            

        }else{
            //si le user co n'est pas admin il ne peut pas accéder à la page
            flash("Vous n'avez pas les autorisations pour accéder à cette page !")->error();
            return back();
        }
       
    }

    public function form_user_modification($id){
        //récupère le user passé en request
        $user = User::find($id);
        //renvoie la page de modification des comptes users
        return view('Admin/modif_profil_user', [
            'user' => $user,
        ]);
    }

    public function user_modification(){
        //récupère les info en request
        request()->validate([     
            'nom'=>['required'],
            'prenom'=>['required'],
            'telephone'=>['required'],
            'email' => ['required'],
            'solde' => ['required'],
            'adresse'=>['required'],
            'code'=>['required'],
            'ville'=>['required'],
            'id',

        ]);

        //met a jour la table user
        $user = User::find(request('id'))->update([
            'nom' =>request('nom'),
            'prenom' =>request('prenom'),
            'telephone' => request('telephone'),
            'email' => request('email'),
            'solde' => request('solde'),
            'adresse'=> request('adresse'),
            'code' => request('code'),
            'ville'=> request('ville'),
        ]);

        //si le password est modifié
        //récupère new password et met a jour la bdd
        if(request('password')){
            request()->validate([
                'password' => ['required', 'min:8', 'confirmed'],
                'password_confirmation' =>['required'],
            ]);

            $user = User::find(request('id'))->update([
                'password'=> bcrypt(request('password')),
            ]);
    
        }
        return redirect('/dashboardAdmin');

    }

    //renvoie la page avec la liste de tous les utilisateurs
    public function liste_user(){
        $utilisateurs = User::all();

        return view('Admin/user_liste',[
            'utilisateurs' => $utilisateurs,
        ]);
        
    }

    //renvoie la page avec la liste de tous les commerces
    public function liste_commerce(){
        $commerces = User::all()->map(function($utilisateur){
            return $utilisateur->commerces;
        })
        ->flatten();

        return view('Admin/commerce_liste_admin',[
            'commerces' => $commerces,
        ]);

    }


    //renvoie la page avec la liste de toutes les commandes
    public function liste_commandes(){
        $commandes = User::all()->map(function($utilisateur){
            return $utilisateur->commandes;
        })
        ->flatten();

        return view('Admin/commandes_liste',[
            'commandes' => $commandes,
        ]);


    }
}
