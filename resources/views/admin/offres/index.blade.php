@extends('admin.home')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <!-- Titre amélioré dans un cadre noir -->
            <div class="bg-dark text-white p-3 rounded mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0 font-weight-bold">Offres de stage disponibles</h2>
                    <span class="badge badge-light text-dark">{{ $offres->total() }} offres</span>
                </div>
            </div>
            
            <!-- Filtres avec fond blanc -->
            <div class="card mb-4 bg-white border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-dark">Filtrer les offres</h5>
                </div>
                <div class="card-body bg-white">
                    <form method="GET" action="{{ route('offres.disponibles') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group text-dark">
                                    <label for="domaine">Domaine</label>
                                    <select name="domaine" id="domaine" class="form-control text-white">
                                        <option value="">Tous les domaines</option>
                                        @foreach(App\Models\OffrePFE::$domaines as $domaine)
                                            <option value="{{ $domaine }}" {{ request('domaine') == $domaine ? 'selected' : '' }}>{{ $domaine }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <div class="form-group text-dark">
                                 <label for="specialite">Spécialité</label>
                                   <select name="specialite" id="specialite" class="form-control text-white">
                                     <option value="">Toutes les spécialités</option>
                                     @foreach(App\Models\OffrePFE::getSpecialitesByDomaine(request('domaine')) as $spec)
                                      <option value="{{ $spec }}" {{ request('specialite') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
                                     @endforeach
                                   </select>
                              </div>
                           </div>
                            <div class="col-md-3">
                                <div class="form-group text-dark">
                                    <label for="lieu">Lieu</label>
                                    <select name="lieu" id="lieu" class="form-control text-white">
                                        <option value="">Tous les lieux</option>
                                        @foreach(App\Models\OffrePFE::$villes as $ville)
                                            <option value="{{ $ville }}" {{ request('lieu') == $ville ? 'selected' : '' }}>{{ $ville }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group text-dark">
                                    <label for="duree">Durée (mois)</label>
                                    <select name="duree" id="duree" class="form-control text-white">
                                        <option value="">Toutes les durées</option>
                                        @foreach(App\Models\OffrePFE::$durees as $key => $value)
                                            <option value="{{ $key }}" {{ request('duree') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Filtrer</button>
                                <a href="{{ route('offres.disponibles') }}" class="btn btn-secondary">Réinitialiser</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($offres->isEmpty())
                <div class="card bg-white border-0 shadow-sm text-dark" >
                    <div class="card-body text-center">
                        <h4>Aucune offre disponible pour le moment</h4>
                        <p>Veuillez vérifier plus tard ou ajuster vos critères de recherche</p>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($offres as $offre)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm bg-white">
                                <div class="card-header bg-success">
                                    <h5 class="card-title mb-0 text-white">{{ $offre->sujet }}</h5>
                                </div>
                                <div class="card-body bg-white text-dark">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">
                                            <i class="mdi mdi-office-building"></i> {{ $offre->recruteur->nom_entreprise }}
                                        </span>
                                        <span class="text-muted ">
                                            <i class="mdi mdi-calendar "></i> {{ $offre->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <p><strong>Domaine:</strong> {{ $offre->domaine }}</p>
                                    <p><strong>Spécialité:</strong> {{ $offre->specialite }}</p>
                                    <p><strong>Lieu:</strong> {{ $offre->lieu }}</p>
                                    <p><strong>Durée:</strong> {{ $offre->duree }} mois</p>
                                    <p class="card-text">{{ Str::limit($offre->description, 150) }}</p>
                                </div>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#postulerModal{{ $offre->id }}">
                                                    Postuler</button>
                                    <a href="{{ route('admin.offres.show', $offre->id) }}" class="btn btn-sm btn-outline-secondary text-dark">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de postulation -->
                        <div class="modal fade" id="postulerModal{{ $offre->id }}" tabindex="-1" role="dialog" aria-labelledby="postulerModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="postulerModalLabel">Postuler à cette offre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('postuler', $offre->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="cv">Votre CV (PDF uniquement, max 2MB)</label>
                                                <input type="file" class="form-control-file" id="cv" name="cv" accept=".pdf" required>
                                            </div>
                                            <p class="text-muted">Votre candidature sera envoyée à {{ $offre->recruteur->nom_entreprise }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination avec compteur -->
                <div class="d-flex justify-content-between align-items-center mt-4 bg-white p-3 rounded shadow-sm">
                    <div class="text-muted">
                        Affichage de {{ $offres->firstItem() }} à {{ $offres->lastItem() }} sur {{ $offres->total() }} offres
                    </div>
                    {{ $offres->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Données des spécialités par domaine
    const specialitesParDomaine = @json(App\Models\OffrePFE::$specialites);
    
    // Fonction pour mettre à jour les spécialités
    function updateSpecialites() {
        const domaine = $('#domaine').val();
        const specialiteSelect = $('#specialite');
        const currentSpecialite = "{{ request('specialite') }}";
        
        // Vider et réinitialiser le select
        specialiteSelect.empty().append('<option value="">Toutes les spécialités</option>');
        
        // Récupérer les spécialités appropriées
        let specialites = [];
        if (domaine && specialitesParDomaine[domaine]) {
            specialites = specialitesParDomaine[domaine];
        } else {
            // Si aucun domaine ou domaine inconnu, afficher toutes
            Object.values(specialitesParDomaine).forEach(specs => {
                specialites = specialites.concat(specs);
            });
            specialites = [...new Set(specialites)]; // Supprimer les doublons
        }
        
        // Ajouter les options
        specialites.forEach(spec => {
            const selected = currentSpecialite === spec ? 'selected' : '';
            specialiteSelect.append(`<option value="${spec}" ${selected}>${spec}</option>`);
        });
    }
    
    // Mettre à jour au chargement si un domaine est sélectionné
    if ($('#domaine').val()) {
        updateSpecialites();
    }
    
    // Écouter les changements de domaine
    $('#domaine').change(updateSpecialites);
});
</script>
@endpush