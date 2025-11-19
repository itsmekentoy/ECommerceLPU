@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')
<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Textile Management</h1>
                <p class="text-gray-600 mt-2">Manage textiles and their applicable item types.</p>
            </div>
            <button onclick="openAddModal()" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                Add Textile
            </button>
        </div>

        <!-- Texttiles Table -->
          <table class="w-full" id="productsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Textile Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied to Categories</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($texttiles as $texttile)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($texttile->file_path)
                                        <img src="{{ asset('storage/texttiles/' . $texttile->file_path) }}" 
                                            alt="{{ $texttile->title }}" 
                                            class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $texttile->title }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $colors = [
                                                'bg-blue-100 text-blue-800',
                                                'bg-green-100 text-green-800',
                                                'bg-purple-100 text-purple-800',
                                                'bg-pink-100 text-pink-800',
                                                'bg-yellow-100 text-yellow-800',
                                                'bg-indigo-100 text-indigo-800',
                                                'bg-red-100 text-red-800',
                                                'bg-orange-100 text-orange-800',
                                            ];
                                        @endphp
                                        @forelse($texttile->appliedTo as $index => $applied)
                                            @php
                                                $colorClass = $colors[$index % count($colors)];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                                {{ $applied->category->type_name }}
                                            </span>
                                        @empty
                                            <span class="text-gray-400 text-sm">No categories assigned</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <button onclick="openUpdateModal({{ $texttile->id }}, '{{ addslashes($texttile->title) }}', {{ $texttile->price ?? 0 }}, '{{ addslashes($texttile->file_path ?? '') }}', {{ json_encode($texttile->appliedTo->pluck('category_id')->toArray()) }})" class="text-primary hover:text-primary/80 transition-colors">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Update
                                    </button>
                                    <button onclick="openDeleteModal({{ $texttile->id }})" class="text-red-600 hover:text-red-800 transition-colors">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
               
            </div>
        </div>
    </div>
</div>

<!-- Add/Update Texttile Modal -->
<div id="productModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Add New Textile</h3>
        </div>
        <form class="px-6 py-4 space-y-4" action="{{route('admin.texttile.create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Texttile Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Textile Name</label>
                <input type="text" id="productName" name="texttile_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Enter texttile name" required>
            </div>
            
            <!-- Additional Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Price (₱)</label>
                <input type="number" id="texttilePrice" name="texttile_price" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Enter additional price" required>
            </div>
            
            <!-- Image Upload Section -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Textile Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <div id="imagePreviewContainer" class="hidden mb-4">
                            <img id="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg shadow-md" src="" alt="Preview">
                            <button type="button" id="removeImage" class="mt-2 text-sm text-red-600 hover:text-red-800">Remove Image</button>
                        </div>
                        <div id="currentImageFilename" class="text-xs text-gray-500 mb-2 hidden"></div>
                        <div id="uploadPrompt">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="productImage" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary/80">
                                    <span>Upload a file</span>
                                    <input id="productImage" name="texttile_image" type="file" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Item Types Checkboxes -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Applied to Item Types</label>
                <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-md p-3">
                    @foreach($itemTypes as $type)
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="itemType{{ $type->id }}" 
                               name="item_types[]" 
                               value="{{ $type->id }}" 
                               class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <label for="itemType{{ $type->id }}" class="ml-2 text-sm text-gray-700 cursor-pointer">
                            {{ $type->type_name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="mt-1 text-xs text-gray-500">Select which item types this textile can be applied to</p>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" onclick="closeProductModal()" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Cancel</button>
                <button type="button" id="saveProductBtn" onclick="saveProductAjax(event)" class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-md transition-colors">Save Texttile</button>
            </div>
        </form>
    </div>
</div>

<script>
function saveProductAjax(e) {
    var btn = document.getElementById('saveProductBtn');
    btn.disabled = true;
    btn.textContent = 'Saving...';
    var form = e.target.closest('form');
    var url = form.action;
    var formData = new FormData(form);
    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: formData
    }).finally(function() {
        location.reload();
    });
}
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('productImage');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const removeImageBtn = document.getElementById('removeImage');

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            handleImageUpload(file);
        }
    });

    // Handle drag and drop
    const dropZone = imageInput.closest('.border-dashed');
    
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('border-primary', 'bg-primary/5');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-primary', 'bg-primary/5');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('border-primary', 'bg-primary/5');
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            imageInput.files = files;
            handleImageUpload(files[0]);
        }
    });

    // Remove image functionality
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreviewContainer.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
    });

    function handleImageUpload(file) {
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            alert('File size must be less than 10MB');
            return;
        }

        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.remove('hidden');
            uploadPrompt.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
});

function closeProductModal() {
    // Reset form and image preview
    document.getElementById('productModal').classList.add('hidden');
    document.getElementById('productImage').value = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('uploadPrompt').classList.remove('hidden');
    
    // Reset form fields
    document.querySelector('#productModal form').reset();
}
</script>

