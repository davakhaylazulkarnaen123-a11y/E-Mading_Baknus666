<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: blob 7s infinite;
        }
        @keyframes blob {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
            100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        }
        .glass {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }
        
        .illustration-img {
            mix-blend-mode: multiply;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2)) contrast(1.1) brightness(1.05);
            transition: all 0.3s ease;
        }
        
        .illustration-img:hover {
            transform: scale(1.02);
            filter: drop-shadow(0 15px 30px rgba(0,0,0,0.3)) contrast(1.15) brightness(1.1);
        }
        
        /* Page entrance animations */
        .slide-in-left {
            opacity: 0;
            transform: translateX(-100px);
            animation: slideInLeft 1s ease-out 0.3s forwards;
        }
        
        .slide-in-right {
            opacity: 0;
            transform: translateX(100px);
            animation: slideInRight 1s ease-out 0.5s forwards;
        }
        
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease-out 0.7s forwards;
        }
        
        .illustration-container {
            animation: float 6s ease-in-out infinite;
        }
        
        .illustration-container:hover {
            animation-play-state: paused;
        }
        
        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-gray-800 overflow-hidden">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Large blob top right -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-gradient-to-br from-blue-600 to-blue-800 blob opacity-30"></div>
        
        <!-- Medium blob bottom left -->
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-gradient-to-tr from-gray-700 to-blue-700 blob opacity-20" style="animation-delay: -2s;"></div>
        
        <!-- Small blob center -->
        <div class="absolute top-1/3 left-1/4 w-32 h-32 bg-gradient-to-br from-blue-500 to-gray-600 blob opacity-25" style="animation-delay: -4s;"></div>
        
        <!-- Floating elements -->
        <div class="absolute top-20 left-10 w-4 h-4 bg-blue-400 rounded-full opacity-40 animate-bounce" style="animation-delay: 1s;"></div>
        <div class="absolute top-40 right-20 w-3 h-3 bg-blue-300 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 left-20 w-2 h-2 bg-blue-500 rounded-full opacity-50 animate-bounce" style="animation-delay: 3s;"></div>
    </div>

    <div class="relative min-h-screen flex">
        <!-- Left Side - Illustration -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12 slide-in-left">
            <div class="max-w-md">
                <!-- Brand -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">E-Mading</h1>
                    <p class="text-gray-300">Digital School Magazine Platform</p>
                </div>
                
                <!-- Illustration -->
                <div class="relative illustration-container">
                    <div class="glass rounded-3xl p-8 mb-6 flex items-center justify-center">
                        <div class="relative w-80 h-64">
                            <img src="{{ asset('images/logo.svg') }}" 
                                 alt="SMK Bakti Nusantara 666" 
                                 class="w-full h-full object-contain rounded-2xl illustration-img">
                        </div>
                    </div>
                    
                    <!-- Floating elements -->
                    <div class="absolute -top-5 -right-5">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center animate-pulse">
                            <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="absolute -bottom-5 -left-5">
                        <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center animate-bounce" style="animation-delay: 1s;">
                            <i class="fas fa-book text-blue-700"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Features -->
                <div class="space-y-3 text-sm text-gray-300">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                        <span>Platform digital untuk artikel sekolah</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-300 rounded-full"></div>
                        <span>Kolaborasi siswa, guru, dan staff</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span>Akses mudah dari mana saja</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 slide-in-right">
            <div class="w-full max-w-md">
                <!-- Navigation -->
                <div class="flex justify-end mb-8 space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-gray-200">About</a>
                    <a href="#" class="text-gray-400 hover:text-gray-200">Contact us</a>
                    <a href="#" class="text-blue-400 hover:text-blue-300">Get the app</a>
                </div>

                <!-- Login Card -->
                <div class="glass rounded-3xl p-8 shadow-xl fade-in-up">
                    <h2 class="text-2xl font-bold text-white mb-6">Login</h2>
                    
                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Username -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="username" 
                                    placeholder="Email or username"
                                    value="{{ old('username') }}"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    required
                                >
                            </div>
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    name="password" 
                                    placeholder="Password"
                                    class="w-full pl-10 pr-10 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                    required
                                >
                                <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-300">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-gray-300">Remember me</span>
                            </label>
                            <a href="#" class="text-blue-400 hover:text-blue-300">Forgot password?</a>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-cyan-600 transition-all transform hover:scale-105 shadow-lg"
                        >
                            Login
                        </button>


                    </form>

                    <!-- Register Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-300">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold">Daftar di sini</a>
                        </p>
                    </div>

                    <!-- Demo Accounts -->
                    <div class="mt-4 p-4 bg-gray-800 rounded-xl border border-gray-600">
                        <h4 class="text-sm font-semibold text-blue-400 mb-2">
                            <i class="fas fa-info-circle mr-1"></i>
                          
                        </h4>
                        <div class="space-y-1 text-xs text-gray-300">
                            <p><strong>Admin:</strong> admin / password</p>
                            <p><strong>Guru:</strong> guru / password</p>
                            <p><strong>Siswa:</strong> siswa / password</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-400">
                        Butuh bantuan? 
                        <a href="#" class="text-blue-400 hover:text-blue-300">Hubungi administrator</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.querySelector('input[name="password"]');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>