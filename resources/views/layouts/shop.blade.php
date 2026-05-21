<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxcomfort — Премиальная корпусная и мягкая мебель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fluxcomfort.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-md bg-white border-bottom border-subtle-gray py-3">
    <div class="container">
        <a class="navbar-brand text-graphite fw-bold text-uppercase fs-4" href="/" style="letter-spacing: 1px;">
            Flux<span class="text-accent">comfort</span>
        </a>
        <button class="navbar-toggler mobile-touch-target border-0 text-graphite" type="button" data-bs-toggle="collapse" data-bs-target="#fluxNavbar" aria-controls="fluxNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="fluxNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-md-0 ms-md-4">
                <li class="nav-item me-3"><a class="nav-link-flux d-block py-2 {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Каталог</a></li>
                <li class="nav-item me-3"><a class="nav-link-flux d-block py-2 {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">О фабрике</a></li>
                <li class="nav-item"><a class="nav-link-flux d-block py-2 {{ request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('contacts') }}">Контакты</a></li>
            </ul>
            <div class="navbar-nav d-flex align-items-md-center border-top border-md-0 pt-3 pt-md-0 mt-3 mt-md-0">
                <a href="{{ url('/cart') }}" class="nav-link-flux py-2 me-md-4 mb-2 mb-md-0 text-lowercase small d-inline-flex align-items-center">
                    корзина: <span class="fw-bold text-accent ms-1">[{{ session('cart') ? count(session('cart')) : 0 }}]</span>
                </a>
                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-graphite fw-bold text-uppercase small py-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border border-subtle-gray p-0 m-0">
                            <li><a class="dropdown-item py-2 small text-uppercase" href="{{ route('dashboard') }}">Кабинет</a></li>
                            <li><hr class="dropdown-divider m-0 border-subtle-gray"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 small text-uppercase text-danger">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link-flux py-2 me-3 small">Войти</a>
                    <a href="{{ route('register') }}" class="btn btn-flux-outline px-3 py-2 text-uppercase fw-bold" style="font-size: 0.75rem;">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main class="flex-grow-1">
    @yield('content')
</main>

<footer class="bg-light-block border-top border-subtle-gray py-4 mt-auto">
    <div class="container">
        <div class="row g-4 justify-content-between">
            <div class="col-12 col-md-4 text-center text-md-start">
                <a class="text-graphite fw-bold text-uppercase fs-5 text-decoration-none" href="/" style="letter-spacing: 1px;">
                    Flux<span class="text-accent">comfort</span>
                </a>
                <p class="small text-muted-gray m-0 mt-2 text-wrap" style="max-width: 280px; line-height: 1.5;">
                    Премиальные архитектурные решения для жилых и общественных пространств.
                </p>
            </div>
            
            <div class="col-12 col-md-8">
                <div class="d-flex flex-column h-100 justify-content-between align-items-center align-items-md-end">
                    <ul class="nav gap-3 gap-md-4 p-0 m-0 text-uppercase small font-monospace justify-content-center" style="letter-spacing: 0.5px;">
                        <li><a href="{{ route('catalog') }}" class="text-graphite text-decoration-none nav-link-flux p-0">Каталог</a></li>
                        <li><a href="{{ route('about') }}" class="text-graphite text-decoration-none nav-link-flux p-0">О фабрике</a></li>
                        <li><a href="{{ route('contacts') }}" class="text-graphite text-decoration-none nav-link-flux p-0">Контакты</a></li>
                    </ul>
                    
                    <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-4 align-items-center mt-3 mt-md-0">
                        <a href="{{ url('/privacy') }}" class="small text-muted-gray text-decoration-none border-bottom border-transparent" style="font-size: 0.75rem;">Политика конфиденциальности</a>
                        <span class="small text-muted-gray d-none d-sm-inline">|</span>
                        <span class="small text-graphite fw-bold text-uppercase" style="font-size: 0.75rem;">© {{ date('Y') }} Fluxcomfort.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
