<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nom' => $this->nom,
            'description' => $this->description,
            'prix' => $this->prix,
            'disponibilite' => $this->disponibilite,
            'categorie' => new CategorieResource($this->categorie),
            'photo_produit' => $this->photo_produit
        ];
    }
}
