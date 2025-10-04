<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Item;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use App\Models\ItemType;
use Mpdf\Mpdf;

class AdminController extends Controller
{
    public function index()
    {
        $countUsers = CustomerInformation::count();
        $items = Item::all();
        $sales = OrderDetails::where('status', 4)->sum('total_amount');
        $totalOrders = OrderDetails::count();
        $recentOrder = OrderDetails::with('customer')->orderBy('created_at', 'desc')->take(5)->get();
        $data = ItemType::select(
        'item_types.type_name',
        DB::raw('SUM(order_detail_items.quantity) as total_quantity')
        )
        ->join('items', 'items.item_type_id', '=', 'item_types.id')
        ->join('order_detail_items', 'order_detail_items.item_id', '=', 'items.id')
        ->groupBy('item_types.id', 'item_types.type_name')
        ->get();


        return view('admin.layout', compact('countUsers', 'items', 'sales', 'totalOrders', 'recentOrder', 'data'));
    }

    
    public function users()
    {
        return view('admin.users');
    }
    public function printOrderItemsPerCategory(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
         $data = ItemType::select(
            'item_types.type_name',
            'items.item_name',
            'items.price',
            DB::raw('SUM(order_detail_items.quantity) as total_quantity'),
            DB::raw('SUM(order_detail_items.quantity * order_detail_items.price) as subtotal')
                )
            ->leftJoin('items', 'items.item_type_id', '=', 'item_types.id')
            ->leftJoin('order_detail_items', 'order_detail_items.item_id', '=', 'items.id')
            ->whereBetween('order_detail_items.created_at', [$request->start_date, $request->end_date])
            ->groupBy('item_types.id', 'item_types.type_name', 'items.id', 'items.item_name', 'items.price')
            ->get();

        $grandTotal = $data->sum('subtotal');
        // Load a Blade view and pass the data
        $html = view('email.order_items_pdf', compact('data', 'grandTotal','start_date','end_date'))->render();

        $mpdf = new Mpdf(['orientation' => 'P']);
        $mpdf->WriteHTML($html);

        // Open in new tab
        return response($mpdf->Output('OrderItemsPerCategory.pdf', 'D'))
            ->header('Content-Type', 'application/pdf');
    }
    
}
