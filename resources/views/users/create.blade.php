@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Buat Akun Baru
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Nama Masjid -->
                <div>
                    <label for="nama_masjid" class="block text-sm font-medium text-gray-700">
                        Nama Masjid
                    </label>
                    <div class="mt-1">
                        <input id="nama_masjid" name="nama_masjid" type="text" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('nama_masjid') border-red-500 @enderror"
                            value="{{ old('nama_masjid') }}">
                        @error('nama_masjid')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nama Takmir -->
                <div>
                    <label for="nama_takmir" class="block text-sm font-medium text-gray-700">
                        Nama Takmir
                    </label>
                    <div class="mt-1">
                        <input id="nama_takmir" name="nama_takmir" type="text" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('nama_takmir') border-red-500 @enderror"
                            value="{{ old('nama_takmir') }}">
                        @error('nama_takmir')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tahun -->
                <div>
                    <label for="tahun" class="block text-sm font-medium text-gray-700">
                        Tahun Berdiri
                    </label>
                    <div class="mt-1">
                        <input id="tahun" name="tahun" type="number" min="1900" max="{{ date('Y') }}" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('tahun') border-red-500 @enderror"
                            value="{{ old('tahun') }}" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189"
                            style="-moz-appearance: textfield;">
                        @error('tahun')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <style>
                    /* Hilangkan spinner di Chrome, Safari, Edge, Opera */
                    input::-webkit-outer-spin-button,
                    input::-webkit-inner-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }
                </style>

                <!-- Status Tanah -->
                <div>
                    <label for="status_tanah" class="block text-sm font-medium text-gray-700">
                        Status Tanah
                    </label>
                    <div class="mt-1">
                        <select id="status_tanah" name="status_tanah" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:green-indigo-500 sm:text-sm @error('status_tanah') border-red-500 @enderror">
                            <option value="">-- Pilih Status Tanah --</option>
                            <option value="Milik Sendiri" {{ old('status_tanah') == 'Milik Sendiri' ? 'selected' : '' }}>
                                Milik Sendiri</option>
                            <option value="Wakaf" {{ old('status_tanah') == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
                            <option value="Sewa" {{ old('status_tanah') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                            <option value="Pinjam Pakai" {{ old('status_tanah') == 'Pinjam Pakai' ? 'selected' : '' }}>
                                Pinjam Pakai</option>
                        </select>
                        @error('status_tanah')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="notlp" class="block text-sm font-medium text-gray-700">
                        Nomor Telepon
                    </label>
                    <div class="mt-1">
                        <input id="notlp" name="notlp" type="number" required maxlength="15"
                            oninput="if(this.value.length > 15) this.value = this.value.slice(0, 15);"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('notlp') border-red-500 @enderror"
                            value="{{ old('notlp') }}">
                        @error('notlp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Topologi Masjid -->
                <div>
                    <label for="topologi_masjid" class="block text-sm font-medium text-gray-700">
                        Topologi Masjid
                    </label>
                    <div class="mt-1">
                        <select id="topologi_masjid" name="topologi_masjid" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:green-indigo-500 sm:text-sm @error('topologi_masjid') border-red-500 @enderror">
                            <option value="">-- Pilih Topologi Masjid --</option>
                            <option value="Masjid Jami" {{ old('topologi_masjid') == 'Masjid Jami' ? 'selected' : '' }}>Masjid Jami</option>
                            <option value="Masjid Negara" {{ old('topologi_masjid') == 'Masjid Negara' ? 'selected' : '' }}>Masjid Negara</option>
                            <option value="Masjid Agung" {{ old('topologi_masjid') == 'Masjid Agung' ? 'selected' : '' }}>Masjid Agung</option>
                            <option value="Masjid Raya" {{ old('topologi_masjid') == 'Masjid Raya' ? 'selected' : '' }}>Masjid Raya</option>
                            <option value="Masjid Besar" {{ old('topologi_masjid') == 'Masjid Besar' ? 'selected' : '' }}>Masjid Besar</option>
                            <option value="Masjid Kecil" {{ old('topologi_masjid') == 'Masjid Kecil' ? 'selected' : '' }}>Masjid Kecil</option>
                        </select>
                        @error('topologi_masjid')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kecamatan -->
                <div>
                    <label for="kecamatan" class="block text-sm font-medium text-gray-700">
                        Kecamatan
                    </label>
                    <div class="mt-1">
                        <input id="kecamatan" name="kecamatan" type="text" required maxlength="100"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('kecamatan') border-red-500 @enderror"
                            value="{{ old('kecamatan') }}">
                        @error('kecamatan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kabupaten -->
                <div>
                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">
                        Kabupaten/Kota
                    </label>
                    <div class="mt-1">
                        <input id="kabupaten" name="kabupaten" type="text" required maxlength="100"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('kabupaten') border-red-500 @enderror"
                            value="{{ old('kabupaten') }}">
                        @error('kabupaten')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">
                        Alamat Lengkap
                    </label>
                    <div class="mt-1">
                        <textarea id="alamat" name="alamat" required maxlength="500"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('alamat') border-red-500 @enderror"
                            rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <div class="mt-1">
                        <input id="username" name="username" type="text" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('username') border-red-500 @enderror"
                            value="{{ old('username') }}">
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Password
                    </label>
                    <div class="mt-1">
                        <input id="password-confirm" name="password_confirmation" type="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    </div>
                </div>

                <!-- Gambar Masjid -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">
                        Gambar Masjid
                    </label>
                    <div class="mt-1">
                        <input id="gambar" name="gambar" type="file" required accept="image/jpeg, image/png, image/jpg"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-indigo-100 @error('gambar') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG (Maks. 2MB)</p>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Surat Keterangan Tanah -->
                <div>
                    <label for="surat" class="block text-sm font-medium text-gray-700">
                        Surat Keterangan Tanah
                    </label>
                    <div class="mt-1">
                        <input id="surat" name="surat" type="file" required accept="application/pdf"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-indigo-100 @error('surat') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Format: PDF (Maks. 5MB)</p>
                        @error('surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ url('/') }}"
                        class="text-sm font-medium text-red-600 hover:text-green-500 mr-10">
                        Kembali
                    </a>

                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>