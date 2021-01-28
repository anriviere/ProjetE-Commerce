@extends('layout')

@section('contenu')
<div class="card text-center">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link" aria-current="true" href="{{ url('/boutique_catalogue/'.$commerce->id) }}">Catalogue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Info Boutique</a>
        </li>
        <li class="nav-item">
          <a href="{{url('/monpanier/'.$commerce->id)}}" class="nav-link" >Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <h5 class="card-title">Bienvenue sur la boutique de : {{ $commerce->nom }}</h5>
      <p class="card-text">Nous contacter {{ $commerce->telephone }} :</p>
      <p class="card-text">Notre adresse : {{ $commerce->adresse }} , {{ $commerce->code }} {{ $commerce->ville }}</p>
      <p class="card-body">Notre histoire : {{ $commerce->description }}</p>
    </div>
  </div>


@endsection