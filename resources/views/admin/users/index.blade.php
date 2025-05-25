@extends('admin.home')
     @section('content')
      <div class="container" id="ui-basic">
        <h2>Liste des utilisateurs</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Ajouter</a>

        <table class="table" >
          <thead>
            <tr>
              <th style="width: 40%">Email</th>
              <th style="width: 15%">Nom complet</th>
              <th style="width: 15%">Rôle</th>
              <th style="width: 30%">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td>
                  <div class="user-info">
                   
                    <div class="user-email">{{ $user->email }}</div>
                  </div>
                </td>
                <td>{{ $user->nom }}</td>
                <td>{{ $user->role }}</td>
                <td>
                  <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
@endsection
