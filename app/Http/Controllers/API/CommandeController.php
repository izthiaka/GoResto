<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommandeResource;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "categories" => CommandeResource::collection(
                Commande::all()
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
            'produits' => 'required',
            'table_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $commande = Commande::create($data);

        return response([ 'commande' => new CommandeResource($commande), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::where('id', $id)->first();

        if ($commande == null) {
            $response = ["error" =>'Commande does not exist'];
            return response($response, 422);
        }

        return response([ '$commande' => new CommandeResource($commande), 'message' => 'Recovered successfully'], 200);
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
            'produits' => 'required',
            'table_id' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $commande = Commande::where('id', $id)->first();

        if ($commande == null) {
            $response = ["error" =>'Commande does not exist'];
            return response($response, 422);
        }

        $commande->update($request->all());

        return response([ 'commande' => new CommandeResource($commande), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commande = Commande::where('id', $id)->first();

        if ($commande == null) {
            $response = ["error" =>'Commande does not exist'];
            return response($response, 422);
        }
        $commande->delete();

        return response(['message' => 'Deleted']);
    }
}
