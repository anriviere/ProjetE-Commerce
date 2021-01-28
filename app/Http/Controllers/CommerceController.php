<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commerces as Commerces;
use App\Models\Articles as Articles;
use App\Models\User as User;
use App\Models\Commandes as Commandes;
use Gloudemans\Shoppingcart\Facades\Cart;

class CommerceController extends Controller
{
    
    public function pageCommerce(){
        
        $id = request('id');
        //on récupère le commerce en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        //On passe sur l'instance de panier du commerce
        Cart::instance($commerce->id);

        //On vérifie si des commandes existes pour ce commerce
        //si oui on les récupère, avec l'user associé (qui a passé la commande)
        if(Commandes::where('commerces_id', $commerce->id)->first()){
            $commande = Commandes::where('commerces_id', $commerce->id)->firstOrFail();
            $user = User::where('id', $commande->id);
        
        }else{
            //sinon on laisse commande et user vide
            $commande = [];
            $user = [];
        }
        //On retourne la page du commerce
        return view('Commerce/pageCommerce', [
            'commerce' => $commerce,
            'commande' => $commande,
            'user' => $user,
        ]);
    }

    public function formModifCommerce(){
        $id = request('id');
        //On récupère le commerce en request
        $commerce = Commerces::where('id', $id)->firstOrFail();

        //On vérifie si l'user connécté est bien le propriétaire du magasin ou si il est admin
        //si oui on lui retourne le formulaire de modification de commerce
        if((auth()->user()->id == $commerce->user_id) || auth()->user()->status == 3){
            return view('Commerce/modification_commerce', [
                'commerce' => $commerce,
            ]);
        }else{
            //sinon il ne peut pas accéder à la page
            flash("Vous n'avez pas les autorisations pour accéder à cette page !")->error();
            return back();
        }

    }

    public function Update_Commerce(){

        //On valide les éléments récupéré en request
        request()->validate([
            'email'=>['required', 'email'],
            'telephone'=>['required'],
            'nomCommerce'=>['required'],
            'type'=>['required'],
            'adresse'=>['required'],
            'code'=>['required'],
            'ville'=>['required'],
            'description'=>['required'],
            'id' =>['required'],
            
        ]);

        $id = request('id');
        
        //On met à jour en bdd le commerce selectionné
        $commerce = Commerces::where('id', $id)->update([
            'email' => request('email'),
            'telephone' =>request('telephone'),
            'nomCommerce'=> request('nomCommerce'),
            'type' => request('type'),
            'adresse'=> request('adresse'),
            'code' => request('code'),
            'ville'=> request('ville'),
            'description'=>request('description'),
            
        ]);  

        //si l'image à été modifiée:
        if(!empty(request('file'))){
            $commerce = Commerces::where('id', $id)->update([
                'url_image' => cloudinary()->upload(request()->file('file')->getRealPath())->getSecurePath()
            ]); 
        }

        return redirect('/profil');
        
    }

    public function formulaireProduit(){
        $id = request('id');
        //récupère le commerce dont l'id a été passé en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        //retourne la page d'ajout de produit du magasin
        return view('Utilisateur/newProduit', [
            'commerce'=>$commerce,
        ]);
    }


    //fonction d'ajout de produit
    public function addProduit(){

        request()->validate([
            'nom'=>['required'],
            'prix'=>['required'],
            'quantite'=>['required'],
            'description'=>['required'],
            'id'=>['required'],
            
        ]);
        
        //cré un nouvel article en bdd
        Articles::create([
            'nom' =>request('nom'),
            'prix'=> request('prix'),
            'quantite'=> request('quantite'),
            'description'=> request('description'),
            'commerces_id'=> request('id'),
            'url_image' => cloudinary()->upload(request()->file('file')->getRealPath())->getSecurePath(),

        ]);

        $id = request('id');

        $id = request('id');
        //récupère le commerce dont l'id a été passé en request
        $commerce = Commerces::where('id', $id)->firstOrFail();

        //return redirect('/profil');
        return redirect('/commerce/'.$commerce->id);

    }

