@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-white">E-Mading</h1>
    
    @if($artikels->count() > 0)
        <div class="row">
            @foreach($artikels as $artikel)
                <div class="col-md-6 mb-4">
                    <div class="card bg-gray-800 border-gray-700">
                        @if($artikel->foto)
                            <img src="{{ asset('storage/artikels/' . $artikel->foto) }}" 
                                 class="card-img-top" 
                                 alt="{{ $artikel->judul }}"
                                 style="height: 200px; object-fit: cover;"
                                 onerror="this.src='{{ asset('storage/artikels/default-artikel.svg') }}'">
                        @else
                            <img src="{{ asset('storage/artikels/default-artikel.svg') }}" 
                                 class="card-img-top" 
                                 alt="Default image"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-white">{{ $artikel->judul }}</h5>
                            <p class="card-text text-gray-300">{{ Str::limit(strip_tags($artikel->isi), 150) }}</p>
                            <small class="text-gray-400">
                                {{ $artikel->tanggal }} | {{ $artikel->kategori->nama_kategori }} | {{ $artikel->user->nama }}
                            </small>
                            <br>
                            <a href="{{ route('artikel.show', $artikel) }}" class="btn btn-primary mt-2">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{ $artikels->links() }}
    @else
        <p class="text-white">Belum ada artikel yang dipublikasikan.</p>
    @endif
</div>
@endsection