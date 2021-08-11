<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produits = [
           [
               'nom' => 'omelette',
               'description' => null,
               'prix' => 1000,
               'disponibilite' => 1,
               'categorie_id' => 1,
               'photo_produit' => null,
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],
           [
                'nom' => 'café au lait',
                'description' => null,
                'prix' => 500,
                'disponibilite' => 1,
                'categorie_id' => 3,
                'photo_produit' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],

           [
                'nom' => 'viennoiseries',
                'description' => null,
                'prix' => 2000,
                'disponibilite' => 1,
                'categorie_id' => 1,
                'photo_produit' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],

           [
                'nom' => 'Pizza reine',
                'description' => null,
                'prix' => 2000,
                'disponibilite' => 1,
                'categorie_id' => 2,
                'photo_produit' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ]
       ];
       DB::table('produits')->insert($produits);
    }
}
