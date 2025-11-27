@extends('layouts.app')

@section('title', 'Buat Laporan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Buat Laporan Baru</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                    <select name="jenis" id="jenis" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            required>
                        <option value="">Pilih Jenis Laporan</option>
                        <option value="artikel" {{ old('jenis') == 'artikel' ? 'selected' : '' }}>Laporan Artikel</option>
                        <option value="komentar" {{ old('jenis') == 'komentar' ? 'selected' : '' }}>Laporan Komentar</option>
                        <option value="user" {{ old('jenis') == 'user' ? 'selected' : '' }}>Laporan User</option>
                        <option value="aktivitas" {{ old('jenis') == 'aktivitas' ? 'selected' : '' }}>Laporan Aktivitas</option>
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">Informasi Jenis Laporan:</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li><strong>Artikel:</strong> Data artikel yang dibuat, status publikasi, kategori</li>
                        <li><strong>Komentar:</strong> Data komentar, status approval, artikel terkait</li>
                        <li><strong>User:</strong> Data user baru, role, aktivitas</li>
                        <li><strong>Aktivitas:</strong> Ringkasan semua aktivitas sistem</li>
                    </ul>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('reports.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Generate Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection