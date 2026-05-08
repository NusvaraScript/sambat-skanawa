@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')
    @component('components.admin-page-heading', [
        'title' => 'Data Pengaduan',
        'subtitle' => 'Kelola pengaduan siswa yang masuk ke sistem.',
        'breadcrumbs' => [['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Pengaduan']],
    ])
    @endcomponent

    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Pengaduan</h4>
                    <a href="{{ route('admin.pengaduan.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Pengaduan
                    </a>
                </div>

                <div class="card-body">
                    @include('components.table-search', [
                        'searchAction' => route('admin.pengaduan.index'),
                        'searchValue' => $search ?? '',
                        'searchPlaceholder' => 'Cari nama siswa, kategori, judul, isi laporan, atau status...',
                    ])

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kategori</th>
                                    <th>Judul & Ringkasan</th>
                                    <th>Jumlah Tanggapan</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengaduans as $pengaduan)
                                    @php
                                        $statusMeta = [
                                            'pending' => ['label' => 'Pending', 'class' => 'bg-warning'],
                                            'proses' => ['label' => 'Proses', 'class' => 'bg-primary'],
                                            'selesai' => ['label' => 'Selesai', 'class' => 'bg-success'],
                                        ][$pengaduan->status] ?? [
                                            'label' => ucfirst($pengaduan->status),
                                            'class' => 'bg-secondary',
                                        ];
                                    @endphp
                                    <tr>
                                        <td>{{ $pengaduans->firstItem() + $loop->index }}</td>
                                        <td>
                                            @if ($pengaduan->is_anonymous)
                                                <span class="badge bg-light-secondary text-dark">
                                                    <i class="bi bi-incognito me-1"></i>Anonim
                                                </span>
                                            @else
                                                <div class="fw-semibold">{{ $pengaduan->siswa->nama_siswa ?? 'Siswa' }}
                                                </div>
                                                <small class="text-muted">NIS: {{ $pengaduan->siswa_nis ?? '-' }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $pengaduan->judul_laporan }}</div>
                                            <small
                                                class="text-muted d-block">{{ \Illuminate\Support\Str::limit($pengaduan->isi_laporan, 110) }}</small>
                                        </td>
                                        <td>{{ $pengaduan->tanggapan->count() }}</td>
                                        <td>
                                            <span class="badge {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.pengaduan.show', $pengaduan) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i><span class="d-none d-lg-inline"> Detail</span>
                                                </a>
                                                <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i><span class="d-none d-lg-inline">
                                                        Edit</span>
                                                </a>
                                                <form action="{{ route('admin.pengaduan.destroy', $pengaduan) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i><span class="d-none d-lg-inline">
                                                            Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada data pengaduan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $pengaduans->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
