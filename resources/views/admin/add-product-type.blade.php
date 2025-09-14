@include('admin.includes.header')
@include('admin.includes.sidebar')

<!-- Add Product Type Card (centered like add-product) -->
<div class="flex flex-1 justify-center items-center min-h-full bg-gray-50">
    <div class="bg-white rounded-lg shadow p-8 w-full max-w-xl border border-gray-200">
        <h2 class="text-2xl font-bold text-center mb-2 tracking-wide">ADD PRODUCT TYPE</h2>
        <hr class="mb-6">
        <form class="flex flex-col items-center gap-6 w-full">
            <div class="flex gap-8 w-full justify-center">
                <!-- Icon Placeholder -->
                <div class="flex flex-col items-center">
                    <div class="flex flex-col items-center justify-center h-32 w-32 border-2 border-gray-300 rounded bg-gray-100">
                        <span class="text-4xl text-gray-400"><i class="fas fa-tags"></i></span>
                    </div>
                    <span class="mt-2 text-sm text-gray-500">Product Type</span>
                </div>
                <!-- Fields -->
                <div class="flex flex-col gap-3 flex-1">
                    <input type="text" placeholder="Type Name" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                    <input type="text" placeholder="Type Description" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400" />
                </div>
            </div>

            <button type="button" class="bg-orange-700 text-white px-6 py-2 rounded text-lg font-medium hover:bg-orange-800 transition-colors mt-2">Add Type</button>
        </form>
    </div>
    
</div>

@include('admin.includes.footer')
