<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // ... andere seeders ...
            OrderSeeder::class,
        ]);
    }
}