<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:100i,300,400,500,600,700,800,900" rel="stylesheet" />
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
                Please enter your email and password to log in.
            </p>

            <form class="space-y-6" method="POST" action="{{ route('authenticate') }}" id="loginForm">
                @csrf
                

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                        Email Address
                    </label>
                    <input 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:border-primary-dark transition duration-200" 
                        id="email" 
                        name="email"
                        type="email" 
                        placeholder="Enter your email"
                    >
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                        Password
                    </label>
                    <input 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:border-primary-dark transition duration-200" 
                        id="password" 
                        name="password"
                        type="password" 
                        placeholder="Enter your password"
                    >
                <div class="flex justify-end mt-2">
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Forgot Password?</a>
                </div>
                </div>
                
                <button 
                    type="submit" 
                    id="loginBtn"
                    class="w-full text-white font-semibold py-3 px-6 rounded-full transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    style="background: rgb(194, 65, 12);"
                    onmouseover="this.style.background='rgb(154, 52, 18)'"
                    onmouseout="this.style.background='rgb(194, 65, 12)'"
                >
                    Login
                </button>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('loginForm');
                const btn = document.getElementById('loginBtn');
                form.addEventListener('submit', function() {
                    btn.disabled = true;
                    btn.textContent = 'Logging in...';
                });
            });
        </script>
                
                <p class="text-center text-gray-600 text-sm">
                    Not yet Register?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">Sign In</a>
                </p>
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