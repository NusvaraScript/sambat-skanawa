@extends('layouts.admin')

@section('title', 'Edit Pengaduan')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Edit Pengaduan',
    'subtitle' => 'Perbarui data pengaduan siswa.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Pengaduan', 'url' => route('admin.pengaduan.index')],
        ['label' => 'Edit'],
    ],
])
@endcomponent

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Pengaduan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Siswa: readonly, ID dikirim via hidden input --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Siswa</label>
                        @if ($pengaduan->is_anonymous)
                            <input type="text" class="form-control bg-light" value="Anonim" readonly>
                        @else
                            <input type="text" class="form-control bg-light"
                                value="{{ $pengaduan->siswa->nama_siswa ?? 'Tidak diketahui' }} (NIS: {{ $pengaduan->siswa_nis }})"
                                readonly>
                        @endif
                        <div class="form-text">Siswa tidak dapat diubah pada edit pengaduan.</div>
                        {{-- Kirim ulang siswa_nis agar validasi lolos --}}
                        <input type="hidden" name="siswa_nis" value="{{ $pengaduan->siswa_nis }}">
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">Pilih kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" @selected(old('kategori_id', $pengaduan->kategori_id) == $kategori->id)>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="judul_laporan" class="form-label fw-semibold">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" name="judul_laporan" id="judul_laporan" value="{{ old('judul_laporan', $pengaduan->judul_laporan) }}" class="form-control @error('judul_laporan') is-invalid @enderror" required>
                        @error('judul_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label fw-semibold">Isi Laporan <span class="text-danger">*</span></label>
                        <textarea name="isi_laporan" id="isi_laporan" rows="5" class="form-control @error('isi_laporan') is-invalid @enderror" required>{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>
                        @error('isi_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Foto</label>
                        <input type="text" name="foto" id="foto" value="{{ old('foto', $pengaduan->foto) }}" class="form-control @error('foto') is-invalid @enderror" placeholder="Nama file atau URL foto (opsional)">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $pengaduan->status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection