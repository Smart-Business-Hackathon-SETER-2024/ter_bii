<?php

namespace App\Http\Controllers;

use App\Models\Boutique;
use Illuminate\Http\Client\Request;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;

class BoutiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Boutique::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $boutique = Boutique::create($request->all());

        return response()->json($boutique, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Boutique $boutique)
    {
        return response()->json($boutique, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $boutique)
    {
        if (!$boutique) {
            return response()->json(["message" => "Cette boutique est introuvable."], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $boutique->update(request()->all());

        return response()->json("La boutique a été modifiée avec succès.",  200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($boutique)
    {
        $boutique = Boutique::find($boutique);
        if (!$boutique) {
            return response()->json(['message' => 'Boutique non trouvée'], 404);
        }
        $boutique->delete();
        return response()->json(['message' => 'Boutique supprimée avec succès'], 200);
    }
}
