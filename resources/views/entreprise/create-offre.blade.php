@extends('entreprise.home')
@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-plus-circle mr-2"></i>Nouvelle Offre de PFE
            </h4>
        </div>
        
        <div class="card-body">
            <form action="{{ route('offres.store') }}" method="POST">
                @csrf

                <!-- Sujet -->
                <div class="form-group">
                    <label for="sujet" class="font-weight-bold">Sujet du PFE *</label>
                    <input type="text" class="form-control @error('sujet') is-invalid @enderror" 
                    id="sujet" name="sujet" value="{{ old('sujet') }}" required
                    style="color: white; background-color: #2c2c2c;" required>
                    @error('sujet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Domaine et Spécialité -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="domaine" class="font-weight-bold">Domaine *</label>
                            <select class="form-control custom-select @error('domaine') is-invalid @enderror" 
                                    id="domaine" name="domaine" required>
                                <option value="">Sélectionnez un domaine</option>
                                @foreach($domaines as $domaine)
                                    <option value="{{ $domaine }}" {{ old('domaine') == $domaine ? 'selected' : '' }}>
                                        {{ $domaine }}
                                    </option>
                                @endforeach
                            </select>
                            @error('domaine')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="specialite" class="font-weight-bold">Spécialité *</label>
                           <select class="form-control custom-select @error('specialite') is-invalid @enderror"
        id="specialite" name="specialite" required>
    <option value="">Sélectionnez une spécialité</option>
    @foreach($specialites as $domaine => $liste)
        <optgroup label="{{ $domaine }}">
            @foreach($liste as $spec)
                <option value="{{ $spec }}" {{ old('specialite') == $spec ? 'selected' : '' }}>
                    {{ $spec }}
                </option>
            @endforeach
        </optgroup>
    @endforeach
</select>

                            @error('specialite')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Lieu et Durée -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lieu" class="font-weight-bold">Ville *</label>
                            <select class="form-control custom-select @error('lieu') is-invalid @enderror" 
                                    id="lieu" name="lieu" required>
                                <option value="">Sélectionnez une ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville }}" {{ old('lieu') == $ville ? 'selected' : '' }}>
                                        {{ $ville }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lieu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duree" class="font-weight-bold">Durée (mois) *</label>
                            <select class="form-control custom-select @error('duree') is-invalid @enderror" 
                                    id="duree" name="duree" required>
                                <option value="">Sélectionnez une durée</option>
                                @foreach($durees as $key => $value)
                                   <option value="{{ $key }}" {{ old('duree') == $key ? 'selected' : '' }}>
                                         {{ $value }}
                                   </option>
                                @endforeach
                            </select>
                            @error('duree')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description détaillée *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="5" style="color: white; background-color: #2c2c2c;"
                              required >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Informations complémentaires -->
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i>
                    Cette offre sera soumise à validation par l'administration avant publication.
                    Statut initial: <span class="badge badge-warning">En attente</span>
                </div>

                <!-- Boutons -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane mr-2"></i>Soumettre l'offre
                    </button>
                    <a href="{{ route('mes-offres') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styles pour changer la couleur du texte des options à blanc */
    select.custom-select option {
        color: #e9e3e3 !important;
        font-weight: normal !important;
    }
    
    select.custom-select {
        color: #acabab !important;
    }
</style>
@endsection