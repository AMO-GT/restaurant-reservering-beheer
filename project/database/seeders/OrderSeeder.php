<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'customer_name' => 'Jan Jansen',
                'items' => 'Bier, Bitterballen, Nacho\'s',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Piet Peters',
                'items' => 'Cola, Hamburger, Friet',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Maria Meer',
                'items' => 'Wijn, Kaasplankje',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Sophie Smit',
                'items' => 'Koffie, Appeltaart',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Lucas de Vries',
                'items' => 'Thee, Tosti, Soep',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Emma Bakker',
                'items' => 'Fanta, Kipnuggets, Friet',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Thomas Visser',
                'items' => 'Sprite, Pizza',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Lisa Mulder',
                'items' => 'Ice Tea, Salade',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Daan de Boer',
                'items' => 'Heineken, Bittergarnituur',
                'status' => 'In behandeling'
            ],
            [
                'customer_name' => 'Anna Meijer',
                'items' => 'Rosé, Olijven, Broodplank',
                'status' => 'In behandeling'
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}