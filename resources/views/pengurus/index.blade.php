@extends('partials.header')

<main class="pt-20 pb-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Judul Section -->
        <div class="text-center mb-8 mt-15">
            <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3 relative inline-block">
                <span class="relative z-10">Struktur Pengurus</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-green-200/70 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg text-gray-600">
                Dewan Masjid Indonesia Provinsi Jawa Tengah
            </p>
        </div>

        <!-- Gambar Pengurus dengan Efek Hover -->
        <div class="grid grid-cols-1 gap-8">
            @foreach($penguruses as $pengurus)
                <div class="relative group overflow-hidden rounded-xl shadow-xl transition-all duration-500 hover:shadow-2xl">
                    <img src="{{ asset('storage/' . $pengurus->gambar) }}" 
                         alt="Gambar Pengurus"
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

        <!-- Pagination dengan Styling -->
        <div class="mt-12 flex justify-center">
            {{ $penguruses->links('pagination::tailwind') }}
        </div>
    </div>
</main>

@extends('partials.footer')
