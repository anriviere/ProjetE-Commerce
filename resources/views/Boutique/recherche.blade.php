@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header mb-3">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="{{ url('/boutique_catalogue/'.$commerce->id) }}">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{ url('/boutique_info/'.$commerce->id) }}">Info Boutique</a>
        </li>
        <li class="nav-item">
          <a href="{{url('/monpanier/'.$commerce->id)}}" class="nav-link" >Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
        </li>

        <li class="nav-item">
          <form action="{{ url('/recherche/'.$commerce->id) }}" class="d-flex">
            @csrf
            <div class="form-group">
              <input type="text" name="recherche" class="form-control" id="">
            </div>
            
            <button type="submit" class="fa fa-search btn"></button>
            

          </form>
        </li>
      </ul>
    </div>
   
    
    <div class="container mx-auto mb-3">
      <div  class="row mx-auto">

        @foreach($articles as $article)
          <div class="card col-3">
            <img src="{{ $article->url_image}}" class="card-img-top" alt="articleImage">
            <div class="card-body">
              <h5 class="card-title">{{$article->nom}}</h5>
              <p class="card-text">{{$article->description}}</p>
              <p class="card-text">{{$article->prix}}</p>
            </div>
            <div class="row mx-auto pb-1 ">
              <a href="{{url('/pageProduit/'.$commerce->id .'/'.$article->id)}}" class="btn btn-outline-dark m-1 btn-sm">voir détails</a>
              @if($article->quantite > 0)
              <form action="/panier/ajouter" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $article->id }}" >
                <input type="hidden" name="commerce_id" value="{{ $commerce->id }}" >
                <button type="submit" class="btn btn-outline-dark m-1 btn-sm">Ajouter au panier</button>
              </form>
              @else
              <div class="alert alert-danger" role="alert">
                Produit en rupture de stock !!
              </div>
              @endif
              
            </div>
          </div>
        @endforeach

        

      </div>
    </div>
  </div>


@endsection