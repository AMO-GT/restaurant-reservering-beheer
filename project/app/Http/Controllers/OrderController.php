<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Laad de bediening pagina.
     */
    public function bediening()
    {
        // Laad de pagina waar bediening bestellingen kan invoeren
        return view('bediening');
    }

    /**
     * Toon het keuken-dashboard met alle bestellingen.
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('kitchen.dashboard', compact('orders'));
    }

    /**
     * Update de status van een bestelling.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,served',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status bijgewerkt!');
    }

    /**
     * Sla een nieuwe bestelling op vanuit de bediening.
     */
    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'table_number' => 'required|integer',
            'order_details' => 'required|string',
        ]);

        // Maak een nieuwe bestelling aan
        Order::create([
            'table_number' => $request->table_number,
            'order_details' => $request->order_details,
            'status' => 'pending', // Standaardstatus is "pending"
        ]);

        return redirect()->route('bediening')->with('success', 'Bestelling is succesvol opgeslagen en doorgestuurd naar de keuken!');
    }
}
