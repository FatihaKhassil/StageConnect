@extends('entreprise.home')
@section('content')
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-times-circle text-danger"></i> Candidatures rejetées</h2>
                <a href="{{ route('mes-offres') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux offres
                </a>
            </div>
                <div class="card-body">
                    @if($candidatures->isEmpty())
                        <div class="alert alert-info text-center py-5">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <h4>Aucune candidature rejetée</h4>
                            <p class="text-muted">Aucune candidature n'a encore été rejetée pour cette offre</p>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $count }} candidature(s) rejetée(s)
                        </div>
        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
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
                                        <td>{{ $candidature->etudiant->user->email }}</td>
                                        <td>
                                            <a href="{{ Storage::url($candidature->cv_path) }}" 
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i> Voir CV
                                            </a>
                                        </td>
                                        <td>{{ $candidature->updated_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($candidature->feedback)
                                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" 
                                                        title="{{ $candidature->feedback }}">
                                                    <i class="fas fa-comment-alt"></i> Voir
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
                        {{ $candidatures->links() }}
                    @endif
                </div>
            </div>
        </div>
        @endsection
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
