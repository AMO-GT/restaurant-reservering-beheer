<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Valideer de input
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'items' => 'required|array'
            ]);

            // Maak een nieuwe bestelling aan
            Order::create([
                'customer_name' => $request->customer_name,
                'items' => implode(', ', $request->items),
                'status' => 'In behandeling'
            ]);

            return redirect()->route('kitchen.index')->with('success', 'Bestelling is succesvol toegevoegd!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Er is iets misgegaan bij het toevoegen van de bestelling.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $order->status === 'In behandeling' ? 'Klaar' : 'In behandeling';
        $order->save();

        return redirect()->route('kitchen.index')->with('success', 'Status is succesvol bijgewerkt!');
    }

    public function index()
    {
        // Haal orders op, gesorteerd op created_at (oudste eerst)
        $orders = Order::orderBy('created_at', 'asc')->get();
        return view('kitchen.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('kitchen.index')->with('success', 'Bestelling is succesvol verwijderd!');
    }
}