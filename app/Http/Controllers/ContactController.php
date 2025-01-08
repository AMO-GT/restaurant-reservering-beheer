<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'reservation_date' => 'required|date',
            'message' => 'required'
        ]);

        return redirect()->route('contact')->with('success', 'Uw annuleringsverzoek is succesvol verzonden.');
    }
}