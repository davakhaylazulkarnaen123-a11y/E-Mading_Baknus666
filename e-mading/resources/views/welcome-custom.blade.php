@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 right-20 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute bottom-32 left-16 w-24 h-24 bg-white/5 rounded-full animate-bounce"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/10 rounded-full"></div>
        <!-- Geometric shapes -->
        <div class="absolute top-32 left-1/3 w-2 h-20 bg-white/20 rotate-45"></div>
        <div class="absolute bottom-40 right-1/3 w-2 h-16 bg-white/15 -rotate-45"></div>
        <div class="absolute top-1/4 right-1/4 w-2 h-12 bg-white/10 rotate-12"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
        <div class="text-center text-white max-w-4xl mx-auto">
            <!-- Main Title -->
            <h1 class="text-6xl md:text-8xl font-bold mb-6 tracking-tight">
                WELCOME
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl mb-4 font-medium opacity-90">
                E-mading Baknus666
            </p>
            
            <!-- Description -->
            <p class="text-lg md:text-xl mb-12 opacity-80 max-w-2xl mx-auto">
                Do You Wanna Join Us?
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('login') }}" 
                   class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Get Started Now
                </a>
                <a href="#about" 
                   class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-8">Platform Mading Digital Modern</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">
            Bergabunglah dengan revolusi digital dalam dunia pendidikan. 
            Bagikan cerita, prestasi, dan inspirasi dalam satu platform yang mudah digunakan.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-edit text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Mudah Menulis</h3>
                <p class="text-gray-600">Interface yang intuitif untuk membuat artikel dengan mudah</p>
            </div>
            
            <div class="p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Kolaboratif</h3>
                <p class="text-gray-600">Siswa, guru, dan staff bekerja sama membangun konten</p>
            </div>
            
            <div class="p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Akses Mobile</h3>
                <p class="text-gray-600">Bisa diakses kapan saja dan di mana saja</p>
            </div>
        </div>
    </div>
</section>
@endsection