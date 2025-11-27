@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Tambah Kategori Baru</h1>
                <p class="text-gray-600">Buat kategori baru untuk mengorganisir artikel</p>
            </div>
            <a href="{{ route('kategori.index') }}" 
               class="bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400 font-semibold py-3 px-6 rounded-2xl transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    
                    <!-- Nama Kategori -->
                    <div class="mb-8">
                        <label for="nama_kategori" class="block text-lg font-semibold text-gray-800 mb-3">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_kategori" 
                               id="nama_kategori"
                               value="{{ old('nama_kategori') }}"
                               class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-300"
                               placeholder="Contoh: Prestasi, Kegiatan, Informasi..."
                               required
                               maxlength="255">
                        <div class="text-right text-sm text-gray-500 mt-2">
                            <span id="char-count">0</span>/255 karakter
                        </div>
                        @error('nama_kategori')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3">
                            <i class="fas fa-plus text-lg"></i>
                            <span class="text-lg">Tambah Kategori</span>
                        </button>
                        <a href="{{ route('kategori.index') }}" 
                           class="flex-1 bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400 hover:bg-gray-50 font-semibold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3">
                            <i class="fas fa-arrow-left text-lg"></i>
                            <span class="text-lg">Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Tips Card -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-2xl p-6 border border-green-200">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                    <h3 class="font-bold text-gray-800">Tips Kategori</h3>
                </div>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Gunakan nama yang jelas dan singkat</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Hindari duplikasi nama kategori</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Buat kategori yang relevan dengan konten</span>
                    </li>
                </ul>
            </div>

            <!-- Example Categories -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-bold text-gray-800 mb-4">Contoh Kategori</h3>
                <div class="space-y-2">
                    @php
                        $exampleCategories = ['Prestasi', 'Kegiatan', 'Informasi', 'Opini', 'Lomba', 'Karya Tulis'];
                    @endphp
                    @foreach($exampleCategories as $example)
                    <div class="flex items-center space-x-2 text-sm text-gray-600">
                        <i class="fas fa-tag text-primary-500 text-xs"></i>
                        <span>{{ $example }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Character count
    const input = document.getElementById('nama_kategori');
    const charCount = document.getElementById('char-count');

    input.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Initialize count
    charCount.textContent = input.value.length;
</script>
@endsection