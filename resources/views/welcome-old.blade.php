<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Traditional Filipino Textiles</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <div class="logo">Habing<span>Ibaan</span></div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#shop">Shop</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
            <div class="nav-actions">
                <input type="text" class="search-bar" placeholder="Search our product">
                <button class="icon-btn">🛒</button>
                <button class="icon-btn">👤</button>
            </div>
        </nav>
    </header>

    <!-- Carousel Section -->
    <section class="carousel-container">
        <div class="carousel">
            <div class="carousel-slide active">
                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-oRSelP2vC9koDaR75nN0tHCIhT2ZJY.png" alt="Traditional Handicrafts">
            </div>
            <div class="carousel-slide">
                <img src="/placeholder.svg?height=400&width=1200" alt="Weaving Process">
            </div>
            <div class="carousel-slide">
                <img src="/placeholder.svg?height=400&width=1200" alt="Handwoven Products">
            </div>
        </div>
        <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">❮</button>
        <button class="carousel-nav carousel-next" onclick="changeSlide(1)">❯</button>
        <div class="carousel-dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="featured-products">
        <h2 class="section-title">FEATURED PRODUCTS</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="/placeholder.svg?height=200&width=200" alt="Black Bag">
                <div class="product-info">
                    <button class="view-btn">View</button>
                </div>
            </div>
            <div class="product-card">
                <img src="/placeholder.svg?height=200&width=200" alt="Checkered Textile">
                <div class="product-info">
                    <button class="view-btn">View</button>
                </div>
            </div>
            <div class="product-card">
                <img src="/placeholder.svg?height=200&width=200" alt="Blue Bag">
                <div class="product-info">
                    <button class="view-btn">View</button>
                </div>
            </div>
            <div class="product-card">
                <img src="/placeholder.svg?height=200&width=200" alt="Messenger Bag">
                <div class="product-info">
                    <button class="view-btn">View</button>
                </div>
            </div>
            <div class="product-card">
                <img src="/placeholder.svg?height=200&width=200" alt="Striped Scarf">
                <div class="product-info">
                    <button class="view-btn">View</button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-section">
        <h2 class="section-title">ABOUT US</h2>
        <div class="about-content">
            <p class="about-text">
                SM Sunrise Weaving is a proud local enterprise specializing in habi, the traditional handwoven textiles that are integral to Filipino culture. Established on June 8, 2017, our organization is committed to the preservation and growth of this cultural heritage. With a strong foundation in traditional weaving techniques, we aim to keep the Filipino craft alive while adapting to the evolving needs of modern design.
            </p>
        </div>
        
        <div class="mission-vision">
            <div class="mission">
                <h3>MISSION</h3>
                <p>Mapaunlad, mapatibay at mapalakas ang Samahan sa pamamagitan ng tradisyonal na paghahabi.</p>
            </div>
            
            
            
            <div class="vision">
                <h3>VISION</h3>
                <p>Makasabay ang produktong habi sa takbo ng panahon kung saan naangkop at maiaangat ang uri ng produktong habi at makikita bilang isang tanyag na habihan sa buong Calabarzon sa taong 2022.</p>
            </div>
        </div>
    </section>

    <!-- Product Catalog -->
    <section class="product-catalog">
        <div class="catalog-nav">
            <button class="catalog-tab active" onclick="showCatalog('textiles')">Textiles</button>
            <button class="catalog-tab" onclick="showCatalog('wallets')">Wallets</button>
            <button class="catalog-tab" onclick="showCatalog('bags')">Bags</button>
            <button class="catalog-tab" onclick="showCatalog('customize')">Customize</button>
            <button class="filter-btn">Filter ⚙️</button>
        </div>

        <!-- Textiles Catalog -->
        <div id="textiles" class="catalog-content active">
            <div class="catalog-grid">
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Red Textile">
                    <div class="catalog-card-info">
                        <h4>Traditional Textile</h4>
                        <div class="price">₱450.00 <span class="sold-count">12 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Brown Textile">
                    <div class="catalog-card-info">
                        <h4>Striped Textile</h4>
                        <div class="price">₱380.00 <span class="sold-count">8 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Geometric Textile">
                    <div class="catalog-card-info">
                        <h4>Geometric Textile</h4>
                        <div class="price">₱520.00 <span class="sold-count">15 sold</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wallets Catalog -->
        <div id="wallets" class="catalog-content">
            <div class="catalog-grid">
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Pink Wallet">
                    <div class="catalog-card-info">
                        <h4>WALLET</h4>
                        <div class="price">₱120.00 <span class="sold-count">9 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Brown Wallet">
                    <div class="catalog-card-info">
                        <h4>LEATHER WALLET</h4>
                        <div class="price">₱180.00 <span class="sold-count">15 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Coin Purse">
                    <div class="catalog-card-info">
                        <h4>COIN PURSE</h4>
                        <div class="price">₱95.00 <span class="sold-count">22 sold</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bags Catalog -->
        <div id="bags" class="catalog-content">
            <div class="catalog-grid">
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Blue Bag">
                    <div class="catalog-card-info">
                        <h4>BAG</h4>
                        <div class="price">₱350.00 <span class="sold-count">65 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Tote Bag">
                    <div class="catalog-card-info">
                        <h4>TOTE BAG</h4>
                        <div class="price">₱250.00 <span class="sold-count">27 sold</span></div>
                    </div>
                </div>
                <div class="catalog-card">
                    <img src="/placeholder.svg?height=200&width=250" alt="Shoulder Bag">
                    <div class="catalog-card-info">
                        <h4>SHOULDER BAG</h4>
                        <div class="price">₱420.00 <span class="sold-count">18 sold</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customize Interface -->
        <div id="customize" class="catalog-content">
            <div class="customize-interface active">
                <div class="customize-sidebar">
                    <h3>Textiles</h3>
                    
                    <div class="customize-options">
                        <h4>Size</h4>
                        <div class="option-buttons">
                            <button class="option-btn active" onclick="selectOption(this)">1 yard</button>
                            <button class="option-btn" onclick="selectOption(this)">2 yards</button>
                            <button class="option-btn" onclick="selectOption(this)">3 yards</button>
                        </div>
                    </div>

                    <div class="customize-options">
                        <h4>Types</h4>
                        <div class="option-buttons">
                            <button class="option-btn active" onclick="selectOption(this)">Bag</button>
                            <button class="option-btn" onclick="selectOption(this)">Wallet</button>
                            <button class="option-btn" onclick="selectOption(this)">Pillowcase</button>
                        </div>
                    </div>
                </div>

                <div class="textile-patterns">
                    <div class="pattern-sample active" onclick="selectPattern(this)">
                        <img src="/placeholder.svg?height=80&width=80" alt="Red Pattern">
                    </div>
                    <div class="pattern-sample" onclick="selectPattern(this)">
                        <img src="/placeholder.svg?height=80&width=80" alt="Brown Pattern">
                    </div>
                    <div class="pattern-sample" onclick="selectPattern(this)">
                        <img src="/placeholder.svg?height=80&width=80" alt="Blue Pattern">
                    </div>
                </div>

                <div class="product-preview">
                    <div class="preview-image">
                        <img src="/placeholder.svg?height=200&width=200" alt="Preview Product">
                    </div>
                    
                    <div class="price-breakdown">
                        <div class="price-line">
                            <span>Total:</span>
                            <span>₱120.00</span>
                        </div>
                        <div class="price-line">
                            <span>Shipping:</span>
                            <span>₱100.00</span>
                        </div>
                        <div class="price-line">
                            <span>Subtotal:</span>
                            <span>₱220.00</span>
                        </div>
                    </div>

                    <div class="cart-buttons">
                        <button class="cart-btn add-to-cart">ADD TO CART</button>
                        <button class="cart-btn checkout">CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>HabingIbaan | 2025</p>
    </footer>

    <script>
        // Carousel functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function changeSlide(direction) {
            currentSlideIndex += direction;
            if (currentSlideIndex >= slides.length) currentSlideIndex = 0;
            if (currentSlideIndex < 0) currentSlideIndex = slides.length - 1;
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

        // Catalog functionality
        function showCatalog(category) {
            // Remove active class from all tabs and content
            document.querySelectorAll('.catalog-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.catalog-content').forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked tab
            event.target.classList.add('active');
            
            // Show corresponding content
            document.getElementById(category).classList.add('active');
        }

        // Customize interface functionality
        function selectOption(button) {
            // Remove active class from siblings
            button.parentNode.querySelectorAll('.option-btn').forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');
        }

        function selectPattern(pattern) {
            // Remove active class from all patterns
            document.querySelectorAll('.pattern-sample').forEach(p => p.classList.remove('active'));
            // Add active class to clicked pattern
            pattern.classList.add('active');
        }
    </script>
</body>
</html>
