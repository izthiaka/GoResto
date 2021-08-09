<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaisseResource;
use App\Models\Caisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "Caisses" => CaisseResource::collection(
                Caisse::all()
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
            'libelle_caisse' => 'required|max:255|unique:caisses,libelle_caisse',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Caisse = Caisse::create($data);

        return response([ 'Caisse' => new CaisseResource($Caisse), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Caisse = Caisse::where('id', $id)->first();

        if ($Caisse == null) {
            $response = ["error" =>'Caisse does not exist'];
            return response($response, 422);
        }

        return response([ 'Caisse' => new CaisseResource($Caisse), 'message' => 'Recovered successfully'], 200);
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
            'libelle_caisse' => "required|unique:caisses,libelle_caisse, $id",
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Caisse = Caisse::where('id', $id)->first();

        if ($Caisse == null) {
            $response = ["error" =>'Caisse does not exist'];
            return response($response, 422);
        }

        $Caisse->update($request->all());

        return response([ 'Caisse' => new CaisseResource($Caisse), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Caisse = Caisse::where('id', $id)->first();

        if ($Caisse == null) {
            $response = ["error" =>'Caisse does not exist'];
            return response($response, 422);
        }
        $Caisse->delete();

        return response(['message' => 'Deleted']);
    }
}
