<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PFERecruteur; 
use App\Models\OffrePFE; 
use Illuminate\Support\Facades\Auth;

class PFERecruteurController extends Controller
{
    public function valider($id){
        $recruteur = PFERecruteur::findOrFail($id);  // Trouve le recruteur par ID
        $recruteur->statut = 'valide';  // Change le statut en "valide"
        $recruteur->save();  // Sauvegarde les modifications
    
        return redirect()->route('admin.entreprises.en_attente')->with('success', 'L\'entreprise a été validée.');
    }
    public function rejeter($id){
        $recruteur = PFERecruteur::findOrFail($id);  // Trouve le recruteur par ID
        $recruteur->statut = 'rejete';  // Change le statut en "rejeté"
        $recruteur->save();  // Sauvegarde les modifications

        return redirect()->route('admin.entreprises.en_attente')->with('success', 'L\'entreprise a été rejetée.');
    }
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

    return view('entreprise.offres.index', [
        'offres' => $offres,  // Liste paginée des offres
        'villes' => OffrePFE::$villes,
        'domaines' => OffrePFE::$domaines,
        'durees' => OffrePFE::$durees,
        'user' => Auth::user(),
        'filters' => $request->only(['domaine', 'specialite', 'lieu', 'duree'])
    ]);
    }
}
