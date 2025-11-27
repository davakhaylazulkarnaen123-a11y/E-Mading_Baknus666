<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Mading Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @if(!request()->is('/') && !request()->is('artikel/*'))
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route(auth()->check() ? 'dashboard' : 'home') }}" class="text-xl font-bold">E-Mading</a>
                    @auth
                    <div class="flex space-x-4">
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-200">Dashboard</a>
                        <a href="{{ route('artikel.index') }}" class="hover:text-blue-200">Artikel Saya</a>
                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('kategori.index') }}" class="hover:text-blue-200">Kategori</a>
                        <a href="{{ route('user.index') }}" class="hover:text-blue-200">User</a>
                        @endif
                    </div>
                    @endauth
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <span>{{ auth()->user()->nama }} ({{ auth()->user()->role }})</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:text-blue-200">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="hover:text-blue-200">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @endif

    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>