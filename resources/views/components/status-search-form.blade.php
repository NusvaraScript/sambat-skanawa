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