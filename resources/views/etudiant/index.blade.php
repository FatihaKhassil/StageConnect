@extends('etudiant.home')

@section('content')
<div class="container py-4">
    <!-- Barre de recherche/filtres -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('offres.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="domaine" class="form-control">
                            <option value="">Tous domaines</option>
                            @foreach(App\Models\OffrePFE::$domaines as $domaine)
                                <option value="{{ $domaine }}" {{ request('domaine') == $domaine ? 'selected' : '' }}>{{ $domaine }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="lieu" class="form-control">
                            <option value="">Tous lieux</option>
                            @foreach(App\Models\OffrePFE::$villes as $ville)
                                <option value="{{ $ville }}" {{ request('lieu') == $ville ? 'selected' : '' }}>{{ $ville }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block">Filtrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des offres -->
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <div class="row">
        @forelse($offres as $offre)
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $offre->sujet }}</h5>
                    <span class="badge badge-secondary">{{ $offre->recruteur->entreprise->nom ?? 'Entreprise' }}</span>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <span class="text-muted mr-3"><i class="fas fa-map-marker-alt"></i> {{ $offre->lieu }}</span>
                        <span class="text-muted"><i class="far fa-clock"></i> {{ App\Models\OffrePFE::$durees[$offre->duree] }}</span>
                    </div>
                    
                    <h6 class="text-primary">
                        <i class="fas fa-tag"></i> {{ $offre->domaine }}
                        @if($offre->specialite)
                            <small class="text-muted">({{ $offre->specialite }})</small>
                        @endif
                    </h6>
                    
                    <div class="mb-3">
                        <strong>Description :</strong>
                        <p class="mt-1">{{ Str::limit($offre->description, 150) }}</p>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Publiée {{ $offre->created_at->diffForHumans() }}</small>
                        
                        @auth
                            @if(auth()->user()->isEtudiant())
                                @if($offre->candidatures->contains('etudiant_id', auth()->id()))
                                    <span class="badge badge-info">Déjà postulé</span>
                                @else
                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#postulerModal{{ $offre->id }}">
                                        <i class="fas fa-paper-plane"></i> Postuler
                                    </button>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de candidature -->
        <div class="modal fade" id="postulerModal{{ $offre->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Postuler à {{ $offre->sujet }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('candidatures.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="offre_id" value="{{ $offre->id }}">
                        
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Votre CV (PDF uniquement, max 2MB)</label>
                                <input type="file" class="form-control-file" name="cv" required accept=".pdf">
                            </div>
                            
                            <div class="form-group">
                                <label>Lettre de motivation (optionnelle)</label>
                                <textarea class="form-control" name="motivation" rows="4" placeholder="Pourquoi êtes-vous intéressé par cette offre?"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Aucune offre disponible pour le moment.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $offres->appends(request()->query())->links() }}
    </div>
</div>
@endsection