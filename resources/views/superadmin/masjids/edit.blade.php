@extends('layouts.superadmin')

@section('title', 'Edit Masjid & Admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-8 border border-blue-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-extrabold text-blue-700 flex items-center gap-2">
                <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4"></path>
                </svg>
                Edit Masjid & User Admin
            </h2>
            <a href="{{ route('superadmin.masjids.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition font-semibold">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>
        </div>
        <form id="form-masjid" action="{{ route('superadmin.masjids.update', $masjid->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-8" novalidate>
            @csrf
            @method('PUT')

            {{-- USER ADMIN --}}
            <div class="bg-blue-50 rounded-lg p-6 shadow mb-4">
                <h3 class="font-bold text-lg text-blue-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                    Data Admin
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="username" class="block font-semibold text-gray-700 mb-1">Username <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="username" id="username"
                            class="w-full border border-blue-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                            value="{{ old('username', $user->username) }}" required placeholder="Masukkan username admin">
                        <span class="text-xs text-red-500 hidden" id="error-username">Wajib Diisi</span>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block font-semibold text-gray-700 mb-1">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email"
                            class="w-full border border-blue-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                            value="{{ old('email', $user->email) }}" required placeholder="Masukkan email admin">
                        <span class="text-xs text-red-500 hidden" id="error-email">Wajib Diisi</span>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block font-semibold text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full border border-blue-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                            placeholder="Password admin">
                        <span class="text-gray-400">(Kosongkan jika tidak diubah)</span>
                        <span class="text-xs text-red-500 hidden" id="error-password">Wajib Diisi</span>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="bg-yellow-50 rounded-lg p-6 shadow mb-4">
                <h3 class="font-bold text-lg text-yellow-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                    </svg>
                    Status User
                </h3>
                <div>
                    <label for="status" class="block font-semibold text-gray-700 mb-1">Status User <span class="text-red-500">*</span></label>
                    <select name="status" id="status"
                        class="w-full border border-yellow-200 rounded-lg p-2 focus:ring-2 focus:ring-yellow-400" required>
                        <option value="approved" {{ old('status', $user->status) == 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- MASJID --}}
            <div class="bg-green-50 rounded-lg p-6 shadow">
                <h3 class="font-bold text-lg text-green-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 13v7"></path>
                    </svg>
                    Data Masjid
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_masjid" class="block font-semibold text-gray-700 mb-1">Nama Masjid <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_masjid" id="nama_masjid"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('nama_masjid', $masjid->nama_masjid) }}" required
                            placeholder="Masukkan nama masjid">
                        <span class="text-xs text-red-500 hidden" id="error-nama_masjid">Wajib Diisi</span>
                        @error('nama_masjid')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_takmir" class="block font-semibold text-gray-700 mb-1">Nama Takmir <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama_takmir" id="nama_takmir"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('nama_takmir', $masjid->nama_takmir) }}" required
                            placeholder="Masukkan nama takmir">
                        <span class="text-xs text-red-500 hidden" id="error-nama_takmir">Wajib Diisi</span>
                        @error('nama_takmir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tahun" class="block font-semibold text-gray-700 mb-1">Tahun Berdiri <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="tahun" id="tahun"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('tahun', $masjid->tahun) }}" required placeholder="Contoh: 1998">
                        <span class="text-xs text-red-500 hidden" id="error-tahun">Wajib Diisi</span>
                        @error('tahun')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="status_tanah" class="block font-semibold text-gray-700 mb-1">Status Tanah <span
                                class="text-red-500">*</span></label>
                        <select name="status_tanah" id="status_tanah"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            required>
                            <option value="">Pilih Status Tanah</option>
                            <option value="Milik Sendiri" {{ old('status_tanah', $masjid->status_tanah) == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                            <option value="Wakaf" {{ old('status_tanah', $masjid->status_tanah) == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
                            <option value="Sewa" {{ old('status_tanah', $masjid->status_tanah) == 'Sewa' ? 'selected' : '' }}>
                                Sewa</option>
                            <option value="Pinjam Pakai" {{ old('status_tanah', $masjid->status_tanah) == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                        </select>
                        <span class="text-xs text-red-500 hidden" id="error-status_tanah">Wajib Dipilih</span>
                        @error('status_tanah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="topologi_masjid" class="block font-semibold text-gray-700 mb-1">Topologi Masjid <span
                                class="text-red-500">*</span></label>
                        <select name="topologi_masjid" id="topologi_masjid"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            required>
                            <option value="">Pilih Topologi</option>
                            <option value="Masjid Jami" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Jami' ? 'selected' : '' }}>Masjid Jami</option>
                            <option value="Masjid Negara" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Negara' ? 'selected' : '' }}>Masjid Negara</option>
                            <option value="Masjid Agung" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Agung' ? 'selected' : '' }}>Masjid Agung</option>
                            <option value="Masjid Raya" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Raya' ? 'selected' : '' }}>Masjid Raya</option>
                            <option value="Masjid Bersejarah" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Bersejarah' ? 'selected' : '' }}>Masjid Bersejarah</option>
                            <option value="Masjid Kampus" {{ old('topologi_masjid', $masjid->topologi_masjid) == 'Masjid Kampus' ? 'selected' : '' }}>Masjid Kampus</option>
                        </select>
                        <span class="text-xs text-red-500 hidden" id="error-topologi_masjid">Wajib Dipilih</span>
                        @error('topologi_masjid')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kecamatan" class="block font-semibold text-gray-700 mb-1">Kecamatan <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kecamatan" id="kecamatan"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('kecamatan', $masjid->kecamatan) }}" required placeholder="Masukkan kecamatan">
                        <span class="text-xs text-red-500 hidden" id="error-kecamatan">Wajib Diisi</span>
                        @error('kecamatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kabupaten" class="block font-semibold text-gray-700 mb-1">Kabupaten <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kabupaten" id="kabupaten"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('kabupaten', $masjid->kabupaten) }}" required placeholder="Masukkan kabupaten">
                        <span class="text-xs text-red-500 hidden" id="error-kabupaten">Wajib Diisi</span>
                        @error('kabupaten')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block font-semibold text-gray-700 mb-1">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400" required
                            placeholder="Masukkan alamat">{{ old('alamat', $masjid->alamat) }}</textarea>
                        <span class="text-xs text-red-500 hidden" id="error-alamat">Wajib Diisi</span>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="lokasi" class="block font-semibold text-gray-700 mb-1">Lokasi<span class="text-red-500">*</span></label>
                        <input type="text" name="lokasi" id="lokasi"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('lokasi', $masjid->lokasi) }}"
                            required
                            placeholder="Tempelkan link Maps lokasi masjid">
                        <span class="text-xs text-red-500 hidden" id="error-lokasi">Wajib Diisi</span>
                        <span class="text-xs text-gray-500">Contoh: https://maps.app.goo.gl/xxxxxxx</span>
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block font-semibold text-gray-700 mb-1">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi" id="deskripsi"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400" required
                            placeholder="Deskripsi masjid">{{ old('deskripsi', $masjid->deskripsi) }}</textarea>
                        <span class="text-xs text-red-500 hidden" id="error-deskripsi">Wajib Diisi</span>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="notlp" class="block font-semibold text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="notlp" id="notlp"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('notlp', $masjid->notlp) }}" placeholder="Nomor telepon masjid">
                        @error('notlp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="donasi" class="block font-semibold text-gray-700 mb-1">Donasi</label>
                        <input type="text" name="donasi" id="donasi"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            value="{{ old('donasi', $masjid->donasi) }}" placeholder="Rekening donasi">
                        @error('donasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Gambar Masjid (opsional)</label>
                        @if($masjid->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $masjid->gambar) }}" class="h-24 rounded" alt="Gambar Masjid">
                            </div>
                        @endif
                        <input type="file" name="gambar"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            accept="image/*">
                        <span class="text-xs text-gray-500">Format JPG/PNG, maks 2MB.</span>
                        @error('gambar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Surat Kepemilikan Tanah (opsional)</label>
                        @if($masjid->surat)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $masjid->surat) }}" class="text-blue-600 hover:underline"
                                    target="_blank">Lihat Surat</a>
                            </div>
                        @endif
                        <input type="file" name="surat"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            accept="application/pdf">
                        <span class="text-xs text-gray-500">Format PDF, maks 2MB.</span>
                        @error('surat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Form Surat Wakaf hanya muncul jika status tanah = Wakaf --}}
                    <div id="form-surat-wakaf"
                        style="display: {{ old('status_tanah', $masjid->status_tanah) == 'Wakaf' ? 'block' : 'none' }};">
                        <label for="surat_wakaf" class="block font-semibold text-gray-700 mb-1">Surat Wakaf (PDF)</label>
                        @if($masjid->surat_wakaf)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $masjid->surat_wakaf) }}" class="text-blue-600 hover:underline"
                                    target="_blank">Lihat Surat Wakaf</a>
                            </div>
                        @endif
                        <input type="file" name="surat_wakaf" id="surat_wakaf"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            accept="application/pdf">
                        <span class="text-xs text-gray-500">Format PDF, maks 2MB.</span>
                        @error('surat_wakaf')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="surat_takmir" class="block font-semibold text-gray-700 mb-1">Surat Pengurus
                            Masjid/Takmir (PDF)</label>
                        @if($masjid->surat_takmir)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $masjid->surat_takmir) }}" class="text-blue-600 hover:underline"
                                    target="_blank">Lihat Surat Takmir</a>
                            </div>
                        @endif
                        <input type="file" name="surat_takmir" id="surat_takmir"
                            class="w-full border border-green-200 rounded-lg p-2 focus:ring-2 focus:ring-green-400"
                            accept="application/pdf">
                        <span class="text-xs text-gray-500">Format PDF, maks 2MB.</span>
                        @error('surat_takmir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-8 py-3 rounded-lg font-bold shadow hover:from-blue-700 hover:to-green-600 transition-all duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Script untuk menampilkan/menyembunyikan form surat wakaf dan validasi Wajib Diisi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusTanah = document.getElementById('status_tanah');
            const formSuratWakaf = document.getElementById('form-surat-wakaf');

            function toggleSuratWakaf() {
                if (statusTanah.value === 'Wakaf') {
                    formSuratWakaf.style.display = 'block';
                } else {
                    formSuratWakaf.style.display = 'none';
                }
            }

            // Jalankan saat halaman pertama kali dimuat
            toggleSuratWakaf();

            // Jalankan saat status tanah berubah
            statusTanah.addEventListener('change', toggleSuratWakaf);

            // Validasi Wajib Diisi
            const form = document.getElementById('form-masjid');
            form.addEventListener('submit', function (e) {
                let valid = true;

                // Daftar field yang Wajib Diisi
                const requiredFields = [
                    { id: 'username', error: 'error-username' },
                    { id: 'email', error: 'error-email' },
                    // password tidak wajib diisi saat edit
                    { id: 'nama_masjid', error: 'error-nama_masjid' },
                    { id: 'nama_takmir', error: 'error-nama_takmir' },
                    { id: 'tahun', error: 'error-tahun' },
                    { id: 'status_tanah', error: 'error-status_tanah' },
                    { id: 'topologi_masjid', error: 'error-topologi_masjid' },
                    { id: 'kecamatan', error: 'error-kecamatan' },
                    { id: 'kabupaten', error: 'error-kabupaten' },
                    { id: 'alamat', error: 'error-alamat' },
                    { id: 'deskripsi', error: 'error-deskripsi' },
                ];

                requiredFields.forEach(function (field) {
                    const input = document.getElementById(field.id);
                    const error = document.getElementById(field.error);
                    if (input) {
                        if (!input.value || (input.tagName === 'SELECT' && input.value === '')) {
                            error.classList.remove('hidden');
                            valid = false;
                        } else {
                            error.classList.add('hidden');
                        }
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    // Scroll ke field pertama yang error
                    const firstError = document.querySelector('span.text-red-500:not(.hidden)');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });

            // Sembunyikan pesan error saat user mulai mengisi
            const allInputs = form.querySelectorAll('input, textarea, select');
            allInputs.forEach(function (input) {
                input.addEventListener('input', function () {
                    const error = document.getElementById('error-' + input.name);
                    if (error) {
                        if (input.value) {
                            error.classList.add('hidden');
                        }
                    }
                });
                input.addEventListener('change', function () {
                    const error = document.getElementById('error-' + input.name);
                    if (error) {
                        if (input.value) {
                            error.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
@endsection