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
            return view('entreprise.home', ['user' => $user]);
        } elseif ($role == 'admin') {
            return view('admin.home', ['user' => $user, 'role'=> $role]); // ajouter si tu veux aussi l'utiliser
        } else { // etudiant
            return view('etudiant.home', ['user' => $user]);
        }
    }
}
