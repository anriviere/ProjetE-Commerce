@extends('layout')

@section('contenu')

<h2>Modification Informations de votre commerce</h2>

<form action="/modification_commerce" method="post" class="mt-3 mb-3" enctype="multipart/form-data">
    {{csrf_field()}}

    
    <div class="form-group">
        <label for="InputTelephone">Téléphone</label>
        <input type="string" name="telephone" placeholder="telephone" value="{{ $commerce->telephone }}" class="form-control" id="InputTelephone" >
        @if($errors->has('telephone'))
            
            <p>{{$errors->first('telephone')}}</p> 
        @endif
    </div>

    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email" name="email" placeholder="Email" value="{{ $commerce->email }}" class="form-control" id="InputEmail" >
        @if($errors->has('email'))
            
            <p>{{$errors->first('email')}}</p> 
        @endif
    </div>
    
   
    <div class="form-group">
        <label for="InputNomCommerce">Nom de commerce</label>
        <input type="string" class="form-control" id="InputNomCommerce" name="nomCommerce" placeholder="nom du commerce" value="{{ $commerce->nomCommerce }}">
        @if($errors->has('nomCommerce'))
            <p>{{$errors->first('NomCommerce')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputType">Type de commerce</label>
        <input type="string" class="form-control" id="InputType" name="type" placeholder="type" value="{{ $commerce->type }}">
        @if($errors->has('type'))
            <p>{{$errors->first('type')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputAdresse">Adresse du commerce</label>
        <input type="string" class="form-control" id="InputAdresse" name="adresse" placeholder="adresse du commerce" value="{{ $commerce->adresse }}">
        @if($errors->has('adresse'))
            <p>{{$errors->first('adresse')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputCode">Code Postal</label>
        <input type="string" class="form-control" id="InputCode" name="code" placeholder="code postal" value="{{ $commerce->code }}">
        @if($errors->has('code'))
            <p>{{$errors->first('code')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputVille">Ville</label>
        <input type="string" class="form-control" id="InputVille" name="ville" placeholder="Ville" value="{{ $commerce->ville }}">
        @if($errors->has('ville'))
            <p>{{$errors->first('ville')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputVille">Description</label>
        <input type="textarea" class="form-control" id="InputDescription" name="description" placeholder="description" value="{{ $commerce->description }}">
        @if($errors->has('description'))
            <p>{{$errors->first('description')}}</p>
        @endif
    </div>

    {{-- <div class="form-group">
        <label for="InputId">Description</label>
        <input type="text" class="form-control" id="InputId" name="user_id" placeholder="en attendant" value={{ old('InputId') }}>
        @if($errors->has('user_id'))
            <p>{{$errors->first('user_id')}}</p>
        @endif
    </div> --}}

    <input type="hidden" name="id" value="{{ $commerce->id }}">


    <input type="file" name="file"  >
    
    <button type="submit" class="btn btn-primary">Valider</button>
    {{-- <input type="submit" value="Valider"> --}}
</form>

@endsection