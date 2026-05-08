<nav class="public-navbar d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
    <a href="{{ route('home') }}" class="brand-mark">
        <span class="brand-icon"><i class="bi bi-chat-square-text-fill"></i></span>
        <span>Sambat Skanawa</span>
    </a>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('home') }}#form-pengaduan" class="btn btn-primary"><i class="bi bi-pencil-square me-1"></i> Buat Laporan</a>
        <a href="{{ route('home') }}" class="btn btn-light-primary"><i class="bi bi-house-door me-1"></i> Beranda</a>

        @if (auth('petugas')->check())
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-speedometer2 me-1"></i> Admin
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        @elseif (auth('siswa')->check())
            <a href="{{ route('user.pengaduan.status') }}" class="btn btn-outline-secondary">
                <i class="bi bi-search me-1"></i> Cek Status
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('register') }}" class="btn btn-outline-secondary"><i class="bi bi-person-plus-fill me-1"></i> Daftar</a>
            <a href="{{ route('login') }}" class="btn btn-outline-primary"><i class="bi bi-person-fill me-1"></i> Masuk</a>
        @endif
    </div>
</nav>
