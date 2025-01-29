<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drink;

class DrinkSeeder extends Seeder
{
    public function run()
    {
        $drinks = [
            ['name' => 'Coca-Cola (regular)', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Coca-Cola Zero Sugar', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Fanta Sinaasappel', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Fanta Cassis', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Sprite Regular', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Sprite Zero Sugar', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Tonic Fever-Tree', 'price' => 3.00, 'category' => 'Frisdrank'],
            ['name' => 'Ginger Ale', 'price' => 2.50, 'category' => 'Frisdrank'],
            ['name' => 'Icetea Lipton', 'price' => 2.75, 'category' => 'Frisdrank'],
            ['name' => 'Appelsap Troebel', 'price' => 2.75, 'category' => 'Sap'],
            ['name' => 'Sauvignon Blanc', 'price' => 4.50, 'category' => 'Wijn'],
        ];

        foreach ($drinks as $drink) {
            Drink::create($drink);
        }
    }
} 