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
           
            @if(session()->has('customer_id'))

                <button type="button" class="login-btn" onclick="openProfileModal()" style="margin-right:0.5rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                    </svg>
                    Profile
                </button>

                <!-- Chat Button and Dropdown -->
                <div style="display:inline-block;position:relative;">
                    <button type="button" id="chatBtn" style="background:#fff;border:none;border-radius:50%;width:2.5rem;height:2.5rem;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.12);cursor:pointer;">
                        <svg width="22" height="22" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </button>
                    <div id="chatDropdown" style="display:none;position:absolute;right:0;top:2.8rem;width:340px;background:#fff;border-radius:1rem;box-shadow:0 8px 32px rgba(0,0,0,0.18);padding:0.5rem 0.5rem 0.5rem 0.5rem;z-index:10000;">
                        <div style="font-weight:600;font-size:1rem;margin-bottom:0.5rem;">Chats</div>
                        <div style="max-height:180px;overflow-y:auto;margin-bottom:0.5rem;">
                            <!-- Example chat list -->
                            <div onclick="openChatModal('John Doe')" style="padding:0.5rem 0.5rem;border-bottom:1px solid #f3f4f6;cursor:pointer;display:flex;align-items:center;">
                                <div style="width:2.2rem;height:2.2rem;background:#fed7aa;border-radius:50%;margin-right:0.7rem;"></div>
                                <div>
                                    <div style="font-weight:500;">John Doe</div>
                                    <div style="font-size:0.85rem;color:#6b7280;">Hey, I have a question...</div>
                                </div>
                            </div>
                            <div onclick="openChatModal('Jane Smith')" style="padding:0.5rem 0.5rem;border-bottom:1px solid #f3f4f6;cursor:pointer;display:flex;align-items:center;">
                                <div style="width:2.2rem;height:2.2rem;background:#fca5a5;border-radius:50%;margin-right:0.7rem;"></div>
                                <div>
                                    <div style="font-weight:500;">Jane Smith</div>
                                    <div style="font-size:0.85rem;color:#6b7280;">Thank you for your help!</div>
                                </div>
                            </div>
                            <div onclick="openChatModal('Support')" style="padding:0.5rem 0.5rem;cursor:pointer;display:flex;align-items:center;">
                                <div style="width:2.2rem;height:2.2rem;background:#a7f3d0;border-radius:50%;margin-right:0.7rem;"></div>
                                <div>
                                    <div style="font-weight:500;">Support</div>
                                    <div style="font-size:0.85rem;color:#6b7280;">How can we assist you?</div>
                                </div>
                            </div>
                <!-- Chat Conversation Modal -->
                <div id="chatModal" style="position:fixed;inset:0;z-index:10001;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.4);">
                    <div style="background:#fff;border-radius:1.25rem;box-shadow:0 10px 40px rgba(0,0,0,0.2);width:100%;max-width:420px;padding:2rem;position:relative;display:flex;flex-direction:column;max-height:90vh;">
                        <button onclick="closeChatModal()" style="position:absolute;top:1rem;right:1rem;color:#6b7280;font-size:2rem;background:none;border:none;cursor:pointer;">&times;</button>
                        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.2rem;">
                            <div id="chatModalAvatar" style="width:2.8rem;height:2.8rem;background:#fed7aa;border-radius:50%;"></div>
                            <div id="chatModalName" style="font-weight:600;font-size:1.1rem;">Chat Name</div>
                        </div>
                        <div id="chatMessages" style="flex:1;overflow-y:auto;background:#f9fafb;border-radius:0.7rem;padding:1rem;margin-bottom:1rem;min-height:120px;max-height:220px;">
                            <!-- Example messages -->
                            <div style="margin-bottom:0.7rem;"><span style="background:#ea580c;color:#fff;padding:0.4rem 0.8rem;border-radius:1rem 1rem 0.2rem 1rem;display:inline-block;">Hello! How can I help you?</span></div>
                            <div style="text-align:right;"><span style="background:#e5e7eb;color:#374151;padding:0.4rem 0.8rem;border-radius:1rem 1rem 1rem 0.2rem;display:inline-block;">I have a question about my order.</span></div>
                        </div>
                        <form id="chatModalForm" style="display:flex;align-items:center;gap:0.4rem;">
                            <input type="text" placeholder="Type a message..." style="flex:1;padding:0.5rem 0.8rem;border:1px solid #d1d5db;border-radius:0.5rem;outline:none;font-size:1rem;" />
                            <label for="chatModalAttachment" style="cursor:pointer;display:flex;align-items:center;">
                                <svg width="20" height="20" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M21.44 11.05l-9.19 9.19a5 5 0 0 1-7.07-7.07l9.19-9.19a3 3 0 0 1 4.24 4.24l-9.19 9.19a1 1 0 0 1-1.41-1.41l9.19-9.19"/>
                                </svg>
                                <input type="file" id="chatModalAttachment" style="display:none;" />
                            </label>
                            <button type="submit" style="background:#ea580c;color:#fff;border:none;border-radius:0.5rem;padding:0.5rem 1rem;font-weight:600;cursor:pointer;">Send</button>
                        </form>
                    </div>
                </div>
                <script>
                    function openChatModal(name) {
                        document.getElementById('chatModal').style.display = 'flex';
                        document.getElementById('chatModalName').textContent = name;
                        // Set avatar color based on name (for demo)
                        var avatar = document.getElementById('chatModalAvatar');
                        if(name === 'Jane Smith') avatar.style.background = '#fca5a5';
                        else if(name === 'Support') avatar.style.background = '#a7f3d0';
                        else avatar.style.background = '#fed7aa';
                    }
                    function closeChatModal() {
                        document.getElementById('chatModal').style.display = 'none';
                    }
                    document.getElementById('chatModalForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        // TODO: Add AJAX send logic here
                        alert('Message sent (template only)');
                    });
                </script>
                        </div>
                        <!-- Message box removed from dropdown -->
                    </div>
                </div>

                <script>
                    // Chat dropdown toggle
                    document.getElementById('chatBtn').addEventListener('click', function(e) {
                        e.stopPropagation();
                        var dropdown = document.getElementById('chatDropdown');
                        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                    });
                    // Hide chat dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        var dropdown = document.getElementById('chatDropdown');
                        if (dropdown && dropdown.style.display === 'block' && !dropdown.contains(e.target) && e.target.id !== 'chatBtn') {
                            dropdown.style.display = 'none';
                        }
                    });
                    // Prevent form submit default for chat message
                    document.getElementById('chatMessageForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        // TODO: Add AJAX send logic here
                        alert('Message sent (template only)');
                    });
                </script>


                <!-- Profile Modal with Inline CSS -->
                <div id="profileModal" style="position:fixed;inset:0;z-index:9999;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.4);">
                    <div style="background:#fff;border-radius:1.25rem;box-shadow:0 10px 40px rgba(0,0,0,0.2);width:100%;max-width:400px;padding:2rem;position:relative;">
                        <button onclick="closeProfileModal()" style="position:absolute;top:1rem;right:1rem;color:#6b7280;font-size:2rem;background:none;border:none;cursor:pointer;">&times;</button>
                        <div style="display:flex;flex-direction:column;align-items:center;margin-bottom:1.5rem;">
                            <div style="position:relative;width:6rem;height:6rem;margin-bottom:0.5rem;">
                                <img src="/imgs/logo.png" alt="Profile" style="width:100%;height:100%;object-fit:cover;border-radius:9999px;border:4px solid #fed7aa;" />
                                <button type="button" onclick="triggerProfileImageUpload()" title="Update Image" style="position:absolute;bottom:0.2rem;right:0.2rem;background:#fff;border:none;border-radius:50%;width:2.2rem;height:2.2rem;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.12);cursor:pointer;padding:0;">
                                    <svg width="20" height="20" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19.5 3 21l1.5-4L16.5 3.5z"/>
                                    </svg>
                                </button>
                                <input type="file" id="profileImageInput" accept="image/*" style="display:none;" />
                            </div>
                <script>
                    function triggerProfileImageUpload() {
                        document.getElementById('profileImageInput').click();
                    }
                    document.getElementById('profileImageInput').addEventListener('change', function(e) {
                        // TODO: Add AJAX upload logic here
                        alert('Profile image update feature coming soon!');
                    });
                </script>
                            <div id="profileName" style="font-size:1.25rem;font-weight:600;margin-bottom:0.25rem;">{{ session('customer_name', 'Customer Name') }}</div>
                            <div id="profileEmail" style="color:#6b7280;font-size:0.875rem;">{{ session('customer_email', 'customer@email.com') }}</div>
                        </div>
                        <hr style="margin-bottom:1.5rem;">
                        <form id="profileForm">
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalName">Name</label>
                                <input id="modalName" name="name" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;outline:none;" value="{{ session('customer_name', 'Customer Name') }}">
                            </div>
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalEmail">Email</label>
                                <input id="modalEmail" name="email" type="email" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;background:#f3f4f6;" value="{{ session('customer_email', 'customer@email.com') }}" readonly>
                            </div>
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalMobile">Mobile Number</label>
                                <input id="modalMobile" name="mobile" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;" value="{{ session('customer_mobile', '') }}">
                            </div>
                            <div style="margin-bottom:1.5rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalAddress">Address</label>
                                <input id="modalAddress" name="address" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;" value="{{ session('customer_address', '') }}">
                            </div>
                            <div style="display:flex;justify-content:flex-end;gap:0.5rem;">
                                <button type="button" onclick="closeProfileModal()" style="padding:0.5rem 1rem;border-radius:0.5rem;background:#e5e7eb;color:#374151;border:none;cursor:pointer;">Close</button>
                                <button type="submit" style="padding:0.5rem 1rem;border-radius:0.5rem;background:#ea580c;color:#fff;font-weight:600;border:none;cursor:pointer;">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function openProfileModal() {
                        document.getElementById('profileModal').style.display = 'flex';
                    }
                    function closeProfileModal() {
                        document.getElementById('profileModal').style.display = 'none';
                    }
                    document.getElementById('profileForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        // TODO: Add AJAX call to save changes if needed
                        closeProfileModal();
                    });
                </script>
                
            @else
                <a href="{{ route('login') }}" class="login-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10.09 15.59L8.67 14.17L11.17 11.67H4V9.67H11.17L8.67 7.17L10.09 5.75L15.34 11L10.09 15.59ZM20 19V5C20 3.9 19.1 3 18 3H12V5H18V19H12V21H18C19.1 21 20 20.1 20 19Z"/>
                    </svg>
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>