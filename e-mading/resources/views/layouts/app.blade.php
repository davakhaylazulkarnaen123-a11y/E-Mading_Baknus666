<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Mading Digital Sekolah</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/image-upload.css') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f4f4f4',
                            100: '#f4f4f4',
                            500: '#1d546c',
                            600: '#1a3d64',
                            700: '#0c2b4e',
                        },
                        secondary: {
                            50: '#f4f4f4',
                            100: '#1d546c',
                            500: '#1a3d64',
                            600: '#0c2b4e',
                        },
                        navy: {
                            50: '#f4f4f4',
                            100: '#1d546c',
                            200: '#1a3d64',
                            300: '#0c2b4e',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .prose {
    line-height: 1.75;
}

.prose p {
    margin-bottom: 1.25em;
}

.prose h2 {
    font-size: 1.5em;
    font-weight: 700;
    margin-top: 2em;
    margin-bottom: 1em;
    color: #1f2937;
}

.prose h3 {
    font-size: 1.25em;
    font-weight: 600;
    margin-top: 1.6em;
    margin-bottom: 0.6em;
    color: #374151;
}

.prose ul, .prose ol {
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose li {
    margin-bottom: 0.5em;
}

.prose blockquote {
    font-weight: 500;
    font-style: italic;
    border-left: 0.25rem solid #e5e7eb;
    padding-left: 1em;
    margin: 1.6em 0;
}
        .gradient-bg {
            background: linear-gradient(135deg, #0c2b4e 0%, #1a3d64 100%);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .text-gradient {
            background: linear-gradient(135deg, #0c2b4e 0%, #1a3d64 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Welcome notification animations */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .notification-enter {
            animation: slideInRight 0.5s ease-out forwards;
        }
        
        .notification-exit {
            animation: slideOutRight 0.5s ease-in forwards;
        }
        
        /* Hide Edge password reveal button */
        input[type="password"]::-ms-reveal {
            display: none;
        }
    </style>
    <script>
        // Setup CSRF token for all AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
        
        // Auto refresh CSRF token every 10 minutes
        setInterval(function() {
            fetch('/csrf-token')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('meta[name="csrf-token"]').setAttribute('content', data.token);
                    window.Laravel.csrfToken = data.token;
                })
                .catch(error => console.log('CSRF refresh failed:', error));
        }, 600000); // 10 minutes
    </script>
</head>
<body class="font-sans bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-gray-800/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-4">
                <!-- Logo - Pojok Kiri -->
                <div class="flex items-center space-x-3 mr-8">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="SMK Bakti Nusantara 666" class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <a href="{{ route(auth()->check() ? 'dashboard' : 'home') }}" class="text-2xl font-bold text-white hover:text-primary-400 transition-colors">
                            Mading
                        </a>
                        <p class="text-xs text-gray-400 -mt-1">Baknus-666</p>
                    </div>
                </div>

                <!-- Navigation Links - Tengah -->
                <div class="hidden md:flex items-center space-x-6 flex-1 justify-center">
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('artikel.index') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-edit"></i>
                        <span>Artikel Saya</span>
                    </a>
                    @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                    <a href="{{ route('pending.articles') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-clock"></i>
                        <span>Pending Artikel</span>
                    </a>
                    <a href="{{ route('pending.comments') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-comments"></i>
                        <span>Pending Komentar</span>
                    </a>
                    @endif
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('kategori.index') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-tags"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="{{ route('user.index') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-users"></i>
                        <span>User</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                    @endif
                    @else
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-primary-400 font-medium transition-colors px-3 py-2 rounded-lg hover:bg-gray-700">Beranda</a>
                    @endauth
                </div>

                <!-- User Menu - Pojok Kanan -->
                <div class="flex items-center space-x-4 ml-auto">
                    @auth
                    <div class="flex items-center space-x-4">
                        <!-- Notifikasi Bell -->
                        <a href="{{ route('notifications.index') }}" class="relative text-gray-300 hover:text-white transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            @php
                                try {
                                    $unreadCount = auth()->user()->unreadNotifications()->count();
                                } catch (Exception $e) {
                                    $unreadCount = 0;
                                }
                            @endphp
                            @if($unreadCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-medium text-white">{{ auth()->user()->nama }}</p>
                            <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role === 'guru' ? 'Pembina' : ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        </div>
                        <button onclick="handleLogout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center space-x-2 font-medium">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif
        
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif
        
        @if(session('warning'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg flex items-center space-x-2">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                <span>{{ session('warning') }}</span>
            </div>
        </div>
        @endif
        
        @if(session('welcome'))
        <div id="welcomeNotification" class="fixed top-4 right-4 z-50 max-w-sm">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-2xl shadow-2xl transform transition-all duration-500 translate-x-full opacity-0">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-check text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-lg mb-1">
                            @if(session('welcome.new_user'))
                                Selamat Bergabung!
                            @else
                                Selamat Datang Kembali!
                            @endif
                        </h3>
                        <p class="text-blue-100 text-sm mb-2">{{ session('welcome.name') }}</p>
                        <p class="text-blue-200 text-xs">{{ session('welcome.role') }}</p>
                    </div>
                    <button onclick="closeWelcomeNotification()" class="text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-300 text-white mt-16 pb-16">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-20 pb-12 ml-64">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-16">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-navy-50 to-navy-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane text-navy-300 text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">E-Mading Digital</span>
                    </div>
                    <p class="text-gray-300 mb-8 text-lg leading-relaxed max-w-lg">
                        Platform digital untuk berbagi informasi, karya, dan prestasi seluruh komunitas sekolah. 
                        Mari bersama-sama membangun budaya literasi yang modern dan inspiratif.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors transform hover:scale-110">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                    </div>
                </div>
                
                <div class="mb-12">
                    <h3 class="font-semibold text-xl mb-8">Quick Links</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors text-lg block py-1">Beranda</a></li>
                        @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-colors text-lg block py-1">Dashboard</a></li>
                        <li><a href="{{ route('artikel.create') }}" class="text-gray-300 hover:text-white transition-colors text-lg block py-1">Buat Artikel</a></li>
                        @else
                        <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors text-lg block py-1">Login</a></li>
                        @endauth
                    </ul>
                </div>
                
                <div class="mb-12">
                    <h3 class="font-semibold text-xl mb-8">Kontak</h3>
                    <div class="space-y-4 text-gray-300">
                        <p class="flex items-start space-x-3 text-lg py-1">
                            <i class="fas fa-map-marker-alt w-6 mt-1 text-xl flex-shrink-0"></i>
                            <span>Jl. Pendidikan No. 123</span>
                        </p>
                        <p class="flex items-center space-x-3 text-lg py-1">
                            <i class="fas fa-phone w-6 text-xl flex-shrink-0"></i>
                            <span>(021) 1234-5678</span>
                        </p>
                        <p class="flex items-center space-x-3 text-lg py-1">
                            <i class="fas fa-envelope w-6 text-xl flex-shrink-0"></i>
                            <span>info@e-mading.sch.id</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-16 pt-10 pb-8 text-center text-gray-300">
                <p class="text-lg">&copy; 2024 E-Mading Digital. All rights reserved. Dibangun dengan ❤️ untuk pendidikan.</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="{{ asset('js/image-upload.js') }}"></script>
    
    <script>
    // Welcome notification functionality
    function showWelcomeNotification() {
        const notification = document.getElementById('welcomeNotification');
        if (notification) {
            const content = notification.querySelector('div');
            setTimeout(() => {
                content.classList.remove('translate-x-full', 'opacity-0');
                content.classList.add('translate-x-0', 'opacity-100');
            }, 500);
            
            // Auto close after 5 seconds
            setTimeout(() => {
                closeWelcomeNotification();
            }, 5500);
        }
    }
    
    function closeWelcomeNotification() {
        const notification = document.getElementById('welcomeNotification');
        if (notification) {
            const content = notification.querySelector('div');
            content.classList.add('translate-x-full', 'opacity-0');
            content.classList.remove('translate-x-0', 'opacity-100');
            setTimeout(() => {
                notification.remove();
            }, 500);
        }
    }
    
    // Show welcome notification on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('welcomeNotification')) {
            showWelcomeNotification();
        }
    });
    
    // Handle logout with fresh CSRF token
    function handleLogout() {
        // Get fresh CSRF token
        fetch('/csrf-token')
            .then(response => response.json())
            .then(data => {
                // Create form with fresh token
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('logout') }}';
                
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = data.token;
                
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit();
            })
            .catch(error => {
                console.log('Logout failed:', error);
                // Fallback: redirect to login
                window.location.href = '{{ route('login') }}';
            });
    }
    </script>
    
    @stack('scripts')
</body>
</html>