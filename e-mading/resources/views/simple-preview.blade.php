@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-white mb-6">Preview Artikel Published</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($artikels as $artikel)
        <div class="bg-gray-800 rounded-lg p-4">
            <h3 class="text-white font-bold mb-2">{{ $artikel->judul }}</h3>
            <p class="text-gray-300 text-sm mb-2">oleh {{ $artikel->user->nama }}</p>
            <p class="text-gray-400 text-sm mb-4">{{ Str::limit($artikel->isi, 100) }}</p>
            
            <div class="flex space-x-2">
                <a href="/artikel/{{ $artikel->id_artikel }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                    Lihat
                </a>
                <form action="/artikel/{{ $artikel->id_artikel }}/like" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                        ❤️ {{ $artikel->likes->count() }}
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-white">
            <p>Belum ada artikel published</p>
        </div>
        @endforelse
    </div>
</div>
@endsection