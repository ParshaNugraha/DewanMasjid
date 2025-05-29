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
                    class="hover:text-green-700 text-green-800 block font-medium text-[15px] py-2 px-3 border-b-4 border-green-500">Beranda</a>
            </li>
            <li>
                <a href='{{ url('/berita') }}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Berita</a>
            </li>
            <li>
                <a href='{{ url('/tentangdmi') }}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Tentang
                    DMI Jateng</a>
            </li>
            <li>
                <a href='{{url('/masjid')}}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Data
                    Masjid</a>
            </li>
            <li>
                <a href='{{ url('/pengurus') }}'
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Pengurus</a>
            </li>

            <!-- Tombol Masuk & Daftar -->
            <li class="md:ml-4 flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                <a href='{{url('/login')}}' class="block">
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

                <a href='{{url('/daftar')}}' class="block">
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

<!-- End Header -->
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

            <div class="relative">
                <!-- Container untuk berita dengan scroll horizontal -->
                <div id="news-scroll-container"
                    class="flex overflow-x-auto pb-6 snap-x snap-mandatory whitespace-nowrap space-x-4 scrollbar-hide"
                    style="cursor: grab; scroll-behavior: smooth;" onmousedown="handleMouseDown(event)"
                    onmousemove="handleMouseMove(event)" onmouseup="handleMouseUp()" onmouseleave="handleMouseUp()"
                    ontouchstart="handleTouchStart(event)" ontouchmove="handleTouchMove(event)"
                    ontouchend="handleTouchEnd()">

                    <!-- Card Berita 1 -->
                    <div
                        class="snap-start flex-shrink-0 w-72 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 whitespace-normal">
                        <img src="https://via.placeholder.com/600x400" alt="Gambar Berita"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span
                                class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">DMI
                                Jateng</span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-800 truncate">Judul Berita Pertama</h3>
                            <p class="mt-2 text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div class="mt-3 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Penulis" class="w-8 h-8 rounded-full">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">John Doe</p>
                                    <p class="text-xs text-gray-500">2 jam lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Berita 2 -->
                    <div
                        class="snap-start flex-shrink-0 w-72 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 whitespace-normal">
                        <img src="https://via.placeholder.com/600x400" alt="Gambar Berita"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span
                                class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">DMI
                                Jateng</span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-800 truncate">Judul Berita Kedua</h3>
                            <p class="mt-2 text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div class="mt-3 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Penulis" class="w-8 h-8 rounded-full">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Jane Smith</p>
                                    <p class="text-xs text-gray-500">Kemarin</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Berita 3 -->
                    <div
                        class="snap-start flex-shrink-0 w-72 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 whitespace-normal">
                        <img src="https://via.placeholder.com/600x400" alt="Gambar Berita"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span
                                class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">DMI
                                Jateng</span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-800 truncate">Judul Berita Ketiga</h3>
                            <p class="mt-2 text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div class="mt-3 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Penulis" class="w-8 h-8 rounded-full">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Ahmad Budi</p>
                                    <p class="text-xs text-gray-500">3 hari lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Berita 4 -->
                    <div
                        class="snap-start flex-shrink-0 w-72 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 whitespace-normal">
                        <img src="https://via.placeholder.com/600x400" alt="Gambar Berita"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span
                                class="inline-block px-2 py-1 bg-cyan-100 text-cyan-800 rounded-full text-xs font-semibold">DMI
                                Jateng</span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-800 truncate">Judul Berita Keempat</h3>
                            <p class="mt-2 text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div class="mt-3 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Penulis" class="w-8 h-8 rounded-full">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Budi Santoso</p>
                                    <p class="text-xs text-gray-500">1 minggu lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Berita 5 -->
                    <div
                        class="snap-start flex-shrink-0 w-72 bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 whitespace-normal">
                        <img src="https://via.placeholder.com/600x400" alt="Gambar Berita"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span
                                class="inline-block px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">DMI
                                Jateng</span>
                            <h3 class="mt-2 text-lg font-semibold text-gray-800 truncate">Judul Berita Kelima</h3>
                            <p class="mt-2 text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit.</p>
                            <div class="mt-3 flex items-center">
                                <img src="https://via.placeholder.com/30" alt="Penulis" class="w-8 h-8 rounded-full">
                                <div class="ml-2">
                                    <p class="text-xs font-medium text-gray-700">Dewi Lestari</p>
                                    <p class="text-xs text-gray-500">2 minggu lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

