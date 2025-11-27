@extends('layouts.app')

@section('title', 'Artikel Menunggu Review')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Artikel Menunggu Review</h1>
            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $artikels->total() }} artikel pending
            </span>
        </div>

        @if($artikels->count() > 0)
            <div class="space-y-4">
                @foreach($artikels as $artikel)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    {{ $artikel->judul }}
                                </h3>
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Penulis:</span> {{ $artikel->user->nama }} ({{ ucfirst($artikel->user->role) }})
                                </div>
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Kategori:</span> {{ $artikel->kategori->nama_kategori }}
                                </div>
                                <div class="text-sm text-gray-600 mb-3">
                                    <span class="font-medium">Tanggal:</span> {{ $artikel->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div class="text-gray-700 mb-3">
                                    {{ Str::limit(strip_tags($artikel->isi), 200) }}
                                </div>
                            </div>
                            
                            <div class="ml-4 flex flex-col space-y-2">
                                <a href="{{ route('artikel.show', $artikel) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm text-center">
                                    Lihat Detail
                                </a>
                                
                                <form action="{{ route('artikel.approve', $artikel) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm"
                                            onclick="return confirm('Setujui artikel ini untuk dipublikasikan?')">
                                        Setujui
                                    </button>
                                </form>
                                
                                <button type="button" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                        onclick="openRejectModal({{ $artikel->id_artikel }}, '{{ $artikel->judul }}')">
                                    Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $artikels->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500 text-lg mb-2">Tidak ada artikel yang menunggu review</div>
                <div class="text-gray-400">Semua artikel sudah diproses</div>
            </div>
        @endif
    </div>
</div>

<!-- Modal Tolak Artikel -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Artikel</h3>
                <p class="text-sm text-gray-600 mb-4">Artikel: <span id="articleTitle" class="font-medium"></span></p>
                
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Alasan Penolakan *
                        </label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                  placeholder="Jelaskan alasan mengapa artikel ini ditolak..." required></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()" 
                                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                            Tolak Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openRejectModal(articleId, articleTitle) {
    document.getElementById('articleTitle').textContent = articleTitle;
    document.getElementById('rejectForm').action = `/artikel/${articleId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
    document.getElementById('rejection_reason').value = '';
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>

@endsection