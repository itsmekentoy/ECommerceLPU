<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:100i,300,400,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        *{
            font-family: 'Poppins';
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgb(194, 65, 12)',
                        'primary-dark': 'rgb(154, 52, 10)',
                        'primary-light': 'rgb(234, 88, 12)'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-6xl flex items-center">
        <!-- Left side - Form -->
        <div class="w-1/2 pr-12">
            <h1 class="text-4xl font-light mb-8">
                <span class="text-gray-800">Habing</span><span class="text-primary-dark">Ibaan</span>
            </h1>

            <h3>Login</h3>
            <p class="text-gray-600 mb-6">
                Please enter password to log in.
            </p>

            <form class="space-y-6" method="POST" action="{{ route('password.change.new') }}" id="loginForm">
                @csrf
                

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                        New Password
                    </label>
                    <div class="relative">
                        <input 
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-full focus:outline-none focus:border-primary-dark transition duration-200" 
                            id="new_password" 
                            name="new_password"
                            type="password"
                            placeholder="Enter your new password"
                            minlength="8"
                            required
                        >
                        <button 
                            type="button" 
                            id="togglePassword" 
                            class="absolute right-4 top-3 text-gray-500 hover:text-gray-700 focus:outline-none"
                            onclick="togglePasswordVisibility()"
                        >
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        Password must contain at least 8 characters, 1 uppercase letter, and 1 special character.
                    </p>
                    <div id="passwordError" class="text-xs text-red-600 mt-1 hidden"></div>
                    <input type="hidden" name="email" value="{{ $email }}">
                </div>
                

                
                
                
                <button 
                    type="submit" 
                    id="loginBtn"
                    class="w-full text-white font-semibold py-3 px-6 rounded-full transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    style="background: rgb(194, 65, 12);"
                    onmouseover="this.style.background='rgb(154, 52, 18)'"
                    onmouseout="this.style.background='rgb(194, 65, 12)'"
                >
                    Save New Password
                </button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('loginForm');
                const btn = document.getElementById('loginBtn');
                const passwordInput = document.getElementById('new_password');
                const passwordError = document.getElementById('passwordError');
                
                // Password validation function
                function validatePassword(password) {
                    const minLength = 8;
                    const hasUpperCase = /[A-Z]/.test(password);
                    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                    
                    if (password.length < minLength) {
                        return 'Password must be at least 8 characters long.';
                    }
                    if (!hasUpperCase) {
                        return 'Password must contain at least 1 uppercase letter.';
                    }
                    if (!hasSpecialChar) {
                        return 'Password must contain at least 1 special character (!@#$%^&*(),.?":{}|<>).';
                    }
                    return '';
                }
                
                // Real-time password validation
                passwordInput.addEventListener('input', function() {
                    const error = validatePassword(this.value);
                    if (error) {
                        passwordError.textContent = error;
                        passwordError.classList.remove('hidden');
                        passwordInput.classList.add('border-red-500');
                        passwordInput.classList.remove('border-gray-300');
                    } else {
                        passwordError.classList.add('hidden');
                        passwordInput.classList.remove('border-red-500');
                        passwordInput.classList.add('border-gray-300');
                    }
                });
                
                form.addEventListener('submit', function(e) {
                    const password = passwordInput.value;
                    const error = validatePassword(password);
                    
                    if (error) {
                        e.preventDefault();
                        passwordError.textContent = error;
                        passwordError.classList.remove('hidden');
                        passwordInput.classList.add('border-red-500');
                        passwordInput.focus();
                        return false;
                    }
                    
                    btn.disabled = true;
                    btn.textContent = 'Loading...';
                });
            });

            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('new_password');
                const passwordIcon = document.getElementById('passwordIcon');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                }
            }
        </script>
                
                
            </form>
        </div>
        
        <!-- Right side - Logo placeholder -->
        <div class="w-1/2 flex justify-center items-center">
                <div class="flex justify-center items-center">
                    <img src="/imgs/logo.png" alt="Logo" class="w-96 h-96 object-contain" />
                </div>
        </div>
    </div>
</body>
</html>