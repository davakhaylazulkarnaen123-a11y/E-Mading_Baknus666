@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header dengan Gradient -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-primary-600 to-purple-600 rounded-3xl p-8 text-white shadow-2xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-3">Artikel Saya</h1>
                    <p class="text-primary-100 text-lg">Kelola dan pantau semua artikel yang telah Anda buat</p>
                </div>
                <a href="{{ route('artikel.create') }}" 
                   class="mt-4 md:mt-0 bg-white text-primary-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-3 group">
                    <i class="fas fa-plus-circle text-xl group-hover:rotate-90 transition-transform"></i>
                    <span class="text-lg">Buat Artikel Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-xs font-medium">Total</p>
                    <p class="text-2xl font-bold mt-1">{{ $artikels->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-layer-group text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-xs font-medium">Published</p>
                    <p class="text-2xl font-bold mt-1">{{ $artikels->where('status', 'published')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-green-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-xs font-medium">Pending</p>
                    <p class="text-2xl font-bold mt-1">{{ $artikels->where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-100 text-xs font-medium">Draft</p>
                    <p class="text-2xl font-bold mt-1">{{ $artikels->where('status', 'draft')->count() }}</p>
                </div>
                <div class="w-10 h-10 bg-gray-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-edit text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-xs font-medium">Views</p>
                    <p class="text-2xl font-bold mt-1">{{ $artikels->sum('views') }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-eye text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    @if($artikels->count() > 0)
    <!-- Articles Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        @foreach($artikels as $artikel)
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
          <!-- Article Image -->
<div class="relative h-48 bg-gradient-to-br from-primary-500 to-primary-600 overflow-hidden">
    @if($artikel->foto)
    <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
         alt="{{ $artikel->judul }}" 
         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
    <div class="w-full h-full flex items-center justify-center" style="display: none;">
        <i class="fas fa-newspaper text-white text-5xl opacity-50"></i>
    </div>
    @else
    <div class="w-full h-full flex items-center justify-center">
        <i class="fas fa-newspaper text-white text-5xl opacity-50"></i>
    </div>
    @endif
    
    <!-- Status Badge -->
    <div class="absolute top-4 left-4">
        @if($artikel->status == 'published')
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow-lg">
            <i class="fas fa-check-circle mr-1"></i>
            PUBLISHED
        </span>
        @elseif($artikel->status == 'pending')
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-500 text-white shadow-lg">
            <i class="fas fa-clock mr-1"></i>
            PENDING
        </span>
        @elseif($artikel->status == 'rejected')
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-500 text-white shadow-lg">
            <i class="fas fa-times-circle mr-1"></i>
            REJECTED
        </span>
        @else
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-500 text-white shadow-lg">
            <i class="fas fa-edit mr-1"></i>
            DRAFT
        </span>
        @endif
    </div>

    <!-- Category Badge -->
    <div class="absolute top-4 right-4">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/90 text-primary-600 backdrop-blur-sm">
            <i class="fas fa-tag mr-1"></i>
            {{ $artikel->kategori->nama_kategori }}
        </span>
    </div>

    <!-- Overlay Gradient -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
</div>

            <!-- Article Content -->
            <div class="p-6">
                <h3 class="font-bold text-xl text-gray-800 mb-3 line-clamp-2 group-hover:text-primary-600 transition-colors">
                    <a href="{{ route('artikel.show', $artikel) }}">
                        {{ $artikel->judul }}
                    </a>
                </h3>

                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ Str::limit(strip_tags($artikel->isi), 100) }}
                </p>

                <!-- Article Meta -->
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center space-x-1">
                            <i class="fas fa-user-circle text-primary-500"></i>
                            <span>{{ $artikel->user->nama }}</span>
                        </span>
                        <span class="flex items-center space-x-1">
                            <i class="far fa-calendar text-primary-500"></i>
                            <span>{{ $artikel->tanggal->format('d M Y') }}</span>
                        </span>
                    </div>
                    <span class="flex items-center space-x-1">
                        <i class="far fa-eye text-primary-500"></i>
                        <span>{{ $artikel->views }} views</span>
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('artikel.show', $artikel) }}" 
                           class="w-10 h-10 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/view"
                           title="Lihat Artikel">
                            <i class="fas fa-eye group-hover/view:rotate-12 transition-transform"></i>
                        </a>
                        <a href="{{ route('artikel.edit', $artikel) }}" 
                           class="w-10 h-10 bg-green-100 hover:bg-green-200 text-green-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/edit"
                           title="Edit Artikel">
                            <i class="fas fa-edit group-hover/edit:rotate-12 transition-transform"></i>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                            @if($artikel->user->role === 'siswa' && $artikel->status === 'pending')
                                <!-- Approval buttons for pending student articles -->
                                <form action="{{ route('artikel.approve', $artikel) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="w-10 h-10 bg-green-100 hover:bg-green-200 text-green-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/approve"
                                            title="Setujui Artikel">
                                        <i class="fas fa-check group-hover/approve:rotate-12 transition-transform"></i>
                                    </button>
                                </form>
                                <form action="{{ route('artikel.reject', $artikel) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="w-10 h-10 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/reject"
                                            title="Tolak Artikel"
                                            onclick="return confirm('Yakin ingin menolak artikel ini?')">
                                        <i class="fas fa-times group-hover/reject:rotate-12 transition-transform"></i>
                                    </button>
                                </form>
                            @else
                                <!-- Regular publish/unpublish -->
                                <form action="{{ route('artikel.' . ($artikel->status == 'published' ? 'unpublish' : 'publish'), $artikel) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="w-10 h-10 bg-{{ $artikel->status == 'published' ? 'orange' : 'green' }}-100 hover:bg-{{ $artikel->status == 'published' ? 'orange' : 'green' }}-200 text-{{ $artikel->status == 'published' ? 'orange' : 'green' }}-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/status"
                                            title="{{ $artikel->status == 'published' ? 'Unpublish' : 'Publish' }}">
                                        <i class="fas fa-{{ $artikel->status == 'published' ? 'eye-slash' : 'eye' }} group-hover/status:rotate-12 transition-transform"></i>
                                    </button>
                                </form>
                            @endif
                        @elseif(auth()->user()->id_user === $artikel->id_user && $artikel->status === 'draft')
                            <!-- Publish button for article owner's draft -->
                            <form action="{{ route('artikel.publish', $artikel) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm font-semibold rounded-lg flex items-center space-x-2 transition-all duration-300 transform hover:scale-105 shadow-lg"
                                        title="Kirim untuk Review">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Publish</span>
                                </button>
                            </form>
                        @endif
                        
                        <form action="{{ route('artikel.destroy', $artikel) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-10 h-10 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group/delete"
                                    title="Hapus Artikel"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                <i class="fas fa-trash group-hover/delete:shake transition-transform"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty Search State -->
    @if($artikels->count() === 0)
    <div class="text-center py-16">
        <div class="w-32 h-32 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-search text-primary-600 text-4xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Tidak ada artikel yang ditemukan</h3>
        <p class="text-gray-500 mb-8">Coba ubah kata kunci pencarian atau buat artikel baru</p>
        <a href="{{ route('artikel.create') }}" 
           class="inline-flex items-center space-x-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus"></i>
            <span>Buat Artikel Baru</span>
        </a>
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="bg-white rounded-3xl shadow-xl p-16 text-center border border-gray-100">
        <div class="w-40 h-40 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-8">
            <i class="fas fa-newspaper text-primary-600 text-5xl"></i>
        </div>
        <h3 class="text-3xl font-bold text-gray-700 mb-4">Belum ada artikel</h3>
        <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto">Mulai bagikan cerita, informasi, atau karya terbaikmu kepada komunitas sekolah.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('artikel.create') }}" 
               class="inline-flex items-center space-x-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus-circle text-xl"></i>
                <span class="text-lg">Buat Artikel Pertama</span>
            </a>
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center space-x-3 bg-white border-2 border-gray-300 text-gray-700 hover:border-primary-400 hover:text-primary-600 font-bold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-arrow-left text-xl"></i>
                <span class="text-lg">Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
    @endif

    <!-- Quick Stats -->
    @if($artikels->count() > 0)
    <div class="mt-12">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-8 text-white shadow-2xl">
            <h3 class="text-2xl font-bold mb-6 text-center">Statistik Artikel Anda</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">{{ $artikels->where('status', 'published')->count() }}</div>
                    <p class="text-gray-300">Artikel Published</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-400 mb-2">{{ $artikels->where('status', 'draft')->count() }}</div>
                    <p class="text-gray-300">Dalam Draft</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $artikels->sum('views') }}</div>
                    <p class="text-gray-300">Total Views</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Success Notification -->
@if(session('success'))
<div id="successNotification" class="fixed top-4 right-4 z-50 animate-fade-in">
    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center space-x-3 transform transition-all duration-500 slide-in-right">
        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
            <i class="fas fa-check text-xl"></i>
        </div>
        <div>
            <p class="font-bold text-lg">Sukses!</p>
            <p class="text-green-100">{{ session('success') }}</p>
        </div>
        <button onclick="closeNotification()" class="text-green-100 hover:text-white transition-colors">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
</div>
@endif

<script>
    // Notification close functionality
    function closeNotification() {
        const notification = document.getElementById('successNotification');
        if (notification) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }
    }

    // Auto close notification after 5 seconds
    setTimeout(() => {
        closeNotification();
    }, 5000);

    // Add hover effects and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add staggered animation to article cards
        const cards = document.querySelectorAll('.group');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-fade-in-up');
        });

        // Add shake animation for delete button
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: scale(1) rotate(0deg); }
                25% { transform: scale(1.1) rotate(-5deg); }
                75% { transform: scale(1.1) rotate(5deg); }
            }
            .group-hover\\/delete:hover i {
                animation: shake 0.5s ease-in-out;
            }
            @keyframes fade-in-up {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-fade-in-up {
                animation: fade-in-up 0.6s ease-out forwards;
            }
            @keyframes slide-in-right {
                from {
                    transform: translateX(100%);
                }
                to {
                    transform: translateX(0);
                }
            }
            .slide-in-right {
                animation: slide-in-right 0.5s ease-out;
            }
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    });
</script>

<style>
    /* Custom scrollbar for the page */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Smooth transitions */
    * {
        transition-property: color, background-color, border-color, transform, box-shadow;
        transition-duration: 300ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection