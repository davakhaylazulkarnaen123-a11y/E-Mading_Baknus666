@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-800 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-slate-800 to-gray-800 rounded-2xl p-8 border border-gray-700 shadow-2xl">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-2">Dashboard</h1>
                <p class="text-gray-300 text-lg">Selamat datang kembali, {{ auth()->user()->nama }}</p>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            @if(auth()->user()->role !== 'guru')
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Siap membuat artikel baru?</h3>
                        <p class="text-gray-300">Bagikan cerita dan informasi menarik dengan komunitas sekolah</p>
                    </div>
                    <a href="/buat-artikel-simple" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <i class="fas fa-plus"></i>
                        <span>Buat Artikel</span>
                    </a>
                </div>
            </div>
            @endif
            
            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-2">Preview Artikel Published</h3>
                        <p class="text-gray-300">{{ $publishedArticles ?? 0 }} artikel published tersedia</p>
                    </div>
                    <a href="/preview-simple" class="bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <i class="fas fa-newspaper"></i>
                        <span>Preview Artikel</span>
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Stats Cards -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-chart-bar text-blue-400 mr-3"></i>
                Statistik
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Draft</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $artikelDraft ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-r from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-edit text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Published</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $artikelPublished ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Views</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalViews ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-eye text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Artikel</p>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalArtikel ?? 0 }}</p>
                        </div>
                        <div class="w-14 h-14 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Articles -->
        <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl border border-gray-600 overflow-hidden shadow-2xl mb-16">
            <div class="p-8 border-b border-gray-600">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-newspaper text-blue-400 mr-3"></i>
                        Artikel Terbaru
                    </h2>
                    <a href="{{ route('artikel.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        Lihat Semua →
                    </a>
                </div>
            </div>
            <div class="p-8">
                @if($artikelTerbaru->count() > 0)
                    <div class="space-y-6">
                        @foreach($artikelTerbaru as $artikel)
                        <div class="bg-gradient-to-r from-gray-700 to-slate-700 rounded-2xl p-6 border border-gray-600 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-white text-lg">{{ Str::limit($artikel->judul, 50) }}</h3>
                                        <p class="text-gray-300 mt-1">{{ $artikel->kategori->nama_kategori }} • {{ $artikel->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-4 py-2 rounded-xl text-sm font-semibold {{ $artikel->status === 'published' ? 'bg-green-500 text-white' : ($artikel->status === 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-500 text-white') }}">
                                        {{ ucfirst($artikel->status) }}
                                    </span>
                                    <span class="text-gray-300 bg-gray-600 px-3 py-2 rounded-xl text-sm font-medium">
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ $artikel->views ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gradient-to-r from-gray-600 to-slate-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-newspaper text-gray-300 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3">Belum ada artikel</h3>
                        <p class="text-gray-300 mb-8 text-lg">Mulai buat artikel pertama Anda</p>
                        @if(auth()->user()->role !== 'guru')
                        <a href="/buat-artikel-simple" class="inline-flex items-center space-x-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus text-xl"></i>
                            <span>Buat Artikel</span>
                        </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection