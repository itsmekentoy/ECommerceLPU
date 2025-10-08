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

    <!-- Search Bar -->
    <section class="search-section py-4 bg-white border-b">
        <div class="container mx-auto">
            <div class="search-container" style="max-width: 600px; margin: 0 auto; margin-top:50px;">
                <div style="position: relative;">
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Search for products..." 
                           style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 0.5rem; font-size: 1rem; outline: none; transition: border-color 0.3s;"
                           onkeyup="searchProducts()"
                           onfocus="this.style.borderColor='#ea580c'"
                           onblur="this.style.borderColor='#e5e7eb'">
                    <svg style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); width: 1.25rem; height: 1.25rem; color: #9ca3af; pointer-events: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div id="searchResults" style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;"></div>
            </div>
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
                        onclick="openCustomizeModal()">
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
                                 class="w-full h-48 object-cover rounded"
                                 style="margin-top: 10px;">

                            <!-- Product Info -->
                            <div class="product-info mt-3">
                                <h3 class="font-semibold text-lg">{{ $item->item_name }}</h3>
                                <p class="product-description text-sm text-gray-500" title="{{ $item->description }}">{{ $item->description }}</p>
                                <p class="product-price font-bold text-blue-600">₱{{ number_format($item->price, 2) }}</p>

                                <!-- Add to Cart Button -->
                                
                               <button onclick="openAddToCartModal({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $item->price }}, '{{ $item->file_path }}', {{ $item->stock }}, '{{ addslashes($item->description) }}')"
                                    class="add-to-cart-btn">
                                    View
                                </button>
                                
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</main>

