<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffrePFE extends Model
{
    use HasFactory;

    protected $table = 'offres_p_f_es';

    protected $fillable = [
        'id_PFERecruteur',
        'sujet',
        'domaine',
        'specialite',
        'lieu',
        'duree',
    ];

    public function recruteur()
    {
        return $this->belongsTo(PFERecruteur::class, 'id_PFERecruteur');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_offre');
    }

    public function ajouterCommentaire($commentaire)
    {
        // Logique pour ajouter un commentaire
    }

    public function modifier($data)
    {
        // Logique pour modifier l'offre
        return $this->update($data);
    }

    public function supprimer()
    {
        // Logique pour supprimer l'offre
        return $this->delete();
    }
}
