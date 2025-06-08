@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Header -->
<div
    class="flex flex-col md:flex-row items-center justify-between border px-4 md:px-10 py-4 shadow-lg shadow-green-800 bg-white fixed top-0 left-0 right-0 z-50">
    <!-- Logo dan Brand -->
    <div class="flex items-center justify-between w-full md:w-auto">
        <a href="{{ url('') }}" class="flex items-center">
            <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="" class="h-20 w-auto">
            <div class="ml-3">
                <h3 class="text-xl font-bold">
                    <span class="hidden md:inline">Dewan Masjid Indonesia</span><br>
                    <span class="block md:inline pb-5">Provinsi Jawa Tengah</span>
                </h3>
            </div>
        </a>

        <!-- Tombol Menu -->
        <button id="mobile-menu-button" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Menu Navbar -->
    <nav id="main-nav" class="hidden md:flex w-full md:w-auto mt-4 md:mt-0">
        <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 w-full">
            <li>
                <a href="{{ url('/') }}"
                    class="hover:text-green-700 text-green-800 block font-medium text-[15px] py-2 px-3 border-b-4 border-green-500">Beranda</a>
            </li>
            <li>
                <a href="{{ url('/berita') }}"
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Berita</a>
            </li>
            <li>
                <a href="{{ url('/tentangdmi') }}"
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Tentang DMI Jateng</a>
            </li>
            <li>
                <a href="{{ url('/masjid') }}"
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Data Masjid</a>
            </li>
            <li>
                <a href="{{ url('/pengurus') }}"
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Pengurus</a>
            </li>

            <!-- Tombol Masuk & Daftar -->
            <li class="md:ml-4 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                <a href="{{ url('/login') }}" class="block">
                    <button
                        class="w-full md:w-auto relative flex items-center px-6 py-2 overflow-hidden font-medium transition-all bg-green-500 rounded-md group">
                        <span
                            class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-green-700 rounded group-hover:-mr-4 group-hover:-mt-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-green-700 rounded group-hover:-ml-4 group-hover:-mb-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-green-600 rounded-md group-hover:translate-x-0"></span>
                        <span
                            class="relative w-full text-center text-white transition-colors duration-200 ease-in-out group-hover:text-white">Masuk</span>
                    </button>
                </a>

                <a href="{{ url('/daftar') }}" class="block">
                    <button
                        class="w-full md:w-auto relative flex items-center px-6 py-2 overflow-hidden font-medium transition-all bg-green-700 rounded-md group">
                        <span
                            class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-green-500 rounded group-hover:-mr-4 group-hover:-mt-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-green-500 rounded group-hover:-ml-4 group-hover:-mb-4">
                            <span
                                class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                        </span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-green-600 rounded-md group-hover:translate-x-0"></span>
                        <span
                            class="relative w-full text-center text-white transition-colors duration-200 ease-in-out group-hover:text-white">Daftar</span>
                    </button>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Body -->
<div class="flex justify-center mt-[96px]"> <!-- Tambah margin atas agar tidak tertutup header -->
    <div class="w-full max-w-screen-lg shadow-lg shadow-green-800 rounded-lg overflow-hidden bg-white">

        <!-- Konten Detail Masjid -->
        <div class="relative mt-5 mb-5 text-center" >

            <!-- Nama Masjid (overlay di atas gambar) -->
            <h1 class="absolute top-0 left-0 w-full text-4xl md:text-5xl font-bold text-green-800 bg-white bg-opacity-80 px-6 py-3 z-20">
                {{ $masjid->nama_masjid }}
            </h1>

            <!-- Gambar masjid -->
            @if ($masjid->gambar)
                <img src="{{ asset('storage/' . $masjid->gambar) }}"
                    alt="Gambar {{ $masjid->nama_masjid }}"
                    class="w-full h-auto max-h-[800px] mt-8 object-cover rounded-b-lg shadow relative z-10">
            @endif
        </div>

        <!-- Informasi masjid -->
        <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 text-lg">
            <div><strong>Tipologi Masjid:</strong> {{ $masjid->topologi_masjid }}</div>
            <div><strong>Tahun Berdiri:</strong> {{ $masjid->tahun }}</div>
            <div><strong>Kecamatan:</strong> {{ $masjid->kecamatan }}</div>
            <div><strong>Kabupaten/Kota:</strong> {{ $masjid->kabupaten }}</div>
            <div><strong>Status Tanah:</strong> {{ $masjid->status_tanah }}</div>
            <div><strong>Takmir:</strong> {{ $masjid->nama_takmir }}</div>
            <div><strong>Deskripsi:</strong> {{ $masjid->deskripsi }}</div>
            <div class="md:col-span-2">
                <strong>Alamat:</strong>
                <p class="mt-1">{{ $masjid->alamat }}</p>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="px-6 pb-6">
            <a href="{{ url()->previous() }}"
                class="inline-block px-5 py-3 bg-green-600 text-white rounded hover:bg-green-700 transition font-semibold text-lg">
                ← Kembali
            </a>
        </div>

    </div>
</div>

<!-- Footer Start -->
<footer class="bg-zinc-50 text-center dark:bg-green-700 lg:text-left">
    <div class="bg-black/5 p-4 text-center text-surface dark:text-white">
        © 2025
        <a href="https://tw-elements.com/">DMI Jawa Tengah</a>
    </div>
</footer>
<!-- Footer End -->
