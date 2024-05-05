<?php

namespace App\Http\Controllers;

use App\Models\Forfait;


class ForfaitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Forfait::all());

    }


    /**
     * Display the specified resource.
     */
    public function show(Forfait $forfait)
    {
        return response()->json($forfait);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forfait $forfait)
    {
        //
    }
}
