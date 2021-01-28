<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commandes;
use App\Models\Commerces;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\NewCommandes;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commander(Request $request){

        $commerce = Commerces::find($request->id);
        $livraison = 2.5;
        Cart::instance($commerce->id);

        //On vérifie que le solde de l'user est suffisant 
        if((Cart::subtotal() + $livraison) <= Auth()->user()->solde){
            //On enregistre le panier dans la base de données:
            //On crée une nouvelle instance de commande et on récupère tte les info a enregistrer
            $commande = new Commandes();
            $commande->user_id = auth()->user()->id;
            $commande->commerces_id = $commerce->id;

            $commande->subtotal = Cart::subtotal();
            $commande->livraison = $livraison;
            $commande->total = Cart::subtotal() + $livraison;


            $articles = [];
            $i = 0;

            //On récupère chaque articles de la commande pour les mettre dans un tableau
            foreach(Cart::content() as $article){
                $articles['article_' . $i][] = $article->model->nom;
                $articles['article_' . $i][] = $article->model->prix;
                $articles['article_' . $i][] = $article->qty;
                $i++;

            }
            //on serialize le tableau pour enregistrer une string en bdd
            $commande->articles = serialize($articles);


            $commande->save();

            //On déduit le prix du solde de l'utilisateur
            $new_solde = Auth()->user()->solde -= $commande->total;
            Auth()->user()->update([
                'solde' => $new_solde,
            ]);

            //On vide l'instance du panier
            Cart::destroy();

            $user = auth()->user();
            $produits = unserialize($commande->articles);
            //On envoie un mail à l'utilisateur pour lui confirmer la commande
            //On envoie un mail au commerce pour le prévenir
           // Mail::to($user->email)->send(new ChangePassword([$user,$commande,$commerce]));
            Mail::to($commerce->email)->send(new NewCommandes($user,$produits,$commande,$commerce));
            // Mail::to($user->email)->send(new ChangePassword($user));

            flash("Votre commande à été enregistrée")->success();
            return redirect('/profil');
        }else{
            //Si le solde est insufisant, l'user reste sur la page panier, où il pourra retirer des articles
            flash("Votre solde est insuffisant pour passer cette commande.")->error();
            return back();
        }

                    

    }

    public function detailCommande($id){
        //on récupère la bonne commande
        $commande = Commandes::where('id', $id)->FirstOrFail();
        //On récupère le user qui a passé la commande
        $user = User::where('id', $commande->user_id)->FirstOrFail();
        //On récupère le commerce a qui la commande a été adréssée
        $commerce = Commerces::where('id', $commande->commerces_id)->FirstOrFail();
        //On récupère un tableau avec les articles de la commande
        $articles = unserialize($commande->articles);
        
        //Si la personne connécté est le commerçant, ou la personne qui a commandé ou un admin,
        //On le renvoie vers le détail de la commande
        if((auth()->user()->id == $commerce->user_id) ||(auth()->user()->id == $commande->user_id) || auth()->user()->status == 3){
            return view('Commande/detail_commande', [
                'commerce' => $commerce,
                'commande' => $commande,
                'user' => $user,
                'articles'=> $articles,
            ]);

        }else{
            //Sinon il ne peut pas accéder à la page
            flash("Vous n'avez pas les autorisations pour accéder à cette page !")->error();
            return back();
        }


        
    }

    //Quand le commerçant c'est occupée de la commande il la valide
    public function valide_commande($id){
        Commandes::find($id)->update([
            'validate'=> 1,
        ]);

        return back();
    }
}
