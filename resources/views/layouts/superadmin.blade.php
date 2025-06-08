<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Superadmin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-800">

    <div class="min-h-screen flex">

        <!-- Sidebar fixed di kiri -->
        <aside class="w-72 bg-green-50 shadow-md flex flex-col h-screen p-6 fixed top-0 left-0 z-20">

            <!-- Tulisan Superadmin di atas menu dengan ketupat gantung -->
            <h2 class="flex items-center text-3xl font-bold text-green-800 mb-6 space-x-3">
                <span>Superadmin</span>
                <!-- Ikon ketupat gantung SVG -->
                <svg class="w-7 h-7 text-green-600 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L8 6l4 4 4-4-4-4z" />  <!-- atas -->
                    <path d="M8 6l-4 4 4 4 4-4-4-4z" />  <!-- kiri -->
                    <path d="M16 6l4 4-4 4-4-4 4-4z" />  <!-- kanan -->
                    <path d="M12 14l-4 4 4 4 4-4-4-4z" />  <!-- bawah -->
                </svg>
            </h2>

            <!-- Navigasi sidebar -->
            <nav class="flex flex-col gap-4 text-lg font-semibold text-green-800 flex-grow">
                <a href="{{ route('superadmin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-md hover:bg-green-200 text-green-700 transition-colors duration-200">
                    🏠 Beranda
                </a>
                <a href="#" class="block px-4 py-3 rounded-md hover:bg-green-200 cursor-pointer">🕌 Kelola Masjid & Admin</a>
                <a href="{{ route('superadmin.pendaftar.index') }}" class="block px-4 py-3 rounded-md hover:bg-green-200 cursor-pointer">
                ✅ Verifikasi Admin
                
                @if (!empty($pendingAdminCount) && $pendingAdminCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                    {{ $pendingAdminCount }}
                    </span>
                @endif
                </a>
                <a href="{{ route('superadmin.berita.index') }}" class="block px-4 py-3 rounded-md hover:bg-green-200 cursor-pointer">📰 Kelola Berita</a>
                <a href="#" class="block px-4 py-3 rounded-md hover:bg-green-200 cursor-pointer">👤 Kelola Pengurus</a>
                <a href="#" class="block px-4 py-3 rounded-md hover:bg-green-200 cursor-pointer">💰 Kelola Donasi</a>

            </nav>

        </aside>

        <!-- Konten utama (header + main) -->
        <div class="flex flex-col flex-grow min-h-screen ml-[18rem]">

            <!-- Header sticky di atas -->
            <header class="bg-green-50 shadow flex items-center justify-between px-6 h-16 sticky top-0 z-10 border-b border-green-300">
                <div class="flex items-center gap-4">
                    <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="Logo" class="h-12 w-12 object-contain rounded-full">
                    <h1 class="text-2xl font-bold text-green-800 whitespace-nowrap">
                        Dewan Masjid Indonesia
                    </h1>
                </div>
                <div class="flex items-center gap-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-green-600 hover:bg-green-800 text-white px-5 py-2 rounded" type="submit">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Konten utama -->
            <main class="flex-grow  p-6 overflow-auto rounded-md shadow-inner">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>
