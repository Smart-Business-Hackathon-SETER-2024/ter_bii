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

}
