@extends('layouts.superadmin')

@section('title', 'Kelola Pendaftar')

@section('content')

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Pendaftar Belum Disetujui</h2>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full table-auto border-collapse text-sm bg-white">
                <thead>
                    <tr class="bg-gradient-to-r from-green-100 to-blue-100 text-gray-700">
                        <th class="border border-gray-300 px-4 py-3 font-semibold">No</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Username</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Email</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Role</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Nama Masjid</th>
                        <th class="border border-gray-300 px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($pendaftar as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $no++ }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->username }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 capitalize">{{ $user->role }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->masjid->nama_masjid ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="flex flex-wrap gap-2">
                                    <button
                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition font-medium"
                                        onclick="openModal('modal-detail-{{ $user->id }}')" type="button">
                                        Detail
                                    </button>
                                    <form action="{{ route('superadmin.pendaftar.approve', $user) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menyetujui pendaftar ini?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition font-medium">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('superadmin.pendaftar.destroy', $user) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menolak dan menghapus pendaftar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition font-medium">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div id="modal-detail-{{ $user->id }}"
                            class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl relative animate-fadeIn">
                                <div class="flex justify-between items-center border-b px-6 py-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-t-lg">
                                    <h3 class="text-lg font-bold text-gray-800">Detail Pendaftar</h3>
                                    <button onclick="closeModal('modal-detail-{{ $user->id }}')"
                                        class="text-gray-500 hover:text-gray-700 text-2xl font-bold focus:outline-none">&times;</button>
                                </div>
                                <div class="p-6 overflow-y-auto max-h-[70vh]">
                                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                        <div>
                                            <dt class="font-semibold text-gray-700">Username:</dt>
                                            <dd class="text-gray-800">{{ $user->username }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Email:</dt>
                                            <dd class="text-gray-800">{{ $user->email ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Role:</dt>
                                            <dd class="text-gray-800">{{ ucfirst($user->role) }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Nama Masjid:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->nama_masjid ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Nama Takmir:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->nama_takmir ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Tahun:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->tahun ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Status Tanah:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->status_tanah ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Topologi:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->topologi_masjid ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Kecamatan:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->kecamatan ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Kabupaten:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->kabupaten ?? '-' }}</dd>
                                        </div>
                                        <div class="md:col-span-2">
                                            <dt class="font-semibold text-gray-700">Alamat:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->alamat ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">No. Telepon:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->notlp ?? '-' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Gambar Masjid:</dt>
                                            <dd>
                                                @if($user->masjid && $user->masjid->gambar)
                                                    <img src="{{ asset('storage/' . $user->masjid->gambar) }}" alt="Gambar Masjid"
                                                        class="h-32 w-auto rounded mt-2 border border-gray-200 shadow">
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Surat Masjid:</dt>
                                            <dd>
                                                @if($user->masjid && $user->masjid->surat)
                                                    <a href="{{ asset('storage/' . $user->masjid->surat) }}"
                                                        target="_blank" class="text-blue-600 hover:underline">Lihat Surat</a>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Surat Wakaf:</dt>
                                            <dd>
                                                @if($user->masjid && $user->masjid->surat_wakaf)
                                                    <a href="{{ asset('storage/' . $user->masjid->surat_wakaf) }}" target="_blank"
                                                        class="text-blue-600 hover:underline">Lihat Surat Wakaf</a>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-semibold text-gray-700">Surat Takmir:</dt>
                                            <dd>
                                                @if($user->masjid && $user->masjid->surat_takmir)
                                                    <a href="{{ asset('storage/' . $user->masjid->surat_takmir) }}" target="_blank"
                                                        class="text-blue-600 hover:underline">Lihat Surat Takmir</a>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </dd>
                                        </div>
                                        <div class="md:col-span-2">
                                            <dt class="font-semibold text-gray-700">Deskripsi:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->deskripsi ?? '-' }}</dd>
                                        </div>
                                        <div class="md:col-span-2">
                                            <dt class="font-semibold text-gray-700">Donasi:</dt>
                                            <dd class="text-gray-800">{{ $user->masjid->donasi ?? '-' }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="flex justify-end border-t px-6 py-4 bg-gray-50 rounded-b-lg">
                                    <button onclick="closeModal('modal-detail-{{ $user->id }}')"
                                        class="px-5 py-2 bg-gray-200 rounded hover:bg-gray-300 font-semibold text-gray-700 transition">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Tidak ada pendaftar baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script Modal -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
        // Tutup modal jika klik di luar konten modal
        document.addEventListener('mousedown', function (event) {
            document.querySelectorAll('[id^="modal-detail-"]').forEach(function (modal) {
                if (!modal.classList.contains('hidden') && !modal.querySelector('.bg-white').contains(event.target) && !event.target.classList.contains('text-blue-600')) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease;
        }
    </style>

@endsection