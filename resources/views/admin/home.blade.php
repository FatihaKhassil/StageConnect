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
    <div class="container-scroller" style="margin-left: 157px; margin-right: -125px; max-width: 100%; margin-top: -25px;">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @include('admin.layouts.navbar')
        <!-- partial -->
        <div class="main-panel" style= "background-color: lightgray">
          <div class="content-wrapper" style= "background-color: rgb(106, 73, 110)">
              @yield('content') <!-- Ici sera injecté le contenu des vues enfants -->
          </div>
      </div>
  </div>
  <!-- Inclure les scripts communs -->
  @include('admin.script')
   <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script> <!-- Souvent nécessaire -->

  </body>
</html>
