<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Superadmin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk mobile menu -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col md:flex-row" x-data="{ mobileMenuOpen: false }">

        <!-- Sidebar (Mobile & Desktop) -->
        <aside 
            class="w-full md:w-72 bg-green-50 shadow-md flex flex-col md:h-screen p-6 fixed top-0 left-0 z-20
                transform transition-transform duration-300 ease-in-out
                -translate-x-full md:translate-x-0"
            :class="{ 'translate-x-0': mobileMenuOpen || window.innerWidth >= 768 }"
            @keydown.window.escape="mobileMenuOpen = false"
            x-ref="sidebar"
        >
            <div class="flex items-center justify-between mb-4 md:mb-6">
                <h2 class="flex items-center text-2xl md:text-3xl font-bold text-green-800 space-x-3">
                    <span>Superadmin</span>
                    <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2L8 6l4 4 4-4-4-4z" />
                        <path d="M8 6l-4 4 4 4 4-4-4-4z" />
                        <path d="M16 6l4 4-4 4-4-4 4-4z" />
                        <path d="M12 14l-4 4 4 4 4-4-4-4z" />
                    </svg>
                </h2>
                <!-- Tombol close sidebar di mobile -->
                <button 
                    class="md:hidden text-green-800 hover:text-green-600 focus:outline-none absolute top-4 right-4"
                    style="position: absolute; top: 1rem; right: 1rem;"
                    @click="mobileMenuOpen = false"
                    aria-label="Tutup menu"
                >
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Navigasi -->
            @php
                $currentRoute = Route::currentRouteName();
            @endphp
            <nav class="flex flex-col gap-2 text-base md:text-lg font-semibold text-green-800 flex-grow">
                <a href="{{ route('superadmin.dashboard') }}"
                   class="flex items-center gap-2 px-4 py-2 md:py-3 rounded-md hover:bg-green-200 transition
                   {{ $currentRoute == 'superadmin.dashboard' ? 'bg-green-600 text-white' : 'text-green-700' }}">
                    🏠 Beranda
                </a>
                <a href="{{ route('superadmin.masjids.index') }}"
                   class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 transition
                   {{ str_starts_with($currentRoute, 'superadmin.masjids') ? 'bg-green-600 text-white' : '' }}">
                    🕌 Kelola Masjid & Admin
                </a>
                <a href="{{ route('superadmin.pendaftar.index') }}"
                   class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 relative transition
                   {{ str_starts_with($currentRoute, 'superadmin.pendaftar') ? 'bg-green-600 text-white' : '' }}">
                    ✅ Verifikasi Admin
                    @php
                        $pendingAdminCount = App\Models\User::where('role', 'admin')
                            ->where('status', 'pending')
                            ->count();
                    @endphp
                    @if($pendingAdminCount > 0)
                        <span class="absolute top-1 right-3 px-2 py-1 text-xs font-bold text-white bg-red-600 rounded-full">
                            {{ $pendingAdminCount }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('superadmin.berita.index') }}"
                   class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 transition
                   {{ str_starts_with($currentRoute, 'superadmin.berita') ? 'bg-green-600 text-white' : '' }}">
                    📰 Kelola Berita
                </a>
                <a href="{{ route('superadmin.pengurus.index') }}"
                   class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 transition
                   {{ str_starts_with($currentRoute, 'superadmin.pengurus') ? 'bg-green-600 text-white' : '' }}">
                    👤 Kelola Pengurus
                </a>
                <a href="{{ route('superadmin.galeri.index') }}"
                   class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 transition
                   {{ str_starts_with($currentRoute, 'superadmin.galeri') ? 'bg-green-600 text-white' : '' }}">
                    🖼️ Kelola Galeri
                </a>
            </nav>
        </aside>

        <!-- Tombol menu untuk mobile (dipindah ke kanan atas) -->
        <button 
            class="fixed top-4 right-4 z-30 md:hidden bg-green-600 text-white p-2 rounded shadow-lg focus:outline-none"
            @click="mobileMenuOpen = true"
            aria-label="Buka menu"
            type="button"
            x-show="!mobileMenuOpen"
        >
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Overlay untuk mobile sidebar -->
        <div 
            class="fixed inset-0 bg-gray-900 opacity-50 z-10 md:hidden"
            x-show="mobileMenuOpen && window.innerWidth < 768"
            @click="mobileMenuOpen = false"
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <!-- Konten utama -->
        <div class="flex flex-col flex-grow min-h-screen md:ml-72 transition-all duration-300">

            <!-- Header -->
            <header class="bg-green-50 shadow px-4 md:px-6 h-auto min-h-16 flex flex-wrap items-center justify-between gap-3 sticky top-0 z-10 border-b border-green-300 py-2">
                <div class="flex items-center gap-3">
                    <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="Logo" class="h-10 w-10 object-contain rounded-full">
                    <h1 class="text-lg md:text-2xl font-bold text-green-800 whitespace-nowrap">
                        Dewan Masjid Indonesia
                    </h1>
                </div>        
                <div class="flex items-center gap-2">
                    <a href="{{ url('/') }}" class="bg-green-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm md:text-base transition-colors duration-200">
                        Kembali ke Beranda
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded text-sm md:text-base" type="submit">
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- Konten halaman -->
            <main class="flex-grow p-4 md:p-6 overflow-y-auto transition-all duration-300">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')

    <script>
        // Force reflow saat resize supaya Tailwind md: class langsung aktif tanpa refresh
        window.addEventListener('resize', () => {
            document.documentElement.style.display = 'none';
            requestAnimationFrame(() => {
                document.documentElement.style.display = '';
            });
        });

        // Tutup sidebar jika resize ke desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                Alpine.store('mobileMenuOpen', false);
            }
        });

        // Inisialisasi sidebar saat pertama kali load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth >= 768) {
                Alpine.store('mobileMenuOpen', true);
            }
        });
    </script>

</body>
</html>