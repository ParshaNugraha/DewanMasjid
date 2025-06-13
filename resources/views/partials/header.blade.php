<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMI Jawa Tengah</title>    
    <!-- Load Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- HEADER -->
    <div class="fixed top-0 left-0 right-0 z-50 bg-white shadow-lg shadow-green-800">
        <div class="flex items-center justify-between px-4 md:px-8 py-3 md:py-5">
            <!-- KIRI: Logo dan Teks -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('') }}" class="flex items-center">
                    <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="" class="h-16 md:h-20 w-auto">
                    <div class="ml-2 md:ml-3">
                        <h3 class="text-sm md:text-xl font-bold">
                            <span class="block">Dewan Masjid Indonesia</span>
                            <span class="block text-sm">Provinsi Jawa Tengah</span>
                        </h3>
                    </div>
                </a>
            </div>

            <!-- TENGAH: Menu Navbar (Hidden di Mobile) -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('/') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Beranda
                </a>
                <a href="{{ url('/berita') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('berita*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Berita
                </a>
                <a href="{{ url('/tentangdmi') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('tentangdmi*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Tentang DMI Jateng
                </a>
                <a href="{{ url('/masjid') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('masjid*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Data Masjid
                </a>
                <a href="{{ url('/pengurus') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('pengurus*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Pengurus
                </a>
                <a href="{{ url('/galeri') }}" 
                   class="px-1 transition-colors duration-200 {{ request()->is('galeri*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    Galeri
                </a>
            </nav>

            <!-- KANAN: Tombol Login & Daftar -->
            <div class="hidden md:flex items-center space-x-2">
                <a href="{{ url('/login') }}">
                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-200">Masuk</button>
                </a>
                <a href="{{ url('/daftar') }}">
                    <button class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition-colors duration-200">Daftar</button>
                </a>
            </div>

            <!-- Mobile Button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none" onclick="toggleMobileMenu()">
                <svg class="w-8 h-8 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white px-4 pb-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ url('/') }}" 
                       class="block py-2 {{ request()->is('/') ? 'text-green-800 font-semibold' : 'text-gray-600' }}">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ url('/berita') }}" 
                       class="block py-2 {{ request()->is('berita*') ? 'text-green-800 font-semibold' : 'text-gray-600' }}">
                        Berita
                    </a>
                </li>
                <li>
                    <a href="{{ url('/tentangdmi') }}" 
                       class="block py-2 {{ request()->is('tentangdmi*') ? 'text-green-800 font-semibold' : 'text-gray-600' }}">
                        Tentang DMI Jateng
                    </a>
                </li>
                <li>
                    <a href="{{ url('/masjid') }}" 
                       class="block py-2 {{ request()->is('masjid*') ? 'text-green-800 font-semibold' : 'text-gray-600' }}">
                        Data Masjid
                    </a>
                </li>
                <li>
                    <a href="{{ url('/pengurus') }}" 
                       class="block py-2 {{ request()->is('pengurus*') ? 'text-green-800 font-semibold' : 'text-gray-600' }}">
                        Pengurus
                    </a>
                </li>
                <li>
                    <a href="{{ url('/login') }}" 
                       class="block py-2 {{ request()->is('login*') ? 'text-green-800 font-semibold' : 'text-green-600' }}">
                        Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ url('/daftar') }}" 
                       class="block py-2 {{ request()->is('daftar*') ? 'text-green-800 font-semibold' : 'text-green-700' }}">
                        Daftar
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html>