<!-- Summary Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-blue-50 p-4 rounded-lg">
        <div class="text-2xl font-bold text-blue-600">{{ $data['total_user_baru'] ?? 0 }}</div>
        <div class="text-sm text-blue-800">User Baru</div>
    </div>
    @if(isset($data['user_by_role']))
        @foreach($data['user_by_role'] as $role => $count)
        <div class="bg-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'green' : 'purple') }}-50 p-4 rounded-lg">
            <div class="text-2xl font-bold text-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'green' : 'purple') }}-600">{{ $count }}</div>
            <div class="text-sm text-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'green' : 'purple') }}-800">{{ ucfirst($role) }}</div>
        </div>
        @endforeach
    @endif
</div>

<!-- Detail Table -->
@if(isset($data['detail_user']) && count($data['detail_user']) > 0)
<div class="overflow-x-auto">
    <h4 class="font-semibold text-gray-800 mb-3">Detail User Baru</h4>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Artikel</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Komentar</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data['detail_user'] as $user)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-900">{{ $user['nama'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $user['username'] }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($user['role'] == 'admin') bg-red-100 text-red-800
                        @elseif($user['role'] == 'guru') bg-green-100 text-green-800
                        @else bg-purple-100 text-purple-800 @endif">
                        {{ ucfirst($user['role']) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $user['total_artikel'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $user['total_komentar'] }}</td>
                <td class="px-4 py-2 text-sm text-gray-600">{{ $user['tanggal_daftar'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif