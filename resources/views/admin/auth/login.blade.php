<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
    <title>Ready 24h security - Security Solutions</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-custom { animation: pulse 2s infinite; }
        .flip-container { perspective: 1000px; width: 100%; max-width: 28rem; }
        .flip-card { position: relative; width: 100%; transform-style: preserve-3d; transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .flip-card.flipped { transform: rotateY(180deg); }
        .flip-card-front, .flip-card-back { position: relative; width: 100%; backface-visibility: hidden; -webkit-backface-visibility: hidden; }
        .flip-card-back { position: absolute; top: 0; left: 0; width: 100%; transform: rotateY(180deg); }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0 bg-radial-gradient"></div>
            <div class="grid grid-cols-8 grid-rows-8 w-full h-full">
                @for ($i = 0; $i < 64; $i++)
                    <div class="border border-red-900/20"></div>
                @endfor
            </div>
        </div>
        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-8">
                <img src="{{ asset('./logo.png') }}" alt="Ready 24h security" class="bg-white p-4 mx-auto w-24 h-24 rounded-full shadow-lg mb-4" />
                <h1 class="text-3xl font-bold text-white mb-2">Ready 24h security</h1>
                <p class="text-red-400 font-medium">Security Solutions</p>
            </div>
            <div class="flip-container">
                <div class="flip-card" id="flipCard">
                    <div class="flip-card-front">
                        <div class="bg-black/40 backdrop-blur-xl border border-red-900/30 shadow-2xl rounded-lg">
                            <div class="space-y-1 pb-6 pt-6 px-6">
                                <h2 class="text-2xl font-bold text-center text-white">Admin Panel Access</h2>
                                <p class="text-center text-gray-300">Secure login for authorized personnel only</p>
                            </div>
                            <div class="space-y-6 px-6 pb-6">
                                @if ($errors->has('error'))
                                    <div class="bg-red-900/20 border border-red-800/30 rounded-lg p-4 mb-4 text-red-300">
                                        {{ $errors->first('error') }}
                                    </div>
                                @endif
                                <form class="space-y-6" method="post" action="{{ route('admin.login') }}">
                                    @csrf
                                    <div class="space-y-2">
                                        <label for="email" class="text-white font-medium block">Email Address</label>
                                        <div class="relative">
                                            <i data-lucide="user" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                                            <input name="email" id="email" type="email" placeholder="email@example.com" class="pl-10 w-full h-10 rounded-md border bg-gray-900/50 border-gray-700 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500/20 focus:outline-none focus:ring-2 px-3 py-2" required />
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label for="password" class="text-white font-medium block">Password</label>
                                        <div class="relative">
                                            <i data-lucide="lock" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                                            <input name="password" id="password" type="password" placeholder="Enter your secure password" class="pl-10 pr-10 w-full h-10 rounded-md border bg-gray-900/50 border-gray-700 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500/20 focus:outline-none focus:ring-2 px-3 py-2" required />
                                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"><i data-lucide="eye" id="eyeIcon" class="w-5 h-5"></i></button>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="checkbox" class="w-4 h-4 rounded border-gray-600 bg-gray-800 text-red-600 focus:ring-red-500 focus:ring-offset-0" />
                                            <span class="text-sm text-gray-300">Remember me</span>
                                        </label>
                                        <button type="button" onclick="flipToForgotPassword()" class="text-sm text-red-400 hover:text-red-300 transition-colors">Forgot password?</button>
                                    </div>
                                    <button type="submit" id="loginBtn" class="w-full bg-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 rounded-md transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2 cursor-pointer">
                                        <i data-lucide="log-in" class="w-5 h-5"></i>
                                        <span>Secure Login</span>
                                    </button>
                                </form>
                                <div class="pt-6 border-t border-gray-700/50">
                                    <div class="bg-red-900/20 border border-red-800/30 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <i data-lucide="shield" class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0"></i>
                                            <div class="text-sm">
                                                <p class="text-red-300 font-medium mb-1">Security Notice</p>
                                                <p class="text-gray-300 text-xs leading-relaxed">This system is for authorized personnel only. All access attempts are logged and monitored.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-card-back">
                        <div class="bg-black/40 backdrop-blur-xl border border-red-900/30 shadow-2xl rounded-lg">
                            <div class="space-y-1 pb-6 pt-6 px-6">
                                <h2 class="text-2xl font-bold text-center text-white">Reset Password</h2>
                                <p class="text-center text-gray-300">Enter your email to receive reset instructions</p>
                            </div>
                            <div class="space-y-6 px-6 pb-6">
                                <form onsubmit="handleForgotPassword(event)" class="space-y-6">
                                    <div class="space-y-2">
                                        <label for="resetEmail" class="text-white font-medium block">Email Address</label>
                                        <div class="relative">
                                            <i data-lucide="mail" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                                            <input id="resetEmail" type="email" placeholder="email@example.com" class="pl-10 w-full h-10 rounded-md border bg-gray-900/50 border-gray-700 text-white placeholder-gray-400 focus:border-red-500 focus:ring-red-500/20 focus:outline-none focus:ring-2 px-3 py-2" required />
                                        </div>
                                    </div>
                                    <button type="submit" id="resetBtn" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 rounded-md transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-2">
                                        <i data-lucide="send" class="w-5 h-5"></i>
                                        <span>Send Reset Link</span>
                                    </button>
                                    <button type="button" onclick="flipToLogin()" class="w-full bg-transparent border border-gray-600 hover:border-red-500 text-gray-300 hover:text-white font-medium py-2 rounded-md transition-all duration-200 flex items-center justify-center space-x-2">
                                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                                        <span>Back to Login</span>
                                    </button>
                                </form>
                                <div class="pt-6 border-t border-gray-700/50">
                                    <div class="bg-red-900/20 border border-red-800/30 rounded-lg p-4">
                                        <div class="flex items-start space-x-3">
                                            <i data-lucide="info" class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0"></i>
                                            <div class="text-sm">
                                                <p class="text-red-300 font-medium mb-1">Reset Instructions</p>
                                                <p class="text-gray-300 text-xs leading-relaxed">You will receive a secure link to reset your password.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8 text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Ready 24h Security Solutions. All rights reserved.</p>
            </div>
        </div>
        <div class="absolute top-10 left-10 w-2 h-2 bg-red-500 rounded-full animate-pulse-custom"></div>
        <div class="absolute top-20 right-20 w-1 h-1 bg-red-400 rounded-full animate-pulse-custom" style="animation-delay: 1000ms"></div>
        <div class="absolute bottom-20 left-20 w-1.5 h-1.5 bg-red-600 rounded-full animate-pulse-custom" style="animation-delay: 500ms"></div>
        <div class="absolute bottom-10 right-10 w-2 h-2 bg-red-500 rounded-full animate-pulse-custom" style="animation-delay: 700ms"></div>
    </div>
    <script>
        lucide.createIcons();
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.setAttribute("data-lucide", "eye-off");
            } else {
                passwordInput.type = "password";
                eyeIcon.setAttribute("data-lucide", "eye");
            }
            lucide.createIcons();
        }
        function flipToForgotPassword() {
            const flipCard = document.getElementById("flipCard");
            flipCard.classList.add("flipped");
        }
        function flipToLogin() {
            const flipCard = document.getElementById("flipCard");
            flipCard.classList.remove("flipped");
        }
        function handleLogin(event) {
            event.preventDefault();
            const loginBtn = document.getElementById("loginBtn");
            const originalContent = loginBtn.innerHTML;
            loginBtn.innerHTML = `<div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div><span>Authenticating...</span>`;
            loginBtn.disabled = true;
            setTimeout(() => {
                loginBtn.innerHTML = originalContent;
                loginBtn.disabled = false;
                alert("Login Successful - Welcome to the Security Admin Panel");
            }, 2000);
        }
        function handleForgotPassword(event) {
            event.preventDefault();
            const resetBtn = document.getElementById("resetBtn");
            const originalContent = resetBtn.innerHTML;
            resetBtn.innerHTML = `<div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div><span>Sending...</span>`;
            resetBtn.disabled = true;
            setTimeout(() => {
                resetBtn.innerHTML = originalContent;
                resetBtn.disabled = false;
                alert("Password reset link sent! Check your email for instructions.");
                flipToLogin();
            }, 2000);
        }
    </script>
</body>
</html>
