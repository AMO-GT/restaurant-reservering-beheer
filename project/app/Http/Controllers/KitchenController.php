<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Drink;
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

        $popularDrinks = Drink::where('order_count', '>', 0)
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get();

        $drinks = Drink::orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');
        
        return view('kitchen.index', compact('orders', 'popularDrinks', 'drinks'));
    }

    public function store(Request $request)
    {
        Order::create([
            'customer_name' => $request->customer_name,
            'items' => implode(', ', $request->items),
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

    public function toggleDrinkAvailability($id)
    {
        $drink = Drink::findOrFail($id);
        $drink->is_available = !$drink->is_available;
        $drink->save();

        return redirect()->back()->with('success', 
            $drink->is_available 
                ? $drink->name . ' is nu beschikbaar.' 
                : $drink->name . ' is nu niet beschikbaar.');
    }
}