<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Seeder;

class DrinkSeeder extends Seeder
{
    public function run()
    {
        $drinks = [
            // Frisdranken
            [
                'name' => 'Cola',
                'description' => 'Coca Cola',
                'category' => 'Frisdrank',
                'price' => 2.50,
                'is_available' => true,
                'order_count' => 45
            ],
            [
                'name' => 'Sprite',
                'description' => 'Sprite frisdrank',
                'category' => 'Frisdrank',
                'price' => 2.50,
                'is_available' => true,
                'order_count' => 25
            ],
            [
                'name' => 'Fanta',
                'description' => 'Fanta Orange',
                'category' => 'Frisdrank',
                'price' => 2.50,
                'is_available' => true,
                'order_count' => 20
            ],
            [
                'name' => 'Ice Tea',
                'description' => 'Lipton Ice Tea',
                'category' => 'Frisdrank',
                'price' => 2.75,
                'is_available' => true,
                'order_count' => 35
            ],
            [
                'name' => 'Spa Rood',
                'description' => 'Bruisend mineraalwater',
                'category' => 'Frisdrank',
                'price' => 2.25,
                'is_available' => true,
                'order_count' => 15
            ],
            // Bieren
            [
                'name' => 'Heineken',
                'description' => 'Heineken pilsener',
                'category' => 'Bier',
                'price' => 3.00,
                'is_available' => true,
                'order_count' => 60
            ],
            [
                'name' => 'Leffe Blond',
                'description' => 'Belgisch blond abdijbier',
                'category' => 'Bier',
                'price' => 4.50,
                'is_available' => true,
                'order_count' => 30
            ],
            [
                'name' => 'La Chouffe',
                'description' => 'Belgisch blond speciaalbier',
                'category' => 'Bier',
                'price' => 4.75,
                'is_available' => true,
                'order_count' => 28
            ],
            [
                'name' => 'Hertog Jan',
                'description' => 'Nederlands pilsener',
                'category' => 'Bier',
                'price' => 3.00,
                'is_available' => true,
                'order_count' => 40
            ],
            [
                'name' => 'Duvel',
                'description' => 'Belgisch sterk blond bier',
                'category' => 'Bier',
                'price' => 4.75,
                'is_available' => true,
                'order_count' => 25
            ],
            // Wijnen
            [
                'name' => 'Huiswijn Rood',
                'description' => 'Rode huiswijn - Merlot',
                'category' => 'Wijn',
                'price' => 4.00,
                'is_available' => true,
                'order_count' => 35
            ],
            [
                'name' => 'Huiswijn Wit',
                'description' => 'Witte huiswijn - Chardonnay',
                'category' => 'Wijn',
                'price' => 4.00,
                'is_available' => true,
                'order_count' => 40
            ],
            [
                'name' => 'Rosé',
                'description' => 'Frisse rosé wijn',
                'category' => 'Wijn',
                'price' => 4.00,
                'is_available' => true,
                'order_count' => 22
            ],
            [
                'name' => 'Prosecco',
                'description' => 'Italiaanse mousserende wijn',
                'category' => 'Wijn',
                'price' => 5.50,
                'is_available' => true,
                'order_count' => 18
            ],
            // Warme Dranken
            [
                'name' => 'Koffie',
                'description' => 'Verse filterkoffie',
                'category' => 'Warme Dranken',
                'price' => 2.50,
                'is_available' => true,
                'order_count' => 55
            ],
            [
                'name' => 'Espresso',
                'description' => 'Sterke espresso',
                'category' => 'Warme Dranken',
                'price' => 2.75,
                'is_available' => true,
                'order_count' => 42
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Espresso met warme melk en melkschuim',
                'category' => 'Warme Dranken',
                'price' => 3.00,
                'is_available' => true,
                'order_count' => 48
            ],
            [
                'name' => 'Thee',
                'description' => 'Diverse soorten thee',
                'category' => 'Warme Dranken',
                'price' => 2.50,
                'is_available' => true,
                'order_count' => 30
            ],
            [
                'name' => 'Warme Chocolademelk',
                'description' => 'Met echte chocolade en slagroom',
                'category' => 'Warme Dranken',
                'price' => 3.50,
                'is_available' => true,
                'order_count' => 15
            ]
        ];

        foreach ($drinks as $drink) {
            Drink::create($drink);
        }
    }
} 