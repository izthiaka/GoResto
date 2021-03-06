<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_secteur'
    ];

    /**
     * Get the categories for the secteur.
     */
    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }
}
