@php
    $siswaLoggedIn = auth('siswa')->check();
    $isAnonymousChecked = $siswaLoggedIn ? old('is_anonymous', false) : true;
@endphp

<section class="section mt-4" id="form-pengaduan">
    <div class="row g-4">
        <div class="col-12 col-xl-8">
            <div class="card form-card">
                <div class="card-header bg-white">
                    <h4 class="card-title mb-1">Form Pengaduan Siswa</h4>
                    <p class="text-muted mb-0">Default laporan akan tersimpan <strong>anonim</strong>. Login sebagai siswa untuk mengirim non-anonim.</p>
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
                            <div class="col-12">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-2">
                                    <div>
                                        <label class="form-label required">Identitas Laporan</label>
                                        <div class="form-text">
                                            @if ($siswaLoggedIn)
                                                Centang untuk mengirim sebagai anonim, atau kosongkan untuk mengirim non-anonim.
                                            @else
                                                Anda belum login. Opsi anonim akan aktif otomatis.
                                                <a class="ms-1" href="{{ route('login') }}">Login sebagai siswa</a> untuk mengirim non-anonim.
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1"
                                            {{ $isAnonymousChecked ? 'checked' : '' }} {{ !$siswaLoggedIn ? 'disabled' : '' }}>
                                        <label class="form-check-label" for="is_anonymous">Kirim sebagai anonim</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="kategori_id" class="form-label required">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                    <option value="">Pilih kategori laporan</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="judul_laporan" class="form-label required">Judul Laporan</label>
                                <input type="text" name="judul_laporan" id="judul_laporan" value="{{ old('judul_laporan') }}"
                                    class="form-control @error('judul_laporan') is-invalid @enderror" maxlength="255"
                                    placeholder="Contoh: Kerusakan fasilitas kelas" required>
                                @error('judul_laporan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="isi_laporan" class="form-label required">Isi Laporan</label>
                                <textarea name="isi_laporan" id="isi_laporan" rows="6" class="form-control @error('isi_laporan') is-invalid @enderror"
                                    placeholder="Tuliskan kronologi atau detail pengaduan secara jelas" required>{{ old('isi_laporan') }}</textarea>
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
                        <div>
                            <h6 class="fw-bold mb-1">Tulis Laporan</h6>
                            <p class="text-muted mb-0">Isi kategori dan detail laporan. Tanpa akun akan otomatis anonim.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <span class="step-icon me-3"><i class="bi bi-shield-check"></i></span>
                        <div>
                            <h6 class="fw-bold mb-1">Verifikasi Petugas</h6>
                            <p class="text-muted mb-0">Admin atau petugas memeriksa dan mengubah status laporan.</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <span class="step-icon me-3"><i class="bi bi-chat-dots"></i></span>
                        <div>
                            <h6 class="fw-bold mb-1">Tanggapan</h6>
                            <p class="text-muted mb-0">Tanggapan dapat dipantau melalui halaman cek status.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
