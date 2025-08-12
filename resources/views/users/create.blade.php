@if (session('pending'))
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-0 animate-fade-in-down relative">
            <button onclick="window.location.href='{{ url('/') }}'" class="absolute top-4 right-4 text-gray-400 hover:text-green-600 transition" aria-label="Tutup">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <div class="flex flex-col items-center px-8 py-10">
                <div class="bg-green-100 rounded-full p-4 mb-4">
                    <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="white"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l3 3 7-7" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-green-700 mb-2">Pendaftaran Berhasil!</h3>
                <div class="text-gray-600 text-center mb-4">
                    <p class="mb-1">Pendaftaran Anda sedang dalam proses verifikasi oleh admin.</p>
                    <p>Anda akan menerima notifikasi via email setelah akun Anda aktif.</p>
                </div>
                <a href="{{ url('/') }}"
                    class="inline-flex items-center px-6 py-2 text-base font-semibold text-white bg-gradient-to-r from-green-500 to-teal-500 rounded-lg shadow-md hover:from-green-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition transform hover:scale-105 mt-2">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
@endif

<div
    class="min-h-screen bg-gradient-to-br from-green-50 to-teal-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-4xl font-extrabold text-gray-900 drop-shadow-sm">
            Buat Akun Baru
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-2xl sm:rounded-2xl sm:px-10 overflow-hidden max-h-[85vh] flex flex-col border border-green-100">
            <div class="overflow-y-auto pr-2 -mr-2">
                <form class="space-y-6" id="registration-form" method="POST" action="{{ route('users.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="nama_masjid" class="block text-sm font-semibold text-green-700">
                            Nama Masjid
                        </label>
                        <div class="mt-1">
                            <input id="nama_masjid" name="nama_masjid" type="text" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('nama_masjid') border-red-500 @enderror"
                                value="{{ old('nama_masjid') }}" placeholder="Contoh: Masjid ...">
                            @error('nama_masjid')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="nama_takmir" class="block text-sm font-semibold text-green-700">
                            Nama Takmir
                        </label>
                        <div class="mt-1">
                            <input id="nama_takmir" name="nama_takmir" type="text" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('nama_takmir') border-red-500 @enderror"
                                value="{{ old('nama_takmir') }}" placeholder="">
                            @error('nama_takmir')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="tahun" class="block text-sm font-semibold text-green-700">
                            Tahun Berdiri
                        </label>
                        <div class="mt-1">
                            <input type="number" name="tahun" min="1000" max="{{ date('Y') + 1 }}" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('tahun') border-red-500 @enderror"
                                value="{{ old('tahun') }}"
                                onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                                style="-moz-appearance: textfield;" placeholder="Contoh: 1980">
                            @error('tahun')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <style>
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                    </style>

                    <div>
                        <label for="status_tanah" class="block text-sm font-semibold text-green-700">
                            Status Tanah
                        </label>
                        <div class="mt-1">
                            <select id="status_tanah" name="status_tanah" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('status_tanah') border-red-500 @enderror"
                                onchange="toggleSuratWakaf()">
                                <option value="">-- Pilih Status Tanah --</option>
                                <option value="Milik Sendiri" {{ old('status_tanah') == 'Milik Sendiri' ? 'selected' : '' }}>
                                    Milik Sendiri</option>
                                <option value="Wakaf" {{ old('status_tanah') == 'Wakaf' ? 'selected' : '' }}>Wakaf
                                </option>
                                <option value="Sewa" {{ old('status_tanah') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                <option value="Pinjam Pakai" {{ old('status_tanah') == 'Pinjam Pakai' ? 'selected' : '' }}>
                                    Pinjam Pakai</option>
                            </select>
                            @error('status_tanah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="notlp" class="block text-sm font-semibold text-green-700">
                            Nomor Telepon
                        </label>
                        <div class="mt-1">
                            <input id="notlp" name="notlp" type="tel" required maxlength="15"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); if(this.value.length > 15) this.value = this.value.slice(0, 15);"
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('notlp') border-red-500 @enderror"
                                value="{{ old('notlp') }}" placeholder="Contoh: 08...">
                            @error('notlp')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="topologi_masjid" class="block text-sm font-semibold text-green-700">
                            Topologi Masjid
                        </label>
                        <div class="mt-1">
                            <select id="topologi_masjid" name="topologi_masjid" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('topologi_masjid') border-red-500 @enderror">
                                <option value="">-- Pilih Topologi Masjid --</option>
                                <option value="Masjid Jami" {{ old('topologi_masjid') == 'Masjid Jami' ? 'selected' : '' }}>Masjid Jami</option>
                                <option value="Masjid Negara" {{ old('topologi_masjid') == 'Masjid Negara' ? 'selected' : '' }}>Masjid Negara</option>
                                <option value="Masjid Agung" {{ old('topologi_masjid') == 'Masjid Agung' ? 'selected' : '' }}>Masjid Agung</option>
                                <option value="Masjid Raya" {{ old('topologi_masjid') == 'Masjid Raya' ? 'selected' : '' }}>Masjid Raya</option>
                                <option value="Masjid Bersejarah" {{ old('topologi_masjid') == 'Masjid Bersejarah' ? 'selected' : '' }}>Masjid Bersejarah</option>
                                <option value="Masjid Kampus" {{ old('topologi_masjid') == 'Masjid Kampus' ? 'selected' : '' }}>Masjid Kampus</option>
                            </select>
                            @error('topologi_masjid')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="kecamatan" class="block text-sm font-semibold text-green-700">
                            Kecamatan
                        </label>
                        <div class="mt-1">
                            <input id="kecamatan" name="kecamatan" type="text" required maxlength="100"
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('kecamatan') border-red-500 @enderror"
                                value="{{ old('kecamatan') }}" placeholder="Contoh: Kecamatan Donorojo">
                            @error('kecamatan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="kabupaten" class="block text-sm font-semibold text-green-700">
                            Kabupaten/Kota
                        </label>
                        <div class="mt-1">
                            <input id="kabupaten" name="kabupaten" type="text" required maxlength="100"
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('kabupaten') border-red-500 @enderror"
                                value="{{ old('kabupaten') }}" placeholder="Contoh: Kabupaten Semarang">
                            @error('kabupaten')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-green-700">
                            Alamat Lengkap
                        </label>
                        <div class="mt-1">
                            <textarea id="alamat" name="alamat" required maxlength="500"
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('alamat') border-red-500 @enderror"
                                rows="3"
                                placeholder="Masukkan alamat lengkap masjid Anda">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="lokasi" class="block text-sm font-semibold text-green-700">
                            Lokasi (Link Google Maps)
                        </label>
                        <div class="mt-1">
                            <input id="lokasi" name="lokasi" type="text" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('lokasi') border-red-500 @enderror"
                                value="{{ old('lokasi') }}" placeholder="Tempelkan link Google Maps lokasi masjid">
                            <p class="mt-1 text-xs text-gray-500">Contoh: https://maps.app.goo.gl/xxxxxxx</p>
                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-semibold text-green-700">
                            Username
                        </label>
                        <div class="mt-1">
                            <input id="username" name="username" type="text" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('username') border-red-500 @enderror"
                                value="{{ old('username') }}" placeholder="">
                            <p class="text-xs text-red-500 mt-1">*Gunakan kombinasi huruf & angka</p>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-green-700">
                            Email <span class="text-xs text-gray-500">(hanya email @dmi.id)</span>
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" required
                                pattern="^[a-zA-Z0-9._%+-]+@dmi\.id$"
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}" placeholder="Masukkan email @dmi.id Anda">
                            <p class="mt-1 text-xs text-gray-500">Contoh: namaanda@dmi.id</p>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-green-700">
                            Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" required
                                class="appearance-none block w-full px-3 py-2 pr-10 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm @error('password') border-red-500 @enderror"
                                placeholder="">

                            <button type="button"
                                class="absolute inset-y-0 right-0 px-3 flex items-center justify-center"
                                onclick="togglePasswordVisibility('password', 'eye-icon-password')">
                                <svg id="eye-icon-password" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="text-xs text-red-500 mt-1">*Minimal 8 karakter</p>
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-semibold text-green-700">
                            Konfirmasi Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password-confirm" name="password_confirmation" type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-green-200 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400 sm:text-sm"
                                placeholder="Konfirmasi password Anda">
                            <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none"
                                onclick="togglePasswordVisibility('password-confirm', 'eye-icon-password-confirm')">
                                <svg id="eye-icon-password-confirm" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <script>
                        function togglePasswordVisibility(fieldId, iconId) {
                            const field = document.getElementById(fieldId);
                            const icon = document.getElementById(iconId);

                            if (field.type === "password") {
                                field.type = "text";
                                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                            } else {
                                field.type = "password";
                                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                            }
                        }

                        function toggleSuratWakaf() {
                            var status = document.getElementById('status_tanah').value;
                            var wakafDiv = document.getElementById('surat_wakaf_div');
                            var wakafInput = document.getElementById('surat_wakaf');
                            if (status === 'Wakaf') {
                                wakafDiv.style.display = 'block';
                                wakafInput.required = true;
                            } else {
                                wakafDiv.style.display = 'none';
                                wakafInput.required = false;
                                wakafInput.value = '';
                                wakafInput.type = 'text';
                                wakafInput.type = 'file';
                            }
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            toggleSuratWakaf();
                        });
                    </script>

                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-green-700">
                            Gambar Masjid
                        </label>
                        <div class="mt-1">
                            <input id="gambar" name="gambar" type="file" required
                                accept="image/jpeg, image/png, image/jpg"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 @error('gambar') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG (Maks. 2MB)</p>
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="surat" class="block text-sm font-semibold text-green-700">
                            Surat Keterangan Tanah
                        </label>
                        <div class="mt-1">
                            <input id="surat" name="surat" type="file" required accept="application/pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 @error('surat') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF (Maks. 5MB)</p>
                            @error('surat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div id="surat_wakaf_div" style="display: none;">
                        <label for="surat_wakaf" class="block text-sm font-semibold text-green-700">
                            Surat Bukti Tanah Wakaf
                        </label>
                        <div class="mt-1">
                            <input type="file" id="surat_wakaf" name="surat_wakaf" accept="application/pdf" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 @error('surat_wakaf') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF (Maks. 5MB)</p>
                            @error('surat_wakaf')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="surat_takmir" class="block text-sm font-semibold text-green-700">
                            Surat Bukti Takmir/Pengurus
                        </label>
                        <div class="mt-1">
                            <input type="file" id="surat_takmir" name="surat_takmir" accept="application/pdf" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 @error('surat_takmir') border-red-500 @enderror">
                            <p class="mt-1 text-xs text-gray-500">Format: PDF (Maks. 5MB)</p>
                            @error('surat_takmir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>

            <div class="mt-6 flex items-center justify-between pt-4 border-t border-green-100">
                <a href="{{ url('/') }}"
                    class="text-sm font-medium text-green-600 hover:text-green-800 transition ease-in-out duration-300 transform hover:scale-105 hover:shadow-md">
                    Kembali
                </a>

                <button type="submit" form="registration-form"
                    class="w-auto flex justify-center py-2 px-6 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition ease-in-out duration-300 transform hover:scale-105 hover:shadow-lg">
                    Daftar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.querySelector('.animate-fade-in-down');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '1';
                successMessage.style.transform = 'translateY(0)';
            }, 100);
        }
    });
</script>