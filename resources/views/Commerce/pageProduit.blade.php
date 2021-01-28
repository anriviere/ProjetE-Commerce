@extends('layout')

@section('contenu')
<h6>
  <a href="{{url('/monpanier/'.$commerce->id)}}" >Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
</h6>

<h4>Article : {{ $produit->nom }}, vendu par : {{ $commerce->nomCommerce}}</h4>

<div class="card col-8">
    <img src="{{ $produit->url_image}}" class="card-img-top" alt="articlesImage">
    <div class="card-body">
      <h5 class="card-title">{{ $produit->nom }}</h5>
      <p class="card-text">{{ $produit->description}}</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Prix : {{ $produit->prix}} </li>
      <li class="list-group-item">Tous les produits sont livrés en vrac, merci de prévoir vos récipient pour les récupérer à la livraison</li>
    </ul>
    <div class="card-body">
        
      @if(auth()->user()->id==$commerce->user_id)
        <a href="{{ url('/modification_article/'.$commerce->id .'/'.$produit->id) }}" class="card-link">Modifier l'article</a>
        {{-- <a href="{{ url('/article_suppression/'.$produit->id .'/'.$commerce->id) }}" class="card-link">Supprimer l'article</a> --}}
        <form action="{{ url('/article_suppression/'.$produit->id .'/'.$commerce->id) }}" method="POST">
          @csrf
          @method('DELETE')
              <button class="btn btn-link" type="submit">Supprimer l'article</button>
        </form>
      @endif

      @if($produit->quantite > 0)
      <form action="/panier/ajouter" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $produit->id }}" >
        <input type="hidden" name="commerce_id" value="{{ $commerce->id }}" >
        <button type="submit" class="btn btn-outline-dark m-1 btn-sm">Ajouter au panier</button>
      </form>
      @else
      <div class="alert alert-danger" role="alert">
        Produit en rupture de stock !!
      </div>
      @endif
    </div>
    <div class="card-body">
        <h3>Avis</h3>
        <form action="/avis_produit/" method="POST">
          @csrf
          <p>Je donne mon avis :</p>
          
          <div class="form-group">
            <label for="note">Ma note</label>
            <select id="note" class="form-control" multiple name="note" placeholder="Ma note" >
                <option disabled >Quelle note donneriez vous a ce produit?</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>    
            </select>
            @if($errors->has('note'))
                <p>{{$errors->first('note')}}</p>     
            @endif
          </div>

          <div class="form-group">
            <label for="commentaire">Mon commentaire</label>
            <input type="text" name="commentaire"  class="form-control" id="commentaire"  value={{ old('commentaire') }}>
            @if ($errors->has('commentaire'))
                <small id="commentaire" class="form-text text-muted">{{ $errors->first('commentaire')}}</small>
            @endif
          </div> 
          
          <input type="hidden" name="articles_id" value="{{ $produit->id }}">

          <button type="submit" class="btn btn-outline-dark m-1 btn-sm">Valider</button>
        </form>  
    </div>

    <div class="card-body">
      <h3>Tous les avis :</h3>
      @foreach($produit->avisProduit as $avis)
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent">
            <p>écrit le {{$avis->created_at}} par {{$avis->prenom}} {{$avis->nom}}</p>
              <h4>{{$avis->note}}</h4>
              <p>{{$avis->commentaire}}</p>
          </li>
        </ul>
      @endforeach
    </div>

</div>


@endsection