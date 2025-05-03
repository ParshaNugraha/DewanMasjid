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
                    class="hover:text-green-700 text-slate-900 block font-medium text-[15px] no-underline py-2 px-3">Data
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
                    <span class="text-sm text-gray-500">Jumat, 24 Maret 2023</span>
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
        <!-- Profil Start -->
        <div
            class="flex flex-col md:flex-row items-center justify-center md:justify-start px-4 md:px-0 md:ml-10 gap-4 md:gap-10 mb-5">
            <!-- Profil 1 -->
            <div
                class="rounded-xl overflow-hidden relative text-center p-7 group items-center flex flex-col w-full max-w-sm hover:shadow-2xl transition-all duration-500 shadow-xl">
                <div class="text-gray-500 group-hover:scale-105 transition-all">
                    <svg class="w-16 h-16" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                            stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div class="group-hover:pb-10 transition-all duration-500 delay-200">
                    <h1 class="font-semibold text-gray-700">Nama</h1>
                    <p class="text-gray-500 text-sm">Ketua DMI</p>
                </div>
                <div
                    class="flex items-center transition-all duration-500 delay-200 group-hover:bottom-3 -bottom-full absolute gap-2 justify-evenly w-full">
                    <div
                        class="flex gap-3 text-2xl bg-green-700 text-white p-1 hover:p-2 transition-all duration-500 delay-200 rounded-full shadow-sm">
                        <a class="hover:scale-110 transition-all duration-500 delay-200">
                            <span class="text-white-700 font-semibold text-sm">PROFIL</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profil 2 -->
            <div
                class="rounded-xl overflow-hidden relative text-center p-7 group items-center flex flex-col w-full max-w-sm hover:shadow-2xl transition-all duration-500 shadow-xl">
                <div class="text-gray-500 group-hover:scale-105 transition-all">
                    <svg class="w-16 h-16" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                            stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </div>
                <div class="group-hover:pb-10 transition-all duration-500 delay-200">
                    <h1 class="font-semibold text-gray-700">Nama Lain</h1>
                    <p class="text-gray-500 text-sm">Jabatan Lain</p>
                </div>
                <div
                    class="flex items-center transition-all duration-500 delay-200 group-hover:bottom-3 -bottom-full absolute gap-2 justify-evenly w-full">
                    <div
                        class="flex gap-3 text-2xl bg-green-700 text-white p-1 hover:p-2 transition-all duration-500 delay-200 rounded-full shadow-sm">
                        <a class="hover:scale-110 transition-all duration-500 delay-200">
                            <span class="text-white-700 font-semibold text-sm">PROFIL</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="md:w-auto md:mr-10">
                <a href="https://maps.app.goo.gl/nEbpU9Cywkv7zyKY8"
                    class="relative bg-green-500 rounded-xl p-6 flex flex-col justify-center w-full min-w-[300px] md:min-w-[350px] max-w-lg shadow-lg transition-all duration-500 hover:scale-105 hover:shadow-2xl group">
                    <div class="flex items-start">
                        <div class="flex-1">
                            <h2
                                class="text-white font-bold text-lg mb-1 transition-all duration-500 group-hover:tracking-wide">
                                Masjid Agung Jawa Tengah</h2>
                            <p class="text-white text-base transition-all duration-500 group-hover:pl-2">Jalan Gajah
                                Raya, Komplek Masjid Agung Jawa Tengah (MAJT) Kota Semarang</p>
                        </div>
                        <div
                            class="absolute -top-6 -right-6 transition-all duration-500 group-hover:-top-8 group-hover:-right-8">
                            <div
                                class="bg-white rounded-full w-20 h-20 flex items-center justify-center shadow-md transition-all duration-500 group-hover:scale-110">
                                <svg class="w-8 h-8 text-green-500 transition-all duration-500 group-hover:text-green-700"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21s-6-5.686-6-10A6 6 0 1118 11c0 4.314-6 10-6 10z" />
                                    <circle cx="12" cy="11" r="2.5" fill="currentColor" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Profil End -->

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