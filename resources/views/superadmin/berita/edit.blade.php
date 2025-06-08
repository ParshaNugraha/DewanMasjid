@extends('layouts.superadmin')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Berita</h1>

    <form action="{{ route('superadmin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Hidden input untuk tanda hapus gambar lama --}}
        <input type="hidden" name="remove_image" id="remove_image" value="0">

        <div>
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title', $berita->title) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Isi Berita</label>
            <textarea name="content" rows="6" class="w-full border rounded px-3 py-2" required>{{ old('content', $berita->content) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Kategori</label>
            <select name="tag" class="w-full border rounded px-3 py-2" required>
                @php
                    $kategori = ['Pengumuman', 'Berita', 'Kegiatan'];
                @endphp
                @foreach ($kategori as $item)
                    <option value="{{ $item }}" {{ $berita->tag === $item ? 'selected' : '' }}>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Durasi Baca (menit)</label>
            <input type="number" name="read_duration" value="{{ old('read_duration', $berita->read_duration) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Gambar</label>
            <input type="file" name="image" accept="image/*"
                class="block border px-3 py-2 rounded w-full text-sm text-gray-700
                       file:mr-4 file:py-2 file:px-4 file:rounded file:border-0
                       file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                       hover:file:bg-blue-100"
                onchange="previewImage(event)">

            <div class="mt-2 flex items-center gap-4">
                <img id="preview" src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://via.placeholder.com/100x100' }}"
                    class="w-24 h-24 object-cover rounded border">
                <span id="filename" class="text-sm text-gray-600">
                    {{ $berita->image ? basename($berita->image) : 'Belum ada gambar' }}
                </span>
                @if($berita->image)
                <button type="button" onclick="clearImage()"
                    class="text-red-500 text-sm hover:underline">Hapus Gambar Lama</button>
                @endif
            </div>
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" {{ $berita->is_published ? 'checked' : '' }} class="mr-2">
                Publikasi
            </label>
        </div>

        <div class="flex gap-2 mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('superadmin.berita.index') }}" class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const filename = document.getElementById('filename');
        const removeImageInput = document.getElementById('remove_image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                filename.textContent = input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);

            // Kalau upload gambar baru, berarti gak hapus gambar lama
            removeImageInput.value = "0";
        }
    }

    function clearImage() {
        const inputFile = document.querySelector('input[name="image"]');
        const preview = document.getElementById('preview');
        const filename = document.getElementById('filename');
        const removeImageInput = document.getElementById('remove_image');

        // Kosongkan input file (hapus gambar baru yang dipilih)
        inputFile.value = "";

        // Ganti preview ke placeholder
        preview.src = "https://via.placeholder.com/100x100";

        // Ganti nama file ke default
        filename.textContent = "Belum ada gambar";

        // Tandai gambar lama dihapus supaya backend hapus dari DB & storage
        removeImageInput.value = "1";
    }
</script>
@endsection
