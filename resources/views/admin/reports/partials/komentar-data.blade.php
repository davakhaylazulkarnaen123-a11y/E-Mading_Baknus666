<!-- Summary Cards -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-blue-600">{{ $data['total_komentar'] ?? 0 }}</div>
        <div class="text-sm text-blue-800">Total Komentar</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-green-600">{{ $data['komentar_approved'] ?? 0 }}</div>
        <div class="text-sm text-green-800">Approved</div>
    </div>
    <div class="bg-yellow-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-yellow-600">{{ $data['komentar_pending'] ?? 0 }}</div>
        <div class="text-sm text-yellow-800">Pending</div>
    </div>
</div>

<!-- Komentar per User -->
@if(isset($data['komentar_by_user']) && count($data['komentar_by_user']) > 0)
<div class="bg-gray-50 p-4 rounded-lg mb-6">
    <h4 class="font-semibold text-gray-800 mb-3">Komentar per User</h4>
    @foreach($data['komentar_by_user'] as $user => $count)
    <div class="flex justify-between items-center mb-2">
        <span class="text-sm text-gray-600">{{ $user }}</span>
        <span class="text-sm font-semibold">{{ $count }}</span>
    </div>
    @endforeach
</div>
@endif

<!-- Detail Table -->
@if(isset($data['detail_komentar']) && count($data['detail_komentar']) > 0)
<div class="overflow-x-auto">
    <h4 class="font-semibold text-gray-800 mb-3">Detail Komentar</h4>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Isi Komentar</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Penulis</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Artikel</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data['detail_komentar'] as $komentar)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $komentar['isi'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $komentar['penulis'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ Str::limit($komentar['artikel'], 30) }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($komentar['status'] == 'Approved') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ $komentar['status'] }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $komentar['tanggal'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif