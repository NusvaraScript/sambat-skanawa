@extends('layouts.admin')

@section('title', 'Data Tanggapan')

@section('content')
@component('components.admin-page-heading', [
    'title' => 'Data Tanggapan',
    'subtitle' => 'Kelola tanggapan admin untuk pengaduan siswa.',
    'breadcrumbs' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tanggapan'],
    ],
])
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

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Daftar Tanggapan</h4>
                <a href="{{ route('admin.tanggapan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Tanggapan
                </a>
            </div>
            <div class="card-body">
                @include('components.table-search', [
                    'searchAction' => route('admin.tanggapan.index'),
                    'searchValue' => $search ?? '',
                    'searchPlaceholder' => 'Cari judul pengaduan, nama siswa, petugas, atau isi tanggapan...',
                ])

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengaduan</th>
                                <th>Nama Siswa</th>
                                <th>Nama Petugas</th>
                                <th>Ringkasan</th>
                                <th>Tanggal Dibuat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tanggapan as $item)
                                <tr>
                                    <td>{{ $tanggapan->firstItem() + $loop->index }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $item->pengaduan->judul_laporan ?? '-' }}</div>
                                        <small class="text-muted d-block">{{ \Illuminate\Support\Str::limit($item->pengaduan->isi_laporan ?? '', 70) }}</small>
                                    </td>
                                    <td>{{ $item->pengaduan?->is_anonymous ? 'Anonim' : ($item->pengaduan->siswa->nama_siswa ?? '-') }}</td>
                                    <td>{{ $item->petugas->nama_petugas ?? '-' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($item->isi_tanggapan, 120) }}</td>
                                    <td>{{ $item->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('admin.tanggapan.show', $item) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.tanggapan.edit', $item) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.tanggapan.destroy', $item) }}"
                                                method="POST"
                                                onsubmit="return confirm('Hapus tanggapan ini? Data tidak dapat dikembalikan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        Belum ada data tanggapan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $tanggapan->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection