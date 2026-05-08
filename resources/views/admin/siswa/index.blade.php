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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h4 class="card-title mb-0">Import & Export CSV</h4>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada data siswa.</td>
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
@endsection