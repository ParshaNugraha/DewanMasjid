@extends('layouts.superadmin')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h2 class="text-xl font-bold mb-4">Tambah Masjid dan User Admin</h2>

    <form action="{{ route('superadmin.masjids.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- USER ADMIN --}}
        <h3 class="font-semibold mt-4 mb-2">Data Admin</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="username" class="block">Username</label>
                <input type="text" name="username" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="email" class="block">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="password" class="block">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
        </div>

        {{-- MASJID --}}
        <h3 class="font-semibold mt-6 mb-2">Data Masjid</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nama_masjid" class="block">Nama Masjid</label>
                <input type="text" name="nama_masjid" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="nama_takmir" class="block">Nama Takmir</label>
                <input type="text" name="nama_takmir" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="tahun" class="block">Tahun Berdiri</label>
                <input type="number" name="tahun" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="status_tanah" class="block">Status Tanah</label>
                <select name="status_tanah" class="w-full border rounded p-2" required>
                    <option value="">Pilih</option>
                    <option value="Milik Sendiri">Milik Sendiri</option>
                    <option value="Wakaf">Wakaf</option>
                    <option value="Sewa">Sewa</option>
                    <option value="Pinjam Pakai">Pinjam Pakai</option>
                </select>
            </div>
            <div>
                <label for="topologi_masjid" class="block">Topologi Masjid</label>
                <select name="topologi_masjid" class="w-full border rounded p-2" required>
                    <option value="">Pilih</option>
                    <option value="Masjid Jami">Masjid Jami</option>
                    <option value="Masjid Negara">Masjid Negara</option>
                    <option value="Masjid Agung">Masjid Agung</option>
                    <option value="Masjid Raya">Masjid Raya</option>
                    <option value="Masjid Besar">Masjid Besar</option>
                    <option value="Masjid Kecil">Masjid Kecil</option>
                </select>
            </div>
            <div>
                <label for="kecamatan" class="block">Kecamatan</label>
                <input type="text" name="kecamatan" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label for="kabupaten" class="block">Kabupaten/Kota</label>
                <input type="text" name="kabupaten" class="w-full border rounded p-2" required>
            </div>
            <div class="md:col-span-2">
                <label for="alamat" class="block">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full border rounded p-2" required></textarea>
            </div>
            <div class="md:col-span-2">
                <label for="deskripsi" class="block">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border rounded p-2" required></textarea>
            </div>
            <div>
                <label for="notlp" class="block">No. Telepon</label>
                <input type="text" name="notlp" class="w-full border rounded p-2">
            </div>
            <div>
                <label for="donasi" class="block">Donasi</label>
                <input type="text" name="donasi" class="w-full border rounded p-2">
            </div>
            <div>
                <label for="gambar" class="block">Gambar Masjid</label>
                <input type="file" name="gambar" class="w-full border rounded p-2">
            </div>
            <div>
                <label for="surat" class="block">Surat Kepemilikan (PDF)</label>
                <input type="file" name="surat" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
