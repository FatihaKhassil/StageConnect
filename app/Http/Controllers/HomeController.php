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
        $role=Auth::user()->role;
        
        if($role=='entreprise')
        {
            return view('dashboard');
        }

        elseif($role=='admin')
        {
            return view('admin.home');
        }
        else//etudiant
        {
            return view('home.userpage');
        }




    }
}
