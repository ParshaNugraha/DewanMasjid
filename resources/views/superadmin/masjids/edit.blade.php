@extends('layouts.superadmin')

@section('title', 'Edit Masjid & Admin')

@section('content')
<div class="bg-white p-6 rounded shadow mt-10 max-w-4xl mx-auto">
    <h3 class="text-2xl font-semibold mb-6">Edit Masjid & Admin</h3>

    <form action="{{ route('superadmin.masjids.update', $masjid->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Data Admin --}}
        <h4 class="text-lg font-semibold mb-2">Data Admin</h4>
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium">Username</label>
            <input type="text" name="username" id="username" class="w-full border p-2 rounded"
                value="{{ old('username', $user->username) }}" required>
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded"
                value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" id="password" class="w-full border p-2 rounded">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Data Masjid --}}
        <h4 class="text-lg font-semibold mt-6 mb-2">Data Masjid</h4>
        <div class="mb-4">
            <label for="nama_masjid" class="block text-sm font-medium">Nama Masjid</label>
            <input type="text" name="nama_masjid" id="nama_masjid" class="w-full border p-2 rounded"
                value="{{ old('nama_masjid', $user->masjid->nama_masjid ?? '') }}" required>
            @error('nama_masjid')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nama_takmir" class="block text-sm font-medium">Nama Takmir</label>
            <input type="text" name="nama_takmir" id="nama_takmir" class="w-full border p-2 rounded"
                value="{{ old('nama_takmir', $user->masjid->nama_takmir ?? '') }}">
            @error('nama_takmir')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tahun" class="block text-sm font-medium">Tahun Berdiri</label>
            <input type="number" name="tahun" id="tahun" class="w-full border p-2 rounded"
                value="{{ old('tahun', $user->masjid->tahun ?? '') }}">
            @error('tahun')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status_tanah" class="block text-sm font-medium">Status Tanah</label>
            <input type="text" name="status_tanah" id="status_tanah" class="w-full border p-2 rounded"
                value="{{ old('status_tanah', $user->masjid->status_tanah ?? '') }}">
            @error('status_tanah')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="topologi_masjid" class="block text-sm font-medium">Topologi Masjid</label>
            <input type="text" name="topologi_masjid" id="topologi_masjid" class="w-full border p-2 rounded"
                value="{{ old('topologi_masjid', $user->masjid->topologi_masjid ?? '') }}">
            @error('topologi_masjid')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="kecamatan" class="block text-sm font-medium">Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" class="w-full border p-2 rounded"
                value="{{ old('kecamatan', $user->masjid->kecamatan ?? '') }}">
            @error('kecamatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="kabupaten" class="block text-sm font-medium">Kabupaten</label>
            <input type="text" name="kabupaten" id="kabupaten" class="w-full border p-2 rounded"
                value="{{ old('kabupaten', $user->masjid->kabupaten ?? '') }}">
            @error('kabupaten')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium">Alamat</label>
            <textarea name="alamat" id="alamat" class="w-full border p-2 rounded">{{ old('alamat', $user->masjid->alamat ?? '') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border p-2 rounded">{{ old('deskripsi', $user->masjid->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="notlp" class="block text-sm font-medium">No. Telepon</label>
            <input type="text" name="notlp" id="notlp" class="w-full border p-2 rounded"
                value="{{ old('notlp', $user->masjid->notlp ?? '') }}">
            @error('notlp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="donasi" class="block text-sm font-medium">Donasi</label>
            <input type="text" name="donasi" id="donasi" class="w-full border p-2 rounded"
                value="{{ old('donasi', $user->masjid->donasi ?? '') }}">
            @error('donasi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Gambar Masjid (opsional)</label>
            @if($user->masjid && $user->masjid->gambar)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->masjid->gambar) }}" class="h-24 rounded" alt="Gambar Masjid">
                </div>
            @endif
            <input type="file" name="gambar" class="w-full">
            @error('gambar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Surat Kepemilikan Tanah (opsional)</label>
            @if($user->masjid && $user->masjid->surat)
                <div class="mb-2">
                    <a href="{{ asset('storage/' . $user->masjid->surat) }}" class="text-blue-600 hover:underline" target="_blank">Lihat Surat</a>
                </div>
            @endif
            <input type="file" name="surat" class="w-full">
            @error('surat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <div class="mt-6 flex items-center">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Update</button>
            <a href="{{ route('superadmin.masjids.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
