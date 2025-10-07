<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddtoCart;
use App\Models\CustomerInformation;
use App\Models\Item;
use App\Models\OrderDetailItem;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class CustomerOrder extends Controller
{
    public function checkout()
    {
        if (! session()->has('customer_id')) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Please log in to proceed to checkout.');

            return redirect()->back();
        }

        $customerId = session('customer_id');
        $cartItems = CustomerAddtoCart::where('customer_id', $customerId)
            ->with('item')
            ->get();

        if ($cartItems->isEmpty()) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Your cart is empty.');

            return redirect()->back();
        }

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $subtotal += $cartItem->item->price * $cartItem->quantity;
        }

        $customer = CustomerInformation::find($customerId);

        return view('jinja.checkout', compact('cartItems', 'subtotal', 'customer'));
    }

    public function placeOrder(Request $request)
    {
        if (! session()->has('customer_id')) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Please log in to place an order.');

            return redirect()->back();
        }

        $validated = $request->validate([
            'delivery_address' => 'required|string|max:500',
        ]);

        $customerId = session('customer_id');
        $cartItems = CustomerAddtoCart::where('customer_id', $customerId)
            ->with('item')
            ->get();

        if ($cartItems->isEmpty()) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Your cart is empty.');

            return redirect()->back();
        }

        // Calculate total amount
        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->item->price * $cartItem->quantity;
        }

        // Create order
        $orderCode = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $order = OrderDetails::create([
            'customer_id' => $customerId,
            'total_amount' => $totalAmount,
            'status' => '1',
            'order_code' => $orderCode,
            'delivery_address' => $validated['delivery_address'],
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderDetailItem::create([
                'order_detail_id' => $order->id,
                'item_id' => $cartItem->item_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->item->price,
                'customization_textile_id' => $cartItem->customization,
            ]);

        }

        // Clear the cart
        CustomerAddtoCart::where('customer_id', $customerId)->delete();

        //update the item status
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            $item->stock -= $cartItem->quantity;
            $item->save();
        }

        // Send email notification
        $this->sendEmailNotification($order, $customerId);

        notyf()
            ->duration(3000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Order placed successfully!');

        return redirect()->route('shop');
    }

    public function directCheckout(Request $request)
    {
        if (! session()->has('customer_id')) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Please log in to proceed to checkout.');

            return redirect()->route('home');
        }

        $customerId = session('customer_id');
        $customer = CustomerInformation::find($customerId);

        // Just return the view - the item data will be read from localStorage via JavaScript
        return view('jinja.checkout-direct', compact('customer'));
    }

    public function placeDirectOrder(Request $request)
    {
        if (! session()->has('customer_id')) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Please log in to place an order.');

            return redirect()->back();
        }

        $validated = $request->validate([
            'delivery_address' => 'required|string|max:500',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $customerId = session('customer_id');
        $item = Item::findOrFail($validated['item_id']);

        // Check stock again
        if ($item->stock < $validated['quantity']) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Insufficient stock available.');

            return redirect()->back();
        }

        $totalAmount = $item->price * $validated['quantity'];

        // Create order
        $orderCode = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $order = OrderDetails::create([
            'customer_id' => $customerId,
            'total_amount' => $totalAmount,
            'status' => '1',
            'order_code' => $orderCode,
            'delivery_address' => $validated['delivery_address'],
        ]);

        // Create order item
        OrderDetailItem::create([
            'order_detail_id' => $order->id,
            'item_id' => $item->id,
            'quantity' => $validated['quantity'],
            'price' => $item->price,
        ]);

        // Send email notification
        $this->sendEmailNotification($order, $customerId);

        notyf()
            ->duration(3000)
            ->position('x', 'center')
            ->position('y', 'top')
            ->dismissible(true)
            ->success('Order placed successfully!');

        return redirect()->route('shop');
    }

    public function ListOrders()
    {
        $orders = OrderDetails::with('customer')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request)
    {
        $validated = $request->validate([
            'orderId' => 'required|integer|exists:order_details,id',
            'status' => 'required|in:1,2,3,4,5',
        ]);

        if (! in_array($validated['status'], ['1', '2', '3', '4', '5'])) {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Invalid status value.');

            return redirect()->back();
        }
        $order = OrderDetails::find($validated['orderId']);
        if ($order) {
            $order->status = $validated['status'];
            $order->save();

            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->success('Order status updated successfully.');

            return redirect()->back();
        } else {
            notyf()
                ->duration(2000)
                ->position('x', 'center')
                ->position('y', 'top')
                ->dismissible(true)
                ->error('Order not found.');

            return redirect()->back();
        }
    }

    public function viewOrder($id)
    {
        $order = OrderDetails::with(['customer', 'items.item', 'items.textile'])->find($id);

        if (! $order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Flatten items
        $order->items->transform(function ($item) {
            return [
                'product_name' => $item->item->item_name ?? '-',
                'product_image' => $item->item->file_path ?? 'default.png',
                'quantity' => $item->quantity,
                'price' => $item->price,
                'customization_textile_id' => $item->customization_textile_id,
                'textile_name' => $item->textile ? $item->textile->title : null,
                'textile_price' => $item->textile ? $item->textile->price : 0,
            ];
        });

        return view('admin.orderDetails', compact('order'));
    }

    private function sendEmailNotification($order, $customerId)
    {
        // get the email for the customer
        $customer = CustomerInformation::find($customerId);
        if (! $customer) {
            return false;
        }
        $to = $customer->email;

        // get the order details
        $orderDetails = OrderDetails::with('items.item')->find($order->id);

        if (! $orderDetails) {
            return false;
        }

        // Flatten items
        $itemsHtml = '';
        $subtotal = 0;

        foreach ($orderDetails->items as $item) {
            $productName = $item->item->item_name ?? '-';
            $productImage = $item->item->file_path
                            ? asset('storage/products/'.$item->item->file_path)
                            : asset('images/default.png');
            $qty = $item->quantity;
            $price = $item->price;
            $total = $qty * $price;

            $subtotal += $total;

            $itemsHtml .= "
        <tr style='border-bottom: 1px solid #e5e7eb;'>
            <td style='padding: 16px 0;'>
                <table role='presentation' style='border-collapse: collapse;'>
                    <tr>
                        
                        <td style='padding-left: 12px; vertical-align: top;'>
                            <div style='font-weight:600; color:#1f2937; font-size:14px; margin-bottom:4px;'>{$productName}</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style='padding:16px 0; text-align:center; font-size:14px; color:#1f2937;'>{$qty}</td>
            <td style='padding:16px 0; text-align:right; font-size:14px; color:#1f2937;'>₱".number_format($price, 2)."</td>
            <td style='padding:16px 0; text-align:right; font-size:14px; font-weight:600; color:#1f2937;'>₱".number_format($total, 2).'</td>
        </tr>';
        }

        // Example values for order summary
        $tax = $subtotal * 0.12; // 12% VAT
        $shipping = 150; // Example shipping fee
        $grandTotal = $subtotal + $tax + $shipping;

        // Build email body
        $body = "
    <!DOCTYPE html>
    <html lang='en'>
    <head><meta charset='UTF-8'><title>Order Receipt</title></head>
    <body style='font-family: Arial, sans-serif; background-color:#f7f7f7;'>
        <table style='width:100%; max-width:600px; margin:0 auto; background:#fff; border-radius:8px; overflow:hidden;'>
            <tr>
                <td style='background:#FA812F; color:#fff; padding:20px; text-align:center;'>
                    <h1 style='margin:0;'>SM Sunrise Weaving Association, Ibaan, Batangas </h1>
                    <p style='margin:0;font-size:14px;'>Munting Tubig, Ibaan, Philippines</p>
                </td>
            </tr>

            <tr>
                <td style='padding:20px;'>
                    <h2 style='margin-top:0;'>Order Receipt</h2>
                    <p><strong>Order ID:</strong> #{$orderDetails->order_code}</p>
                    <p><strong>Order Date:</strong> ".date('F j, Y g:i A', strtotime($orderDetails->created_at))."</p>
                    
                </td>
            </tr>

            <tr>
                <td style='padding:20px; border-top:1px solid #eee;'>
                    <h3>Bill To:</h3>
                    <p>
                        <strong>{$customer->fullname}</strong><br>
                        {$customer->email}<br>
                        {$customer->phone}<br>
                        {$customer->address}
                    </p>
                </td>
            </tr>

            <tr>
                <td style='padding:20px;'>
                    <h3>Order Items</h3>
                    <table style='width:100%; border-collapse:collapse;'>
                        <tr style='border-bottom:2px solid #d1d5db;'>
                            <td style='padding:12px 0; font-weight:bold;'>Item</td>
                            <td style='padding:12px 0; font-weight:bold; text-align:center;'>Qty</td>
                            <td style='padding:12px 0; font-weight:bold; text-align:right;'>Unit Price</td>
                            <td style='padding:12px 0; font-weight:bold; text-align:right;'>Total</td>
                        </tr>
                        {$itemsHtml}
                    </table>

                    <table style='width:100%; margin-top:20px;'>
                        <tr style='font-weight:bold;'><td style='text-align:right;'>Total:</td><td style='text-align:right;'>₱".number_format($subtotal, 2)."</td></tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style='background:#111827; color:#fff; padding:20px; text-align:center;'>
                    <p style='margin:0;'>Thank you for your order!</p>
                </td>
            </tr>
        </table>
    </body>
    </html>";

        // send the email
        $mailer = new \App\Services\MailerService;

        return $mailer->sendMail($to, $body);
    }
}
