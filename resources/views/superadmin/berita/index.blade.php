@extends('layouts.superadmin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Berita</h1>
        <a href="{{ route('superadmin.berita.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Berita
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($beritas as $berita)
            @php
                $tagColors = [
                    'Berita' => 'bg-blue-100 text-blue-800',
                    'Pengumuman' => 'bg-red-100 text-red-800',
                    'Kegiatan' => 'bg-green-100 text-green-800',
                ];
                $tag = $berita->tag ?? 'Berita';
                $tagClass = $tagColors[$tag] ?? $tagColors['Berita'];
            @endphp
            <div class="bg-white rounded shadow hover:shadow-md transition">
                <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://via.placeholder.com/600x400' }}" class="w-full h-40 object-cover rounded-t">
                <div class="p-4">
                    <span class="text-xs px-2 py-1 rounded-full font-semibold {{ $tagClass }}">
                        {{ $tag }}
                    </span>

                    <div class="mt-2">
                        @if($berita->is_published)
                            <span class="text-xs px-2 py-1 rounded-full font-semibold bg-green-100 text-green-800">Telah Dipublikasi</span>
                        @else
                            <span class="text-xs px-2 py-1 rounded-full font-semibold bg-yellow-100 text-yellow-800">Belum Dipublikasi</span>
                        @endif
                    </div>

                    <h2 class="text-lg font-semibold mt-2">{{ $berita->title }}</h2>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit(strip_tags($berita->content), 100) }}</p>

                    <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                        <span>{{ $berita->author_name }}</span>
                        <span>{{ $berita->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="flex gap-2 mt-4 flex-wrap">
                        @if(!$berita->is_published)
                            <form action="{{ route('superadmin.berita.update', $berita->id) }}" method="POST" onsubmit="return confirm('Publikasikan berita ini?')">
                                @csrf
                                @method('PUT')

                                {{-- Field untuk validasi --}}
                                <input type="hidden" name="title" value="{{ $berita->title }}">
                                <input type="hidden" name="content" value="{{ $berita->content }}">
                                <input type="hidden" name="tag" value="{{ $berita->tag }}">
                                <input type="hidden" name="read_duration" value="{{ $berita->read_duration }}">
                                <input type="hidden" name="is_published" value="1">
                                <input type="hidden" name="image_path" value="{{ $berita->image }}">

                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                    Publikasi
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('superadmin.berita.edit', $berita->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                            Edit
                        </a>

                        <form action="{{ route('superadmin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
