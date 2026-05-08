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
                                        'pending' => ['label' => 'Pending', 'class' => 'bg-warning text-dark'],
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