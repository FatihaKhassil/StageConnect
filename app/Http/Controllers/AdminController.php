<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
{
    try {
        // Lève une exception si non connecté
        $users = User::all();
        $user = Auth::user();
        
        return view('admin.users.index', [
            'users' => $users,
            'user' => $user,
        ]);
        
    } catch (\Illuminate\Auth\AuthenticationException $e) {
        return redirect('/login')->with('error', 'Veuillez vous connecter');
    }
}

    public function create()
    {
        try {
            // Lève une exception si non connecté
            $users = User::all();
            $user = Auth::user();
            
            return view('admin.users.create', [
                'users' => $users,
                'user' => $user,
            ]);
            
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            return redirect('/login')->with('error', 'Veuillez vous connecter');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:entreprise,etudiant,admin', // Ajout possible du rôle admin
        ]);

        User::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur créé avec succès');
    }

    public function edit(User $user) // Utilisation de Route Model Binding
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|confirmed|min:8', // Mot de passe optionnel
            'role' => 'required|in:entreprise,etudiant,admin',
        ]);

        $updateData = [
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroy(User $user) // Utilisation de Route Model Binding
    {
        $user->delete();
        
        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur supprimé avec succès');
    }
}