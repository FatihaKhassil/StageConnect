@extends('entreprise.home')
@section('content')
<div class="container py-4 text-white">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-times-circle text-danger me-2"></i> Candidatures rejetées</h2>
        <div class="d-flex align-items-center">
            <span class="badge bg-danger me-3">
                <i class="fas fa-ban"></i> {{ $count }} rejet(s)
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
                    <i class="fas fa-inbox fa-3x mb-3 text-danger"></i>
                    <h4 class="text-white">Aucune candidature rejetée</h4>
                    <p class="text-white-50">Aucune candidature n'a encore été rejetée pour cette offre</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead class="bg-danger">
                            <tr>
                                <th>Étudiant</th>
                                <th>Email</th>
                                <th>CV</th>
                                <th>Rejetée le</th>
                                <th>Feedback</th>
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
                                    @if($candidature->feedback)
                                        <button class="btn btn-sm btn-outline-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#feedbackModal{{ $candidature->id }}">
                                            <i class="fas fa-comment-alt me-1"></i> Lire
                                        </button>
                                    @else
                                        <span class="text-muted">Aucun feedback</span>
                                    @endif
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

@foreach($candidatures as $candidature)
@if($candidature->feedback)
<!-- Modal pour le feedback -->
<div class="modal fade" id="feedbackModal{{ $candidature->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-danger">
                <h5 class="modal-title">
                    <i class="fas fa-comment-dots text-danger me-2"></i>
                    Feedback pour {{ $candidature->etudiant->utilisateur->nom }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Candidature rejetée le {{ $candidature->updated_at->format('d/m/Y à H:i') }}
                </div>
                <div class="bg-secondary p-3 rounded">
                    <p class="mb-0">{{ $candidature->feedback }}</p>
                </div>
            </div>
            <div class="modal-footer border-danger">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

<style>
    .table-dark {
        --bs-table-bg: #1a1a2e;
        --bs-table-striped-bg: #252836;
        --bs-table-hover-bg: #2a2d3a;
        border-color: #3a3d4d;
    }
    .table-dark thead th {
        background-color: #dc3545;
        color: white;
    }
    .pagination .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
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