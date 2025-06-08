@extends('layouts.superadmin')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-8">

    {{-- Statistik summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Admin</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalAdmins ?? '-' }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Masjid</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalMasjids ?? '-' }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-2">Total Pengunjung</h2>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalVisitors ?? '-' }}</p>
        </div>
    </div>

    {{-- Grafik garis --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <h3 class="text-xl font-semibold mb-4">Total Admin per Bulan</h3>
            <canvas id="chartAdmins" class="w-full h-64 bg-white p-4 rounded-lg shadow"></canvas>
        </div>
        <div>
            <h3 class="text-xl font-semibold mb-4">Total Masjid per Bulan</h3>
            <canvas id="chartMasjids" class="w-full h-64 bg-white p-4 rounded-lg shadow"></canvas>
        </div>
        <div>
            <h3 class="text-xl font-semibold mb-4">Total Pengunjung per Bulan</h3>
            <canvas id="chartVisitors" class="w-full h-64 bg-white p-4 rounded-lg shadow"></canvas>
        </div>
    </div>

</div>

{{-- Tabel daftar user dan masjid --}}
<div class="bg-white p-4 rounded shadow mt-10 overflow-x-auto max-w-full">
    <h3 class="text-2xl font-semibold mb-4">Daftar User & Masjid</h3>

    <table class="min-w-full table-auto border-collapse border border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-3 py-1 text-left">No</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Username</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Email</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Role</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Nama Masjid</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Nama Takmir</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Tahun</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Status Tanah</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Topologi Masjid</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Kecamatan</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Kabupaten</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Alamat</th>
                <th class="border border-gray-300 px-3 py-1 text-left">No. Telepon</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Gambar</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Surat</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $offset = ($users->currentPage() - 1) * $users->perPage();
            @endphp

            @forelse($users as $user)
                <tr>
                    <td class="border border-gray-300 px-3 py-1">{{ $loop->iteration + $offset }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->username }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-3 py-1 capitalize">{{ $user->role }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->nama_masjid ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->nama_takmir ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->tahun ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->status_tanah ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->topologi_masjid ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->kecamatan ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->kabupaten ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->alamat ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->masjid->notlp ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">
                        @if($user->masjid && $user->masjid->gambar)
                            <img src="{{ asset('storage/' . $user->masjid->gambar) }}" alt="Gambar Masjid" class="h-12 w-auto rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-1">
                        @if($user->masjid && $user->masjid->surat)
                            <a href="{{ asset('storage/' . $user->masjid->surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Surat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-1">
                        <a href="{{ route('masjids.edit', $user->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('masjids.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center py-4">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    // Fungsi mapping data dari controller (array of {month, total}) ke array 12 bulan
    function mapDataPerMonth(data) {
        let arr = new Array(12).fill(0);
        data.forEach(item => {
            arr[item.month - 1] = item.total;
        });
        return arr;
    }

    // Ambil data dari blade (controller)
    const adminsData = @json($adminsPerMonth ?? []);
    const masjidsData = @json($masjidsPerMonth ?? []);
    const visitorsData = @json($visitorsPerMonth ?? []);

    const adminsPerMonth = mapDataPerMonth(adminsData);
    const masjidsPerMonth = mapDataPerMonth(masjidsData);
    const visitorsPerMonth = mapDataPerMonth(visitorsData);

    // Buat chart admins
    new Chart(document.getElementById('chartAdmins').getContext('2d'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Total Admin',
                data: adminsPerMonth,
                borderColor: 'rgba(99, 102, 241, 1)',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, precision: 0 }
            }
        }
    });

    // Buat chart masjids
    new Chart(document.getElementById('chartMasjids').getContext('2d'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Total Masjid',
                data: masjidsPerMonth,
                borderColor: 'rgba(16, 185, 129, 1)',
                backgroundColor: 'rgba(16, 185, 129, 0.2)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, precision: 0 }
            }
        }
    });

    // Buat chart visitors
    new Chart(document.getElementById('chartVisitors').getContext('2d'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Total Pengunjung',
                data: visitorsPerMonth,
                borderColor: 'rgba(244, 63, 94, 1)',
                backgroundColor: 'rgba(244, 63, 94, 0.2)',
                fill: true,
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, precision: 0 }
            }
        }
    });
</script>
@endsection
