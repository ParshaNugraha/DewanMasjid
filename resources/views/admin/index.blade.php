@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="flex-grow max-w-screen-xl mx-auto px-6 py-8">
    <!-- Header dengan background gradient -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white rounded-xl p-6 mb-8 shadow-lg">
        <h1 class="text-3xl sm:text-4xl font-bold mb-2">Dashboard Admin</h1>
        <div class="flex justify-between items-center">
            <p class="text-green-100">Selamat datang di panel admin DMI Jawa Tengah</p>
            <span class="bg-white/20 px-4 py-2 rounded-full text-sm font-medium">
                Masjid: {{ auth()->user()->masjid ? 1 : 0 }}
            </span>
        </div>
    </div>

    @if(auth()->user()->masjid)
        @php $m = auth()->user()->masjid; @endphp
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header card -->
            <div class="bg-green-700 text-white px-6 py-4">
                <h2 class="text-2xl font-bold">Informasi Masjid</h2>
            </div>

            <div class="p-6 flex flex-col lg:flex-row gap-8">
                <!-- Gambar masjid -->
                <div class="lg:w-1/3">
                    <div class="rounded-lg overflow-hidden shadow-md bg-gray-100 h-64 flex items-center justify-center cursor-pointer" onclick="showFullImage('{{ $m->gambar ? asset('storage/' . $m->gambar) : '' }}', 'Foto Masjid {{ $m->nama_masjid }}')">
                        @if($m->gambar)
                            <img 
                                src="{{ asset('storage/' . $m->gambar) }}" 
                                alt="Foto Masjid {{ $m->nama_masjid }}" 
                                class="object-cover w-full h-full hover:opacity-90 transition-opacity"
                            >
                        @else
                            <div class="text-center p-6 text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Belum ada foto masjid
                            </div>
                        @endif
                    </div>

                    <!-- Modal untuk gambar penuh -->
                    <div id="imageModal" class="hidden fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
                        <div class="relative max-w-6xl w-full">
                            <button onclick="hideFullImage()" class="absolute -top-12 right-0 text-white text-3xl hover:text-gray-300">
                                &times;
                            </button>
                            <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[90vh] object-contain">
                            <p id="modalCaption" class="text-center text-white mt-4 text-lg"></p>
                        </div>
                    </div>

                    <script>
                        function showFullImage(src, caption) {
                            if(!src) return;
                            document.getElementById('modalImage').src = src;
                            document.getElementById('modalCaption').textContent = caption;
                            document.getElementById('imageModal').classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        }

                        function hideFullImage() {
                            document.getElementById('imageModal').classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    </script>

                    <!-- Tombol aksi -->
                    <div class="mt-6 space-y-3">
                        <a href="{{ route('admin.masjids.edit', $m->id) }}" 
                           class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-lg font-medium transition">
                            Edit Informasi
                        </a>
                        
                        @if($m->surat)
                            <a href="{{ asset('storage/' . $m->surat) }}" target="_blank" 
                               class="block w-full bg-blue-100 hover:bg-blue-200 text-blue-800 text-center py-3 rounded-lg font-medium transition">
                                📄 Lihat Surat Resmi
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Detail masjid -->
                <div class="lg:w-2/3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([
                            'Nama Masjid' => $m->nama_masjid,
                            'Nama Takmir' => $m->nama_takmir,
                            'Tahun Berdiri' => $m->tahun,
                            'Status Tanah' => $m->status_tanah,
                            'Topologi' => $m->topologi_masjid,
                            'Alamat' => "{$m->alamat}, {$m->kecamatan}, {$m->kabupaten}",
                            'Telepon' => $m->notlp ?? '-',
                            'Donasi' => $m->donasi
                        ] as $label => $value)
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <h3 class="font-semibold text-green-700 mb-1">{{ $label }}</h3>
                                <p class="text-gray-800">{{ $value }}</p>
                            </div>
                        @endforeach
                        
                        <!-- Deskripsi dengan space lebih lebar -->
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 md:col-span-2">
                            <h3 class="font-semibold text-green-700 mb-1">Deskripsi</h3>
                            <p class="text-gray-800 whitespace-pre-line">{{ $m->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Anda belum memiliki data masjid. Silakan tambahkan data masjid Anda.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
