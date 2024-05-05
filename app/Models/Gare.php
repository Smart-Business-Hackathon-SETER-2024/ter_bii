<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Boutique;

class Gare extends Model
{
    use HasFactory;
    protected $fillable = [
        'localite',
        'images',
        'nom',
        'nombres_train',
        'parking',
        'etat',
        'voie',
        'heure_ouverture',
        'heure_fermuture',
        'boutiques_id',
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function boutiques()
    {
        return $this->belongsTo(Boutique::class,'boutiques_id');
    }
}
