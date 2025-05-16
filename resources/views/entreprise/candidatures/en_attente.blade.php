@extends('entreprise.home')
@section('content')
        <div class="container">
          <div class="d-flex justify-content-between align-items-center mb-4">
              <h2><i class="fas fa-clock text-warning"></i> Candidatures en attente</h2>
              <a href="{{ route('mes-offres') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-arrow-left"></i> Retour aux offres
              </a>
          </div>

          @if($candidatures->isEmpty())
              <div class="alert alert-info text-center py-5">
                  <i class="fas fa-inbox fa-3x mb-3"></i>
                  <h4>Aucune candidature en attente</h4>
                  <p class="text-muted">Toutes les candidatures ont été traitées</p>
              </div>
          @else
              <div class="alert alert-warning">
                  <i class="fas fa-exclamation-circle"></i>
                  {{ $count }} candidature(s) nécessitent votre attention
              </div>

              <!-- Ajout d'un formulaire de recherche comme dans le deuxième template -->
              <form action="{{ url()->current() }}" method="GET" class="form-inline mb-3">
                  <input type="text" name="search" class="form-control mr-2" placeholder="Rechercher par étudiant" value="{{ request('search') }}">
                  <button type="submit" class="btn btn-primary">Rechercher</button>
              </form>

              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Étudiant</th>
                              <th>Email</th>
                              <th>CV</th>
                              <th>Postulé le</th>
                              <th>Actions</th>
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
                              <td>{{ $candidature->created_at->format('d/m/Y H:i') }}</td>
                              <td class="action-buttons">
                                  <form action="{{ route('entreprise.candidatures.updateStatut', $candidature) }}" method="POST" style="display:inline;">
                                      @csrf
                                      <input type="hidden" name="statut" value="acceptee">
                                      <button type="submit" class="btn btn-sm btn-success">
                                          <i class="fas fa-check"></i> Accepter
                                      </button>
                                  </form>

                                  <button type="button" 
                                          class="btn btn-sm btn-danger" 
                                          data-bs-toggle="modal"
                                          data-bs-target="#rejetModal{{ $candidature->id }}">
                                      <i class="fas fa-times"></i> Rejeter
                                  </button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              {{ $candidatures->links() }}
          @endif
      </div>

      @foreach($candidatures as $candidature)
      <!-- Modal pour le rejet -->
      <div class="modal fade" id="rejetModal{{ $candidature->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form action="{{ route('entreprise.candidatures.updateStatut', $candidature) }}" method="POST">
                      @csrf
                      <input type="hidden" name="statut" value="rejetee">
                      <div class="modal-header">
                          <h5 class="modal-title">Rejeter la candidature</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <p>Vous êtes sur le point de rejeter la candidature de <strong>{{ $candidature->etudiant->user->name }}</strong>.</p>
                          <div class="mb-3">
                              <label for="feedback{{ $candidature->id }}" class="form-label">Feedback (optionnel)</label>
                              <textarea class="form-control" id="feedback{{ $candidature->id }}" name="feedback" rows="3" placeholder="Raison du rejet..."></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                          <button type="submit" class="btn btn-danger">Confirmer le rejet</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      @endforeach
    </div>
@endsection