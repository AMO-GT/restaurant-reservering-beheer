<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class BarController extends Controller
{
    public function startBon(Request $request)
    {
        // Logica om een nieuwe bon te starten
        $customerName = $request->input('customer_name');
        // Hier kun je de bon opslaan in de database of verdere verwerking doen

        return redirect()->back()->with('success', 'Bon gestart voor ' . $customerName);
    }

    public function index()
    {
        $orders = Order::orderByRaw("CASE 
            WHEN status = 'In behandeling' THEN 1 
            ELSE 2 
            END")
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('kitchen.bar', compact('orders'));
    }
} 