<!-- Customize Product Modal -->
<div class="modal-overlay" id="customizeModal" style="display: none;">
    <div class="customize-modal">
        <div class="modal-header">
            <h3>Customize Your Product</h3>
            <button class="close-modal" onclick="closeCustomizeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <!-- Step 1: Select Textile -->
            <div id="step1" class="customize-step">
                <h4 class="step-title">Select Textile</h4>
                <div class="textile-grid">
                    @foreach($textiles as $textile)
                    <div class="textile-card" onclick="selectTextile({{ $textile->id }}, '{{ $textile->title }}', {{ $textile->price }}, '{{ $textile->file_path }}')">
                        <img src="{{ asset('storage/texttiles/' . $textile->file_path) }}" alt="{{ $textile->title }}" class="textile-image">
                        <div class="textile-info">
                            <h5>{{ $textile->title }}</h5>
                            <p class="textile-price">₱{{ number_format($textile->price, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Step 2: Select Category -->
            <div id="step2" class="customize-step" style="display: none;">
                <button class="btn-back" onclick="backToStep(1)">← Back</button>
                <h4 class="step-title">Select Product Category</h4>
                <p class="selected-info">Selected Textile: <strong id="selectedTextileName"></strong> (₱<span id="selectedTextilePrice"></span>)</p>
                <div class="category-dropdown">
                    <label for="categorySelect">Choose Category:</label>
                    <select id="categorySelect" onchange="selectCategory()" class="form-select">
                        <option value="">-- Select a Category --</option>
                    </select>
                </div>
            </div>

            <!-- Step 3: Select Product -->
            <div id="step3" class="customize-step" style="display: none;">
                <button class="btn-back" onclick="backToStep(2)">← Back</button>
                <h4 class="step-title">Select Product</h4>
                <p class="selected-info">
                    Textile: <strong id="selectedTextileName2"></strong> (₱<span id="selectedTextilePrice2"></span>) | 
                    Category: <strong id="selectedCategoryName"></strong>
                </p>
                <div class="products-grid-custom" id="customProductsGrid">
                    <!-- Products will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add to Cart Modal -->
<div class="modal-overlay" id="addToCartModal">
    <div class="add-to-cart-modal">
        <div class="modal-header">
            <h3>Add to Cart</h3>
            <button class="close-modal" onclick="closeAddToCartModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-product-info">
                <img id="modalProductImage" src="" alt="Product Image" class="modal-product-image">
                <div class="modal-product-details">
                    <h4 id="modalProductName"></h4>
                    <p class="modal-product-price" id="modalProductPrice"></p>
                    <p class="modal-product-stock" id="modalStockText">Available Stock: <span id="modalProductStock"></span></p>
                    <p class="modal-unavailable" id="modalUnavailable" style="display: none; color: red; font-weight: bold;">Unavailable</p>
                </div>
            </div>
            <div class="modal-product-description">
                <h5>Description</h5>
                <p id="modalProductDescription"></p>
            </div>
            <div class="modal-quantity-control" id="modalQuantityControl">
                <label for="modalQuantity">Quantity:</label>
                <div class="quantity-input-group">
                    <button class="quantity-btn" id="decreaseBtn" onclick="decreaseQuantity()">-</button>
                    <input type="number" id="modalQuantity" value="1" min="1" max="999" readonly>
                    <button class="quantity-btn" id="increaseBtn" onclick="increaseQuantity()">+</button>
                </div>
            </div>
            @if($currentCustomer)
            <div class="modal-actions">
                <button class="btn-cancel" id="buyNowBtn" onclick="buyNow()">Buy Now</button>
                <button class="btn-add-to-cart" id="addToCartBtn" onclick="confirmAddToCart()">Add to Cart</button>
            </div>
            @endif
        </div>
    </div>
</div>

@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')

<script>
// Search functionality
function searchProducts() {
    const searchInput = document.getElementById('searchInput');
    const searchQuery = searchInput.value.toLowerCase().trim();
    const productCards = document.querySelectorAll('.product-card');
    const searchResults = document.getElementById('searchResults');
    const activeTab = document.querySelector('.tab-btn.active');
    const activeCategory = activeTab ? activeTab.getAttribute('onclick').match(/'([^']+)'/)[1] : 'all';
    let visibleCount = 0;
    
    productCards.forEach(card => {
        const productName = card.querySelector('h3').textContent.toLowerCase();
        const productDescription = card.querySelector('.product-description').textContent.toLowerCase();
        const cardCategory = card.getAttribute('data-category');
        
        // Check if matches category filter
        const matchesCategory = activeCategory === 'all' || cardCategory === activeCategory;
        
        // Check if matches search query
        const matchesSearch = searchQuery === '' || productName.includes(searchQuery) || productDescription.includes(searchQuery);
        
        if (matchesCategory && matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    // Update search results text
    if (searchQuery === '') {
        searchResults.textContent = '';
    } else if (visibleCount === 0) {
        searchResults.textContent = 'No products found matching "' + searchQuery + '"';
        searchResults.style.color = '#ef4444';
    } else if (visibleCount === 1) {
        searchResults.textContent = '1 product found';
        searchResults.style.color = '#059669';
    } else {
        searchResults.textContent = visibleCount + ' products found';
        searchResults.style.color = '#059669';
    }
}

// Customization data
let selectedTextileId = null;
let selectedTextileData = {};
let selectedCategoryId = null;
let selectedCategoryName = '';
let textilesData = @json($textiles);

function openCustomizeModal() {
    document.getElementById('customizeModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    // Reset to step 1
    showStep(1);
}

function closeCustomizeModal() {
    document.getElementById('customizeModal').style.display = 'none';
    document.body.style.overflow = '';
    // Reset selections
    selectedTextileId = null;
    selectedTextileData = {};
    selectedCategoryId = null;
    selectedCategoryName = '';
}

function showStep(stepNumber) {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step' + stepNumber).style.display = 'block';
}

function backToStep(stepNumber) {
    showStep(stepNumber);
}

function selectTextile(textileId, textileName, textilePrice, textileImage) {
    selectedTextileId = textileId;
    selectedTextileData = {
        id: textileId,
        name: textileName,
        price: textilePrice,
        image: textileImage
    };

    console.log('Selected Textile:', selectedTextileData);

    // Update step 2 info
    document.getElementById('selectedTextileName').textContent = textileName;
    document.getElementById('selectedTextilePrice').textContent = textilePrice.toFixed(2);

    // Find categories for this textile
    const textile = textilesData.find(t => t.id === textileId);
    const categorySelect = document.getElementById('categorySelect');
    categorySelect.innerHTML = '<option value="">-- Select a Category --</option>';

    if (textile && textile.applied_to && textile.applied_to.length > 0) {
        textile.applied_to.forEach(appliedTo => {
            if (appliedTo.category) {
                const option = document.createElement('option');
                option.value = appliedTo.category.id;
                option.textContent = appliedTo.category.type_name;
                categorySelect.appendChild(option);
            }
        });
    }

    // Move to step 2
    showStep(2);
}

function selectCategory() {
    const categorySelect = document.getElementById('categorySelect');
    selectedCategoryId = categorySelect.value;
    selectedCategoryName = categorySelect.options[categorySelect.selectedIndex].text;

    if (!selectedCategoryId) return;

    console.log('Selected Category:', selectedCategoryId, selectedCategoryName);

    // Update step 3 info
    document.getElementById('selectedTextileName2').textContent = selectedTextileData.name;
    document.getElementById('selectedTextilePrice2').textContent = selectedTextileData.price.toFixed(2);
    document.getElementById('selectedCategoryName').textContent = selectedCategoryName;

    // Load products for this category
    loadProductsByCategory(selectedCategoryId);

    // Move to step 3
    showStep(3);
}

function loadProductsByCategory(categoryId) {
    const productsGrid = document.getElementById('customProductsGrid');
    productsGrid.innerHTML = '<p style="text-align: center; padding: 2rem;">Loading products...</p>';

    // Fetch products
    fetch(`/api/items-by-category/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            if (data.items && data.items.length > 0) {
                let html = '';
                data.items.forEach(item => {
                    const itemPrice = parseFloat(item.price);
                    const textilePrice = parseFloat(selectedTextileData.price);
                    const totalPrice = itemPrice + textilePrice;
                    
                    // Escape single quotes in item name
                    const escapedItemName = item.item_name.replace(/'/g, "\\'");
                    
                    html += `
                        <div class="product-card-custom">
                            <img src="/storage/products/${item.file_path}" alt="${item.item_name}" class="product-image-custom">
                            <div class="product-info-custom">
                                <h5>${item.item_name}</h5>
                                <div class="price-breakdown">
                                    <p class="product-price-detail">Item: ₱${itemPrice.toFixed(2)}</p>
                                    <p class="product-price-detail">Textile: ₱${textilePrice.toFixed(2)}</p>
                                    <p class="product-price-custom">Total: ₱${totalPrice.toFixed(2)}</p>
                                </div>
                                ${item.stock > 0 ? `
                                    <div class="custom-product-actions">
                                        <button class="btn-buy-now-custom" onclick="buyNowCustomized(${item.id}, '${escapedItemName}', ${totalPrice}, '${item.file_path}')">
                                            Buy Now
                                        </button>
                                        <button class="btn-add-cart-custom" onclick="addCustomizedToCart(${item.id}, '${escapedItemName}', ${item.price}, ${totalPrice})">
                                            Add to Cart
                                        </button>
                                    </div>
                                ` : `
                                    <button class="btn-select-product" disabled>
                                         Out of Stock
                                    </button>
                                `}
                            </div>
                        </div>
                    `;
                });
                productsGrid.innerHTML = html;
            } else {
                productsGrid.innerHTML = '<p style="text-align: center; padding: 2rem; color: #999;">No products found in this category.</p>';
            }
        })
        .catch(error => {
            console.error('Error loading products:', error);
            productsGrid.innerHTML = '<p style="text-align: center; padding: 2rem; color: red;">Error loading products.</p>';
        });
}

function addCustomizedToCart(productId, productName, productPrice, totalPrice) {
    // Check if customer is logged in
    const isLoggedIn = {{ $currentCustomer ? 'true' : 'false' }};
    
    if (!isLoggedIn) {
        alert('Please log in to add items to your cart.');
        return;
    }

    console.log('Adding to cart:', {
        productId,
        productName,
        productPrice,
        totalPrice,
        textileId: selectedTextileData.id,
        textileName: selectedTextileData.name
    });

    // Add to cart via API with customization
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            item_id: productId,
            quantity: 1,
            customization: selectedTextileData.id, // textile_id
            price: totalPrice // total price (item + textile)
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Response:', data);
        if (data.success) {
            // Close modal
            closeCustomizeModal();
            
            // Refresh cart display
            if (typeof loadCart === 'function') {
                loadCart();
            }
            
            // Optional: Show a subtle success notification (non-blocking)
            showSuccessToast('Customized product added to cart!');
        } else {
            alert(data.error || 'Failed to add item to cart.');
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        alert('An error occurred while adding to cart.');
    });
}

function buyNowCustomized(productId, productName, totalPrice, productImage) {
    // Check if customer is logged in
    const isLoggedIn = {{ $currentCustomer ? 'true' : 'false' }};
    
    if (!isLoggedIn) {
        alert('Please log in to purchase items.');
        return;
    }

    console.log('Buy Now customized:', {
        productId,
        productName,
        totalPrice,
        textileId: selectedTextileData.id,
        textileName: selectedTextileData.name,
        textilePrice: selectedTextileData.price
    });

    // Store the customized item in localStorage for direct checkout
    const directCheckoutItem = {
        item_id: productId,
        item_name: productName,
        price: totalPrice,
        quantity: 1,
        image: productImage,
        customization: selectedTextileData.id,
        textile_name: selectedTextileData.name,
        textile_price: selectedTextileData.price,
        timestamp: Date.now()
    };

    // Save to localStorage
    localStorage.setItem('directCheckoutItem', JSON.stringify(directCheckoutItem));
    console.log('Saved customized item to localStorage:', directCheckoutItem);
    
    // Close modal
    closeCustomizeModal();
    
    // Redirect to checkout
    window.location.href = '/item/direct-checkout';
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('customizeModal');
    if (modal && event.target === modal) {
        closeCustomizeModal();
    }
});
</script>

<style>
/* Customize Modal Styles */
.customize-modal {
    background: white;
    border-radius: 12px;
    max-width: 900px;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.customize-step {
    padding: 1rem 0;
}

.step-title {
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #c17854;
}

.selected-info {
    background: #f0f8ff;
    padding: 0.75rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    color: #333;
}

.btn-back {
    background: #6c757d;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    margin-bottom: 1rem;
    font-weight: 600;
}

.btn-back:hover {
    background: #5a6268;
}

/* Textile Grid */
.textile-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 0.75rem;
}

.textile-card {
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 0.75rem;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
}

.textile-card:hover {
    border-color: #c17854;
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(193, 120, 84, 0.3);
}

.textile-image {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 0.4rem;
}

.textile-info h5 {
    font-size: 1rem;
    color: #333;
    margin-bottom: 0.25rem;
}

.textile-price {
    color: #c17854;
    font-weight: bold;
    font-size: 1.1rem;
}

/* Category Dropdown */
.category-dropdown {
    margin: 1.5rem 0;
}

.category-dropdown label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.form-select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
}

.form-select:focus {
    outline: none;
    border-color: #c17854;
}

/* Products Grid Custom */
.products-grid-custom {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 0.75rem;
}

.product-card-custom {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 0.75rem;
    text-align: center;
    transition: all 0.3s;
}

.product-card-custom:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-image-custom {
    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: 6px;
    margin-bottom: 0.5rem;
}

.product-info-custom h5 {
    font-size: 1rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.price-breakdown {
    background: #f8f9fa;
    padding: 0.75rem;
    border-radius: 6px;
    margin: 0.5rem 0;
}

.product-price-detail {
    color: #666;
    font-size: 0.9rem;
    margin: 0.25rem 0;
}

.product-price-custom {
    color: #c17854;
    font-weight: bold;
    font-size: 1rem;
    margin: 0.5rem 0;
    padding-top: 0.5rem;
    border-top: 1px solid #ddd;
}

.product-stock-custom {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.75rem;
}

.custom-product-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.btn-buy-now-custom,
.btn-add-cart-custom {
    flex: 1;
    padding: 0.6rem 0.5rem;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-buy-now-custom {
    background: #10b981;
    color: white;
}

.btn-buy-now-custom:hover {
    background: #059669;
    transform: translateY(-2px);
}

.btn-add-cart-custom {
    background: rgb(194, 65, 12);
    color: white;
}

.btn-add-cart-custom:hover {
    background: rgb(154, 52, 18);
    transform: translateY(-2px);
}

.btn-select-product {
    width: 100%;
    padding: 0.75rem;
    background: #c17854;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-select-product:hover:not(:disabled) {
    background: #a66545;
    transform: translateY(-2px);
}

.btn-select-product:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .customize-modal {
        width: 98%;
        max-height: 95vh;
    }

    .textile-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .products-grid-custom {
        grid-template-columns: 1fr;
    }
}
</style>
