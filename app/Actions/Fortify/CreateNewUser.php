<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
{
    Validator::make($input, [
        'nom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'role' => ['required', Rule::in(['entreprise', 'etudiant', 'admin'])],
    ])->validate();

    // Création de l'utilisateur sans les champs supplémentaires
    return User::create([
        'nom' => $input['nom'],
        'email' => $input['email'],
        'role' => $input['role'],
        'password' => Hash::make($input['password']),
    ]);
}


}
