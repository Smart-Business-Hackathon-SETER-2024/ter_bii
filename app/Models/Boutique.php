<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
    ];
    public function gares()
    {
        return $this->belongsTo(Gare::class,'boutiques_id');
    }
}
