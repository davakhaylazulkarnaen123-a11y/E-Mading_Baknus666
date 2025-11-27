@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Laporan</h1>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('reports.update', $report) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Laporan</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $report->judul) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi', $report->deskripsi) }}</textarea>
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
                        <option value="artikel" {{ old('jenis', $report->jenis) == 'artikel' ? 'selected' : '' }}>Laporan Artikel</option>
                        <option value="komentar" {{ old('jenis', $report->jenis) == 'komentar' ? 'selected' : '' }}>Laporan Komentar</option>
                        <option value="user" {{ old('jenis', $report->jenis) == 'user' ? 'selected' : '' }}>Laporan User</option>
                        <option value="aktivitas" {{ old('jenis', $report->jenis) == 'aktivitas' ? 'selected' : '' }}>Laporan Aktivitas</option>
                    </select>
                    @error('jenis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $report->tanggal_mulai->format('Y-m-d')) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $report->tanggal_selesai->format('Y-m-d')) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                    <h4 class="text-sm font-medium text-yellow-800 mb-2">⚠️ Perhatian:</h4>
                    <p class="text-sm text-yellow-700">
                        Jika Anda mengubah jenis laporan atau periode tanggal, data laporan akan di-generate ulang sesuai dengan parameter baru.
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('reports.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                        <i class="fas fa-save mr-2"></i>
                        Update Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection