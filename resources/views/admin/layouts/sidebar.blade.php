<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #e5cdeb;">
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #e5cdeb">
          <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; text-decoration: none;">
            <img src="{{ asset('photo/LOGO.png') }}" alt="Logo" style="height: 50px; margin-right: 5px;">
            <h1 style="font-size: 25px; margin: 0; font-weight: bold;">
              <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
            </h1>
          </a>
        </div>
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle" src="{{ asset('admin/assets/images/faces/face15.jpg') }}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal text-black">{{ $user->nom }}</h5>
            <span>{{ ucfirst(auth()->user()->role) }}</span>
          </div>
        </div>
      </div>
    </li>

    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Offres</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('offres.en_attente') }}">Offres en attente</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('offres.valides') }}">Offres valides</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('offres.non_valides') }}">Offres non valides</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ route('admin.users.index') }}" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-account-multiple"></i>
        </span>
        <span class="menu-title">Utilisateurs</span>
      </a>
    </li>

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-domain"></i>
        </span>
        <span class="menu-title">Entreprises</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.entreprises.en_attente') }}">Entreprises en attente</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.entreprises.validees') }}">Entreprises valides</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.entreprises.rejetees') }}">Entreprises rejetées</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
