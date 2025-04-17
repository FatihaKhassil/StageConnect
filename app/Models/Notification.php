<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    protected $fillable = [
        'message',
        'dateEnvoi',
        'statut',
        'utilisateur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function envoyerNotification($utilisateur, $message)
    {
        // Logique pour envoyer une notification
        return self::create([
            'message' => $message,
            'dateEnvoi' => now(),
            'statut' => 'non_lu',
            'utilisateur_id' => $utilisateur->id,
        ]);
    }

    public function marquerCommeUue()
    {
        // Marquer notification comme lue
        $this->statut = 'lu';
        return $this->save();
    }

    public function supprimer()
    {
        // Supprimer une notification
        return $this->delete();
    }
}