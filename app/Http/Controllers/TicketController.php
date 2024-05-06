<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('user', 'forfait', 'gareDepart', 'gareArrivee', 'trajet')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        return response()->json($tickets);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $date_achat = Carbon::now();
        $date_expiration = $date_achat->addDays(10);

        $ticket = new Ticket();
        $ticket->date_achat = $date_achat;
        $ticket->date_expiration = $date_expiration;

        $ticket->forfaits_id = $request->forfaits_id;
        $ticket->gares_depart = $request->gares_depart;
        $ticket->gares_arriver = $request->gares_arriver;
        $ticket->trajets_id = $request->trajets_id;

        $ticket->user_id = Auth::user()->id;
        $ticket->save();

        return response()->json($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }
    // public function historiquesTickets(){
    //     $tickets = Ticket::where('users_id', auth()->user())->first();

    //     if(!$tickets){
    //         return response()->json(['message' => 'Votre historique de ticket est vide. Veiller acheter un ticket'],
    //          404);
    //     }
    //     else{
    //         // return response()->json(TicketResource::collection($tickets));
    //         return response()->json($tickets);
    //     }
    // }
        public function historiquesTickets()
    {
        $user_id = Auth::user()->id;

        $tickets = Ticket::where('users_id', $user_id)->get();
        // dd( $tickets);

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'Aucun ticket trouvé dans votre historiques'], 404);
        }

        return response()->json($tickets);
    }

}
