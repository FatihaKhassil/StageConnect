<?php

namespace App\Http\Controllers;

use App\Models\OffrePFE;
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
    //les entreprises en attede de validation
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
  //liste des entreprises validees
    public function entreprisesValidees()
    {
        $valides = PFERecruteur::where('statut', 'valide')->with('user')->get();
        $user = Auth::user();
        return view('admin.entreprises.validees', compact('valides', 'user'));
    }
    //listes des entreprises rejetees
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
    //modifier les infos d un utilisateur
    public function edit($id)
     {
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
     }

    public function update(Request $request, $id)
    {
    $user = User::findOrFail($id);

    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:etudiant,entreprise',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user->nom = $request->nom;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }
    public function destroy(User $user) // Utilisation de Route Model Binding
    {
        $user->delete();
        
        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur supprimé avec succès');
    }
    //les offres qui sont en attente de validation par l admin
    public function enAttende()
    {
        $user = Auth::user();
        $offres = OffrePFE::where('statut','attente')->paginate(10);
        return view('admin.offres.en_attente', compact('offres','user'));

    }
    //les offres qui ont ete validees par l admin
     public function offresValides()
    {
        $user = Auth::user();
        $offres = OffrePFE::where('statut','validee')->paginate(10);
        return view('admin.offres.validees', compact('offres','user'));
        
    }
    //les offres qui ont ete rejetees par l admin
     public function offresNonValides()
    {
        $user = Auth::user();
        $offres = OffrePFE::where('statut','rejetee')->paginate(10);
        return view('admin.offres.rejetees', compact('offres','user'));
        
    }
    //les actions d admin a savoir la validation et la non validation
    public function valider(OffrePFE $offre)
    {
        $offre->update(['statut'=>'validee']);
        return back()->with('success','Offre validée avec succès');
    }
    public function rejeter(OffrePFE $offre)
    {
        $offre->update(['statut'=>'rejetee']);
        return back()->with('success','Offre rejetée avec succès');
    }
}