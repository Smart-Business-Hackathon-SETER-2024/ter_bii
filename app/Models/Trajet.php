<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trajet extends Model
{
    use HasFactory;
    protected $fillable = [
         'lieu_depart',
         'lieu_arrive',
         'etat',
         'duree',
         'temps_mort',
        'heure_depart',
        'heure_arrive'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
