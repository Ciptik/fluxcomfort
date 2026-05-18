@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- СБРОС СТИЛЕЙ И ФИКСАЦИЯ ГЕОМЕТРИИ FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .form-control, .badge, .alert, .breadcrumb-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .text-accent-green { color: #198754; }
        .bg-accent-green { background-color: #198754; }
        
        /* Кнопки и инпуты без анимаций, мгновенный строгий отклик */
        .btn-flux-primary {
            background-color: #198754;
            color: #FFFFFF;
            border: 1px solid #198754;
            transition: none;
        }
        .btn-flux-primary:hover {
            background-color: #146c43;
            border-color: #146c43;
            color: #FFFFFF;
        }
        .btn-flux-secondary {
            background-color: #212529;
            color: #FFFFFF;
            border: 1px solid #212529;
            transition: none;
        }
        .btn-flux-secondary:hover {
            background-color: #000000;
            border-color: #000000;
            color: #FFFFFF;
        }

        /* Адаптивная высота под палец для мобильных устройств */
        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 48px;
            }
        }
    </style>

    <!-- НАВИГАЦИОННАЯ ЦЕПОЧКА (ХЛЕБНЫЕ КРОШКИ) -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
            <li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Каталог</a></li>
            <li class="breadcrumb-item active text-graphite fw-semibold" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- ДВУХКОЛОНОЧНЫЙ РАЗВОРOT ТОВАРА -->
    <div class="row g-4 g-lg-5">
        
        <!-- ЛЕВАЯ КОЛОНКА: ВИЗУАЛ -->
        <div class="col-12 col-md-6">
            <div class="bg-light-block d-flex align-items-center justify-content-center border border-subtle-gray w-100 position-relative" style="aspect-ratio: 4/3;">
                @if($product->image_path)
                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="img-fluid object-fit-cover w-100 h-100">
                @else
                    <!-- Строгая минималистичная заглушка при отсутствии фото -->
                    <div class="text-center p-4">
                        <span class="text-muted-gray text-uppercase small d-block mb-1" style="letter-spacing: 0.1rem;">Fluxcomfort</span>
                        <span class="text-muted-gray font-monospace small">[ Изображение готовится ]</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- ПРАВАЯ КОЛОНКА: КОММЕРЧЕСКИЙ БЛОК -->
        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
            <div>
                <!-- Идентификатор и Категория -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted-gray small font-monospace">ID: #{{ $product->id }}</span>
                    <span class="badge bg-light text-graphite border border-subtle-gray text-uppercase font-monospace px-2 py-1" style="font-size: 0.7rem; letter-spacing: 0.02rem;">
                        {{ $product->category_name ?? 'Фабричная модель' }}
                    </span>
                </div>

                <!-- Название модели -->
                <h1 class="text-uppercase fw-bold text-graphite mb-3 fs-3 fs-lg-2" style="letter-spacing: 0.02rem; line-height: 1.1;">
                    {{ $product->name }}
                </h1>

                <!-- Цена -->
                <div class="py-2 mb-3 border-top border-bottom border-subtle-gray d-flex align-items-baseline gap-2">
                    <span class="text-muted-gray small text-uppercase" style="font-size: 0.75rem;">Стоимость:</span>
                    <span class="fs-2 fw-bold text-accent-green">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                </div>

                <!-- Блок статуса склада фабрики -->
                <div class="mb-4">
                    @if($product->stock > 0)
                        <div class="p-3 border border-success-subtle bg-light-block border-start border-3 d-flex align-items-center gap-2" style="border-color: #198754 !important;">
                            <span class="text-accent-green fs-5">●</span>
                            <div class="small">
                                <strong class="text-graphite d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.02rem;">В наличии на складе</strong>
                                <span class="text-muted-gray">Готово к отправке, доставка фабрики 1-2 дня.</span>
                            </div>
                        </div>
                    @else
                        <div class="p-3 border border-warning-subtle bg-light-block border-start border-3 d-flex align-items-center gap-2" style="border-color: #212529 !important;">
                            <span class="text-graphite fs-5">○</span>
                            <div class="small">
                                <strong class="text-graphite d-block text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.02rem;">Под заказ</strong>
                                <span class="text-muted-gray">Срок изготовления на производстве — 7 рабочих дней.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ФОРМА ОТПРАВКИ В КОРЗИНУ / ОФОРМЛЕНИЯ ПРЕДЗАКАЗА -->
            <div class="mb-4 mb-md-0">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    
                    @if($product->stock > 0)
                        <!-- Блок выбора количества + Кнопка (В наличии) -->
                        <div class="row g-2">
                            <div class="col-4 col-md-3">
                                <label for="quantity" class="visually-hidden">Количество</label>
                                <select name="quantity" id="quantity" class="form-select form-select-lg text-center rounded-0 border-subtle-gray font-monospace mobile-touch-target fw-bold text-graphite" style="font-size: 0.95rem;">
                                    @for($i = 1; $i <= min($product->stock, 10); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-8 col-md-9">
                                <button type="submit" class="btn btn-flux-primary btn-lg w-100 rounded-0 text-uppercase fw-bold mobile-touch-target d-flex align-items-center justify-content-center" style="font-size: 0.85rem; letter-spacing: 0.05rem;">
                                    🛒 Добавить в корзину
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Кнопка предзаказа (Если нет на складе) -->
                        <button type="submit" class="btn btn-flux-secondary btn-lg w-100 rounded-0 text-uppercase fw-bold mobile-touch-target d-flex align-items-center justify-content-center" style="font-size: 0.85rem; letter-spacing: 0.05rem;">
                            🛠️ Оформить предзаказ
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- ТЕХНИЧЕСКИЕ ХАРАКТЕРИСТИКИ И МАТЕРИАЛЫ -->
    <div class="mt-5 pt-4 border-top border-subtle-gray">
        <h2 class="text-uppercase fw-bold text-graphite mb-3 fs-5" style="letter-spacing: 0.05rem;">
            Технические характеристики и материалы
        </h2>
        <div class="bg-light-block p-3 p-md-4 border border-subtle-gray">
            <div class="text-graphite lh-base text-wrap" style="font-size: 0.95rem; white-space: pre-line;">
                {{ $product->description ?? 'Описание и спецификации данной модели мебели в данный момент обновляются конструкторским бюро фабрики.' }}
            </div>
        </div>
    </div>
</div>
@endsection
