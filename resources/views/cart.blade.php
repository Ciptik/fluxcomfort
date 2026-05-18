<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fluxcomfort — Корзина</title>

    <!-- Подключение Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Стили Дизайн-Системы Fluxcomfort -->
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

        /* Цветовая палитра */
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
        }
        .btn-flux-outline:hover {
            background-color: #212529;
            color: #ffffff;
        }
        
        /* Фокусы полей */
        .form-control:focus, .form-select:focus {
            border-color: #212529;
            box-shadow: none;
        }

        /* Стилизация таблицы на десктопе */
        .table-flux th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: #6C757D;
            border-bottom: 2px solid #212529 !important;
            padding: 12px 8px;
        }
        .table-flux td {
            padding: 16px 8px;
            vertical-align: middle;
            color: #212529;
            border-bottom: 1px solid #DEE2E6;
        }

        /* Навигационные ссылки */
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

        @media (max-width: 767.98px) {
            .mobile-menu-btn {
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- АВТОНОМНЫЙ NAVBAR (Защищен от падений Auth::user()) -->
<nav class="navbar navbar-expand-md bg-white border-bottom border-subtle-gray py-3">
    <div class="container">
        <!-- Логотип -->
        <a class="navbar-brand text-graphite fw-bold text-uppercase fs-4" href="/" style="letter-spacing: 1px;">
            Flux<span style="color: #198754;">comfort</span>
        </a>

        <!-- Бургер для мобилок -->
        <button class="navbar-toggler mobile-menu-btn border-0 text-graphite" type="button" data-bs-toggle="collapse" data-bs-target="#fluxNavbar" aria-controls="fluxNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Ссылки -->
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

            <!-- Блок сессии/авторизации -->
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

<!-- ОСНОВНОЙ КОНТЕНТ СТРАНИЦЫ КОРЗИНЫ -->
<div class="container py-4 flex-grow-1">
    
    <div class="pb-3 mb-4 border-bottom border-subtle-gray">
        <h1 class="text-graphite fw-bold m-0 text-uppercase fs-3" style="letter-spacing: 1px;">Корзина заказа</h1>
    </div>

    @if(empty($cart) || count($cart) === 0)
        <!-- СОСТОЯНИЕ: КОРЗИНА ПУСТА -->
        <div class="text-center py-5 bg-light-block border border-subtle-gray">
            <p class="text-muted-gray mb-3 fs-5">Ваша корзина пуста</p>
            <p class="text-muted-gray small mb-4">Для продолжения покупок перейдите в наш мебельный каталог.</p>
            <a href="{{ route('catalog') }}" class="btn btn-flux-primary px-4 py-2.5 text-uppercase fw-bold small">
                Вернуться в каталог
            </a>
        </div>
    @else
        <!-- СОСТОЯНИЕ: В КОРЗИНЕ ЕСТЬ ТОВАРЫ -->
        <div class="row g-4">
            
            <!-- ЛЕВАЯ КОЛОНКА: СПИСОК ТОВАРОВ -->
            <div class="col-12 col-md-8">
                
                <!-- 1. ДЕСКТОПНЫЙ ВАРИАНТ: ТАБЛИЦА (Скрыта на экранах < md) -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-flux m-0">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 40%;">Наименование мебели</th>
                                <th scope="col" class="text-end">Цена</th>
                                <th scope="col" class="text-center" style="width: 15%;">Количество</th>
                                <th scope="col" class="text-end">Итого</th>
                                <th scope="col" class="text-center" style="width: 10%;">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td class="fw-bold text-graphite">{{ $item['name'] }}</td>
                                    <td class="text-end text-muted-gray">{{ number_format($item['price'], 0, '.', ' ') }} ₽</td>
                                    <td class="text-center fw-bold">{{ $item['quantity'] }}</td>
                                    <td class="text-end fw-bold text-graphite">
                                        {{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ url('/remove-from-cart/' . $id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none small text-uppercase fw-bold" style="font-size: 0.75rem;">
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- 2. МОБИЛЬНЫЙ ВАРИАНТ: ПЛОСКИЕ СТРОГИЕ КАРТОЧКИ (Скрыты на экранах >= md) -->
                <div class="d-md-none space-y-3">
                    @foreach($cart as $id => $item)
                        <div class="p-3 border border-subtle-gray bg-white mb-2 position-relative">
                            <div class="fw-bold text-graphite fs-6 mb-2pe-4">{{ $item['name'] }}</div>
                            
                            <div class="row g-0 pt-2 border-top border-light small text-muted-gray">
                                <div class="col-6 mb-1">Цена:</div>
                                <div class="col-6 text-end mb-1 text-graphite">{{ number_format($item['price'], 0, '.', ' ') }} ₽</div>
                                
                                <div class="col-6 mb-1">Количество:</div>
                                <div class="col-6 text-end mb-1 text-graphite fw-bold">{{ $item['quantity'] }} шт.</div>
                                
                                <div class="col-6 fw-bold text-graphite pt-1 border-top border-light">Сумма:</div>
                                <div class="col-6 text-end fw-bold text-success pt-1 border-top border-light" style="color: #198754 !important;">
                                    {{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }} ₽
                                </div>
                            </div>

                            <!-- Кнопка удаления для мобильных (Абсолютное позиционирование в углу карточки) -->
                            <div class="position-absolute top-0 end-0 p-3">
                                <form action="{{ url('/remove-from-cart/' . $id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none fw-bold" style="font-size: 1.1rem; line-height: 1;">
                                        &times;
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- ПРАВАЯ КОЛОНКА: СВОДКА И ФОРМА ОФОРМЛЕНИЯ -->
            <div class="col-12 col-md-4">
                <div class="p-3 bg-light-block border border-subtle-gray">
                    
                    <!-- Сводка стоимости -->
                    <div class="pb-3 mb-3 border-bottom border-subtle-gray">
                        <span class="text-muted-gray text-uppercase small d-block mb-1" style="letter-spacing: 0.5px;">Итого к оплате</span>
                        <div class="fs-3 fw-bold text-graphite">
                            {{ number_format($total, 0, '.', ' ') }} ₽
                        </div>
                    </div>

                    <!-- Форма заказа -->
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        
                        <!-- Способ получения -->
                        <div class="mb-3">
                            <label for="delivery_method" class="form-label small text-uppercase text-muted-gray fw-bold" style="letter-spacing: 0.5px;">Способ получения</label>
                            <select class="form-select form-select-sm border-subtle-gray text-graphite" id="delivery_method" name="delivery_method" required onchange="toggleAddressField()">
                                <option value="pickup">Самовывоз с фабрики (г. Москва)</option>
                                <option value="delivery" selected>Доставка до подъезда</option>
                            </select>
                        </div>

                        <!-- Адрес доставки -->
                        <div class="mb-3" id="address_container">
                            <label for="address" class="form-label small text-uppercase text-muted-gray fw-bold" style="letter-spacing: 0.5px;">Адрес доставки</label>
                            <input type="text" class="form-control form-control-sm border-subtle-gray placeholder-gray" id="address" name="address" placeholder="Улица, дом, квартира" required>
                        </div>

                        <!-- Номер телефона -->
                        <div class="mb-3">
                            <label for="phone" class="form-label small text-uppercase text-muted-gray fw-bold" style="letter-spacing: 0.5px;">Номер телефона</label>
                            <input type="tel" class="form-control form-control-sm border-subtle-gray" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                        </div>

                        <!-- Комментарий к заказу -->
                        <div class="mb-3">
                            <label for="comment" class="form-label small text-uppercase text-muted-gray fw-bold" style="letter-spacing: 0.5px;">Комментарий к заказу</label>
                            <textarea class="form-control form-control-sm border-subtle-gray" id="comment" name="comment" rows="3" placeholder="Укажите артикул ткани, цвет или желаемые габаритные изменения..."></textarea>
                        </div>

                        <!-- Информационная плашка фабрики перед подтверждением -->
                        <div class="p-2 bg-white border border-subtle-gray text-muted-gray mb-3" style="font-size: 0.72rem; line-height: 1.3;">
                            * Отправляя заказ, вы подтверждаете запуск позиций в производство. Менеджер свяжется с вами в течение 15 минут для согласования договора-спецификации.
                        </div>

                        <!-- Главная кнопка отправки -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-flux-primary py-3 text-uppercase fw-bold fs-6" style="letter-spacing: 1px;">
                                Подтвердить и отправить в производство
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    @endif
</div>

<!-- МИНИМАЛИСТИЧНЫЙ ПОДВАЛ -->
<footer class="bg-light-block border-top border-subtle-gray py-4 mt-auto">
    <div class="container text-center text-sm-start">
        <span class="small text-graphite fw-bold text-uppercase">© {{ date('Y') }} Fluxcomfort.</span>
    </div>
</footer>

<!-- Скрипты переключения и Bootstrap JS -->
<script>
    // Простой нативный скрипт для скрытия/показа поля адреса на основании выбранного способа получения
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
