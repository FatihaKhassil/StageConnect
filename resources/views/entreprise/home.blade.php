<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style type="text/css">
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('entreprise.layouts.sidebar')
      <!-- partial -->
      @include('entreprise.layouts.navbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
              @yield('content') <!-- Ici sera injecté le contenu des vues enfants -->
          </div>
      </div>
  </div>
  <!-- Inclure les scripts communs -->
  @include('admin.script')
    
  </div>
  </body>
</html>
