@extends('layout')

@section('contenu')

<h2>Mon profil</h2>
<section class="jumbotron mx-5">
    <h3>Mes Informations</h2>
    <div class="row d-flex">
      <div class="col-12 col-md-3">
        <ul class="list-group list-group-flush">
          <li class="list-group-item bg-transparent">Nom: {{$user->nom}} </li>
          <li class="list-group-item bg-transparent">Prénom: {{$user->prenom}} </li>
          <li class="list-group-item bg-transparent">Téléphone: {{$user->telephone}}</li>
          <li class="list-group-item bg-transparent">Email: {{$user->email}} </li>
        </ul>
      </div>
    </div>
    <div class="col-12 col-md-3 mx-auto">
        <a href="{{ url('/modification_profil/') }}" class="btn btn-success">modifier mon profil</a>
    </div>
</section>

<section class="jumbotron mx-5">
  <h3>Mes Commandes</h2>
  <div class="row d-flex">
    <div class="col-12">
      <ul class="list-group list-group-flush">
        @foreach($user->commandes as $commande)
        <li class="list-group-item bg-transparent">Commande du : {{ $commande->created_at}} <a href="{{ url('/detail_commande/'.$commande->id) }}" class="btn btn-sm btn-outline-success">Voir détail commande</a></li>
        
        @endforeach
      </ul>
    </div>
  </div>
  {{-- <div class="col-12 col-md-3 mx-auto">
      <a href="" class="btn btn-success">Voir mes commandes</a>
  </div> --}}
</section>

@if(auth()->user()->status == 2)
  <section class="jumbotron mx-5">
    <h3>Mes Commerces</h2>
    <div class="row d-flex">
      <div class="col-12 col-md-3">
        
        @foreach($user->commerces as $commerce)
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent">
                <h4>{{$commerce->nom}}</h4>
                <p>{{$commerce->adresse}} , {{$commerce->code}} {{$commerce->ville}}</p>
                <a href="{{ url('/commerce/'.$commerce->id) }}" class="btn btn-outline-success btn-sm">Voir mon commerce</a>
            </li>
          </ul>
        @endforeach
          
        
      </div>
    </div>
    <div class="col-12 col-md-3 mx-auto">
      <a href="{{ url('/ajoutCommerce') }}" class="btn btn-success">Ajouter un commerce</a>
    </div>
  
  </section>
@endif


<section class="jumbotron mx-5">
  
  <div class="row d-flex">
    <div  id="cores" class="col-12 col-md-4" style="overflow-y:scroll; height: 25rem;">
      <h3>Mes Corespondants</h3>
      <ul class="list-group" >
        @foreach($user->corespondants as $corespondant) 
        <li class="list-group-item bg-transparent">
          {{$corespondant->prenom}} <a href="{{ url('/profil/'.$corespondant->id) }}" class="btn btn-sm btn-outline-success">Voir messages</a>
        </li>   
        @endforeach
      </ul>
    </div>

    <div data-mdb-perfect-scrollbar='true' class="col-12 col-md-6 scrollspy-example" >
      <div style="overflow-y:scroll; height: 25rem;">
        <h3>Mes Messages</h3>
        @if(isset($messages))
          @foreach ($messages as $message)
          @if($message->destinataire_id == $user->id)
          
          <div class="card bg-success ml-auto mb-2" style="width: 18rem;">
            <div class="card-body">  
              <p class="card-title"><small>posted at : {{$message->created_at}}</small></p>
              <p class="card-text ">{{$message->contenu}}</p>
            </div>
          </div>
          @else
          
  
          <div class="card text-end bg-danger mb-2" style="width: 18rem;">
            <div class="card-body">
              <p class="card-title"><small>posted at : {{$message->created_at}}</small></p>
              <p class="card-text ">{{$message->contenu}}</p>
            </div>
          </div>
          @endif
              
          @endforeach
      </div>
      

        <form action="/envoiMessage" class="mt-3 mb-3" method="POST">
          {{ csrf_field()}}
      
        <div class="form-group">
            <label for="contenu">Mon message :</label>
            <input type="text" name="contenu"  class="form-control" id="contenu" value="{{ old('contenu') }}" >
            @if ($errors->has('contenu'))
                <small id="contenu" class="form-text text-muted">{{ $errors->first('contenu')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif
      
        </div>
      
          <input type="hidden" name='destinataire_id' value="{{$dest->id}}">
          <input type="hidden" name='expediteur_id' value="{{$user->id}}">
          <button type="submit" class="btn btn-sm btn-outline-success">Envoyer message</button>
        
          
        </form>

      @endif
    </div>
  </div>
</section>
    
@endsection
