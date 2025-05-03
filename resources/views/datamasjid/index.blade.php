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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <!-- Menu Navbar -->
    <nav id="main-nav" class="hidden md:flex w-full md:w-auto mt-4 md:mt-0">
        <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 w-full">
            <li>
                <a href='{{url('/')}}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] py-2 px-3">Beranda</a>
            </li>
            <li>
                <a href='javascript:void(0)'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Berita</a>
            </li>
            <li>
                <a href='javascript:void(0)'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Tentang
                    DMI Jateng</a>
            </li>
            <li>
                <a href='{{url('/masjid')}}'
                    class="hover:text-green-700 text-green-800 block font-medium text-[15px] py-2 px-3 border-b-4 border-green-500">Data
                    Masjid</a>
            </li>
            <li>
                <a href='javascript:void(0)'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Pengurus</a>
            </li>

            <!-- Tombol Masuk & Daftar -->
            <li class="md:ml-4 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                <a href='https://www.youtube.com/' class="block">
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

                <a href='javascript:void(0)' class="block">
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
<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('main-nav');
        menu.classList.toggle('hidden');
    });
</script>
<!-- End Header -->

<!-- Body -->
<div class="flex justify-center">
    <div class="w-full max-w-screen-lg shadow-lg shadow-green-800">
        <img src="{{ Vite::asset('resources/image/DMI-3.jpg') }}" alt="" class="py-40 px-5 pb-0.5">
        <!-- Jadwal Sholat start -->
        <div class="flex justify-center mt-10">
            <div class="w-full max-w-screen-lg bg-white rounded-lg p-5">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-green-700">Jadwal Sholat</h2>
                    <span class="text-sm text-gray-500">Sabtu, 3 Mei 2025</span>
                </div>
                <div class="grid grid-cols-6 gap-4 text-center">
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Subuh</h3>
                        <p class="text-gray-700">04:25</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Dzuhur</h3>
                        <p class="text-gray-700">11:50</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Ashar</h3>
                        <p class="text-gray-700">15:13</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Maghrib</h3>
                        <p class="text-gray-700">18:25</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Isya</h3>
                        <p class="text-gray-700">19:40</p>
                    </div>
                    <div class="shadow shadow-gray-500 rounded-2xl p-5">
                        <h3 class="text-lg font-semibold text-green-600">Imsak</h3>
                        <p class="text-gray-700">04:15</p>
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
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Masjid
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Gambar
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Tipologi Masjid
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tahun
                                        Berdiri
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                        Kecamatan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                        Kabupaten/Kota
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Alamat
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Status
                                        Tanah
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Takmir
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">1.
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Masjid Agung</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Masjid Besar</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">2001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Gayamsari</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Kota Semarang</td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="max-w-[200px] overflow-x-auto whitespace-nowrap [scrollbar-width:none] [-ms-overflow-style:none] [-webkit-overflow-scrolling:touch] [&::-webkit-scrollbar]:hidden">
                                            <span class="text-sm text-gray-800">
                                                Jl. Gajah Raya, Kelurahan Sambirejo, Kecamatan Gayamsari, Kota Semarang
                                                Jawa Tengah
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Wakaf</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex items-center justify-center h-full">

                                        <button
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                            type="button">
                                            Edit
                                        </button>
                                        <br>
                                        <button
                                            class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                            type="button">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <tr class="odd:bg-white even:bg-green-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">2.
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Masjid Baiturrahman</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Masjid Besar</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">1974</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Semarang Tengah</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Kota Semarang</td>
                                    <td class="px-6 py-4">
                                        <div
                                            class="max-w-[200px] overflow-x-auto whitespace-nowrap [scrollbar-width:none] [-ms-overflow-style:none] [-webkit-overflow-scrolling:touch] [&::-webkit-scrollbar]:hidden">
                                            <span class="text-sm text-gray-800">
                                            Jl. Pandanaran 126 Semarang
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Wakaf</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"></td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex items-center justify-center h-full">

                                        <button
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                            type="button">
                                            Edit
                                        </button>
                                        <br>
                                        <button
                                            class="text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                            type="button">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
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