<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index()
    {
        $orders = Order::orderByRaw("CASE 
            WHEN status = 'In behandeling' THEN 1 
            ELSE 2 
            END")
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('kitchen.index', compact('orders'));
    }

    public function store(Request $request)
    {
        Order::create([
            'customer_name' => $request->customer_name,
            'items' => $request->items,
            'status' => 'In behandeling'
        ]);

        return redirect()->back()->with('success', 'Bestelling toegevoegd!');
    }

    public function updateStatus(Order $order)
    {
        $order->update([
            'status' => $order->status == 'In behandeling' ? 'Klaar' : 'In behandeling'
        ]);

        return redirect()->back()->with('success', 'Status bijgewerkt!');
    }
}