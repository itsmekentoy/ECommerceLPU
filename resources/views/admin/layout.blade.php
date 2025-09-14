@include('admin.includes.header')
@include('admin.includes.sidebar')
<!-- Main Content: Record of Type of Product -->
<div class="flex-1 bg-white rounded-lg shadow-sm flex flex-col min-h-0 p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Product Types</h2>
        <a href="{{ route('admin.addProductType') }}" class="bg-orange-700 text-white px-4 py-2 rounded text-sm hover:bg-orange-800 transition-colors">
            Add Type
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example Type 1 -->
                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Bag</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">All kinds of bags</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                </tr>
                <!-- Example Type 2 -->
                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Wallet</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Leather and fabric wallets</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                </tr>
                <!-- Example Type 3 -->
                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Facemask</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Protective face masks</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                </tr>
                <!-- Example Type 4 -->
                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Blanket</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Various blankets</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                </tr>
                <!-- Example Type 5 -->
                <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">Textiles</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">Textile products</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button class="text-blue-500 hover:text-blue-700 mr-2">
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