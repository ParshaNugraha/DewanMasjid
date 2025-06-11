@extends('layouts.superadmin')

@section('title', 'Kelola Masjid dan Admin')

@section('content')
<div class="bg-white p-4 rounded shadow mt-10 overflow-x-auto max-w-full">
    <h3 class="text-2xl font-semibold mb-4">Daftar User & Masjid</h3>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('superadmin.masjids.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Masjid & Admin</a>

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
                <th class="border border-gray-300 px-3 py-1 text-left">Donasi</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Deskripsi</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Gambar</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Surat</th>
                <th class="border border-gray-300 px-3 py-1 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $offset = ($masjids->currentPage() - 1) * $masjids->perPage();
            @endphp

            @forelse($masjids as $masjid)
                <tr>
                    <td class="border border-gray-300 px-3 py-1">{{ $loop->iteration + $offset }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->user->username ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->user->email ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1 capitalize">{{ $masjid->user->role ?? '-' }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->nama_masjid }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->nama_takmir }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->tahun }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->status_tanah }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->topologi_masjid }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->kecamatan }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->kabupaten }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->alamat }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->notlp }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->donasi }}</td>
                    <td class="border border-gray-300 px-3 py-1">{{ $masjid->deskripsi }}</td>
                    <td class="border border-gray-300 px-3 py-1">
                        @if($masjid->gambar)
                            <img src="{{ asset('storage/' . $masjid->gambar) }}" alt="Gambar Masjid" class="h-12 w-auto rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-1">
                        @if($masjid->surat)
                            <a href="{{ asset('storage/' . $masjid->surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Surat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-1">
                        <a href="{{ route('superadmin.masjids.edit', $masjid->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('superadmin.masjids.destroy', $masjid->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data masjid ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="text-center py-4">Tidak ada data masjid.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $masjids->links() }}
    </div>
</div>
@endsection
