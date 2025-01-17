<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BezoekersaantallenController extends Controller
{
    public function index()
    {
        // Haal de bezoekersaantallen op uit de database
        $visitors = DB::table('visitors')->orderBy('date', 'asc')->get();

        // Voeg de dag van de week toe aan elk record
        $visitors->transform(function ($visitor) {
            $visitor->day = Carbon::parse($visitor->date)->locale('nl')->isoFormat('dddd');
            return $visitor;
        });

        // Geef de bezoekersaantallen door aan de view
        return view('admin.bezoekersaantallen', compact('visitors'));
    }
}