    //fonction qui affiche la page du produit selectionné
    public function pageProduit(){

        $id = request('id');
        $prd = request('produit');
        //on récupère le commerce et l'article
        //dont les id ont été passés en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        $produit = Articles::where('id', $prd)->firstOrFail();
        
        //On récupère l'instance de panier du commerce
        Cart::instance($commerce->id);

        //On renvoie la page du produit
        return view('Commerce/pageProduit', [
            'commerce' => $commerce,
            'produit' => $produit,
            
        ]);
    }


    //fonction de modification des produits
    public function FormulaireModifProduit(){

        $id = request('id');
        $prd = request('produit');
        //on récupère le commerce et l'article
        //dont les id ont été passés en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        $produit = Articles::where('id', $prd)->firstOrFail();

        //On vérifie que l'user connécté est propriétaire du magasin ou qu'il est admin
        //si oui il accède à la page de modif d'article
        if((auth()->user()->id == $commerce->user_id) || auth()->user()->status == 3){
            return view('Commerce/modification_produit', [
                'commerce' => $commerce,
                'produit' => $produit,
            ]);
        }else{
            //sinon il n'a pas accès à la page
            flash("Vous n'avez pas les autorisations pour accéder à cette page !")->error();
            return back();
        }

        
    }

    public function ModifProduit(){

        //validation des éléments
        request()->validate([
            'nom'=>['required'],
            'prix'=>['required'],
            'quantite'=>['required'],
            'description'=>['required'],
            'article' =>['required'],
            'id'=> ['required'],
            
        ]);

        //récupère l'article dont l'id est en request
        $article = request('article');

        //Mise a jour du produit en bdd
        $produit = Articles::where('id', $article)->update([
            'nom' =>request('nom'),
            'prix'=> request('prix'),
            'quantite' => request('quantite'),
            'description'=> request('description'),
                
        ]);  

        if(!empty(request('file'))){
            $produit = Articles::where('id', $article)->update([
                'url_image' => cloudinary()->upload(request()->file('file')->getRealPath())->getSecurePath()
            ]); 
        }
            
        $id = request('id');
        
        $produit = Articles::where('id', $article)->firstOrFail();
        $commerce = Commerces::where('id', $id)->firstOrFail();
        //retourne page produits
        return redirect('/pageProduit/'.$commerce->id .'/' .$produit->id);
    }

    public function liste(){
        //récupère tous les commerces
        $commerces = User::all()->map(function($utilisateur){
            return $utilisateur->commerces;
        })
        ->flatten();

        //retourne vue liste de commerce
        return view('Commerce/listeCommerce',[
            'commerces' => $commerces,
        ]);
    }

    public function boutiqueCatalogue(){
        $id = request('id');
        //récupère le commerce dont l'id est en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        //récupère l'instance de panier lié au commerce
        Cart::instance($commerce->id);
        //retourne la page cataloque du commerce
        return view('Boutique/boutique_catalogue', [
            'commerce' => $commerce,
        ]);
    }

    public function boutiqueInfo(){

        $id = request('id');
        //récupère le commerce dont l'id est passé en request
        $commerce = Commerces::where('id', $id)->firstOrFail();
        //récupère l'instance de panier lié au commerce
        Cart::instance($commerce->id);
        //retourne la page info du commerce
        return view('Boutique/boutique_info', [
            'commerce' => $commerce,
        ]);

    }

//cette fonction sert a effectuer une recherche de produit dans le catalogue du commerce spécifié
    public function recherche(){
        $recherche = request('recherche');
        
        //récupère le commerce dont l'id est passé en request
        $commerce = Commerces::where('id', request('commerce'))->firstOrFail();
        
        //on récupère les produits du commerce dont le texte recherché fait partie de la description ou du nom
        $produits = Articles::where([['commerces_id', request('commerce')],['nom', 'like', "%$recherche%"]])
                            ->orWhere([['commerces_id', request('commerce')],['description', 'like', "%$recherche%"]])
                            ->get();

        //On retourne la vue avec les produits trouvés
        return view('Boutique/recherche', [
            'commerce' => $commerce,
            'articles' =>$produits,
        ]);

    }

    public function article_suppression($id, $commerce){
        
        $article = Articles::find($id);
        $article->delete();

        
        return redirect('/commerce/'.$commerce);
        
        
    }



}
