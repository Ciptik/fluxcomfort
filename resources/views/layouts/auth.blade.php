<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxcomfort — Авторизация</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fluxcomfort.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-white">

<main class="flex-grow-1 d-flex align-items-center py-5">
    <div class="container">
        <div class="text-center mb-4">
            <a class="navbar-brand text-graphite fw-bold text-uppercase fs-3 text-decoration-none" href="/" style="letter-spacing: 2px;">
                Flux<span class="text-accent">comfort</span>
            </a>
        </div>
        
        @yield('content')
    </div>
</main>

<footer class="py-3 border-top border-subtle-gray">
    <div class="container">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 font-monospace small">
            <div>
                <a href="{{ url('/privacy') }}" class="text-muted-gray text-decoration-none border-bottom" style="font-size: 0.75rem;">Политика конфиденциальности</a>
            </div>
            <div class="text-muted-gray" style="font-size: 0.75rem;">
                © {{ date('Y') }} FLUXCOMFORT. ALL RIGHTS RESERVED.
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
