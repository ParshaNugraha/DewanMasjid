@extends('layouts.superadmin')

@section('content')
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Edit Foto Galeri</h1>

    <form action="{{ route('superadmin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Judul</label>
            <input type="text" name="judul" class="w-full border rounded px-3 py-2" value="{{ old('judul', $galeri->judul) }}">
        </div>

        <div>
            <label class="block font-semibold">Ganti Foto (opsional)</label>
            <input type="file" name="gambar" accept="image/*" class="w-full border rounded px-3 py-2">
            <p class="text-sm text-gray-600">Biarkan kosong jika tidak ingin mengganti.</p>
            @error('gambar') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <p class="font-semibold mb-2">Foto Saat Ini:</p>
            <img src="{{ asset('storage/' . $galeri->gambar) }}" class="w-48 rounded border">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('superadmin.galeri.index') }}" class="text-gray-600">Batal</a>
    </form>
</div>
@endsection
