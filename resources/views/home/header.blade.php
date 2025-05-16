<link rel="stylesheet" href="Style.css">
 <div class="menu_bar">
    <h1 class="logo">Stage<span>Connect</span></h1>
    <img src="photo/LOGO.png" alt="Italian Trulli" class="logoimage">
    <div class="box">
        <input type="text" placeholder="Recherche...">
        <a href="{{ route('login') }}">
            <i class="fas fa-search"></i>
        </a>
    </div>
    @if (Route::has('login'))
    @auth
    <li class="">
        <x-app-layout>

        </x-app-layout>
    </li>
     @else
        <a class="btn btn-primary buttonConnexion" href="{{ route('login') }}">Se connecter</a>
        <a class="btn btn-success buttoninscription" href="{{ route('register') }}">S'inscrire</a>
    @endauth   
     @endif
     <ul class="buttonhh">
        <li class="AN1"><a href="" onclick="scrollByAmount(1)">Accueil</a></li>
        <li class="AN2"><a href="" onclick="scrollByAmount(1650)">À propos</a></li>
        <li class="AN3"><a href="" onclick="scrollByAmount(2400)">Contact</a></li>
    </ul>
    
    <script>
    function scrollByAmount(pixels) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        window.scrollBy({
            top: pixels,
            behavior: 'smooth' // Défilement fluide
        });
    }
    </script>
</div>
