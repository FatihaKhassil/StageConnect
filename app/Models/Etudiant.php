<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $table = 'etudiants';

    protected $fillable = [
        'utilisateur_id',
        'cv',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_etudiant');
    }
    public function annulerCandidature(Candidature $candidature)
    {
        // Logique pour annuler une candidature
        if ($candidature->id_etudiant == $this->id) {
            return $candidature->delete();
        }
        return false;
    }
    public function consulterCandidatures()
    {
        // Récupérer toutes les candidatures de l'étudiant
        return $this->candidatures;
    }
    public function aPostule($offreId)
{
    return $this->candidatures()->where('id_offre', $offreId)->exists();
}
    public function filtrerOffres($criteres)
    {
        // Logique pour filtrer les offres selon certains critères
    }
}