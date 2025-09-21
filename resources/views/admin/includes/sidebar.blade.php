<div class="w-64 bg-white shadow-sm border-r border-gray-200 fixed h-full overflow-y-auto">
    <nav class="mt-8 px-4">
        <ul class="space-y-2">
            <!-- Home -->
            <li>
                <a href="{{ route('admin.index') }}" class="bg-primary text-white group flex items-center px-4 py-3 text-sm font-medium rounded-lg">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>
            </li>
            <!-- Products & Inventory -->
            <li>
                <a href="{{ route('admin.inventory') }}" class="text-gray-700 hover:bg-primary hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Products & Inventory
                </a>
            </li>
            <!-- Orders -->
            <li>
                <a href="#" class="text-gray-700 hover:bg-primary hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Orders
                </a>
            </li>
            <!-- Users -->
            <li>
                <a href="{{ route('admin.customers') }}" class="text-gray-700 hover:bg-primary hover:text-white group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Users
                </a>
            </li>
           
        </ul>
    </nav>
</div>