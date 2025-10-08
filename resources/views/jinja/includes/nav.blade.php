<nav class="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="nav-brand">
            <span class="habing">Habing</span><span class="ibaan">Ibaan</span>
        </a>
        
        <!-- Hamburger Menu Button (Mobile Only) -->
        <button class="hamburger-menu" id="hamburgerMenu" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="toggleMobileMenu()"></div>
        
        <!-- Navigation Menu -->
        <ul class="nav-menu" id="navMenu">
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
            
            <!-- Mobile Only: Actions in Menu -->
            <div class="mobile-only-actions">
                @if($currentCustomer)
                <li class="mobile-menu-item">
                    <button class="mobile-cart-btn" onclick="toggleCart(); toggleMobileMenu();">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14l.84-2h7.45c.75 0 1.41-.41 1.75-1.03l3.24-5.88A1 1 0 0 0 20.5 4H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7.42c-.14 0-.25-.11-.26-.25z"/>
                        </svg>
                        <span>Cart</span>
                        <span class="cart-badge-mobile">{{ $countItems ?? 0 }}</span>
                    </button>
                </li>
                <li class="mobile-menu-item">
                    <button class="mobile-profile-btn" onclick="openProfileModal(); toggleMobileMenu();">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                        </svg>
                        <span>Profile</span>
                    </button>
                </li>
                <li class="mobile-menu-item">
                    <button class="mobile-chat-btn" onclick="document.getElementById('chatBtn').click(); toggleMobileMenu();">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                        <span>Chat</span>
                    </button>
                </li>
                @else
                <li class="mobile-menu-item">
                    <a href="{{ route('login') }}" class="mobile-login-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                        </svg>
                        <span>Login</span>
                    </a>
                </li>
                @endif
            </div>
        </ul>

        
        <div class="nav-actions desktop-only-actions">
            @if($currentCustomer)
            <button class="cart-btn" onclick="toggleCart()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14l.84-2h7.45c.75 0 1.41-.41 1.75-1.03l3.24-5.88A1 1 0 0 0 20.5 4H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7.42c-.14 0-.25-.11-.26-.25z"/>
                </svg>
                Cart
                <span class="cart-badge" id="cartBadge">
                    {{ $countItems ?? 0 }}  
                </span>
            </button>
            @endif
           
            @if($currentCustomer)

                <button type="button" class="login-btn" onclick="openProfileModal()" style="margin-right:0.5rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                    </svg>
                    Profile
                </button>

                @php
                    $adminChats = \App\Models\UserConversationWithAdmin::where('user_id', $currentCustomer->id)->with('admin')->get();
                    $adminConversationMap = [];
                    foreach ($adminChats as $chat) {
                        $adminConversationMap[$chat->admin->id] = $chat->id;
                    }
                @endphp
                <script>
                window.adminConversationMap = @json($adminConversationMap);
                </script>
                <div style="display:inline-block;position:relative;">
                    <button type="button" id="chatBtn" style="background:#fff;border:none;border-radius:50%;width:2.5rem;height:2.5rem;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 6px rgba(0,0,0,0.12);cursor:pointer;">
                        <svg width="22" height="22" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </button>
                    <div id="chatDropdown" style="display:none;position:absolute;right:0;top:2.8rem;width:340px;background:#fff;border-radius:1rem;box-shadow:0 8px 32px rgba(0,0,0,0.18);padding:0.5rem 0.5rem 0.5rem 0.5rem;z-index:10000;">
                        <div style="font-weight:600;font-size:1rem;margin-bottom:0.5rem;">Chats with Admins</div>
                        <div style="max-height:180px;overflow-y:auto;margin-bottom:0.5rem;">
                            @php
                                $adminChats = \App\Models\UserConversationWithAdmin::where('user_id', $currentCustomer->id)->with('admin')->get();
                            @endphp
                            @forelse($adminChats as $chat)
                                @php
                                    $latestMsg = \App\Models\ConversationMessage::where('conversation_id', $chat->id)->orderByDesc('created_at')->first();
                                @endphp
                                <div onclick="openChatModal('{{ $chat->admin->name ?? 'Admin' }}', '{{ $chat->admin->id }}')" style="padding:0.5rem 0.5rem;border-bottom:1px solid #f3f4f6;cursor:pointer;display:flex;align-items:center;">
                                    <div style="width:2.2rem;height:2.2rem;background:#fed7aa;border-radius:50%;margin-right:0.7rem;"></div>
                                    <div>
                                        <div style="font-weight:500;">{{ $chat->admin->name ?? 'Admin' }}</div>
                                        <div style="font-size:0.85rem;color:#6b7280;">
                                            {{ $latestMsg ? $latestMsg->message : 'No messages yet.' }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div style="padding:0.5rem;color:#6b7280;">No admin chats yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <!-- Chat Conversation Modal -->
                <div id="chatModal" style="position:fixed;inset:0;z-index:10001;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.4);">
                    <div style="background:#fff;border-radius:1.25rem;box-shadow:0 10px 40px rgba(0,0,0,0.2);width:100%;max-width:600px;padding:1.2rem;position:relative;display:flex;flex-direction:column;max-height:98vh;height:700px;">
                        <button onclick="closeChatModal()" style="position:absolute;top:1rem;right:1rem;color:#6b7280;font-size:2rem;background:none;border:none;cursor:pointer;">&times;</button>
                        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.2rem;">
                            <div id="chatModalAvatar" style="width:2.8rem;height:2.8rem;background:#fed7aa;border-radius:50%;"></div>
                            <div id="chatModalName" style="font-weight:600;font-size:1.1rem;">Conversation with Chat Name</div>
                        </div>
                        <div id="chatMessages" style="flex:1;overflow-y:auto;background:#f9fafb;border-radius:0.7rem;padding:1rem;margin-bottom:1rem;min-height:350px;max-height:520px;">
                            <!-- Example messages -->
                            <div style="display:none;"></div>
                        </div>
                        <form id="chatModalForm" style="display:flex;align-items:center;gap:0.4rem;">
                            <input type="text" placeholder="Type a message..." style="flex:1;padding:0.5rem 0.8rem;border:1px solid #d1d5db;border-radius:0.5rem;outline:none;font-size:1rem;" />
                            
                            <button type="submit" style="background:#ea580c;color:#fff;border:none;border-radius:0.5rem;padding:0.5rem 1rem;font-weight:600;cursor:pointer;">Send</button>
                        </form>
                    </div>
                </div>
                <script>
window.chatPollingInterval = null;
window.currentChatAdminId = null;

window.openChatModal = function(name, adminId) {
    document.getElementById('chatModal').style.display = 'flex';
    document.getElementById('chatModalName').textContent = 'Conversation with ' + name;
    window.currentChatAdminId = adminId;
    window.fetchChatMessages();
    window.startChatPolling();
    // Set avatar color based on name (for demo)
    var avatar = document.getElementById('chatModalAvatar');
    avatar.style.background = '#fed7aa';
}
window.closeChatModal = function() {
    document.getElementById('chatModal').style.display = 'none';
    window.stopChatPolling();
}
window.fetchChatMessages = function() {
    fetch('{{ route('conversation.fetch') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            conversation_id: window.getConversationIdForAdmin(window.currentChatAdminId)
        })
    })
    .then(response => response.json())
    .then(messages => {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.innerHTML = '';
        messages.forEach(msg => {
            const isSender = msg.sender_type === 'user';
            const msgDiv = document.createElement('div');
            msgDiv.style.marginBottom = '0.7rem';
            if (isSender) {
                msgDiv.style.textAlign = 'right';
                msgDiv.innerHTML = `<span style="background:#e5e7eb;color:#374151;padding:0.4rem 0.8rem;border-radius:1rem 1rem 1rem 0.2rem;display:inline-block;">${msg.message}</span>`;
            } else {
                msgDiv.innerHTML = `<span style="background:#ea580c;color:#fff;padding:0.4rem 0.8rem;border-radius:1rem 1rem 0.2rem 1rem;display:inline-block;">${msg.message}</span>`;
            }
            chatMessages.appendChild(msgDiv);
        });
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
}
window.sendChatMessage = function(e) {
    e.preventDefault();
    const input = document.querySelector('#chatModalForm input[type="text"]');
    const sendBtn = document.querySelector('#chatModalForm button[type="submit"]');
    const messageText = input.value.trim();
    if (!messageText) return;
    // Show loader/spinner and disable button
    sendBtn.disabled = true;
    const originalBtnContent = sendBtn.innerHTML;
    sendBtn.innerHTML = `<span class="spinner" style="display:inline-block;width:18px;height:18px;border:2px solid #fff;border-top:2px solid #ea580c;border-radius:50%;animation:spin 0.8s linear infinite;margin-right:6px;"></span>Sending...`;
    fetch('{{ route('conversation.send') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            conversation_id: window.getConversationIdForAdmin(window.currentChatAdminId),
            sender_type: 'user',
            sender_id: {{ $currentCustomer->id ?? 'null' }},
            message: messageText
        })
    })
    .then(response => response.json())
    .then(data => {
        input.value = '';
        window.fetchChatMessages();
    })
    .finally(() => {
        sendBtn.disabled = false;
        sendBtn.innerHTML = originalBtnContent;
    });
}

