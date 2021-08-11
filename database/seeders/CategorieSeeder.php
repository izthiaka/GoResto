<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
           [
               'nom_categorie' => 'Boisson',
               'secteur_id' => 1,
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],
           [
               'nom_categorie' => 'Alcool',
               'secteur_id' => 1,
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],

           [
               'nom_categorie' => 'Brunch',
               'secteur_id' => 2,
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ],

           [
               'nom_categorie' => 'Pizza',
               'secteur_id' => 3,
               'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
           ]
       ];
       DB::table('categories')->insert($categories);
    }
}
