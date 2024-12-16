<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Validatie
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'persons' => 'required|integer|min:1',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Gegevens opslaan
        Reservation::create($request->all());

        // Bevestigingsbericht terugsturen
        return back()->with('success', 'Reservering succesvol aangemaakt!');
    }
}
