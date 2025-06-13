@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('partials.header')

<!-- Body -->
<main class="pt-28 md:pt-32 bg-gradient-to-b from-green-50 to-gray-50">
    <section class="relative h-[70vh] max-h-[800px] overflow-hidden">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <img src="{{ Vite::asset('resources/image/DMI-3.jpg') }}" alt="DMI Jawa Tengah" 
             class="w-full h-full object-cover object-center">
        
        <div class="absolute inset-0 z-20 flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate-fade-in-down">
                Dewan Masjid Indonesia
            </h1>
            <h2 class="text-2xl md:text-4xl font-semibold text-white mb-6 animate-fade-in-down delay-100">
                Provinsi Jawa Tengah
            </h2>
    </section>
            
            <!-- Jadwal Sholat Section -->
            <div class="bg-white rounded-lg p-6 mx-4 -mt-8 relative z-10 shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-green-700 mb-2 md:mb-0">Jadwal Sholat</h2>
                    <span class="text-base bg-green-100 text-green-800 px-3 py-1 rounded-full">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3 text-center">
                    @foreach([
                        ['Subuh', '04:25', 'bg-blue-50'],
                        ['Dzuhur', '11:50', 'bg-yellow-50'], 
                        ['Ashar', '15:13', 'bg-orange-50'],
                        ['Maghrib', '18:25', 'bg-red-50'],
                        ['Isya', '19:40', 'bg-indigo-50'],
                        ['Imsak', '04:15', 'bg-purple-50']
                    ] as $sholat)
                    <div class="rounded-xl p-4 {{ $sholat[2] }} hover:shadow-md transition-all">
                        <h3 class="text-lg font-semibold text-green-600">{{ $sholat[0] }}</h3>
                        <p class="text-gray-700 font-medium">{{ $sholat[1] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tentang DMI Section -->
            <div class="px-6 py-10">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3 relative inline-block">
                <span class="relative z-10">Tentang DMI Jawa Tengah</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-green-200/70 z-0 -rotate-1"></span>
            </h2>
                    </div>

                    <div class="space-y-8">
                        <div class="flex flex-col md:flex-row gap-6 items-center">
                            <div class="md:w-1/3">
                                <div class="bg-green-100 p-6 rounded-xl h-full flex items-center justify-center">
                                    <img src="{{ Vite::asset('resources/image/MasjidAgung.png') }}" 
                                         alt="Masjid" class="w-full h-auto max-h-48 object-contain">
                                </div>
                            </div>
                            <div class="md:w-2/3">
                                <h3 class="text-2xl font-bold text-green-700 mb-4">🕌 Dewan Masjid Indonesia (DMI)</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Dewan Masjid Indonesia (DMI) adalah organisasi kemasyarakatan dan wahana komunikasi pengelola masjid
                                    seluruh Indonesia yang melaksanakan gerakan dakwah, serta menjadikan masjid sebagai pusat kegiatan pembinaan aqidah,
                                    ibadah, akhlak, ukhuwah, keilmuan, keterampilan dan kesejahteraan umat.
                                </p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-green-100">
                                <h3 class="text-xl font-semibold text-green-700 mb-3">Visi & Misi</h3>
                                <p class="text-gray-700">
                                    Organisasi tingkat nasional dengan tujuan mewujudkan fungsi masjid sebagai pusat ibadah, 
                                    pengembangan masyarakat dan persatuan umat.
                                </p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-green-100">
                                <h3 class="text-xl font-semibold text-green-700 mb-3">Sejarah</h3>
                                <p class="text-gray-700">
                                    Didirikan pada <span class="font-bold text-green-700">22 Juni 1972</span> untuk meningkatkan 
                                    keimanan, ketaqwaan, akhlaq mulia dan kecerdasan umat.
                                </p>
                            </div>
                        </div>

                        <div class="bg-green-50 p-6 rounded-xl">
                            <h3 class="text-xl font-semibold text-green-700 mb-3">Struktur Organisasi</h3>
                            <p class="text-gray-700">
                                DMI mempunyai kepengurusan di setiap provinsi dan kabupaten/kota di Indonesia. 
                                Pimpinan pusat DMI dipilih secara demokratis setiap lima tahun melalui muktamar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('partials.footer')