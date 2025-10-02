<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Item;
use App\Models\OrderDetails;
class AdminController extends Controller
{
    public function index()
    {
        $countUsers = CustomerInformation::count();
        $items = Item::all();
        $sales = OrderDetails::where('status', 4)->sum('total_amount');
        $totalOrders = OrderDetails::count();
        $recentOrder = OrderDetails::with('customer')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.layout', compact('countUsers', 'items', 'sales', 'totalOrders', 'recentOrder'));
    }

    
    public function users()
    {
        return view('admin.users');
    }
    
}
