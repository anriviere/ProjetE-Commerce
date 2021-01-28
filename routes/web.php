<?php

use Illuminate\Support\Facades\Route;
use App\Models\User as User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'App\Http\Middleware\Auth',

], function(){

    //Routes liées au profil de l'user
    Route::get('/profil', 'App\Http\Controllers\AccountController@profil');
    Route::get('/profil/{id}', 'App\Http\Controllers\AccountController@profilMessage');
    Route::get('/signout','App\Http\Controllers\AccountController@signout');

    //Routes liées a l'ajout d'un commerce
    Route::post('/ajoutCommerce', 'App\Http\Controllers\UsersController@addCommerce');
    Route::get('/ajoutCommerce','App\Http\Controllers\UsersController@formulaireCommerce' );

    //Routes liées à l'ajout d'un produit
    Route::get('/ajoutProduit/{id}','App\Http\Controllers\CommerceController@formulaireProduit');
    Route::post('/ajoutProduit','App\Http\Controllers\CommerceController@addProduit');

    //Routes liées à la modification du profil
    Route::get('/modification_profil', 'App\Http\Controllers\AccountController@form_user_modification');
    Route::post('/modification_profil', 'App\Http\Controllers\AccountController@user_modification');

    //page commerce
    Route::get('/commerce/{id}','App\Http\Controllers\CommerceController@pageCommerce');

    //modification info du commerce
    Route::get('/modification_commerce/{id}','App\Http\Controllers\CommerceController@formModifCommerce');
    Route::post('/modification_commerce','App\Http\Controllers\CommerceController@Update_Commerce');

    //Routes liées aux articles (affichage + modification + suppression)
    Route::delete('/article_suppression/{id}/{commerce}', 'App\Http\Controllers\CommerceController@article_suppression');
    Route::get('/pageProduit/{id}/{produit}/','App\Http\Controllers\CommerceController@pageProduit');
    Route::get('/modification_article/{id}/{produit}/','App\Http\Controllers\CommerceController@FormulaireModifProduit');
    Route::post('/modification_article', 'App\Http\Controllers\CommerceController@ModifProduit');

    //Routes liées au panier
    Route::delete('/monpanier/{rowid}/{id}','App\Http\Controllers\CartController@destroy');
    Route::post('/panier/ajouter', 'App\Http\Controllers\CartController@store');
    Route::get('/monpanier/{id}', 'App\Http\Controllers\CartController@index');

    //Routes liés aux commerces, côté user (pages catalogues, recherche de produits etc..)
    Route::get('/listeCommerces','App\Http\Controllers\CommerceController@liste');
    Route::get('/boutique_catalogue/{id}','App\Http\Controllers\CommerceController@boutiqueCatalogue');
    Route::get('/boutique_info/{id}','App\Http\Controllers\CommerceController@boutiqueInfo');
    Route::get('/recherche/{commerce}','App\Http\Controllers\CommerceController@recherche');


    //Route::get('/test', 'App\Http\Controllers\CartController@test');
    Route::post('/avis_produit', 'App\Http\Controllers\AvisController@avisProduit');

    //Routes liées aux commandes
    Route::get('/commande/{id}', 'App\Http\Controllers\CommandeController@commander');
    Route::get('/detail_commande/{id}', 'App\Http\Controllers\CommandeController@detailCommande');
    Route::get('/validCommande/{id}', 'App\Http\Controllers\CommandeController@valide_commande');

    //Route liée au chat
    Route::post('/envoiMessage', 'App\Http\Controllers\MessageController@envoiMessage');

    //Routes liées à l'espace admin
    Route::get('/dashboardAdmin', 'App\Http\Controllers\AdminController@dashboardAdmin');
    Route::get('/modification_profilAdmin/{id}', 'App\Http\Controllers\AdminController@form_user_modification');
    Route::post('/modification_profilAdmin', 'App\Http\Controllers\AdminController@user_modification');
    Route::get('/liste_user','App\Http\Controllers\AdminController@liste_user');
    Route::get('/liste_commerce','App\Http\Controllers\AdminController@liste_commerce');
    Route::get('/liste_commandes','App\Http\Controllers\AdminController@liste_commandes');

});



//Routes liées à l'inscription
Route::post('/inscription','App\Http\Controllers\InscriptionsController@form' );
Route::get('/inscription','App\Http\Controllers\InscriptionsController@formulaire' );


//Routes liées à la connexion
Route::get('/connexion', '\App\Http\Controllers\ConnexionsController@formulaire');
Route::post('/connexion', '\App\Http\Controllers\ConnexionsController@formConnexion');


