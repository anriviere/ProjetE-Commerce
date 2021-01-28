@extends('layout')

@section('contenu')

<form action="/connexion" method="post" class="mt-3 mb-3">
    {{csrf_field()}}

    
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" id="InputEmail" >
        @if($errors->has('email'))
            
            <p>{{$errors->first('email')}}</p> 
        @endif
    </div>

   
    <div class="form-group">
        <label for="InputPassword">Password</label>
        <input type="password" id="InputPassword" class="form-control" name="password" placeholder="Password" >
        @if($errors->has('password'))
            <p>{{$errors->first('password')}}</p>
            
        @endif

    </div>

    
    <button type="submit" class="btn btn-primary">Valider</button>
    {{-- <input type="submit" value="Valider"> --}}
</form>

@endsection