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
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @include('admin.layouts.navbar')
        <!-- partial -->
        <div class="bg-black p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center mt-[10cm]">Modifier Utilisateur</h1>
    
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <!--formulaire de modification-->
            </form>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>