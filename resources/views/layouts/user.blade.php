<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sambat Skanawa - Pengaduan Siswa')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
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
            position: relative;
            z-index: 20;
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

        /* Icon centering (landing stats + buttons) */
        .stats-icon,
        .brand-icon,
        .step-icon {
            align-items: center;
            display: inline-flex !important;
            justify-content: center;
        }

        .stats-icon i,
        .brand-icon i,
        .step-icon i {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: 1 !important;
            width: 1em !important;
            height: 1em !important;
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

        .page-title {
            margin-bottom: 2rem;
        }

        .page-title h3 {
            font-weight: 700;
        }

        .text-subtitle {
            color: #6c757d !important;
            font-size: 0.875rem;
            margin-bottom: 0;
        }

        .page-banner {
            background: linear-gradient(135deg, #435ebe 0%, #25396f 100%);
            border: 0;
            border-radius: 1.4rem;
            box-shadow: 0 18px 45px rgba(67, 94, 190, .22);
            color: #fff;
            overflow: hidden;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app" class="container py-4 py-lg-5">
        @include('components.user-navbar')

        @hasSection('breadcrumbs')
            <div class="mt-4">
                @yield('breadcrumbs')
            </div>
        @endif

        <div class="mt-3">
            @include('components.flash-messages')
        </div>

        <main class="page-content mt-4">
            @yield('content')
        </main>

        <div class="mt-5">
            @include('components.footer')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>