<nav class="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-brand">
            <span class="habing">Habing</span><span class="ibaan">Ibaan</span>
        </a>
        
        <ul class="nav-menu">
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            </li>
            <li>
                <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') ? 'active' : '' }}">Shops</a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
            </li>
        </ul>

        
        <div class="nav-actions">
            <button class="cart-btn" onclick="toggleCart()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14l.84-2h7.45c.75 0 1.41-.41 1.75-1.03l3.24-5.88A1 1 0 0 0 20.5 4H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7.42c-.14 0-.25-.11-.26-.25z"/>
                </svg>
                Cart
                <span class="cart-badge" id="cartBadge">0</span>
            </button>
            <a href="login.html" class="login-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10.09 15.59L8.67 14.17L11.17 11.67H4V9.67H11.17L8.67 7.17L10.09 5.75L15.34 11L10.09 15.59ZM20 19V5C20 3.9 19.1 3 18 3H12V5H18V19H12V21H18C19.1 21 20 20.1 20 19Z"/>
                </svg>
                Login
            </a>
        </div>
    </div>
</nav>