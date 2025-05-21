@extends('entreprise.home')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3>{{ $offre->sujet }}</h3>
            <p class="mb-0">
                <i class="mdi mdi-office-building"></i>{{ $offre->recruteur->nom_entreprise }} 
                <span class="mx-2">|</span>
                <i class="mdi mdi-calendar"></i> Publiée le {{ $offre->created_at->format('d/m/Y') }}
            </p>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Domaine :</strong> {{ $offre->domaine }}</p>
                    <p><strong>Spécialité :</strong> {{ $offre->specialite }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Lieu :</strong> {{ $offre->lieu }}</p>
                    <p><strong>Durée :</strong> {{ $offre->duree }} mois</p>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Description :</h5>
                <p class="text-justify">{{ $offre->description }}</p>
            </div>
            
            @if($offre->candidatures->count())
                <div class="mt-4">
                    <h5>{{ $offre->candidatures->count() }} Candidature(s)</h5>
                    <!-- Liste des candidatures -->
                </div>
            @endif
        </div>
        
        <div class="card-footer bg-white d-flex justify-content-between">
            <a href="{{ route('offres.disponibles') }}" class="btn btn-outline-secondary  text-dark">
                <i class="mdi mdi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</div>


@endsection