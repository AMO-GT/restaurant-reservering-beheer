use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisitorsTableSeeder extends Seeder
{
    public function run()
    {
        $startDate = Carbon::now()->subDays(30);
        
        for ($i = 0; $i < 30; $i++) {
            DB::table('visitors')->insert([
                'date' => $startDate->copy()->addDays($i)->format('Y-m-d'),
                'count' => rand(50, 200),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 