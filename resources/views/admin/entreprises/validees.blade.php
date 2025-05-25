 @extends('admin.home')
    @section('content')
        <div class="container" style="margin-top: 100px;">
            {{-- Bloc collapsible --}}
            <div id="ui-basic" class="collapse">
                <!-- Ici tu peux ajouter du contenu caché qui s'affichera quand on clique sur le lien -->
            </div>

            {{-- Tableaux des entreprises valides --}}
            <h2>Entreprises valides ({{ $valides->count() }})</h2>
            <form action="{{ url()->current() }}" method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Rechercher par nom" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
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
                    @forelse($valides as $recruteur)
                        <tr>
                            <td>{{ $recruteur->user->nom }}</td>
                            <td>{{ $recruteur->user->email }}</td>
                            <td>{{ $recruteur->nom_entreprise }}</td>
                            <td>
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
    </div>
@endsection