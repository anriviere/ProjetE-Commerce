@extends('layout')

@section('contenu')

<h2>Votre commerce</h2>

<form action="/ajoutCommerce" method="post" class="mt-3 mb-3" enctype="multipart/form-data">
    {{csrf_field()}}

    
    <div class="form-group">
        <label for="InputTelephone">Téléphone</label>
        <input type="string" name="telephone" placeholder="telephone" value="{{ old('telephone') }}" class="form-control" id="InputTelephone" >
        @if($errors->has('telephone'))
            
            <p>{{$errors->first('telephone')}}</p> 
        @endif
    </div>

    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" id="InputEmail" >
        @if($errors->has('email'))
            
            <p>{{$errors->first('email')}}</p> 
        @endif
    </div>
    
   
    <div class="form-group">
        <label for="InputNomCommerce">Nom de commerce</label>
        <input type="string" class="form-control" id="InputNomCommerce" name="nomCommerce" placeholder="nom du commerce" value={{ old('InputNomCommerce') }}>
        @if($errors->has('nomCommerce'))
            <p>{{$errors->first('NomCommerce')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputType">Type de commerce</label>
        <select class="form-control" id="InputType" name="type" multiple value={{ old('type') }}>
            <option value="1">Alimentaire</option>
            <option value="2">hygiène/esthétique</option>
            <option value="3">Autre</option>
        </select>
        @if($errors->has('type'))
            <p>{{$errors->first('type')}}</p>
        @endif
    </div>



    <div class="form-group">
        <label for="InputAdresse">Adresse du commerce</label>
        <input type="string" class="form-control" id="InputAdresse" name="adresse" placeholder="adresse du commerce" value={{ old('adresse') }}>
        @if($errors->has('adresse'))
            <p>{{$errors->first('adresse')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputCode">Code Postal</label>
        <input type="string" class="form-control" id="InputCode" name="code" placeholder="code postal" value={{ old('code') }}>
        @if($errors->has('code'))
            <p>{{$errors->first('code')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputVille">Ville</label>
        <input type="string" class="form-control" id="InputVille" name="ville" placeholder="Ville" value={{ old('ville') }}>
        @if($errors->has('ville'))
            <p>{{$errors->first('ville')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputVille">Description</label>
        <input type="textarea" class="form-control" id="InputDescription" name="description" placeholder="description" value={{ old('description') }}>
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


    <input type="file" name="file"  id="InputFile">
    
    <button type="submit" class="btn btn-primary">Valider</button>
    {{-- <input type="submit" value="Valider"> --}}
</form>

@endsection