<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $table = 'candidatures';

    protected $fillable = [
        'id_etudiant',
        'id_offre',
        'statut',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant');
    }

    public function offre()
    {
        return $this->belongsTo(OffrePFE::class, 'id_offre');
    }
}
