<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $startDate = Carbon::now()->subDays(30);

        for ($i = 0; $i < 30; $i++) {
            $count = rand(50, 200);
            $status = $this->determineStatus($count);

            DB::table('visitors')->insert([
                'date' => $startDate->copy()->addDays($i)->format('Y-m-d'),
                'count' => $count,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function determineStatus($count)
    {
        if ($count > 150) {
            return 'druk';
        } elseif ($count >= 100) {
            return 'gemiddeld';
        } else {
            return 'niet druk';
        }
    }
}
