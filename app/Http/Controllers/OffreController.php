<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OffrePFE;
use App\Models\Candidature;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index(Request $request)
{
    $query = OffrePFE::query()->where('statut', 'validee');

    // Appliquer les filtres
    if ($request->has('domaine')) {
        $query->where('domaine', 'like', '%'.$request->domaine.'%');
    }

    if ($request->has('specialite')) {
        $query->where('specialite', 'like', '%'.$request->specialite.'%');
    }

    if ($request->has('lieu')) {
        $query->where('lieu', 'like', '%'.$request->lieu.'%');
    }

    if ($request->has('duree')) {
        $query->where('duree', '<=', $request->duree);
    }

    $offres = $query->latest()->paginate(10);

    // Message si aucun résultat
    if ($offres->isEmpty()) {
        $message = $request->anyFilled(['domaine', 'specialite', 'lieu', 'duree'])
            ? "Aucune offre ne correspond à vos critères de recherche"
            : "Aucune offre disponible actuellement";
        
        session()->now('info', $message);
    }

    return view('offres.index', [
        'offres' => $offres,  // Liste paginée des offres
        'villes' => OffrePFE::$villes,
        'domaines' => OffrePFE::$domaines,
        'durees' => OffrePFE::$durees,
        'user' => Auth::user(),
        'filters' => $request->only(['domaine', 'specialite', 'lieu', 'duree'])
    ]);
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sujet' => 'required|string|max:255',
            'domaine' => 'required|in:'.implode(',', OffrePFE::$domaines),
            'specialite' => 'nullable|string',
            'lieu' => 'required|in:'.implode(',', OffrePFE::$villes),
            'duree' => 'required|numeric|in:' . implode(',', array_keys(OffrePFE::$durees)),
            'description' => 'required|string'
        ]);
         if (!Auth::user()->pfeRecruteur) {
        Auth::user()->pfeRecruteur()->create([]);
    }

    Auth::user()->pfeRecruteur->offres()->create($validated + ['statut' => 'attente']);

    return redirect()->route('mes-offres')->with('success', 'Offre créée, en attente de validation');
    }

    public function mesOffres()
    {
         $user = Auth::user();
    
    // Vérification en une ligne avec opérateur null safe (PHP 8.0+)
    $offres = $user->pfeRecruteur?->offres ?? collect();
        return view('entreprise.offres', compact('offres','user'));
    }

    // In your controller
public function create()
{
    return view('entreprise.create-offre', [
        'domaines' => OffrePFE::$domaines,
        'specialites' => OffrePFE::$specialites, // Keep the grouped structure
        'villes' => OffrePFE::$villes,
        'durees' => OffrePFE::$durees,
        'user' => Auth::user()
    ]);
}
    public function mesCandidatures()
    {
        $candidatures = Auth::user()->etudiant->candidatures()->with('offre')->get();
        return view('etudiant.candidatures', compact('candidatures'));
    }
    public function gererCandidatures(OffrePFE $offre)
    {
        $user = Auth::user();
        $candidatures = $offre->candidatures()->with('etudiant')->get();
        return view('entreprise.candidatures', compact('candidatures', 'offre','user'));
    }
    public function updateStatut(Request $request, Candidature $candidature)
    {
        $request->validate(['statut' => 'required|in:acceptee,rejetee']);
        $candidature->update(['statut' => $request->statut]);
        
        // Ici vous pouvez ajouter une notification à l'étudiant
        
        return back()->with('success', 'Statut mis à jour');
    }

}