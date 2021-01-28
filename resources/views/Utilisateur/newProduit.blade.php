@extends('layout')

@section('contenu')
    
    
    <h2>Ajouter un produit</h2>

    <form action="/ajoutProduit" method="post" class="mt-3 mb-3" enctype="multipart/form-data">
        {{ csrf_field()}}

        <div class="form-group">
            <label for="InputNom">Nom</label>
            <input type="text" name="nom"  class="form-control" id="InputNom" value={{ old('InputNom') }} >
            @if ($errors->has('nom'))
                <small id="nomHeld" class="form-text text-muted">{{ $errors->first('nom')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        <div class="form-group">
            <label for="InputPrix">Prix</label>
            <input type="text" name="prix"  class="form-control" id="InputPrix"  value={{ old('InputPrix') }}>
            @if ($errors->has('title'))
                <small id="prixHeld" class="form-text text-muted">{{ $errors->first('prix')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        <div class="form-group">
            <label for="InputQuantite">Quantités</label>
            <input type="text" name="quantite"  class="form-control" id="InputQuantite"  value={{ old('InputQuantite') }}>
            @if ($errors->has('quantite'))
                <small id="quantiteHeld" class="form-text text-muted">{{ $errors->first('quantite')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>

        

        <input type="file" name="file"  id="InputFile" class="form-control">

     


        <div class="form-group">
            <label for="InputDescription">Description</label>
            <input type="text" name="description"  class="form-control" id="InputDescription"  value={{ old('InputDescription') }}>
            @if ($errors->has('description'))
                <small id="descriptionHeld" class="form-text text-muted">{{ $errors->first('description')}}</small>
                {{-- <p>{{ $errors->first('email')}}</p> --}}
            @endif

        </div>
        <input type="hidden" name="id" value="{{$commerce->id}}">
        
        <button type="submit" class="btn btn-primary">Submit !</button>
    </form>

    

    
    
@endsection