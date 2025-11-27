<!-- Summary Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-blue-600">{{ $data['total_artikel'] ?? 0 }}</div>
        <div class="text-sm text-blue-800">Total Artikel</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-green-600">{{ $data['artikel_published'] ?? 0 }}</div>
        <div class="text-sm text-green-800">Published</div>
    </div>
    <div class="bg-yellow-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-yellow-600">{{ $data['artikel_pending'] ?? 0 }}</div>
        <div class="text-sm text-yellow-800">Pending</div>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-gray-600">{{ $data['artikel_draft'] ?? 0 }}</div>
        <div class="text-sm text-gray-800">Draft</div>
    </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    @if(isset($data['artikel_by_kategori']) && count($data['artikel_by_kategori']) > 0)
    <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold text-gray-800 mb-3">Artikel per Kategori</h4>
        @foreach($data['artikel_by_kategori'] as $kategori => $count)
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm text-gray-600">{{ $kategori ?: 'Tidak ada kategori' }}</span>
            <span class="text-sm font-semibold">{{ $count }}</span>
        </div>
        @endforeach
    </div>
    @endif

    @if(isset($data['artikel_by_user']) && count($data['artikel_by_user']) > 0)
    <div class="bg-gray-50 p-4 rounded-lg">
        <h4 class="font-semibold text-gray-800 mb-3">Artikel per Penulis</h4>
        @foreach($data['artikel_by_user'] as $user => $count)
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm text-gray-600">{{ $user }}</span>
            <span class="text-sm font-semibold">{{ $count }}</span>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Detail Table -->
@if(isset($data['detail_artikel']) && count($data['detail_artikel']) > 0)
<div class="overflow-x-auto">
    <h4 class="font-semibold text-gray-800 mb-3">Detail Artikel</h4>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Views</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data['detail_artikel'] as $artikel)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-900">{{ Str::limit($artikel['judul'], 30) }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $artikel['penulis'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $artikel['kategori'] }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($artikel['status'] == 'published') bg-green-100 text-green-800
                        @elseif($artikel['status'] == 'pending') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($artikel['status']) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $artikel['views'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $artikel['tanggal'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif