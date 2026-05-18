@extends('layouts.shop')

@section('content')
<!-- HERO-БАННЕР -->
<section class="text-white py-5 position-relative" style="background-color: #212529;">
    <div class="container py-3 py-md-5">
        <div class="row m-0">
            <div class="col-12 col-md-10 col-lg-8 p-0">
                <span class="text-uppercase text-muted-gray small mb-2 d-block" style="letter-spacing: 2px;">Архитектура интерьера</span>
                <h1 class="display-5 fw-bold mb-3 text-white">
                    Мебельная фабрика Fluxcomfort.
                </h1>
                <p class="fs-5 mb-4 text-light opacity-75 fw-light" style="max-width: 600px;">
                    Производство и продажа корпусной и мягкой мебели. Строгая геометрия, премиальное исполнение и отсутствие лишних деталей.
                </p>
                <a href="{{ route('catalog') }}" class="btn btn-flux-primary btn-lg px-4 py-3 text-uppercase fs-6 fw-bold d-block d-sm-inline-block">
                    Перейти в каталог
                </a>
            </div>
        </div>
    </div>
</section>

<!-- БЛОК ПРЕИМУЩЕСТВ ФАБРИКИ -->
<section class="bg-light-block border-bottom border-subtle-gray py-4">
    <div class="container">
        <div class="row g-3 g-md-4">
            <!-- Преимущество 1 -->
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-start p-1">
                    <div class="me-3 mt-1">
                        <div style="width: 8px; height: 8px; background-color: #198754;"></div>
                    </div>
                    <div>
                        <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Собственное производство</h5>
                        <p class="text-muted-gray small mb-0">Контроль качества на каждом технологическом этапе сборки и распила плит.</p>
                    </div>
                </div>
            </div>
            <!-- Преимущество 2 -->
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-start p-1">
                    <div class="me-3 mt-1">
                        <div style="width: 8px; height: 8px; background-color: #198754;"></div>
                    </div>
                    <div>
                        <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Доставка и сборка</h5>
                        <p class="text-muted-gray small mb-0">Собственная логистическая служба доставит и смонтирует мебель за 1 рабочий день.</p>
                    </div>
                </div>
            </div>
            <!-- Преимущество 3 -->
            <div class="col-12 col-md-4">
                <div class="d-flex align-items-start p-1">
                    <div class="me-3 mt-1">
                        <div style="width: 8px; height: 8px; background-color: #198754;"></div>
                    </div>
                    <div>
                        <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Гарантия фабрики 2 года</h5>
                        <p class="text-muted-gray small mb-0">Мы уверены в используемой премиальной фурнитуре и прочности конструктива.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- БЛОК "ХИТЫ ПРОДАЖ" (ДИНАМИЧЕСКИЙ ВЫВОД) -->
<section class="bg-white py-4 py-md-5">
    <div class="container">
        <!-- Заголовок блока -->
        <div class="d-flex align-items-end justify-content-between mb-4 border-bottom border-subtle-gray pb-2">
            <h2 class="text-graphite fw-bold m-0 text-uppercase fs-4" style="letter-spacing: 1px;">Хиты продаж</h2>
            <a href="{{ route('catalog') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase d-none d-sm-block">
                Все товары &rarr;
            </a>
        </div>

        <!-- Сетка товаров (Mobile-First: 2 карточки на смартфонах, 4 на десктопе) -->
        <div class="row g-2 g-md-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                    <div class="card border border-subtle-gray w-100 d-flex flex-column bg-white">

                        <!-- Контейнер изображения товара -->
                        <div class="position-relative bg-light-block overflow-hidden">
                            <img src="{{ asset($product->image_path) }}"
                                 class="card-img-top product-card-img img-fluid"
                                 alt="{{ $product->name }}"
                                 loading="lazy">

                            <!-- Статус наличия -->
                            <div class="position-absolute top-0 start-0 m-2">
                                @if($product->stock > 0)
                                    <span class="badge badge-in-stock px-2 py-1 small text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">В наличии</span>
                                @else
                                    <span class="badge badge-on-order px-2 py-1 small text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Под заказ</span>
                                @endif
                            </div>
                        </div>

                        <!-- Информационная часть карточки -->
                        <div class="card-body p-2 p-md-3 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Название -->
                                <h3 class="card-title text-graphite fw-bold mb-1 p-0 m-0 fs-6 text-truncate" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </h3>

                                <!-- Адаптивное обрезание текста -->
                                <p class="card-text text-muted-gray mb-3 small d-none d-sm-block">
                                    {{ Str::limit($product->description, 60, '...') }}
                                </p>
                                <p class="card-text text-muted-gray mb-2 small d-block d-sm-none" style="font-size: 0.72rem; line-height: 1.2;">
                                    {{ Str::limit($product->description, 25, '...') }}
                                </p>
                            </div>

                            <div>
                                <!-- Нижняя планка: Цена и переход в каталог -->
                                <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between pt-2 border-top border-light">
                                    <span class="fs-5 fw-bold text-graphite mb-2 mb-sm-0">
                                        {{ number_format($product->price, 0, '.', ' ') }} ₽
                                    </span>

                                    <a href="{{ route('catalog') }}" class="btn btn-flux-outline btn-sm w-100 w-sm-auto px-2 py-2 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                        Подробнее
                                    </a>
                                </div>

                                <!-- Предупреждение о сроках под заказ для мобильных -->
                                @if($product->stock == 0)
                                    <div class="text-muted-gray mt-1 p-0 d-block d-sm-none" style="font-size: 0.6rem;">
                                        * Изготовление: 14 дней
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Мобильная кнопка перехода в каталог внизу секции -->
        <div class="text-center mt-3 d-block d-sm-none">
            <a href="{{ route('catalog') }}" class="btn btn-flux-outline w-100 py-2.5 text-uppercase fw-bold small">
                Смотреть весь каталог
            </a>
        </div>
    </div>
</section>
@endsection
