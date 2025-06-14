@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('partials.header')

<!-- Body -->
<main class="pt-28 md:pt-32 bg-gradient-to-b from-green-50 to-gray-50">
    <!-- Header Tentang DMI -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12 px-4 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 relative inline-block">
                <span class="relative z-10">Tentang DMI Jawa Tengah</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-white/30 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl">
                Profil dan informasi lengkap tentang Dewan Masjid Indonesia Provinsi Jawa Tengah
            </p>
        </div>
    </div>

    <!-- Konten utama -->
    <div class="container mx-auto px-4 md:px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="space-y-8">
                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <div class="md:w-1/3">
                        <div class="bg-green-100 p-6 rounded-xl h-full flex items-center justify-center">
                            <img src="{{ Vite::asset('resources/image/MasjidAgung.png') }}" alt="Masjid"
                                class="w-full h-auto max-h-48 object-contain">
                        </div>
                    </div>
                    <div class="md:w-2/3">
                        <h3 class="text-2xl font-bold text-green-700 mb-4">🕌 Dewan Masjid Indonesia (DMI)</h3>
                        <p class="text-gray-700 leading-relaxed text-lg">
                            Dewan Masjid Indonesia (DMI) adalah organisasi kemasyarakatan dan wahana komunikasi
                            pengelola masjid seluruh Indonesia yang melaksanakan gerakan dakwah, serta menjadikan masjid 
                            sebagai pusat kegiatan pembinaan aqidah, ibadah, akhlak, ukhuwah, keilmuan, keterampilan 
                            dan kesejahteraan umat.
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-green-100">
                        <h3 class="text-xl font-semibold text-green-700 mb-3">Visi & Misi</h3>
                        <p class="text-gray-700 text-lg">
                            Organisasi tingkat nasional dengan tujuan mewujudkan fungsi masjid sebagai pusat ibadah,
                            pengembangan masyarakat dan persatuan umat.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-green-100">
                        <h3 class="text-xl font-semibold text-green-700 mb-3">Sejarah</h3>
                        <p class="text-gray-700 text-lg">
                            Didirikan pada <span class="font-bold text-green-700">22 Juni 1972</span> untuk meningkatkan
                            keimanan, ketaqwaan, akhlaq mulia dan kecerdasan umat.
                        </p>
                    </div>
                </div>

                <div class="bg-green-50 p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-green-700 mb-3">Struktur Organisasi</h3>
                    <p class="text-gray-700 text-lg">
                        DMI mempunyai kepengurusan di setiap provinsi dan kabupaten/kota di Indonesia.
                        Pimpinan pusat DMI dipilih secara demokratis setiap lima tahun melalui muktamar.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer')