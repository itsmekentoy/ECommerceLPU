<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Admin Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:100i,300,400,500,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        *{
            font-family: 'Poppins';
        }
        body {
            background: #ffffff;
            min-height: 100vh;
        }
        .card-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .header-gradient {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .otp-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            margin: 0 6px;
            transition: all 0.3s ease;
            background: #f9fafb;
            caret-color: rgb(194, 65, 12);
        }
        .otp-input:focus {
            outline: none;
            border-color: rgb(194, 65, 12);
            box-shadow: 0 0 0 4px rgba(194, 65, 12, 0.1);
            background: #fff;
            transform: scale(1.05);
        }
        .otp-input.filled {
            border-color: rgb(194, 65, 12);
            background: linear-gradient(135deg, #fef3e2, #fff);
            color: rgb(194, 65, 12);
        }
        .otp-input.error {
            border-color: #ef4444;
            background: #fef2f2;
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .verify-btn {
            background: linear-gradient(135deg, #ea580c, #c2410c);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .verify-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(194, 65, 12, 0.3);
            background: linear-gradient(135deg, #c2410c, #9a340a);
        }
        .verify-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .timer-badge {
            display: inline-block;
            background: linear-gradient(135deg, #fef3e2, #fff);
            color: rgb(194, 65, 12);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid rgb(194, 65, 12);
        }
        .timer-badge.warning {
            background: #fef3c7;
            color: #f59e0b;
            border-color: #f59e0b;
        }
        .timer-badge.danger {
            background: #fef2f2;
            color: #ef4444;
            border-color: #ef4444;
        }
        .icon-container {
            display: none;
        }
        .resend-btn {
            color: rgb(194, 65, 12);
            font-weight: 600;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        .resend-btn:hover:not(:disabled) {
            border-bottom-color: rgb(194, 65, 12);
            transform: translateY(-2px);
        }
        .resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .back-btn {
            color: rgb(194, 65, 12);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .back-btn:hover {
            gap: 10px;
            color: #9a340a;
        }
        .email-display {
            background: linear-gradient(135deg, #fef3e2, #fff);
            padding: 12px 16px;
            border-radius: 8px;
            border-left: 4px solid rgb(194, 65, 12);
            margin: 15px 0;
        }
        .error-alert {
            background: #fef2f2;
            border: 2px solid #fecaca;
            color: #991b1b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .error-alert i {
            font-size: 20px;
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
<body class="flex items-center justify-center p-4">
    <div class="w-full max-w-md card-container">
        <!-- Header -->
        <div class="header-gradient">
            <div class="icon-container">
                <i class="fas fa-lock"></i>
            </div>
            <h1 class="text-3xl font-bold mb-2">Verify Your Login</h1>
            <p class="text-orange-100 text-sm">Two-Factor Authentication</p>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Email Display -->
            <div class="email-display">
                <p class="text-sm text-gray-600 mb-2">Verification code sent to:</p>
                <p class="font-semibold text-gray-800">
                    <i class="fas fa-envelope mr-2" style="color: rgb(194, 65, 12);"></i>
                    {{ substr($email, 0, 3) }}***{{ substr($email, strpos($email, '@') - 3) }}
                </p>
            </div>

            <form method="POST" action="{{ route('admin.otp.verify') }}" id="otpForm" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <p class="font-semibold">Verification Failed</p>
                            @foreach ($errors->all() as $error)
                                <p class="text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Instructions -->
                <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-4 rounded-lg border border-orange-200">
                    <p class="text-gray-700 text-sm">
                        <i class="fas fa-info-circle mr-2" style="color: rgb(194, 65, 12);"></i>
                        Enter the 6-digit code from your email
                    </p>
                </div>

                <!-- OTP Input Fields -->
                <div class="flex justify-center gap-2 mb-4">
                    <input type="text" class="otp-input" id="otp1" name="otp[]" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp2" name="otp[]" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp3" name="otp[]" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp4" name="otp[]" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp5" name="otp[]" maxlength="1" inputmode="numeric" required>
                    <input type="text" class="otp-input" id="otp6" name="otp[]" maxlength="1" inputmode="numeric" required>
                </div>

                <!-- Verify Button -->
                <button 
                    type="submit" 
                    id="verifyBtn"
                    class="w-full verify-btn text-white font-bold py-3 px-6 rounded-lg transition duration-200 shadow-lg flex items-center justify-center gap-2"
                >
                    <span id="btnText">Verify Code</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Timer -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm mb-3">Code expires in:</p>
                    <div id="timerBadge" class="timer-badge">
                        <i class="fas fa-hourglass-end mr-2"></i><span id="timer">10:00</span>
                    </div>
                </div>

                <!-- Resend Code -->
                <div class="border-t pt-6">
                    <p class="text-center text-gray-600 text-sm mb-3">
                        Didn't receive the code?
                    </p>
                    <button 
                        type="button" 
                        class="w-full resend-btn py-2 text-center"
                        onclick="resendOtp()"
                        id="resendBtn"
                    >
                        <i class="fas fa-redo mr-2"></i>Resend Code
                    </button>
                </div>
            </form>

            <!-- Back to Login Link -->
            <div class="text-center mt-8 pt-6 border-t">
                <a href="{{ route('admin.login') }}" class="back-btn">
                    <i class="fas fa-chevron-left"></i>
                    <span>Back to Login</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (!/^[0-9]$/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                e.target.classList.add('filled');
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = (e.clipboardData || window.clipboardData).getData('text');
                const pastedDigits = pastedData.replace(/\D/g, '').slice(0, 6);
                
                if (pastedDigits.length > 0) {
                    pastedDigits.split('').forEach((digit, i) => {
                        if (i + index < otpInputs.length) {
                            otpInputs[i + index].value = digit;
                            otpInputs[i + index].classList.add('filled');
                        }
                    });
                    otpInputs[Math.min(pastedDigits.length + index - 1, otpInputs.length - 1)].focus();
                }
            });
        });

        let timeLeft = 600;
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            const timeString = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            document.getElementById('timer').textContent = timeString;
            
            const badge = document.getElementById('timerBadge');
            if (timeLeft <= 60) {
                badge.classList.add('warning');
            }
            if (timeLeft <= 30) {
                badge.classList.remove('warning');
                badge.classList.add('danger');
            }
            
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                document.getElementById('resendBtn').disabled = false;
                document.getElementById('verifyBtn').disabled = true;
                alert('OTP has expired. Please request a new one.');
            }
        }

        updateTimer();

        function resendOtp() {
            const email = document.querySelector('input[name="email"]').value;
            const resendBtn = document.getElementById('resendBtn');
            resendBtn.disabled = true;
            const originalText = resendBtn.innerHTML;
            resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';

            fetch('{{ route('admin.otp.resend') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('A new code has been sent to your email!');
                    timeLeft = 600;
                    updateTimer();
                    otpInputs.forEach(input => {
                        input.value = '';
                        input.classList.remove('filled', 'error');
                    });
                    otpInputs[0].focus();
                } else {
                    alert(data.message || 'Failed to resend code. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            })
            .finally(() => {
                resendBtn.disabled = false;
                resendBtn.innerHTML = originalText;
            });
        }

        document.getElementById('otpForm').addEventListener('submit', function(e) {
            const verifyBtn = document.getElementById('verifyBtn');
            verifyBtn.disabled = true;
            document.getElementById('btnText').innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
        });

        otpInputs[0].focus();
    </script>
</body>
</html>
