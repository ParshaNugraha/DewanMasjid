@extends('partials.header')
<main class="pt-28 md:pt-32 bg-gradient-to-b from-green-50 to-gray-50">
    <!-- Judul Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12 px-4 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 relative inline-block">
                <span class="relative z-10">Galeri Dokumentasi</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-white/30 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl">
                Dokumentasi Kegiatan DMI Provinsi Jawa Tengah
            </p>
        </div>
    </div>
    <div class="container mx-auto px-4 pt-5">
        <!-- Search Form -->
        <div class="mb-8 max-w-md mx-auto">
            <form action="{{ route('galeri.search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari judul dokumentasi..."
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

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-5">
            @forelse ($galeris as $galeri)
                <div class="relative group overflow-hidden rounded-xl shadow-lg transition-all duration-500 hover:shadow-2xl cursor-pointer" onclick="event.stopPropagation(); showImageModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ $galeri->judul ?? 'Galeri Kegiatan' }}')">
                    <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                         alt="{{ $galeri->judul ?? 'Galeri Kegiatan' }}" 
                         class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent flex items-end p-4">
                        <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                            @if($galeri->judul)
                                <h3 class="text-lg font-bold mb-1 text-shadow-md shadow-black/50">{{ $galeri->judul }}</h3>
                            @endif
                            <p class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 [text-shadow:_0_1px_0_rgb(0_0_0_/_40%)]">
                                {{ $galeri->created_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="mt-4 text-lg text-gray-500">
                        @if(request('search'))
                            Dokumentasi tidak ditemukan untuk pencarian "{{ request('search') }}"
                        @else
                            Belum ada dokumentasi di galeri
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Modal untuk gambar besar -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300">
            <div class="relative max-w-4xl w-full bg-white rounded-xl overflow-hidden shadow-2xl transform transition-all duration-300 scale-95 group-hover:scale-100">
                <button onclick="hideImageModal()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/30 text-white text-2xl w-10 h-10 rounded-full flex items-center justify-center transition-all hover:rotate-90">
                    &times;
                </button>
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain transition-transform duration-500 group-hover:scale-105">
                <p id="modalCaption" class="text-center py-4 text-xl font-semibold text-gray-800 bg-white bg-opacity-90 backdrop-blur-sm"></p>
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

            // Tutup modal saat klik di luar gambar
            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideImageModal();
                }
            });
        </script>

        <!-- Pagination -->
        @if($galeris->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $galeris->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</main>
@extends('partials.footer')