<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <link href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <style type="text/css">
    .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 280px;
    height: 100vh;
    z-index: 100;
   }
    </style>
  </head>
  <body>
    <div class="container-scroller" style="margin-left: 157px; margin-right: -125px; max-width: 100%; margin-top: -25px">
      <!-- partial:partials/_sidebar.html -->
      @include('etudiant.layouts.sidebar')
      <!-- partial -->
      @include('etudiant.layouts.navbar')
        <!-- partial -->
        {{ Auth::user()->name }} 
        <div class="main-panel">
          <div class="content-wrapper" style= "background-color: rgb(106, 73, 110)">
              @yield('content') <!-- Ici sera injecté le contenu des vues enfants -->
          </div>
      </div>
  </div>
  <!-- Inclure les scripts communs -->
  @include('admin.script')
    
  </div>
  </body>
</html>
