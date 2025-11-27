@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Article Header -->
    <div class="bg-white rounded-2xl shadow-xl p-8 mb-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg">
                    {{ $artikel->kategori->nama_kategori }}
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $artikel->status == 'published' ? 'green' : 'orange' }}-100 text-{{ $artikel->status == 'published' ? 'green' : 'orange' }}-800">
                    <i class="fas fa-circle text-xs mr-1"></i>
                    {{ ucfirst($artikel->status) }}
                </span>
            </div>
            <span class="text-sm text-gray-500">
                <i class="far fa-calendar mr-1"></i>
                {{ $artikel->tanggal->format('d F Y') }}
            </span>
        </div>

        <h1 class="text-4xl font-bold text-gray-800 mb-4 leading-tight">{{ $artikel->judul }}</h1>
        
        <div class="flex items-center space-x-4 text-gray-600">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold">
                    {{ strtoupper(substr($artikel->user->nama, 0, 1)) }}
                </div>
                <div>
                    <p class="font-medium text-gray-800">{{ $artikel->user->nama }}</p>
                    <p class="text-sm text-gray-500 capitalize">{{ $artikel->user->role }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
             @if($artikel->foto)
             <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                 alt="{{ $artikel->judul }}" 
                 class="w-full h-96 object-cover"
                 onerror="this.src='{{ asset('storage/artikels/default-artikel.svg') }}'">
             @else
             <img src="{{ asset('storage/artikels/default-artikel.svg') }}" alt="Default image" class="w-full h-96 object-cover">
             @endif

                <div class="p-8">
                    <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                        {!! nl2br(e($artikel->isi)) !!}
                    </div>

                    <!-- Article Stats -->
                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center space-x-6 text-gray-500">
                            <span class="flex items-center space-x-2">
                                <i class="far fa-eye"></i>
                                <span>{{ $artikel->views ?? 0 }} dilihat</span>
                            </span>
                            @auth
                            <button id="likeButton" class="flex items-center space-x-2 text-gray-500 hover:text-red-500 transition-colors cursor-pointer">
                                @php
                                    $userLike = $artikel->likes()->where('id_user', auth()->user()->id_user)->first();
                                @endphp
                                <i class="{{ $userLike ? 'fas text-red-500' : 'far' }} fa-heart" id="likeIcon"></i>
                                <span id="likeCount">{{ $artikel->likes()->count() }}</span>
                            </button>
                            @else
                            <span class="flex items-center space-x-2">
                                <i class="far fa-heart"></i>
                                <span>{{ $artikel->likes()->count() }} likes</span>
                            </span>
                            @endauth
                            <span class="flex items-center space-x-2">
                                <i class="far fa-clock"></i>
                                <span>{{ $artikel->created_at->diffForHumans() }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 mt-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Komentar</h3>
                
                <!-- Add Comment Form -->
                @auth
                <form action="{{ route('comments.store', $artikel) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary-500 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <textarea name="comment" 
                                      rows="3" 
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all" 
                                      placeholder="Tulis komentar Anda..."
                                      required></textarea>
                            
                            <!-- Emoji Picker -->
                            <div class="mt-3">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-sm text-gray-600">Pilih emoji:</span>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('😊')">😊</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('😍')">😍</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('👍')">👍</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('❤️')">❤️</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('😂')">😂</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('🔥')">🔥</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('👏')">👏</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('🎉')">🎉</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('💯')">💯</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('🤔')">🤔</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('😢')">😢</span>
                                    <span class="emoji-btn text-2xl hover:bg-gray-100 p-2 rounded-lg transition-all cursor-pointer" onclick="addEmoji('😮')">😮</span>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-3">
                                <button type="submit" 
                                        class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-xl font-medium transition-all">
                                    <i class="fas fa-paper-plane mr-2"></i>Kirim Komentar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="bg-gray-50 rounded-xl p-6 text-center mb-8">
                    <p class="text-gray-600 mb-4">Silakan login untuk memberikan komentar</p>
                    <a href="{{ route('login') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-xl font-medium transition-all">
                        Login
                    </a>
                </div>
                @endauth
                
                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($artikel->comments()->with('user')->where('is_approved', true)->latest()->get() as $comment)
                    <div class="flex space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($comment->user->nama, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <div class="bg-gray-50 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-gray-800">{{ $comment->user->nama }}</h4>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        @if(auth()->check() && auth()->user()->id_user === $comment->id_user)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm" 
                                                    onclick="return confirm('Yakin ingin menghapus komentar ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $comment->isi_komentar }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-comments text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">Kelola Artikel</h3>
                <div class="space-y-3">
                    <a href="{{ route('artikel.edit', $artikel) }}" 
                       class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit Artikel</span>
                    </a>
                    <a href="{{ route('artikel.index') }}" 
                       class="w-full bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400 font-medium py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>

                </div>
            </div>

            <!-- Article Meta -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                <h3 class="font-bold text-gray-800 mb-4">Informasi</h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <span class="text-gray-600 block mb-1">Dibuat</span>
                        <span class="font-medium text-gray-800">{{ $artikel->created_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Diupdate</span>
                        <span class="font-medium text-gray-800">{{ $artikel->updated_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Penulis</span>
                        <span class="font-medium text-primary-600">{{ $artikel->user->nama }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 block mb-1">Role</span>
                        <span class="font-medium text-gray-800 capitalize">{{ $artikel->user->role }}</span>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">Artikel Lainnya</h3>
                <div class="space-y-4">
                    @if($relatedArticles->count() > 0)
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('artikel.show', $related) }}" class="block group">
                            <div class="flex items-center space-x-3 p-3 rounded-lg border border-gray-200 hover:border-primary-300 hover:bg-primary-50 transition-all duration-300">
                                @if($related->foto && file_exists(public_path('storage/artikels/' . $related->foto)))
                                <img src="{{ asset('storage/artikels/' . $related->foto) }}" 
                                     alt="{{ $related->judul }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                                @else
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-newspaper text-primary-600 text-sm"></i>
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 group-hover:text-primary-600 transition-colors truncate">
                                        {{ Str::limit($related->judul, 40) }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $related->user->nama }} • {{ $related->created_at->format('d M') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <div class="text-center py-6">
                            <i class="fas fa-newspaper text-2xl text-gray-300 mb-2"></i>
                            <p class="text-gray-500 text-sm">Belum ada artikel lain dalam kategori ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addEmoji(emoji) {
    const textarea = document.querySelector('textarea[name="comment"]');
    textarea.value += emoji;
    textarea.focus();
}

@auth
document.addEventListener('DOMContentLoaded', function() {
    const likeButton = document.getElementById('likeButton');
    const likeIcon = document.getElementById('likeIcon');
    const likeCount = document.getElementById('likeCount');
    
    if (likeButton) {
        likeButton.addEventListener('click', function() {
            fetch('{{ route('artikel.like', $artikel) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    likeIcon.classList.remove('far');
                    likeIcon.classList.add('fas');
                    likeButton.classList.add('text-red-500');
                } else {
                    likeIcon.classList.remove('fas');
                    likeIcon.classList.add('far');
                    likeButton.classList.remove('text-red-500');
                }
                likeCount.textContent = data.like_count;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
@endauth
</script>

@endsection