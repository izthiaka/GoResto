<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            "Tables" => TableResource::collection(
                Table::all()
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
            'numero' => 'required|max:255|unique:tables,numero',
            'nbr_couvert' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Table = Table::create($data);

        return response([ 'Table' => new TableResource($Table), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Table = Table::where('id', $id)->first();

        if ($Table == null) {
            $response = ["error" =>'Table does not exist'];
            return response($response, 422);
        }

        return response([ 'Table' => new TableResource($Table), 'message' => 'Recovered successfully'], 200);
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
            'numero' => "required|unique:tables,numero, $id",
            'nbr_couvert' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Table = Table::where('id', $id)->first();

        if ($Table == null) {
            $response = ["error" =>'Table does not exist'];
            return response($response, 422);
        }

        $Table->update($request->all());

        return response([ 'Table' => new TableResource($Table), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Table = Table::where('id', $id)->first();

        if ($Table == null) {
            $response = ["error" =>'Table does not exist'];
            return response($response, 422);
        }
        $Table->delete();

        return response(['message' => 'Deleted']);
    }
}
