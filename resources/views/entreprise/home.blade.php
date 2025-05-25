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
    <!-- Chargement de jQuery (nécessaire pour Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container-scroller" style="margin-left: 157px; margin-right: -125px;  max-width: 100%;  margin-top: -25px" >
        @include('entreprise.layouts.sidebar')
        @include('entreprise.layouts.navbar')
        
        <div class="main-panel">
            <div class="content-wrapper" style= "background-color: rgb(106, 73, 110)">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts en fin de body -->
    <script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/assets/js/misc.js') }}"></script> <!-- Souvent nécessaire -->
    
    <!-- Initialisation manuelle si nécessaire -->
    <script>
        $(document).ready(function() {
            // Activation du bouton minimize
            $('[data-toggle="minimize"]').on('click', function() {
                $('body').toggleClass('sidebar-icon-only');
            });
        });
    </script>
</body>
</html>
