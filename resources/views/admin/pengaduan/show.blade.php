@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Detail Pengaduan',
    'subtitle' => 'Lihat detail laporan dan tanggapan yang terkait.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Pengaduan', 'url' => route('admin.pengaduan.index')],
        ['label' => 'Detail'],
    ],
])
    @slot('actions')
        <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit
        </a>
        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-light-secondary">Kembali</a>
    @endslot
@endcomponent

<div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Informasi Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Judul Laporan</dt>
                            <dd class="col-sm-8">{{ $pengaduan->judul_laporan }}</dd>

                            <dt class="col-sm-4">Siswa</dt>
                            <dd class="col-sm-8">
                                @if ($pengaduan->is_anonymous)
                                    <span class="badge bg-light-secondary text-dark">
                                        <i class="bi bi-incognito me-1"></i>Anonim
                                    </span>
                                @else
                                    {{ $pengaduan->siswa->nama_siswa ?? '-' }} ({{ $pengaduan->siswa_nis ?? '-' }})
                                @endif
                            </dd>

                            <dt class="col-sm-4">Kategori</dt>
                            <dd class="col-sm-8">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</dd>

                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">
                                <span class="badge {{ $pengaduan->status === 'selesai' ? 'bg-success' : ($pengaduan->status === 'proses' ? 'bg-primary' : 'bg-warning') }}">
                                    {{ ucfirst($pengaduan->status) }}
                                </span>
                            </dd>

                            <dt class="col-sm-4">Foto</dt>
                            <dd class="col-sm-8">
                                @if ($pengaduan->foto)
                                    <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="d-inline-block">
                                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto pengaduan"
                                             class="img-fluid rounded border" style="max-height: 260px;">
                                    </a>
                                    <div class="text-muted small mt-2">{{ $pengaduan->foto }}</div>
                                @else
                                    -
                                @endif
                            </dd>

                            <dt class="col-sm-4">Dibuat</dt>
                            <dd class="col-sm-8">{{ $pengaduan->created_at?->format('d-m-Y H:i') ?? '-' }}</dd>

                            <dt class="col-sm-4">Isi Laporan</dt>
                            <dd class="col-sm-8">{{ $pengaduan->isi_laporan }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Tanggapan</h4>
                        <a href="{{ route('admin.tanggapan.create', ['pengaduan_id' => $pengaduan->id]) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        @forelse ($pengaduan->tanggapan as $item)
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $item->petugas->nama_petugas ?? '-' }}</strong>
                                    <small class="text-muted">{{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}</small>
                                </div>
                                <p class="mb-2">{{ $item->isi_tanggapan }}</p>
                                <a href="{{ route('admin.tanggapan.show', $item) }}" class="btn btn-sm btn-info">Detail</a>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada tanggapan untuk pengaduan ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection