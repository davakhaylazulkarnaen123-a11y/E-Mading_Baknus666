@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Kategori</h1>
            <p class="text-gray-600">Kelompokkan artikel berdasarkan kategori yang relevan</p>
        </div>
        <a href="{{ route('kategori.create') }}" 
           class="mt-4 md:mt-0 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Kategori</p>
                    <p class="text-3xl font-bold mt-2">{{ $kategoris->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-tags text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Kategori Terpakai</p>
                    <p class="text-3xl font-bold mt-2">{{ $kategoris->where('artikels_count', '>', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Kategori Kosong</p>
                    <p class="text-3xl font-bold mt-2">{{ $kategoris->where('artikels_count', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-inbox text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Artikel</p>
                    <p class="text-3xl font-bold mt-2">{{ $kategoris->sum('artikels_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    @if($kategoris->count() > 0)
    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @foreach($kategoris as $kategori)
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tag text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $kategori->nama_kategori }}</h3>
                        <p class="text-sm text-gray-500">{{ $kategori->artikels_count }} artikel</p>
                    </div>
                </div>
                <div class="relative">
                    <button class="w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg flex items-center justify-center transition-colors"
                            onclick="toggleDropdown('dropdown-{{ $kategori->id_kategori }}')">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div id="dropdown-{{ $kategori->id_kategori }}" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 z-10 hidden">
                        <div class="py-1">
                            <a href="{{ route('kategori.edit', $kategori) }}" 
                               class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-lg mx-2 my-1 transition-colors">
                                <i class="fas fa-edit text-blue-500 w-4"></i>
                                <span>Edit Kategori</span>
                            </a>
                            <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="mx-2 my-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="flex items-center space-x-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?')">
                                    <i class="fas fa-trash text-red-500 w-4"></i>
                                    <span>Hapus Kategori</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>Penggunaan</span>
                    <span>{{ $kategori->artikels_count }} artikel</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    @php
                        $totalArticles = $kategoris->sum('artikels_count');
                        $percentage = $totalArticles > 0 ? ($kategori->artikels_count / $totalArticles) * 100 : 0;
                    @endphp
                    <div class="bg-gradient-to-r from-primary-500 to-primary-600 h-2 rounded-full transition-all duration-500" 
                         style="width: {{ $percentage }}%"></div>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="flex items-center justify-between">
                @if($kategori->artikels_count > 0)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-circle text-xs mr-1"></i>
                    Aktif
                </span>
                @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    <i class="fas fa-circle text-xs mr-1"></i>
                    Kosong
                </span>
                @endif
                <span class="text-xs text-gray-500">
                    {{ round($percentage, 1) }}% dari total
                </span>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
        <div class="w-24 h-24 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-tags text-primary-600 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada kategori</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">Mulai dengan membuat kategori pertama untuk mengorganisir artikel-artikel Anda.</p>
        <a href="{{ route('kategori.create') }}" 
           class="inline-flex items-center space-x-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus"></i>
            <span>Buat Kategori Pertama</span>
        </a>
    </div>
    @endif

    <!-- Usage Guide -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6 border border-blue-200 mt-8">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <h3 class="font-bold text-gray-800">Tips Penggunaan Kategori</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-start space-x-2">
                <i class="fas fa-check text-green-500 mt-0.5"></i>
                <span>Buat kategori yang jelas dan spesifik</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-check text-green-500 mt-0.5"></i>
                <span>Hindari duplikasi kategori</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-check text-green-500 mt-0.5"></i>
                <span>Kategori kosong bisa dihapus</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-check text-green-500 mt-0.5"></i>
                <span>Update kategori sesuai kebutuhan</span>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('hidden');
        
        // Close other dropdowns
        document.querySelectorAll('[id^="dropdown-"]').forEach(otherDropdown => {
            if (otherDropdown.id !== dropdownId) {
                otherDropdown.classList.add('hidden');
            }
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Animation for progress bars
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.bg-gradient-to-r');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
    });
</script>

<style>
    .dropdown-toggle {
        cursor: pointer;
    }
    
    [id^="dropdown-"] {
        animation: fadeIn 0.2s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection