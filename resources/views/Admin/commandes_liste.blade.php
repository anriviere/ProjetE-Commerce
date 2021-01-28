@extends('layout')

@section('contenu')

<h2>Toutes les commandes :</h2>
@foreach($commandes as $commande)
    
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <h5 class="card-title">commande n° : {{$commande->id}}</h5>
                    <p class="card-text">client n° :{{$commande->user_id}}</p>
                    <p class="card-text">client n° :{{$commande->commerces_id}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <a href="{{ url('/detail_commande/'.$commande->id) }}" class="btn btn-sm btn-outline-success">Voir détail commande</a>
                </div>
            </div>
        </div>
    </div>
@endforeach


@endsection