@extends('etudiant.home')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Postuler à l'offre</h4>
                    <p class="mb-0">{{ $offre->sujet }}</p>
                    <small>{{ $offre->recruteur->entreprise->nom }} - {{ $offre->lieu }}</small>
                </div>

                <div class="card-body">
                    <form action="{{ route('postuler', $offre) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="cv" class="form-label fw-bold">Importer votre CV (PDF uniquement, max 2MB)*</label>
                            <input type="file" class="form-control @error('cv') is-invalid @enderror" 
                                   id="cv" name="cv" required accept=".pdf">
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Assurez-vous que votre CV est à jour et en format PDF.
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('offres.show', $offre) }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-paper-plane"></i> Envoyer ma candidature
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection