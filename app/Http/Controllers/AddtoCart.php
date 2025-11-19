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
            ->with(['item', 'textile'])
            ->get();

        return response()->json(['items' => $items]);
    }

    public function addtoCart(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'customization' => 'nullable|integer',
            'price' => 'nullable|numeric|min:0',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Please log in to add items to your cart.'], 401);
        }

        $customization = $validated['customization'] ?? 0;
        $price = $validated['price'] ?? 0;

        // For customized items, don't merge with existing items - treat as unique
        if ($customization > 0) {
            CustomerAddtoCart::create([
                'customer_id' => session('customer_id'),
                'item_id' => $validated['item_id'],
                'quantity' => $validated['quantity'],
                'customization' => $customization,
                'price' => $price,
            ]);
        } else {
            // For regular items, merge with existing cart items
            $cartItem = CustomerAddtoCart::where('customer_id', session('customer_id'))
                ->where('item_id', $validated['item_id'])
                ->where('customization', 0)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $validated['quantity'];
                $cartItem->save();
            } else {
                CustomerAddtoCart::create([
                    'customer_id' => session('customer_id'),
                    'item_id' => $validated['item_id'],
                    'quantity' => $validated['quantity'],
                    'customization' => 0,
                    'price' => 0,
                ]);
            }
        }

        return response()->json(['success' => 'Item added to cart successfully.']);
    }

    public function removeItemFromCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:customer_addto_carts,id',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->where('id', $request->cart_id)
            ->delete();

        return response()->json(['success' => 'Item removed successfully.']);
    }

    public function updateCartItem(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:customer_addto_carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if (! session()->has('customer_id')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cartItem = CustomerAddtoCart::where('customer_id', session('customer_id'))
            ->where('id', $request->cart_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json(['success' => 'Cart updated successfully.']);
    }
}
