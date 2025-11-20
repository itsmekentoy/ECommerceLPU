<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Home</title>
    <link rel="stylesheet" href="{{ asset('/css/landing.css') }}">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.html" class="nav-brand">
                <span class="habing">Habing</span><span class="ibaan">Ibaan</span>
            </a>
            
            <ul class="nav-menu">
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="shops.html">Shops</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
            
            <div class="nav-actions">
                <button class="cart-btn" onclick="toggleCart()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                    </svg>
                    Cart
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>
                <a href="login.html" class="login-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.11 3.89 23 5 23H19C20.11 23 21 22.11 21 21V9M19 21H5V3H13V9H19V21Z"/>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Carousel Section -->
        <section class="hero-carousel">
            <div class="carousel-container">
                <div class="carousel-slides" id="carouselSlides">
                    <div class="slide active">
                        <img src="/placeholder.svg?height=500&width=1200" alt="Local Products">
                        <div class="slide-content">
                            <h1>Welcome to HabingIbaan</h1>
                            <p>Discover authentic local products and crafts from Ibaan</p>
                            <a href="shops.html" class="cta-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="/placeholder.svg?height=500&width=1200" alt="Handicrafts">
                        <div class="slide-content">
                            <h1>Handcrafted Excellence</h1>
                            <p>Support local artisans and their beautiful creations</p>
                            <a href="shops.html" class="cta-btn">Explore Collection</a>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="/placeholder.svg?height=500&width=1200" alt="Fresh Products">
                        <div class="slide-content">
                            <h1>Fresh & Local</h1>
                            <p>Farm-fresh products delivered to your doorstep</p>
                            <a href="shops.html" class="cta-btn">Order Fresh</a>
                        </div>
                    </div>
                </div>
                <button class="carousel-btn prev" onclick="changeSlide(-1)">&#10094;</button>
                <button class="carousel-btn next" onclick="changeSlide(1)">&#10095;</button>
                <div class="carousel-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="featured-section">
            <div class="container">
                <h2>Featured Products</h2>
                <p class="section-subtitle">Discover our most popular local products</p>
                
                <div class="featured-grid">
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Woven Basket">
                        <div class="product-info">
                            <h3>Traditional Woven Basket</h3>
                            <p class="product-price">₱450.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 1, name: 'Traditional Woven Basket', price: 450, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Handmade Pottery">
                        <div class="product-info">
                            <h3>Handmade Pottery Set</h3>
                            <p class="product-price">₱680.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 2, name: 'Handmade Pottery Set', price: 680, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Organic Honey">
                        <div class="product-info">
                            <h3>Pure Organic Honey</h3>
                            <p class="product-price">₱320.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 3, name: 'Pure Organic Honey', price: 320, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Traditional Textile">
                        <div class="product-info">
                            <h3>Traditional Textile</h3>
                            <p class="product-price">₱890.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 4, name: 'Traditional Textile', price: 890, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Wooden Craft">
                        <div class="product-info">
                            <h3>Handcrafted Wood Art</h3>
                            <p class="product-price">₱1,250.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 5, name: 'Handcrafted Wood Art', price: 1250, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="/placeholder.svg?height=250&width=250" alt="Coffee Beans">
                        <div class="product-info">
                            <h3>Premium Coffee Beans</h3>
                            <p class="product-price">₱540.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 6, name: 'Premium Coffee Beans', price: 540, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h3>Shopping Cart</h3>
            <button class="close-cart" onclick="toggleCart()">&times;</button>
        </div>
        <div class="cart-content" id="cartContent">
            <p style="text-align: center; color: var(--muted-foreground); padding: 2rem;">Your cart is empty</p>
        </div>
        <div class="cart-total" id="cartTotal" style="display: none;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                <span>Total:</span>
                <span id="totalAmount">₱0.00</span>
            </div>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>

    <!-- Overlay -->
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
        function setActiveNav() {
            const currentPage = window.location.pathname.split('/').pop() || 'index.html';
            const navLinks = document.querySelectorAll('.nav-menu a');
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                }
            });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setActiveNav();
            updateCartBadge();
        });
    </script>
</body>
</html>
