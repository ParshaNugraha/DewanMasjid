<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Superadmin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Sidebar -->
        <aside class="w-full md:w-72 bg-green-50 shadow-md flex flex-col md:h-screen p-6 md:fixed top-0 left-0 z-20">
            <h2 class="flex items-center text-2xl md:text-3xl font-bold text-green-800 mb-4 md:mb-6 space-x-3">
                <span>Superadmin</span>
                <svg class="w-6 h-6 md:w-7 md:h-7 text-green-600 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L8 6l4 4 4-4-4-4z" />
                    <path d="M8 6l-4 4 4 4 4-4-4-4z" />
                    <path d="M16 6l4 4-4 4-4-4 4-4z" />
                    <path d="M12 14l-4 4 4 4 4-4-4-4z" />
                </svg>
            </h2>

            <!-- Navigasi -->
            <nav class="flex flex-col gap-2 text-base md:text-lg font-semibold text-green-800 flex-grow">
                <a href="{{ route('superadmin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 md:py-3 rounded-md hover:bg-green-200 text-green-700 transition">
                    🏠 Beranda
                </a>
                <a href="{{ route('superadmin.masjids.index') }}" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200">🕌 Kelola Masjid & Admin</a>
                <a href="{{ route('superadmin.pendaftar.index') }}" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200 relative">
                    ✅ Verifikasi Admin
                    @if (!empty($pendingAdminCount) && $pendingAdminCount > 0)
                        <span class="absolute top-1 right-3 px-2 py-1 text-xs font-bold text-white bg-red-600 rounded-full">
                            {{ $pendingAdminCount }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('superadmin.berita.index') }}" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200">📰 Kelola Berita</a>
                <a href="{{ route('superadmin.pengurus.index') }}" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200">👤 Kelola Pengurus</a>
                <a href="#" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200">💰 Kelola Donasi</a>
                <a href="#" class="px-4 py-2 md:py-3 rounded-md hover:bg-green-200">🖼️ Kelola Galeri</a>
            </nav>
        </aside>

        <!-- Konten utama -->
        <div class="flex flex-col flex-grow min-h-screen md:ml-[18rem] transition-all duration-300">

            <!-- Header -->
            <header class="bg-green-50 shadow px-4 md:px-6 h-auto min-h-16 flex flex-wrap items-center justify-between gap-3 sticky top-0 z-10 border-b border-green-300 py-2">
                <div class="flex items-center gap-3">
                    <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="Logo" class="h-10 w-10 object-contain rounded-full">
                    <h1 class="text-lg md:text-2xl font-bold text-green-800 whitespace-nowrap">
                        Dewan Masjid Indonesia
                    </h1>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded text-sm md:text-base" type="submit">
                        Logout
                    </button>
                </form>
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
    </script>

</body>
</html>
