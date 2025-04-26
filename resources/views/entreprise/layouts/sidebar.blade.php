<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #e5cdeb;">
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc"><div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top" style="background-color: #e5cdeb">
          <a href="index.html" style="display: flex; align-items: center; text-decoration: none;">
            <img src="photo/LOGO.png" alt="Logo" style="height: 50px; margin-right: 5px;">
            <h1 style="font-size: 25px; margin: 0; font-weight: bold;">
                <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
            </h1>
        </a>
        </div>
          <div class="profile-pic">
            <div class="count-indicator">
              <img class="img-xs rounded-circle " src="admin/assets/images/faces/face15.jpg" alt="">
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
                <h5 class="mb-0 font-gray-normal text-black">{{ $user->nom }}</h5>
                <span>{{ ucfirst($user->role) }}</span>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="index.html">
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
          <span class="menu-title">Mes offres</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Offres en attende</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Offres valides</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Offres non valides</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
          <span class="menu-icon">
            <i class="mdi mdi-playlist-play"></i>
          </span>
          <span class="menu-title">Mes offres </span>
        </a>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
          </span>
          <span class="menu-title">Candidatures</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html">Candidatures en attende </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> Candidatures acceptées </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html">Candidatures refusées </a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>