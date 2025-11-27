@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Kategori</h1>
                <p class="text-gray-600">Perbarui kategori "{{ $kategori->nama_kategori }}"</p>
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
                <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Kategori -->
                    <div class="mb-8">
                        <label for="nama_kategori" class="block text-lg font-semibold text-gray-800 mb-3">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_kategori" 
                               id="nama_kategori"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
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
                            <i class="fas fa-save text-lg"></i>
                            <span class="text-lg">Perbarui Kategori</span>
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
            <!-- Category Info -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="font-bold text-lg">Info Kategori</h3>
                </div>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-blue-100">Jumlah Artikel</span>
                        <span class="font-semibold">{{ $kategori->artikels_count }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-blue-100">Dibuat</span>
                        <span class="font-semibold">{{ $kategori->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-100">Diupdate</span>
                        <span class="font-semibold">{{ $kategori->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    @if($kategori->artikels_count == 0)
                    <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-medium py-3 px-4 rounded-xl transition-all duration-300 border border-red-200 flex items-center justify-center space-x-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?')">
                            <i class="fas fa-trash"></i>
                            <span>Hapus Kategori</span>
                        </button>
                    </form>
                    @else
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-3 text-sm text-orange-700">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Kategori tidak bisa dihapus karena masih memiliki artikel
                    </div>
                    @endif
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