@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Notifikasi</h1>
            @if(auth()->user()->unreadNotifications()->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 {{ $notification->is_read ? 'border-gray-300' : 'border-red-500' }}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="font-semibold text-lg {{ $notification->is_read ? 'text-gray-600' : 'text-gray-800' }}">
                                        {{ $notification->title }}
                                    </h3>
                                    @if(!$notification->is_read)
                                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">Baru</span>
                                    @endif
                                </div>
                                <p class="text-gray-700 mb-3">{{ $notification->message }}</p>
                                <div class="text-sm text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if(!$notification->is_read)
                                <form action="{{ route('notifications.read', $notification->id_notification) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm px-3 py-1 rounded hover:bg-blue-50 transition-colors">
                                        Tandai Dibaca
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('notifications.destroy', $notification->id_notification) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm px-3 py-1 rounded hover:bg-red-50 transition-colors" onclick="return confirm('Yakin ingin menghapus notifikasi ini?')">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Notifikasi</h3>
                <p class="text-gray-500">Anda belum memiliki notifikasi apapun.</p>
            </div>
        @endif
    </div>
</div>
@endsection