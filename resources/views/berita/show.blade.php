@extends('partials.header')

@section('title', $berita->title . ' | DMI Jawa Tengah')

<!-- Body -->
<main class="pt-28 md:pt-32 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 md:px-6 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('berita.publicIndex') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-green-600 md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($berita->title, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Artikel Utama -->
        <article class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <!-- Gambar Utama -->
            <div class="relative">
                <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://via.placeholder.com/800x450' }}" 
                     alt="{{ $berita->title }}" 
                     class="w-full h-auto object-contain">
                
                <!-- Badge Kategori dan Tanggal -->
                <div class="absolute bottom-4 left-4 flex items-center space-x-2">
                    <span class="bg-green-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                        {{ $berita->tag ?? 'Berita' }}
                    </span>
                    <span class="bg-white text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full shadow-sm">
                        {{ $berita->created_at->translatedFormat('d F Y') }}
                    </span>
                    @if($berita->created_at->diffInDays(now()) <= 3)
                    <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        BARU
                    </span>
                    @endif
                </div>
            </div>

            <!-- Konten Artikel -->
            <div class="p-6 md:p-8">
                <!-- Judul -->
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $berita->title }}</h1>
                
                <!-- Meta Info -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-600">{{ $berita->author_name ?? 'Admin DMI' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm text-gray-600">{{ $berita->read_duration }} menit baca</span>
                    </div>
                </div>

                <!-- Konten -->
                <div class="prose max-w-none text-gray-700">
                    {!! $berita->content !!}
                </div>

                <!-- Bagikan -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-900">Bagikan berita ini:</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank"
                           class="text-gray-500 hover:text-blue-600">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->title) }}&url={{ urlencode(url()->current()) }}" 
                           target="_blank"
                           class="text-gray-500 hover:text-blue-400">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($berita->title . ' - Baca selengkapnya: ' . url()->current()) }}" 
                           target="_blank"
                           class="text-gray-500 hover:text-green-500">
                            <span class="sr-only">WhatsApp</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-6.29-3.435c-.173.248-.5.744-.673.992-.174.249-.347.373-.347.373s-.272.124-.52-.025c-.248-.149-.941-.347-1.316-1.24-.375-.893-.367-1.863-.342-1.985.024-.123.124-.248.248-.248.124 0 .272.025.421.124.149.1.595.446.793.694.198.249.347.373.347.373s.05.05.074.124c.025.074.025.397-.149.768" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Berita Terkait -->
        <section class="max-w-4xl mx-auto mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Berita Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($beritaTerkait as $terkait)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('berita.show', $terkait->id) }}">
                        <div class="relative">
                            <img src="{{ $terkait->image ? asset('storage/' . $terkait->image) : 'https://via.placeholder.com/600x400' }}" 
                                 alt="{{ $terkait->title }}" 
                                 class="w-full h-48 object-cover">
                            @if($terkait->created_at->diffInDays(now()) <= 3)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">BARU</span>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-semibold text-green-600">{{ $terkait->tag ?? 'Berita' }}</span>
                                <span class="text-xs text-gray-500">{{ $terkait->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $terkait->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit(strip_tags($terkait->content), 100) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</main>

@extends('partials.footer')

@push('scripts')
<script>
    // Highlight gambar dalam konten
    document.querySelectorAll('.prose img').forEach(img => {
        img.classList.add('rounded-lg', 'shadow-md', 'my-4');
    });
</script>
@endpush

