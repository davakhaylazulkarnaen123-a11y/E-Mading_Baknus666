@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
               WELCOME
            <span class="block bg-gradient-to-r from-yellow-300 to-yellow-400 bg-clip-text text-transparent">
                E-Mading Baknus666  
            </span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Wadah kreativitas dan informasi digital untuk seluruh keluarga sekolah. 
            Berbagi cerita, prestasi, dan inspirasi dalam satu platform modern.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @auth
            <a href="{{ route('artikel.create') }}" 
               class="bg-white text-primary-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Buat Artikel Baru</span>
            </a>
            @else
            <a href="{{ route('login') }}" 
               class="bg-white text-primary-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login untuk Menulis</span>
            </a>
            @endauth
            <a href="#artikel-terbaru" 
               class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-primary-600 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                <i class="fas fa-newspaper"></i>
                <span>Jelajahi Artikel</span>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="p-6">
                <div class="text-3xl font-bold text-primary-600 mb-2">{{ $artikels->count() }}+</div>
                <div class="text-gray-600">Artikel Terbit</div>
            </div>
            <div class="p-6">
                <div class="text-3xl font-bold text-primary-600 mb-2">{{ $kategoris->count() }}+</div>
                <div class="text-gray-600">Kategori</div>
            </div>
            <div class="p-6">
                <div class="text-3xl font-bold text-primary-600 mb-2">24/7</div>
                <div class="text-gray-600">Akses Digital</div>
            </div>
            <div class="p-6">
                <div class="text-3xl font-bold text-primary-600 mb-2">100%</div>
                <div class="text-gray-600">Gratis</div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section id="artikel-terbaru" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($artikels->count() > 0)
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Artikel Terbaru</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Temukan informasi, inspirasi, dan cerita terbaru dari komunitas sekolah kami
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Featured Article -->
                @if($artikels->first())
                @php $featured = $artikels->first() @endphp
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 hover-lift">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @if($featured->foto)
                        <div class="h-80 md:h-auto">
                            <img src="{{ asset('storage/artikels/' . $featured->foto) }}" 
                                 alt="{{ $featured->judul }}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center" style="display: none;">
                                <i class="fas fa-newspaper text-white text-6xl"></i>
                            </div>
                        </div>
                        @else
                        <div class="h-80 md:h-auto">
                            <div class="w-full h-full bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-6xl"></i>
                            </div>
                        </div>
                        @endif
                        <div class="p-8 flex flex-col justify-center">
                            <span class="inline-block bg-primary-100 text-primary-800 text-sm font-medium px-3 py-1 rounded-full mb-4">
                                {{ $featured->kategori->nama_kategori }}
                            </span>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 leading-tight">
                                <a href="{{ route('artikel.show', $featured) }}" class="hover:text-primary-600 transition-colors">
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
                                   class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-lg transition-colors font-medium flex items-center space-x-2">
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
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-lift border border-gray-100">
                        @if($artikel->foto)
                        <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                             alt="{{ $artikel->judul }}" 
                             class="w-full h-48 object-cover"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center" style="display: none;">
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                        </div>
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                        </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="inline-block bg-primary-50 text-primary-700 text-xs font-medium px-2 py-1 rounded">
                                    {{ $artikel->kategori->nama_kategori }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $artikel->tanggal->diffForHumans() }}
                                </span>
                            </div>
                            
                            <h3 class="font-bold text-lg mb-3 text-gray-800 leading-tight">
                                <a href="{{ route('artikel.show', $artikel) }}" class="hover:text-primary-600 transition-colors">
                                    {{ Str::limit($artikel->judul, 60) }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($artikel->isi), 100) }}
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-user-circle text-primary-500"></i>
                                        <span>{{ $artikel->user->nama }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="far fa-heart text-red-400"></i>
                                        <span>{{ $artikel->like_count }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('artikel.show', $artikel) }}" 
                                   class="text-primary-600 hover:text-primary-700 font-medium flex items-center space-x-1">
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
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-fire text-orange-500"></i>
                        <span>Trending</span>
                    </h3>
                    <div class="space-y-4">
                        @foreach($artikelsPopuler as $index => $artikel)
                        <div class="flex items-start space-x-3 pb-4 border-b border-gray-100 last:border-b-0 last:pb-0">
                            <div class="flex-shrink-0 w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm font-bold">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-sm mb-1 leading-tight">
                                    <a href="{{ route('artikel.show', $artikel) }}" class="hover:text-primary-600 transition-colors">
                                        {{ Str::limit($artikel->judul, 50) }}
                                    </a>
                                </h4>
                                <div class="flex items-center space-x-2 text-xs text-gray-500">
                                    <span>{{ $artikel->likes_count }} likes</span>
                                    <span>•</span>
                                    <span>{{ $artikel->tanggal->format('d M') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800 flex items-center space-x-2">
                        <i class="fas fa-tags text-primary-500"></i>
                        <span>Kategori</span>
                    </h3>
                    <div class="space-y-2">
                        @foreach($kategoris as $kategori)
                        <a href="#" class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-primary-50 text-gray-700 hover:text-primary-600 transition-colors group">
                            <span class="font-medium">{{ $kategori->nama_kategori }}</span>
                            <span class="bg-primary-100 text-primary-600 text-xs px-2 py-1 rounded-full group-hover:bg-primary-200 transition-colors">
                                {{ $kategori->artikels->where('status', 'published')->count() }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- CTA Box -->
                @guest
                <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl shadow-lg p-6 text-white text-center">
                    <i class="fas fa-users text-3xl mb-4"></i>
                    <h4 class="font-bold text-lg mb-2">Bergabunglah dengan Kami</h4>
                    <p class="text-primary-100 text-sm mb-4">Bagikan cerita dan inspirasimu kepada komunitas sekolah</p>
                    <a href="{{ route('login') }}" 
                       class="bg-white text-primary-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors inline-block">
                        Login Sekarang
                    </a>
                </div>
                @endguest
            </div>
        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-primary-500 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada artikel</h3>
                <p class="text-gray-500 mb-6">Jadilah yang pertama membagikan cerita dan informasi menarik!</p>
                
                @auth
                <a href="{{ route('artikel.create') }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-xl font-semibold transition-colors inline-flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Buat Artikel Pertama</span>
                </a>
                @else
                <a href="{{ route('login') }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-3 rounded-xl font-semibold transition-colors inline-flex items-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login untuk Menulis</span>
                </a>
                @endauth
            </div>
        </div>
        @endif
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tentang E-Mading Digital</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Transformasi mading konvensional menjadi platform digital yang interaktif dan modern
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bolt text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Cepat & Real-time</h3>
                <p class="text-gray-600">Informasi terbaru langsung sampai ke pembaca tanpa delay</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Kolaboratif</h3>
                <p class="text-gray-600">Siswa, guru, dan staff bersama-sama membangun konten</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-primary-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Akses Mobile</h3>
                <p class="text-gray-600">Bisa diakses kapan saja dan di mana saja via smartphone</p>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .gradient-bg {
        background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
</style>