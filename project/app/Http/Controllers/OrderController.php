<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function bediening()
    {
        // Laad de pagina waar bediening bestellingen kan invoeren
        return view('bediening');
    }
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('kitchen.dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'table_number' => 'required|integer',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Opslaan in database (voorbeeld met Eloquent)
        foreach ($request->items as $item) {
            \App\Models\Order::create([
                'table_number' => $request->table_number,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('bediening')->with('success', 'Bestelling is opgeslagen!');
    }
}
