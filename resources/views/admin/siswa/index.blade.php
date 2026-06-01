@extends('layouts.admin')

@section('title', 'Daftar Siswa')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Daftar Siswa',
    'subtitle' => 'Lihat data siswa, export data, dan import CSV untuk menambah siswa dalam jumlah besar.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Siswa'],
    ],
])
    @slot('actions')
        <span class="badge bg-light-primary text-primary align-self-center">Total: {{ $siswas->total() }} siswa</span>
    @endslot
@endcomponent

<div class="page-content">
    <section class="section">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Import & Export --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h4 class="card-title mb-0">Import &amp; Export CSV</h4>
                    <small class="text-muted">Gunakan template CSV untuk menambah banyak siswa sekaligus.</small>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.siswa.template') }}" class="btn btn-outline-primary">
                        <i class="bi bi-download"></i> Template CSV
                    </a>
                    <a href="{{ route('admin.siswa.export') }}" class="btn btn-outline-success">
                        <i class="bi bi-file-earmark-spreadsheet"></i> Export Data Siswa
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-8">
                        <label for="csv_file" class="form-label">File CSV Siswa</label>
                        <input type="file" name="csv_file" id="csv_file" class="form-control @error('csv_file') is-invalid @enderror" accept=".csv,text/csv,text/plain" required>
                        <div class="form-text">Kolom wajib: nis, nama_siswa, username, kelas, no_hp, password. Maksimal 2MB.</div>
                        @error('csv_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-upload"></i> Import Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Data Siswa --}}
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Siswa</h4>
            </div>
            <div class="card-body">
                @include('components.table-search', [
                    'searchAction' => route('admin.siswa.index'),
                    'searchValue' => $search ?? '',
                    'searchPlaceholder' => 'Cari NIS, nama siswa, username, kelas, atau no. HP...',
                ])

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Username</th>
                                <th>Kelas</th>
                                <th>No. HP</th>
                                <th>Jumlah Pengaduan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $siswa)
                                <tr>
                                    <td>{{ $siswas->firstItem() + $loop->index }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{ $siswa->username }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>{{ $siswa->no_hp }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $siswa->pengaduan_count }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            {{-- Tombol Edit --}}
                                            <button type="button"
                                                class="btn btn-sm btn-outline-warning btn-edit-siswa"
                                                data-edit-url="{{ route('admin.siswa.edit', $siswa->nis) }}"
                                                data-update-url="{{ route('admin.siswa.update', $siswa->nis) }}"
                                                title="Edit siswa">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.siswa.destroy', $siswa->nis) }}" method="POST"
                                                onsubmit="return confirm('Hapus siswa {{ addslashes($siswa->nama_siswa) }}? Data yang sudah dihapus tidak dapat dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus siswa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada data siswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $siswas->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Modal Edit Siswa --}}
<div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSiswaLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Data Siswa
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- Loading spinner --}}
            <div id="editModalLoading" class="modal-body text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Memuat data...</span>
                </div>
                <p class="mt-2 text-muted">Memuat data siswa...</p>
            </div>

            {{-- Form Edit --}}
            <form id="formEditSiswa" method="POST" style="display:none;">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">NIS</label>
                            <input type="text" id="editNis" class="form-control bg-light" readonly>
                            <div class="form-text">NIS tidak dapat diubah.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="editNamaSiswa" class="form-label fw-semibold">Nama Siswa <span class="text-danger">*</span></label>
                            <input type="text" name="nama_siswa" id="editNamaSiswa" class="form-control" required maxlength="255">
                        </div>
                        <div class="col-md-6">
                            <label for="editUsername" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="editUsername" class="form-control" required maxlength="255">
                        </div>
                        <div class="col-md-6">
                            <label for="editKelas" class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="kelas" id="editKelas" class="form-control" required maxlength="255">
                        </div>
                        <div class="col-md-6">
                            <label for="editNoHp" class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" id="editNoHp" class="form-control" required maxlength="20">
                        </div>
                        <div class="col-md-6">
                            <label for="editPassword" class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" id="editPassword" class="form-control" minlength="6" autocomplete="new-password">
                            <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal        = new bootstrap.Modal(document.getElementById('modalEditSiswa'));
        const loadingEl    = document.getElementById('editModalLoading');
        const formEl       = document.getElementById('formEditSiswa');

        document.querySelectorAll('.btn-edit-siswa').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const editUrl   = this.dataset.editUrl;
                const updateUrl = this.dataset.updateUrl;

                // Tampilkan modal dengan loading, sembunyikan form
                loadingEl.style.display = 'block';
                formEl.style.display    = 'none';
                modal.show();

                // Set action form ke URL update siswa ini
                formEl.action = updateUrl;

                // Fetch data siswa dari endpoint edit
                fetch(editUrl, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function (res) {
                    if (!res.ok) throw new Error('Gagal memuat data siswa.');
                    return res.json();
                })
                .then(function (data) {
                    document.getElementById('editNis').value        = data.nis;
                    document.getElementById('editNamaSiswa').value  = data.nama_siswa;
                    document.getElementById('editUsername').value   = data.username;
                    document.getElementById('editKelas').value      = data.kelas;
                    document.getElementById('editNoHp').value       = data.no_hp;
                    document.getElementById('editPassword').value   = '';

                    loadingEl.style.display = 'none';
                    formEl.style.display    = 'block';
                })
                .catch(function (err) {
                    loadingEl.innerHTML = '<p class="text-danger py-3"><i class="bi bi-exclamation-triangle me-2"></i>' + err.message + '</p>';
                });
            });
        });
    });
</script>
@endpush
@endsection