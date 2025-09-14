@include('admin.includes.header')
@include('admin.includes.sidebar')
<!-- Main Content: Inventory Table -->
<div class="flex-1 bg-white rounded-lg shadow-sm flex flex-col min-h-0 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Inventory</h2>
        <a href="{{ route('admin.addProduct') }}" class="bg-orange-700 text-white px-4 py-2 rounded text-sm hover:bg-orange-800 transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Add Product
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stocks</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example Item 1 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="/images/bag.jpg" alt="Bag" class="h-12 w-12 object-cover rounded" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">Bag</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">54</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">₱350.00</td>
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Example Item 2 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="/images/wallet.jpg" alt="Wallet" class="h-12 w-12 object-cover rounded" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">Wallet</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">₱120.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Example Item 3 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="/images/facemask.jpg" alt="Facemask" class="h-12 w-12 object-cover rounded" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">Facemask</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">27</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">₱75.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Example Item 4 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="/images/blanket.jpg" alt="Blanket" class="h-12 w-12 object-cover rounded" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">Blanket</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">36</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">₱650.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Example Item 5 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="/images/textiles.jpg" alt="Textiles" class="h-12 w-12 object-cover rounded" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">Textiles</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">120</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-800">₱750.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@include('admin.includes.footer')