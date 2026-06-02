<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login - Sembilan Bersuara')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    @if (env('ASSETS_USE_CDN', false))
        <!-- CDN: Bootstrap & Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- Local vendor/app CSS (still loaded) -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @endif
    <style>
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
    </style>
    @stack('styles')
</head>

<body>
    <div id="auth">
        @hasSection('breadcrumbs')
            <div class="container mt-4">
                @yield('breadcrumbs')
            </div>
        @endif

        @yield('content')
    </div>

    @if (env('ASSETS_USE_CDN', false))
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/dist/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    @else
        <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    @endif
    @stack('scripts')
</body>

</html>