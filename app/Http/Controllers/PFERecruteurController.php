<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PFERecruteur; 

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
}
