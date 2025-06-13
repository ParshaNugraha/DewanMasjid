@extends('layouts.superadmin')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Tambah Foto Galeri</h1>

    <form action="{{ route('superadmin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Judul (opsional)</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2" value="{{ old('judul') }}">
        </div>

        <div>
            <label class="block font-semibold">Foto</label>
            <input type="file" name="gambar" accept="image/*" required class="w-full border rounded px-3 py-2">
            @error('gambar') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('superadmin.galeri.index') }}" class="text-gray-600">Batal</a>
    </form>
</div>
@endsection
