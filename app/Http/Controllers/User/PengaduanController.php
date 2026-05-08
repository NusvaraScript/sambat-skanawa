<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'judul_laporan' => ['required', 'string', 'max:255'],
            'isi_laporan' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ]);

        $siswa = Auth::guard('siswa')->user();
        $wantsAnonymous = $request->boolean('is_anonymous');

        // Default: tanpa akun siswa => otomatis anonim.
        $isAnonymous = $siswa ? $wantsAnonymous : true;

        $foto = '';
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'kategori_id' => $validated['kategori_id'],
            'siswa_nis' => $isAnonymous ? null : $siswa->nis,
            'judul_laporan' => $validated['judul_laporan'],
            'isi_laporan' => $validated['isi_laporan'],
            'foto' => $foto,
            'status' => 'pending',
            'is_anonymous' => $isAnonymous,
        ]);

        return redirect()
            ->route('home')
            ->with('success', $isAnonymous
                ? 'Laporan Anda berhasil dikirim sebagai anonim dan menunggu verifikasi petugas.'
                : 'Laporan Anda berhasil dikirim dan menunggu verifikasi petugas.'
            );
    }

    public function status(Request $request): View
    {
        $nis = $request->string('nis')->trim()->toString();
        $pengaduans = collect();

        if ($nis !== '') {
            $pengaduans = Pengaduan::with(['kategori', 'tanggapan.petugas'])
                ->where('siswa_nis', $nis)
                ->latest()
                ->get();
        }

        return view('user.pengaduan.status', compact('nis', 'pengaduans'));
    }
}
