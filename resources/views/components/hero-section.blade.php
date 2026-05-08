<section class="row align-items-stretch g-4">
    <div class="col-12 col-xl-8">
        <div class="card hero-card h-100">
            <div class="card-body p-4 p-lg-5">
                <span class="badge bg-light text-primary mb-3">Layanan Pengaduan Siswa</span>
                <h1 class="display-6 fw-bold mb-3">Sampaikan pengaduan Anda dengan aman dan terdata.</h1>
                <p class="fs-5 mb-4 opacity-75">
                    Pengaduan Anda akan tersimpan <strong>anonim</strong> jika dibuat tanpa akun.
                    Jika ingin laporan <strong>tidak anonim</strong> (terhubung ke akun siswa), silakan login/daftar akun siswa sebelum mengirim.
                </p>
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
