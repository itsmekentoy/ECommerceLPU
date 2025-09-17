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
    // Cart functionality
    let cartItems = [];
    let cartCount = 0;
    function toggleCart() {
        const sidebar = document.getElementById('cartSidebar');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    }
    function updateCartBadge() {
        document.getElementById('cartBadge').textContent = cartCount;
    }
    function addToCart(product) {
        const existingItem = cartItems.find(item => item.id === product.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cartItems.push({...product, quantity: 1});
        }
        
        cartCount++;
        updateCartBadge();
        renderCartItems();
    }
    function removeFromCart(productId) {
        const itemIndex = cartItems.findIndex(item => item.id === productId);
        if (itemIndex > -1) {
            const item = cartItems[itemIndex];
            cartCount -= item.quantity;
            cartItems.splice(itemIndex, 1);
            updateCartBadge();
            renderCartItems();
        }
    }
    function updateQuantity(productId, change) {
        const item = cartItems.find(item => item.id === productId);
        if (item) {
            const newQuantity = item.quantity + change;
            if (newQuantity > 0) {
                item.quantity = newQuantity;
                cartCount += change;
            } else {
                removeFromCart(productId);
                return;
            }
            updateCartBadge();
            renderCartItems();
        }
    }
    function renderCartItems() {
        const cartContent = document.getElementById('cartContent');
        const cartTotal = document.getElementById('cartTotal');
        
        if (cartItems.length === 0) {
            cartContent.innerHTML = '<p style="text-align: center; color: var(--muted-foreground); padding: 2rem;">Your cart is empty</p>';
            cartTotal.style.display = 'none';
            return;
        }
        let total = 0;
        const itemsHTML = cartItems.map(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            return `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="cart-item-info">
                        <h4>${item.name}</h4>
                        <div class="cart-item-price">₱${item.price.toFixed(2)}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                            <button onclick="removeFromCart(${item.id})" style="margin-left: auto; background: none; border: none; color: var(--destructive); cursor: pointer;">Remove</button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
        cartContent.innerHTML = itemsHTML;
        document.getElementById('totalAmount').textContent = `₱${total.toFixed(2)}`;
        cartTotal.style.display = 'block';
    }
    // Active navigation highlighting
   
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setActiveNav();
        updateCartBadge();
    });
</script>