@include('jinja.includes.header')
@include('jinja.includes.nav')
<main class="main-content">
    <!-- Hero Carousel Section -->
    <section class="hero-carousel">
        <div class="carousel-container">
            <div class="carousel-slides" id="carouselSlides">
                <div class="slide active">
                    <img src="{{ asset('imgs/image1.jpg') }}" alt="Local Products">
                    <div class="slide-content">
                        <h1>Welcome to HabingIbaan</h1>
                        <p>Discover authentic local products and crafts from Ibaan</p>
                        <a href="{{ route('shop') }}" class="cta-btn">Shop Now</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('imgs/image2.jpg') }}" alt="Handicrafts">
                    <div class="slide-content">
                        <h1>Handcrafted Excellence</h1>
                        <p>Support local artisans and their beautiful creations</p>
                        <a href="{{ route('shop') }}" class="cta-btn">Explore Collection</a>
                    </div>
                </div>
                <div class="slide">
                    <img src="{{ asset('imgs/image3.jpg') }}" alt="Fresh Products">
                    <div class="slide-content">
                        <h1>Fresh & Local</h1>
                        <p>Fresh products delivered to your doorstep</p>
                        <a href="{{ route('shop') }}" class="cta-btn">Order Fresh</a>
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
                @foreach($featuredItems as $item)
                <div class="product-card">
                    <img src="{{ asset('storage/products/' . $item->file_path) }}" alt="{{ $item->item_name }}">
                    <div class="product-info">
                        <h3>{{ $item->item_name }}</h3>
                        <p class="product-description" title="{{ $item->description }}">{{ $item->description }}</p> 
                        <p class="product-price">₱{{ number_format($item->price, 2) }}</p>
                       
                        <button onclick="openAddToCartModal({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $item->price }}, '{{ $item->file_path }}', {{ $item->stock }})"
                            class="add-to-cart-btn">
                            View
                        </button>


                    </div>
                </div>
                @endforeach
                
                
                
            </div>
        </div>
    </section>
</main>    

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