<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    public function run()
    {
        $dishes = [
            // Voorgerechten
            [
                'name' => 'Carpaccio',
                'description' => 'Rundercarpaccio met truffelmayonaise',
                'category' => 'Voorgerechten',
                'price' => 12.50,
                'is_available' => true,
                'order_count' => 45
            ],
            [
                'name' => 'Tomatensoep',
                'description' => 'Tomatensoep met basilicum',
                'category' => 'Voorgerechten',
                'price' => 7.50,
                'is_available' => true,
                'order_count' => 30
            ],
            // Hoofdgerechten
            [
                'name' => 'Biefstuk',
                'description' => 'Biefstuk met champignonsaus',
                'category' => 'Hoofdgerechten',
                'price' => 24.50,
                'is_available' => true,
                'order_count' => 55
            ],
            [
                'name' => 'Zalm',
                'description' => 'Gegrilde zalm met citroenboter',
                'category' => 'Hoofdgerechten',
                'price' => 22.50,
                'is_available' => true,
                'order_count' => 40
            ],
            [
                'name' => 'Pasta Carbonara',
                'description' => 'Verse pasta met roomsaus en spekjes',
                'category' => 'Hoofdgerechten',
                'price' => 18.50,
                'is_available' => true,
                'order_count' => 35
            ],
            // Desserts
            [
                'name' => 'Tiramisu',
                'description' => 'Huisgemaakte Tiramisu',
                'category' => 'Desserts',
                'price' => 8.50,
                'is_available' => true,
                'order_count' => 38
            ],
            [
                'name' => 'Chocoladetaart',
                'description' => 'Warme chocoladetaart met vanille-ijs',
                'category' => 'Desserts',
                'price' => 8.50,
                'is_available' => true,
                'order_count' => 32
            ]
        ];

        foreach ($dishes as $dish) {
            Dish::create($dish);
        }
    }
} 