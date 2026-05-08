<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambat Skanawa - Pengaduan Siswa</title>

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

        .hero-card {
            background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
            border: 0;
            border-radius: 1.4rem;
            box-shadow: 0 18px 45px rgba(67, 94, 190, .22);
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        .hero-card::after {
            background: rgba(255, 255, 255, .12);
            border-radius: 999px;
            content: '';
            height: 260px;
            position: absolute;
            right: -85px;
            top: -95px;
            width: 260px;
        }

        .hero-card .card-body {
            position: relative;
            z-index: 1;
        }

        .form-card {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 10px 24px rgba(50, 65, 120, .08);
        }

        .required::after {
            color: #dc3545;
            content: ' *';
        }

        .step-icon {
            align-items: center;
            background: #eef3ff;
            border-radius: 1rem;
            color: #435ebe;
            display: inline-flex;
            font-size: 1.35rem;
            height: 3.25rem;
            justify-content: center;
            margin-bottom: .85rem;
            width: 3.25rem;
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
                <a href="#form-pengaduan" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Buat Laporan</a>
                <a href="{{ route('user.pengaduan.status') }}" class="btn btn-light-primary"><i class="bi bi-search me-1"></i> Cek Status</a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary"><i class="bi bi-person-fill me-1"></i> Masuk Petugas</a>
            </div>
        </nav>

        <main class="page-content mt-4">
            <section class="row align-items-stretch g-4">
                <div class="col-12 col-xl-8">
                    <div class="card hero-card h-100">
                        <div class="card-body p-4 p-lg-5">
                            <span class="badge bg-light text-primary mb-3">Layanan Pengaduan Siswa</span>
                            <h1 class="display-6 fw-bold mb-3">Sampaikan pengaduan Anda dengan aman dan terdata.</h1>
                            <p class="fs-5 mb-4 opacity-75">Isi formulir sesuai data siswa yang terdaftar agar laporan bisa diverifikasi oleh admin dan petugas.</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="#form-pengaduan" class="btn btn-light fw-bold">Laporkan Sekarang</a>
                                <a href="{{ route('user.pengaduan.status') }}" class="btn btn-outline-light fw-bold">Lihat Perkembangan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row g-3 h-100">
                        <div class="col-6 col-xl-12">
                            <div class="card h-100">
                                <div class="card-body py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="stats-icon purple"><i class="bi bi-chat-left-text-fill" style="width: auto; height: auto;"></i></div>
                                        <div class="ms-3">
                                            <h6 class="text-muted font-semibold mb-1">Total Laporan</h6>
                                            <h3 class="font-extrabold mb-0">{{ number_format($totalPengaduan) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-12">
                            <div class="card h-100">
                                <div class="card-body py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="stats-icon blue"><i class="bi bi-arrow-repeat" style="width: auto; height: auto;"></i></div>
                                        <div class="ms-3">
                                            <h6 class="text-muted font-semibold mb-1">Diproses</h6>
                                            <h3 class="font-extrabold mb-0">{{ number_format($totalDiproses) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card h-100">
                                <div class="card-body py-4 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="stats-icon green"><i class="bi bi-check-circle-fill" style="width: auto; height: auto;"></i></div>
                                        <div class="ms-3">
                                            <h6 class="text-muted font-semibold mb-1">Selesai</h6>
                                            <h3 class="font-extrabold mb-0">{{ number_format($totalSelesai) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section mt-4" id="form-pengaduan">
                <div class="row g-4">
                    <div class="col-12 col-xl-8">
                        <div class="card form-card">
                            <div class="card-header bg-white">
                                <h4 class="card-title mb-1">Form Pengaduan Siswa</h4>
                                <p class="text-muted mb-0">Kolom formulir disesuaikan dengan tabel pengaduan: kategori, NIS siswa, judul, isi laporan, dan foto.</p>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Periksa kembali data laporan.</div>
                                        <ul class="mb-0 ps-3">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="siswa_nis" class="form-label required">NIS Siswa</label>
                                            <input type="number" name="siswa_nis" id="siswa_nis" value="{{ old('siswa_nis') }}" class="form-control @error('siswa_nis') is-invalid @enderror" placeholder="Masukkan NIS terdaftar" required>
                                            @error('siswa_nis')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kategori_id" class="form-label required">Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                                <option value="">Pilih kategori laporan</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>{{ $kategori->nama_kategori }}</option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="judul_laporan" class="form-label required">Judul Laporan</label>
                                            <input type="text" name="judul_laporan" id="judul_laporan" value="{{ old('judul_laporan') }}" class="form-control @error('judul_laporan') is-invalid @enderror" maxlength="255" placeholder="Contoh: Kerusakan fasilitas kelas" required>
                                            @error('judul_laporan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="isi_laporan" class="form-label required">Isi Laporan</label>
                                            <textarea name="isi_laporan" id="isi_laporan" rows="6" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Tuliskan kronologi atau detail pengaduan secara jelas" required>{{ old('isi_laporan') }}</textarea>
                                            @error('isi_laporan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="foto" class="form-label">Foto Pendukung</label>
                                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                            <small class="text-muted">Opsional. Format gambar maksimal 2MB.</small>
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                                        <p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i>Status awal laporan otomatis <strong>pending</strong>.</p>
                                        <button type="submit" class="btn btn-primary btn-lg fw-bold"><i class="bi bi-send me-1"></i> Kirim Laporan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card h-100">
                            <div class="card-header bg-white"><h4 class="card-title mb-0">Alur Penanganan</h4></div>
                            <div class="card-body">
                                <div class="d-flex mb-4">
                                    <span class="step-icon me-3"><i class="bi bi-pencil-square"></i></span>
                                    <div><h6 class="fw-bold mb-1">Tulis Laporan</h6><p class="text-muted mb-0">Siswa mengirim laporan sesuai data NIS dan kategori.</p></div>
                                </div>
                                <div class="d-flex mb-4">
                                    <span class="step-icon me-3"><i class="bi bi-shield-check"></i></span>
                                    <div><h6 class="fw-bold mb-1">Verifikasi Petugas</h6><p class="text-muted mb-0">Admin atau petugas memeriksa dan mengubah status laporan.</p></div>
                                </div>
                                <div class="d-flex">
                                    <span class="step-icon me-3"><i class="bi bi-chat-dots"></i></span>
                                    <div><h6 class="fw-bold mb-1">Tanggapan</h6><p class="text-muted mb-0">Tanggapan dapat dipantau melalui halaman cek status.</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
