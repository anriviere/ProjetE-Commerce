@extends('layout')

@section('contenu')

<h2>Tous les commerces :</h2>
@foreach($commerces as $commerce)
    
    <div class="card my-3">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body">
                    <h5 class="card-title">commerce n° : {{$commerce->id}}</h5>
                    <p class="card-text">nom :{{$commerce->nomCommerce}}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <a href="{{ url('/commerce/'.$commerce->id) }}" class="btn btn-sm btn-outline-success">Voir détail commerce</a>
                </div>
            </div>
        </div>
    </div>
@endforeach


@endsection