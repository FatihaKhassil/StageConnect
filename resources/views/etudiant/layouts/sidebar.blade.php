<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #e5cdeb;">
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #e5cdeb">
          <a style="display: flex; align-items: center; text-decoration: none;">
            <img src="{{ asset('photo/LOGO.png') }}" alt="Logo" style="height: 50px; margin-right: 5px;">
            <h1 style="font-size: 25px; margin: 0; font-weight: bold;">
              <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
            </h1>
          </a>
        </div>
        <div class="profile-pic">
          <div class="count-indicator">
            <span style="display:inline-block;width:40px;height:40px;border-radius:50%;background: rgb(106, 73, 110);color:white;text-align:center;line-height:40px;font-weight:bold">
              {{ strtoupper(substr($user->nom, 0, 1)) }}
            </span>
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal text-black">{{ $user->nom }}</h5>
            <span>{{ ucfirst($user->role) }}</span>
          </div>
        </div>
      </div>
    </li>

    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>

    <!-- Tableau de bord -->
    <li class="nav-item menu-items {{ request()->routeIs('offres.disponibles') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('offres.disponibles') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>

    <!-- Mes candidatures -->
    <li class="nav-item menu-items {{ request()->routeIs('etudiant.mes-candidatures') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('etudiant.mes-candidatures') }}">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Mes candidatures</span>
      </a>
    </li>
  </ul>
</nav>