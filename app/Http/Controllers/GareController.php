<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use App\Http\Resources\GareResource;

class GareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //return response()->json(Gare::all()->with('boutiques')->get());
        $gares = Gare::with('boutiques')->get();
            return response()->json(GareResource::collection($gares));
    }

    /**
     * Display the specified resource.
     */
    public function show (string $id) {
        $gare = Gare::find($id);
        if ($gare){
            return response()->json([
                'Message' => 'gare trouvé.',
                'Gare' => $gare
            ], 200);
        } else {
            return response([

                'Message' => 'La gare n\'est pas trouvé.',
            ], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gare $gare)
    {
        //
    }
    public function historiqueGare(){

    }
}
