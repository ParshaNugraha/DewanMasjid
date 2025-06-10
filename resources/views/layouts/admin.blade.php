<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <!-- Logo dan Judul -->
        <div class="flex items-center gap-3 min-w-0">
            <img src="{{ Vite::asset('resources/image/logo-dmi.jpg') }}" alt="Logo" class="h-8 w-8 flex-shrink-0">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 whitespace-nowrap truncate">
                {{ auth()->user()->masjid->nama_masjid ?? 'Dashboard Admin' }}
                @if(auth()->user()->masjid && auth()->user()->masjid->topologi_masjid)
                    ({{ auth()->user()->masjid->topologi_masjid }})
                @endif
            </h1>
        </div>

<!-- Profil dan dropdown -->
<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open" class="flex items-center gap-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-500 rounded">
        <span class="text-sm font-medium select-none">👤 {{ auth()->user()->username }}</span>
        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z" />
        </svg>
    </button>

    <div
        x-show="open"
        x-transition
        class="absolute right-0 mt-2 w-44 bg-white rounded shadow-md z-10"
        style="display: none;"
    >
        <a href="{{ route('admin.password.change.form') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Ganti Kata Sandi
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                Logout
            </button>
        </form>
    </div>
</div>


    </div>
</header>


        <!-- Konten Utama -->
                           <main class="flex-grow max-w-screen-xl mx-auto px-6 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
    <footer class="bg-zinc-50 text-center dark:bg-green-700">
                    <div class="bg-black/5 p-4 text-center text-surface dark:text-white">
            © 2025 <a href="https://tw-elements.com/">DMI Jawa Tengah</a>
        </div>
    </footer>
    </div>

    <!-- Alpine.js untuk dropdown -->
    <script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>
