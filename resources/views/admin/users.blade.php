@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')
<div class="flex-1 ml-64 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Users</h1>
                <p class="text-gray-600 mt-2">Manage user accounts and communications.</p>
            </div>
            
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">User List</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($customers as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                                                <span class="text-sm font-medium text-primary">
                                                    {{ strtoupper(substr($user->name, 0, 1) . substr(strrchr($user->name, ' '), 1, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $user->address }}    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <!-- Conversation Button with Badge -->
                                        <button onclick="openConversationModalWithLoader({{ $user->id }}, this)" class="relative text-blue-600 hover:text-blue-800 transition-colors border border-blue-400 rounded-md px-2 py-1">
                                            <span class="loader hidden absolute inset-0 flex items-center justify-center bg-white bg-opacity-60 rounded-md">
                                                <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                                </svg>
                                            </span>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{-- <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">1</span> --}}
                                        </button>
                                        <!-- Update Status Button -->
                                        <button onclick="openStatusModal({{ $user->id }})" class="text-primary hover:text-primary/80 transition-colors border border-primary rounded-md px-2 py-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <!-- Sample User Rows -->
                        
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Update Status Modal -->
<div id="statusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Update User Status</h3>
        </div>
        <form class="px-6 py-4 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="userStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="active">Active</option>
                    <option value="banned">Banned</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                <textarea id="userRemarks" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Enter remarks (optional)"></textarea>
            </div>
        </form>
        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
            <button onclick="closeStatusModal()" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">Cancel</button>
            <button onclick="saveStatus()" class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-md transition-colors">Save Status</button>
        </div>
    </div>
</div>

<!-- Conversation Modal -->
<div id="conversationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 h-[600px] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Conversation with <span id="conversationUserName">John Doe</span></h3>
            <button onclick="closeConversationModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Conversation Messages -->
        <div id="conversationMessages" class="flex-1 p-6 overflow-y-auto bg-gray-50">
            <!-- Sample Messages -->
            <div class="space-y-4">
                <!-- User Message -->
                {{-- <div class="flex justify-end">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 bg-primary text-white rounded-lg">
                        <p class="text-sm">Hello! I have a question about my recent order.</p>
                        <span class="text-xs opacity-75 mt-1 block">2:30 PM</span>
                    </div>
                </div>
                
                <!-- Admin Reply -->
                <div class="flex justify-start">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 bg-white border rounded-lg">
                        <p class="text-sm text-gray-800">Hi! I'd be happy to help you with your order. What's your question?</p>
                        <span class="text-xs text-gray-500 mt-1 block">2:32 PM</span>
                    </div>
                </div>
                
                <!-- User Message -->
                <div class="flex justify-end">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 bg-primary text-white rounded-lg">
                        <p class="text-sm">I haven't received my order yet. It's been 5 days since I placed it.</p>
                        <span class="text-xs opacity-75 mt-1 block">2:35 PM</span>
                    </div>
                </div> --}}
            </div>
        </div>
        
        <!-- Message Input -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex space-x-3">
                <input type="text" id="newMessage" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Type your message...">
                <button id="sendMessageBtn" onclick="sendNewMessage()" class="px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-md transition-colors flex items-center justify-center">
                    <span id="sendBtnText">Send</span>
                    <span id="sendBtnSpinner" class="ml-2 hidden">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>



<script>
let currentUserId = null;
let isEditMode = false;
// Get AJAX URLs from blade
const fetchMessagesUrl = '{{ route('conversation.fetch') }}';
const sendMessageUrl = '{{ route('conversation.send') }}';

// Build userNames object from PHP data
const userNames = {
    @foreach($customers as $user)
        {{ $user->id }}: '{{ $user->name }}',
    @endforeach
};

function openStatusModal(userId) {
    currentUserId = userId;
    document.getElementById('statusModal').classList.remove('hidden');
    document.getElementById('statusModal').classList.add('flex');
    // Optionally, load current status/remarks for userId here
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
    document.getElementById('statusModal').classList.remove('flex');
    clearStatusForm();
}

function clearStatusForm() {
    document.getElementById('userStatus').value = 'active';
    document.getElementById('userRemarks').value = '';
}

function saveStatus() {
    // Here you would typically send the status/remarks to your backend
    const status = document.getElementById('userStatus').value;
    const remarks = document.getElementById('userRemarks').value;
    console.log('Saving status for user ID:', currentUserId, status, remarks);
    closeStatusModal();
    alert('User status updated!');
}

function openConversationModalWithLoader(userId, btn) {
    const loader = btn.querySelector('.loader');
    loader.classList.remove('hidden');
    btn.disabled = true;
    fetch('{{ route('conversation.getOrCreate') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        currentUserId = data.conversation_id;
        document.getElementById('conversationUserName').textContent = userNames[userId] || 'User';
        document.getElementById('conversationModal').classList.remove('hidden');
        document.getElementById('conversationModal').classList.add('flex');
        fetchConversationMessages();
        startPollingMessages();
    })
    .finally(() => {
        loader.classList.add('hidden');
        btn.disabled = false;
    });
}

function closeConversationModal() {
    document.getElementById('conversationModal').classList.add('hidden');
    document.getElementById('conversationModal').classList.remove('flex');
    document.getElementById('newMessage').value = '';
    stopPollingMessages();
}

function sendNewMessage() {
    const messageInput = document.getElementById('newMessage');
    const messageText = messageInput.value.trim();
    const sendBtn = document.getElementById('sendMessageBtn');
    const sendBtnText = document.getElementById('sendBtnText');
    const sendBtnSpinner = document.getElementById('sendBtnSpinner');
    if (!messageText) return;
    // Show loading spinner
    sendBtnText.classList.add('hidden');
    sendBtnSpinner.classList.remove('hidden');
    fetch(sendMessageUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            conversation_id: currentUserId,
            sender_type: 'admin', // or 'user'
            sender_id: 1, // set actual sender id
            message: messageText
        })
    })
    .then(response => response.json())
    .then(data => {
        messageInput.value = '';
        fetchConversationMessages();
    })
    .finally(() => {
        // Hide loading spinner
        sendBtnText.classList.remove('hidden');
        sendBtnSpinner.classList.add('hidden');
    });
}

