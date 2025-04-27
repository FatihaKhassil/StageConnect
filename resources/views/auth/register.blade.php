<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <div class="flex flex-col items-center" style="gap: 4px;">
                <img src="{{ asset('photo/LOGO.png') }}" alt="Votre Logo" style="width: 2cm; height: 2cm;" />
                <h1 style="font-size: 25px; margin: 0; font-weight: bold; line-height: 1;">
                    <span style="color: #111;">Stage</span><span style="color: rgb(196, 110, 236);">Connect</span>
                </h1>
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="nom" value="{{ __('Nom et prénom :') }}" />
                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email :') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            
            <div class="mt-4">
                <x-label for="role" value="{{ __('Vous êtes :') }}" />
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Sélectionnez votre rôle --</option>
                    <option value="entreprise">Entreprise</option>
                    <option value="etudiant">Étudiant(e)</option>
                </select>
            </div>
            <div id="entreprise-name-field" class="mt-4 hidden">
                <x-label for="nom_entreprise" value="{{ __('Entreprise :') }}" />
                <x-input id="nom_entreprise" class="block mt-1 w-full" type="text" name="nom_entreprise" :value="old('nom_entreprise')" />
            </div>
            <div id="entreprise-adresse-field" class="mt-4 hidden">
                <x-label for="adresse" value="{{ __('Adresse :') }}" />
                <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" />
            </div>
            <div id="secteur-field" class="mt-4 hidden">
                <x-label for="secteur" value="{{ __('Secteur :') }}" />
                <select id="secteur" name="secteur" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">>
                    <option value="">-- Sélectionner un secteur --</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Banque">Banque</option>
                    <option value="Santé">Santé</option>
                    <option value="Éducation">Éducation</option>
                    <option value="Industrie">Industrie</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>
            
            
        
            

            <div class="mt-4">
                <x-label for="password" value="{{ __('Mot de passe :') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmer le mot de passe :') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <!-- Champ Nom Entreprise -->
<div id="entreprise-name-field" class="mt-4 hidden">
    <x-label for="nom_entreprise" value="{{ __('Entreprise :') }}" />
    <x-input id="nom_entreprise" class="block mt-1 w-full" type="text" name="nom_entreprise" :value="old('nom_entreprise')" />
</div>

<!-- Champ Adresse Entreprise -->
<div id="entreprise-adresse-field" class="mt-4 hidden">
    <x-label for="adresse" value="{{ __('Adresse de l\'entreprise :') }}" />
    <x-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" />
</div>

<!-- Script pour afficher/cacher les champs -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const entrepriseNameField = document.getElementById('entreprise-name-field');
    const entrepriseAdresseField = document.getElementById('entreprise-adresse-field');
    const secteurField = document.getElementById('secteur-field');  // Utilise secteur-field ici

    function toggleEntrepriseFields() {
        if (roleSelect.value === 'entreprise') {
            entrepriseNameField.classList.remove('hidden');
            entrepriseAdresseField.classList.remove('hidden');
            secteurField.classList.remove('hidden');  // Affiche le secteur
        } else {
            entrepriseNameField.classList.add('hidden');
            entrepriseAdresseField.classList.add('hidden');
            secteurField.classList.add('hidden');  // Cache le secteur
        }
    }

    roleSelect.addEventListener('change', toggleEntrepriseFields);
    // pour gérer le cas où la page recharge (ex : erreur validation)
    toggleEntrepriseFields();
});

</script>
    </x-authentication-card>
</x-guest-layout>

