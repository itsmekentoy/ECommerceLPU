@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')

<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Add Carousel Item</h1>
        <p class="text-gray-600 mt-2">Create a new carousel slide with image, title, and subtitle</p>
    </div>

    <!-- Form -->
    <div class="flex justify-center">
        <div class="bg-white rounded-lg shadow-sm p-8 max-w-2xl w-full">
            <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}"
                    placeholder="e.g., Welcome to HabingIbaan"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-semibold text-gray-900 mb-2">
                    Subtitle
                </label>
                <input 
                    type="text" 
                    id="subtitle" 
                    name="subtitle" 
                    value="{{ old('subtitle') }}"
                    placeholder="e.g., Discover authentic local products and crafts"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('subtitle') border-red-500 @enderror"
                >
                @error('subtitle')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">
                    Image <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors cursor-pointer" id="dropZone">
                    <div class="space-y-1 text-center">
                        <div id="imagePreviewContainer" class="hidden mb-4">
                            <img id="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-lg shadow-md" src="" alt="Preview">
                            <button type="button" id="removeImage" class="mt-2 text-sm text-red-600 hover:text-red-800">Remove Image</button>
                        </div>
                        <div id="uploadPrompt">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-14-8v8m0 0l-4-4m4 4l4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div class="flex text-sm text-gray-600 mt-2">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark">
                                    <span>Click to upload</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF, WEBP up to 5MB</p>
                        </div>
                    </div>
                </div>
                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Storage Disk -->
            <div style="display: none;s">
                <label for="storage_disk" class="block text-sm font-semibold text-gray-900 mb-2">
                    Storage Location
                </label>
                <select 
                    id="storage_disk" 
                    name="storage_disk"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                >
                    <option value="public" disabled>Local Storage (Public)</option>
                    <option value="s3" selected>Amazon S3</option>
                </select>
                <p class="text-xs text-gray-500 mt-2">Choose where to store the carousel image</p>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-gray-900 mb-2">
                    Display Order
                </label>
                <input 
                    type="number" 
                    id="sort_order" 
                    name="sort_order" 
                    value="{{ old('sort_order', 0) }}"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                >
                <p class="text-xs text-gray-500 mt-2">Lower numbers appear first (0 = first position)</p>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.carousel.index') }}" class="px-6 py-2 border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors font-medium"
                >
                    Create Carousel Item
                </button>
            </div>
        </form>
    </div>
</div>

<script>
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const uploadPrompt = document.getElementById('uploadPrompt');
const removeImageBtn = document.getElementById('removeImage');

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Highlight drop zone when dragging over it
['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.add('border-primary', 'bg-blue-50'), false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => dropZone.classList.remove('border-primary', 'bg-blue-50'), false);
});

// Handle drop
dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;
    previewImage(files[0]);
}

// Handle file input change
fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        previewImage(e.target.files[0]);
    }
});

function previewImage(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.remove('hidden');
            uploadPrompt.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

removeImageBtn.addEventListener('click', (e) => {
    e.preventDefault();
    fileInput.value = '';
    imagePreviewContainer.classList.add('hidden');
    uploadPrompt.classList.remove('hidden');
});

// Click on drop zone to open file picker
dropZone.addEventListener('click', () => fileInput.click());
</script>

    </div>
</div>

@include('admin.includes.script')
@include('admin.includes.footer')
