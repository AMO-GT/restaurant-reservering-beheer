<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Dish;
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

        // Haal de top 5 populaire gerechten op
        $popularDishes = Dish::where('order_count', '>', 0)
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get();

        // Haal alle gerechten op, gegroepeerd per categorie
        $dishes = Dish::orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');

        // Haal de populaire drankjes op
        $popularDrinks = Drink::where('order_count', '>', 0)
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get();

        $drinks = Drink::orderBy('category')
            ->orderBy('name')
            ->get()
            ->groupBy('category');
        
        return view('kitchen.index', compact('orders', 'popularDishes', 'dishes', 'popularDrinks', 'drinks'));
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

    public function toggleDishAvailability($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->is_available = !$dish->is_available;
        $dish->save();

        return redirect()->back()->with('success', 
            $dish->is_available 
                ? $dish->name . ' is nu beschikbaar.' 
                : $dish->name . ' is nu niet beschikbaar.');
    }
} 