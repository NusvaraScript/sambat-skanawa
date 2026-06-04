@extends('layouts.user')

@section('title', 'Status Laporan - Sambat Skanawa')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'title' => 'Status Laporan',
        'subtitle' => 'Pantau perkembangan laporan pengaduan Anda',
        'items' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Status Laporan'],
        ],
    ])
@endsection

    <section class="card page-banner mb-4">
    <div class="card-body p-4 p-lg-5">
        <span class="badge bg-light text-primary mb-3">Pantau Laporan</span>
        <h1 class="fw-bold mb-2">Cek Status Pengaduan</h1>
        <p class="fs-5 mb-0 opacity-75">Masukkan NIS siswa untuk melihat status laporan dan tanggapan petugas.</p>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header bg-white">
            <h4 class="card-title mb-0">Pencarian Laporan</h4>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('user.pengaduan.status') }}" class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label for="nis" class="form-label fw-bold">NIS Siswa</label>
                    <input type="number" name="nis" id="nis" value="{{ $nis }}" class="form-control form-control-lg" placeholder="Contoh: 12345" required>
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary btn-lg fw-bold" type="submit"><i class="bi bi-search me-1"></i> Cek Status</button>
                </div>
            </form>
        </div>
    </div>
</section>

@if ($nis !== '')
    <section class="section mt-4">
        <div class="card">
            <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between gap-2">
                <div>
                    <h4 class="card-title mb-1">Riwayat Laporan</h4>
                    <p class="text-muted mb-0">Daftar laporan untuk NIS <strong>{{ $nis }}</strong>.</p>
                </div>
                <span class="badge bg-light-primary align-self-start align-self-md-center">{{ $pengaduans->count() }} laporan</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggapan Terakhir</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengaduans as $pengaduan)
                                @php
                                    $statusMeta = [
                                        'pending' => ['label' => 'Pending', 'class' => 'bg-warning text-dark'],
                                        'proses' => ['label' => 'Proses', 'class' => 'bg-primary'],
                                        'selesai' => ['label' => 'Selesai', 'class' => 'bg-success'],
                                    ][$pengaduan->status] ?? ['label' => ucfirst($pengaduan->status), 'class' => 'bg-secondary'];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $pengaduan->judul_laporan }}</div>
                                        <small class="text-muted">{{ str($pengaduan->isi_laporan)->limit(70) }}</small>
                                    </td>
                                    <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                    <td><span class="badge {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span></td>
                                    <td>
                                        @if ($pengaduan->tanggapan->isNotEmpty())
                                            <div>{{ $pengaduan->tanggapan->last()->isi_tanggapan }}</div>
                                            <small class="text-muted">{{ $pengaduan->tanggapan->last()->petugas->nama_petugas ?? 'Petugas' }}</small>
                                        @else
                                            <span class="text-muted">Belum ada tanggapan</span>
                                        @endif
                                    </td>
                                    <td>{{ $pengaduan->created_at?->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada laporan untuk NIS tersebut.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
