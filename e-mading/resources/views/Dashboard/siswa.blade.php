@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-800 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-10">
            <div class="bg-gradient-to-r from-slate-800 to-gray-800 rounded-2xl p-8 border border-gray-700 shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-green-400 to-blue-400 bg-clip-text text-transparent mb-2">Dashboard Siswa</h1>
                        <p class="text-gray-300 text-lg">Selamat datang, {{ auth()->user()->nama }}</p>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="bg-gradient-to-r from-slate-700 to-gray-700 rounded-full p-3 shadow-lg border border-gray-600">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 p-6 border border-gray-600 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Artikel</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $totalArtikel }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 p-6 border border-gray-600 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Published</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $artikelPublished }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 p-6 border border-gray-600 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Pending</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $artikelPending }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 p-6 border border-gray-600 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Views</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $totalViews }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-eye text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <a href="{{ route('artikel.create') }}" class="group bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-700 text-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 transition-all duration-300 border border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Tulis Artikel Baru</h3>
                        <p class="text-blue-100 text-sm">Bagikan ide dan pemikiranmu</p>
                    </div>
                    <div class="p-4 bg-white bg-opacity-20 rounded-2xl group-hover:bg-opacity-30 transition-all duration-300">
                        <i class="fas fa-plus text-3xl"></i>
                    </div>
                </div>
            </a>

            <a href="{{ route('artikel.index') }}" class="group bg-gradient-to-br from-green-600 via-green-700 to-emerald-700 text-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 transition-all duration-300 border border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Kelola Artikel</h3>
                        <p class="text-green-100 text-sm">Edit dan kelola artikelmu</p>
                    </div>
                    <div class="p-4 bg-white bg-opacity-20 rounded-2xl group-hover:bg-opacity-30 transition-all duration-300">
                        <i class="fas fa-edit text-3xl"></i>
                    </div>
                </div>
            </a>

            <a href="{{ route('home') }}" class="group bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-700 text-white p-8 rounded-3xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 transition-all duration-300 border border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Jelajahi E-Mading</h3>
                        <p class="text-purple-100 text-sm">Baca artikel terbaru</p>
                    </div>
                    <div class="p-4 bg-white bg-opacity-20 rounded-2xl group-hover:bg-opacity-30 transition-all duration-300">
                        <i class="fas fa-compass text-3xl"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Artikel Terbaru -->
        <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-3xl shadow-2xl border border-gray-600">
            <div class="p-8 border-b border-gray-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-3 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Artikel Terbaru Saya</h3>
                    </div>
                    <a href="{{ route('artikel.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-2xl font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        Lihat semua →
                    </a>
                </div>
            </div>
            <div class="p-8">
                @if($artikelTerbaru->count() > 0)
                    <div class="space-y-6">
                        @foreach($artikelTerbaru as $artikel)
                        <div class="bg-gradient-to-r from-gray-700 to-slate-700 rounded-2xl p-6 border border-gray-600 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="font-bold text-white text-lg mb-3">{{ $artikel->judul }}</h4>
                                    <div class="flex items-center space-x-6 text-sm">
                                        <span class="flex items-center bg-gray-600 text-gray-200 px-3 py-2 rounded-xl">
                                            <i class="fas fa-folder mr-2 text-blue-400"></i>
                                            {{ $artikel->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                        </span>
                                        <span class="flex items-center bg-gray-600 text-gray-200 px-3 py-2 rounded-xl">
                                            <i class="fas fa-eye mr-1 text-purple-400"></i>
                                            {{ $artikel->views ?? 0 }} views
                                        </span>
                                        <span class="flex items-center bg-gray-600 text-gray-200 px-3 py-2 rounded-xl">
                                            <i class="fas fa-calendar mr-2 text-green-400"></i>
                                            {{ $artikel->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4 ml-6">
                                    <div class="flex flex-col items-end">
                                        <span class="px-4 py-2 text-sm font-semibold rounded-2xl 
                                            @if($artikel->status == 'published') bg-green-500 text-white
                                            @elseif($artikel->status == 'pending') bg-yellow-500 text-white
                                            @elseif($artikel->status == 'rejected') bg-red-500 text-white
                                            @else bg-gray-500 text-white @endif">
                                            {{ ucfirst($artikel->status) }}
                                        </span>
                                        @if($artikel->status == 'rejected' && isset($artikel->rejection_reason) && $artikel->rejection_reason)
                                            <button onclick="showRejectionReason('{{ addslashes($artikel->rejection_reason) }}', '{{ addslashes(optional($artikel->reviewer)->nama ?? 'Admin') }}', '{{ isset($artikel->reviewed_at) && $artikel->reviewed_at ? $artikel->reviewed_at->format('d/m/Y H:i') : '' }}')"
                                                    class="text-xs text-red-400 hover:text-red-300 mt-1 underline">
                                                Lihat Alasan
                                            </button>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('artikel.show', $artikel) }}" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 text-white rounded-xl flex items-center justify-center transition-colors">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('artikel.edit', $artikel) }}" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="mb-6">
                            <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-slate-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-newspaper text-4xl text-gray-300"></i>
                            </div>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-3">Belum ada artikel</h4>
                        <p class="text-gray-300 mb-8 text-lg">Mulai menulis artikel pertamamu sekarang!</p>
                        <a href="{{ route('artikel.create') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-8 py-4 rounded-2xl font-semibold inline-flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fas fa-plus mr-3"></i>
                            Tulis Artikel Baru
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Alasan Penolakan -->
<div id="rejectionModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-2xl max-w-md w-full border border-gray-600">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-times-circle text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Artikel Ditolak</h3>
                </div>
                
                <div class="mb-6">
                    <p class="text-sm text-gray-300 mb-2">
                        <span class="font-semibold text-white">Direview oleh:</span> <span id="reviewerName"></span>
                    </p>
                    <p class="text-sm text-gray-300 mb-4">
                        <span class="font-semibold text-white">Tanggal review:</span> <span id="reviewDate"></span>
                    </p>
                    
                    <div class="bg-red-900 bg-opacity-50 border border-red-500 rounded-xl p-4">
                        <p class="text-sm font-semibold text-red-300 mb-2">Alasan Penolakan:</p>
                        <p id="rejectionReason" class="text-sm text-red-200"></p>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button onclick="closeRejectionModal()" 
                            class="px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-xl font-semibold transition-all duration-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showRejectionReason(reason, reviewer, reviewDate) {
    document.getElementById('rejectionReason').textContent = reason;
    document.getElementById('reviewerName').textContent = reviewer;
    document.getElementById('reviewDate').textContent = reviewDate;
    document.getElementById('rejectionModal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectionModal();
    }
});
</script>

@endsection