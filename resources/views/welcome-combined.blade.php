<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Mading Digital Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
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
            fill: #ffffff;
        }
        .article-card {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fade-in-up.animate {
            opacity: 1;
            transform: translateY(0);
        }
        .hero-title {
            animation: heroTitleIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) 0.3s forwards;
        }
        .hero-subtitle {
            animation: heroSubtitleIn 1s cubic-bezier(0.4, 0, 0.2, 1) 0.8s forwards;
        }
        .hero-question {
            animation: heroQuestionIn 1s cubic-bezier(0.4, 0, 0.2, 1) 1.2s forwards;
        }
        .hero-buttons {
            animation: heroButtonsIn 1s cubic-bezier(0.4, 0, 0.2, 1) 1.6s forwards;
        }
        @keyframes heroTitleIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes heroSubtitleIn {
            to {
                opacity: 0.9;
                transform: translateY(0);
            }
        }
        @keyframes heroQuestionIn {
            to {
                opacity: 0.8;
                transform: translateY(0);
            }
        }
        @keyframes heroButtonsIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="font-sans bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-gray-800/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="SMK Bakti Nusantara 666" class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <div class="text-xl font-bold text-white">E-Mading</div>
                        <div class="text-xs text-gray-400">Digital School Magazine</div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white font-medium hover:text-blue-400 transition-colors">Beranda</a>
                </div>

                <!-- Login/Logout Button -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 font-medium transition-colors flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
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
                <h1 class="text-6xl md:text-8xl font-bold mb-4 hero-title opacity-0 translate-y-12">WELCOME</h1>
                <p class="text-xl md:text-2xl mb-8 opacity-0 hero-subtitle translate-y-8">E-mading Baknus666</p>
                <p class="text-lg md:text-xl mb-12 opacity-0 hero-question translate-y-8">Do You Wanna Join Us?</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center hero-buttons opacity-0 translate-y-8">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Started Now
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Started Now
                    </a>
                @endauth
                <a href="#articles" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
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

    <!-- Stats Section -->
    <section class="bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 transform hover:scale-105 transition-all duration-300 fade-in-up">
                    <div class="text-3xl font-bold text-blue-400 mb-2 counter" data-target="{{ $artikels->total() }}">0</div>
                    <div class="text-gray-300">Artikel Terbit</div>
                </div>
                <div class="p-6 transform hover:scale-105 transition-all duration-300 fade-in-up">
                    <div class="text-3xl font-bold text-blue-400 mb-2 counter" data-target="{{ $kategoris->count() }}">0</div>
                    <div class="text-gray-300">Kategori</div>
                </div>
                <div class="p-6 transform hover:scale-105 transition-all duration-300 fade-in-up">
                    <div class="text-3xl font-bold text-blue-400 mb-2">24/7</div>
                    <div class="text-gray-300">Akses Digital</div>
                </div>
                <div class="p-6 transform hover:scale-105 transition-all duration-300 fade-in-up">
                    <div class="text-3xl font-bold text-blue-400 mb-2">100%</div>
                    <div class="text-gray-300">Gratis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="py-16 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($artikels->count() > 0)
            <div class="text-center mb-12 fade-in-up">
                <h2 class="text-4xl font-bold text-white mb-4">Artikel Terbaru</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Temukan informasi, inspirasi, dan cerita terbaru dari komunitas sekolah kami
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Featured Article -->
                    @if($artikels->first())
                    @php $featured = $artikels->first() @endphp
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 hover:shadow-2xl transition-all duration-500 transform hover:scale-105 article-card opacity-0 translate-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            @if($featured->foto && file_exists(public_path('storage/artikels/' . $featured->foto)))
                            <div class="h-80 md:h-auto">
                                <img src="{{ asset('storage/artikels/' . $featured->foto) }}" 
                                     alt="{{ $featured->judul }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="h-80 md:h-auto bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-6xl"></i>
                            </div>
                            @endif
                            <div class="p-8 flex flex-col justify-center">
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mb-4">
                                    {{ $featured->kategori->nama_kategori }}
                                </span>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4 leading-tight">
                                    <a href="{{ route('artikel.show', $featured) }}" class="hover:text-blue-600 transition-colors">
                                        {{ $featured->judul }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-6 line-clamp-3">
                                    {{ Str::limit(strip_tags($featured->isi), 150) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-user-circle"></i>
                                            <span>{{ $featured->user->nama }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <i class="far fa-calendar"></i>
                                            <span>{{ $featured->tanggal->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('artikel.show', $featured) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
                                        <span>Baca</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Articles Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($artikels->skip(1) as $artikel)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-500 transform hover:scale-105 border border-gray-100 article-card opacity-0 translate-y-8">
                            @if($artikel->foto && file_exists(public_path('storage/artikels/' . $artikel->foto)))
                            <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                                 alt="{{ $artikel->judul }}" 
                                 class="w-full h-48 object-cover">
                            @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-4xl"></i>
                            </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block bg-blue-50 text-blue-700 text-xs font-medium px-2 py-1 rounded">
                                        {{ $artikel->kategori->nama_kategori }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $artikel->tanggal->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <h3 class="font-bold text-lg mb-3 text-gray-800 leading-tight">
                                    <a href="{{ route('artikel.show', $artikel) }}" class="hover:text-blue-600 transition-colors">
                                        {{ Str::limit($artikel->judul, 60) }}
                                    </a>
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($artikel->isi), 100) }}
                                </p>
                                
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-user-circle text-blue-500"></i>
                                            <span>{{ $artikel->user->nama }}</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <i class="fas fa-eye text-blue-400"></i>
                                            <span>{{ $artikel->views ?? 0 }}</span>
                                        </div>
                                        <!-- Like Button -->
                                        @auth
                                            <button class="like-btn flex items-center space-x-1 text-gray-500 hover:text-red-500 transition-colors cursor-pointer"
                                                    data-artikel-id="{{ $artikel->id_artikel }}"
                                                    onclick="toggleLikeHome(this)">
                                                <i class="{{ $artikel->isLikedByUser(auth()->user()->id_user) ? 'fas text-red-500' : 'far' }} fa-heart"></i>
                                                <span class="like-count">{{ $artikel->likes()->count() }}</span>
                                            </button>
                                        @else
                                            <span class="flex items-center space-x-1 text-gray-400 cursor-not-allowed" 
                                                  title="Login untuk memberikan like">
                                                <i class="far fa-heart"></i>
                                                <span>{{ $artikel->likes()->count() }}</span>
                                            </span>
                                        @endauth
                                    </div>
                                    <a href="{{ route('artikel.show', $artikel) }}" 
                                       class="text-blue-600 hover:text-blue-700 font-medium flex items-center space-x-1">
                                        <span>Baca</span>
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Popular Articles -->
                    <div class="bg-white rounded-xl shadow-lg p-6 article-card opacity-0 translate-y-8">
                        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center space-x-2">
                            <i class="fas fa-fire text-orange-500"></i>
                            <span>Trending</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach($artikelsPopuler as $index => $artikel)
                            <div class="flex items-start space-x-3 pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm font-bold">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm mb-1 leading-tight">
                                        <a href="{{ route('artikel.show', $artikel) }}" class="hover:text-blue-600 transition-colors">
                                            {{ Str::limit($artikel->judul, 50) }}
                                        </a>
                                    </h4>
                                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                                        <span>{{ $artikel->views ?? 0 }} views</span>
                                        <span>•</span>
                                        <span>{{ $artikel->tanggal->format('d M') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-lg p-6 article-card opacity-0 translate-y-8">
                        <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center space-x-2">
                            <i class="fas fa-tags text-blue-500"></i>
                            <span>Kategori</span>
                        </h3>
                        <div class="space-y-2">
                            @foreach($kategoris as $kategori)
                            <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-colors group">
                                <span class="font-medium">{{ $kategori->nama_kategori }}</span>
                                <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full group-hover:bg-blue-200 transition-colors">
                                    {{ $kategori->artikels->where('status', 'published')->count() }}
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-newspaper text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada artikel</h3>
                    <p class="text-gray-500 mb-6">Jadilah yang pertama membagikan cerita dan informasi menarik!</p>
                    
                    @auth
                    <a href="{{ route('artikel.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-colors inline-flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Buat Artikel Pertama</span>
                    </a>
                    @else
                    <a href="{{ route('login') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transition-colors inline-flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login untuk Menulis</span>
                    </a>
                    @endauth
                </div>
            </div>
            @endif
        </div>
    </section>
<script>
// Counter Animation
function animateCounters() {
    const counters = document.querySelectorAll('.counter');
    
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const increment = target / 100;
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current);
                setTimeout(updateCounter, 20);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    });
}

// Intersection Observer for triggering animation when stats section is visible
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(entry.target);
        }
    });
});

