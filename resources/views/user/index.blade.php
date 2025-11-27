@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola User</h1>
            <p class="text-gray-600">Kelola akun pengguna sistem E-Mading</p>
        </div>
        <a href="{{ route('user.create') }}" 
           class="mt-4 md:mt-0 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-6 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
            <i class="fas fa-user-plus"></i>
            <span>Tambah User</span>
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total User</p>
                    <p class="text-3xl font-bold mt-2">{{ $users->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Admin</p>
                    <p class="text-3xl font-bold mt-2">{{ $users->where('role', 'admin')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Guru</p>
                    <p class="text-3xl font-bold mt-2">{{ $users->where('role', 'guru')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Siswa</p>
                    <p class="text-3xl font-bold mt-2">{{ $users->where('role', 'siswa')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-400 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    @if($users->count() > 0)
    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 mb-8">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center text-white font-semibold text-lg">
                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $user->nama }}</p>
                                    <p class="text-sm text-gray-500">Bergabung {{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-at mr-1 text-gray-500"></i>
                                {{ $user->username }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role == 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-user-shield mr-1"></i>
                                Admin
                            </span>
                            @elseif($user->role == 'guru')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-chalkboard-teacher mr-1"></i>
                                Guru
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-user-graduate mr-1"></i>
                                Siswa
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($user->id_user === auth()->id())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                Anda
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                Aktif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('user.edit', $user) }}" 
                                   class="w-10 h-10 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-xl flex items-center justify-center transition-colors"
                                   title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id_user !== auth()->id())
                                <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 bg-red-100 hover:bg-red-200 text-red-600 rounded-xl flex items-center justify-center transition-colors"
                                            title="Hapus User"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @else
                                <button class="w-10 h-10 bg-gray-100 text-gray-400 rounded-xl flex items-center justify-center cursor-not-allowed"
                                        title="Tidak dapat menghapus akun sendiri">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-100">
        <div class="w-24 h-24 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-users text-primary-600 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum ada user</h3>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">Mulai dengan menambahkan user pertama untuk mengelola sistem E-Mading.</p>
        <a href="{{ route('user.create') }}" 
           class="inline-flex items-center space-x-2 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-user-plus"></i>
            <span>Tambah User Pertama</span>
        </a>
    </div>
    @endif

    <!-- User Guide -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl p-6 border border-blue-200">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-info-circle text-blue-600"></i>
            </div>
            <h3 class="font-bold text-gray-800">Panduan Pengelolaan User</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
            <div class="flex items-start space-x-2">
                <i class="fas fa-shield-alt text-blue-500 mt-0.5"></i>
                <span><strong>Admin</strong> - Akses penuh ke semua fitur</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-chalkboard-teacher text-blue-500 mt-0.5"></i>
                <span><strong>Guru</strong> - Dapat memverifikasi artikel siswa</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-user-graduate text-blue-500 mt-0.5"></i>
                <span><strong>Siswa</strong> - Dapat membuat dan mengelola artikel sendiri</span>
            </div>
            <div class="flex items-start space-x-2">
                <i class="fas fa-exclamation-triangle text-orange-500 mt-0.5"></i>
                <span>User tidak dapat menghapus akun sendiri</span>
            </div>
        </div>
    </div>
</div>
@endsection