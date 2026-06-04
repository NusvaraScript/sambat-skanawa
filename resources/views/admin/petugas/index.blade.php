@extends('layouts.admin')

@section('title', 'Daftar Petugas')

@section('content')
    @component('components.page-heading', [
        'title' => 'Daftar Petugas',
        'subtitle' => 'Lihat data petugas dan tambahkan petugas baru secara manual.',
        'breadcrumbs' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Petugas']],
    ])
        @slot('actions')
            <span class="badge bg-light-primary text-primary align-self-center">Total: {{ $petugas->total() }} petugas</span>
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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
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

            {{-- Form Tambah Petugas --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tambah Petugas Manual</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.petugas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                <input type="text" name="nama_petugas" id="nama_petugas"
                                    value="{{ old('nama_petugas') }}"
                                    class="form-control @error('nama_petugas') is-invalid @enderror" required>
                                @error('nama_petugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    class="form-control @error('username') is-invalid @enderror" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="level" class="form-label fw-semibold">Level</label>
                                <select name="level" id="level" class="form-select @error('level') is-invalid @enderror" required>
                                    <option value="petugas" @selected(old('level') == 'petugas')>Petugas</option>
                                    <option value="admin" @selected(old('level') == 'admin')>Admin</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                <div class="form-text">Minimal 6 karakter.</div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus"></i> Simpan Petugas
                        </button>
                    </form>
                </div>
            </div>

            {{-- Tabel Data Petugas --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Petugas</h4>
                </div>
                <div class="card-body">
                    @include('components.search-bar', [
                        'searchAction' => route('admin.petugas.index'),
                        'searchValue' => $search ?? '',
                        'searchPlaceholder' => 'Cari nama petugas, username, atau level...',
                    ])

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Jumlah Tanggapan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($petugas as $petugasItem)
                                    <tr>
                                        <td>{{ $petugas->firstItem() + $loop->index }}</td>
                                        <td>{{ $petugasItem->nama_petugas }}</td>
                                        <td>{{ $petugasItem->username }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $petugasItem->level === 'admin' ? 'bg-success' : 'bg-info' }}">
                                                {{ ucfirst($petugasItem->level) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $petugasItem->tanggapan_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Tombol Edit --}}
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-warning btn-edit-petugas"
                                                    data-edit-url="{{ route('admin.petugas.edit', $petugasItem->id) }}"
                                                    data-update-url="{{ route('admin.petugas.update', $petugasItem->id) }}"
                                                    title="Edit petugas">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                {{-- Tombol Hapus --}}
                                                <form
                                                    action="{{ route('admin.petugas.destroy', ['petugas' => $petugasItem]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Hapus petugas {{ addslashes($petugasItem->nama_petugas) }}? Data yang sudah dihapus tidak dapat dikembalikan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus petugas">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            <i class="bi bi-person-x fs-1"></i>
                                            <p class="mb-0">Belum ada petugas yang ditambahkan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $petugas->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Edit Petugas --}}
    <div class="modal fade" id="modalEditPetugas" tabindex="-1" aria-labelledby="modalEditPetugasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditPetugasLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Data Petugas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Loading spinner --}}
                <div id="editPetugasLoading" class="modal-body text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Memuat data...</span>
                    </div>
                    <p class="mt-2 text-muted">Memuat data petugas...</p>
                </div>

                {{-- Form Edit --}}
                <form id="formEditPetugas" method="POST" style="display:none;">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="editNamaPetugas" class="form-label fw-semibold">Nama Petugas <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nama_petugas" id="editNamaPetugas" class="form-control"
                                    required maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label for="editUsernamePetugas" class="form-label fw-semibold">Username <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="username" id="editUsernamePetugas" class="form-control"
                                    required maxlength="255">
                            </div>
                            <div class="col-md-4">
                                <label for="editLevelPetugas" class="form-label fw-semibold">Level <span
                                        class="text-danger">*</span></label>
                                <select name="level" id="editLevelPetugas" class="form-select" required>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="editPasswordPetugas" class="form-label fw-semibold">Password Baru</label>
                                <input type="password" name="password" id="editPasswordPetugas" class="form-control"
                                    minlength="6" autocomplete="new-password">
                                <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
                            </div>
                            <div class="col-md-4">
                                <label for="editPasswordConfirmPetugas" class="form-label fw-semibold">Konfirmasi
                                    Password</label>
                                <input type="password" name="password_confirmation" id="editPasswordConfirmPetugas"
                                    class="form-control" autocomplete="new-password">
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
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('modalEditPetugas'));
                const loadingEl = document.getElementById('editPetugasLoading');
                const formEl = document.getElementById('formEditPetugas');

                document.querySelectorAll('.btn-edit-petugas').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const editUrl = this.dataset.editUrl;
                        const updateUrl = this.dataset.updateUrl;

                        // Tampilkan modal dengan loading, sembunyikan form
                        loadingEl.style.display = 'block';
                        formEl.style.display = 'none';
                        modal.show();

                        // Set action form ke URL update petugas ini
                        formEl.action = updateUrl;

                        // Fetch data petugas dari endpoint edit
                        fetch(editUrl, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(function(res) {
                                if (!res.ok) throw new Error('Gagal memuat data petugas.');
                                return res.json();
                            })
                            .then(function(data) {
                                document.getElementById('editNamaPetugas').value = data
                                .nama_petugas;
                                document.getElementById('editUsernamePetugas').value = data
                                .username;
                                document.getElementById('editLevelPetugas').value = data.level;
                                document.getElementById('editPasswordPetugas').value = '';
                                document.getElementById('editPasswordConfirmPetugas').value = '';

                                loadingEl.style.display = 'none';
                                formEl.style.display = 'block';
                            })
                            .catch(function(err) {
                                loadingEl.innerHTML =
                                    '<p class="text-danger py-3"><i class="bi bi-exclamation-triangle me-2"></i>' +
                                    err.message + '</p>';
                            });
                    });
                });
            });
        </script>
    @endpush
@endsection
