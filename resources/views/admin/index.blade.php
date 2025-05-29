@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    <p class="mb-4">Halo, <span class="font-semibold">{{ auth()->user()->username }}</span>! Selamat datang di dashboard.</p>

    <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold mb-2">Jumlah Masjid Anda</h2>
            <p class="text-4xl font-bold">{{ auth()->user()->masjid ? 1 : 0 }}</p>
        </div>
        <!-- Tambah kartu statistik lain jika perlu -->
    </div>

    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4">Data Masjid Anda</h2>

        @if(auth()->user()->masjid)
            <table class="w-full text-left border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-3 py-2">Nama Masjid</th>
                        <th class="border border-gray-300 px-3 py-2">Nama Takmir</th>
                        <th class="border border-gray-300 px-3 py-2">Tahun</th>
                        <th class="border border-gray-300 px-3 py-2">Status Tanah</th>
                        <th class="border border-gray-300 px-3 py-2">Topologi Masjid</th>
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
                    @php
                        $m = auth()->user()->masjid;
                    @endphp
                    <tr>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->nama_masjid }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->nama_takmir }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->tahun }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->status_tanah }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->topologi_masjid }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->kecamatan }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->kabupaten }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->alamat }}</td>
                        <td class="border border-gray-300 px-3 py-2">{{ $m->notlp ?? '-' }}</td>
                        <td class="border border-gray-300 px-3 py-2">
                            @if($m->gambar)
                                <img src="{{ asset('storage/' . $m->gambar) }}" alt="Gambar Masjid" class="h-16 w-auto rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="border border-gray-300 px-3 py-2">
                            @if($m->surat)
                                <a href="{{ asset('storage/' . $m->surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Surat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td class="border border-gray-300 px-3 py-2 whitespace-nowrap">
                            <a href="{{ route('masjids.edit', $m->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('masjids.destroy', $m->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus masjid ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Anda belum memiliki data masjid.</p>
        @endif
    </div>
</div>
@endsection
