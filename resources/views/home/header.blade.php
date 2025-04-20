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
        <li class="AN1"><a href="#">Accueil</a></li>
        <li class="AN2"><a href="#">À propos</a></li>
        <li class="AN3"><a href="#">Contact</a></li>
        <li class="AN4"><a href="#"></a></li>
    </ul>
</div>
