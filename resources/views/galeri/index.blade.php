@extends('partials.header')
<div class="pt-40 pb-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Judul Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3 relative inline-block">
                <span class="relative z-10">Galeri Dokumentasi</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-green-200/70 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg text-gray-600">
                Dokumentasi Kegiatan DMI Provinsi Jawa Tengah
            </p>
        </div>

        <!-- Search Form -->
        <div class="mb-8 max-w-md mx-auto">
            <form action="{{ route('galeri.search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari judul dokumentasi..." 
                           value="{{ request('search') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <button type="submit" class="absolute right-3 top-3 text-gray-500 hover:text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($galeris as $galeri)
            <div class="relative group overflow-hidden rounded-xl shadow-lg transition-all duration-500 hover:shadow-2xl">
                <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                     alt="{{ $galeri->judul }}"
                     class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105">
                
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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

        <!-- Pagination -->
        @if($galeris->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $galeris->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>
@extends('partials.footer')
