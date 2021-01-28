@extends('layout')

@section('contenu')
    
    
    <h2>Modifier mon article</h2>

    <form action="/modification_article" method="post" class="mt-3 mb-3" enctype="multipart/form-data">
        {{ csrf_field()}}

        <div class="form-group">
            <label for="InputNom">Nom</label>
            <input type="text" name="nom"  class="form-control" id="InputNom" value="{{ $produit->nom }}" >
            @if ($errors->has('nom'))
                <small id="nomHeld" class="form-text text-muted">{{ $errors->first('nom')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        <div class="form-group">
            <label for="InputPrix">Prix</label>
            <input type="text" name="prix"  class="form-control" id="InputPrix"  value="{{ $produit->prix }}">
            @if ($errors->has('title'))
                <small id="prixHeld" class="form-text text-muted">{{ $errors->first('prix')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        <div class="form-group">
            <label for="InputQuantite">Quantités</label>
            <input type="text" name="quantite"  class="form-control" id="InputQuantite"  value="{{ $produit->quantite }}">
            @if ($errors->has('quantite'))
                <small id="quantiteHeld" class="form-text text-muted">{{ $errors->first('quantite')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

     

        <input type="file" name="file"  id="InputFile">

        {{-- <div class="form-group">
            <input type="file" name="file"  id="InputFile">
            

        </div> --}}


        <div class="form-group">
            <label for="InputDescription">Description</label>
            <input type="text" name="description"  class="form-control" id="InputDescription"  value="{{ $produit->description }}">
            @if ($errors->has('description'))
                <small id="descriptionHeld" class="form-text text-muted">{{ $errors->first('description')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>
        <input type="hidden" name="id" value="{{$commerce->id}}">
        <input type="hidden" name="article" value="{{$produit->id}}">
        
        <button type="submit" class="btn btn-primary">Submit !</button>
    </form>

    

    
    
@endsection