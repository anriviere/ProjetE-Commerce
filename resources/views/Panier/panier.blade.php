@extends('layout')

@section('contenu')

<div class="card">
  <div class="card-header mb-3">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" aria-current="true" href="{{ url('/boutique_catalogue/'.$commerce->id) }}">Catalogue</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/boutique_info/'.$commerce->id) }}">Info Boutique</a>
      </li>
      <li class="nav-item">
        <a href="{{url('/monpanier/'.$commerce->id)}}" class="nav-link active" >Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
      </li>
    </ul>
  </div>

<h2 class="mx-auto">Mon Panier</h2>
@if (Cart::count()>0)
  <table class="table">
      <thead>
        <tr>
          <th scope="col">Article</th>
          <th scope="col">Prix</th>
          <th scope="col">Quantité</th>
          <th scope="col">Prix total</th>
          <th scope="col">Supprimer</th>
        </tr>
      </thead>
     
      <tbody>
          @foreach(Cart::content() as $article)
          <tr>
              <th scope="row">{{ $article->model->nom }}</th>
              <td>{{ $article->model->prix }}</td>
              <td>{{ $article->qty}}</td>
              <td>{{ $article->model->prix * $article->qty }}</td>
              <td>
                <form action="{{ url('/monpanier/'.$article->rowId .'/'.$commerce->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="fa fa-trash-o btn"></button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>
    
      
    </table>
    <table class="table">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>prix commande : </th>
          <td>{{ Cart::subtotal()}}</td>
        </tr>
        <tr>
          <th>livraison : </th>
          <td>{{ $livraison }}</td>
        </tr>
        <tr>
          <th>Total : </th>
          <td>{{ Cart::subtotal() + $livraison}}</td>
        </tr>
        <tr>
          <th></th>
          <td>
              
              <a href="{{ url('/commande/'.$commerce->id) }}" class="btn btn-outline-dark">Valider Commande</a>
          </td>
        </tr>
      </tbody>

    </table>

@else
<p>Votre panier est vide</p>

@endif

@endsection