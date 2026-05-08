@extends('layouts.admin')

@section('title', 'Detail Tanggapan')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Detail Tanggapan',
    'subtitle' => 'Lihat detail tanggapan dan pengaduan yang ditanggapi.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tanggapan', 'url' => route('admin.tanggapan.index')],
        ['label' => 'Detail'],
    ],
])
@endcomponent

    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Informasi Tanggapan</h4>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Petugas</dt>
                            <dd class="col-sm-8">{{ $tanggapan->petugas->nama_petugas ?? '-' }}</dd>

                            <dt class="col-sm-4">Tanggal Dibuat</dt>
                            <dd class="col-sm-8">{{ $tanggapan->created_at?->format('d-m-Y H:i') ?? '-' }}</dd>

                            <dt class="col-sm-4">Isi Tanggapan</dt>
                            <dd class="col-sm-8">{{ $tanggapan->isi_tanggapan }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pengaduan Terkait</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Judul:</strong> {{ $tanggapan->pengaduan->judul_laporan ?? '-' }}</p>
                        <p class="mb-1"><strong>Siswa:</strong> {{ $tanggapan->pengaduan->siswa->nama_siswa ?? '-' }}</p>
                        <p class="mb-1"><strong>Kategori:</strong> {{ $tanggapan->pengaduan->kategori->nama_kategori ?? '-' }}</p>
                        <p class="mb-3"><strong>Status:</strong> {{ ucfirst($tanggapan->pengaduan->status ?? '-') }}</p>

                        @if ($tanggapan->pengaduan)
                            <a href="{{ route('admin.pengaduan.show', $tanggapan->pengaduan) }}" class="btn btn-info">Lihat Pengaduan</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.tanggapan.edit', $tanggapan) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-light-secondary">Kembali</a>
        </div>
    </section>
@endsection