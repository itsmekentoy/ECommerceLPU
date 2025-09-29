<nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full top-0 z-50">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side - Logo/Brand -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl">
                        <span class="text-black">Habing</span><span class="text-primary-dark">Ibaan</span>
                    </h1>
                </div>
            </div>
            <!-- Right side - Profile Dropdown -->
            <div class="flex items-center">
                <div class="relative">
                    <button id="profileButton" class="flex items-center space-x-2 text-gray-700 hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 rounded-lg p-2">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">A</span>
                        </div>
                        <span class="hidden md:block text-sm font-medium">Admin</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        
                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="flex h-screen pt-16">