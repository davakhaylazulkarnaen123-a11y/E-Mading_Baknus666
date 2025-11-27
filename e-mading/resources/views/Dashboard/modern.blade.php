@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-900 to-gray-800">


    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-slate-800/95 backdrop-blur-md shadow-2xl z-40 transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 border-r border-gray-700">
        <!-- Logo -->
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-paper-plane text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-white">E-Mading</span>
                </div>
                <button id="sidebarClose" class="w-8 h-8 rounded-lg hover:bg-gray-700 flex items-center justify-center lg:hidden">
                    <i class="fas fa-times text-gray-300"></i>
                </button>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 bg-purple-600/80 text-white rounded-xl font-medium">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('artikel.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-list w-5"></i>
                <span>Artikel Saya</span>
            </a>
            <a href="{{ route('artikel.create') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-plus w-5"></i>
                <span>Buat Artikel</span>
            </a>
            @if(auth()->user()->isSiswa())
            <a href="{{ route('notifications.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-bell w-5"></i>
                <span>Notifikasi</span>
                @php
                    try {
                        $unreadCount = auth()->user()->unreadNotifications()->count();
                    } catch (Exception $e) {
                        $unreadCount = 0;
                    }
                @endphp
                @if($unreadCount > 0)
                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full ml-auto">{{ $unreadCount }}</span>
                @endif
            </a>
            @endif
            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
            <a href="{{ route('pending.articles') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-clock w-5"></i>
                <span>Pending Artikel</span>
            </a>
            <a href="{{ route('pending.comments') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-comments w-5"></i>
                <span>Pending Komentar</span>
            </a>
            @endif
            @if(auth()->user()->isAdmin())
            <a href="{{ route('user.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-cog w-5"></i>
                <span>Settings</span>
            </a>
            @endif
            <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:bg-gray-700/80 rounded-xl font-medium transition-colors">
                <i class="fas fa-eye w-5"></i>
                <span>Preview</span>
            </a>
        </nav>


    </div>

    <!-- Main Content -->
    <div id="mainContent" class="ml-0 lg:ml-64 p-8 relative z-10 transition-all duration-300">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-4">
                <button id="sidebarToggle" class="w-10 h-10 bg-slate-800 hover:bg-slate-700 rounded-xl shadow-sm flex items-center justify-center transition-colors lg:hidden border border-gray-600">
                    <i class="fas fa-bars text-gray-300"></i>
                </button>
                <div>
                    <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                    <p class="text-gray-300">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-medium text-white">{{ auth()->user()->nama }}</p>
                        <p class="text-sm text-gray-300">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-slate-800 to-gray-800 rounded-3xl p-8 mb-8 relative overflow-hidden border border-gray-700 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent mb-2">Dashboard</h2>
                    <p class="text-gray-300 mb-6">Kelola artikel dan konten Anda</p>
                    @if(auth()->user()->role !== 'guru')
                    <a href="{{ route('artikel.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus"></i>
                        <span>Create New Article</span>
                    </a>
                    @endif
                </div>
                <div class="hidden lg:block">
                    <div class="w-48 h-32 bg-gradient-to-br from-purple-600/20 to-blue-600/20 rounded-2xl flex items-center justify-center border border-gray-600">
                        <i class="fas fa-laptop-code text-4xl text-purple-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-chart-bar text-blue-400 mr-3"></i>
                Overview
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 text-white border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-newspaper text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold">{{ $totalArtikel ?? 0 }}</span>
                    </div>
                    <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Artikel</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 text-white border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold">{{ $artikelPublished ?? 0 }}</span>
                    </div>
                    <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Published</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 text-white border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold">{{ $totalViews ?? 0 }}</span>
                    </div>
                    <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Views</p>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 text-white border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-gray-500 to-gray-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold">{{ $artikelDraft ?? 0 }}</span>
                    </div>
                    <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Draft</p>
                </div>
            </div>
        </div>

        @if(auth()->user()->isSiswa() && isset($notifications) && $notifications->count() > 0)
        <!-- Notifikasi untuk Siswa -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Notifikasi Terbaru</h3>
            <div class="space-y-3">
                @foreach($notifications->take(3) as $notification)
                <div class="bg-white rounded-2xl p-4 shadow-sm border-l-4 {{ $notification->is_read ? 'border-gray-300' : 'border-red-500' }} hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h4 class="font-semibold text-gray-800">{{ $notification->title }}</h4>
                                @if(!$notification->is_read)
                                    <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                                @endif
                            </div>
                            <p class="text-gray-600 text-sm mb-2">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if(!$notification->is_read)
                            <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm px-3 py-1 rounded-lg hover:bg-blue-50 transition-colors">
                                    Tandai Dibaca
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('notifications.destroy', $notification->id_notification) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm px-3 py-1 rounded-lg hover:bg-red-50 transition-colors" onclick="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($notifications->count() > 3)
                <div class="text-center">
                    <a href="{{ route('notifications.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Semua Notifikasi ({{ $notifications->count() }})
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Recent Articles -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-newspaper text-green-400 mr-3"></i>
                @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                    Artikel Terbaru (Semua)
                @else
                    Artikel Saya
                @endif
            </h3>
            <div class="space-y-4">
                @if(isset($artikelTerbaru) && $artikelTerbaru->count() > 0)
                    @foreach($artikelTerbaru as $artikel)
                    <div class="bg-gradient-to-r from-slate-800 to-gray-800 rounded-2xl p-6 shadow-xl border border-gray-600 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                @if($artikel->foto)
                                <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                                     alt="{{ $artikel->judul }}" 
                                     class="w-16 h-16 rounded-xl object-cover border border-gray-600"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center" style="display: none;">
                                    <i class="fas fa-newspaper text-white text-xl"></i>
                                </div>
                                @else
                                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-xl"></i>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-semibold text-white mb-1">{{ Str::limit($artikel->judul ?? 'Untitled', 50) }}</h4>
                                    <p class="text-sm text-gray-300">
                                        {{ $artikel->kategori->nama_kategori ?? 'Uncategorized' }} • 
                                        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                                            {{ $artikel->user->nama }} • 
                                        @endif
                                        {{ $artikel->created_at ? $artikel->created_at->format('d M Y') : 'Unknown date' }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $artikel->views ?? 0 }} Views</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                @php
                                    $statusColors = [
                                        'published' => 'bg-green-100 text-green-600',
                                        'pending' => 'bg-yellow-100 text-yellow-600',
                                        'draft' => 'bg-gray-100 text-gray-600',
                                        'rejected' => 'bg-red-100 text-red-600'
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$artikel->status ?? 'draft'] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($artikel->status ?? 'draft') }}
                                </span>
                                <div class="flex items-center space-x-2">
                                    @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                                        @if($artikel->status === 'pending')
                                        <form action="{{ route('artikel.approve', $artikel) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-8 h-8 bg-green-100 hover:bg-green-200 text-green-600 rounded-lg flex items-center justify-center transition-colors" title="Approve">
                                                <i class="fas fa-check text-sm"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('artikel.reject', $artikel) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg flex items-center justify-center transition-colors" title="Reject">
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @endif
                                    @if(auth()->user()->isAdmin() || auth()->user()->id_user === $artikel->id_user)
                                    <a href="{{ route('artikel.edit', $artikel) }}" class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors" title="Edit">
                                        <i class="fas fa-edit text-gray-600 text-sm"></i>
                                    </a>
                                    @endif
                                    <a href="{{ route('artikel.show', $artikel) }}" class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg flex items-center justify-center transition-colors" title="View">
                                        <i class="fas fa-external-link-alt text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-12 text-center border border-gray-600 shadow-xl">
                        <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-slate-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-gray-300 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">
                            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                                Belum ada artikel
                            @else
                                Anda belum membuat artikel
                            @endif
                        </h3>
                        <p class="text-gray-300 mb-8 text-lg">
                            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                                Belum ada artikel yang dibuat oleh pengguna
                            @else
                                Mulai berbagi cerita dan informasi menarik
                            @endif
                        </p>
                        @if(!auth()->user()->isGuru())
                        <a href="{{ route('artikel.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus"></i>
                            <span>Buat Artikel</span>
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        
        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
        <!-- Quick Actions for Admin/Guru -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('pending.articles') }}" class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 shadow-xl border border-gray-600 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-1">Artikel Pending</h4>
                        <p class="text-sm text-gray-300">{{ $artikelPending ?? 0 }} artikel menunggu review</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('pending.comments') }}" class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 shadow-xl border border-gray-600 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-comments text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-1">Komentar Pending</h4>
                        <p class="text-sm text-gray-300">Moderasi komentar baru</p>
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>
</div>

