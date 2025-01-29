<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\DishSeeder;
use Database\Seeders\DrinkSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            DishSeeder::class,
            // ... andere seeders ...
            OrderSeeder::class,
            DrinkSeeder::class,
        ]);
    }
}