<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'DateReservation',
        'Repas1',
        'Repas2',
        'Repas3',
        'Annulation',
        'Matricule'
    ];

    protected $dates = [
        'DateReservation',
        'created_at',
        'updated_at'
    ];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'Matricule', 'Matricule');
    }
}
