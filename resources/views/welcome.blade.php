@extends('layouts.shop')

@section('content')
<section class="text-white py-4 py-md-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8">
                <span class="text-uppercase text-muted-gray small mb-2 d-block font-monospace" style="letter-spacing: 2px;">Архитектура интерьера</span>
                <h1 class="display-5 fw-bold mb-3 text-white">Мебельная фабрика Fluxcomfort.</h1>
                <p class="fs-5 mb-4 text-light opacity-75 fw-light text-wrap">
                    Производство и продажа корпусной и мягкой мебели. Строгая геометрия, премиальное исполнение и отсутствие лишних деталей.
                </p>
                <a href="{{ route('catalog') }}" class="btn btn-flux-primary px-4 d-flex d-sm-inline-flex align-items-center justify-content-center text-uppercase fw-bold">Перейти в каталог</a>
            </div>
        </div>
    </div>
</section>

<section class="bg-light-block border-bottom border-subtle-gray py-4">
    <div class="container">
        <div class="row g-3 g-md-4">
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Собственное производство</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Контроль качества на каждом технологическом этапе.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Доставка и сборка</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Собственная логистическая служба доставит мебель за 1 день.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Гарантия 2 года</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Уверены в используемой премиальной фурнитуре.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-4 py-md-5">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-4 border-bottom border-subtle-gray pb-2">
            <h2 class="text-graphite fw-bold m-0 text-uppercase fs-4" style="letter-spacing: 1px;">Хиты продаж</h2>
            <a href="{{ route('catalog') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase d-none d-sm-block">Все товары &rarr;</a>
        </div>
        
        <div class="row g-2 g-md-4">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="d-block d-sm-none mt-3">
            <a href="{{ route('catalog') }}" class="btn btn-flux-outline w-100 d-flex align-items-center justify-content-center text-uppercase fw-bold small">Смотреть весь каталог</a>
        </div>
    </div>
</section>
@endsection
