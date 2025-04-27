<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style type="text/css">
   </style>
   @section('content')
   <style>
       #ui-basic {
           margin-top: 4cm;
       }
   </style>

   <div id="ui-basic">
       <!-- Contenu de l'élément -->
   </div>
@endsection
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @include('admin.layouts.navbar')
        <!-- partial -->
        
        <div class="container" style="margin-top: 100px;">
          {{-- Entreprises en attente --}}
          <h2>Entreprises en attente ({{ $en_attente->count() }})</h2>
          <form action="{{ url()->current() }}" method="GET" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Rechercher par nom" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        
          <table class="table" >
              <thead>
                  <tr>
                      <th>Nom du recruteur</th>
                      <th>Email</th>
                      <th>Nom de l'entreprise</th>
                      <th>Actions</th>
                  </tr>
              </thead>
                      <tbody>
                        @forelse($en_attente as $recruteur)
                            <tr>
                                <td>{{ $recruteur->user->nom }}</td>
                                <td>{{ $recruteur->user->email }}</td>
                                <td>{{ $recruteur->nom_entreprise }}</td>
                                <td>
                                    <form action="{{ route('entreprises.valider', $recruteur->id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-success btn-sm">Valider</button>
                                  </form>
                                  
                                  <form action="{{ route('entreprises.rejeter', $recruteur->id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                                  </form>
                                  </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucun recruteur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
          </table>
      </div>
      
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>