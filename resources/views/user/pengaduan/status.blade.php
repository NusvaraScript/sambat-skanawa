<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Laporan - Sambat Skanawa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f2f7ff;
        }

        .public-navbar {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(50, 65, 120, .08);
            margin-top: 1.5rem;
            padding: .85rem 1rem;
        }

        .brand-mark {
            align-items: center;
            color: #25396f;
            display: inline-flex;
            font-size: 1.2rem;
            font-weight: 900;
            gap: .65rem;
            text-decoration: none;
        }

        .brand-icon {
            align-items: center;
            background: #435ebe;
            border-radius: .8rem;
            color: #fff;
            display: inline-flex;
            height: 2.5rem;
            justify-content: center;
            width: 2.5rem;
        }

        .page-banner {
            background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
            border: 0;
            border-radius: 1.4rem;
            box-shadow: 0 18px 45px rgba(67, 94, 190, .22);
            color: #fff;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div id="app" class="container py-4 py-lg-5">
        <nav class="public-navbar d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <a href="{{ route('home') }}" class="brand-mark">
                <span class="brand-icon"><i class="bi bi-chat-square-text-fill"></i></span>
                <span>Sambat Skanawa</span>
            </a>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}#form-pengaduan" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Buat Laporan</a>
                <a href="{{ route('home') }}" class="btn btn-light-primary"><i class="bi bi-house-door me-1"></i> Beranda</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary"><i class="bi bi-person-fill me-1"></i> Masuk Petugas</a>
            </div>
        </nav>

        <main class="page-content mt-4">
            <section class="card page-banner mb-4">
                <div class="card-body p-4 p-lg-5">
                    <span class="badge bg-light text-primary mb-3">Pantau Laporan</span>
                    <h1 class="fw-bold mb-2">Cek Status Pengaduan</h1>
                    <p class="fs-5 mb-0 opacity-75">Masukkan NIS siswa untuk melihat status laporan dan tanggapan petugas.</p>
                </div>
            </section>

            <section class="section">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="card-title mb-0">Pencarian Laporan</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('user.pengaduan.status') }}" class="row g-3 align-items-end">
                            <div class="col-md-9">
                                <label for="nis" class="form-label fw-bold">NIS Siswa</label>
                                <input type="number" name="nis" id="nis" value="{{ $nis }}" class="form-control form-control-lg" placeholder="Contoh: 12345" required>
                            </div>
                            <div class="col-md-3 d-grid">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit"><i class="bi bi-search me-1"></i> Cek Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            @if ($nis !== '')
                <section class="section mt-4">
                    <div class="card">
                        <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between gap-2">
                            <div>
                                <h4 class="card-title mb-1">Riwayat Laporan</h4>
                                <p class="text-muted mb-0">Daftar laporan untuk NIS <strong>{{ $nis }}</strong>.</p>
                            </div>
                            <span class="badge bg-light-primary align-self-start align-self-md-center">{{ $pengaduans->count() }} laporan</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Tanggapan Terakhir</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengaduans as $pengaduan)
                                            @php
                                                $statusMeta = [
                                                    'pending' => ['label' => 'Pending', 'class' => 'bg-warning'],
                                                    'proses' => ['label' => 'Proses', 'class' => 'bg-primary'],
                                                    'selesai' => ['label' => 'Selesai', 'class' => 'bg-success'],
                                                ][$pengaduan->status] ?? ['label' => ucfirst($pengaduan->status), 'class' => 'bg-secondary'];
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">{{ $pengaduan->judul_laporan }}</div>
                                                    <small class="text-muted">{{ str($pengaduan->isi_laporan)->limit(70) }}</small>
                                                </td>
                                                <td>{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                                                <td><span class="badge {{ $statusMeta['class'] }}">{{ $statusMeta['label'] }}</span></td>
                                                <td>
                                                    @if ($pengaduan->tanggapan->isNotEmpty())
                                                        <div>{{ $pengaduan->tanggapan->last()->isi_tanggapan }}</div>
                                                        <small class="text-muted">{{ $pengaduan->tanggapan->last()->petugas->nama_petugas ?? 'Petugas' }}</small>
                                                    @else
                                                        <span class="text-muted">Belum ada tanggapan</span>
                                                    @endif
                                                </td>
                                                <td>{{ $pengaduan->created_at?->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-5">
                                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                    Belum ada laporan untuk NIS tersebut.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </main>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
