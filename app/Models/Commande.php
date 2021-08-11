<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'table_id', 'produits', 'statut_commande'
    ];


    //Tell laravel to fetch text values and set them as arrays
    protected $casts = [
        'produits' => 'array',
    ];

    /**
     * Get the secteur that owns the categorie.
     */
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
