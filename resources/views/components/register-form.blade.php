<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
                </a>
            </div>
            <h1 class="auth-title">Daftar.</h1>
            <p class="auth-subtitle mb-5">Buat akun siswa agar bisa mengirim pengaduan tanpa anonim.</p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="number" name="nis" class="form-control form-control-lg"
                        placeholder="NIS" value="{{ old('nis') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-hash"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="nama_siswa" class="form-control form-control-lg"
                        placeholder="Nama siswa" value="{{ old('nama_siswa') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="username" class="form-control form-control-lg"
                        placeholder="Username" value="{{ old('username') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="kelas" class="form-control form-control-lg"
                        placeholder="Kelas" value="{{ old('kelas') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-collection"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="number" name="no_hp" class="form-control form-control-lg"
                        placeholder="No. HP" value="{{ old('no_hp') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-lg"
                        placeholder="Password (minimal 8 karakter)" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg"
                        placeholder="Konfirmasi password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>
            </form>

            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" class="shadow-lg"
             style="background: url('{{ asset('assets/images/bg/thumbnail.png') }}'), #435ebe;
                    background-size: cover;
                    background-position: center;
                    box-shadow: inset 10px 0 100px -10px rgba(0,0,0,0.5) !important;">
        </div>
    </div>
</div>
