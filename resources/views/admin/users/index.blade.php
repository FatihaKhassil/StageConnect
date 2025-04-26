<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
   <style type="text/css">
    .users-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        width: 100%;
        background-color: #19191b;
    }
    
    .space-before-table {
        height: 5cm; /* Espace de 5cm avant le tableau */
        width: 100%;
    }
    
    .table-wrapper {
        width: 80%;
        max-width: 1200px;
        background-color: #ffffff;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .table-title {
        color: #6a7286;
        font-size: 20px;
        margin: 0;
    }
    
    .add-user-btn {
        background-color: #34c759;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }
    
    .users-table {
        width: 100%;
        border-collapse: collapse;
        color: #ffffff;
        background-color: #0b0c0d;
    }
    
    .users-table th {
        text-align: left;
        padding: 15px 10px;
        border-bottom: 1px solid #fcfcfc;
        font-weight: 500;
        font-size: 14px;
        color: #f6f2f2;
    }
    
    .users-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #fcfcff;
        vertical-align: middle;
        font-size: 14px;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        margin-right: 10px;
        background-color: #2d303a;
    }
    
    .user-email {
        color: #e4e6eb;
    }
    
    .status-badge {
        background-color: rgba(52, 199, 89, 0.2);
        color: #34c759;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
    }
    
    .edit-link {
        color: #5c6bc0;
        text-decoration: none;
        font-weight: 500;
    }
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layouts.sidebar')
      <!-- partial -->
      @include('admin.layouts.navbar')
        <!-- partial -->
        <!-- Supposons que ce code sera intégré dans un template où $users est disponible -->
        <div class="users-container">
            <div class="space-before-table"></div>
            <div class="table-wrapper">
                <div class="table-header">
                    <h1 class="table-title">Liste des utilisateurs</h1>
                    <a href="{{ route('admin.users.create') }}" class="add-user-btn">Ajouter</a>
                </div>                             
                <table class="users-table">
                    <thead>
                        <tr>
                            <th style="width: 40%">Email</th>
                            
                            <th style="width: 15%">Nom complet</th>
                            <th style="width: 15%">Role</th>
                            <th style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <img src="{{ $user->avatar_url ?? '/assets/default-avatar.png' }}" alt="{{ $user->email }}" class="avatar">
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->role }}</td> 
                            <div class="user-info">                   
                            
                            <td><a href="{{ route('admin.users.edit', $user->id) }}" class="edit-link">modifier</a></td>
                            <td><a href="{{ route('admin.users.destroy', $user->id) }}" class="edit-link">supprimer</a></td>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
