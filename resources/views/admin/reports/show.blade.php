@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">{{ $report->judul }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Laporan</h3>
                
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Jenis</label>
                        <p class="text-gray-900 capitalize">{{ $report->jenis }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Periode</label>
                        <p class="text-gray-900">
                            {{ $report->tanggal_mulai->format('d/m/Y') }} - {{ $report->tanggal_selesai->format('d/m/Y') }}
                        </p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Dibuat Oleh</label>
                        <p class="text-gray-900">{{ $report->user->nama }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Dibuat</label>
                        <p class="text-gray-900">{{ $report->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    @if($report->deskripsi)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                        <p class="text-gray-900">{{ $report->deskripsi }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data Panel -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Laporan</h3>
                
                @if($report->jenis == 'artikel')
                    @include('admin.reports.partials.artikel-data', ['data' => $report->data])
                @elseif($report->jenis == 'komentar')
                    @include('admin.reports.partials.komentar-data', ['data' => $report->data])
                @elseif($report->jenis == 'user')
                    @include('admin.reports.partials.user-data', ['data' => $report->data])
                @elseif($report->jenis == 'aktivitas')
                    @include('admin.reports.partials.aktivitas-data', ['data' => $report->data])
                @endif
            </div>
        </div>
    </div>
</div>
@endsection