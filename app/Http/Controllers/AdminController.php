<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
use App\Models\PFERecruteur; 
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
    public function en_attente()
{
    $query = PFERecruteur::where('statut', 'en_attente')->with('user');

    if (request('search')) {
        $query->whereHas('user', function($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        });
    }

    $en_attente = $query->get();
    $user = Auth::user();
    return view('admin.entreprises.en_attente', compact('en_attente', 'user'));
}
  
    public function entreprisesValidees()
    {
        $valides = PFERecruteur::where('statut', 'valide')->with('user')->get();
        $user = Auth::user();
        return view('admin.entreprises.validees', compact('valides', 'user'));
    }
    
    public function entreprisesRejetees(Request $request)
    {
        $query = PFERecruteur::where('statut', 'rejete')->with('user'); // On charge la relation user
    
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->search . '%');
            });
        }
    
        $rejetes = $query->get();
    
        // Vérifie si la recherche a donné des résultats
        $noResults = $rejetes->isEmpty() && $request->has('search');
    
        // Récupère l'utilisateur connecté
        $user = Auth::user();  // On récupère l'utilisateur authentifié
    
        return view('admin.entreprises.rejetees', compact('rejetes', 'noResults', 'user'));  // On passe 'user' à la vue
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