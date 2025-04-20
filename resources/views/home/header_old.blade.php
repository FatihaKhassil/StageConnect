<header class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html"><img width="250" src="images/logo.png" alt="#" /></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav">
                <li class="nav-item active">
                   <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
            
                
                <form class="form-inline">
                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                 </form>
                 @if (Route::has('login'))
                 @auth
                 <li class="nav-item">
                    <x-app-layout>

                    </x-app-layout>
                </li>


                 @else
                <li class="nav-item">
                    <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Login</a>
                 </li>
                 <li class="nav-item">
                    <a class="btn btn-success" href="{{ route('register') }}">Register</a>
                 </li>
                 @endauth
                 @endif{{--
             </ul>
          </div>--}}
       </nav>
    </div>
 </header>
 {{--
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
                 <li>
                </li>
                @else
                <div>
                    <button target="_blank" href="{{ route('register') }}" class="buttoninscription">S'inscrire</button>
                    <button target="_blank" href="{{ route('login') }}" class="buttonConnexion">Se connecter</button>
                </div>
                @endauth
                @endif
    <ul class="buttonhh">
        <li class="AN1"><a href="#">Accueil</a></li>
        <li class="AN2"><a href="#">À propos</a></li>
        <li class="AN3"><a href="#">Contact</a></li>
        <li class="AN4"><a href="#"></a></li>
    </ul>
</div>
--}}