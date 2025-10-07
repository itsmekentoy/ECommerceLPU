@include('jinja.includes.header')
@include('jinja.includes.nav')

<main class="checkout-main">
    <div class="checkout-container">
        <div class="checkout-header">
            <h1 style="color: #c17854;">🛒 Direct Checkout (Buy Now)</h1>
            <p>Review your order and complete your purchase</p>
        </div>

        <!-- Loading State -->
        <div id="loadingState" style="text-align: center; padding: 3rem;">
            <div style="display: inline-block; width: 50px; height: 50px; border: 5px solid #f3f3f3; border-top: 5px solid #c17854; border-radius: 50%; animation: spin 1s linear infinite;"></div>
            <p style="margin-top: 1rem; color: #666;">Loading your item...</p>
        </div>

        <!-- Error State -->
        <div id="errorState" style="display: none; text-align: center; padding: 3rem;">
            <h2 style="color: #dc3545;">⚠️ No Item Found</h2>
            <p style="color: #666; margin: 1rem 0;">Please select an item to purchase.</p>
            <a href="{{ route('shop') }}" style="display: inline-block; padding: 0.75rem 2rem; background: #c17854; color: white; text-decoration: none; border-radius: 8px;">Back to Shop</a>
        </div>

        <!-- Checkout Form -->
        <form action="{{ route('order.place.direct') }}" method="POST" class="checkout-form" id="checkoutForm" style="display: none;">
            @csrf
            <input type="hidden" name="item_id" id="hiddenItemId">
            <input type="hidden" name="quantity" id="hiddenQuantity">
            
            <div class="checkout-content">
                <!-- Order Items Section -->
                <div class="order-items-section">
                    <h2>Order Item/s</h2>
                    <div class="order-items-list" id="orderItemsList">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Delivery Address Section -->
                <div class="delivery-section">
                    <h2>Delivery Address</h2>
                    <div class="form-group">
                        <label for="delivery_address">Enter your delivery address *</label>
                        <textarea 
                            id="delivery_address" 
                            name="delivery_address" 
                            rows="4" 
                            placeholder="Enter your complete delivery address..."
                            required
                        >{{ $customer->address ?? '' }}</textarea>
                        @error('delivery_address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div class="order-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span id="subtotalAmount">₱0.00</span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Grand Total:</span>
                        <span id="grandTotalAmount">₱0.00</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="checkout-actions">
                    <a href="{{ route('shop') }}" class="btn-cancel-checkout">Cancel</a>
                    <button type="submit" class="btn-place-order" id="placeOrderBtn">
                        <span id="placeOrderText">Place Order</span>
                        <span id="placeOrderLoader" style="display: none;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="animation: spin 1s linear infinite;">
                                <circle cx="12" cy="12" r="10" stroke-width="4" stroke="currentColor" stroke-opacity="0.25"></circle>
                                <path d="M12 2a10 10 0 0 1 10 10" stroke-width="4" stroke-linecap="round"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('===== DIRECT CHECKOUT PAGE LOADED =====');
    
    // Get item from localStorage
    const directCheckoutItemStr = localStorage.getItem('directCheckoutItem');
    
    if (!directCheckoutItemStr) {
        console.error('No direct checkout item found in localStorage');
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('errorState').style.display = 'block';
        return;
    }

    const item = JSON.parse(directCheckoutItemStr);
    console.log('Retrieved item from localStorage:', item);

    // Check if item is too old (more than 30 minutes)
    const thirtyMinutes = 30 * 60 * 1000;
    if (Date.now() - item.timestamp > thirtyMinutes) {
        console.error('Checkout item expired');
        localStorage.removeItem('directCheckoutItem');
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('errorState').style.display = 'block';
        return;
    }

    // Populate the form
    document.getElementById('hiddenItemId').value = item.item_id;
    document.getElementById('hiddenQuantity').value = item.quantity;

    // Calculate totals
    const subtotal = item.price * item.quantity;

    // Build the item HTML
    const itemHTML = `
        <div class="checkout-item">
            <img src="/storage/products/${item.image}" 
                 alt="${item.item_name}" 
                 class="checkout-item-image">
            <div class="checkout-item-details">
                <h3>${item.item_name}</h3>
                <p class="item-price">₱${parseFloat(item.price).toFixed(2)}</p>
                <p class="item-quantity">Quantity: ${item.quantity}</p>
            </div>
            <div class="checkout-item-total">
                <p class="item-subtotal">₱${subtotal.toFixed(2)}</p>
            </div>
        </div>
    `;

    // Update the DOM
    document.getElementById('orderItemsList').innerHTML = itemHTML;
    document.getElementById('subtotalAmount').textContent = '₱' + subtotal.toFixed(2);
    document.getElementById('grandTotalAmount').textContent = '₱' + subtotal.toFixed(2);

    // Show the form, hide loading
    document.getElementById('loadingState').style.display = 'none';
    document.getElementById('checkoutForm').style.display = 'block';

    // Handle form submission
    const form = document.getElementById('checkoutForm');
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    const placeOrderText = document.getElementById('placeOrderText');
    const placeOrderLoader = document.getElementById('placeOrderLoader');

    form.addEventListener('submit', function(e) {
        // Clear localStorage on submit
        localStorage.removeItem('directCheckoutItem');
        
        // Disable button to prevent multiple clicks
        placeOrderBtn.disabled = true;
        placeOrderBtn.style.opacity = '0.7';
        placeOrderBtn.style.cursor = 'not-allowed';
        
        // Show loader, hide text
        placeOrderText.style.display = 'none';
        placeOrderLoader.style.display = 'inline-flex';
        placeOrderLoader.style.alignItems = 'center';
        placeOrderLoader.style.gap = '0.5rem';
    });
});
</script>

<style>
/* Spinner Animation */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Checkout Page Styles */
.checkout-main {
    min-height: 100vh;
    background: #f5f5f5;
    padding: 2rem 1rem;
}

.checkout-container {
    max-width: 1200px;
    margin: 0 auto;
}

.checkout-header {
    text-align: center;
    margin-bottom: 2rem;
}

.checkout-header h1 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.checkout-header p {
    color: #666;
    font-size: 1rem;
}

.checkout-content {
    display: grid;
    gap: 2rem;
}

/* Order Items Section */
.order-items-section {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.order-items-section h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #c17854;
    padding-bottom: 0.5rem;
}

.order-items-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.checkout-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 8px;
    align-items: center;
}

.checkout-item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

.checkout-item-details {
    flex: 1;
}

.checkout-item-details h3 {
    font-size: 1.1rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.item-price {
    color: #c17854;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.item-quantity {
    color: #666;
    font-size: 0.9rem;
}

.checkout-item-total {
    text-align: right;
}

.item-subtotal {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

/* Delivery Section */
.delivery-section {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.delivery-section h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #c17854;
    padding-bottom: 0.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-weight: 600;
    color: #333;
    font-size: 1rem;
}

.form-group textarea {
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    resize: vertical;
    transition: border-color 0.3s;
}

.form-group textarea:focus {
    outline: none;
    border-color: #c17854;
}

.error-message {
    color: red;
    font-size: 0.875rem;
}

/* Order Summary */
.order-summary {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.order-summary h2 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #c17854;
    padding-bottom: 0.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #eee;
}

.summary-row span {
    font-size: 1rem;
    color: #666;
}

.total-row {
    border-bottom: none;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 2px solid #333;
}

.total-row span {
    font-size: 1.3rem;
    font-weight: bold;
    color: #333;
}

/* Action Buttons */
.checkout-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
}

.btn-cancel-checkout,
.btn-place-order {
    padding: 1rem 2.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-cancel-checkout {
    background: #f5f5f5;
    color: #666;
    border: 1px solid #ddd;
}

.btn-cancel-checkout:hover {
    background: #e0e0e0;
}

.btn-place-order {
    background: #c17854;
    color: white;
}

.btn-place-order:hover {
    background: #a66545;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(193, 120, 84, 0.3);
}

.btn-place-order:active {
    transform: translateY(0);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .checkout-main {
        padding: 1rem 0.5rem;
    }

    .checkout-header h1 {
        font-size: 1.5rem;
    }

    .order-items-section,
    .delivery-section,
    .order-summary {
        padding: 1.5rem;
    }

    .order-items-section h2,
    .delivery-section h2,
    .order-summary h2 {
        font-size: 1.25rem;
    }

    .checkout-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .checkout-item-image {
        width: 100px;
        height: 100px;
    }

    .checkout-item-total {
        text-align: center;
        width: 100%;
    }

    .checkout-actions {
        flex-direction: column;
        gap: 0.75rem;
    }

    .btn-cancel-checkout,
    .btn-place-order {
        width: 100%;
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .checkout-header h1 {
        font-size: 1.25rem;
    }

    .checkout-header p {
        font-size: 0.9rem;
    }

    .order-items-section,
    .delivery-section,
    .order-summary {
        padding: 1rem;
    }

    .checkout-item-details h3 {
        font-size: 1rem;
    }

    .item-price {
        font-size: 0.9rem;
    }

    .item-subtotal {
        font-size: 1rem;
    }

    .summary-row span {
        font-size: 0.9rem;
    }

    .total-row span {
        font-size: 1.1rem;
    }
}
</style>

@include('jinja.includes.footer')
