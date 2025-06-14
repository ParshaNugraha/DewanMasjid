@extends('partials.header')

<main class="pt-28 md:pt-32 bg-gradient-to-b from-green-50 to-gray-50">
    <!-- Judul Section -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12 px-4 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 relative inline-block">
                <span class="relative z-10">Struktur Pengurus</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-white/30 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl">
                Dewan Masjid Indonesia Provinsi Jawa Tengah
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4 pt-5">
        <!-- Gambar Pengurus dengan Efek Hover -->
        <div class="grid grid-cols-1 gap-8">
            @foreach($penguruses as $pengurus)
                <div class="relative group overflow-hidden rounded-xl shadow-xl transition-all duration-500 hover:shadow-2xl cursor-pointer" 
                     onclick="event.stopPropagation(); showImageModal('{{ asset('storage/' . $pengurus->gambar) }}', 'Struktur Organisasi - Periode {{ $pengurus->periode ?? '2023-2028' }}')">
                    <img src="{{ asset('storage/' . $pengurus->gambar) }}" alt="Gambar Pengurus"
                        class="w-full h-[900px] object-cover object-center transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent flex items-end p-6">
                        <div class="text-white transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                            <h3 class="text-xl font-bold mb-1 text-shadow-md shadow-black/50">Struktur Organisasi</h3>
                            <p class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 [text-shadow:_0_1px_0_rgb(0_0_0_/_40%)]">
                                Periode {{ $pengurus->periode ?? '2023-2028' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
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

        <!-- Pagination dengan Styling -->
        <div class="mt-12 flex justify-center">
            {{ $penguruses->links('pagination::tailwind') }}
        </div>
    </div>
</main>

@extends('partials.footer')