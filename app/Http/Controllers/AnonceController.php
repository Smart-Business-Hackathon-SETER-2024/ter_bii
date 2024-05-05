<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnonceRequest;
use App\Http\Requests\UpdateAnonceRequest;
use App\Models\Anonce;

class AnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return response()->json(Anonce::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnonceRequest $request)
    {
        $alerte = new Anonce();

        $imagePath = $request->file('image')->store('images/alerte', 'public');
        $alerte->image = $imagePath;

        $alerte->titre = $request->titre;
        $alerte->description = $request->description;
        $alerte->save();

        return response()->json('Anonce ajoutée!!!', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Anonce $alerte)
    {
        return response()->json($alerte);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnonceRequest $request, Anonce $alerte)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images/diplome', 'public');
            $alerte->image = $imagePath;
        }
        $alerte->titre = $request->titre;
        $alerte->description = $request->description;
        $alerte->update();
        return response()->json('Anonce modifiée!!!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anonce $alerte)
    {
        $alerte->delete();
        return response()->json('Anonce supprimée!!!', 200);
    }
}
