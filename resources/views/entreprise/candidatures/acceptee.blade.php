@extends('entreprise.home')
@section('content')
<div class="container py-4 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-check-circle text-success me-2"></i> Candidatures acceptées</h2>
        <div class="d-flex align-items-center">
            <span class="badge bg-success me-3">
                <i class="fas fa-check-circle"></i> {{ $count }} acceptée(s)
            </span>
            <a href="{{ route('mes-offres') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-1"></i> Retour aux offres
            </a>
        </div>
    </div>

    <div class="card bg-dark border-0">
        <div class="card-body">
            @if($candidatures->isEmpty())
                <div class="alert alert-dark text-center py-5">
                    <i class="fas fa-inbox fa-3x mb-3 text-success"></i>
                    <h4 class="text-white">Aucune candidature acceptée</h4>
                    <p class="text-white-50">Aucune candidature n'a encore été acceptée pour cette offre</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead class="bg-success">
                            <tr>
                                <th>Étudiant</th>
                                <th>Email</th>
                                <th>CV</th>
                                <th>Acceptée le</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidatures as $candidature)
                            <tr>
                                <td>{{ $candidature->etudiant->utilisateur->nom }}</td>
                                <td>{{ $candidature->etudiant->utilisateur->email }}</td>
                                <td>
                                    <a href="{{ Storage::url($candidature->cv_path) }}" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-light">
                                        <i class="fas fa-eye me-1"></i> Voir CV
                                    </a>
                                </td>
                                <td>{{ $candidature->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i> Acceptée
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-white-50">
                        Affichage de <strong>{{ $candidatures->firstItem() }}</strong> à 
                        <strong>{{ $candidatures->lastItem() }}</strong> sur 
                        <strong>{{ $candidatures->total() }}</strong>
                    </div>
                    {{ $candidatures->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table-dark {
        --bs-table-bg: #1a1a2e;
        --bs-table-striped-bg: #252836;
        --bs-table-hover-bg: #2a2d3a;
        border-color: #3a3d4d;
    }
    .table-dark thead th {
        background-color: #28a745;
        color: white;
    }
    .pagination .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
    }
    .pagination .page-link {
        color: #ffffff;
        background-color: #252836;
        border: 1px solid #3a3d4d;
    }
    .pagination .page-link:hover {
        background-color: #2a2d3a;
    }
</style>

@endsection

@include('admin.script')