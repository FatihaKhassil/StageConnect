@extends('entreprise.home')
        @section('content')
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-check-circle text-success"></i> Candidatures acceptées</h2>
                <a href="{{ route('mes-offres') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux offres
                </a>
            </div>
        
                <div class="card-body">
                    @if($candidatures->isEmpty())
                        <div class="alert alert-info text-center py-5">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <h4>Aucune candidature acceptée</h4>
                            <p class="text-muted">Aucune candidature n'a encore été acceptée pour cette offre</p>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ $count }} candidature(s) acceptée(s)
                        </div>
        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <!-- Même structure que en_attente.blade.php mais sans boutons d'action -->
                                <thead class="table-light">
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
                                        <td>{{ $candidature->etudiant->user->name }}</td>
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
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Acceptée
                                            </span>
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