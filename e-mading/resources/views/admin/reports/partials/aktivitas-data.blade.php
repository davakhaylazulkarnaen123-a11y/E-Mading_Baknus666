<!-- Summary Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-blue-600">{{ $data['artikel_baru'] ?? 0 }}</div>
        <div class="text-sm text-blue-800">Artikel Baru</div>
    </div>
    <div class="bg-green-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-green-600">{{ $data['komentar_baru'] ?? 0 }}</div>
        <div class="text-sm text-green-800">Komentar Baru</div>
    </div>
    <div class="bg-purple-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-purple-600">{{ $data['user_baru'] ?? 0 }}</div>
        <div class="text-sm text-purple-800">User Baru</div>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-gray-600">{{ $data['total_aktivitas'] ?? 0 }}</div>
        <div class="text-sm text-gray-800">Total Aktivitas</div>
    </div>
</div>

<!-- Aktivitas Harian -->
@if(isset($data['aktivitas_harian']) && count($data['aktivitas_harian']) > 0)
<div class="overflow-x-auto">
    <h4 class="font-semibold text-gray-800 mb-3">Aktivitas Harian</h4>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Artikel</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">User Baru</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data['aktivitas_harian'] as $tanggal => $aktivitas)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-900">{{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}</td>
                <td class="px-4 py-2 text-sm text-blue-600">{{ $aktivitas['artikel'] }}</td>
                <td class="px-4 py-2 text-sm text-green-600">{{ $aktivitas['komentar'] }}</td>
                <td class="px-4 py-2 text-sm text-purple-600">{{ $aktivitas['user'] }}</td>
                <td class="px-4 py-2 text-sm font-semibold text-gray-900">
                    {{ $aktivitas['artikel'] + $aktivitas['komentar'] + $aktivitas['user'] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif