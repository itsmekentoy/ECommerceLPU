@include('jinja.includes.header')
@include('jinja.includes.nav')
<main class="main-content">
        <!-- Contact Header -->
        <section class="contact-header">
            <div class="container">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="container">
                <div class="contact-grid">
                    <!-- Contact Information -->
                    <div class="contact-info">
                        <h2>Get in Touch</h2>
                        <p>Have questions about our products or need assistance? We're here to help!</p>
                        
                        <div class="contact-details">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22S19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9S10.62 6.5 12 6.5S14.5 7.62 14.5 9S13.38 11.5 12 11.5Z"/>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <h4>Address</h4>
                                    <p>Munting Tubig, Ibaan<br>Philippines 4230</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6.62 10.79C8.06 13.62 10.38 15.94 13.21 17.38L15.41 15.18C15.69 14.9 16.08 14.82 16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z"/>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <h4>Phone</h4>
                                    <p>+63 961 487 6218</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <h4>Email</h4>
                                    <p>engreyman@gmail.com</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22S22 17.52 22 12S17.52 2 12 2ZM11 19.93C7.05 19.44 4 16.08 4 12C4 11.38 4.08 10.79 4.21 10.21L9 15V16C9 17.1 9.9 18 11 18V19.93ZM17.9 17.39C17.64 16.58 16.9 16 16 16H15V13C15 12.45 14.55 12 14 12H8V10H10C10.55 10 11 9.55 11 9V7H13C14.1 7 15 6.1 15 5V4.59C17.93 5.77 20 8.65 20 12C20 14.08 19.2 15.97 17.9 17.39Z"/>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <h4>Business Hours</h4>
                                    <p>Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 4:00 PM<br>Sunday: Closed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-container">
                        <form class="contact-form" id="contactForm">
                            <h3>Send us a Message</h3>
                            
                           
                                <div class="form-group">
                                    <label for="firstName">First Name *</label>
                                    <input type="text" id="firstName" name="firstName"
                                    @if($currentCustomer)
                                        value="{{ $currentCustomer->name }}"
                                    @endif
                                    required>
                                    
                                </div>
                               
                            
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email"
                                @if($currentCustomer)
                                    value="{{ $currentCustomer->email }}"
                                @endif
                                required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone"
                                @if($currentCustomer)
                                    value="{{ $currentCustomer->phone }}"
                                @endif>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="product">Product Information</option>
                                    <option value="order">Order Support</option>
                                    <option value="custom">Custom Product Request</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="6" placeholder="Please provide details about your inquiry..." required></textarea>
                            </div>
                            
                            
                            
                            <button type="submit" class="submit-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2.01 21L23 12L2.01 3L2 10L17 12L2 14L2.01 21Z"/>
                                </svg>
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="container">
                <h2>Find Us</h2>
                <div class="map-container">
                    <div class="map-wrapper">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.7421844106907!2d121.16230317514977!3d13.854508286548135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd1353e2ef64c9%3A0xdb78526ee640c04d!2sSM%20Sunrise%20Weaving%20Association!5e0!3m2!1sen!2sph!4v1759854682581!5m2!1sen!2sph" 
                            width="100%" 
                            height="450" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <div class="map-info-card">
                            <div class="map-info">
                                <h4>SM Sunrise Weaving Association</h4>
                                <p>Ibaan, Batangas</p>
                                <a href="https://www.google.com/maps/dir//SM+Sunrise+Weaving+Association/@13.854508286548135,121.16230317514977,15z" target="_blank" class="directions-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22S19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9S10.62 6.5 12 6.5S14.5 7.62 14.5 9S13.38 11.5 12 11.5Z"/>
                                    </svg>
                                    Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@include('jinja.includes.cart')
@include('jinja.includes.footer')
@include('jinja.includes.scripts')