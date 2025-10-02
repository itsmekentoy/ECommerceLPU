@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')

<div class="flex-1 ml-64 p-8">
    <div class="max-w-4xl mx-auto">
       

        <!-- Receipt Container -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden" id="receipt">
            <!-- Company Header -->
           

            <!-- Invoice Header -->
            <div class="p-8 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Order Details</h2>
                        <div class="space-y-1 text-sm">
                            <div><span class="font-semibold">Order ID:</span> {{ $order->order_code }}</div>
                            <div><span class="font-semibold">Order Date:</span> {{ $order->created_at->format('F d, Y h:i A') }}</div>
                            
                        </div>
                    </div>
                    
                    <div class="text-right">
                        @php
                            $statusColors = [
                                '1' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                '2' => 'bg-blue-100 text-blue-800 border-blue-300',
                                '3' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
                                '4' => 'bg-green-100 text-green-800 border-green-300',
                                '5' => 'bg-red-100 text-red-800 border-red-300',
                                '6' => 'bg-gray-100 text-gray-800 border-gray-300'
                            ];
                        @endphp
                        <span class="px-4 py-2 rounded-lg text-sm font-semibold border-2 
                        @if (isset($statusColors[$order->status]) )
                            {{ $statusColors[$order->status] }}
                        @else
                            bg-gray-100 text-gray-800 border-gray-300
                        
                            
                        @endif
                        ">
                            @if ($order->status == '1')
                                Pending
                            @elseif ($order->status == '2')
                                Processing
                            @elseif ($order->status == '3')
                                Shipped
                            @elseif ($order->status == '4')
                                Delivered
                            @elseif ($order->status == '5')
                                Cancelled
                            @elseif ($order->status == '6')
                                Refunded
                            @else
                                Unknown
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="p-8 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Billing Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Bill To:</h3>
                        <div class="space-y-2 text-sm">
                            <div class="font-semibold text-gray-900">{{ $order->customer->name ?? 'N/A' }}</div>
                            <div class="text-gray-600">{{ $order->customer->email ?? 'N/A' }}</div>
                            @if($order->customer && $order->customer->phone)
                                <div class="text-gray-600">{{ $order->customer->phone }}</div>
                            @endif
                            @if($order->customer && $order->customer->address)
                                <div class="text-gray-600 leading-relaxed">
                                    {{ $order->customer->address }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ship To:</h3>
                        <div class="space-y-2 text-sm">
                            <div class="font-semibold text-gray-900">{{ $order->shipping_name ?? ($order->customer->name ?? 'N/A') }}</div>
                            @if(($order->shipping_phone ?? ($order->customer->phone ?? null)))
                                <div class="text-gray-600">{{ $order->shipping_phone ?? $order->customer->phone }}</div>
                            @endif
                            <div class="text-gray-600 leading-relaxed">
                                {{ $order->shipping_address ?? ($order->customer->address ?? 'Same as billing address') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Order Items</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th class="text-left py-3 text-sm font-semibold text-gray-900 uppercase tracking-wide">Item</th>
                                <th class="text-center py-3 text-sm font-semibold text-gray-900 uppercase tracking-wide">Qty</th>
                                <th class="text-right py-3 text-sm font-semibold text-gray-900 uppercase tracking-wide">Unit Price</th>
                                <th class="text-right py-3 text-sm font-semibold text-gray-900 uppercase tracking-wide">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $subtotal = 0; @endphp
                            @foreach($order->items as $item)
                                @php 
                                    $itemTotal = $item['quantity'] * $item['price'];
                                    $subtotal += $itemTotal;
                                @endphp
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-start">
                                            
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $item['product_name'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 text-center text-gray-900">{{ $item['quantity'] }}</td>
                                    <td class="py-4 text-right text-gray-900">₱{{ number_format($item['price'], 2) }}</td>
                                    <td class="py-4 text-right font-medium text-gray-900">₱{{ number_format($itemTotal, 2) }}</td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Order Summary -->
                <div class="mt-8 border-t-2 border-gray-300 pt-6">
                    <div class="flex justify-end">
                        <div class="w-full max-w-sm space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="text-gray-900">₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            
                            @if($order->tax_amount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tax:</span>
                                    <span class="text-gray-900">₱{{ number_format($order->tax_amount, 2) }}</span>
                                </div>
                                
                            @else
                                
                            @endif
                            
                            @if($order->shipping_amount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Shipping:</span>
                                    <span class="text-gray-900">₱{{ number_format($order->shipping_amount, 2) }}</span>
                                </div>
                            @endif
                            
                            @if($order->discount_amount > 0)
                                <div class="flex justify-between text-sm text-green-600">
                                    <span>Discount:</span>
                                    <span>-${{ number_format($order->discount_amount, 2) }}</span>
                                </div>
                            @endif
                            
                            <div class="border-t border-gray-300 pt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900">Total:</span>
                                    <span class="text-gray-900">₱{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            @if($order->notes || $order->special_instructions)
                <div class="p-8 bg-gray-50 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h3>
                    @if($order->notes)
                        <div class="mb-4">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Order Notes:</h4>
                            <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                        </div>
                    @endif
                    @if($order->special_instructions)
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Special Instructions:</h4>
                            <p class="text-sm text-gray-600">{{ $order->special_instructions }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Footer -->
            <div class="p-8  text-white text-center">
                
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        font-size: 12px;
    }
    
    .flex-1.ml-64 {
        margin-left: 0 !important;
    }
    
    #receipt {
        box-shadow: none !important;
        border-radius: 0 !important;
    }
    
    .bg-primary {
        background-color: #1f2937 !important;
        -webkit-print-color-adjust: exact;
    }
    
    .text-primary-100 {
        color: #f3f4f6 !important;
        -webkit-print-color-adjust: exact;
    }
    
    /* Ensure status badges print with colors */
    .bg-yellow-100 { background-color: #fef3c7 !important; -webkit-print-color-adjust: exact; }
    .bg-blue-100 { background-color: #dbeafe !important; -webkit-print-color-adjust: exact; }
    .bg-indigo-100 { background-color: #e0e7ff !important; -webkit-print-color-adjust: exact; }
    .bg-green-100 { background-color: #dcfce7 !important; -webkit-print-color-adjust: exact; }
    .bg-red-100 { background-color: #fee2e2 !important; -webkit-print-color-adjust: exact; }
    .bg-gray-100 { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; }
    
    .text-yellow-800 { color: #92400e !important; -webkit-print-color-adjust: exact; }
    .text-blue-800 { color: #1e40af !important; -webkit-print-color-adjust: exact; }
    .text-indigo-800 { color: #3730a3 !important; -webkit-print-color-adjust: exact; }
    .text-green-800 { color: #166534 !important; -webkit-print-color-adjust: exact; }
    .text-red-800 { color: #991b1b !important; -webkit-print-color-adjust: exact; }
    .text-gray-800 { color: #1f2937 !important; -webkit-print-color-adjust: exact; }
    
    .bg-gray-900 {
        background-color: #111827 !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>

<script>
function downloadPDF() {
    // You can implement PDF generation here using libraries like jsPDF or server-side PDF generation
    fetch('', {
        method: 'GET',
        headers: {
            'Accept': 'application/pdf',
        }
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'order-{{ $order->id }}-receipt.pdf';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error downloading PDF:', error);
        alert('Error downloading PDF. Please try again.');
    });
}

// Auto-focus for better UX
window.addEventListener('load', function() {
    // Add any initialization code here if needed
});
</script>

@include('admin.includes.script')
@include('admin.includes.footer')