@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="bg-gradient-to-br from-gray-900 via-slate-900 to-gray-800 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-slate-800 to-gray-800 rounded-2xl p-8 border border-gray-700 shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-red-400 to-pink-400 bg-clip-text text-transparent mb-2">Dashboard Admin</h1>
                        <p class="text-gray-300 text-lg">Kelola seluruh sistem E-Mading</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('artikel.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-plus"></i>
                            <span>Buat Artikel</span>
                        </a>
                        <a href="{{ route('kategori.create') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center space-x-2 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-tag"></i>
                            <span>Tambah Kategori</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
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

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
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

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
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

            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl p-6 border border-gray-600 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-300 text-sm font-medium uppercase tracking-wide">Total Users</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $totalUsers }}</p>
                    </div>
                    <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('pending.articles') }}" class="bg-gradient-to-br from-blue-600 to-blue-700 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Review Artikel</h3>
                        <p class="text-blue-100">{{ $artikelPending }} artikel menunggu</p>
                    </div>
                    <i class="fas fa-eye text-3xl text-blue-200"></i>
                </div>
            </a>

            <a href="{{ route('pending.comments') }}" class="bg-gradient-to-br from-green-600 to-emerald-700 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Approve Komentar</h3>
                        <p class="text-green-100">{{ $komentarPending }} komentar menunggu</p>
                    </div>
                    <i class="fas fa-comments text-3xl text-green-200"></i>
                </div>
            </a>

            <a href="/preview-simple" class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-indigo-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Preview Artikel</h3>
                        <p class="text-indigo-100">{{ $publishedArticles ?? $artikelPublished }} artikel published</p>
                    </div>
                    <i class="fas fa-newspaper text-3xl text-indigo-200"></i>
                </div>
            </a>

            <a href="{{ route('reports.index') }}" class="bg-gradient-to-br from-purple-600 to-pink-700 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Generate Laporan</h3>
                        <p class="text-purple-100">Buat laporan sistem</p>
                    </div>
                    <i class="fas fa-chart-bar text-3xl text-purple-200"></i>
                </div>
            </a>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Artikel Pending Review -->
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-2xl border border-gray-600">
                <div class="p-6 border-b border-gray-600">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-clock text-yellow-400 mr-3"></i>
                        Artikel Menunggu Review
                    </h3>
                </div>
                <div class="p-6">
                    @if($artikelPendingReview->count() > 0)
                        <div class="space-y-4">
                            @foreach($artikelPendingReview as $artikel)
                            <div class="bg-gradient-to-r from-gray-700 to-slate-700 rounded-xl p-4 border border-gray-600 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-white text-lg">{{ Str::limit($artikel->judul, 40) }}</h4>
                                        <p class="text-gray-300 mt-1">
                                            oleh {{ $artikel->user->nama }} • {{ $artikel->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('artikel.approve', $artikel->id_artikel) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('artikel.show', $artikel->id_artikel) }}" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 text-white rounded-xl flex items-center justify-center transition-colors" title="Lihat Artikel">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('artikel.edit', $artikel->id_artikel) }}" class="w-10 h-10 bg-purple-500 hover:bg-purple-600 text-white rounded-xl flex items-center justify-center transition-colors" title="Edit Artikel">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('pending.articles') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                                Lihat semua →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-300 text-lg">Tidak ada artikel yang menunggu review</p>
                        </div>
                    @endif
                </div>
        </div>

            <!-- Komentar Pending Approval -->
            <div class="bg-gradient-to-br from-slate-800 to-gray-800 rounded-2xl shadow-2xl border border-gray-600">
                <div class="p-6 border-b border-gray-600">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-comments text-green-400 mr-3"></i>
                        Komentar Menunggu Approval
                    </h3>
                </div>
                <div class="p-6">
                    @if($komentarPendingApproval->count() > 0)
                        <div class="space-y-4">
                            @foreach($komentarPendingApproval as $komentar)
                            <div class="bg-gradient-to-r from-gray-700 to-slate-700 rounded-xl p-4 border border-gray-600 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="text-white font-medium">{{ Str::limit($komentar->isi_komentar, 60) }}</p>
                                        <p class="text-gray-300 text-sm mt-2">
                                            oleh {{ $komentar->user->nama }} pada {{ Str::limit($komentar->artikel->judul, 30) }}
                                        </p>
                                    </div>
                                    <div class="flex space-x-2 ml-4">
                                        <form action="{{ route('comments.approve', $komentar) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-xl flex items-center justify-center transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('comments.destroy', $komentar) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-xl flex items-center justify-center transition-colors">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('pending.comments') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                                Lihat semua →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-300 text-lg">Tidak ada komentar yang menunggu approval</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection