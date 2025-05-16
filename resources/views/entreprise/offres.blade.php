@extends('entreprise.home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Mes Offres de Stage</h2>
                @if(!$offres->isEmpty())
                <a href="{{ route('offres.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus"></i> Ajouter une offre
                </a>
                @endif
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($offres->isEmpty())
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Vous n'avez pas encore publié d'offres</h4>
                        <p>Commencez par créer votre première offre de stage</p>
                        <a href="{{ route('offres.create') }}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Créer une offre
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($offres as $offre)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-{{ $offre->statut_offre === 'validee' ? 'success' : 'warning' }}">
                                    <h5 class="card-title mb-0 text-white">{{ $offre->sujet }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Domaine:</strong> {{ $offre->domaine }}</p>
                                    <p><strong>Spécialité:</strong> {{ $offre->specialite }}</p>
                                    <p><strong>Lieu:</strong> {{ $offre->lieu }}</p>
                                    <p><strong>Durée:</strong> {{ $offre->duree }} mois</p>
                                    <p class="card-text">{{ Str::limit($offre->description, 150) }}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <span class="badge badge-{{ $offre->statut === 'validee' ? 'success' : 'warning' }}">
                                        {{ $offre->statut === 'validee' ? 'Validée' : 'En attente' }}
                                    </span>
                                    <a href="{{ route('entreprise.candidatures.en_attente', $offre->id) }}" class="btn btn-sm btn-info">
                                        Voir candidatures
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection