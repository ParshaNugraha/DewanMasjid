<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin')</title>
    {{-- Tambahkan ini supaya Vite inject CSS dan JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Dewan Masjid Admin
                </h1>

                <div class="flex items-center gap-4">
                    <span>👤 {{ auth()->user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Konten Utama -->
        <main class="flex-grow container mx-auto px-6 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white text-center text-sm text-gray-500 py-4 shadow-inner">
            &copy; {{ date('Y') }} Dewan Masjid Indonesia - Jateng
        </footer>

    </div>

</body>
</html>
