@extends('partials.header')

<!-- Body -->
<div class="min-h-screen bg-gradient-to-b from-green-50 to-gray-50 pt-32 pb-20">
    <div class="container mx-auto px-4">
        <!-- Card Utama dengan Animasi -->
        <div
            class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border border-green-100/50 transition-all duration-500 hover:shadow-green-200/50 animate-fade-in-up">
            <!-- Header dengan Gambar -->
            <div class="relative w-full overflow-hidden group">
                @if ($masjid->gambar)
                    <img src="{{ asset('storage/' . $masjid->gambar) }}" alt="Gambar {{ $masjid->nama_masjid }}"
                        class="w-full h-auto max-h-[80vh] object-contain transition-transform duration-700 group-hover:scale-105">
                @else
                    <div
                        class="w-full h-64 md:h-80 bg-gradient-to-r from-green-100 to-emerald-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-green-400 animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 9l2-2m0 0l7-7 7 7M5 21v-14a2 2 0 012-2h10a2 2 0 012 2v14" />
                        </svg>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-white animate-fade-in-down">
                        {{ $masjid->nama_masjid }}
                    </h1>
                    <p class="text-green-100 mt-2 flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $masjid->alamat }}
                    </p>
                </div>
            </div>

            <!-- Informasi Masjid -->
            <div class="p-6 md:p-8 pb-1">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-2"></div>
                <!-- Baris Atas - Kolom Kiri dan Kanan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div
                            class="bg-green-50/30 p-4 rounded-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 animate-fade-in-down delay-100">
                            <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Tipologi Masjid
                            </h3>
                            <p class="mt-1 text-lg font-medium text-gray-800">{{ $masjid->topologi_masjid }}</p>
                        </div>

                        <div
                            class="bg-green-50/30 p-4 rounded-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 animate-fade-in-down delay-200">
                            <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none, stroke=" currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tahun Berdiri
                            </h3>
                            <p class="mt-1 text-lg font-medium text-gray-800">{{ $masjid->tahun }}</p>
                        </div>

                        <div
                            class="bg-green-50/30 p-4 rounded-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 animate-fade-in-down delay-300">
                            <a href="{{ $masjid->lokasi }}" target="_blank" class="group">
                                <div class="flex justify-between items-center">
                                    {{-- Bagian Kiri: Teks Lokasi --}}
                                    <div>
                                        <h3
                                            class="text-sm font-semibold text-green-600 uppercase tracking-wider flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            Lokasi
                                        </h3>
                                        <p class="mt-1 text-gray-800">
                                            <span class="font-medium">{{ $masjid->kecamatan }}</span>,
                                            {{ $masjid->kabupaten }}
                                        </p>
                                    </div>

                                    {{-- Bagian Kanan: Ikon Jari dengan Animasi Klik --}}
                                    <div class="text-green-500 flex flex-col items-center">
                                        {{-- Ganti SVG dan class animasinya di sini --}}
                                        <svg class="w-10 h-10 transform transition-transform duration-200 ease-in-out group-hover:scale-90 group-hover:translate-y-0.5"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672z" />
                                        </svg>
                                        <p class="text-xs text-gray-600 mt-1">klik untuk lokasi</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div
                            class="bg-green-50/30 p-4 rounded-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 animate-fade-in-down delay-100">
                            <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                </svg>
                                Status Tanah
                            </h3>
                            <p class="mt-1 text-lg font-medium text-gray-800">{{ $masjid->status_tanah }}</p>
                        </div>

                        <div
                            class="bg-green-50/30 p-4 rounded-lg border-l-4 border-green-500 hover:shadow-md transition-all duration-300 animate-fade-in-down delay-200">
                            <h3 class="text-sm font-semibold text-green-600 uppercase tracking-wider flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7a4 4 0 100-8 4 4 0 000 8z" />
                                </svg>
                                Takmir & Kontak
                            </h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-gray-800">
                                    <span class="font-medium">{{ $masjid->nama_takmir }}</span>
                                </p>
                                <p class="text-gray-800">
                                    {{ $masjid->notlp }}
                                </p>
                            </div>
                            <div class="bg-blue-50/30 p-4 mt-4 rounded-lg border-l-4 border-blue-500">
                                <h3 class="text-sm font-semibold text-blue-600 uppercase tracking-wider">Donasi</h3>
                                <p class="mt-1 text-lg font-medium text-gray-800">{{ $masjid->donasi }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Baris Bawah - Tidak Terhubung dengan Grid -->
                <div class="space-y-4">
                </div>

                <!-- Deskripsi -->
                <div class="mt-1 bg-gray-50/50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-700 mb-3">Deskripsi Masjid</h3>
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <p class="text-gray-700 leading-relaxed">{{ $masjid->deskripsi }}</p>
                    </div>
                    <!-- Tombol Aksi -->
                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <a href="{{ url()->previous() }}"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 transition-colors">
                            ← Kembali
                        </a>
                        <button onclick="copyToClipboard('{{ url()->current() }}')"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-green-600 text-sm font-medium rounded-md shadow-sm text-green-600 bg-white hover:bg-green-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                            Bagikan
                        </button>
                        <script>
                            function copyToClipboard(text) {
                                navigator.clipboard.writeText(text).then(() => {
                                    // Buat overlay dan notifikasi
                                    const overlay = document.createElement('div');
                                    overlay.className = 'fixed inset-0 bg-black/30 z-40 flex items-center justify-center';

                                    const notif = document.createElement('div');
                                    notif.className = 'bg-white p-6 rounded-lg shadow-xl max-w-sm w-full mx-4 animate-fade-in-down';
                                    notif.innerHTML = `
                                        <div class="text-center">
                                            <svg class="w-12 h-12 mx-auto text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <h3 class="text-lg font-bold text-gray-800 mb-1">Data Masjid Tersalin</h3>
                                            <p class="text-gray-600 mb-4">Anda dapat membagikan Data Masjid ini</p>
                                            <button onclick="this.closest('div[class*=\\'fixed\\']').remove()" 
                                                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                                Tutup
                                            </button>
                                        </div>
                                    `;

                                    overlay.appendChild(notif);
                                    document.body.appendChild(overlay);

                                }).catch(err => {
                                    console.error('Gagal menyalin: ', err);
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @extends('partials.footer')