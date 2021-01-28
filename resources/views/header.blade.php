<nav class="navbar navbar-expand-lg navbar-light bg-light">
    @if(auth()->check())
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="{{url('/signout')}}" class="button nav-link">sign out</a>
        </li>

        <li class="nav-item">
            <a href="{{url('/listeCommerces')}}" class="button nav-link">Les commerces</a>
        </li>

        <li class="nav-item">
            <a href="{{url('/profil')}}" class="button nav-link">profil</a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{url('/monpanier'.Cart::content()->instance)}}" class="button nav-link">Mon panier <span class="badge badge-pill badge-success">{{ Cart::count() }}</span> </a>
        </li> --}}

        {{-- <li class="nav-item">
            <a href="{{url('/password_modification')}}" class="button nav-link">password modification</a>
        </li> --}}

    </ul>
    @else    
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="{{url('/connexion')}}" class="button nav-link">Connexion</a>
        </li>
        <li class="nav-item">
        <a href="{{url('/inscription')}}" class="button nav-link">Inscription</a>
        </li>

        <li class="nav-item">
            <a href="{{url('/')}}" class="button nav-link">Acceuil</a>
        </li>

    </ul>
    @endif

</nav>


