<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_categorie', 'secteur_id'
    ];

    /**
     * Get the secteur that owns the categorie.
     */
    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }
}
