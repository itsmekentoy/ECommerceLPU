<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation;
use App\Models\Item;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;
use App\Models\ItemType;
use Mpdf\Mpdf;
use App\Models\TextTile;
use App\Models\TextTileAppliedto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    

    public function texttile(){

        $texttiles = TextTile::with(['appliedTo.category'])->get();
        $itemTypes = ItemType::all();
        return view('admin.texttile', compact('texttiles', 'itemTypes'));
    }

    public function createTexttile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'texttile_name' => 'required|string|max:255',
            'texttile_price' => 'required|numeric|min:0',
            'texttile_image' => 'nullable|image|max:10240', // 10MB max
            'item_types' => 'required|array|min:1',
            'item_types.*' => 'exists:item_types,id',
        ], [
            'texttile_name.required' => 'Texttile name is required',
            'texttile_price.required' => 'Additional price is required',
            'texttile_price.numeric' => 'Price must be a number',
            'texttile_price.min' => 'Price must be at least 0',
            'item_types.required' => 'Please select at least one item type',
            'item_types.min' => 'Please select at least one item type',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()
                    ->duration(3000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('texttile_image')) {
            $image = $request->file('texttile_image');
            
            // Generate unique name
            $imageName = uniqid('texttile_', true) . '.' . $image->getClientOriginalExtension();
            
            // Save to storage/app/public/texttiles
            Storage::disk('public')->putFileAs('texttiles', $image, $imageName);
        }

        // Create the texttile
        $texttile = TextTile::create([
            'title' => $request->input('texttile_name'),
            'price' => $request->input('texttile_price'),
            'file_path' => $imageName,
        ]);

        // Create the relationships with item types
        $itemTypes = $request->input('item_types', []);
        foreach ($itemTypes as $itemTypeId) {
            TextTileAppliedto::create([
                'texttile_id' => $texttile->id,
                'category_id' => $itemTypeId,
            ]);
        }

        notyf()
            ->duration(3000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Texttile successfully created');

        return redirect()->back();
    }

    public function updateTexttile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'texttile_name' => 'required|string|max:255',
            'texttile_price' => 'required|numeric|min:0',
            'texttile_image' => 'nullable|image|max:10240', // 10MB max
            'item_types' => 'required|array|min:1',
            'item_types.*' => 'exists:item_types,id',
        ], [
            'texttile_name.required' => 'Texttile name is required',
            'texttile_price.required' => 'Additional price is required',
            'texttile_price.numeric' => 'Price must be a number',
            'texttile_price.min' => 'Price must be at least 0',
            'item_types.required' => 'Please select at least one item type',
            'item_types.min' => 'Please select at least one item type',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notyf()
                    ->duration(3000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $texttile = TextTile::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('texttile_image')) {
            // Delete old image if exists
            if ($texttile->file_path) {
                Storage::disk('public')->delete('texttiles/' . $texttile->file_path);
            }

            $image = $request->file('texttile_image');
            
            // Generate unique name
            $imageName = uniqid('texttile_', true) . '.' . $image->getClientOriginalExtension();
            
            // Save to storage/app/public/texttiles
            Storage::disk('public')->putFileAs('texttiles', $image, $imageName);
            
            $texttile->file_path = $imageName;
        }

        // Update the texttile
        $texttile->title = $request->input('texttile_name');
        $texttile->price = $request->input('texttile_price');
        $texttile->save();

        // Delete existing relationships
        TextTileAppliedto::where('texttile_id', $id)->delete();

        // Create new relationships with item types
        $itemTypes = $request->input('item_types', []);
        foreach ($itemTypes as $itemTypeId) {
            TextTileAppliedto::create([
                'texttile_id' => $texttile->id,
                'category_id' => $itemTypeId,
            ]);
        }

        notyf()
            ->duration(3000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Texttile successfully updated');

        return redirect()->back();
    }

    public function deleteTexttile($id)
    {
        try {
            $texttile = TextTile::findOrFail($id);

            // Delete the image file if exists
            if ($texttile->file_path) {
                Storage::disk('public')->delete('texttiles/' . $texttile->file_path);
            }

            // Delete relationships
            TextTileAppliedto::where('texttile_id', $id)->delete();

            // Delete the texttile
            $texttile->delete();

            notyf()
                ->duration(3000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->success('Texttile successfully deleted');

            return response()->json(['success' => true, 'message' => 'Texttile deleted successfully']);
        } catch (\Exception $e) {
            notyf()
                ->duration(3000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Failed to delete texttile');

            return response()->json(['success' => false, 'message' => 'Failed to delete texttile'], 500);
        }
    }
}
