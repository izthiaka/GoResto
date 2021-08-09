<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "categories" => CategorieResource::collection(
                Categorie::all()
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
            'nom_categorie' => 'required|max:255|unique:categories,nom_categorie',
            'secteur_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $categorie = Categorie::create($data);

        return response([ 'categorie' => new CategorieResource($categorie), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::where('id', $id)->first();

        if ($categorie == null) {
            $response = ["error" =>'Categorie does not exist'];
            return response($response, 422);
        }

        return response([ 'categorie' => new CategorieResource($categorie), 'message' => 'Recovered successfully'], 200);
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
            'nom_categorie' => "required|unique:categories,nom_categorie, $id",
            'secteur_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $categorie = Categorie::where('id', $id)->first();

        if ($categorie == null) {
            $response = ["error" =>'Categorie does not exist'];
            return response($response, 422);
        }

        $categorie->update($request->all());

        return response([ 'categorie' => new CategorieResource($categorie), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::where('id', $id)->first();

        if ($categorie == null) {
            $response = ["error" =>'Categorie does not exist'];
            return response($response, 422);
        }
        $categorie->delete();

        return response(['message' => 'Deleted']);
    }
}
