<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProduitResource;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "Produits" => ProduitResource::collection(
                Produit::all()
            )
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nom' => 'required|max:255|unique:produits,nom',
            'prix' => 'required',
            'disponibilite' => 'required',
            'categorie_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        // $produit = Produit::create($data);
        $produit = Produit::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'disponibilite' => $request->disponibilite,
            'categorie_id' => $request->categorie_id,
        ]);

        if($request->hasFile('photo_produit')){
            $photo = $request->photo_produit;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo_produit = '/storage/produits/'.$image_new_name;
        }

        $produit->save();

        return response([ 'Produit' => new ProduitResource($produit), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit = Produit::where('id', $id)->first();

        if ($produit == null) {
            $response = ["error" =>'Produit does not exist'];
            return response($response, 422);
        }

        return response([ 'Produit' => new ProduitResource($produit), 'message' => 'Recovered successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nom' => "required|unique:produits,nom, $id",
            'prix' => 'required',
            'disponibilite' => 'required',
            'categorie_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $produit = Produit::where('id', $id)->first();

        if ($produit == null) {
            $response = ["error" =>'Produit does not exist'];
            return response($response, 422);
        }

        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->disponibilite = $request->disponibilite;
        $produit->categorie_id = $request->categorie_id;

        if($request->hasFile('photo_produit')){
            $photo = $request->photo_produit;
            $image_new_name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('storage/produits/', $image_new_name);
            $produit->photo_produit = '/storage/produits/'.$image_new_name;
        }

        $produit->save();

        return response([ 'Produit' => new ProduitResource($produit), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::where('id', $id)->first();

        if ($produit == null) {
            $response = ["error" =>'Produit does not exist'];
            return response($response, 422);
        }
        $produit->delete();

        return response(['message' => 'Deleted']);
    }
}
