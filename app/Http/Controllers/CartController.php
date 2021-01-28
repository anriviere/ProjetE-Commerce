<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Articles;
use App\Models\Commerces;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //On récupère le commerce en request
        $commerce = Commerces::find($request->id);
        $livraison = 2.5;
        //on récupère l'instance de panier qui corespond au commerce récupéré
        Cart::instance($commerce->id);
        //On retourne la vue du panier
        return view('Panier/panier',[
            'commerce'=>$commerce,
            'livraison'=>$livraison,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //récupère l'article en request
        $article = Articles::find($request->id);
        //On récupère le commerce qui vend le produit
        $commerce = Commerces::find($request->commerce_id);

        //on ajoute le produit a l'instance de panier du commerce
        Cart::instance($commerce->id)->add($article->id, $article->nom, 1, $article->prix)->associate('App\Models\Articles');
            
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowid, $id)
    {
        //On récupère le commerce en request(id)
        $commerce = Commerces::find($id);
        //on remove l'article en request(rowid), de l'instance de panier du commerce
        Cart::instance($commerce->id)->remove($rowid);
        //On retourne sur le panier 
        return redirect('/monpanier/'.$id);
    }

    
}