// Add spinner animation CSS
const style = document.createElement('style');
style.innerHTML = `@keyframes spin { 0% { transform: rotate(0deg);} 100% { transform: rotate(360deg);} }`;
document.head.appendChild(style);

window.startChatPolling = function() {
    if (window.chatPollingInterval) clearInterval(window.chatPollingInterval);
    window.chatPollingInterval = setInterval(window.fetchChatMessages, 2000);
}
window.stopChatPolling = function() {
    if (window.chatPollingInterval) clearInterval(window.chatPollingInterval);
}
window.getConversationIdForAdmin = function(adminId) {
    // You may want to pass conversation_id from blade, or fetch it via AJAX
    // For demo, assume you have a JS object mapping adminId to conversationId
    if (window.adminConversationMap && window.adminConversationMap[adminId]) {
        return window.adminConversationMap[adminId];
    }
    return null;
}
document.getElementById('chatModalForm').addEventListener('submit', window.sendChatMessage);
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
                    <div style="background:#fff;border-radius:1.25rem;box-shadow:0 10px 40px rgba(0,0,0,0.2);width:100%;max-width:550px;padding:2rem;position:relative;">
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
                            <div id="profileName" style="font-size:1.25rem;font-weight:600;margin-bottom:0.25rem;">{{ $currentCustomer->name ?? 'Customer Name' }}</div>
                            <div id="profileEmail" style="color:#6b7280;font-size:0.875rem;">{{ $currentCustomer->email ?? 'customer@email.com' }}</div>
                        </div>
                        <hr style="margin-bottom:1.5rem;">
                        <form id="profileForm">
                            @csrf
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalName">Name</label>
                                <input id="modalName" name="name" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;outline:none;" value="{{ $currentCustomer->name ?? '' }}">
                            </div>
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalEmail">Email</label>
                                <input id="modalEmail" name="email" type="email" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;background:#f3f4f6;" value="{{ $currentCustomer->email ?? '' }}" readonly>
                            </div>
                            <div style="margin-bottom:1rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalMobile">Mobile Number</label>
                                <input id="modalMobile" name="mobile" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;" value="{{ $currentCustomer->phone ?? '' }}">
                            </div>
                            <div style="margin-bottom:1.5rem;">
                                <label style="display:block;color:#374151;font-size:0.875rem;font-weight:500;margin-bottom:0.25rem;" for="modalAddress">Address</label>
                                <input id="modalAddress" name="address" type="text" style="width:100%;padding:0.5rem 1rem;border:1px solid #d1d5db;border-radius:0.5rem;" value="{{ $currentCustomer->address ?? '' }}">
                            </div>
                            <div style="display:flex;justify-content:flex-end;gap:0.5rem;">
                                <button type="button" onclick="closeProfileModal()" style="padding:0.5rem 1rem;border-radius:0.5rem;background:#e5e7eb;color:#374151;border:none;cursor:pointer;">Close</button>
                                <button type="button" onclick="document.getElementById('logoutForm').submit()" style="padding:0.5rem 1rem;border-radius:0.5rem;background:#ef4444;color:#fff;font-weight:600;border:none;cursor:pointer;">Logout</button>
                                <button type="submit" style="padding:0.5rem 1rem;border-radius:0.5rem;background:#ea580c;color:#fff;font-weight:600;border:none;cursor:pointer;">Save Changes</button>
                            </div>
                        </form>
                        <!-- Hidden logout form outside profile form and button row -->
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
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
                        
                        // put it into form data
                        var formData = new FormData(this);
                        formData.append('customer_id', '{{ $currentCustomer->id }}');
                        fetch('{{ route('customer.update.profile') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(
                            // reload the page to reflect changes
                            () => window.location.reload()
                        )
                        .catch(error => {
                            console.error('Error updating profile:', error);
                        });

                        
                    });
                </script>
                
            @else
                <a href="{{ route('login') }}" class="login-btn">
                        
                    Login
                </a>
            @endif
        </div>
    </div>
