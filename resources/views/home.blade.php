@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    Carbon::setLocale('id');
@endphp
@extends('partials.header')
<!-- Body -->
<main class="pt-20 md:pt-22 bg-gray-50">
    <!-- Hero Section -->
    <section class="relative h-[70vh] max-h-[800px] overflow-hidden">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <img src="{{ Vite::asset('resources/image/DMI-3.jpg') }}" alt="Masjid Agung Jawa Tengah"
            class="w-full h-full object-cover object-center">

        <div class="absolute inset-0 z-20 flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate-fade-in-down">
                Dewan Masjid Indonesia
            </h1>
            <h2 class="text-2xl md:text-4xl font-semibold text-white mb-6 animate-fade-in-down delay-100">
                Provinsi Jawa Tengah
            </h2>
            <p class="text-lg md:text-xl text-white max-w-2xl mb-8 animate-fade-in-down delay-200">
                Menjalin ukhuwah, memakmurkan masjid, membangun peradaban
            </p>
            <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up delay-300">
                <a href="{{ route('berita.publicIndex') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    Lihat Berita Terkini
                </a>
                <a href="#jadwal-sholat"
                    class="bg-white/90 hover:bg-white text-green-700 font-semibold px-8 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    Jadwal Sholat
                </a>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 animate-bounce">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Jadwal Sholat Section -->
    <section id="jadwal-sholat" class="py-16 bg-gradient-to-b from-white to-green-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3 relative inline-block">
                    <span class="relative z-10">Jadwal Sholat Hari Ini</span>
                    <span class="absolute bottom-0 left-0 w-full h-2 bg-green-200/70 z-0 -rotate-1"></span>
                </h2>
                <p class="text-lg text-gray-600">
                    {{ Str::lower(Carbon::now()->translatedFormat('l, d F Y')) }}
                </p>
            </div>

            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-2 md:grid-cols-6 gap-px bg-gray-200">
                    @php
                        date_default_timezone_set('Asia/Jakarta');
                        $currentTime = now()->format('H:i');
                        
                        // Ambil data jadwal sholat dari API Aladhan
                        $latitude = -6.9667; // Koordinat Semarang
                        $longitude = 110.4167;
                        $date = date('d-m-Y');
                        $apiUrl = "http://api.aladhan.com/v1/timings/$date?latitude=$latitude&longitude=$longitude&method=2";
                        
                        try {
                            $response = file_get_contents($apiUrl);
                            $data = json_decode($response, true);
                            $jadwal = $data['data']['timings'];
                            
                            $prayerTimes = [
                                'Imsak' => [
                                    'time' => $jadwal['Imsak'],
                                    'active' => ($currentTime >= $jadwal['Imsak'] && $currentTime < $jadwal['Fajr']),
                                    'upcoming' => false
                                ],
                                'Subuh' => [
                                    'time' => $jadwal['Fajr'],
                                    'active' => ($currentTime >= $jadwal['Fajr'] && $currentTime < $jadwal['Sunrise']),
                                    'upcoming' => ($currentTime >= date('H:i', strtotime('-30 minutes', strtotime($jadwal['Fajr']))) && $currentTime < $jadwal['Fajr'])
                                ],
                                'Dzuhur' => [
                                    'time' => $jadwal['Dhuhr'],
                                    'active' => ($currentTime >= $jadwal['Dhuhr'] && $currentTime < $jadwal['Asr']),
                                    'upcoming' => ($currentTime >= date('H:i', strtotime('-30 minutes', strtotime($jadwal['Dhuhr']))) && $currentTime < $jadwal['Dhuhr'])
                                ],
                                'Ashar' => [
                                    'time' => $jadwal['Asr'],
                                    'active' => ($currentTime >= $jadwal['Asr'] && $currentTime < $jadwal['Maghrib']),
                                    'upcoming' => ($currentTime >= date('H:i', strtotime('-30 minutes', strtotime($jadwal['Asr']))) && $currentTime < $jadwal['Asr'])
                                ],
                                'Maghrib' => [
                                    'time' => $jadwal['Maghrib'],
                                    'active' => ($currentTime >= $jadwal['Maghrib'] && $currentTime < $jadwal['Isha']),
                                    'upcoming' => ($currentTime >= date('H:i', strtotime('-30 minutes', strtotime($jadwal['Maghrib']))) && $currentTime < $jadwal['Maghrib'])
                                ],
                                'Isya' => [
                                    'time' => $jadwal['Isha'],
                                    'active' => ($currentTime >= $jadwal['Isha'] || $currentTime < $jadwal['Imsak']),
                                    'upcoming' => ($currentTime >= date('H:i', strtotime('-30 minutes', strtotime($jadwal['Isha']))) && $currentTime < $jadwal['Isha'])
                                ],
                            ];
                        } catch (Exception $e) {
                            // Fallback jika API tidak bisa diakses
                            $prayerTimes = [
                                'Imsak' => ['time' => '04:33', 'active' => false, 'upcoming' => false],
                                'Subuh' => ['time' => '05:47', 'active' => false, 'upcoming' => false],
                                'Dzuhur' => ['time' => '11:39', 'active' => false, 'upcoming' => false],
                                'Ashar' => ['time' => '15:01', 'active' => false, 'upcoming' => false],
                                'Maghrib' => ['time' => '17:31', 'active' => false, 'upcoming' => false],
                                'Isya' => ['time' => '18:46', 'active' => false, 'upcoming' => false],
                            ];
                        }
                    @endphp

                    @foreach($prayerTimes as $name => $prayer)
                        <div class="bg-white p-4 text-center group transition-all duration-300 
                                        {{ $prayer['active'] ? 'bg-green-700 text-white scale-105 z-10 shadow-lg' : 'hover:bg-green-50' }}
                                        {{ $prayer['upcoming'] ? 'bg-yellow-100' : '' }}">
                            <div class="flex flex-col items-center h-full justify-between">
                                <h3
                                    class="text-lg font-semibold mb-2 {{ $prayer['active'] ? 'text-gray-900' : ($prayer['upcoming'] ? 'text-yellow-700' : 'text-green-700') }}">
                                    {{ $name }}
                                </h3>
                                <div
                                    class="text-2xl font-bold {{ $prayer['active'] ? 'text-gray-900' : ($prayer['upcoming'] ? 'text-yellow-800' : 'text-gray-800') }}">
                                    {{ $prayer['time'] }}
                                </div>
                                <div
                                    class="text-sm {{ $prayer['active'] ? 'text-gray-900' : ($prayer['upcoming'] ? 'text-yellow-600' : 'text-gray-500') }}">
                                    WIB
                                </div>
                                @if($prayer['active'])
                                    <div class="mt-2 animate-pulse">
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-bold bg-white text-green-700 rounded-full">
                                            WAKTU SHOLAT
                                        </span>
                                    </div>
                                @elseif($prayer['upcoming'])
                                    <div class="mt-2">
                                        <span
                                            class="inline-block px-2 py-1 text-xs font-bold bg-yellow-500 text-white rounded-full">
                                            WAKTU SHOLAT HAMPIR TIBA
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Pengurus Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3">
                    Pengurus DMI Jateng
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kenali para pengurus yang mengelola dan memakmurkan masjid-masjid di Jawa Tengah
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Ketua -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ Vite::asset('resources/image/Ahmad_Rofiq.png') }}" alt="Ketua DMI"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Prof. Dr. H. Ahmad Rofiq, MA.</h3>
                            <p class="text-green-300 font-medium">Ketua DMI Jateng</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            Memimpin DMI Jateng dengan visi memakmurkan masjid sebagai pusat peradaban umat.
                        </p>
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                            Lihat Profil Lengkap
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Sekretaris -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ Vite::asset('resources\image\Imam_Yahya..png') }}" alt="Sekretaris DMI"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Dr. H. Imam Yahya, M.Ag.</h3>
                            <p class="text-green-300 font-medium">Sekretaris DMI Jateng</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            Mengkoordinasikan seluruh kegiatan DMI Jateng dan memastikan program berjalan sesuai
                            rencana.
                        </p>
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                            Lihat Profil Lengkap
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Bendahara -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ Vite::asset('resources\image\Mardiyah.jpg') }}" alt="Bendahara DMI"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-xl font-bold text-white">Dr. Hj. Mardiyah, SKM, M. Kes.</h3>
                            <p class="text-green-300 font-medium">Bendahara DMI Jateng</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            Mengelola keuangan DMI Jateng dengan transparan dan akuntabel untuk kemaslahatan umat.
                        </p>
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                            Lihat Profil Lengkap
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi Masjid Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-8 max-w-6xl mx-auto">
                <div class="lg:w-1/2">
                    <div class="bg-green-700 rounded-xl p-8 text-white shadow-lg h-full">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4">Masjid Agung Jawa Tengah</h2>
                        <p class="text-lg mb-6">
                            Komplek Masjid Agung Jawa Tengah (MAJT), Jalan Gajah Raya, Kota Semarang
                        </p>

                        <div class="space-y-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Alamat Lengkap</h3>
                                    <p class="text-green-100">Jl. Gajah Raya No.1, Sambirejo, Kec. Gayamsari, Kota
                                        Semarang, Jawa Tengah 50166</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Telepon</h3>
                                    <p class="text-green-100">0821 3457 5163</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Email</h3>
                                    <p class="text-green-100">dmijateng@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <a href="https://maps.app.goo.gl/hpTASvVzyLjQyySY7" target="_blank"
                            class="inline-flex items-center bg-white text-green-700 font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>

                <div class="lg:w-1/2 h-96 rounded-xl overflow-hidden shadow-xl">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.225201202107!2d110.4451181!3d-6.9835851!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708cb76c98241f%3A0x6afb73af24d41bf9!2sMasjid%20Agung%20Jawa%20Tengah%20(MAJT)!5e0!3m2!1sen!2sid!4v1712345678901!5m2!1sen!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terkini Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-2">Berita Terkini</h2>
                    <p class="text-lg text-gray-600">Update terbaru seputar kegiatan DMI Provinsi Jawa Tengah</p>
                </div>
                <a href="{{ route('berita.publicIndex') }}"
                    class="mt-4 md:mt-0 inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
                    Lihat Semua Berita
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <!-- Featured News (Carousel) -->
            <div class="relative mb-16">
                <div class="swiper-container news-carousel">
                    <div class="swiper-wrapper">
                        @foreach($beritas->where('is_published', true)->sortByDesc('created_at')->take(5) as $berita)
                            <div class="swiper-slide">
                                <div class="relative h-96 rounded-xl overflow-hidden group">
                                    <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://source.unsplash.com/random/1200x800/?mosque' }}"
                                        alt="{{ $berita->title }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                                    </div>
                                    <div class="absolute bottom-0 left-0 p-8 w-full">
                                        <div class="mb-4">
                                            <span
                                                class="inline-block px-3 py-1 bg-green-600 text-white text-sm font-semibold rounded-full">
                                                {{ $berita->tag ?? 'Berita' }}
                                            </span>
                                            <span class="ml-2 text-white text-sm">
                                                {{ $berita->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <h3 class="text-2xl font-bold text-white mb-3">{{ $berita->title }}</h3>
                                        <p class="text-white/90 mb-4 line-clamp-2">
                                            {{ Str::limit(strip_tags($berita->content), 150) }}</p>
                                        <a href="{{ route('berita.show', $berita->id) }}"
                                            class="inline-flex items-center text-white font-medium hover:text-green-300 transition duration-300">
                                            Baca Selengkapnya
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <!-- Grid Berita -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritas->where('is_published', true)->sortByDesc('created_at')->skip(5)->take(6) as $berita)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-2 group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://source.unsplash.com/random/600x400/?islamic' }}"
                                alt="{{ $berita->title }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4">
                                <span
                                    class="inline-block px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                                    {{ $berita->tag ?? 'Berita' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $berita->created_at->diffForHumans() }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $berita->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($berita->content), 120) }}
                            </p>
                            <a href="{{ route('berita.show', $berita->id) }}"
                                class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition duration-300">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-16 bg-green-700 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-3">DMI Jateng dalam Angka</h2>
                <p class="text-lg text-green-100 max-w-2xl mx-auto">
                    Kontribusi nyata kami dalam memakmurkan masjid di Jawa Tengah
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="bg-white/10 rounded-xl p-6 text-center backdrop-blur-sm">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        {{ $totalMasjid }}
                    </div>
                    <div class="text-lg">Masjid Terdaftar</div>
                </div>

                <div class="bg-white/10 rounded-xl p-6 text-center backdrop-blur-sm">
                    <div class="text-4xl md:text-5xl font-bold mb-2">
                        {{ $totalKegiatan }}
                    </div>
                    <div class="text-lg">Kegiatan DMI</div>
                </div>

                <div class="bg-white/10 rounded-xl p-6 text-center backdrop-blur-sm">
                    <div class="text-4xl md:text-5xl font-bold mb-2">{{ $totalDokumentasi }}</div>
                    <div class="text-lg">Dokumentasi DMI</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-green-800 mb-3">Galeri Kegiatan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dokumentasi berbagai kegiatan yang telah kami selenggarakan
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($galeris as $galeri)
                    <div class="relative group overflow-hidden rounded-xl aspect-square cursor-pointer"
                        onclick="event.stopPropagation(); showImageModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ $galeri->judul ?? 'Galeri Kegiatan' }}')">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul ?? 'Galeri Kegiatan' }}"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modal untuk gambar besar -->
            <div id="imageModal"
                class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 transition-opacity duration-300">
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

            <div class="text-center mt-10">
                <a href="{{ route('galeri.index') }}"
                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition duration-300">
                    Lihat Galeri Lengkap
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
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
            document.getElementById('imageModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    hideImageModal();
                }
            });
        </script>
    </section>
</main>

@extends('partials.footer')

@push('styles')
    <style>
        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }

        .animate-fade-in-down.delay-100 {
            animation-delay: 0.1s;
        }

        .animate-fade-in-down.delay-200 {
            animation-delay: 0.2s;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.news-carousel', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            // Animated counter
            const counters = document.querySelectorAll('.animate-count');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    const updateCount = () => {
                        const currentCount = +counter.innerText;
                        const newCount = Math.ceil(currentCount + increment);

                        if (newCount < target) {
                            counter.innerText = newCount;
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = target;
                        }
                    };

                    updateCount();
                }
            });
        });
    </script>
@endpush