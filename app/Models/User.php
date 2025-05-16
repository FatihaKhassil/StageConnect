<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'utilisateur_id');
    }
    public function pfeRecruteur()
{
    return $this->hasOne(PFERecruteur::class, 'utilisateur_id');
}

    public function mesOffres()
{
    $user = Auth::user();
    
    // Vérification en une ligne avec opérateur null safe (PHP 8.0+)
    $offres = $user->pfeRecruteur?->offres ?? collect();
    
    return view('offres.index', compact('offres'));
}

    public function admin()
    {
        return $this->hasOne(Admin::class, 'utilisateur_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'utilisateur_id');
    }
    public static function countEtudiants()
    {
        return self::where('role', 'etudiant')->count();
    }

    public static function countEntreprisesValidees()
    {
        return self::where('role', 'entreprise')->where('is_valid', true)->count();
    }

    public static function countEntreprisesEnAttente()
    {
        return self::where('role', 'entreprise')->where('is_valid', false)->count();
    }
    public function isEtudiant()
{
    return $this->role === 'etudiant';
}
}
