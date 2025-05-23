@vite(['resources/css/app.css', 'resources/js/app.js'])

@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif

<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-green-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Update Data Masjid</h2>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Masjid -->
                        <div>
                            <label for="nama_masjid" class="block text-sm font-medium text-gray-700">Nama Masjid</label>
                            <input id="nama_masjid" name="nama_masjid" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('nama_masjid', $user->nama_masjid) }}">
                            @error('nama_masjid')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Takmir -->
                        <div>
                            <label for="nama_takmir" class="block text-sm font-medium text-gray-700">Nama Takmir</label>
                            <input id="nama_takmir" name="nama_takmir" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('nama_takmir', $user->nama_takmir) }}">
                            @error('nama_takmir')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Berdiri -->
                        <div>
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun Berdiri</label>
                            <input type="number" name="tahun" min="1000" max="9999" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('tahun', $user->tahun) }}">
                            @error('tahun')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Tanah -->
                        <div>
                            <label for="status_tanah" class="block text-sm font-medium text-gray-700">Status
                                Tanah</label>
                            <select id="status_tanah" name="status_tanah" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="Milik Sendiri" {{ $user->status_tanah == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                <option value="Wakaf" {{ $user->status_tanah == 'Wakaf' ? 'selected' : '' }}>Wakaf
                                </option>
                                <option value="Sewa" {{ $user->status_tanah == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                <option value="Pinjam Pakai" {{ $user->status_tanah == 'Pinjam Pakai' ? 'selected' : '' }}>Pinjam Pakai</option>
                            </select>
                            @error('status_tanah')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Topologi Masjid -->
                        <div>
                            <label for="topologi_masjid" class="block text-sm font-medium text-gray-700">Topologi
                                Masjid</label>
                            <select id="topologi_masjid" name="topologi_masjid" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="Masjid Jami" {{ $user->topologi_masjid == 'Masjid Jami' ? 'selected' : '' }}>Masjid Jami</option>
                                <option value="Masjid Negara" {{ $user->topologi_masjid == 'Masjid Negara' ? 'selected' : '' }}>Masjid Negara</option>
                                <option value="Masjid Agung" {{ $user->topologi_masjid == 'Masjid Agung' ? 'selected' : '' }}>Masjid Agung</option>
                                <option value="Masjid Raya" {{ $user->topologi_masjid == 'Masjid Raya' ? 'selected' : '' }}>Masjid Raya</option>
                                <option value="Masjid Besar" {{ $user->topologi_masjid == 'Masjid Besar' ? 'selected' : '' }}>Masjid Besar</option>
                                <option value="Masjid Kecil" {{ $user->topologi_masjid == 'Masjid Kecil' ? 'selected' : '' }}>Masjid Kecil</option>
                            </select>
                            @error('topologi_masjid')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <input id="kecamatan" name="kecamatan" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('kecamatan', $user->kecamatan) }}">
                            @error('kecamatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kabupaten -->
                        <div>
                            <label for="kabupaten"
                                class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <input id="kabupaten" name="kabupaten" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('kabupaten', $user->kabupaten) }}">
                            @error('kabupaten')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Nomor Telepon -->
                        <div>
                            <label for="notlp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input id="notlp" name="notlp" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('notlp', $user->notlp) }}">
                            @error('notlp')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input id="username" name="username" type="text" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500"
                                value="{{ old('username', $user->username) }}">
                            @error('username')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password (Kosongkan
                                jika tidak ingin mengubah)</label>
                            <input id="password" name="password" type="password"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500">
                            @error('password')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar dan Surat -->
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Gambar -->
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar
                                    Masjid</label>
                                <input id="gambar" name="gambar" type="file"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                @if($user->gambar)
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-500">Gambar saat ini:</span><br>
                                        <img src="{{ Vite::asset('storage/app/public/' . $user->gambar) }}"
                                            alt="Gambar Masjid" class="mt-1 h-32 rounded shadow-md">
                                    </div>
                                @endif
                                @error('gambar')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Surat -->
                            <div>
                                <label for="surat" class="block text-sm font-medium text-gray-700">Surat Keterangan
                                    Tanah</label>
                                <input id="surat" name="surat" type="file"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                @if($user->surat)
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-500">Surat saat ini:</span><br>
                                        <a href="{{ Vite::asset('storage/app/public/' . $user->surat) }}" target="_blank"
                                            class="text-green-600 hover:text-green-800 text-sm">Lihat Surat</a>
                                    </div>
                                @endif
                                @error('surat')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="md:col-span-2 text-right">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>