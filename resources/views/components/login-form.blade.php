<div class="row min-vh-100 g-0"> <div class="col-lg-5 col-md-8 col-12 d-flex align-items-center mx-auto">
    <div id="auth-left" class="p-4 p-sm-5 w-100"> <div class="auth-logo mb-5 text-center text-lg-start">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 2.5rem;">
            </a>
        </div>
        
        <h1 class="auth-title h2">Log in.</h1>
        <p class="auth-subtitle mb-4">Masuk sebagai petugas/admin atau siswa untuk mengirim pengaduan non-anonim.</p>

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group position-relative has-icon-left mb-3">
                <input type="text" name="username" class="form-control form-control-xl"
                    placeholder="Username" value="{{ old('username') }}" required autofocus>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>

            <div class="form-group position-relative has-icon-left mb-3">
                <input type="password" name="password" class="form-control form-control-xl"
                    placeholder="Password" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>

            <div class="form-check form-check-lg d-flex align-items-center">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
                <label class="form-check-label text-gray-600 small" for="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4 w-100">Log in</button>
        </form>

        <div class="text-center mt-5 text-lg fs-5">
            <p class="text-gray-600">Belum punya akun? 
                <a class="font-bold" href="{{ route('register') }}">Daftar</a>.
            </p>
        </div>
    </div>
</div>

<div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right" class="h-100"
         style="background: linear-gradient(rgba(67, 94, 190, 0.7), rgba(67, 94, 190, 0.7)), 
                url('{{ asset('assets/images/bg/thumbnail.png') }}');
                background-size: cover;
                background-position: center;
                min-height: 100vh;">
    </div>
</div>
</div>