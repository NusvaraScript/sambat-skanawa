@extends('layouts.admin')

@section('title', 'Edit Tanggapan')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Edit Tanggapan',
    'subtitle' => 'Perbarui data tanggapan pengaduan.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tanggapan', 'url' => route('admin.tanggapan.index')],
        ['label' => 'Edit'],
    ],
])
@endcomponent

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Tanggapan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tanggapan.update', $tanggapan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="pengaduan_id" class="form-label">Pengaduan</label>
                        <select name="pengaduan_id" id="pengaduan_id" class="form-select @error('pengaduan_id') is-invalid @enderror" required>
                            <option value="">Pilih Pengaduan</option>
                            @foreach ($pengaduan as $item)
                                <option value="{{ $item->id }}" @selected(old('pengaduan_id', $tanggapan->pengaduan_id) == $item->id)>
                                    {{ $item->judul_laporan }} - {{ $item->siswa->nama_siswa ?? 'Tanpa siswa' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengaduan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="petugas_id" class="form-label">Petugas</label>
                        <select name="petugas_id" id="petugas_id" class="form-select @error('petugas_id') is-invalid @enderror" required>
                            <option value="">Pilih Petugas</option>
                            @foreach ($petugas as $item)
                                <option value="{{ $item->id }}" @selected(old('petugas_id', $tanggapan->petugas_id) == $item->id)>
                                    {{ $item->nama_petugas }}
                                </option>
                            @endforeach
                        </select>
                        @error('petugas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="isi_tanggapan" class="form-label">Isi Tanggapan</label>
                        <textarea name="isi_tanggapan" id="isi_tanggapan" class="form-control @error('isi_tanggapan') is-invalid @enderror" rows="5" required>{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>
                        @error('isi_tanggapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('admin.tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection