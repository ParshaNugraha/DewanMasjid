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

        <!-- Modal untuk gambar besar dengan fitur zoom dan pan -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300">
            <div class="relative max-w-6xl w-full max-h-[90vh] overflow-auto bg-white rounded-xl shadow-2xl">
                <button onclick="hideImageModal()" class="absolute top-4 right-4 bg-white/20 hover:bg-white/30 text-white text-2xl w-10 h-10 rounded-full flex items-center justify-center transition-all hover:rotate-90 z-50">
                    &times;
                </button>
                <div class="p-4">
                    <img id="modalImage" src="" alt="" class="w-full h-auto max-w-full cursor-move" style="transform-origin: 0 0">
                    <p id="modalCaption" class="text-center py-4 text-xl font-semibold text-gray-800 bg-white bg-opacity-90 backdrop-blur-sm"></p>
                </div>
            </div>
        </div>

        <script>
            let scale = 1;
            let posX = 0;
            let posY = 0;
            let isDragging = false;
            let startX, startY;

            function showImageModal(src, caption) {
                document.getElementById('modalImage').src = src;
                document.getElementById('modalCaption').textContent = caption;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Reset zoom dan posisi setiap kali modal dibuka
                scale = 1;
                posX = 0;
                posY = 0;
                updateImageTransform();
                
                // Tambahkan event listeners untuk zoom dan pan
                const img = document.getElementById('modalImage');
                img.addEventListener('wheel', handleWheel);
                img.addEventListener('mousedown', startDrag);
                img.addEventListener('mouseup', endDrag);
                img.addEventListener('mouseleave', endDrag);
                img.addEventListener('mousemove', drag);
            }

            function hideImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
                
                // Hapus event listeners
                const img = document.getElementById('modalImage');
                img.removeEventListener('wheel', handleWheel);
                img.removeEventListener('mousedown', startDrag);
                img.removeEventListener('mouseup', endDrag);
                img.removeEventListener('mouseleave', endDrag);
                img.removeEventListener('mousemove', drag);
            }

            function handleWheel(e) {
                e.preventDefault();
                const delta = -e.deltaY;
                
                // Batasi zoom antara 0.5x sampai 3x
                if (delta > 0 && scale < 3) {
                    scale *= 1.1;
                } else if (delta < 0 && scale > 0.5) {
                    scale *= 0.9;
                }
                
                updateImageTransform();
            }

            function startDrag(e) {
                isDragging = true;
                startX = e.clientX - posX;
                startY = e.clientY - posY;
            }

            function endDrag() {
                isDragging = false;
            }

            function drag(e) {
                if (!isDragging) return;
                e.preventDefault();
                posX = e.clientX - startX;
                posY = e.clientY - startY;
                updateImageTransform();
            }

            function updateImageTransform() {
                const img = document.getElementById('modalImage');
                img.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
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