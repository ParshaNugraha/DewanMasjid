@extends('layouts.superadmin') {{-- Sesuaikan dengan layout superadmin kamu --}}

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Galeri Foto</h1>

    <a href="{{ route('superadmin.galeri.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        Tambah Foto
    </a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($galeris as $galeri)
            <div class="border rounded p-2 shadow">
                <img src="{{ asset('storage/' . $galeri->gambar) }}" class="w-full h-40 object-cover rounded mb-2">
                <p class="font-semibold">{{ $galeri->judul }}</p>
                <div class="flex gap-2 mt-2">
                    <form action="{{ route('superadmin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
