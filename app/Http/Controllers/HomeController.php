<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{
    public function redirect()
    {
        $role=Auth::user()->role;
        
        if($role=='entreprise')
        {
            return view('entreprise.home');
        }

        elseif($role=='admin')
        {
            return view('admin.home');
        }
        else//etudiant
        {
            return view('dashboard');
        }




    }
}
