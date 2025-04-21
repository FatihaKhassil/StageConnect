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
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="container mx-auto p-6">
                <h1 class="text-2xl font-bold mb-6">Gestion des Utilisateurs</h1>
          
                <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                  <table class="min-w-full divide-y divide-black-100 text-sm text-black"> <!-- Ajout de text-black ici -->
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                      <tr>
                        <th class="px-6 py-3 text-left text-black">Nom</th>
                        <th class="px-6 py-3 text-left text-black">Email</th>
                        <th class="px-6 py-3 text-left text-black">Rôle</th>
                        <th class="px-6 py-3 text-center text-black">Actions</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                      @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                          <td class="px-6 py-4 text-black">{{ $user->nom }}</td>
                          <td class="px-6 py-4 text-black">{{ $user->email }}</td>
                          <td class="px-6 py-4 capitalize text-black">{{ $user->role }}</td>
                          <td class="px-6 py-4 text-center space-x-2">
                            <a href="#" class="text-blue-500 hover:underline">Voir</a>
                            
                            <!-- Bloquer/Débloquer -->
                            <form action="{{ route('admin.users.toggle-block', $user) }}" method="POST" class="inline">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="text-sm text-black px-2 py-1 rounded {{ $user->is_blocked ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                {{ $user->is_blocked ? 'Débloquer' : 'Bloquer' }}
                              </button>
                            </form>
          
                            <!-- Supprimer -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-sm text-black bg-gray-700 hover:bg-gray-800 px-2 py-1 rounded">
                                Supprimer
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="p-4">
                    {{ $users->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
