<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;

abstract class Controller
{
    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'table_number' => 'required|integer',
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Bestelling opslaan
        foreach ($request->items as $item) {
            Order::create([
                'table_number' => $request->table_number,
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
            ]);
        }

        return redirect()->route('bediening')->with('success', 'Bestelling opgeslagen!');
    }
}
