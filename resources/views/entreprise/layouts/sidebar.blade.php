<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #e5cdeb;">
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc"><div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #e5cdeb">
        <a style="display: flex; align-items: center; text-decoration: none;">
          <img src=" {{ asset('photo/LOGO.png') }}" alt="Logo" style="height: 50px; margin-right: 5px;">
          <h1 style="font-size: 25px; margin: 0; font-weight: bold;">
              <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
          </h1>
        </a>
      </div>
      <div class="profile-pic">
        <div class="count-indicator">
          <span style="display:inline-block;width:40px;height:40px;border-radius:50%;background: rgb(106, 73, 110);color:white;text-align:center;line-height:40px;font-weight:bold">
    {{ strtoupper(substr($user->nom, 0, 1)) }}
          <span class="count bg-success"></span>
        </div>
        <div class="profile-name">
          <h5 class="mb-0 font-gray-normal text-black">{{ $user->nom }}</h5>
          <span>{{ ucfirst($user->role) }}</span>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('entreprise.offres.index') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('entreprise.offres.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ request()->routeIs('mes-offres') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('mes-offres') }}">
        <span class="menu-icon">
          <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title">Mes offres</span>
      </a>
    </li>
    <li class="nav-item menu-items {{ 
        request()->routeIs('entreprise.candidatures.en_attente') || 
        request()->routeIs('entreprise.candidatures.acceptee') || 
        request()->routeIs('entreprise.candidatures.rejetee') ? 'active' : '' 
    }}">
      <a class="nav-link" href="{{ route('entreprise.candidatures.en_attente') }}">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Candidatures</span>
      </a>
      <div class="collapse {{ 
          request()->routeIs('entreprise.candidatures.en_attente') || 
          request()->routeIs('entreprise.candidatures.acceptee') || 
          request()->routeIs('entreprise.candidatures.rejetee') ? 'show' : '' 
      }}" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link {{ request()->routeIs('entreprise.candidatures.en_attente') ? 'active' : '' }}" 
               href="{{ route('entreprise.candidatures.en_attente') }}">
              Candidatures en attente
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link {{ request()->routeIs('entreprise.candidatures.acceptee') ? 'active' : '' }}" 
               href="{{ route('entreprise.candidatures.acceptee') }}">
              Candidatures acceptées
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link {{ request()->routeIs('entreprise.candidatures.rejetee') ? 'active' : '' }}" 
               href="{{ route('entreprise.candidatures.rejetee') }}">
              Candidatures refusées
            </a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>