function fetchConversationMessages() {
    fetch(fetchMessagesUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            conversation_id: currentUserId
        })
    })
    .then(response => response.json())
    .then(messages => {
        const messagesContainer = document.getElementById('conversationMessages');
        const spaceY4 = messagesContainer.querySelector('.space-y-4');
        spaceY4.innerHTML = '';
        messages.forEach(msg => {
            // sender_type: 'admin' or 'user', sender_id: id
            // Assume current admin id is 1 (replace with actual admin id if needed)
            const isSender = msg.sender_type === 'admin' && msg.sender_id == 1;
            const msgDiv = document.createElement('div');
            msgDiv.className = isSender ? 'flex justify-end' : 'flex justify-start';
            msgDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md px-4 py-2 ${isSender ? 'bg-primary text-white' : 'bg-white border text-gray-800'} rounded-lg">
                    <p class="text-sm">${msg.message}</p>
                    <span class="text-xs ${isSender ? 'opacity-75' : 'text-gray-500'} mt-1 block">${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                </div>
            `;
            spaceY4.appendChild(msgDiv);
        });
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    });
}

let pollingInterval = null;

function startPollingMessages() {
    if (pollingInterval) clearInterval(pollingInterval);
    pollingInterval = setInterval(fetchConversationMessages, 2000);
}

function stopPollingMessages() {
    if (pollingInterval) clearInterval(pollingInterval);
}

function confirmDelete() {
    // Here you would typically send a delete request to your backend
    console.log('Deleting user ID:', currentUserId);
    
    closeDeleteModal();
    alert('User deleted successfully!');
}

function clearForm() {
    document.getElementById('userName').value = '';
    document.getElementById('userEmail').value = '';
    document.getElementById('userContact').value = '';
    document.getElementById('userAddress').value = '';
}

// Close modals when clicking outside


document.getElementById('conversationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeConversationModal();
    }
});



document.getElementById('newMessage').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendNewMessage();
    }
});
</script>

@include('admin.includes.script')
@include('admin.includes.footer')