</nav>
<!-- Overlay -->
<div id="overlay" class="overlay" style="position:fixed;inset:0;z-index:9998;display:none;background:rgba(0,0,0,0.4);">
    <button onclick="closeCart()" style="position:absolute;top:1.5rem;right:2rem;background:none;border:none;font-size:2rem;color:#fff;cursor:pointer;z-index:10000;">&times;</button>
</div>

<!-- Sidebar -->
<div id="cartSidebar" class="cart-sidebar">
    <h3 style="text-align:center;margin-top:1rem;">Your Cart</h3>
    <div id="cartContent"></div>
    <div id="cartTotal" style="display: none;">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <strong>Total:</strong> <span id="totalAmount">₱0.00</span>
            <button id="checkoutBtn" onclick="checkout()" style="margin-top: 1rem; padding: 0.5rem 1.5rem; background: #ea580c; color: #fff; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; position:relative;">
                <span id="checkoutBtnText">Proceed to Checkout</span>
                <span id="checkoutLoader" style="display:none;position:absolute;left:1rem;top:50%;transform:translateY(-50%);">
                    <span style="display:inline-block;width:18px;height:18px;border:2px solid #fff;border-top:2px solid #ea580c;border-radius:50%;animation:spin 0.8s linear infinite;"></span>
                </span>
            </button>
            <style>
                @keyframes spin { 100% { transform: rotate(360deg); } }
            </style>
            <script>
                function checkout() {
                    var btn = document.getElementById('checkoutBtn');
                    var btnText = document.getElementById('checkoutBtnText');
                    var loader = document.getElementById('checkoutLoader');
                    btn.disabled = true;
                    btn.style.opacity = '0.7';
                    btnText.style.display = 'none';
                    loader.style.display = 'inline-block';
                    setTimeout(function() {
                        window.location.href = "{{ route('item.checkout') }}";
                    }, 600); // short delay for loader effect
                }
            </script>
            <button onclick="closeCart();" style="margin-top:1rem; padding:0.5rem 1.5rem; background:#e5e7eb; color:#374151; border:none; border-radius:0.5rem; font-weight:600; cursor:pointer;">
                Back to Home
            </button>
            <script>
                function closeCart() {
                    document.getElementById('cartSidebar').style.display = 'none';
                    document.getElementById('overlay').style.display = 'none';
                }
                function toggleCart() {
                    var sidebar = document.getElementById('cartSidebar');
                    var overlay = document.getElementById('overlay');
                    var isOpen = sidebar.style.display === 'block';
                    sidebar.style.display = isOpen ? 'none' : 'block';
                    overlay.style.display = isOpen ? 'none' : 'block';
                }

                // Mobile Menu Toggle
                function toggleMobileMenu() {
                    const navMenu = document.getElementById('navMenu');
                    const overlay = document.getElementById('mobileMenuOverlay');
                    const hamburger = document.getElementById('hamburgerMenu');
                    
                    navMenu.classList.toggle('active');
                    overlay.classList.toggle('active');
                    hamburger.classList.toggle('active');
                    document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
                }

                // Close mobile menu when clicking on a nav link
                document.querySelectorAll('.nav-menu a').forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth <= 768) {
                            toggleMobileMenu();
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>