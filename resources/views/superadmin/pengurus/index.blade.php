@extends('layouts.superadmin')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-green-700">Kelola Gambar Pengurus</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tampilkan gambar pengurus jika ada --}}
    @if($pengurus)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $pengurus->gambar) }}" alt="Gambar Pengurus" class="w-full max-h-96 object-contain rounded border">
        </div>
    @else
        <p class="mb-6 text-gray-500">Belum ada gambar pengurus yang diupload.</p>
    @endif

    {{-- Form upload gambar --}}
    <form action="{{ route('superadmin.pengurus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="gambar" class="block mb-2 font-semibold">Upload Gambar Pengurus (jpg, png, max 2MB)</label>
            <input type="file" name="gambar" id="gambar" accept="image/*" required class="border p-2 rounded w-full">
            @error('gambar')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Simpan
        </button>
    </form>

    @if($pengurus)
    {{-- Form hapus gambar --}}
    <form action="{{ route('superadmin.pengurus.destroy', $pengurus->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin hapus gambar pengurus?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
            Hapus
        </button>
    </form>
    @endif
</div>
@endsection
