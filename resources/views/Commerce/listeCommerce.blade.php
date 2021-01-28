@extends('layout')

@section('contenu')

<h2>Listes des commerces :</h2>
@foreach($commerces as $commerce)
    
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{$commerce->url_image}}" class="img-thumbnail" alt="commerceImage">
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <h5 class="card-title">{{$commerce->nomCommerce}}</h5>
                    <p class="card-text">{{$commerce->description}}</p>
                    <p class="card-text"><small class="text-muted">{{$commerce->adresse}}, {{$commerce->code}} {{$commerce->ville}}</small></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <a href="{{ url('/boutique_catalogue/'.$commerce->id) }}" class="btn btn-outline-success">voir détails boutique</a>
                    {{-- <button class="btn btn-outline-success">voir détails boutique</button> --}}
                    @if(Cart::instance($commerce->id)->count() > 0)
                        <p>Votre panier dans cette boutique : <span class="badge badge-pill badge-success">{{ Cart::instance($commerce->id)->count() }} articles</p>   
                    @else 
                        <p>Vous n'avez pas de panier en cours ici !</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach


@endsection