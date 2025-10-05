@include('jinja.includes.header')
@include('jinja.includes.nav')

<main class="main-content">
    <!-- Shop Header -->
    <section class="shop-header py-6 bg-gray-100">
        <div class="container mx-auto text-center">
            <h1 class="text-2xl font-bold">Our Products</h1>
            <p class="text-gray-600">Discover authentic local products crafted by skilled artisans</p>
        </div>
    </section>

    <!-- Product Tabs -->
    <section class="shop-section py-8">
        <div class="container mx-auto">
            <!-- Tabs -->
            <div class="shop-tabs flex flex-wrap gap-2 mb-6">
                <button class="tab-btn active px-4 py-2 bg-blue-500 text-white rounded"
                        onclick="showTab(event, 'all')">
                    All
                </button>
                @foreach ($itemTypes as $itemType)
                    <button class="tab-btn px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            onclick="showTab(event, '{{ $itemType->id }}')">
                        {{ $itemType->type_name }}
                    </button>
                @endforeach
                <button class="tab-btn custom-tab flex items-center gap-1 px-4 py-2 bg-green-500 text-white rounded"
                        >
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Add Customize Product
                </button>
            </div>

            <!-- Products Grid -->
            <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
                @foreach ($items as $itemType)
                    @foreach ($itemType->items as $item)
                        <div class="product-card border rounded-lg p-4 shadow-sm hover:shadow-md"
                             data-category="{{ $itemType->id }}">
                            <!-- Product Image -->
                            <img src="{{ asset('storage/products/' . $item->file_path) }}"
                                 alt="{{ $item->item_name }}"
                                 class="w-full h-48 object-cover rounded">

                            <!-- Product Info -->
                            <div class="product-info mt-3">
                                <h3 class="font-semibold text-lg">{{ $item->item_name }}</h3>
                                <p class="product-category text-sm text-gray-500">{{ $itemType->type_name }}</p>
                                <p class="product-price font-bold text-blue-600">₱{{ number_format($item->price, 2) }}</p>

                                <!-- Add to Cart Button -->
                                @if($currentCustomer)
                               <button onclick="addToCart({{ $item->id }})"
                                    class="add-to-cart-btn"
                                    @if ($item->stock <= 0)
                                        disabled style="background-color: gray; cursor: not-allowed;"
                                    @endif>
                                    {{ $item->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</main>



@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')
