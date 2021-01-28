@extends('layout')

@section('contenu')
<section class="jumbotron mx-5">
    <h3>Commande : 
        @if(auth()->user()->id == $commerce->user_id)
        @if($commande->validate == 0) <a href="{{ url('/validCommande/'.$commande->id)}}" class="btn btn-sm btn-outline-success">Valider commande </a> @endif @endif </h3>
        <div class="row d-flex">
          <div class="col-12">
            <ul class="list-group list-group-flush">
              <li class="list-group-item bg-transparent">Numéro commande: {{$commande->id}} , Montant : {{$commande->total}} , Status : @if($commande->validate == 0) 
                Commande non validée <span class="badge badge-pill badge-danger">NV</span> @else Commande validée <span class="badge badge-pill badge-success">V</span> @endif </li>
            
              <li class="list-group-item bg-transparent">Client : {{$user->nom}} , {{$user->prenom}}</li>
              <li class="list-group-item bg-transparent">Adresse de livraison : {{$user->adresse}} , {{$user->code}} {{$user->ville}}</li>
              
            </ul>
            <h6>Produits</h6>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix total</th>
                  </tr>
                </thead>
               
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <th scope="row">{{ $article[0] }}</th>
                        <td>{{ $article[1] }}</td>
                        <td>{{ $article[2] }}</td>
                        <td>{{ $article[1] * $article[2] }}</td>
                    </tr>
                    @endforeach
                </tbody>
      
            </table>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-transparent">Sous-total : {{$commande->subtotal}} </li>
                <li class="list-group-item bg-transparent">Montant livraison: {{$commande->livraison}}</li>
                <li class="list-group-item bg-transparent">Montant total : {{$commande->total}}</li>    
            </ul>
      
                 
          </div>
        </div>

        <form action="/envoiMessage" class="mt-3 mb-3" method="POST">
          <h6>Contact</h6>
          {{ csrf_field()}}

        <div class="form-group">
            <label for="contenu">Mon message :</label>
            <input type="text" name="contenu"  class="form-control" id="contenu" value="{{ old('contenu') }}" >
            @if ($errors->has('contenu'))
                <small id="contenu" class="form-text text-muted">{{ $errors->first('contenu')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        @if(auth()->user()->id == $commerce->user_id)
          <input type="hidden" name='destinataire_id' value="{{$commande->user_id}}">
          <input type="hidden" name='expediteur_id' value="{{$commerce->user_id}}">
          <button type="submit" class="btn btn-sm btn-outline-success">Contacter le client</button>
        @endif
        @if(auth()->user()->id == $commande->user_id)
          <input type="hidden" name='destinataire_id' value="{{$commerce->user_id}}">
          <input type="hidden" name='expediteur_id' value="{{$commande->user_id}}">
          <button type="submit" class="btn btn-sm btn-outline-success">Contacter le magasin</button>
        @endif
          
        </form>
        
        
     
    
  </section>



@endsection