<style>
.border-primary {
    border-color: var(--primary-color, #3b82f6);
}

.bg-primary\/5 {
    background-color: rgba(59, 130, 246, 0.05);
}

.text-primary {
    color: var(--primary-color, #3b82f6);
}

.hover\:text-primary\/80:hover {
    color: rgba(59, 130, 246, 0.8);
}
</style>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="deleteProductForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="px-6 py-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-900">Delete Textile</h3>
                        <p class="text-sm text-gray-600 mt-1">Are you sure you want to delete this textile? This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Cancel</button>
                <button type="button" id="confirmDeleteBtn" onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors">Delete</button>
            </div>
        </form>
</div>

<script>
let currentProductId = null;
let isEditMode = false;

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add New Textile';
    document.getElementById('productModal').classList.remove('hidden');
    document.getElementById('productModal').classList.add('flex');
    isEditMode = false;
    clearForm();
    // Hide current image filename and preview
    document.getElementById('currentImageFilename').classList.add('hidden');
    document.getElementById('currentImageFilename').textContent = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('uploadPrompt').classList.remove('hidden');
    // Change button text back to Save
    var btn = document.getElementById('saveProductBtn');
    btn.textContent = 'Save Textile';
    btn.onclick = function(e) { saveProductAjax(e); };
}

// Accept filePath, selectedItemTypes, and price as arguments
function openUpdateModal(texttileId, name, price, filePath, selectedItemTypes) {
    document.getElementById('modalTitle').textContent = 'Update Textile';
    document.getElementById('productModal').classList.remove('hidden');
    document.getElementById('productModal').classList.add('flex');
    currentProductId = texttileId;
    isEditMode = true;
    
    // Populate name field
    document.getElementById('productName').value = name;
    
    // Populate price field
    document.getElementById('texttilePrice').value = price;

    // Uncheck all checkboxes first
    var checkboxes = document.querySelectorAll('input[name="item_types[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });

    // Check the selected item types
    if (selectedItemTypes && Array.isArray(selectedItemTypes)) {
        selectedItemTypes.forEach(function(typeId) {
            var checkbox = document.getElementById('itemType' + typeId);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }

    // Show current image filename and preview if filePath is provided
    var filenameDiv = document.getElementById('currentImageFilename');
    var imagePreview = document.getElementById('imagePreview');
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');
    var uploadPrompt = document.getElementById('uploadPrompt');
    if (filePath && filePath !== 'null' && filePath !== '') {
        // Extract filename from filePath
        var filename = filePath.split('/').pop();
        filenameDiv.textContent = 'Current image: ' + filename;
        filenameDiv.classList.remove('hidden');
        // Set preview if image exists
        var previewPath = filePath.startsWith('texttiles/') ? filePath : 'texttiles/' + filePath;
        imagePreview.src = '/storage/' + previewPath;
        imagePreviewContainer.classList.remove('hidden');
        uploadPrompt.classList.add('hidden');
    } else {
        filenameDiv.textContent = '';
        filenameDiv.classList.add('hidden');
        imagePreviewContainer.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
    }

    // Change button to Update
    var btn = document.getElementById('saveProductBtn');
    btn.textContent = 'Update Textile';
    btn.onclick = updateProductAjax;
}

function updateProductAjax(e) {
    var btn = document.getElementById('saveProductBtn');
    btn.disabled = true;
    btn.textContent = 'Updating...';
    var form = e.target.closest('form');
    var url = '/admin/texttile/' + currentProductId + '/update';
    var formData = new FormData(form);
    formData.append('id', currentProductId);
    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        },
        body: formData
    }).finally(function() {
        location.reload();
    });
}

function closeProductModal() {
    document.getElementById('productModal').classList.add('hidden');
    document.getElementById('productModal').classList.remove('flex');
    clearForm();
}

function openDeleteModal(texttileId) {
    currentProductId = texttileId;
    // Set the form action to the correct route for deleting a texttile using Laravel's route helper
    var form = document.getElementById('deleteProductForm');
    // Use a placeholder in the route and replace it with the texttileId
    var routeTemplate = "{{ route('admin.texttile.delete', [':id']) }}";
    form.action = routeTemplate.replace(':id', texttileId);
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
    currentProductId = null;
}

// function saveProduct() {
//     const productType = document.getElementById('productType').value;
//     const productName = document.getElementById('productName').value;
//     const productStock = document.getElementById('productStock').value;
//     const productPrice = document.getElementById('productPrice').value;
    
//     if (!productType || !productName || !productStock || !productPrice) {
//         alert('Please fill in all fields');
//         return;
//     }
    
//     // Here you would typically send the data to your backend
//     console.log('Saving product:', { productType, productName, productStock, productPrice });
    
//     closeProductModal();
//     alert(isEditMode ? 'Product updated successfully!' : 'Product added successfully!');
// }

function confirmDelete() {
    var btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.textContent = 'Deleting...';
    // Get CSRF token from meta or form
    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('#deleteProductForm input[name="_token"]').value;
    // Build the delete URL using Laravel route helper
    var texttileId = currentProductId;
    var routeTemplate = "{{ route('admin.texttile.delete', [':id']) }}";
    var url = routeTemplate.replace(':id', texttileId);
    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
    }).finally(function() {
        location.reload();
    });
}

function clearForm() {
    document.getElementById('productName').value = '';
    document.getElementById('texttilePrice').value = '';
    document.getElementById('productImage').value = '';
    
    // Uncheck all item type checkboxes
    var checkboxes = document.querySelectorAll('input[name="item_types[]"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
    
    // Hide filename and preview
    document.getElementById('currentImageFilename').classList.add('hidden');
    document.getElementById('currentImageFilename').textContent = '';
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('uploadPrompt').classList.remove('hidden');
}

// Close modals when clicking outside
document.getElementById('productModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProductModal();
    }
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>   
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        // Add padding to DataTable controls after initialization
        $('#productsTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
            { orderable: false, targets: 0 },
            { orderable: false, targets: -1 }
            ],
            drawCallback: function() {
            // Add padding classes to DataTable controls
            $('.dataTables_length').addClass('px-4 py-2');
            $('.dataTables_filter').addClass('px-4 py-2');
            $('.dataTables_paginate').addClass('px-4 py-2');
            }
        });
        // Initial padding for controls
        $('.dataTables_length').addClass('px-4 py-2');
        $('.dataTables_filter').addClass('px-4 py-2');
        $('.dataTables_paginate').addClass('px-4 py-2');
        });
</script>

@include('admin.includes.script')
@include('admin.includes.footer')
