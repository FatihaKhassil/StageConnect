<?php

namespace App\Observers;

use App\Models\User;
use App\Models\PFERecruteur;
use App\Models\Etudiant;
use App\Models\Admin;
class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role === 'entreprise') {
            PFERecruteur::create([
                'utilisateur_id' => $user->id,
                'nom_entreprise' => request('nom_entreprise'),
                'adresse' => request('adresse'),
                'secteur' => request('secteur'),
            ]);
        } elseif ($user->role === 'etudiant') {
            Etudiant::create([
                'utilisateur_id' => $user->id,
            ]);
        } elseif ($user->role === 'admin') {
            Admin::create([
                'utilisateur_id' => $user->id,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->role === 'entreprise') {
            PFERecruteur::where('utilisateur_id', $user->id)->delete();
        } elseif ($user->role === 'etudiant') {
            Etudiant::where('utilisateur_id', $user->id)->delete();
        } elseif ($user->role === 'admin') {
            Admin::where('utilisateur_id', $user->id)->delete();
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
