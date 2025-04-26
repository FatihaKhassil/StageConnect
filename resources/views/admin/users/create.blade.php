<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style type="text/css">
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @include('admin.layouts.navbar')
        <!-- partial -->
        <div class="min-h-screen bg-black-100 flex items-center justify-center  pb-12"> <!-- Ajout de pt-12 pour décaler vers le bas -->
            <div class="w-full 50-w-lg bg-white rounded-lg shadow-md p-8"> <!-- Augmentation de la largeur avec max-w-lg -->
                @if(session('success'))
                     <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                     {{ session('success') }}
            </div>
               @endif
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter un utilisateur</h2>
                
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
                    @csrf
        
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom et prénom :</label>
                        <input id="nom" class="w-full px-4 py-2 border text-gray-700 rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
                    </div>
        
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email :</label>
                        <input id="email" class="w-full px-4 py-2 border text-gray-700  rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>
                    
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Vous êtes :</label>
                        <select id="role" name="role" class="w-full px-4 py-2 border text-gray-700  rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Sélectionnez un rôle --</option>
                            <option value="entreprise">Entreprise</option>
                            <option value="etudiant">Étudiant(e)</option>
                        </select>
                    </div>
        
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe :</label>
                        <input id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    </div>
        
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe :</label>
                        <input id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
            
                    <div class="flex items-center justify-between pt-4">
                        <a class="text-sm text-indigo-600 hover:text-indigo-500" href="{{ route('login') }}">
                            Déjà inscrit?
                        </a>
            
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            ENREGISTRER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>