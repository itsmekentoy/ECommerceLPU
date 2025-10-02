@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')
<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Orders</h1>
                <p class="text-gray-600 mt-2">Manage customer orders and track order status.</p>
            </div>
            
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Order List</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        HI-{{ $order->order_code }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                                                <span class="text-sm font-medium text-primary">
                                                    {{ strtoupper(substr($order->customer->name, 0, 1) . substr(strrchr($order->customer->name, ' '), 1, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $order->customer->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $order->customer->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $order->created_at->format('M d, Y') }}
                                    <div class="text-xs text-gray-500">
                                        {{ $order->created_at->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    &#8369; {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            '1' => 'bg-yellow-100 text-yellow-800',
                                            '2' => 'bg-blue-100 text-blue-800',
                                            '3' => 'bg-indigo-100 text-indigo-800',
                                            '4' => 'bg-green-100 text-green-800',
                                            '5' => 'bg-red-100 text-red-800',
                                            '6' => 'bg-gray-100 text-gray-800'
                                        ];
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ 
                                            $order->status == 1 ? 'Pending' : 
                                            ($order->status == 2 ? 'Processing' : 
                                            ($order->status == 3 ? 'Shipped' : 
                                            ($order->status == 4 ? 'Delivered' : 
                                            ($order->status == 5 ? 'Cancelled' : 
                                            ($order->status == 6 ? 'Refunded' : 'Unknown'))))) 
                                        }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <!-- View Order Details Button -->
                                        <a href="{{ route('customer.view.order', $order->id) }}" class="text-green-600 hover:text-green-800 transition-colors border border-green-400 rounded-md px-2 py-1" title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <!-- Update Status Button -->
                                        <button onclick="openOrderStatusModal({{ $order->order_code }}, '{{ $order->status }}', {{ $order->id }})" class="text-primary hover:text-primary/80 transition-colors border border-primary rounded-md px-2 py-1" title="Update Status">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </button>
                                       
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Update Order Status Modal -->
<div id="orderStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Update Order Status</h3>
        </div>
        <form class="px-6 py-4 space-y-4" method="POST" action="{{ route('admin.update.order.status') }}">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Order ID</label>
                <input type="hidden" id="orderId" name="orderId">
                <input type="text" id="orderIdDisplay" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="orderStatus" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="1">Pending</option>
                    <option value="2">Processing</option>
                    <option value="3">Shipped</option>
                    <option value="4">Delivered</option>
                    <option value="5">Cancelled</option>
                    <option value="6">Refunded</option>
                </select>
            </div>
           
        
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeOrderStatusModal()" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Cancel</button>
                <button id="updateStatusBtn" type="submit" class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-md transition-colors flex items-center justify-center" style="min-width:120px;">
                    <span id="updateStatusBtnText">Update Status</span>
                    <svg id="updateStatusBtnLoader" class="animate-spin ml-2 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Order Details Modal -->
<div id="orderDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 h-[600px] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Order Details - <span id="orderDetailsId">#12345</span></h3>
            <button onclick="closeOrderDetailsModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <div class="flex-1 p-6 overflow-y-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Customer Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Customer Information</h4>
                    <div class="space-y-2 text-sm">
                        <div><span class="font-medium">Name:</span> <span id="customerName">-</span></div>
                        <div><span class="font-medium">Email:</span> <span id="customerEmail">-</span></div>
                        <div><span class="font-medium">Phone:</span> <span id="customerPhone">-</span></div>
                        <div><span class="font-medium">Address:</span> <span id="customerAddress">-</span></div>
                    </div>
                </div>

                <!-- Order Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-3">Order Information</h4>
                    <div class="space-y-2 text-sm">
                        <div><span class="font-medium">Order Date:</span> <span id="orderDate">-</span></div>
                        <div><span class="font-medium">Status:</span> <span id="orderStatusDisplay" class="px-2 py-1 rounded-full text-xs">-</span></div>
                        <div><span class="font-medium">Total Amount:</span> <span id="orderTotal" class="font-semibold text-green-600">-</span></div>
                        <div><span class="font-medium">Payment Method:</span> <span id="paymentMethod">-</span></div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mt-6">
                <h4 class="font-semibold text-gray-900 mb-3">Order Items</h4>
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderItemsTable" class="divide-y divide-gray-200">
                            <!-- Order items will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Loader for Update Status button
document.addEventListener('DOMContentLoaded', function() {
    var orderStatusForm = document.querySelector('#orderStatusModal form');
    if (orderStatusForm) {
        orderStatusForm.addEventListener('submit', function(e) {
            var btn = document.getElementById('updateStatusBtn');
            var loader = document.getElementById('updateStatusBtnLoader');
            var btnText = document.getElementById('updateStatusBtnText');
            if (btn && loader && btnText) {
                btn.disabled = true;
                loader.classList.remove('hidden');
                btnText.textContent = 'Updating...';
            }
        });
    }

    // Reset button state when modal is closed
    window.closeOrderStatusModal = (function(origFn) {
        return function() {
            var btn = document.getElementById('updateStatusBtn');
            var loader = document.getElementById('updateStatusBtnLoader');
            var btnText = document.getElementById('updateStatusBtnText');
            if (btn && loader && btnText) {
                btn.disabled = false;
                loader.classList.add('hidden');
                btnText.textContent = 'Update Status';
            }
            if (typeof origFn === 'function') origFn();
        };
    })(window.closeOrderStatusModal);
});
let currentOrderId = null;

// Order Status Modal Functions
function openOrderStatusModal(orderId, currentStatus,id) {
    currentOrderId = orderId;
    document.getElementById('orderIdDisplay').value = 'HI-' + orderId;
    document.getElementById('orderStatus').value = currentStatus;
    document.getElementById('orderId').value = id;
    document.getElementById('orderStatusModal').classList.remove('hidden');
    document.getElementById('orderStatusModal').classList.add('flex');
}

function closeOrderStatusModal() {
    document.getElementById('orderStatusModal').classList.add('hidden');
    document.getElementById('orderStatusModal').classList.remove('flex');
    clearOrderStatusForm();
}

function clearOrderStatusForm() {
    document.getElementById('orderStatus').value = 'pending';
    document.getElementById('orderNotes').value = '';
}



// View Order Details Function

function getStatusLabel(status) {
    const labels = {
        '1': 'Pending',
        '2': 'Processing',
        '3': 'Shipped',
        '4': 'Completed',
        '5': 'Cancelled',
        '6': 'Returned'
    };
    return labels[status] || 'Unknown';
}

function closeOrderDetailsModal() {
    document.getElementById('orderDetailsModal').classList.add('hidden');
    document.getElementById('orderDetailsModal').classList.remove('flex');
}

function printInvoice(orderId) {
    // Open invoice in new window for printing
    window.open('/' + orderId, '_blank');
}

// Close modals when clicking outside
document.getElementById('orderStatusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeOrderStatusModal();
    }
});

document.getElementById('orderDetailsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeOrderDetailsModal();
    }
});
</script>

@include('admin.includes.script')
@include('admin.includes.footer')