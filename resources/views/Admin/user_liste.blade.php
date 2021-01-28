@extends('layout')

@section('contenu')

<h2>Tous les utilisateurs :</h2>
@foreach($utilisateurs as $utilisateur)
    
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <h5 class="card-title">utilisateur n° : {{$utilisateur->id}}</h5>
                    <p class="card-text">nom :{{$utilisateur->nom}}</p>
                    <p class="card-text">prenom :{{$utilisateur->prenom}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                     <a href="{{ url('/modification_profilAdmin/'.$utilisateur->id) }}" class="btn btn-sm btn-outline-success">Voir/modifier détail utilisateur</a>
                </div>
            </div>
        </div>
    </div>
@endforeach


@endsection