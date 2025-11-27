@extends('layouts.app')

@section('title', 'Komentar Menunggu Persetujuan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Komentar Menunggu Persetujuan</h1>
            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $comments->total() }} komentar pending
            </span>
        </div>

        @if($comments->count() > 0)
            <div class="space-y-4">
                @foreach($comments as $comment)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Penulis:</span> {{ $comment->user->nama }} ({{ ucfirst($comment->user->role) }})
                                </div>
                                <div class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Artikel:</span> 
                                    <a href="{{ route('artikel.show', $comment->artikel) }}" class="text-blue-600 hover:underline">
                                        {{ $comment->artikel->judul }}
                                    </a>
                                </div>
                                <div class="text-sm text-gray-600 mb-3">
                                    <span class="font-medium">Tanggal:</span> {{ $comment->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div class="bg-gray-50 p-3 rounded border-l-4 border-gray-300">
                                    <p class="text-gray-700">{{ $comment->isi_komentar }}</p>
                                </div>
                            </div>
                            
                            <div class="ml-4 flex flex-col space-y-2">
                                <form action="{{ route('comments.approve', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm"
                                            onclick="return confirm('Setujui komentar ini?')">
                                        Setujui
                                    </button>
                                </form>
                                
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm"
                                            onclick="return confirm('Hapus komentar ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $comments->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <div class="text-gray-500 text-lg mb-2">Tidak ada komentar yang menunggu persetujuan</div>
                <div class="text-gray-400">Semua komentar sudah diproses</div>
            </div>
        @endif
    </div>
</div>
@endsection