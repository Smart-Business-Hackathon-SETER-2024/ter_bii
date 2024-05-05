<?php

namespace App\Http\Controllers;

use App\Models\Trajet;

class TrajetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère tous les trajets en triant par la durée en ordre croissant
        $trajets = Trajet::all();
        return response()->json([
            'trajets' => $trajets
        ]);
    }

    public function show(string $id)
    {

        $trajet = Trajet::find($id);

        if ($trajet){

            return response()->json([
                'Message' => 'Trajet trouvé.',
                'trajet' => $trajet
            ], 200);

        } else {

            return response([

                'Message' => 'Nous n\'avons pas trouvé le trajet .',

            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id )
    {
        $trajet = Trajet::find($id);

        if($trajet){

            $trajet->delete();

            return response()->json([

                'Message' => 'trajet  supprimé avec  success.',

            ], 200);

        }else {

            return response([

                'Message' => 'Nous n\'avons pas trouvé le trajet.',

            ], 500);
        }

    }

    public function dureeTrajet(){


    }
}
