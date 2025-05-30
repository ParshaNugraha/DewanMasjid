<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Masjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
public function __construct()
{
    // Semua method butuh login kecuali create dan store (form daftar & submit registrasi)
    $this->middleware('auth')->except(['create', 'store']);
    $this->middleware('can:manage-users')->except(['create', 'store', 'show']);
}

    public function index()
    {
        // Superadmin lihat semua, admin lihat sendiri saja
        if (auth()->user()->role === 'superadmin') {
            $users = User::with('masjid')->get();
        } else {
            $users = User::with('masjid')->where('id', auth()->id())->get();
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {

        return view('users.create');
    }

    public function store(Request $request)
    {
        // Gabungkan validasi user + masjid sekaligus
       $validated = $request->validate([
        // User
        'username' => 'required|string|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',

        // Masjid
        'nama_masjid' => 'required|string|max:255',
        'nama_takmir' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1000|max:9999',
        'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
        'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
        'kecamatan' => 'required|string|max:100',
        'kabupaten' => 'required|string|max:100',
        'alamat' => 'required|string|max:500',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'surat' => 'nullable|file|mimes:pdf|max:5120',
        'notlp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
    ], 
    [
        'notlp.regex' => 'Nomor telepon harus valid, hanya angka, dan dimulai dengan 08.',
    ]);
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
            'status' => 'pending', // ini supaya status user baru belum disetujui
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
        }

        if ($request->hasFile('surat')) {
            $validated['surat'] = $request->file('surat')->store('surat_masjid', 'public');
        }

        $user->masjid()->create($validated);

        // Ganti redirect setelah registrasi: user diarahkan ke halaman menunggu verifikasi
        return redirect()->route('login')->with('success', 'silahkan menunggu verifikasi superadmin.');
        }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user->load('masjid');

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $user->load('masjid');

        return view('users.edit', compact('user'));
    }

public function update(Request $request, User $user)
{
    $this->authorize('update', $user);

    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',

        'nama_masjid' => 'required|string|max:255',
        'nama_takmir' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1000|max:9999',
        'status_tanah' => 'required|in:Milik Sendiri,Wakaf,Sewa,Pinjam Pakai',
        'topologi_masjid' => 'required|in:Masjid Jami,Masjid Negara,Masjid Agung,Masjid Raya,Masjid Besar,Masjid Kecil',
        'kecamatan' => 'required|string|max:100',
        'kabupaten' => 'required|string|max:100',
        'alamat' => 'required|string|max:500',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        'surat' => 'nullable|file|mimes:pdf|max:5120',
        'notlp' => ['required', 'regex:/^08[0-9]{8,11}$/'],
    ], [
        'notlp.regex' => 'Nomor telepon harus valid, hanya angka, dan dimulai dengan 08.',
    ]);

    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->username = $validated['username'];
    $user->save();

    $masjid = $user->masjid;

    if ($request->hasFile('gambar')) {
        if ($masjid->gambar) {
            Storage::disk('public')->delete($masjid->gambar);
        }
        $validated['gambar'] = $request->file('gambar')->store('gambar_masjid', 'public');
    }

    if ($request->hasFile('surat')) {
        if ($masjid->surat) {
            Storage::disk('public')->delete($masjid->surat);
        }
        $validated['surat'] = $request->file('surat')->store('surat_masjid', 'public');
    }

    $masjid->update($validated);

    return redirect()->route('users.index')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $masjid = $user->masjid;

        if ($masjid) {
            if ($masjid->gambar) {
                Storage::disk('public')->delete($masjid->gambar);
            }
            if ($masjid->surat) {
                Storage::disk('public')->delete($masjid->surat);
            }
            $masjid->delete();
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User dan data masjid berhasil dihapus.');
    }
    public function pending()
{
    return view('registration.pending');
}
}
