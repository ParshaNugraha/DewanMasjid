<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMI Jawa Tengah</title>
    <!-- Load Vite CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
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

            @if(session('success'))
                <!-- Notifikasi untuk status sukses setelah registrasi -->
                <div
                    class="fixed top-4 right-4 z-50 p-4 bg-green-50 border border-green-200 text-green-600 rounded-lg shadow-lg transform transition-all duration-300 opacity-0 translate-y-2">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const notification = document.querySelector('.fixed.top-4.right-4');

                        // Tampilkan notifikasi
                        setTimeout(() => {
                            notification.classList.remove('opacity-0', 'translate-y-2');
                            notification.classList.add('opacity-100', 'translate-y-0');
                        }, 100);

                        // Sembunyikan setelah 5 detik
                        setTimeout(() => {
                            notification.classList.remove('opacity-100', 'translate-y-0');
                            notification.classList.add('opacity-0', 'translate-y-2');

                            setTimeout(() => {
                                notification.remove();
                            }, 300);
                        }, 5000);
                    });
                </script>
            @endif

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
                <button onclick="showLoginPopup()"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-200">Masuk</button>
                <button onclick="showRegisterPopup()"
                    class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition-colors duration-200">Daftar</button>
            </div>

            <!-- Mobile Button -->
            <button id="mobile-menu-button" class="md:hidden focus:outline-none" onclick="toggleMobileMenu()">
                <svg class="w-8 h-8 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
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
                    <button onclick="showLoginPopup()" class="block py-2 text-green-600 w-full text-left">Masuk</button>
                </li>
                <li>
                    <button onclick="showRegisterPopup()"
                        class="block py-2 text-green-700 w-full text-left">Daftar</button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Popup Overlay -->
    <div id="popup-overlay"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden transition-opacity duration-300">
        <!-- Login Popup -->
        <div id="login-popup"
            class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 hidden transform transition-all duration-300">
            @include('users.login')
        </div>

        <!-- Register Popup -->
        <div id="register-popup"
            class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 hidden transform transition-all duration-300">
            @include('users.create')
        </div>
    </div>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Popup functions
        function showLoginPopup() {
            const overlay = document.getElementById('popup-overlay');
            const loginPopup = document.getElementById('login-popup');
            const registerPopup = document.getElementById('register-popup');

            overlay.classList.remove('hidden');
            registerPopup.classList.add('hidden');
            loginPopup.classList.remove('hidden');

            // Trigger animation
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                loginPopup.classList.remove('opacity-0', 'scale-95');
                loginPopup.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function showRegisterPopup() {
            const overlay = document.getElementById('popup-overlay');
            const loginPopup = document.getElementById('login-popup');
            const registerPopup = document.getElementById('register-popup');

            overlay.classList.remove('hidden');
            loginPopup.classList.add('hidden');
            registerPopup.classList.remove('hidden');

            // Trigger animation
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                registerPopup.classList.remove('opacity-0', 'scale-95');
                registerPopup.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function hidePopup() {
            const overlay = document.getElementById('popup-overlay');
            const loginPopup = document.getElementById('login-popup');
            const registerPopup = document.getElementById('register-popup');

            // Trigger animation
            overlay.classList.add('opacity-0');
            loginPopup.classList.add('opacity-0', 'scale-95');
            registerPopup.classList.add('opacity-0', 'scale-95');

            // Hide after animation
            setTimeout(() => {
                overlay.classList.add('hidden');
                loginPopup.classList.add('hidden');
                registerPopup.classList.add('hidden');
            }, 300);
        }

        // Close popup when clicking outside
        document.getElementById('popup-overlay').addEventListener('click', function (e) {
            if (e.target === this) {
                hidePopup();
            }
        });
    </script>
</body>

</html>