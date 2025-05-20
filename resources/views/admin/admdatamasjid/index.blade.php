@vite(['resources/css/app.css', 'resources/js/app.js'])
@if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
        {{ session('success') }}
    </div>
@endif
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>
                <!-- Menu Navbar -->
    <nav id="main-nav" class="hidden md:flex w-full md:w-auto mt-4 md:mt-0">
        <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 w-full">
            <li class="md:mt-6">
                <a href='{{url('/')}}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Beranda</a>
            </li>
            <li class="md:mt-6">
                <a href='javascript:void(0)'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Berita</a>
            </li>
            <li class="md:mt-6">
                <a href='{{ url('/tentangdmi') }}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Tentang
                    DMI Jateng</a>
            </li>
            <li class="md:mt-6">
                <a href='{{url('/masjid')}}'
                    class="hover:text-green-700 text-green-800 block font-medium text-[15px] no-underline py-2 px-3 border-b-4 border-green-500">Data
                    Masjid</a>
            </li>
            <li class="md:mt-6">
                <a href='javascript:void(0)'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Pengurus</a>
            </li>

            <!-- Tombol Masuk & Daftar -->
            <li class="md:ml-4 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                @auth
                    <!-- Tampilkan informasi user yang login -->
                    <div class="top-4 left-4 bg-white p-2 rounded shadow z-50">
                        <p class="text-lg font-semibold text-green-700"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"
                                class="w-5 h-5 inline"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                            </svg> {{ auth()->user()->nama_takmir }}</p>
                        <p class="text-sm text-green-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-6 h-6 mr-2">
                                <path
                                    d="M400 0c5 0 9.8 2.4 12.8 6.4c34.7 46.3 78.1 74.9 133.5 111.5c0 0 0 0 0 0s0 0 0 0c5.2 3.4 10.5 7 16 10.6c28.9 19.2 45.7 51.7 45.7 86.1c0 28.6-11.3 54.5-29.8 73.4l-356.4 0c-18.4-19-29.8-44.9-29.8-73.4c0-34.4 16.7-66.9 45.7-86.1c5.4-3.6 10.8-7.1 16-10.6c0 0 0 0 0 0s0 0 0 0C309.1 81.3 352.5 52.7 387.2 6.4c3-4 7.8-6.4 12.8-6.4zM288 512l0-72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 72-48 0c-17.7 0-32-14.3-32-32l0-128c0-17.7 14.3-32 32-32l416 0c17.7 0 32 14.3 32 32l0 128c0 17.7-14.3 32-32 32l-48 0 0-72c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 72-64 0 0-58c0-19-8.4-37-23-49.2L400 384l-25 20.8C360.4 417 352 435 352 454l0 58-64 0zM70.4 5.2c5.7-4.3 13.5-4.3 19.2 0l16 12C139.8 42.9 160 83.2 160 126l0 2L0 128l0-2C0 83.2 20.2 42.9 54.4 17.2l16-12zM0 160l160 0 0 136.6c-19.1 11.1-32 31.7-32 55.4l0 128c0 9.6 2.1 18.6 5.8 26.8c-6.6 3.4-14 5.2-21.8 5.2l-64 0c-26.5 0-48-21.5-48-48L0 176l0-16z" />
                            </svg>
                            {{ auth()->user()->nama_masjid }}
                        </p>
                        </p>

                        <!-- Tombol Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button
                                class="w-full md:w-auto relative flex items-center px-6 py-2 overflow-hidden font-medium transition-all bg-red-700 rounded-md group">
                                <span
                                    class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-red-500 rounded group-hover:-mr-4 group-hover:-mt-4">
                                    <span
                                        class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span
                                    class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-red-500 rounded group-hover:-ml-4 group-hover:-mb-4">
                                    <span
                                        class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span
                                    class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-red-600 rounded-md group-hover:translate-x-0"></span>
                                <span
                                    class="relative w-full text-center text-white transition-colors duration-200 ease-in-out group-hover:text-white">Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </li>
        </ul>
    </nav>
</div>

<!-- Body -->
<div class="flex justify-center">
    <div class="w-full max-w-screen-lg shadow-lg shadow-green-800">
        <img src="{{ Vite::asset('resources/image/DMI-3.jpg') }}" alt="" class="py-40 px-5 pb-0.5">
        <!-- Jadwal Sholat start -->
        <div class="flex justify-center">
            <div class="w-full max-w-screen-lg bg-white rounded-lg p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl md:text-2xl font-bold text-green-700">Jadwal Sholat</h2>
                    <span class="text-sm md:text-base text-gray-500">Jumat, 24 Maret 2023</span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2 sm:gap-4 text-center">
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Subuh</h3>
                        <p class="text-sm sm:text-base text-gray-700">04:25</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Dzuhur</h3>
                        <p class="text-sm sm:text-base text-gray-700">11:50</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Ashar</h3>
                        <p class="text-sm sm:text-base text-gray-700">15:13</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Maghrib</h3>
                        <p class="text-sm sm:text-base text-gray-700">18:25</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Isya</h3>
                        <p class="text-sm sm:text-base text-gray-700">19:40</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-3 sm:p-5">
                        <h3 class="text-base sm:text-lg font-semibold text-green-600">Imsak</h3>
                        <p class="text-sm sm:text-base text-gray-700">04:15</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jadwal Sholat End -->
        <div class="flex justify-between items-center mb-4 ml-5">
            <h2 class="text-xl font-bold text-green-700">Data Masjid di Jawa Tengah</h2>
        </div>
        <!-- Tabel Start -->
        <div class="flex flex-col ml-5 mr-5 mb-5 shadow-sm shadow-zinc-800">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Masjid
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Gambar
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Tipologi Masjid</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tahun
                                        Berdiri</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                        Kecamatan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Kabupaten/Kota</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Alamat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Status
                                        Tanah</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Takmir
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($masjids as $index => $masjid)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $masjid->nama_masjid }}
                                        </td>
                                        <td>
                                            @if($masjid->gambar)
                                            <img src="{{ Vite::asset('storage/app/public/' . $masjid->gambar) }}" 
                                                    alt="Gambar {{ $masjid->nama_masjid }}"
                                                    class="h-16 w-auto object-cover rounded">
                                            @else
                                                <span class="text-gray-400">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">-</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $masjid->tahun }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">-</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">-</td>
                                        <td class="px-6 py-4">
                                            <div
                                                class="max-w-[200px] overflow-x-auto whitespace-nowrap [scrollbar-width:none] [-ms-overflow-style:none] [-webkit-overflow-scrolling:touch] [&::-webkit-scrollbar]:hidden">
                                                <span class="text-sm text-gray-800">-</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $masjid->status_tanah }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                            {{ $masjid->nama_takmir }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex items-center justify-center h-full">
                                            <a href="{{ route('users.edit', $masjid->id) }}"
                                                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $masjid->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabel End -->
    </div>
</div>


<!-- End Body -->
<!-- Footer Start -->
<footer class="bg-zinc-50 text-center dark:bg-green-700 lg:text-left">
    <div class="bg-black/5 p-4 text-center text-surface dark:text-white">
        © 2025
        <a href="https://tw-elements.com/">DMI Jawa Tengah</a>
    </div>
</footer>
<!-- Footer End -->