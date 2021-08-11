<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'nbr_couvert'
    ];

    /**
     * Get the categories for the secteur.
     */
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
