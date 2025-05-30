@extends('layouts.admin')

@section('title', 'Kelola Pendaftar')

@section('content')

@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8">
    <h2 class="text-3xl font-semibold mb-4">Pendaftar Belum Disetujui</h2>

    <table class="min-w-full table-auto border-collapse border border-gray-200 text-sm bg-white rounded shadow overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Username</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Daftar</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->username }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('pendaftar.approve', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menyetujui pendaftar ini?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 hover:underline mr-3">Setujui</button>
                        </form>

                        <form action="{{ route('pendaftar.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menolak dan menghapus pendaftar ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada pendaftar baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
