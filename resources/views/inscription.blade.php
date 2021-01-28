@extends('layout')

@section('contenu')

<form action="/inscription" method="post" class="mt-3 mb-3">
    {{csrf_field()}}

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" class="form-control" multiple name="status" placeholder="status" >
            <option disabled >Choisissez un status</option>
            <option value="1">Utilisateur</option>
            <option value="2">Commerçant</option>
        </select>
        @if($errors->has('status'))
            <p>{{$errors->first('status')}}</p>
            
        @endif

    </div>
    
    <div class="form-group">
        <label for="InputNom">Nom</label>
        <input type="string" class="form-control" id="InputNom" name="nom" placeholder="Nom" value={{ old('nom') }}>
        @if($errors->has('nom'))
            <p>{{$errors->first('nom')}}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="InputPrenom">Prénom</label>
        <input type="string" class="form-control" id="InputPrenom" name="prenom" placeholder="prenom" value={{ old('prenom') }}>
        @if($errors->has('prenom'))
            <p>{{$errors->first('prenom')}}</p>
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
        <label for="InputTelephone">Téléphone</label>
        <input type="string" name="telephone" placeholder="telephone" value="{{ old('telephone') }}" class="form-control" id="InputTelephone" >
        @if($errors->has('email'))
            
            <p>{{$errors->first('email')}}</p> 
        @endif
    </div>

    <div class="form-group">
        <label for="InputAdresse">Adresse</label>
        <input type="string" class="form-control" id="InputAdresse" name="adresse" placeholder="adresse" value={{ old('adresse') }}>
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
        <label for="InputPassword">Password</label>
        <input type="password" id="InputPassword" class="form-control" name="password" placeholder="Password" >
        @if($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
            
        @endif

    </div>

    

    <div class="form-group">
        <label for="InputPasswordConfirm">Password Confirmation</label>
        <input type="password" id="InputPasswordConfirm" class="form-control" name="password_confirmation" placeholder="Confirmation password">
        @if($errors->has('password_confirmation'))
            <p>{{$errors->first('password_confirmation')}}</p>
            
        @endif
    </div>
    
    <button type="submit" class="btn btn-primary">Valider</button>
    {{-- <input type="submit" value="Valider"> --}}
</form>

@endsection