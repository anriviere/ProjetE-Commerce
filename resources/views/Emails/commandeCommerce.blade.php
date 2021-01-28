<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<h1>Vous avez reçu une nouvelle commande !</h1>

<h3>Adresse de livraison :</h3>
<ul class="list-group list-group-flush">
    <li class="list-group-item bg-transparent">nom : {{ $user->nom }}</li>
    <li class="list-group-item bg-transparent">prenom : {{ $user->prenom }}</li>
    <li class="list-group-item bg-transparent">adresse : {{ $user->adresse }}</li>
    <li class="list-group-item bg-transparent">Code Postal : {{ $user->code }}</li>
    <li class="list-group-item bg-transparent">ville : {{ $user->ville }}</li>
    <li class="list-group-item bg-transparent">telephone : {{ $user->telephone }}</li>
    <li class="list-group-item bg-transparent">email : {{ $user->email }}</li>
</ul>

<h3>Les produits :</h3>
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


