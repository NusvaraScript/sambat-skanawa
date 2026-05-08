<div class="row min-vh-100 g-0">
    <div class="col-lg-5 col-md-8 col-12 d-flex align-items-center mx-auto">
        <div id="auth-left" class="p-4 p-sm-5 w-100">
            <div class="auth-logo mb-4 text-center text-lg-start">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 2.5rem;">
                </a>
            </div>
            
            <h1 class="auth-title h2">Daftar.</h1>
            <p class="auth-subtitle mb-4">Buat akun siswa agar bisa mengirim pengaduan tanpa anonim.</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group position-relative has-icon-left mb-3">
                    <input type="number" name="nis" class="form-control form-control-xl"
                        placeholder="NIS" value="{{ old('nis') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-hash"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-3">
                    <input type="text" name="nama_siswa" class="form-control form-control-xl"
                        placeholder="Nama siswa" value="{{ old('nama_siswa') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="username" class="form-control form-control-xl"
                                placeholder="Username" value="{{ old('username') }}" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-12">
                        <div class="form-group position-relative has-icon-left mb-3">
                            <select name="kelas" class="form-select form-control-xl" required style="padding-left: 3rem;">
                                <option value="" disabled selected>Pilih Kelas</option>
                                @foreach(['10', '11', '12'] as $tingkat)
                                    <optgroup label="Kelas {{ $tingkat }}">
                                        @foreach(['ANM', 'RPL', 'TSM', 'TEI', 'TKJ'] as $jurusan)
                                            <option value="{{ $tingkat }} {{ $jurusan }}" {{ old('kelas') == "$tingkat $jurusan" ? 'selected' : '' }}>
                                                {{ $tingkat }} {{ $jurusan }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-collection"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-3">
                    <input type="number" name="no_hp" class="form-control form-control-xl"
                        placeholder="No. HP" value="{{ old('no_hp') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-3">
                    <input type="password" name="password" class="form-control form-control-xl"
                        placeholder="Password (min. 8 karakter)" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password_confirmation" class="form-control form-control-xl"
                        placeholder="Konfirmasi password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg w-100">Daftar</button>
            </form>

            <div class="text-center mt-4 text-lg fs-5">
                <p class="text-gray-600">Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right" class="h-100"
             style="background: linear-gradient(rgba(67, 94, 190, 0.4), rgba(67, 94, 190, 0.6)), 
                    url('{{ asset('assets/images/bg/thumbnail.png') }}');
                    background-size: cover;
                    background-position: center;
                    min-height: 100vh;">
        </div>
    </div>
</div>