@extends('etudiant.home')
      @section('content')
      <!-- Main content -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12">
              <h2 class="mb-4">Mes Candidatures</h2>
              <p>Bienvenue, {{ Auth::user()->name }}</p>

              <div class="card">
                <div class="card-body">
                  @if($candidatures->isEmpty())
                    <div class="empty-message">
                      <div class="alert alert-info">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <h4>Vous n'avez postulé à aucune offre pour le moment</h4>
                        <a href="{{ route('offres.index') }}" class="btn btn-primary mt-3">
                          <i class="fas fa-search"></i> Voir les offres disponibles
                        </a>
                      </div>
                    </div>
                  @else
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <!-- Table content remains the same -->
                        <thead>
                            <tr>
                                <th>Offre</th>
                                <th>Entreprise</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidatures as $candidature)
                            <tr>
                                <td>
                                    <a href="{{ route('offres.show', $candidature->offre) }}">
                                        {{ $candidature->offre->sujet }}
                                    </a>
                                </td>
                                <td>{{ $candidature->offre->recruteur->entreprise->nom }}</td>
                                <td>{{ $candidature->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($candidature->statut == 'acceptee') bg-success
                                        @elseif($candidature->statut == 'rejetee') bg-danger
                                        @else bg-warning text-dark @endif">
                                        {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('candidatures.show', $candidature) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      {{ $candidatures->links() }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection