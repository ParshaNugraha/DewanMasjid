@extends('layouts.superadmin')

@section('title', 'Kelola Masjid dan Admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg mt-10 overflow-x-auto max-w-full">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Lengkap Masjid & Admin</h3>
        <a href="{{ route('superadmin.masjids.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Data
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 border-l-4 border-green-500 text-green-700">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Info Admin</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Detail Masjid</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kontak & Donasi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $offset = ($masjids->currentPage() - 1) * $masjids->perPage();
                    $no = 1 + $offset;
                    $adaData = false;
                @endphp

                @foreach($masjids as $masjid)
                    @if(isset($masjid->user) && $masjid->user->status === 'approved')
                        @php $adaData = true; @endphp
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $no++ }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $masjid->user->username ?? '-' }}</div>
                                <div class="text-sm text-gray-500">{{ $masjid->user->email ?? '-' }}</div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $masjid->user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $masjid->user->role ?? '-' }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $masjid->nama_masjid }}</div>
                                <div class="text-sm text-gray-500">Tahun: {{ $masjid->tahun }}</div>
                                <div class="text-sm text-gray-500">Status Tanah: {{ $masjid->status_tanah }}</div>
                                <div class="text-sm text-gray-500">Tipe: {{ $masjid->topologi_masjid }}</div>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $masjid->alamat }}</div>
                                <div class="text-sm text-gray-500">Kec. {{ $masjid->kecamatan }}</div>
                                <div class="text-sm text-gray-500">Kab. {{ $masjid->kabupaten }}</div>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">Takmir: {{ $masjid->nama_takmir }}</div>
                                <div class="text-sm text-gray-500">Telp: {{ $masjid->notlp ?? '-' }}</div>
                                <div class="text-sm text-blue-600 font-medium">Donasi: {{ $masjid->donasi ?? '-' }}</div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col space-y-2">
                                    <a href="{{ route('superadmin.masjids.edit', $masjid->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition duration-150 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <!-- Tombol untuk membuka modal konfirmasi hapus -->
                                    <button type="button"
                                        onclick="openDeleteModal({{ $masjid->id }})"
                                        class="text-red-600 hover:text-red-800 transition duration-150 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div id="deleteModal-{{ $masjid->id }}" class="fixed z-50 inset-0 overflow-y-auto hidden">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>
                                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full z-50">
                                                <div class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        <svg class="h-6 w-6 text-red-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                            Konfirmasi Hapus
                                                        </h3>
                                                    </div>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            Apakah Anda yakin ingin menghapus data masjid ini? Tindakan ini tidak dapat dibatalkan.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-2">
                                                    <button type="button" onclick="closeDeleteModal({{ $masjid->id }})" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                                        Batal
                                                    </button>
                                                    <form action="{{ route('superadmin.masjids.destroy', $masjid->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function openDeleteModal(id) {
                                            document.getElementById('deleteModal-' + id).classList.remove('hidden');
                                        }
                                        function closeDeleteModal(id) {
                                            document.getElementById('deleteModal-' + id).classList.add('hidden');
                                        }
                                    </script>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                @if(!$adaData)
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data masjid yang sudah disetujui.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $masjids->links() }}
    </div>
</div>
@endsection
