<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Ganti Kata Sandi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-green-600 text-white p-4 shadow">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Aplikasi Masjid - @yield('title')</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-50 text-center dark:bg-green-700">
        <div class="bg-black/5 p-4 text-center text-surface dark:text-white">
            © 2025 <a href="https://tw-elements.com/">DMI Jawa Tengah</a>
        </div>
    </footer>

</body>
</html>
