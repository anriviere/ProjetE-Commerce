@extends('layout')

@section('contenu')
<h6>
  <a href="{{url('/monpanier/'.$commerce->id)}}" >Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
</h6>

<h2>Mon Commerce</h2>
<section class="jumbotron mx-5">
    <h3>Informations du commerce</h2>
    <div class="row d-flex">
      <div class="col-12">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent">Nom: {{$commerce->nomCommerce}} </li>
          <li class="list-group-item bg-transparent">adresse: {{$commerce->adresse}} </li>
          <li class="list-group-item bg-transparent">Code postal: {{$commerce->code}}</li>
          <li class="list-group-item bg-transparent">Ville: {{$commerce->ville}} </li>
          <li class="list-group-item bg-transparent">Telephone: {{$commerce->telephone}} </li>
          <li class="list-group-item bg-transparent">Description: {{$commerce->description}} </li>
          <li class="list-group-item bg-transparent"><img src="{{ $commerce->url_image}}" class="img-thumbnail" alt="articleImage"></li>
        </ul>
      </div>
    </div>
    <div class="col-12 col-md-3 mx-auto">
        <a href="{{ url('/modification_commerce/'.$commerce->id) }}" class="btn btn-success">modifier les informations</a>
    </div>
</section>

<section class="jumbotron mx-5">
  <h3>Les Commandes</h2>
    @foreach($commerce->commandes as $commande)
      <div class="row d-flex">
        <div class="col-12">
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent">Numéro commande: {{$commande->id}} , Montant : {{$commande->total}} , Status : @if($commande->validate == 0) 
              Commande non validée <span class="badge badge-pill badge-danger">NV</span> @else Commande validée <span class="badge badge-pill badge-success">V</span> @endif </li>
            <li class="list-group-item bg-transparent"> 
              <a href="{{ url('/detail_commande/'.$commande->id) }}" class="btn btn-outline-success">Voir détail commande</a>
            </li>
          </ul>
        </div>
      </div>
    @endforeach
  
</section>



<section class="jumbotron mx-5">
  <h3>Les articles que je propose</h2>
  <div class="row d-flex">
    <div class="col-12 row d-flex ">
      
      @foreach($commerce->articles as $article)
        {{-- <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent">
              <h4>{{$article->nom}}</h4>
              <p>{{$article->prix}}</p>
              <a href="{{ url('/pageProduit/'.$commerce->id .'/'.$article->id) }}" class="btn btn-outline-success btn-sm">Voir produit</a>
          </li>
        </ul> --}}

        <div class="card" style="width: 18rem;">
          <img src="{{$article->url_image}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h4 class="card-title">{{$article->nom}}</h4>
            <p class="card-title">{{$article->prix}}</p>
            <a href="{{ url('/pageProduit/'.$commerce->id .'/'.$article->id) }}" class="btn btn-outline-success btn-sm">Voir produit</a>
          </div>
        </div>
      @endforeach
        
      
    </div>
  </div>
  <div class="col-12 col-md-3 mx-auto">
    <a href="{{ url('/ajoutProduit/'.$commerce->id) }}" class="btn btn-success">Ajouter un produit</a>
  </div>
  
</section>

{{-- <a href="{{ url('/ajoutProduit/'.$commerce->id) }}" class="btn btn-success">Ajouter un produit</a> --}}
    
@endsection
