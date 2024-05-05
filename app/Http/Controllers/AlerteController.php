<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlerteRequest;
use App\Http\Requests\UpdateAlerteRequest;
use App\Models\Alerte;
use Illuminate\Support\Facades\Auth;

class AlerteController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return response()->json(Alerte::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlerteRequest $request)
    {
        $alerte = new Alerte();

        $imagePath = $request->file('image')->store('images/alerte', 'public');
        $alerte->image = $imagePath;

        $alerte->objet = $request->objet;
        $alerte->description = $request->description;
        $alerte->user_id = Auth::user()->id;
        $alerte->save();

        return response()->json('Alerte ajoutée!!!', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alerte $alerte)
    {
        return response()->json($alerte);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlerteRequest $request, Alerte $alerte)
    {
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images/diplome', 'public');
            $alerte->image = $imagePath;
        }
        $alerte->objet = $request->objet;
        $alerte->description = $request->description;
        $alerte->update();
        return response()->json('Alerte modifiée!!!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alerte $alerte)
    {
        $alerte->delete();
        return response()->json('Alerte supprimée!!!', 200);
    }
}
