<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'localite' =>  $this->localite,
            'nom'=> $this->nom,
            'parking'=>$this->parking,
            'etat'=>$this->etat,
            'commerces'=>[
            'titre' =>$this->boutiques ? $this->boutiques->titre : NULL,
            'description' =>$this->boutiques ? $this->boutiques->description : NULL
        ]
       ];
    }
}
