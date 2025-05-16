@extends('admin.home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Offres Rejetées <span class="badge badge-danger">{{ $offres->count() }}</span></h2>
            </div>

            @if($offres->isEmpty())
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Aucune offre rejetée</h4>
                        <p>Vous n'avez rejeté aucune offre pour le moment</p>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($offres as $offre)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="card-title mb-0">{{ $offre->sujet }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Entreprise:</strong> {{ $offre->recruteur->nom_entreprise }}</p>
                                    <p><strong>Publiée le:</strong> {{ $offre->created_at->format('d/m/Y') }}</p>
                                    <p><strong>Domaine:</strong> {{ $offre->domaine }}</p>
                                    <p><strong>Spécialité:</strong> {{ $offre->specialite }}</p>
                                    <p><strong>Lieu:</strong> {{ $offre->lieu }}</p>
                                    <p><strong>Durée:</strong> {{ $offre->duree }} mois</p>
                                    <p class="card-text">{{ Str::limit($offre->description, 150) }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <form action="{{ route('offres.valider', $offre->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block">
                                                <i class="mdi mdi-check"></i> Valider
                                            </button>
                                        </form>
                                    </div>
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
