@include('jinja.includes.header')
@include('jinja.includes.nav')
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
@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')