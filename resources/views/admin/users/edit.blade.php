@extends('admin.home')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-user-edit mr-2"></i>Modifier l'utilisateur
            </h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT') <!-- Pour une requête PUT -->

                <!-- Nom -->
                <div class="form-group">
                    <label for="nom" class="font-weight-bold">Nom et prénom *</label>
                    <input id="nom" type="text" name="nom" value="{{ old('nom', $user->nom) }}"
                           class="form-control @error('nom') is-invalid @enderror"
                           style="color: white; background-color: #2c2c2c;" required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email *</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="form-control @error('email') is-invalid @enderror"
                           style="color: white; background-color: #2c2c2c;" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rôle -->
                <div class="form-group">
                    <label for="role" class="font-weight-bold">Vous êtes *</label>
                    <select id="role" name="role"
                            class="form-control custom-select @error('role') is-invalid @enderror"
                            required>
                        <option value="">-- Sélectionnez un rôle --</option>
                        <option value="entreprise" {{ old('role', $user->role) == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                        <option value="etudiant" {{ old('role', $user->role) == 'etudiant' ? 'selected' : '' }}>Étudiant(e)</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Nouveau mot de passe (laisser vide si inchangé)</label>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           style="color: white; background-color: #2c2c2c;">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="form-group">
                    <label for="password_confirmation" class="font-weight-bold">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="form-control"
                           style="color: white; background-color: #2c2c2c;">
                </div>

                <!-- Boutons -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary ml-2">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    select.custom-select option {
        color: #e9e3e3 !important;
        font-weight: normal !important;
    }

    select.custom-select {
        color: #acabab !important;
    }
</style>
@endsection
