@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Buat Artikel Baru</h1>
        
        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" 
                       name="judul" 
                       id="judul"
                       value="{{ old('judul') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Masukkan judul artikel..."
                       required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="id_kategori" 
                        id="id_kategori"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Gambar Artikel (Opsional)</label>
                <input type="file" 
                       name="foto" 
                       id="foto"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       accept="image/*">
                <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF (Max: 5MB)</p>
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi Artikel</label>
                <textarea name="isi" 
                          id="isi" 
                          rows="10"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Tulis isi artikel di sini..."
                          required>{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors">
                    Simpan Artikel
                </button>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition-colors">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection