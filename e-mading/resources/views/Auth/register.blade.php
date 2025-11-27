<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - E-Mading Digital</title>
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
            background: rgba(51, 65, 85, 0.4);
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
<body class="min-h-screen bg-gradient-to-br from-gray-800 via-slate-900 to-gray-900 overflow-hidden">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-gradient-to-br from-slate-600 to-gray-700 blob opacity-30"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-gradient-to-tr from-gray-600 to-slate-700 blob opacity-20" style="animation-delay: -2s;"></div>
        <div class="absolute top-1/3 left-1/4 w-32 h-32 bg-gradient-to-br from-slate-500 to-gray-600 blob opacity-25" style="animation-delay: -4s;"></div>
        
        <div class="absolute top-20 left-10 w-4 h-4 bg-green-400 rounded-full opacity-40 animate-bounce" style="animation-delay: 1s;"></div>
        <div class="absolute top-40 right-20 w-3 h-3 bg-emerald-400 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-40 left-20 w-2 h-2 bg-green-300 rounded-full opacity-50 animate-bounce" style="animation-delay: 3s;"></div>
    </div>

    <div class="relative min-h-screen flex">
        <!-- Left Side - Illustration -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12 slide-in-left">
            <div class="max-w-md">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">E-Mading</h1>
                    <p class="text-gray-300">Bergabunglah dengan Platform Digital Sekolah</p>
                </div>
                
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
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center animate-pulse">
                            <i class="fas fa-users text-green-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="absolute -bottom-5 -left-5">
                        <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center animate-bounce" style="animation-delay: 1s;">
                            <i class="fas fa-pencil-alt text-green-700"></i>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3 text-sm text-gray-300">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        <span>Buat dan publikasikan artikel</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full"></div>
                        <span>Berkolaborasi dengan teman</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span>Dapatkan feedback dari guru</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 slide-in-right">
            <div class="w-full max-w-md">
                <div class="flex justify-between items-center mb-8">
                    <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-gray-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Login
                    </a>
                    <div class="space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-gray-200">About</a>
                        <a href="#" class="text-gray-400 hover:text-gray-200">Contact</a>
                    </div>
                </div>

                <div class="glass rounded-3xl p-8 shadow-xl fade-in-up">
                    <h2 class="text-2xl font-bold text-white mb-6">Daftar Akun Baru</h2>
                    
                    <form action="{{ route('register') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    placeholder="Nama Lengkap"
                                    value="{{ old('nama') }}"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                    required
                                >
                            </div>
                            @error('nama')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-at absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="username" 
                                    placeholder="Username"
                                    value="{{ old('username') }}"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                    required
                                >
                            </div>
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-user-tag absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <select 
                                    name="role" 
                                    class="w-full pl-10 pr-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all appearance-none"
                                    required
                                >
                                    <option value="">Pilih Role</option>
                                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                            </div>
                            @error('role')
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
                                    class="w-full pl-10 pr-10 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                    required
                                >
                                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="toggleIcon1"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    placeholder="Konfirmasi Password"
                                    class="w-full pl-10 pr-10 py-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                                    required
                                >
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="toggleIcon2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start space-x-2">
                            <input type="checkbox" name="terms" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 mt-1" required>
                            <label class="text-sm text-gray-300">
                                Saya setuju dengan <a href="#" class="text-green-400 hover:text-green-300">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white py-3 rounded-xl font-semibold hover:from-green-600 hover:to-emerald-600 transition-all transform hover:scale-105 shadow-lg"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-300">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-semibold">Login di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldName) {
            const passwordInput = document.querySelector(`input[name="${fieldName}"]`);
            const toggleIcon = fieldName === 'password' ? document.getElementById('toggleIcon1') : document.getElementById('toggleIcon2');
            
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