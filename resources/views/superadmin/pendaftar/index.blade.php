@extends('layouts.superadmin')

@section('title', 'Kelola Pendaftar')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8">
    <h2 class="text-3xl font-semibold mb-4">Pendaftar Belum Disetujui</h2>

    <table class="min-w-full table-auto border-collapse border border-gray-200 text-sm bg-white rounded shadow overflow-x-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-3 py-2">No</th>
                <th class="border border-gray-300 px-3 py-2">Username</th>
                <th class="border border-gray-300 px-3 py-2">Email</th>
                <th class="border border-gray-300 px-3 py-2">Role</th>
                <th class="border border-gray-300 px-3 py-2">Nama Masjid</th>
                <th class="border border-gray-300 px-3 py-2">Nama Takmir</th>
                <th class="border border-gray-300 px-3 py-2">Tahun</th>
                <th class="border border-gray-300 px-3 py-2">Status Tanah</th>
                <th class="border border-gray-300 px-3 py-2">Topologi</th>
                <th class="border border-gray-300 px-3 py-2">Kecamatan</th>
                <th class="border border-gray-300 px-3 py-2">Kabupaten</th>
                <th class="border border-gray-300 px-3 py-2">Alamat</th>
                <th class="border border-gray-300 px-3 py-2">No. Telepon</th>
                <th class="border border-gray-300 px-3 py-2">Gambar</th>
                <th class="border border-gray-300 px-3 py-2">Surat</th>
                <th class="border border-gray-300 px-3 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($pendaftar as $user)
                <tr>
                    <td class="border border-gray-300 px-3 py-1">{{ $no++ }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->username }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $user->email ?? '-' }}</td>
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
                        <form action="{{ route('superadmin.pendaftar.approve', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menyetujui pendaftar ini?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 hover:underline mr-3">Setujui</button>
                        </form>

                        <form action="{{ route('superadmin.pendaftar.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menolak dan menghapus pendaftar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="text-center py-4">Tidak ada pendaftar baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
