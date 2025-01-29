<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class KassaController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'Te Betalen')
            ->orderBy('created_at', 'desc')
            ->get();

        // Prijslijst voor items
        $prices = [
            // Frisdranken
            'Coca-Cola (regular)' => 2.50,
            'Coca-Cola Zero Sugar' => 2.50,
            'Fanta Sinaasappel' => 2.50,
            'Fanta Cassis' => 2.50,
            'Sprite Regular' => 2.50,
            'Sprite Zero Sugar' => 2.50,
            'Tonic Fever-Tree' => 3.00,
            'Ginger Ale' => 2.50,
            'Icetea Lipton' => 2.75,
            'Appelsap Troebel' => 2.75,
            'Sauvignon Blanc' => 4.50,
            
            // Voorgerechten
            'Carpaccio' => 12.50,
            'Tomatensoep' => 6.50,
            "Gamba's" => 11.50,
            'Bruschetta' => 7.50,
            'Salade' => 8.50,
            
            // Hoofdgerechten
            'Biefstuk' => 24.50,
            'Zalm' => 22.50,
            'Pasta Carbonara' => 16.50,
            'Risotto' => 17.50,
            'Schnitzel' => 18.50,
            'Kipsaté' => 17.50,
            
            // Bijgerechten
            'Friet' => 3.50,
            'Groenten' => 4.00,
            
            // Desserts
            'Tiramisu' => 7.50,
            'Cheesecake' => 6.50,
            'Chocoladetaart' => 7.00,
            'Sorbet' => 6.50,
        ];
        
        return view('kassa.index', compact('orders', 'prices'));
    }

    public function history()
    {
        $orders = Order::where('status', 'Betaald')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($order) {
                return $order->created_at->format('Y-m-d');
            });

        // Prijslijst voor items
        $prices = [
            // Frisdranken
            'Coca-Cola (regular)' => 2.50,
            'Coca-Cola Zero Sugar' => 2.50,
            'Fanta Sinaasappel' => 2.50,
            'Fanta Cassis' => 2.50,
            'Sprite Regular' => 2.50,
            'Sprite Zero Sugar' => 2.50,
            'Tonic Fever-Tree' => 3.00,
            'Ginger Ale' => 2.50,
            'Icetea Lipton' => 2.75,
            'Appelsap Troebel' => 2.75,
            'Sauvignon Blanc' => 4.50,
            
            // Voorgerechten
            'Carpaccio' => 12.50,
            'Tomatensoep' => 6.50,
            "Gamba's" => 11.50,
            'Bruschetta' => 7.50,
            'Salade' => 8.50,
            
            // Hoofdgerechten
            'Biefstuk' => 24.50,
            'Zalm' => 22.50,
            'Pasta Carbonara' => 16.50,
            'Risotto' => 17.50,
            'Schnitzel' => 18.50,
            'Kipsaté' => 17.50,
            
            // Bijgerechten
            'Friet' => 3.50,
            'Groenten' => 4.00,
            
            // Desserts
            'Tiramisu' => 7.50,
            'Cheesecake' => 6.50,
            'Chocoladetaart' => 7.00,
            'Sorbet' => 6.50,
        ];
        
        return view('kassa.history', compact('orders', 'prices'));
    }
} 