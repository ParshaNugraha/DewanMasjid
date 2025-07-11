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
                            <span class="block">DEWAN MASJID INDONESIA</span>
                            <span class="block text-sm">PROVINSI JAWA TENGAH</span>
                        </h3>
                    </div>
                </a>
            </div>

            @if(session('success'))
                <!-- Notifikasi untuk status sukses -->
                <div
                    class="fixed top-4 right-4 z-50 p-4 bg-green-50 border border-green-200 text-green-600 rounded-lg shadow-lg transform transition-all duration-300 opacity-0 translate-y-2">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <!-- Notifikasi untuk status error -->
                <div
                    class="fixed top-4 right-4 z-50 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg shadow-lg transform transition-all duration-300 opacity-0 translate-y-2">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const notifications = document.querySelectorAll('.fixed.top-4.right-4');

                    notifications.forEach(notification => {
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
                });
            </script>

            <!-- TENGAH: Menu Navbar (Hidden di Mobile) -->
            <nav class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('/') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    BERANDA
                </a>
                <a href="{{ url('/berita') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('berita*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    BERITA
                </a>
                <a href="{{ url('/tentangdmi') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('tentangdmi*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    TENTANG DMI JATENG
                </a>
                <a href="{{ url('/masjid') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('masjid*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    DATA MASJID
                </a>
                <a href="{{ url('/pengurus') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('pengurus*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    PENGURUS
                </a>
                <a href="{{ url('/galeri') }}"
                    class="px-1 transition-colors duration-200 {{ request()->is('galeri*') ? 'text-green-800 font-semibold border-b-2 border-green-500' : 'text-gray-600 hover:text-green-700' }}">
                    GALERI
                </a>
            </nav>

            <!-- KANAN: Tombol Login & Daftar / Dashboard -->
            <div class="hidden md:flex items-center space-x-2">
                @guest
                    <button onclick="showLoginPopup()"
                        class="flex items-center gap-2 bg-gradient-to-r from-green-400 to-green-500 text-white px-5 py-2.5 rounded-lg hover:from-green-500 hover:to-green-600 transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        MASUK
                    </button>
                    <button onclick="showRegisterPopup()"
                        class="flex items-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white px-5 py-2.5 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        DAFTAR
                    </button>
                @endguest
                @auth
                    <div class="flex items-center space-x-2">
                        <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}"
                            class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-600 text-white px-5 py-2.5 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            DASHBOARD
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-600 text-white px-5 py-2.5 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                KELUAR
                            </button>
                        </form>
                    </div>
                @endauth
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
        <div id="mobile-menu" class="hidden md:hidden bg-white px-4 pb-4 shadow-lg rounded-b-lg">
            <ul class="space-y-3">
                <li>
                    <a href="{{ url('/') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('/') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-home mr-2"></i> BERANDA
                    </a>
                </li>
                <li>
                    <a href="{{ url('/berita') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('berita*') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-newspaper mr-2"></i> BERITA
                    </a>
                </li>
                <li>
                    <a href="{{ url('/tentangdmi') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('tentangdmi*') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-info-circle mr-2"></i> TENTANG DMI JATENG
                    </a>
                </li>
                <li>
                    <a href="{{ url('/masjid') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('masjid*') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-mosque mr-2"></i> DATA MASJID
                    </a>
                </li>
                <li>
                    <a href="{{ url('/pengurus') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('pengurus*') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-users mr-2"></i> PENGURUS
                    </a>
                </li>
                <li>
                    <a href="{{ url('/galeri') }}"
                        class="block py-2 px-3 rounded-lg transition-colors {{ request()->is('galeri*') ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-600 hover:bg-green-50' }}">
                        <i class="fas fa-images mr-2"></i> GALERI
                    </a>
                </li>
                <li class="pt-2 border-t border-gray-100">
                    @guest
                        <button onclick="showLoginPopup()" 
                            class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors text-base font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span>MASUK</span>
                        </button>
                    @endguest
                    @auth
                        <a href="{{ Auth::user()->role === 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}"
                            class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors text-base font-medium">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span>DASHBOARD</span>
                        </a>
                    @endauth
                </li>
                <li>
                    @guest
                        <button onclick="showRegisterPopup()"
                            class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors text-base font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span>DAFTAR</span>
                        </button>
                    @endguest
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors text-base font-medium">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                <span>KELUAR</span>
                            </button>
                        </form>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
    <!-- Popup Overlay -->
    <div id="popup-overlay" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden">
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