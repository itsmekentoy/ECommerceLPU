@include('admin.includes.header')
@include('admin.includes.sidebar')
            <!-- Main Content -->
<div class="flex-1 bg-white rounded-lg shadow-sm flex flex-col min-h-0">
    <!-- Header Row -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <div class="flex items-center gap-16">
            <span class="text-gray-700 font-medium">Product</span>
            <span class="text-gray-700 font-medium">Stocks</span>
            <span class="text-gray-700 font-medium">Price</span>
        </div>
        <button class="bg-orange-700 text-white px-3 py-1.5 rounded text-sm hover:bg-orange-800 transition-colors">
            Add Product
        </button>
    </div>
    <!-- Product List -->
    <div class="flex-1 overflow-y-auto divide-y divide-gray-200">
        <!-- Product 1: Bag -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-3">
                <input type="checkbox" class="w-4 h-4 text-orange-600 rounded border-gray-300">
                <span class="text-gray-800 w-20">Bag</span>
            </div>
            <div class="flex items-center gap-16">
                <span class="text-gray-800 w-16 text-center">54</span>
                <span class="text-gray-800 w-20 text-center">₱350.00</span>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        <!-- Product 2: Wallet (Out of Stock) -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors border-2 border-purple-300 bg-purple-50">
            <div class="flex items-center gap-3">
                <input type="checkbox" class="w-4 h-4 text-orange-600 rounded border-gray-300">
                <span class="text-gray-800 w-20">Wallet</span>
            </div>
            <div class="flex items-center gap-16">
                <span class="text-red-500 w-16 text-center font-medium text-sm">Out of Stock</span>
                <span class="text-gray-800 w-20 text-center">₱120.00</span>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        <!-- Product 3: Facemask -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-3">
                <input type="checkbox" class="w-4 h-4 text-orange-600 rounded border-gray-300">
                <span class="text-gray-800 w-20">Facemask</span>
            </div>
            <div class="flex items-center gap-16">
                <span class="text-gray-800 w-16 text-center">27</span>
                <span class="text-gray-800 w-20 text-center">₱75.00</span>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        <!-- Product 4: Blanket -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-3">
                <input type="checkbox" class="w-4 h-4 text-orange-600 rounded border-gray-300">
                <span class="text-gray-800 w-20">Blanket</span>
            </div>
            <div class="flex items-center gap-16">
                <span class="text-gray-800 w-16 text-center">36</span>
                <span class="text-gray-800 w-20 text-center">₱650.00</span>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
        <!-- Product 5: Textiles -->
        <div class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-3">
                <input type="checkbox" class="w-4 h-4 text-orange-600 rounded border-gray-300">
                <span class="text-gray-800 w-20">Textiles</span>
            </div>
            <div class="flex items-center gap-16">
                <span class="text-gray-800 w-16 text-center">120</span>
                <span class="text-gray-800 w-20 text-center">₱750.00</span>
            </div>
            <button class="text-gray-400 hover:text-red-500 transition-colors p-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>
</div>
@include('admin.includes.footer')