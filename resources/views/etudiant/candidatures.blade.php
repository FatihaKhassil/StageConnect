@extends('etudiant.home')

@section('content')
<!-- Main content -->
<div class="main-panel">
  <div class="content-wrapper" style="background-color: rgb(106, 73, 110);">
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4 text-white">Mes Candidatures</h2>
        <p class="text-light">Bienvenue, {{ Auth::user()->name }}</p>

        <div class="card" style="background-color: rgb(106, 73, 110); border: none;">
          <div class="card-body">
            @if($candidatures->isEmpty())
              <div class="empty-message">
                <div class="alert alert-info text-center" style="background-color: rgb(106, 73, 110); border-color: #6c5ce7;">
                  <i class="fas fa-info-circle fa-2x mb-3" style="color: #6c5ce7;"></i>
                  <h4 class="text-white">Vous n'avez postulé à aucune offre pour le moment</h4>
                  <a href="{{ route('offres.disponibles') }}" class="btn btn-primary mt-3" style="background-color: #6c5ce7; border: none;">
                    <i class="fas fa-search"></i> Voir les offres disponibles
                  </a>
                </div>
              </div>
            @else
              <div class="table-responsive">
                <table class="table text-white" style="background-color: #252836;">
                  <thead style="background-color: #1a1a2e;">
                      <tr>
                          <th class="text-light">Offre</th>
                          <th class="text-light">Entreprise</th>
                          <th class="text-light">Date</th>
                          <th class="text-light">Statut</th>
                          <th class="text-light">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($candidatures as $candidature)
                      <tr style="border-bottom: 1px solid #3a3d4d;">
                          <td class="text-light">{{ $candidature->offre->sujet }}</td>
                          <td class="text-light">{{ $candidature->offre->recruteur->nom_entreprise }}</td>
                          <td class="text-light">{{ $candidature->created_at->format('d/m/Y') }}</td>
                          <td>
                              <span class="badge 
                                  @if($candidature->statut == 'acceptee') bg-success
                                  @elseif($candidature->statut == 'rejetee') bg-danger
                                  @else bg-warning text-dark @endif"
                                  style="font-size: 0.9rem; padding: 0.35em 0.65em;">
                                  {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                              </span>
                          </td>
                          <td>
                              <a href="{{ Storage::url($candidature->cv_path) }}" 
                                 class="btn btn-sm"
                                 style="background-color: #6c5ce7; color: white;"
                                 target="_blank">
                                  <i class="fas fa-file-alt"></i> Voir CV
                              </a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                <div class="mt-3">
                  {{ $candidatures->links('pagination::bootstrap-4') }}
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .table-hover tbody tr:hover {
    background-color: rgba(108, 92, 231, 0.1) !important;
  }
  .pagination .page-item.active .page-link {
    background-color: #6c5ce7;
    border-color: #6c5ce7;
  }
  .pagination .page-link {
    color: #6c5ce7;
    background-color: #252836;
    border: 1px solid #3a3d4d;
  }
</style>
@endsection