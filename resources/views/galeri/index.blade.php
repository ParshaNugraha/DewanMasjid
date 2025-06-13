
<div class="p-4 max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-center">Galeri Foto</h1>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
@forelse ($galeris as $galeri)
    <div class="border rounded shadow-sm overflow-hidden">
        <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-48 object-cover">

        @foreach ($galeris as $galeri)
            <p>{{ $galeri->gambar }}</p>
        @endforeach

        @if ($galeri->judul)
            <div class="p-2 text-sm text-center font-semibold">{{ $galeri->judul }}</div>
        @endif
    </div>
@empty
    <p class="col-span-full text-center text-gray-500">Belum ada foto di galeri.</p>
@endforelse

    </div>
</div>
