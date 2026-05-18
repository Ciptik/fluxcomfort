<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fluxcomfort — Премиальный каталог мебели</title>

<!-- Подключение Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Стили Дизайн-Системы Fluxcomfort (Суровый премиальный минимализм) -->
<style>
/* Абсолютное обнуление скруглений во всей системе */
*, .card, .btn, .badge, .form-control, .form-select, .list-group-item, .page-link, .dropdown-menu, .offcanvas {
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

/* Кнопки и интерактивные элементы */
.btn-flux-success {
    background-color: #198754;
    color: #ffffff;
    border: 1px solid #198754;
    transition: all 0.15s ease-in-out;
}
.btn-flux-success:hover {
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
.btn-flux-outline-secondary {
    background-color: transparent;
    color: #6C757D;
    border: 1px solid #6C757D;
    transition: all 0.15s ease-in-out;
}
.btn-flux-outline-secondary:hover {
    background-color: #6C757D;
    color: #ffffff;
}

/* Эффект при наведении на элементы изменения количества */
.hover-gray:hover {
    background-color: #E9ECEF !important;
    color: #000000 !important;
}

/* Навигационный бар */
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

/* Статусы товара */
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

/* Чекбоксы */
.form-check-input { border-color: #6C757D; }
.form-check-input:checked { background-color: #198754; border-color: #198754; }
.form-control:focus, .form-select:focus { border-color: #212529; box-shadow: none; }

/* Стилизация пагинации под строгие квадраты */
.pagination .page-link {
    color: #212529;
    background-color: #FFFFFF;
    border: 1px solid #DEE2E6;
    padding: 8px 16px;
}
.pagination .page-item.active .page-link {
    background-color: #212529 !important;
    border-color: #212529 !important;
    color: #FFFFFF !important;
}
.pagination .page-link:hover {
    background-color: #F8F9FA;
    color: #212529;
    border-color: #DEE2E6;
}

/* Изображения */
.catalog-card-img {
    height: 160px;
    object-fit: cover;
    background-color: #F8F9FA;
}

/* Мобильная горизонтальная лента категорий */
@media (max-width: 767.98px) {
    .mobile-category-scroll {
        display: flex !important;
        flex-direction: row !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 8px;
        border: none !important;
    }
    .mobile-category-scroll::-webkit-scrollbar {
        display: none;
    }
    .mobile-category-scroll .list-group-item {
        border: 1px solid #DEE2E6 !important;
        margin-right: 8px;
        padding: 8px 16px !important;
        display: inline-block !important;
        width: auto !important;
    }
    .mobile-menu-btn, .btn-mobile-filter {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- АВТОНОМНЫЙ NAVBAR -->
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
<a class="nav-link-flux d-block py-2 text-success" href="{{ route('catalog') }}">Каталог</a>
</li>
<li class="nav-item me-3">
<a class="nav-link-flux d-block py-2" href="/">О фабрике</a>
</li>
<li class="nav-item">
<a class="nav-link-flux d-block py-2" href="#">Контакты</a>
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

<!-- ОСНОВНОЙ БЛОК КАТАЛОГА -->
<div class="container py-3 py-md-4">

<!-- Заголовок и хлебные крошки -->
<div class="d-flex flex-column flex-md-row align-items-start align-items-md-end justify-content-between pb-3 mb-3 border-bottom border-subtle-gray">
<div>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb m-0 p-0 small text-uppercase" style="letter-spacing: 0.5px;">
<li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Главная</a></li>
<li class="breadcrumb-item active text-graphite fw-bold" aria-current="page">Каталог</li>
</ol>
</nav>
<h1 class="text-graphite fw-bold m-0 text-uppercase fs-3" style="letter-spacing: 1px;">Каталог продукции</h1>
</div>
<span class="text-muted-gray small mt-2 mt-md-0">Доступно: {{ $products->total() }} моделей</span>
</div>

<!-- Мобильная строка управления (Фильтры + Сортировка) -->
<div class="row g-2 mb-3 align-items-center justify-content-between">
<div class="col-12 col-md-auto d-md-none">
<button class="btn btn-flux-outline w-100 text-uppercase fw-bold btn-mobile-filter btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterSidebar">
Параметры фильтрации
</button>
</div>

<div class="col-12 col-md-4 col-lg-3 ms-auto">
<form method="GET" action="{{ route('catalog') }}" id="sortForm">
<!-- Сохраняем параметры при смене сортировки -->
<input type="hidden" name="category" value="{{ request('category') }}">
<input type="hidden" name="price_from" value="{{ request('price_from') }}">
<input type="hidden" name="price_to" value="{{ request('price_to') }}">
<input type="hidden" name="in_stock" value="{{ request('in_stock') }}">

<select class="form-select border-subtle-gray text-graphite small text-uppercase" name="sort" onchange="document.getElementById('sortForm').submit();" style="letter-spacing: 0.5px;">
<option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>По умолчанию</option>
<option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена: По возрастанию</option>
<option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена: По убыванию</option>
</select>
</form>
</div>
</div>

<!-- ГОРИЗОНТАЛЬНЫЙ СКРОЛЛ КАТЕГОРИЙ ДЛЯ МОБИЛОК (< md) -->
<div class="d-md-none mb-3">
<div class="list-group mobile-category-scroll">
<a href="{{ route('catalog', request()->except('category')) }}" class="list-group-item text-uppercase small py-2 px-3 fw-bold border-0 {{ !request('category') ? 'bg-dark text-white' : 'text-graphite bg-white' }}">
Все категории
</a>
@foreach($categories as $cat)
<a href="{{ route('catalog', array_merge(request()->query(), ['category' => $cat->slug])) }}" class="list-group-item text-uppercase small py-2 px-3 fw-bold border-0 {{ request('category') == $cat->slug ? 'bg-dark text-white' : 'text-graphite bg-white' }}">
{{ $cat->name }}
</a>
@endforeach
</div>
</div>

<!-- МАКЕТ: САЙДБАР + СЕТКА -->
<div class="row g-4">

<!-- ПОЛНОЦЕННЫЙ САЙДБАР ФИЛЬТРОВ ДЛЯ ПК (Категории + Цены + Наличие) -->
<aside class="col-md-4 col-lg-3 d-none d-md-block">
<form method="GET" action="{{ route('catalog') }}" class="p-3 bg-light-block border border-subtle-gray">

<!-- Сохраняем выбранную категорию при фильтрации цен -->
@if(request('category'))
<input type="hidden" name="category" value="{{ request('category') }}">
@endif
@if(request('sort'))
<input type="hidden" name="sort" value="{{ request('sort') }}">
@endif

<!-- Раздел: Категории (Вертикальный список) -->
<div class="mb-4">
<h5 class="text-graphite fw-bold text-uppercase fs-7 mb-2" style="letter-spacing: 0.5px; font-size:0.75rem;">Категория мебели</h5>
<div class="list-group border border-subtle-gray">
<a href="{{ route('catalog', request()->except('category')) }}" class="list-group-item list-group-item-action text-uppercase small py-2 px-3 {{ !request('category') ? 'bg-dark text-white' : 'text-graphite bg-white' }} border-0">
Все модели
</a>
@foreach($categories as $cat)
<a href="{{ route('catalog', array_merge(request()->query(), ['category' => $cat->slug])) }}" class="list-group-item list-group-item-action text-uppercase small py-2 px-3 border-0 border-top border-subtle-gray {{ request('category') == $cat->slug ? 'bg-dark text-white' : 'text-graphite bg-white' }}">
{{ $cat->name }}
</a>
@endforeach
</div>
</div>

<!-- Раздел: Диапазон Цен -->
<div class="mb-4">
<h5 class="text-graphite fw-bold text-uppercase fs-7 mb-2" style="letter-spacing: 0.5px; font-size:0.75rem;">Цена, ₽</h5>
<div class="d-flex align-items-center gap-2">
<input type="number" class="form-control form-control-sm border-subtle-gray text-center small" name="price_from" placeholder="от" value="{{ request('price_from') }}">
<span class="text-muted-gray">—</span>
<input type="number" class="form-control form-control-sm border-subtle-gray text-center small" name="price_to" placeholder="до" value="{{ request('price_to') }}">
</div>
</div>

<!-- Раздел: Наличие на складе -->
<div class="mb-4">
<h5 class="text-graphite fw-bold text-uppercase fs-7 mb-2" style="letter-spacing: 0.5px; font-size:0.75rem;">Склад</h5>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="in_stock" value="1" id="filter_stock" {{ request('in_stock') ? 'checked' : '' }}>
<label class="form-check-label text-graphite small" for="filter_stock">Только готовые на складе</label>
</div>
</div>

<!-- Кнопки управления -->
<div class="d-grid gap-2 pt-2 border-top border-subtle-gray">
<button type="submit" class="btn btn-flux-success btn-sm py-2 text-uppercase fw-bold">Применить фильтр</button>
<a href="{{ route('catalog') }}" class="btn btn-flux-outline btn-sm py-2 text-uppercase fw-bold text-center text-decoration-none">Сбросить всё</a>
</div>
</form>
</aside>

<!-- СЕТКА С ТОВАРАМИ -->
<main class="col-12 col-md-8 col-lg-9">
<div class="row g-2 g-md-3">
@forelse($products as $product)
<div class="col-6 col-md-4 d-flex align-items-stretch">
<div class="card border border-subtle-gray w-100 d-flex flex-column bg-white">

<div class="position-relative overflow-hidden border-bottom border-light">
<img src="{{ $product->image_path ? asset($product->image_path) : 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22160%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2212%22 fill=%22%236C757D%22>Fluxcomfort Design</text></svg>' }}"
class="card-img-top catalog-card-img img-fluid" alt="{{ $product->name }}" loading="lazy">
<div class="position-absolute top-0 start-0 m-2">
@if($product->stock > 0)
<span class="badge badge-in-stock px-2 py-1 small text-uppercase" style="font-size: 0.6rem;">В наличии</span>
@else
<span class="badge badge-on-order px-2 py-1 small text-uppercase" style="font-size: 0.6rem;">Под заказ</span>
@endif
</div>
</div>

<div class="card-body p-2 p-md-3 d-flex flex-column justify-content-between flex-grow-1">
<div>
<h3 class="card-title text-graphite fw-bold mb-1 text-uppercase fs-6 text-truncate" style="letter-spacing: 0.5px;">
{{ $product->name }}
</h3>
<p class="card-text text-muted-gray mb-3 small d-none d-sm-block" style="font-size: 0.8rem; line-height: 1.4;">
{{ Str::limit($product->description, 55, '...') }}
</p>
<p class="card-text text-muted-gray mb-2 small d-block d-sm-none" style="font-size: 0.7rem; line-height: 1.3;">
{{ Str::limit($product->description, 25, '...') }}
</p>
</div>

<div>
<div class="mb-2">
<span class="fs-6 fw-bold text-graphite">
{{ number_format($product->price, 0, '.', ' ') }} ₽
</span>
</div>

<!-- ИНТЕРАКТИВНОЕ УПРАВЛЕНИЕ КОРЗИНОЙ ИЗ СЕТКИ -->
<div class="m-0">
@if(session('cart') && array_key_exists($product->id, session('cart')))
<!-- Товар уже добавлен: Показываем управление количеством [-] количество [+] -->
<div class="d-flex align-items-center justify-content-between border border-subtle-gray p-0 bg-light-block" style="height: 38px;">

<!-- Кнопка уменьшения (Минус) -->
<form action="{{ route('cart.remove', $product->id) }}" method="POST" class="m-0 flex-grow-1 h-100">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-link text-graphite w-100 h-100 p-0 text-decoration-none fw-bold d-flex align-items-center justify-content-center border-0 hover-gray" style="font-size: 1rem;">
—
</button>
</form>

<!-- Текущее количество в сессии -->
<div class="px-2 text-graphite fw-bold small text-center flex-grow-1" style="min-width: 30px; letter-spacing: 0.5px;">
{{ session('cart')[$product->id]['quantity'] }} шт
</div>

<!-- Кнопка увеличения (Плюс) -->
<form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 flex-grow-1 h-100">
@csrf
<button type="submit" class="btn btn-link text-graphite w-100 h-100 p-0 text-decoration-none fw-bold d-flex align-items-center justify-content-center border-0 hover-gray" style="font-size: 1rem;">
+
</button>
</form>

</div>
@else
<!-- Товара нет в корзине: Показываем стандартные кнопки -->
<form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
@csrf
@if($product->stock > 0)
<button type="submit" class="btn btn-flux-success w-100 py-2 text-uppercase fw-bold btn-sm border-0" style="font-size: 0.72rem; letter-spacing: 0.5px; height: 38px;">
В корзину
</button>
@else
<button type="submit" class="btn btn-flux-outline-secondary w-100 py-2 text-uppercase fw-bold btn-sm" style="font-size: 0.72rem; letter-spacing: 0.5px; height: 38px;">
Предзаказ
</button>
@endif
</form>
@endif
</div>

</div>
</div>

</div>
</div>
@empty
<div class="col-12 py-5 text-center bg-light-block border border-subtle-gray">
<p class="text-muted-gray m-0">Моделей с такими критериями не найдено.</p>
<a href="{{ route('catalog') }}" class="btn btn-flux-outline-secondary btn-sm mt-3 text-uppercase fw-bold">Сбросить все фильтры</a>
</div>
@endforelse
</div>

<!-- ПАГИНАЦИЯ -->
<div class="d-flex justify-content-center mt-4 pt-3 border-top border-light">
{{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
</main>

</div>
</div>

<!-- ВСПЛЫВАЮЩИЕ МОБИЛЬНЫЕ ФИЛЬТРЫ (Offcanvas: Цены + Наличие для смартфонов) -->
<div class="offcanvas offcanvas-start border-end border-subtle-gray bg-white" tabindex="-1" id="mobileFilterSidebar" style="width: 290px;">
<div class="offcanvas-header border-bottom border-subtle-gray py-3">
<h5 class="offcanvas-title text-graphite fw-bold text-uppercase fs-6 m-0" style="letter-spacing: 0.5px;">Фильтры каталога</h5>
<button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas"></button>
</div>
<div class="offcanvas-body p-3">
<form method="GET" action="{{ route('catalog') }}">
@if(request('category'))
<input type="hidden" name="category" value="{{ request('category') }}">
@endif
@if(request('sort'))
<input type="hidden" name="sort" value="{{ request('sort') }}">
@endif

<div class="mb-4">
<h6 class="text-graphite fw-bold text-uppercase small mb-2" style="font-size: 0.75rem;">Цена, ₽</h6>
<div class="d-flex align-items-center gap-2">
<input type="number" class="form-control form-control-sm border-subtle-gray text-center small" name="price_from" placeholder="от" value="{{ request('price_from') }}">
<input type="number" class="form-control form-control-sm border-subtle-gray text-center small" name="price_to" placeholder="до" value="{{ request('price_to') }}">
</div>
</div>

<div class="mb-4">
<h6 class="text-graphite fw-bold text-uppercase small mb-2" style="font-size: 0.75rem;">Доступность</h6>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="in_stock" value="1" id="m_filter_stock" {{ request('in_stock') ? 'checked' : '' }}>
<label class="form-check-label text-graphite small" for="m_filter_stock">Только в наличии</label>
</div>
</div>

<div class="d-grid gap-2">
<button type="submit" class="btn btn-flux-success py-2 text-uppercase fw-bold small">Применить</button>
<a href="{{ route('catalog') }}" class="btn btn-flux-outline py-2 text-uppercase fw-bold small text-center text-decoration-none">Очистить сброс</a>
</div>
</form>
</div>
</div>

<!-- МИНИМАЛИСТИЧНЫЙ ПОДВАЛ -->
<footer class="bg-light-block border-top border-subtle-gray py-4 mt-auto">
<div class="container text-center text-sm-start">
<span class="small text-graphite fw-bold text-uppercase">© {{ date('Y') }} Fluxcomfort.</span>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bundle.min.js"></script>
</body>
</html>
