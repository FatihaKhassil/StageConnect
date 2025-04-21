<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;

class AdminController extends Controller
{
public function index()
{
    $users = User::paginate(20); // Tu peux aussi filtrer ici selon le rôle ou le statut
    return view('admin.users', compact('users'));
}
 // Bloquer ou débloquer un utilisateur
 public function toggleBlock(User $user)
 {
     $user->is_blocked = !$user->is_blocked;
     $user->save();

     return redirect()->route('admin.users.index')->with('success', 'Statut mis à jour avec succès.');
 }

 // Supprimer un utilisateur
 public function destroy(User $user)
 {
     $user->delete();
     return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé.');
 }
}

