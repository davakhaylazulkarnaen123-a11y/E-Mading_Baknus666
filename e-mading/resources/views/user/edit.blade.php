@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit User</h1>
                <p class="text-gray-600">Perbarui informasi user {{ $user->nama }}</p>
            </div>
            <a href="{{ route('user.index') }}" 
               class="bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400 font-semibold py-3 px-6 rounded-2xl transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <form action="{{ route('user.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama -->
                    <div class="mb-6">
                        <label for="nama" class="block text-lg font-semibold text-gray-800 mb-3">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama" 
                               id="nama"
                               value="{{ old('nama', $user->nama) }}"
                               class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-300"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('nama')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-6">
                        <label for="username" class="block text-lg font-semibold text-gray-800 mb-3">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="username" 
                               id="username"
                               value="{{ old('username', $user->username) }}"
                               class="w-full px-4 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-300"
                               placeholder="Masukkan username unik"
                               required>
                        @error('username')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="password" class="block text-lg font-semibold text-gray-800 mb-3">
                                Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password"
                                       class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-300"
                                       placeholder="Kosongkan jika tidak diubah">
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center"
                                        onclick="togglePassword('password')">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-sm mt-3 flex items-center space-x-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-lg font-semibold text-gray-800 mb-3">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation"
                                       class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-300"
                                       placeholder="Konfirmasi password">
                                <button type="button" 
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center"
                                        onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-8">
                        <label for="role" class="block text-lg font-semibold text-gray-800 mb-3">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="relative">
                                <input type="radio" name="role" value="admin" class="hidden peer" {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-2xl cursor-pointer transition-all duration-300 peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-primary-500 peer-checked:bg-primary-500"></div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Admin</p>
                                            <p class="text-sm text-gray-500">Akses penuh</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative">
                                <input type="radio" name="role" value="guru" class="hidden peer" {{ old('role', $user->role) == 'guru' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-2xl cursor-pointer transition-all duration-300 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-blue-500 peer-checked:bg-blue-500"></div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Guru</p>
                                            <p class="text-sm text-gray-500">Verifikasi artikel</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="relative">
                                <input type="radio" name="role" value="siswa" class="hidden peer" {{ old('role', $user->role) == 'siswa' ? 'checked' : '' }}>
                                <div class="p-4 border-2 border-gray-200 rounded-2xl cursor-pointer transition-all duration-300 peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-gray-300">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-4 h-4 border-2 border-gray-300 rounded-full peer-checked:border-green-500 peer-checked:bg-green-500"></div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Siswa</p>
                                            <p class="text-sm text-gray-500">Buat artikel</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-1">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3">
                            <i class="fas fa-save text-lg"></i>
                            <span class="text-lg">Perbarui User</span>
                        </button>
                        <a href="{{ route('user.index') }}" 
                           class="flex-1 bg-white border-2 border-gray-300 text-gray-700 hover:border-gray-400 hover:bg-gray-50 font-semibold py-4 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3">
                            <i class="fas fa-arrow-left text-lg"></i>
                            <span class="text-lg">Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- User Info -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="font-bold text-lg">Info User</h3>
                </div>
                <div class="space-y-4">
                    <div class="pb-3 border-b border-white/20">
                        <div class="text-blue-100 text-sm mb-1">Bergabung</div>
                        <div class="font-semibold">{{ $user->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="pb-3 border-b border-white/20">
                        <div class="text-blue-100 text-sm mb-1">Diupdate</div>
                        <div class="font-semibold">{{ $user->updated_at->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="text-blue-100 text-sm mb-1">Status</div>
                        <div class="font-semibold capitalize">{{ $user->role }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    @if($user->id_user !== auth()->id())
                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-medium py-3 px-4 rounded-xl transition-all duration-300 border border-red-200 flex items-center justify-center space-x-2"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->nama }}?')">
                            <i class="fas fa-trash"></i>
                            <span>Hapus User</span>
                        </button>
                    </form>
                    @else
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-3 text-sm text-orange-700">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Tidak dapat menghapus akun sendiri
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const icon = passwordInput.nextElementSibling.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection