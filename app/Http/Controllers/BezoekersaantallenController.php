namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BezoekersaantallenController extends Controller
{
    public function index()
    {
        // Haal de bezoekersaantallen op uit de database
        $visitors = DB::table('visitors')->orderBy('date', 'asc')->get();

        // Geef de bezoekersaantallen door aan de view
        return view('admin.bezoekersaantallen', compact('visitors'));
    }
} 