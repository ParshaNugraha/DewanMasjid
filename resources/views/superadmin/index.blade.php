@extends('layouts.admin')

@section('title', 'Dashboard Superadmin')

@section('content')

<div class="mb-8">
    <h2 class="text-3xl font-semibold mb-4">Dashboard Superadmin</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-2">Total Users</h3>
            <p class="text-4xl font-extrabold text-indigo-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-2">Total Admins</h3>
            <p class="text-4xl font-extrabold text-indigo-600">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-2">Total Masjids</h3>
            <p class="text-4xl font-extrabold text-indigo-600">{{ $totalMasjids }}</p>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded shadow overflow-x-auto">
    <h3 class="text-2xl font-semibold mb-4">Daftar User & Masjid</h3>

    <table class="min-w-full table-auto border-collapse border border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Username</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Role</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Masjid</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Nama Takmir</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Tahun</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Status Tanah</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Topologi Masjid</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Kecamatan</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Kabupaten</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Alamat</th>
                <th class="border border-gray-300 px-4 py-2 text-left">No. Telepon</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Gambar</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Surat</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->username }}</td>
                    <td class="border border-gray-300 px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->nama_masjid ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->nama_takmir ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->tahun ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->status_tanah ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->topologi_masjid ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->kecamatan ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->kabupaten ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->alamat ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->notlp ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($user->masjid && $user->masjid->gambar)
                            <img src="{{ asset('storage/' . $user->masjid->gambar) }}" alt="Gambar Masjid" class="h-16 w-auto rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($user->masjid && $user->masjid->surat)
                            <a href="{{ asset('storage/' . $user->masjid->surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Surat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="text-center py-4">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

@endsection
