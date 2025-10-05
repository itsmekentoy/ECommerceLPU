@include('jinja.includes.header')
@include('jinja.includes.nav')
<main class="main-content">
        <!-- Hero Section with Background -->
        <section class="about-hero">
            <div class="hero-background">
                <img src="/placeholder.svg?height=400&width=1200" alt="Traditional Marketplace" class="watermark-bg">
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-content">
                <h1>About HabingIbaan</h1>
                <p>Connecting communities through authentic local products and traditional craftsmanship</p>
            </div>
        </section>

        <!-- About Us Section -->
        <section class="about-section">
            <div class="container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>About Us</h2>
                        <p>SM Sunrise Weaving is a proud local enterprise specializing in habi, the traditional handwoven textiles that are integral to Filipino culture. Established on June 8, 2017, our organization is committed to the preservation and growth of this cultural heritage. With a strong foundation in traditional weaving techniques, we aim to keep the Filipino craft alive while adapting to the evolving needs of modern design.</p>
                        
                        
                    </div>
                    
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section class="mission-vision-section">
            <div class="container">
                <div class="mv-grid">
                    <div class="mission-card">
                        <div class="card-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z"/>
                            </svg>
                        </div>
                        <h3>Our Mission</h3>
                        <p>Mapaunlad, mapatibay at mapalakas ang Samahan sa pamamagitan ng tradisyonal na paghahabi.</p>
                    </div>
                    
                    <div class="vision-card">
                        <div class="card-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7S17 9.24 17 12S14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15S15 13.66 15 12S13.66 9 12 9Z"/>
                            </svg>
                        </div>
                        <h3>Our Vision</h3>
                        <p>Makasabay ang produktong habi sa takbo ng panahon kung saan naangkop at maiaangat ang uri ng produktong habi at makilala bilang isang tanyag na habihan sa buong Calabarzon sa taong 2022.</p>
                    </div>
                </div>
            </div>
        </section>

        
    </main>
   
@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')