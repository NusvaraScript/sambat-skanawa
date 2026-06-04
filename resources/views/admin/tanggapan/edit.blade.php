@extends('layouts.admin')

@section('title', 'Edit Tanggapan')

@section('content')
@component('components.page-heading', [
    'title' => 'Edit Tanggapan',
    'subtitle' => 'Perbarui isi tanggapan untuk pengaduan siswa.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tanggapan', 'url' => route('admin.tanggapan.index')],
        ['label' => 'Edit'],
    ],
])
@endcomponent

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Tanggapan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tanggapan.update', $tanggapan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pengaduan: readonly, ID dikirim via hidden --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pengaduan</label>
                        <input type="text" class="form-control bg-light"
                            value="{{ $tanggapan->pengaduan->judul_laporan ?? '-' }} — {{ $tanggapan->pengaduan?->is_anonymous ? 'Anonim' : ($tanggapan->pengaduan->siswa->nama_siswa ?? 'Tanpa siswa') }}"
                            readonly>
                        <div class="form-text">Pengaduan tidak dapat diubah.</div>
                        <input type="hidden" name="pengaduan_id" value="{{ $tanggapan->pengaduan_id }}">
                    </div>

                    {{-- Petugas: readonly, ID dikirim via hidden --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Petugas</label>
                        <input type="text" class="form-control bg-light"
                            value="{{ $tanggapan->petugas->nama_petugas ?? '-' }}"
                            readonly>
                        <div class="form-text">Petugas tidak dapat diubah.</div>
                        <input type="hidden" name="petugas_id" value="{{ $tanggapan->petugas_id }}">
                    </div>

                    <div class="mb-4">
                        <label for="isi_tanggapan" class="form-label fw-semibold">Isi Tanggapan <span class="text-danger">*</span></label>
                        <textarea name="isi_tanggapan" id="isi_tanggapan" class="form-control @error('isi_tanggapan') is-invalid @enderror" rows="5" required>{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>
                        @error('isi_tanggapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
