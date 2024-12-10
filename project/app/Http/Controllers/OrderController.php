<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('kitchen.dashboard', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
