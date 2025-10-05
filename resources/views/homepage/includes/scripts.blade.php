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

        // Show/hide products by category
        document.querySelectorAll('.product-card').forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>