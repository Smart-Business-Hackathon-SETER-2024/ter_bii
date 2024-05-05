<?php

namespace App\Models;

use App\Models\Gare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_achat',
        'date_expiration',
        'statut',
        'users_id',
        'gares_id',
        'trajets_id',
    ];

    public function gares()
    {
        return $this->belongsTo(Gare::class,'gares_id');
    }
    public function trajets()
    {
        return $this->belongsTo(Trajet::class,'trajets_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
