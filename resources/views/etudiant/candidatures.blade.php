@extends('etudiant.home')

@section('content')
<!-- Main content -->
<div class="main-panel text-white">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4">Mes Candidatures</h2>
        <p>Bienvenue, {{ Auth::user()->name }}</p>

        <div class="card">
          <div class="card-body">
            @if($candidatures->isEmpty())
              <div class="empty-message">
                <div class="alert alert-info text-center">
                  <i class="fas fa-info-circle fa-2x mb-3"></i>
                  <h4>Vous n'avez postulé à aucune offre pour le moment</h4>
                  <a href="{{ route('offres.disponibles') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-search"></i> Voir les offres disponibles
                  </a>
                </div>
              </div>
            @else
              <div class="table-responsive text-white">
                <table class="table table-striped table-secondary text-white" style="cursor: default;">
                  <thead class="thead-white">
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
                      <tr class="no-hover">
                          <td>{{ $candidature->offre->sujet }}</td>
                          <td>{{ $candidature->offre->recruteur->nom_entreprise }}</td>
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
                              <a href="{{ Storage::url($candidature->cv_path) }}" 
                                 class="btn btn-sm btn-info"
                                 target="_blank">
                                  <i class="fas fa-file-alt"></i> Voir CV
                              </a>
                          </td>
                          <!--<td>
                                  <a href="{{ Storage::url($candidature->cv_path) }}" 
                                     target="_blank"
                                     class="btn btn-sm btn-outline-primary">
                                      <i class="fas fa-eye"></i> Voir CV
                                  </a>
                              </td>
                      </tr>-->
                      @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                  {{ $candidatures->links() }}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
