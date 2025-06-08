@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="flex-grow max-w-screen-xl mx-auto px-6 py-8">
    <h1 class="text-3xl sm:text-4xl font-bold mb-6 flex justify-between items-center">
        Dashboard Admin
        <span class="text-lg sm:text-xl font-medium text-gray-600">
            Jumlah Masjid: {{ auth()->user()->masjid ? 1 : 0 }}
        </span>
    </h1>

    @if(auth()->user()->masjid)
        @php $m = auth()->user()->masjid; @endphp
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row gap-6">
            <!-- Gambar masjid -->
            <div class="md:w-1/2 flex items-stretch rounded overflow-hidden bg-gray-100 shadow" style="min-height: 300px;">
                @if($m->gambar)
                    <img 
                        src="{{ asset('storage/' . $m->gambar) }}" 
                        alt="Foto Masjid {{ $m->nama_masjid }}" 
                        class="object-cover w-full h-full"
                    >
                @else
                    <div class="flex items-center justify-center text-gray-400 italic p-8 w-full">
                        Belum ada foto masjid
                    </div>
                @endif
            </div>

            <!-- Informasi masjid -->
            <div class="md:w-1/2 flex flex-col justify-center space-y-8 text-gray-700">
                <h2 class="text-3xl font-extrabold text-gray-800 border-b-4 border-green-600 pb-3 mb-6">
                    Informasi Masjid
                </h2>
                <div class="space-y-5 text-lg leading-relaxed">
                    @foreach ([
                        '🏛️ Nama Masjid' => $m->nama_masjid,
                        '👤 Nama Takmir' => $m->nama_takmir,
                        '📅 Tahun Berdiri' => $m->tahun,
                        '🏞️ Status Kepemilikan Tanah' => $m->status_tanah,
                        '🌍 Kategori Topologi' => $m->topologi_masjid,
                        '📍 Alamat Lengkap' => "{$m->alamat}, {$m->kecamatan}, {$m->kabupaten}",
                        '📚 Deskripsi' => $m->deskripsi,
                        '📞 Nomor Telepon' => $m->notlp ?? '-'
                    ] as $label => $value)
                        <div class="bg-gray-50 p-5 rounded-lg shadow-sm flex items-center gap-3">
                            <span class="font-semibold w-44">{{ $label }}</span> 
                            <span>{{ $value }}</span>
                        </div>
                    @endforeach
                </div>

                @if($m->surat)
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Surat Resmi</h3>
                        <a href="{{ asset('storage/' . $m->surat) }}" target="_blank" class="text-blue-600 hover:underline font-medium text-lg">
                            📄 Lihat Dokumen
                        </a>
                    </div>
                @endif

                <div class="mt-8">
                    <a href="{{ route('masjids.edit', $m->id) }}" class="bg-green-600 text-white px-5 py-3 rounded-lg hover:bg-green-700 transition text-lg font-semibold">
                        Edit Informasi Masjid
                    </a>
                </div>
            </div>
        </div>
    @else
        <p class="text-gray-600 italic text-lg">Anda belum memiliki data masjid.</p>
    @endif
</div>
@endsection
