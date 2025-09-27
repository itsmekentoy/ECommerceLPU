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
                        <p class="product-price">₱{{ number_format($item->price, 2) }}</p>
                        <button class="add-to-cart-btn"
                        @if ($item->stock <= 0)
                            disabled style='background-color: gray; cursor: not-allowed;'
                        @endif
                        onclick="addToCart({id: {{ $item->id }}, name: '{{ addslashes($item->item_name) }}', price: {{ $item->price }}, image: '{{ asset('storage/products/' . $item->file_path) }}'})">
                        @if ($item->stock > 0)
                            Add to Cart
                        @else
                            Out of Stock
                            
                        @endif
                        </button>
                    </div>
                </div>
                @endforeach
                
                
                
            </div>
        </div>
    </section>
</main>    
@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')