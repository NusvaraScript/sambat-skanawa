<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
                </a>
            </div>
            <h1 class="auth-title">Log in.</h1>
            <p class="auth-subtitle mb-5">Masuk sebagai petugas/admin atau siswa untuk mengirim pengaduan non-anonim.</p>

            <form action="{{ route('login.attempt') }}" method="POST">
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
                    <input type="text" name="username" class="form-control form-control-lg"
                        placeholder="Username" value="{{ old('username') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-lg"
                        placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-gray-600" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>

            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Belum punya akun?
                    <a class="font-bold" href="{{ route('register') }}">Daftar</a>.
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
