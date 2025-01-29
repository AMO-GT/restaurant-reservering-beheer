<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Drink;
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

    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        // Check of het verzoek van de kassa pagina komt
        if($request->header('referer') && str_contains($request->header('referer'), 'kassa')) {
            return redirect()->route('kassa.index')->with('success', 'Bestelling is succesvol verwijderd!');
        }

        return redirect()->route('kitchen.index')->with('success', 'Bestelling is succesvol verwijderd!');
    }

    public function updateItems(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $currentItems = explode(', ', $order->items);
        $newDrinks = $request->input('drinks', []);
        
        // Voeg nieuwe dranken toe aan de bestaande items
        $updatedItems = array_merge($currentItems, $newDrinks);
        
        // Update de bestelling met de nieuwe items
        $order->update([
            'items' => implode(', ', array_unique($updatedItems))
        ]);

        // Update de order_count voor elk toegevoegd drankje
        foreach ($newDrinks as $drinkName) {
            $drink = Drink::where('name', $drinkName)->first();
            if ($drink) {
                $drink->increment('order_count');
            }
        }
        
        return redirect()->back()->with('success', 'Dranken zijn toegevoegd aan de bestelling.');
    }

    public function removeItem(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $itemToRemove = $request->input('item');
        
        $currentItems = explode(', ', $order->items);
        $updatedItems = array_filter($currentItems, function($item) use ($itemToRemove) {
            return $item !== $itemToRemove;
        });
        
        $order->update([
            'items' => implode(', ', $updatedItems)
        ]);
        
        return redirect()->back()->with('success', 'Drankje is verwijderd uit de bestelling.');
    }

    public function markForPayment($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'Te Betalen';
            $order->save();
            
            return redirect()->route('bar.index')
                ->with('success', 'Bestelling #' . $order->id . ' is doorgestuurd naar de kassa.');
        } catch (\Exception $e) {
            return redirect()->route('bar.index')
                ->with('error', 'Er is iets misgegaan bij het doorsturen van de bestelling naar de kassa.');
        }
    }

    public function markAsPaid($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->status = 'Betaald';
            $order->save();
            
            return redirect()->route('kassa.index')
                ->with('success', 'Bestelling #' . $order->id . ' is afgerekend.');
        } catch (\Exception $e) {
            return redirect()->route('kassa.index')
                ->with('error', 'Er is iets misgegaan bij het afrekenen van de bestelling.');
        }
    }
}