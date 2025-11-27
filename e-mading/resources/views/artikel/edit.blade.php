@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="bg-white rounded-t-2xl shadow-lg p-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-500 p-3 rounded-full">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Artikel</h1>
                    <p class="text-gray-600">Perbarui konten artikel Anda</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-b-2xl shadow-lg p-8">
            <form action="{{ route('artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Judul -->
                <div class="space-y-2">
                    <label for="judul" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-heading mr-2 text-blue-500"></i>Judul Artikel
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('judul') border-red-500 @enderror" 
                           id="judul" name="judul" 
                           value="{{ old('judul', $artikel->judul) }}" 
                           placeholder="Masukkan judul artikel yang menarik..."
                           required>
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kategori -->
                <div class="space-y-2">
                    <label for="id_kategori" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-tags mr-2 text-green-500"></i>Kategori
                    </label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('id_kategori') border-red-500 @enderror" 
                            id="id_kategori" name="id_kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" 
                                    {{ old('id_kategori', $artikel->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Isi Artikel -->
                <div class="space-y-2">
                    <label for="isi" class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-align-left mr-2 text-purple-500"></i>Isi Artikel
                    </label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none @error('isi') border-red-500 @enderror" 
                              id="isi" name="isi" rows="12" 
                              placeholder="Tulis konten artikel Anda di sini..."
                              required>{{ old('isi', $artikel->isi) }}</textarea>
                    @error('isi')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Foto -->
                <div class="space-y-4">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-image mr-2 text-orange-500"></i>Foto Artikel
                    </label>
                    
                    <!-- Preview Foto -->
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            @if($artikel->foto)
                                <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                                     alt="Current photo" 
                                     class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200 shadow-sm"
                                     onerror="this.src='{{ asset('storage/artikels/default-artikel.svg') }}'">
                            @else
                                <img src="{{ asset('storage/artikels/default-artikel.svg') }}" 
                                     alt="Default image" 
                                     class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 mb-2">
                                {{ $artikel->foto ? 'Foto saat ini' : 'Belum ada foto' }}
                            </p>
                            <div class="relative">
                                <input type="file" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 @error('foto') border-red-500 @enderror" 
                                       id="foto" name="foto" accept="image/*">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                            </div>
                        </div>
                    </div>
                    @error('foto')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('artikel.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Update Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection