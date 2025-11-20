<div class="overlay" id="overlay" onclick="toggleCart()"></div>

<script>
    // Carousel functionality
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }
    function changeSlide(direction) {
        currentSlideIndex += direction;
        
        if (currentSlideIndex >= slides.length) {
            currentSlideIndex = 0;
        } else if (currentSlideIndex < 0) {
            currentSlideIndex = slides.length - 1;
        }
        
        showSlide(currentSlideIndex);
    }
    function currentSlide(index) {
        currentSlideIndex = index - 1;
        showSlide(currentSlideIndex);
    }
    // Auto-advance carousel
    setInterval(() => {
        changeSlide(1);
    }, 5000);
    
    // Active navigation highlighting
   
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setActiveNav();
        
    });
    // Product tab switching
    function showTab(event, category) {
        // Remove 'active' class from all tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        // Add 'active' class to the clicked tab
        event.currentTarget.classList.add('active');

        // Get search query if exists
        const searchInput = document.getElementById('searchInput');
        const searchQuery = searchInput ? searchInput.value.toLowerCase().trim() : '';

        // Show/hide products by category and search
        document.querySelectorAll('.product-card').forEach(card => {
            const matchesCategory = category === 'all' || card.getAttribute('data-category') === category;
            
            if (matchesCategory) {
                // If there's a search query, also check if product matches search
                if (searchQuery !== '') {
                    const productName = card.querySelector('h3').textContent.toLowerCase();
                    const productDescription = card.querySelector('.product-description') 
                        ? card.querySelector('.product-description').textContent.toLowerCase() 
                        : '';
                    
                    if (productName.includes(searchQuery) || productDescription.includes(searchQuery)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    card.style.display = '';
                }
            } else {
                card.style.display = 'none';
            }
        });

        // Update search results if search input exists
        if (searchInput && searchQuery !== '') {
            const searchResults = document.getElementById('searchResults');
            const visibleCount = Array.from(document.querySelectorAll('.product-card')).filter(card => card.style.display !== 'none').length;
            
            if (visibleCount === 0) {
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
    }

    // Add to Cart Modal functionality
    let currentProductId = null;
    let currentMaxStock = 0;

    function openAddToCartModal(productId, productName, productPrice, productImage, stock, description = '') {
        console.log('Opening modal for product:', productId, productName);
        currentProductId = productId;
        currentMaxStock = stock;

        // Get modal element
        const modal = document.getElementById('addToCartModal');
        console.log('Modal element:', modal);

        // Set product details in modal
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalProductPrice').textContent = '₱' + parseFloat(productPrice).toFixed(2);
        document.getElementById('modalProductImage').src = '/storage/products/' + productImage;
        document.getElementById('modalProductStock').textContent = stock;
        document.getElementById('modalProductDescription').textContent = description || 'No description available.';
        document.getElementById('modalQuantity').value = 1;
        document.getElementById('modalQuantity').max = stock;

        // Check if out of stock
        const stockText = document.getElementById('modalStockText');
        const unavailableText = document.getElementById('modalUnavailable');
        const quantityControl = document.getElementById('modalQuantityControl');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const buyNowBtn = document.getElementById('buyNowBtn');
        const addToCartBtn = document.getElementById('addToCartBtn');

        if (stock <= 0) {
            // Show unavailable, hide stock
            if (stockText) stockText.style.display = 'none';
            if (unavailableText) unavailableText.style.display = 'block';
            
            // Disable quantity controls
            if (quantityControl) quantityControl.style.opacity = '0.5';
            if (decreaseBtn) decreaseBtn.disabled = true;
            if (increaseBtn) increaseBtn.disabled = true;
            
            // Disable buttons
            if (buyNowBtn) {
                buyNowBtn.disabled = true;
                buyNowBtn.style.opacity = '0.5';
                buyNowBtn.style.cursor = 'not-allowed';
            }
            if (addToCartBtn) {
                addToCartBtn.disabled = true;
                addToCartBtn.style.opacity = '0.5';
                addToCartBtn.style.cursor = 'not-allowed';
            }
        } else {
            // Show stock, hide unavailable
            if (stockText) stockText.style.display = 'block';
            if (unavailableText) unavailableText.style.display = 'none';
            
            // Enable quantity controls
            if (quantityControl) quantityControl.style.opacity = '1';
            if (decreaseBtn) decreaseBtn.disabled = false;
            if (increaseBtn) increaseBtn.disabled = false;
            
            // Enable buttons
            if (buyNowBtn) {
                buyNowBtn.disabled = false;
                buyNowBtn.style.opacity = '1';
                buyNowBtn.style.cursor = 'pointer';
            }
            if (addToCartBtn) {
                addToCartBtn.disabled = false;
                addToCartBtn.style.opacity = '1';
                addToCartBtn.style.cursor = 'pointer';
            }
        }

        // Show modal
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            console.log('Modal opened successfully');
        } else {
            console.error('Modal element not found!');
        }
    }

    function closeAddToCartModal() {
        document.getElementById('addToCartModal').classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
        currentProductId = null;
        currentMaxStock = 0;
    }

    function increaseQuantity() {
        const quantityInput = document.getElementById('modalQuantity');
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < currentMaxStock) {
            quantityInput.value = currentValue + 1;
        }
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('modalQuantity');
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }

    function confirmAddToCart() {
        if (!currentProductId) return;
        
        // Check if product is out of stock
        if (currentMaxStock <= 0) {
            alert('This product is currently unavailable.');
            return;
        }

        const quantity = parseInt(document.getElementById('modalQuantity').value);
        const productName = document.getElementById('modalProductName').textContent;
        
        // Call the existing addToCart function with quantity
        fetch("{{ route('add.to.cart') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ item_id: currentProductId, quantity: quantity }),
        })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                // Close modal
                closeAddToCartModal();
                
                // Reload cart
                if (typeof loadCart === 'function') {
                    loadCart();
                }
                
                // Show success toast
                showSuccessToast(`${productName} added to cart!`);
            } else {
                alert(data.error || 'Failed to add item to cart.');
            }
        })
        .catch((error) => {
            console.error('Error adding to cart:', error);
            alert('An error occurred while adding to cart.');
        });
    }

    // Simple toast notification function
    function showSuccessToast(message) {
        // Create toast element
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #10b981;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            animation: slideIn 0.3s ease-out;
        `;
        
        // Add animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        if (!document.getElementById('toast-animations')) {
            style.id = 'toast-animations';
            document.head.appendChild(style);
        }
        
        // Add to page
        document.body.appendChild(toast);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => {
                if (toast.parentNode) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }

    function buyNow() {
        if (!currentProductId) {
            console.error('No product ID found');
            return;
        }
        
        // Check if product is out of stock
        if (currentMaxStock <= 0) {
            alert('This product is currently unavailable.');
            return;
        }

        const quantity = parseInt(document.getElementById('modalQuantity').value);
        const productName = document.getElementById('modalProductName').textContent;
        const productPrice = document.getElementById('modalProductPrice').textContent.replace('₱', '').replace(',', '');
        const productImage = document.getElementById('modalProductImage').src;

        console.log('Buy Now clicked - Product ID:', currentProductId, 'Quantity:', quantity);
        
        // Store the item in localStorage for direct checkout
        const directCheckoutItem = {
            item_id: currentProductId,
            item_name: productName,
            price: parseFloat(productPrice),
            quantity: quantity,
            image: productImage.split('/storage/products/')[1], // Get just the filename
            timestamp: Date.now()
        };

        // Save to localStorage
        localStorage.setItem('directCheckoutItem', JSON.stringify(directCheckoutItem));
        console.log('Saved to localStorage:', directCheckoutItem);
        
        // Disable button and show loading
        const buyNowBtn = document.getElementById('buyNowBtn');
        if (buyNowBtn) {
            buyNowBtn.disabled = true;
            buyNowBtn.textContent = 'Processing...';
            buyNowBtn.style.opacity = '0.7';
        }

        // Redirect to direct checkout
        window.location.href = "{{ route('item.direct.checkout') }}";
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('addToCartModal');
        if (modal && event.target === modal) {
            closeAddToCartModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('addToCartModal');
            if (modal && modal.classList.contains('active')) {
                closeAddToCartModal();
            }
        }
    });
</script>