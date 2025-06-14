@extends('partials.header')
<!-- Body -->
<main class="pt-28 md:pt-32 pb-40 bg-gradient-to-b from-green-50 to-gray-50">
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12 px-4 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 relative inline-block">
                <span class="relative z-10">Data Masjid Provinsi Jawa Tengah</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-white/30 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl">
                Daftar lengkap masjid yang terdaftar di DMI Jawa Tengah
            </p>
        </div>
    </div>
    <div class="container mx-auto px-4 pt-5">
        <!-- Search Form -->
        <div class="mb-8 max-w-md mx-auto">
            <form action="{{ route('datamasjid.search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari Masjid"
                        value="{{ request('search') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <button type="submit" class="absolute right-3 top-3 text-gray-500 hover:text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel untuk menampilkan daftar masjid -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-green-100/50">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200/60">
                            <table class="min-w-full divide-y divide-gray-200/60 border-x border-gray-200/60">
                                <thead class="bg-gradient-to-r from-green-600 to-emerald-500">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            No</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            Masjid</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            Gambar</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            Tipologi</th>
                                        <th
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            Tahun</th>
                                        <th
                                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider border-r border-white/30">
                                            Kecamatan</th>
                                        <th
                                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                            Kabupaten/Kota</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200/30">
                                    @foreach($masjids as $index => $masjid)
                                        <tr onclick="window.location='{{ route('datamasjid.show', $masjid) }}'"
                                            class="cursor-pointer hover:bg-green-50/50 transition duration-200 even:bg-gray-50/30">

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-200/40">
                                                <span
                                                    class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-800">
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200/40">
                                                <div
                                                    class="text-sm font-semibold text-green-700 hover:text-green-600 transition-colors">
                                                    {{ $masjid->nama_masjid }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">{{ $masjid->alamat }}</div>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200/40">
                                                @if($masjid->gambar)
                                                    <button
                                                        onclick="event.stopPropagation(); showImageModal('{{ Vite::asset('storage/app/public/' . $masjid->gambar) }}', '{{ $masjid->nama_masjid }}')"
                                                        class="group relative">
                                                        <img src="{{ Vite::asset('storage/app/public/' . $masjid->gambar) }}"
                                                            alt="Gambar {{ $masjid->nama_masjid }}"
                                                            class="h-16 w-16 object-cover rounded-lg hover:opacity-80 transition-all shadow-md group-hover:shadow-lg">
                                                        <span
                                                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                            </svg>
                                                        </span>
                                                    </button>
                                                @else
                                                    <span class="text-gray-400 text-sm italic">Tidak ada gambar</span>
                                                @endif
                                            </td>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 border-r border-gray-200/40">
                                                <span
                                                    class="px-2 py-1 bg-gradient-to-r from-green-100 to-emerald-50 text-green-800 rounded-full text-xs font-medium shadow-sm">
                                                    {{ $masjid->topologi_masjid }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium border-r border-gray-200/40">
                                                {{ $masjid->tahun }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-center border-r border-gray-200/40">
                                                <span
                                                    class="bg-gray-100 px-2 py-1 rounded-md">{{ $masjid->kecamatan }}</span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-center font-medium">
                                                <span
                                                    class="bg-green-50 px-2 py-1 rounded-md text-green-700">{{ $masjid->kabupaten }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Gambar -->
        <div id="imageModal"
            class="hidden fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300">
            <div
                class="relative max-w-4xl w-full bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all duration-300 scale-95 group-hover:scale-100">
                <button onclick="hideImageModal()"
                    class="absolute top-4 right-4 bg-white/20 hover:bg-white/30 text-white text-2xl w-10 h-10 rounded-full flex items-center justify-center transition-all hover:rotate-90">
                    &times;
                </button>
                <img id="modalImage" src="" alt=""
                    class="w-full h-auto max-h-[80vh] object-contain transition-transform duration-500 group-hover:scale-105">
                <p id="modalCaption"
                    class="text-center py-4 text-xl font-semibold text-gray-800 bg-white bg-opacity-90 backdrop-blur-sm">
                </p>
            </div>
        </div>

        <script>
            function showImageModal(src, caption) {
                document.getElementById('modalImage').src = src;
                document.getElementById('modalCaption').textContent = caption;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function hideImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        </script>
    </div>
</main>

@extends('partials.footer')