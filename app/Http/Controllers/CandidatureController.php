<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Notifications\CandidatureStatusUpdated;
use App\Models\OffrePFE;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class CandidatureController extends Controller
{
    public function postuler(Request $request, OffrePFE $offre)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user = Auth::user();
        $data = [
            'id_offre' => $offre->id,
            'cv_path' => $request->file('cv')->store('cvs', 'public'),
            'statut' => 'en_attente'
        ];

        if ($user->etudiant) {
            $data['id_etudiant'] = $user->etudiant->id;
        } elseif ($user->recruteur) {
            abort(403, 'Les recruteurs ne peuvent pas postuler');
        } elseif ($user->isAdmin()) {
            abort(403, 'Les administrateurs ne peuvent pas postuler');
        }

        Candidature::create($data);

        return back()->with('success', 'Candidature envoyée avec succès!');
    }

    public function mesCandidatures()
    {
    $candidatures = Auth::user()->etudiant
        ->candidatures()
        ->with(['offre.recruteur']) // Retirez .entreprise
        ->latest()
        ->paginate(10);

    return view('etudiant.candidatures', [
        'candidatures' => $candidatures,
        'user' => Auth::user()
    ]);
    }

    public function gererCandidatures(OffrePFE $offre)
    {
        Gate::authorize('manage-candidatures', $offre);

        $candidatures = $offre->candidatures()
            ->with(['etudiant.user'])
            ->latest()
            ->paginate(10);

        return view('entreprise.candidatures.index', compact('candidatures', 'offre'));
    }

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
        $query = Candidature::with(['etudiant.utilisateur', 'offre.recruteur'])
            ->where('statut', $statut);

        if ($request->filled('nom')) {
            $query->whereHas('etudiant.utilisateur', function($q) use ($request) {
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
    // Autorisation via la policy
    
    Gate::authorize('update', $candidature);

    // Validation
    $request->validate([
        'statut' => 'required|in:acceptee,rejetee',
        'feedback' => 'nullable|string|max:500'
    ]);

    // Mise à jour de la candidature
    $candidature->update([
        'statut' => $request->statut,
        'feedback' => $request->feedback
    ]);


    return back()->with('success', 'Statut mis à jour avec succès');
   }


    public function showCV(Candidature $candidature)
    {
        Gate::authorize('view-cv', $candidature);
        dd($candidature->cv_path, Storage::disk('public')->exists($candidature->cv_path));
        if (!Storage::disk('public')->exists($candidature->cv_path)) {
            abort(404);
        }

        return Storage::disk('public')->response($candidature->cv_path);
    }
}