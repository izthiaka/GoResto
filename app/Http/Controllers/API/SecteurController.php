<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SecteurResource;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "secteurs" => SecteurResource::collection(
                Secteur::all()
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
            'nom_secteur' => 'required|max:255|unique:secteurs,nom_secteur',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $secteur = Secteur::create($data);

        return response([ 'secteur' => new SecteurResource($secteur), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $secteur = Secteur::where('id', $id)->first();

        if ($secteur == null) {
            $response = ["error" =>'Secteur does not exist'];
            return response($response, 422);
        }

        return response([ 'secteur' => new SecteurResource($secteur), 'message' => 'Recovered successfully'], 200);
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
            'nom_secteur' => "required|unique:secteurs,nom_secteur, $id",
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $secteur = Secteur::where('id', $id)->first();

        if ($secteur == null) {
            $response = ["error" =>'Secteur does not exist'];
            return response($response, 422);
        }

        $secteur->update($request->all());

        return response([ 'secteur' => new SecteurResource($secteur), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $secteur = Secteur::where('id', $id)->first();

        if ($secteur == null) {
            $response = ["error" =>'Secteur does not exist'];
            return response($response, 422);
        }
        $secteur->delete();

        return response(['message' => 'Deleted']);
    }
}
