@include('jinja.includes.header')
@include('jinja.includes.nav')
<main class="main-content">
    <!-- Shop Header -->
    <section class="shop-header">
        <div class="container">
            <h1>Our Products</h1>
            <p>Discover authentic local products crafted by skilled artisans</p>
        </div>
    </section>
    <!-- Product Tabs -->
    <section class="shop-section">
        <div class="container">
            <div class="shop-tabs">
                <button class="tab-btn active" onclick="showTab('all')">All Products</button>
                <button class="tab-btn" onclick="showTab('handicrafts')">Handicrafts</button>
                <button class="tab-btn" onclick="showTab('food')">Food & Beverages</button>
                <button class="tab-btn" onclick="showTab('textiles')">Textiles</button>
                <button class="tab-btn" onclick="showTab('pottery')">Pottery</button>
                <button class="tab-btn custom-tab" onclick="showCustomizeModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Add Customize Product
                </button>
            </div>
            <!-- All Products Tab -->
            <div class="tab-content active" id="all">
                <div class="products-grid">
                    <div class="product-card" data-category="handicrafts">
                        <img src="/placeholder.svg?height=250&width=250" alt="Woven Basket">
                        <div class="product-info">
                            <h3>Traditional Woven Basket</h3>
                            <p class="product-category">Handicrafts</p>
                            <p class="product-price">₱450.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 1, name: 'Traditional Woven Basket', price: 450, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="pottery">
                        <img src="/placeholder.svg?height=250&width=250" alt="Handmade Pottery">
                        <div class="product-info">
                            <h3>Handmade Pottery Set</h3>
                            <p class="product-category">Pottery</p>
                            <p class="product-price">₱680.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 2, name: 'Handmade Pottery Set', price: 680, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="food">
                        <img src="/placeholder.svg?height=250&width=250" alt="Organic Honey">
                        <div class="product-info">
                            <h3>Pure Organic Honey</h3>
                            <p class="product-category">Food & Beverages</p>
                            <p class="product-price">₱320.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 3, name: 'Pure Organic Honey', price: 320, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="textiles">
                        <img src="/placeholder.svg?height=250&width=250" alt="Traditional Textile">
                        <div class="product-info">
                            <h3>Traditional Textile</h3>
                            <p class="product-category">Textiles</p>
                            <p class="product-price">₱890.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 4, name: 'Traditional Textile', price: 890, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="handicrafts">
                        <img src="/placeholder.svg?height=250&width=250" alt="Wooden Craft">
                        <div class="product-info">
                            <h3>Handcrafted Wood Art</h3>
                            <p class="product-category">Handicrafts</p>
                            <p class="product-price">₱1,250.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 5, name: 'Handcrafted Wood Art', price: 1250, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="food">
                        <img src="/placeholder.svg?height=250&width=250" alt="Coffee Beans">
                        <div class="product-info">
                            <h3>Premium Coffee Beans</h3>
                            <p class="product-category">Food & Beverages</p>
                            <p class="product-price">₱540.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 6, name: 'Premium Coffee Beans', price: 540, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="textiles">
                        <img src="/placeholder.svg?height=250&width=250" alt="Embroidered Bag">
                        <div class="product-info">
                            <h3>Embroidered Handbag</h3>
                            <p class="product-category">Textiles</p>
                            <p class="product-price">₱750.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 7, name: 'Embroidered Handbag', price: 750, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="pottery">
                        <img src="/placeholder.svg?height=250&width=250" alt="Ceramic Vase">
                        <div class="product-info">
                            <h3>Decorative Ceramic Vase</h3>
                            <p class="product-category">Pottery</p>
                            <p class="product-price">₱420.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 8, name: 'Decorative Ceramic Vase', price: 420, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                    <div class="product-card" data-category="food">
                        <img src="/placeholder.svg?height=250&width=250" alt="Dried Fruits">
                        <div class="product-info">
                            <h3>Mixed Dried Fruits</h3>
                            <p class="product-category">Food & Beverages</p>
                            <p class="product-price">₱280.00</p>
                            <button class="add-to-cart-btn" onclick="addToCart({id: 9, name: 'Mixed Dried Fruits', price: 280, image: '/placeholder.svg?height=60&width=60'})">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual Category Tabs (Hidden by default) -->
            <div class="tab-content" id="handicrafts"></div>
            <div class="tab-content" id="food"></div>
            <div class="tab-content" id="textiles"></div>
            <div class="tab-content" id="pottery"></div>
        </div>
    </section>
</main>
<script>
        // Tab functionality
        function showTab(category) {
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Show/hide products based on category
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Customize modal functionality
        function showCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'flex';
        }

        function closeCustomizeModal() {
            document.getElementById('customizeModal').style.display = 'none';
            document.getElementById('customizeForm').reset();
        }

        // Handle customize form submission
        document.getElementById('customizeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const customProduct = {
                name: formData.get('productName'),
                category: formData.get('productCategory'),
                price: parseFloat(formData.get('productPrice')),
                description: formData.get('productDescription'),
                customizations: formData.get('customizations')
            };
            
            // Here you would typically send this to your backend
            alert('Custom product request submitted successfully! We will contact you soon.');
            closeCustomizeModal();
        });

        // Active navigation highlighting
      

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setActiveNav();
            updateCartBadge();
        });
    </script>
@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')