<script>
// Sidebar Toggle Functionality
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarOverlay = document.getElementById('sidebarOverlay');
const mainContent = document.getElementById('mainContent');
let sidebarOpen = window.innerWidth >= 1024; // Open by default on desktop

// Update sidebar state based on screen size
function updateSidebarForScreenSize() {
    if (window.innerWidth >= 1024) {
        // Desktop: sidebar always visible
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
        mainContent.classList.add('lg:ml-64');
        sidebarOpen = true;
    } else {
        // Mobile/Tablet: sidebar hidden by default
        if (!sidebarOpen) {
            sidebar.classList.add('-translate-x-full');
        }
        mainContent.classList.remove('lg:ml-64');
    }
}

// Toggle sidebar
function toggleSidebar() {
    sidebarOpen = !sidebarOpen;
    
    if (sidebarOpen) {
        sidebar.classList.remove('-translate-x-full');
        if (window.innerWidth < 1024) {
            sidebarOverlay.classList.remove('hidden');
        }
    } else {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    }
}

// Event listeners
sidebarToggle.addEventListener('click', toggleSidebar);
sidebarOverlay.addEventListener('click', toggleSidebar);
document.getElementById('sidebarClose').addEventListener('click', toggleSidebar);

// Handle window resize
window.addEventListener('resize', updateSidebarForScreenSize);

// Touch/Swipe functionality
let touchStartX = 0;
let touchEndX = 0;

// Touch events for swipe
document.addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
});

document.addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 100;
    const swipeDistance = touchEndX - touchStartX;
    
    // Only handle swipes on mobile/tablet
    if (window.innerWidth < 1024) {
        // Swipe right to open sidebar (from left edge)
        if (swipeDistance > swipeThreshold && touchStartX < 50 && !sidebarOpen) {
            toggleSidebar();
        }
        // Swipe left to close sidebar
        else if (swipeDistance < -swipeThreshold && sidebarOpen) {
            toggleSidebar();
        }
    }
}

// Initialize sidebar state
updateSidebarForScreenSize();

// Keyboard shortcut (Ctrl + B)
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'b') {
        e.preventDefault();
        toggleSidebar();
    }
});
</script>

@endsection