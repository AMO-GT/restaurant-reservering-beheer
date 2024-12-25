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

        // Zoek een beschikbare tafel die nog niet gereserveerd is voor de gekozen datum en tijd
        $table = Table::whereDoesntHave('reservations', function($query) use ($request) {
                $query->where('date', $request->date)
                      ->where('time', $request->time);
            })
            ->where('capacity', '>=', $request->persons)
            ->orderBy('capacity')
            ->first();

        // Controleer of er een tafel beschikbaar is
        if (!$table) {
            return back()
                ->withInput()
                ->with('error', 'Er zijn momenteel geen tafels beschikbaar voor ' . $request->persons . ' personen op de gekozen datum en tijd.');
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
