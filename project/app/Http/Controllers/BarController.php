<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Drink;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'Klaar')
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
        
        return view('kitchen.bar', compact('orders', 'popularDrinks', 'drinks'));
    }

    public function toggleAvailability($id)
    {
        $drink = Drink::findOrFail($id);
        $drink->is_available = !$drink->is_available;
        $drink->save();

        return redirect()->back()->with('success', 
            $drink->is_available 
                ? $drink->name . ' is nu beschikbaar.' 
                : $drink->name . ' is nu niet beschikbaar.');
    }

    public function updateOrderCount($id)
    {
        $drink = Drink::findOrFail($id);
        $drink->order_count++;
        $drink->save();
    }
} 