<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'administrateurs';

    protected $fillable = [
        'utilisateur_id',
        'created_at',
        'updated_at',
    ];
    
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

}
