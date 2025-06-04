{{-- resources/views/layouts/superadmin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Superadmin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Dewan Masjid Superadmin
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

        <!-- Konten Utama dengan Sidebar -->
        <div class="flex flex-grow">

            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md p-6">
                <nav class="space-y-4">
                    <a href="" class="block text-green-700 font-semibold hover:underline">Beranda</a>
                    <a href="" class="block text-green-700 hover:underline">Data Masjid</a>
                    <a href="" class="block text-green-700 hover:underline">Pendaftaran Admin</a>
                    <a href="" class="block text-green-700 hover:underline">Manajemen User</a>
                </nav>
            </aside>

            <!-- Isi Konten -->
            <main class="flex-grow px-6 py-8">
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-zinc-50 text-center dark:bg-green-700">
            <div class="bg-black/5 p-4 text-center text-surface dark:text-white">
                © 2025 <a href="https://tw-elements.com/">DMI Jawa Tengah</a>
            </div>
        </footer>

    </div>

</body>
</html>
