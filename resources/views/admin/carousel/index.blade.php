@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')

<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Carousel Management</h1>
            <p class="text-gray-600 mt-2">Manage homepage carousel images and content</p>
        </div>
        <a href="{{ route('admin.carousel.create') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Carousel Item
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-2">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- Carousel Items Table -->
    @if($carouselItems->count() > 0)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Order</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Image</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Title</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Subtitle</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Storage</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($carouselItems as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $item->sort_order }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ $item->getImageUrlAttribute() }}" alt="{{ $item->title }}" class="h-16 w-24 object-cover rounded-lg shadow-sm">
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $item->subtitle ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-block px-3 py-1 text-xs font-medium rounded-full {{ $item->storage_disk === 's3' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($item->storage_disk) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="toggleActive({{ $item->id }})" class="inline-block px-3 py-1 text-xs font-medium rounded-full transition-colors {{ $item->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.carousel.edit', $item) }}" class="text-primary hover:text-primary-dark transition-colors font-medium">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.carousel.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this carousel item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        No carousel items found. <a href="{{ route('admin.carousel.create') }}" class="text-primary hover:text-primary-dark font-medium">Create one now</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No carousel items</h3>
        <p class="mt-2 text-gray-600">Get started by creating your first carousel item</p>
        <a href="{{ route('admin.carousel.create') }}" class="mt-4 inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
            Create First Item
        </a>
    </div>
    @endif
</div>

<script>
function toggleActive(itemId) {
    fetch(`/admin/carousel/${itemId}/toggle-active`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

    </div>
</div>

@include('admin.includes.script')
@include('admin.includes.footer')
