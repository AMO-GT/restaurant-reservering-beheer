<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
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

        // Zoek een beschikbare tafel
        $table = Table::where('is_available', true)
            ->where('capacity', '>=', $request->persons)
            ->orderBy('capacity') // Kies de kleinste tafel die past
            ->first();

        // Controleer of er een tafel beschikbaar is
        if (!$table) {
            return back()->with('error', 'Er zijn momenteel geen tafels beschikbaar voor het geselecteerde aantal personen.');
        }

        // Maak de reservering en wijs de tafel toe
        Reservation::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'persons' => $request->input('persons'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'status' => 'accepted', // Automatisch accepteren
            'table_id' => $table->id, // Koppel de tafel
        ]);

        // Markeer de tafel als niet beschikbaar
        $table->update(['is_available' => false]);

        // Bevestigingsbericht terugsturen
        return back()->with('success', 'Reservering succesvol aangemaakt en tafel toegewezen!');
    }
}
