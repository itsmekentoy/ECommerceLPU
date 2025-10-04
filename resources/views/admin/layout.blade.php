@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')
<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-2">Welcome back! Here's what's happening with your business today.</p>
        </div>
        <!-- Generate Sales Button -->
            <div class="mb-8 flex justify-end">
                <button id="openSalesModal" type="button" class="inline-block px-6 py-2 bg-primary text-white font-semibold rounded-lg shadow hover:bg-orange-700 transition">
                    Generate Sales
                </button>
                <!-- Sales Modal -->
                <div id="salesModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md relative">
                        <button id="closeSalesModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                        <h2 class="text-xl font-bold mb-4">Generate Sales Report</h2>
                        <form method="POST" action="{{ route('admin.printOrderItemsPerCategory') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-primary text-white font-semibold rounded-lg shadow hover:bg-orange-700 transition">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    document.getElementById('openSalesModal').addEventListener('click', function() {
                        document.getElementById('salesModal').classList.remove('hidden');
                    });
                    document.getElementById('closeSalesModal').addEventListener('click', function() {
                        document.getElementById('salesModal').classList.add('hidden');
                    });
                    window.addEventListener('click', function(e) {
                        const modal = document.getElementById('salesModal');
                        if (e.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });
                </script>
            </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-primary bg-opacity-10 rounded-lg">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Revenue</p>
                        <p class="text-2xl font-bold text-gray-900">₱{{ number_format($sales, 2) }} </p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Products</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $items->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $countUsers }}</p>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Content Area -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Sales Overview</h2>
                    <div class="bg-white rounded-lg shadow border p-4">
                        <canvas id="salesChart" height="150"></canvas>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var ctx = document.getElementById('salesChart').getContext('2d');
                            const chartData = @json($data);

                            const labels = chartData.map(item => item.type_name);
                            const values = chartData.map(item => item.total_quantity);
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Sales',
                                        data: values    ,
                                        backgroundColor: 'rgba(234, 88, 12, 0.7)',
                                        borderRadius: 8,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: { display: false },
                                        title: { display: false }
                                    },
                                    scales: {
                                        y: { beginAtZero: true }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
                <div class="col-span-4 bg-gray-50 rounded-lg p-4 flex flex-col items-center justify-center">
                    <!-- Recent Orders Widget -->
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Orders</h3>
                    <ul class="w-full space-y-3">
                        @foreach($recentOrder as $order)
                        <li class="bg-white rounded shadow p-3 flex flex-col">
                            <a href="{{ route('customer.view.order', $order->id) }}" class="font-semibold text-gray-800 hover:text-primary">
                                HI-{{ $order->order_code }}
                            </a>
                            <span class="text-xs text-gray-500"> ₱{{ number_format($order->total_amount, 2) }} &bull; {{ $order->created_at->format('Y-m-d') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </div>
</div>
@include('admin.includes.script')
@include('admin.includes.footer')