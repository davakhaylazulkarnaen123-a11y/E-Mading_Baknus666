@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
       @if($artikel->foto)
           <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                alt="{{ $artikel->judul }}" 
                class="w-full h-64 object-cover"
                onerror="this.src='{{ asset('storage/artikels/default-artikel.svg') }}'">
       @else
           <img src="{{ asset('storage/artikels/default-artikel.svg') }}" 
                alt="Default image" 
                class="w-full h-64 object-cover">
       @endif
        
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded">
                    {{ $artikel->kategori->nama_kategori }}
                </span>
                <span class="text-gray-500 text-sm">
                    <i class="far fa-calendar"></i>
                    {{ $artikel->tanggal->format('d F Y') }}
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $artikel->judul }}</h1>
            
            <div class="flex items-center text-gray-600 mb-6">
                <i class="fas fa-user mr-2"></i>
                <span>Oleh: {{ $artikel->user->nama }}</span>
            </div>
            
            <div class="prose max-w-none text-gray-700 mb-6">
                {!! nl2br(e($artikel->isi)) !!}
            </div>
            
            <div class="border-t border-gray-200 pt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500">
                            <i class="far fa-heart"></i>
                            {{ $artikel->like_count }} Likes
                        </span>
                    </div>
                    
                    <a href="{{ route('home') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection