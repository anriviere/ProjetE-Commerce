<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guest()){
        //vérifie que le visiteur est connécté pour le renvoyer sur les pages
        //sinon message d'erreur, demandant de se connecter + redirection page de connexion
            flash("Vous devez être connécté pour acceder à cette page")->error();
            return redirect('/connexion');
        }
        return $next($request);
    }
}
