<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style type="text/css">
        /* Tu peux mettre ton style ici si nécessaire */
        #ui-basic {
            margin-top: 4cm;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.sidebar')
        <!-- partial -->
        @include('admin.layouts.navbar')
        <!-- partial -->

        <div class="container" style="margin-top: 100px;">
            {{-- Bloc collapsible --}}
            <div id="ui-basic" class="collapse">
                <!-- Ici tu peux ajouter du contenu caché qui s'affichera quand on clique sur le lien -->
            </div>

            {{-- Tableaux des entreprises valides --}}
            <h2>Entreprises rejetées ({{ $rejetes->count() }})</h2>
            <form action="{{ url()->current() }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Rechercher par nom" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
            
            @if(isset($noResults) && $noResults)
                <div class="alert alert-danger">
                    Le recruteur n'existe pas.
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom du recruteur</th>
                        <th>Email</th>
                        <th>Nom de l'entreprise</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                        @forelse($rejetes as $recruteur)
                            <tr>
                                <td>{{ $recruteur->user->nom }}</td>
                                <td>{{ $recruteur->user->email }}</td>
                                <td>{{ $recruteur->nom_entreprise }}</td>
                                <td>
                                    <form action="{{ route('entreprises.valider', $recruteur->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Valider</button>
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
    </div>

    <!-- plugins:js -->
    @include('admin.script')
</body>
</html>
