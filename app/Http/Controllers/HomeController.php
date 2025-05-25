<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{

    public function index(){
        return view('home.userpage');
    }

    public function redirect()
    {
        $role = Auth::user()->role;
        $user = Auth::user(); // ici on récupère tout l'utilisateur
    
        if ($role == 'entreprise') {
            return redirect()->route('entreprise.offres.index');
        } elseif ($role == 'admin') {
            return redirect()->route('offres.disponibles.admin');// ajouter si tu veux aussi l'utiliser
        } else { // etudiant
            return redirect()->route('offres.disponibles');
        }
    }
}
