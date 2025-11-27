@extends('layouts.app')

@section('title', 'Preview Artikel')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Preview Artikel Published</h1>
                <p class="text-gray-600 mt-2">Lihat dan berikan apresiasi kepada artikel siswa</p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($artikels as $artikel)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Article Image -->
            <div class="h-48 bg-gray-200 relative">
                @if($artikel->foto && file_exists(public_path('storage/artikels/' . $artikel->foto)))
                    <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                         alt="{{ $artikel->judul }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                @endif
                <div class="absolute top-2 right-2">
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">Published</span>
                </div>
            </div>

            <!-- Article Content -->
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                        {{ $artikel->kategori->nama_kategori }}
                    </span>
                    <span class="text-gray-500 text-xs">{{ $artikel->created_at->format('d M Y') }}</span>
                </div>
                
                <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">{{ $artikel->judul }}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                
                <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                    <span>oleh {{ $artikel->user->nama }}</span>
                    <span><i class="fas fa-eye mr-1"></i>{{ $artikel->views ?? 0 }}</span>
                </div>

                <!-- Like and Comment Stats -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-heart mr-1 text-red-500"></i>
                            <span class="like-count">{{ $artikel->likes->count() }}</span>
                        </span>
                        <span class="flex items-center text-gray-600">
                            <i class="fas fa-comment mr-1 text-blue-500"></i>
                            {{ $artikel->comments->where('is_approved', true)->count() }}
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <a href="{{ route('artikel.show', $artikel->id_artikel) }}" 
                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-3 rounded-lg text-sm transition-colors">
                        <i class="fas fa-eye mr-1"></i>Lihat
                    </a>
                    
                    <!-- Like Button -->
                    <button class="like-btn bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-lg text-sm transition-colors {{ $artikel->likes->where('id_user', auth()->id())->count() > 0 ? 'bg-red-600' : '' }}" 
                            data-artikel-id="{{ $artikel->id_artikel }}">
                        <i class="fas fa-heart heart-icon"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-newspaper text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-800 mb-2">Belum ada artikel published</h3>
            <p class="text-gray-600">Artikel yang sudah di-publish akan muncul di sini</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($artikels->hasPages())
    <div class="mt-8">
        {{ $artikels->links() }}
    </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-btn');
    
    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const artikelId = this.dataset.artikelId;
            const heartIcon = this.querySelector('.heart-icon');
            const likeCountSpan = this.closest('.bg-white').querySelector('.like-count');
            
            fetch(`/artikel/${artikelId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    this.classList.add('bg-red-600');
                    this.classList.remove('bg-red-500');
                } else {
                    this.classList.add('bg-red-500');
                    this.classList.remove('bg-red-600');
                }
                likeCountSpan.textContent = data.like_count;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>
@endsection