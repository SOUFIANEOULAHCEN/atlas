<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Compte extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'Matricule';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Matricule',
        'login',
        'motdepasse',
        'nom',
        'Prenom',
        'Email',
        'photo',
        'TypeCompte'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'Matricule', 'Matricule');
    }
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }
}
