<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductItemController extends Controller
{
    public function inventory()
    {

        $itemTypes = ItemType::all();
        $items = Item::with('itemType')->get();

        return view('admin.product', compact('itemTypes', 'items'));
    }

    public function CreateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'product_type' => 'required|exists:item_types,id',
            'product_image' => 'required|image|max:2048',
            'is_featured' => 'sometimes|boolean',
        ]);
        foreach ($validator->errors()->all() as $error) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error($error);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // generate the unique name for image then save on storage/public
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            // Generate unique name
            $imageName = uniqid('product_', true).'.'.$image->getClientOriginalExtension();

            // Save to storage/app/public/products
            Storage::disk('public')->putFileAs('products', $image, $imageName);

        } else {
            $imageName = null;
        }

        $newItem = Item::create([
            'item_name' => $request->input('product_name'),
            'description' => $request->input('product_description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock_quantity'),
            'item_type_id' => $request->input('product_type'),
            'file_path' => $imageName,
            'is_featured' => $request->input('is_featured', false),
        ]);

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Item successfully saved');

        return redirect()->back();

    }

    public function UpdateItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'product_type' => 'required|exists:item_types,id',
            'product_image' => 'nullable|image|max:2048',
            'is_featured' => 'sometimes|boolean',
        ]);
        foreach ($validator->errors()->all() as $error) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error($error);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Item::find($id);
        if (! $item) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Item not found');

            return redirect()->back();
        }

        // Handle image update
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            // Generate unique name
            $imageName = uniqid('product_', true).'.'.$image->getClientOriginalExtension();

            // Save to storage/app/public/products
            Storage::disk('public')->putFileAs('products', $image, $imageName);

            // Delete old image if exists
            if ($item->file_path && Storage::exists('public/products/'.$item->file_path)) {
                Storage::disk('public')->delete('products/'.$item->file_path);
            }

            // Update file_path
            $item->file_path = $imageName;
        }

        // Update other fields
        $item->item_name = $request->input('product_name');
        $item->description = $request->input('product_description');
        $item->price = $request->input('price');
        $item->stock = $request->input('stock_quantity');
        $item->item_type_id = $request->input('product_type');
        $item->is_featured = $request->input('is_featured', false);
        $item->save();

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Item successfully updated');

        return redirect()->back();
    }

    public function DeleteItem($id)
    {
        $item = Item::find($id);
        // Delete image if exists
        if ($item && $item->file_path && Storage::exists('public/products/'.$item->file_path)) {
            Storage::disk('public')->delete('products/'.$item->file_path);
        }

        // Delete item record
        if ($item) {
            $item->delete();
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->success('Item successfully Deleted');

            return redirect()->back();
        } else {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Item not found');

            return redirect()->back();
        }

    }
}
