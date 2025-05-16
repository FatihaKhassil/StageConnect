<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Notifications\CandidatureStatusUpdated;
use App\Models\OffrePFE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CandidatureController extends Controller
{
    public function postuler(Request $request, OffrePFE $offre)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('cv')->store('cvs');

        Candidature::create([
            'etudiant_id' => Auth::id(),
            'offre_pfe_id' => $offre->id,
            'cv_path' => $path,
            'statut' => 'en_attente'
        ]);

        return back()->with('success', 'Candidature envoyée');
    }

    public function mesCandidatures()

    {
        $candidatures = Auth::user()->etudiant->candidatures()->with('offre')->get();
        $user = Auth::user();
        return view('etudiant.candidatures', compact('candidatures','user'));
    }

    public function gererCandidatures(OffrePFE $offre)
    {
        $candidatures = $offre->candidatures()->with('etudiant')->get();
        return view('entreprise.candidatures', compact('candidatures', 'offre'));
    }
    // Dans CandidatureController.php

    public function enAttente(Request $request)
    {
        return $this->getCandidaturesByStatut('en_attente', $request);
    }
    
    public function acceptees(Request $request)
    {
        return $this->getCandidaturesByStatut('acceptee', $request);
    }
    
    public function rejetees(Request $request)
    {
        return $this->getCandidaturesByStatut('rejetee', $request);
    }
    
    private function getCandidaturesByStatut($statut, Request $request)
{
    $query = Candidature::with(['etudiant.user', 'offre.recruteur.entreprise'])
                ->where('statut', $statut);

    // Filtre par nom
    if ($request->filled('nom')) {
        $query->whereHas('etudiant.user', function($q) use ($request) {
            $q->where('name', 'like', '%'.$request->nom.'%');
        });
    }

    $candidatures = $query->latest()->paginate(10);

    return view("entreprise.candidatures.$statut", [
        'candidatures' => $candidatures,
        'statut' => $statut,
        'count' => $candidatures->total(),
        'user' => Auth::user()
    ]);
}

public function updateStatut(Request $request, Candidature $candidature)
{
    $request->validate([
        'statut' => 'required|in:acceptee,rejetee',
        'feedback' => 'nullable|string|max:500'
    ]);

    $candidature->update([
        'statut' => $request->statut,
        'feedback' => $request->feedback
    ]);

    // Envoyer une notification à l'étudiant
    $candidature->etudiant->user->notify(new CandidatureStatusUpdated($candidature));

    return back()->with('success', 'Statut mis à jour avec succès');
}

}