// Scroll Animation Observer
const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            if (entry.target.classList.contains('fade-in-up')) {
                entry.target.classList.add('animate');
            }
            if (entry.target.classList.contains('article-card')) {
                setTimeout(() => {
                    entry.target.classList.remove('opacity-0', 'translate-y-8');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }, 100);
            }
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

// Staggered animation for article cards
function animateArticleCards() {
    const articleCards = document.querySelectorAll('.article-card');
    articleCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.remove('opacity-0', 'translate-y-8');
            card.classList.add('opacity-100', 'translate-y-0');
        }, index * 150);
    });
}

// Special observer for articles section
const articlesObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateArticleCards();
            articlesObserver.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.2
});

// Start observing sections
document.addEventListener('DOMContentLoaded', () => {
    // Stats counter observer
    const statsSection = document.querySelector('.bg-gray-800');
    if (statsSection) {
        observer.observe(statsSection);
    }
    
    // Articles section observer
    const articlesSection = document.querySelector('#articles');
    if (articlesSection) {
        articlesObserver.observe(articlesSection);
    }
    
    // Observe all fade-in-up elements
    const fadeElements = document.querySelectorAll('.fade-in-up');
    fadeElements.forEach(element => {
        scrollObserver.observe(element);
    });
    
    // Observe all article cards
    const articleCards = document.querySelectorAll('.article-card');
    articleCards.forEach(card => {
        scrollObserver.observe(card);
    });
});

@auth
// Like functionality for home page
function toggleLikeHome(button) {
    const artikelId = button.dataset.artikelId;
    const likeIcon = button.querySelector('i');
    const likeCount = button.querySelector('.like-count');
    
    // Disable button temporarily
    button.disabled = true;
    button.style.opacity = '0.6';
    
    fetch(`/artikel/${artikelId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            alert(data.error);
            return;
        }
        
        if (data.liked) {
            likeIcon.className = 'fas fa-heart text-red-500';
        } else {
            likeIcon.className = 'far fa-heart';
        }
        likeCount.textContent = data.like_count;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
    })
    .finally(() => {
        // Re-enable button
        button.disabled = false;
        button.style.opacity = '1';
    });
}
@endauth
</script>
</body>
</html>