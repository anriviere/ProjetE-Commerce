@extends('layout')

@section('contenu')
<a href="/test">test</a>
<h2>Tableau de bord:</h2>
<section class="jumbotron mx-5">
    <h3>Les utilisateurs</h2>
    <div class="row d-flex">
      <div class="col-12 col-md-3">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent">Nombre de commandes passées: {{$commandes->count()}} </li>
          <li class="list-group-item bg-transparent">Nombre de commandes en cours: {{$commandes->where('validate', 0)->count()}} </li>
          <li class="list-group-item bg-transparent">Revenus total: {{$commandes->count() * 2.5}}</li>
          <li class="list-group-item bg-transparent">Nombre de commerces: {{$commerces->count()}} </li>
          <li class="list-group-item bg-transparent">Nombre d'utilisateurs(non commerçants): {{$utilisateurs->count()}} </li>
          <li class="list-group-item bg-transparent">Nombre d'utilisateurs total: {{$utilisateurs->count() + $commercants->count()}} </li>
        </ul>
      </div>
    </div>
</section>

<section class="jumbotron mx-5">
  <h3>Les commerces</h2>
  <div class="row d-flex">
    <div class="col-12">
      <ul class="list-group list-group-flush">
        @foreach($commerces->take(10) as $commerce)
        <li class="list-group-item bg-transparent">Commerce n° : {{ $commerce->id}} <a href="{{ url('/commerce/'.$commerce->id) }}" class="btn btn-sm btn-outline-success">Voir détail commerce</a></li> 
        @endforeach
      </ul>
    </div>
  </div>
  <div class="col-12 col-md-3 mx-auto">
    <a href="\liste_commerce" class="btn btn-success">Voir tous les commerces</a>
</div>
</section>

<section class="jumbotron mx-5">
    <h3>Les commandes</h2>
    <div class="row d-flex">
      <div class="col-12">
        <ul class="list-group list-group-flush">
          @foreach($commandes->take(10) as $commande)
            <li class="list-group-item bg-transparent">Commande n° : {{ $commande->id}} <a href="{{ url('/detail_commande/'.$commande->id) }}" class="btn btn-sm btn-outline-success">Voir détail commande</a></li>
          
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-12 col-md-3 mx-auto">
        <a href="\liste_commandes" class="btn btn-success">Voir toutes les commandes</a>
    </div>
  </section>

  <section class="jumbotron mx-5">
    <h3>Les utilisateurs</h2>
    <div class="row d-flex">
      <div class="col-12">
        <ul class="list-group list-group-flush">
          @foreach($utilisateurs->take(10) as $utilisateur)
          <li class="list-group-item bg-transparent">Utilisateur n° : {{ $utilisateur->id}} <a href="{{ url('/modification_profilAdmin/'.$utilisateur->id) }}" class="btn btn-sm btn-outline-success">Voir/modifier détail utilisateur</a></li> 
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-12 col-md-3 mx-auto">
      <a href="\liste_user" class="btn btn-success">Voir tous les utilisateurs</a>
  </div>
  </section>

{{-- <section class="jumbotron mx-5">
  
  <div class="row d-flex">
    <div  id="cores" class="col-12 col-md-4">
      <h3>Mes Corespondants</h3>
      <ul class="list-group" >
        @foreach($user->corespondants as $corespondant) 
        <li class="list-group-item bg-transparent">
          {{$corespondant->prenom}} <a href="{{ url('/profil/'.$corespondant->id) }}" class="btn btn-sm btn-outline-success">Voir messages</a>
        </li>   
        @endforeach
      </ul>
    </div>

    <div data-mdb-perfect-scrollbar='true' class="col-12 col-md-6 scrollspy-example">
      <h3>Mes Messages</h3>
      @if(isset($messages))
        @foreach ($messages as $message)
        @if($message->destinataire_id == $user->id)
        <p class="bg-success">{{$message->contenu}}</p>
        @else
        <p class="bg-danger">{{$message->contenu}}</p>
        @endif
            
        @endforeach

      @endif
    </div>
  </div>
</section> --}}
    
@endsection
