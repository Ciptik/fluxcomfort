<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxcomfort — Корзина заказа</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Полный сброс скруглений */
        *, .card, .btn, .badge, .form-control, .form-select, .dropdown-menu {
            border-radius: 0px !important;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #FFFFFF;
            color: #212529;
            overflow-x: hidden;
        }

        /* Селекторы дизайн-системы */
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }

        /* Кнопки действия */
        .btn-flux-primary {
            background-color: #198754;
            color: #ffffff;
            border: 1px solid #198754;
            transition: all 0.15s ease-in-out;
            font-size: 0.75rem;
            letter-spacing: 1px;
            text-transform: uppercase;
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
            transition: all 0.15s ease-in-out;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .btn-flux-outline:hover {
            background-color: #212529;
            color: #ffffff;
        }

        .form-control:focus, .form-select:focus {
            border-color: #212529;
            box-shadow: none;
        }

        .nav-link-flux {
            color: #212529;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-decoration: none;
        }
        .nav-link-flux:hover {
            color: #198754;
        }

        /* Кастомный счетчик количества */
        .quantity-counter {
            display: inline-flex;
            border: 1px solid #DEE2E6;
            background-color: #FFFFFF;
        }
        .quantity-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: #212529;
            font-size: 1.1rem;
            transition: background 0.1s ease;
        }
        .quantity-btn:hover:not(:disabled) {
            background-color: #F8F9FA;
        }
        .quantity-btn:disabled {
            color: #DEE2E6;
            cursor: not-allowed;
        }
        .quantity-value {
            width: 44px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: monospace;
            font-weight: 700;
            background-color: #F8F9FA;
            border-left: 1px solid #DEE2E6;
            border-right: 1px solid #DEE2E6;
            font-size: 0.85rem;
        }

        /* Стилизация изображений товаров */
        .cart-img-container {
            width: 70px;
            height: 70px;
            min-width: 70px;
            border: 1px solid #DEE2E6;
            background-color: #F8F9FA;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .cart-img-product {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 767.98px) {
            .mobile-menu-btn {
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .cart-img-container {
                width: 60px;
                height: 60px;
                min-width: 60px;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

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
                    <a class="nav-link-flux d-block py-2" href="{{ route('catalog') }}">Каталог</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link-flux d-block py-2" href="/">О фабрике</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-flux d-block py-2" href="#">Контакты</a>
                </li>
            </ul>

            <div class="navbar-nav d-flex align-items-md-center border-top border-md-0 pt-3 pt-md-0 mt-3 mt-md-0">
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

<div class="container py-4 flex-grow-1">

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-0 font-monospace small mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-0 font-monospace small mb-4">{{ session('error') }}</div>
    @endif

    <div class="pb-2 mb-4 border-bottom border-subtle-gray">
        <span class="text-uppercase text-muted-gray small font-monospace d-block mb-1" style="letter-spacing: 1px;">Ваш выбор</span>
        <h1 class="text-graphite fw-bold m-0 text-uppercase fs-4" style="letter-spacing: 1px;">Корзина заказа</h1>
    </div>

    @if(empty($cart) || count($cart) === 0)
        <div class="text-center py-5 bg-light-block border border-subtle-gray">
            <div class="mb-3 opacity-25">
                <svg width="48" height="48" viewBox="0 0 40 40" fill="none" class="mx-auto">
                    <rect x="4" y="10" width="32" height="22" stroke="#212529" stroke-width="1.5"/>
                    <circle cx="14" cy="32" r="3" stroke="#212529" stroke-width="1.5"/>
                    <circle cx="26" cy="32" r="3" stroke="#212529" stroke-width="1.5"/>
                    <path d="M4 14H36" stroke="#212529" stroke-width="1.5"/>
                </svg>
            </div>
            <h3 class="text-graphite fw-bold text-uppercase fs-6 mb-2" style="letter-spacing: 0.5px;">Ваша корзина пуста</h3>
            <p class="text-muted-gray small mb-4">Архитектурные мебельные решения еще не добавлены в спецификацию.</p>
            <a href="{{ route('catalog') }}" class="btn btn-flux-primary px-4 py-2.5">
                Перейти в каталог
            </a>
        </div>
    @else
        <div class="row g-4">

            <div class="col-12 col-lg-8">

                <div class="d-none d-md-block">
                    <div class="d-flex text-uppercase font-monospace small text-muted-gray pb-2 border-bottom border-subtle-gray" style="letter-spacing: 0.5px; font-size: 0.72rem;">
                        <div style="width: 45%;">Архитектурная модель</div>
                        <div class="text-end" style="width: 15%;">Цена</div>
                        <div class="text-center" style="width: 20%;">Количество</div>
                        <div class="text-end" style="width: 15%;">Итого</div>
                        <div class="text-center" style="width: 5%;"></div>
                    </div>

                    @foreach($cart as $id => $item)
                        <div class="d-flex align-items-center py-3 border-bottom border-subtle-gray">

                            <div class="d-flex align-items-center" style="width: 45%;">
                                <div class="cart-img-container me-3">
                                    <img src="{{ !empty($item['image']) ? asset($item['image']) : 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>' }}"
                                         alt="{{ $item['name'] }}"
                                         class="cart-img-product"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>';">
                                </div>
                                <div>
                                    <h5 class="text-graphite fw-bold fs-6 text-uppercase m-0 mb-1" style="letter-spacing: 0.5px;">{{ $item['name'] }}</h5>
                                    <span class="font-monospace text-muted-gray d-block" style="font-size: 0.65rem;">ART: FLUX-{{ $id }}</span>
                                    @if(isset($item['stock']))
                                        <span class="font-monospace text-success d-block" style="font-size: 0.65rem;">Доступно: {{ $item['stock'] }} шт.</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-end font-monospace text-muted-gray small" style="width: 15%;">
                                {{ number_format($item['price'], 0, '.', ' ') }} ₽
                            </div>

                            <div class="d-flex justify-content-center" style="width: 20%;">
                                <div class="quantity-counter">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                        <button type="submit" class="quantity-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                    </form>

                                    <div class="quantity-value">{{ $item['quantity'] }}</div>

                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                        <button type="submit" class="quantity-btn" {{ (isset($item['stock']) && $item['quantity'] >= $item['stock']) ? 'disabled' : '' }}>+</button>
                                    </form>
                                </div>
                            </div>

                            <div class="text-end font-monospace text-graphite fw-bold fs-6" style="width: 15%;">
                                {{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽
                            </div>

                            <div class="text-center" style="width: 5%;">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 text-muted-gray text-decoration-none" style="font-size: 1.2rem; line-height: 1;">
                                        &times;
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="d-md-none">
                    @foreach($cart as $id => $item)
                        <div class="p-3 border border-subtle-gray bg-white mb-3 position-relative">

                            <div class="d-flex align-items-center mb-3 pe-4">
                                <div class="cart-img-container me-3">
                                    <img src="{{ !empty($item['image']) ? asset($item['image']) : 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>' }}"
                                         alt="{{ $item['name'] }}"
                                         class="cart-img-product"
                                         onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>';">
                                </div>
                                <div>
                                    <div class="fw-bold text-graphite text-uppercase small" style="letter-spacing: 0.5px;">{{ $item['name'] }}</div>
                                    <span class="font-monospace text-muted-gray d-block" style="font-size: 0.65rem;">ART: FLUX-{{ $id }}</span>
                                    @if(isset($item['stock']))
                                        <span class="font-monospace text-success d-block" style="font-size: 0.65rem;">Склад: {{ $item['stock'] }} шт.</span>
                                    @endif
                                </div>
                            </div>

                            <div class="position-absolute top-0 end-0 p-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-muted-gray d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.5rem; line-height: 1;">
                                        &times;
                                    </button>
                                </form>
                            </div>

                            <div class="row g-0 pt-3 border-top border-subtle-gray align-items-center">
                                <div class="col-6">
                                    <div class="quantity-counter">
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                            <button type="submit" class="quantity-btn" style="width: 44px; height: 44px;" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>
                                        <div class="quantity-value" style="height: 44px;">{{ $item['quantity'] }}</div>
                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" class="quantity-btn" style="width: 44px; height: 44px;" {{ (isset($item['stock']) && $item['quantity'] >= $item['stock']) ? 'disabled' : '' }}>+</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="text-muted-gray font-monospace d-block small" style="font-size: 0.7rem;">Сумма:</span>
                                    <span class="text-graphite font-monospace fw-bold fs-6">{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    <a href="{{ route('catalog') }}" class="text-decoration-none text-muted-gray small font-monospace fw-bold text-uppercase d-inline-block">
                        &larr; Назад в каталог моделей
                    </a>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="p-4 bg-light-block border border-subtle-gray">

                    <h3 class="text-graphite fw-bold text-uppercase fs-6 mb-3 font-monospace pb-2 border-bottom border-subtle-gray" style="letter-spacing: 0.5px;">Спецификация</h3>

                    <div class="d-flex justify-content-between align-items-center mb-2 font-monospace small">
                        <span class="text-muted-gray">Выбрано моделей:</span>
                        <span class="text-graphite fw-bold">{{ count($cart) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 font-monospace small">
                        <span class="text-muted-gray">Конструкторский надзор:</span>
                        <span class="text-success fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">0 ₽ // Бесплатно</span>
                    </div>

                    <div class="pt-2 mb-4 d-flex justify-content-between align-items-end border-top border-subtle-gray">
                        <span class="text-graphite text-uppercase fw-bold small m-0 font-monospace">Итого</span>
                        <span class="text-graphite font-monospace fw-bold fs-4" style="line-height: 1;">{{ number_format($total, 0, '.', ' ') }} ₽</span>
                    </div>

                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="delivery_method" class="form-label small text-uppercase text-muted-gray fw-bold font-monospace" style="letter-spacing: 0.5px; font-size: 0.68rem;">Логистика</label>
                            <select class="form-select form-select-sm border-subtle-gray text-graphite py-2" id="delivery_method" name="delivery_method" required onchange="toggleAddressField()">
                                <option value="delivery" selected>Доставка до объекта (Адресная)</option>
                                <option value="pickup">Самовывоз со склада фабрики</option>
                            </select>
                        </div>

                        <div class="mb-3" id="address_container">
                            <label for="address" class="form-label small text-uppercase text-muted-gray fw-bold font-monospace" style="letter-spacing: 0.5px; font-size: 0.68rem;">Адрес доставки</label>
                            <input type="text" class="form-control form-control-sm border-subtle-gray py-2" id="address" name="address" placeholder="Город, улица, дом, квартира" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label small text-uppercase text-muted-gray fw-bold font-monospace" style="letter-spacing: 0.5px; font-size: 0.68rem;">Телефон для связи</label>
                            <input type="tel" class="form-control form-control-sm border-subtle-gray py-2" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label small text-uppercase text-muted-gray fw-bold font-monospace" style="letter-spacing: 0.5px; font-size: 0.68rem;">Технические примечания</label>
                            <textarea class="form-control form-control-sm border-subtle-gray" id="comment" name="comment" rows="3" placeholder="Цвет каркаса, категория ткани, нюансы дверных проемов..."></textarea>
                        </div>

                        <div class="p-2 bg-white border border-subtle-gray text-muted-gray mb-3 font-monospace text-wrap" style="font-size: 0.65rem; line-height: 1.4;">
                            // Отправляя спецификацию, вы подтверждаете готовность к согласованию КД (конструкторской документации).
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-flux-primary py-3 fw-bold fs-6">
                                Отправить в производство
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>

<footer class="bg-light-block border-top border-subtle-gray py-3 mt-auto">
    <div class="container text-center text-md-start">
        <span class="small text-muted-gray font-monospace text-uppercase" style="font-size: 0.68rem;">© {{ date('Y') }} Fluxcomfort. Архитектура и производство мебели.</span>
    </div>
</footer>

<script>
    function toggleAddressField() {
        const method = document.getElementById('delivery_method').value;
        const addressContainer = document.getElementById('address_container');
        const addressInput = document.getElementById('address');

        if (method === 'pickup') {
            addressContainer.style.display = 'none';
            addressInput.removeAttribute('required');
        } else {
            addressContainer.style.display = 'block';
            addressInput.setAttribute('required', 'required');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
