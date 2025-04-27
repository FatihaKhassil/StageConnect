<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFERecruteur extends Model
{
    use HasFactory;

    protected $table = 'pferecruteurs';

    protected $fillable = [
        'utilisateur_id',
        'nom_entreprise',
        'adresse',
        'secteur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function offres()
    {
        return $this->hasMany(OffrePFE::class, 'id_PFERecruteur');
    }

    public function publierOffre($data)
    {
        // Logique pour publier une offre
        return $this->offres()->create($data);
    }

    public function consulterCandidatures()
    {
        // Récupère toutes les candidatures pour les offres de ce recruteur
        $offres = $this->offres;
        $candidatures = collect();
        
        foreach ($offres as $offre) {
            $candidatures = $candidatures->merge($offre->candidatures);
        }
        
        return $candidatures;
    }

    public function gererCandidatures(Candidature $candidature, $nouveauStatut)
    {
        // Vérifier que la candidature est pour une offre de ce recruteur
        $offre = OffrePFE::find($candidature->id_offre);
        if ($offre && $offre->id_PFERecruteur == $this->id) {
            return $candidature->changerStatut($nouveauStatut);
        }
        return false;
    }
}