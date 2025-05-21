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
        'statut',
        'description',
    ];
    public static $durees = [
        1 => "1 mois",
        2 => "2 mois", 
        3 => "3 mois",
        4 => "4 mois",
        5 => "5 mois",
        6 => "6 mois",
        7 => "7 mois"
    ];
    public static $villes = [
        'Casablanca',
        'Rabat',
        'Marrakech',
        'Tanger',
        'Fès',
        'Agadir',
        'Meknès',
        'Oujda',
        'Kénitra',
        'Tétouan',
        'Safi',
        'El Jadida',
        'Béni Mellal',
        'Nador'
    ];
    public static $domaines = [
        'Informatique',
        'Génie Civil',
        'Mécanique',
        'Électrique',
        'Commerce',
        'Finance',
        'Marketing',
        'Ressources Humaines',
        'Biologie',
        'Chimie',
        'Architecture',
        'Design'
    ];
    public static $specialites = [
        'Informatique' => [
            'Développement Web',
            'Intelligence Artificielle',
            'Réseaux et Sécurité',
            'Cloud Computing',
            'Data Science',
            'Mobile Development'
        ],
        'Génie Civil' => [
            'BTP',
            'Urbanisme',
            'Géotechnique',
            'Structures',
            'Routes et Ponts'
        ],
        'Mécanique' => [
            'Automobile',
            'Aéronautique',
            'Robotique',
            'Énergétique',
            'Production Industrielle'
        ],
        'Électrique' => [
            'Électronique',
            'Automatisme',
            'Énergies Renouvelables',
            'Smart Grids',
            'Télécommunications'
        ],
        'Commerce' => [
            'Commerce International',
            'E-commerce',
            'Logistique',
            'Achat et Approvisionnement',
            'Vente et Distribution'
        ],
    ];
    public function recruteur()
    {
        return $this->belongsTo(PFERecruteur::class, 'id_PFERecruteur');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'id_offre');
    }
    public static function getAllSpecialites()
    {
    $allSpecialites = [];
    foreach (self::$specialites as $domaineSpecialites) {
        $allSpecialites = array_merge($allSpecialites, $domaineSpecialites);
    }
    return array_unique($allSpecialites);
    }
    public static function getSpecialitesByDomaine($domaine = null)
    {
    if (!$domaine) {
        // Retourne toutes les spécialités si aucun domaine n'est spécifié
        $all = [];
        foreach (self::$specialites as $specs) {
            $all = array_merge($all, $specs);
        }
        return array_unique($all);
    }
    
    return self::$specialites[$domaine] ?? [];
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
    public function estValidee()
    {
        return $this->statut === 'validee';
    }
}
