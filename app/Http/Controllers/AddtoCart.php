<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddtoCart;
use Illuminate\Http\Request;

class AddtoCart extends Controller
{
    public function fetchCartItems()
    {
        if (! session()->has('customer_id')) {
            return response()->json(['items' => []]);
        }

        $items = CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->with('item')
            ->get();

        return response()->json(['items' => $items]);
    }

    public function addtoCart(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Please log in to add items to your cart.'], 401);
        }

        $cartItem = CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            CustomerAddtoCart::create([
                'customer_id' => session('customer_id'),
                'item_id' => $validated['item_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return response()->json(['success' => 'Item added to cart successfully.']);
    }

    public function removeItemFromCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->where('item_id', $request->item_id)
            ->delete();

        return response()->json(['success' => 'Item removed successfully.']);
    }

    public function updateCartItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cartItem = CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->where('item_id', $request->item_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json(['success' => 'Cart updated successfully.']);
    }
}
