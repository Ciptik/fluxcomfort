<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxcomfort — Премиальная корпусная и мягкая мебель</title>

    <!-- Подключение Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Стили Дизайн-Системы Fluxcomfort (Строгий премиальный минимализм) -->
    <style>
        /* Обнуление скруглений во всей системе */
        *, .card, .btn, .badge, .form-control, .form-select, .dropdown-menu, .list-group-item {
            border-radius: 0px !important;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #FFFFFF;
            color: #212529;
            overflow-x: hidden;
        }

        /* Цветовая палитра */
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }

        /* Кнопки и акценты */
        .btn-flux-primary {
            background-color: #198754;
            color: #ffffff;
            border: 1px solid #198754;
            transition: all 0.2s ease-in-out;
        }
        .btn-flux-primary:hover {
            background-color: #146c43;
            border-color: #146c43;
            color: #ffffff;
        }
        .btn-flux-outline {
            background-color: transparent;
            color: #212529;
            border: 1px solid #212529;
            transition: all 0.2s ease-in-out;
        }
        .btn-flux-outline:hover {
            background-color: #212529;
            color: #ffffff;
        }

        /* Стили ссылок навигации */
        .nav-link-flux {
            color: #212529;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-decoration: none;
            transition: color 0.15s ease-in-out;
        }
        .nav-link-flux:hover {
            color: #198754;
        }
        .nav-link-flux.active {
            color: #198754;
            font-weight: 600;
        }

        /* Интерактивные ссылки футера */
        .footer-link {
            color: #868E96 !important;
            text-decoration: none;
            transition: color 0.15s ease-in-out;
        }
        .footer-link:hover {
            color: #198754 !important;
        }

        /* Статусы */
        .badge-in-stock {
            background-color: #E8F5E9;
            color: #198754;
            font-weight: 500;
        }
        .badge-on-order {
            background-color: #F8F9FA;
            color: #6C757D;
            border: 1px solid #DEE2E6;
            font-weight: 500;
        }

        .product-card-img {
            height: 290px;
            object-fit: cover;
        }

        @media (max-width: 767.98px) {
            .product-card-img {
                height: 170px;
            }
            .mobile-menu-btn {
                min-width: 44px;
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- СКВОЗНОЙ NAVBAR -->
<nav class="navbar navbar-expand-md bg-white border-bottom border-subtle-gray py-3">
    <div class="container">
        <a class="navbar-brand text-graphite fw-bold text-uppercase fs-4" href="/" style="letter-spacing: 1px;">
            Flux<span style="color: #198754;">comfort</span>
        </a>

        <button class="navbar-toggler mobile-menu-btn border-0 text-graphite" type="button" data-bs-toggle="collapse" data-bs-target="#fluxNavbar" aria-controls="fluxNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="fluxNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-md-0 ms-md-4">
                <li class="nav-item me-3">
                    <a class="nav-link-flux d-block py-2 {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Каталог</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link-flux d-block py-2 {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">О фабрике</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-flux d-block py-2 {{ request()->routeIs('contacts') ? 'active' : '' }}" href="{{ route('contacts') }}">Контакты</a>
                </li>
            </ul>

            <div class="navbar-nav d-flex align-items-md-center border-top border-md-0 pt-3 pt-md-0 mt-3 mt-md-0">
                <a href="{{ url('/cart') }}" class="nav-link-flux py-2 me-md-4 mb-2 mb-md-0 text-lowercase small d-inline-flex align-items-center">
                    корзина: <span class="fw-bold text-success ms-1">[{{ session('cart') ? count(session('cart')) : 0 }}]</span>
                </a>

                @auth
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-graphite fw-bold text-uppercase small" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border border-subtle-gray shadow-none p-0 m-0" aria-labelledby="authDropdown">
                            <li><a class="dropdown-item py-2 small text-uppercase" href="{{ route('profile.edit') }}">Профиль</a></li>
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
                    <a href="{{ route('register') }}" class="btn btn-flux-outline btn-sm px-3 py-2 text-uppercase fw-bold" style="font-size: 0.75rem;">Регистрация</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- ОСНОВНОЙ КОНТЕНТ СТРАНИЦЫ -->
<main class="flex-grow-1">
    @yield('content')
</main>

<!-- СТРОГИЙ ПРОМЫШЛЕННЫЙ ФУТЕР -->
<footer class="bg-dark text-white py-4 mt-auto border-top border-secondary">
    <div class="container">
        <div class="row g-3 justify-content-between align-items-center">
            <!-- Блок копирайта предприятия -->
            <div class="col-12 col-md-6 text-center text-md-start">
                <span class="small text-uppercase tracking-wider d-block mb-1" style="letter-spacing: 0.5px;">
                    © {{ date('Y') }} Мебельная фабрика Fluxcomfort.
                </span>
                <span class="small text-secondary">Все права защищены. Разработано в рамках строгой дизайн-системы.</span>
            </div>
            
            <!-- Информационное меню для покупателя и проверочной комиссии (ФЗ-152) -->
            <div class="col-12 col-md-6">
                <ul class="list-unstyled d-flex flex-column flex-sm-row justify-content-center justify-content-md-end gap-2 gap-sm-4 m-0 p-0 text-center text-md-end">
                    <li>
                        <a href="{{ route('about') }}" class="small text-uppercase footer-link" style="font-size: 0.75rem; letter-spacing: 0.5px;">О фабрике</a>
                    </li>
                    <li>
                        <a href="{{ route('contacts') }}" class="small text-uppercase footer-link" style="font-size: 0.75rem; letter-spacing: 0.5px;">Контакты</a>
                    </li>
                    <li>
                        <a href="{{ route('delivery') }}" class="small text-uppercase footer-link" style="font-size: 0.75rem; letter-spacing: 0.5px;">Доставка и сборка</a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="small text-uppercase footer-link" style="font-size: 0.75rem; letter-spacing: 0.5px;">Конфиденциальность (ФЗ-152)</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Официальный JS Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
