<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddtoCart extends Controller
{
    public function addtoCart(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);
        if (! session()->has('user_id')) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Please log in to add items to your cart.');

            return redirect()->route('login');
        }

        // if validation failed, Laravel will automatically redirect back with errors
        if ($validated->fails()) {
            foreach ($validated->errors()->all() as $error) {
                notyf()
                    ->duration(2000)
                    ->position('x', 'center')
                    ->position('y', 'top')
                    ->dismissible(true)
                    ->error($error);
            }
        }

        // Add the item to the cart
        CustomerAddtoCart::create([
            'customer_id' => session('user_id'),
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
        ]);

        notyf()
            ->duration(2000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Item added to cart successfully.');

        return redirect()->back();
    }
}
