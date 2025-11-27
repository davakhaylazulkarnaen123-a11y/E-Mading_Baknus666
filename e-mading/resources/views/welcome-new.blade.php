<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mading Digital Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="white" opacity="0.2"/><circle cx="40" cy="80" r="1.5" fill="white" opacity="0.15"/><circle cx="90" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="1" fill="white" opacity="0.2"/></svg>');
        }
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            right: 10%;
            animation: float 6s ease-in-out infinite;
        }
        .shape-2 {
            width: 100px;
            height: 100px;
            top: 60%;
            left: 5%;
            animation: float 4s ease-in-out infinite reverse;
        }
        .shape-3 {
            width: 150px;
            height: 150px;
            bottom: 20%;
            right: 20%;
            animation: float 5s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        .wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }
        .wave .shape-fill {
            fill: #1e3a8a;
        }
    </style>
</head>
<body class="font-sans">
    <!-- Navigation -->
    <nav class="bg-gray-800/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xl font-bold text-white">Mading</div>
                        <div class="text-xs text-gray-400">Baknus-666</div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white font-medium hover:text-blue-400 transition-colors">Beranda</a>
                    <a href="#about" class="text-gray-300 hover:text-blue-400 font-medium transition-colors">Tentang</a>
                    <a href="#contact" class="text-gray-300 hover:text-blue-400 font-medium transition-colors">Kontak</a>
                </div>

                <!-- Login/Logout Button -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 font-medium transition-colors flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center justify-center relative">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        
        <div class="text-center text-white z-10 relative px-4">
            <div class="mb-8">
                <h1 class="text-6xl md:text-8xl font-bold mb-4">WELCOME</h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">E-mading Baknus666</p>
                <p class="text-lg md:text-xl mb-12 opacity-80">Do You Wanna Join Us?</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Started Now
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Started Now
                    </a>
                @endauth
                <a href="#about" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                    Learn More
                </a>
            </div>
        </div>

        <!-- Wave Shape -->
        <div class="wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-blue-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Tentang E-Mading Digital</h2>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Platform digital modern untuk berbagi informasi, prestasi, dan kreativitas seluruh komunitas sekolah
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Kolaboratif</h3>
                    <p class="opacity-80">Siswa, guru, dan staff bersama-sama membangun konten berkualitas</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Real-time</h3>
                    <p class="opacity-80">Informasi terbaru langsung sampai ke seluruh komunitas sekolah</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Mobile Friendly</h3>
                    <p class="opacity-80">Akses kapan saja dan di mana saja melalui perangkat mobile</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
            <p class="text-xl opacity-90 mb-8">Punya pertanyaan? Kami siap membantu!</p>
            
            <div class="flex flex-col sm:flex-row gap-8 justify-center items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-envelope text-blue-400 text-xl"></i>
                    <span>info@baknus666.sch.id</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-phone text-blue-400 text-xl"></i>
                    <span>(021) 1234-5678</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 E-Mading Digital Baknus666. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>