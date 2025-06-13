@extends('partials.header')

<!-- Body -->
<main class="pt-28 md:pt-32 bg-gray-50">
    <!-- Header Berita -->
    <div class="bg-gradient-to-r from-green-600 to-green-800 text-white py-12 px-4 md:px-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4 relative inline-block">
                <span class="relative z-10">Berita Terkini</span>
                <span class="absolute bottom-0 left-0 w-full h-2 bg-white/30 z-0 -rotate-1"></span>
            </h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl">
                Update terbaru seputar kegiatan dan informasi dari DMI Provinsi Jawa Tengah
            </p>
        </div>
    </div>

    <!-- Konten utama -->
    <div class="container mx-auto px-4 md:px-6 py-8">
        <!-- Search dan Filter -->
        <div class="mb-8 bg-white p-4 rounded-lg shadow-md">
            <form action="{{ route('berita.publicIndex') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 items-center">
                <!-- Search Input with Icon -->
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" placeholder="Cari berita..." value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Filter Tag with Icon -->
                <div class="w-full md:w-48 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <select name="tag"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag }}" {{ request('tag') == $tag ? 'selected' : '' }}>{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tanggal with Icon -->
                <div class="w-full md:w-48 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <select name="sort"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 appearance-none">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>

                <button type="submit"
                    class="flex items-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
            </form>
        </div>

        <!-- Berita Utama -->
        @if($beritas->count() > 0)
            <div class="mb-12">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:w-2/3">
                            <img src="{{ $beritas[0]->image ? asset('storage/' . $beritas[0]->image) : 'https://via.placeholder.com/800x500' }}"
                                alt="{{ $beritas[0]->title }}" class="w-full h-64 md:h-full object-cover">
                        </div>
                        <div class="p-6 md:w-1/3">
                            <div class="flex justify-between items-center mb-2">
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $beritas[0]->tag ?? 'Headline' }}</span>
                                <span class="text-gray-500 text-sm">{{ $beritas[0]->created_at->format('d M Y') }}</span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $beritas[0]->title }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($beritas[0]->content), 200) }}</p>
                            <a href="{{ route('berita.show', $beritas[0]->id) }}"
                                class="text-green-600 font-semibold hover:underline">Baca Selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Daftar Berita -->
        @if($beritas->count() > 1)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($beritas->slice(1) as $berita)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://via.placeholder.com/600x400' }}"
                                alt="{{ $berita->title }}" class="w-full h-48 object-cover">
                            @if($berita->created_at->diffInDays(now()) <= 3)
                                <span
                                    class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">BARU</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-semibold text-green-600">{{ $berita->tag ?? 'Berita' }}</span>
                                <span class="text-xs text-gray-500">{{ $berita->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $berita->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                {{ Str::limit(strip_tags($berita->content), 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ $berita->author_name ?? 'Admin DMI' }}</span>
                                <a href="{{ route('berita.show', $berita->id) }}"
                                    class="text-green-600 text-sm font-medium hover:underline">Baca →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-600">Tidak ada berita yang ditemukan.</p>
            </div>
        @endif

        <!-- Pagination -->
        @if($beritas->hasPages())
            <div class="mt-10">
                {{ $beritas->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</main>

@extends('partials.footer')