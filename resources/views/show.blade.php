@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
     
    @if(session('success') || session('error'))
        <div class="row mb-4">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success m-0 font-monospace small rounded-0">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger m-0 font-monospace small rounded-0">{{ session('error') }}</div>
                @endif
            </div>
        </div>
    @endif

    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem; font-size: 0.75rem;">
            <li class="breadcrumb-item"><a href="/" class="text-secondary text-decoration-none">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('catalog') }}" class="text-secondary text-decoration-none">Каталог</a></li>
            <li class="breadcrumb-item active text-graphite fw-bold" aria-current="page">{{ Str::upper($product->name) }}</li>
        </ol>
    </nav>

    <div class="row g-4 g-md-5">
         
        <div class="col-12 col-md-6">
            <div class="bg-light-block d-flex align-items-center justify-content-center border border-subtle-gray w-100 position-relative style-neutral" style="aspect-ratio: 4/3; border-radius: 0px !important;">
                @if($product->image_path && file_exists(public_path($product->image_path)))
                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="img-fluid object-fit-cover w-100 h-100" style="border-radius: 0px !important;">
                @else
                    <div class="text-center p-4 border border-dark border-1 m-3 w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-white" style="border-radius: 0px !important;">
                        <span class="fw-bold text-uppercase small mb-1" style="color: #212529; letter-spacing: 0.15rem;">Fluxcomfort</span>
                        <span class="text-secondary font-monospace small" style="font-size: 0.7rem;">[ ГРАФИЧЕСКИЙ МАКЕТ ГОТОВИТСЯ ]</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-secondary small font-monospace" style="font-size: 0.8rem;">АРТИКУЛ: #{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</span>
                    <span class="text-secondary text-uppercase small font-monospace" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        {{ $product->category->name ?? 'Заводская серия' }}
                    </span>
                </div>

                <h1 class="text-uppercase fw-bold mb-3 fs-3 fs-lg-2" style="color: #212529; letter-spacing: 0.02rem; line-height: 1.15;">
                    {{ $product->name }}
                </h1>

                <div class="mb-4">
                    @if($product->stock > 0)
                        <div class="p-3 border-start border-success border-3 bg-light-block d-flex align-items-center gap-2" style="border-radius: 0px !important;">
                            <span class="text-success small">●</span>
                            <div class="small">
                                <strong class="d-block text-uppercase" style="color: #212529; font-size: 0.75rem; letter-spacing: 0.05rem;">В наличии: {{ $product->stock }} шт.</strong>
                                <span class="text-secondary" style="font-size: 0.8rem;">Серийный выпуск готов к отгрузке со склада фабрики за 24 часа.</span>
                            </div>
                        </div>
                    @else
                        <div class="p-3 border-start border-secondary border-3 bg-light-block d-flex align-items-center gap-2" style="border-radius: 0px !important;">
                            <span class="text-secondary small">○</span>
                            <div class="small">
                                <strong class="d-block text-uppercase" style="color: #212529; font-size: 0.75rem; letter-spacing: 0.05rem;">ПОД ЗАКАЗ (Срок изготовления 14 дней)</strong>
                                <span class="text-secondary" style="font-size: 0.8rem;">Индивидуальный конвейерный цикл по стандартам Fluxcomfort.</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="py-3 mb-4 border-top border-bottom border-subtle-gray d-flex align-items-baseline justify-content-between">
                    <span class="text-secondary small text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05rem;">Цена фабрики:</span>
                    <span class="fs-2 fw-bold" style="color: #198754;">{{ number_format($product->price, 0, '.', ' ') }} ₽</span>
                </div>
            </div>

            <div class="mb-2">
                @php
                    $cart = session()->get('cart', []);
                    $alreadyInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
                    $isLimitReached = ($alreadyInCart >= $product->stock);
                @endphp

                @if($product->stock <= 0)
                    <button type="button" class="btn btn-secondary w-100 text-uppercase fw-bold text-muted border-subtle-gray bg-light-block" style="font-size: 0.85rem; letter-spacing: 0.05rem; height: 52px; border-radius: 0px !important;" disabled>
                        Нет в наличии
                    </button>
                @elseif($alreadyInCart > 0)
                    <div class="d-flex align-items-center justify-content-between border border-subtle-gray w-100 bg-white" style="height: 52px; border-radius: 0px !important;">
                        
                        <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="m-0 h-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn border-0 h-100 px-4 d-flex align-items-center justify-content-center text-graphite font-monospace fw-bold" style="font-size: 1.4rem; background: transparent; transition: background 0.15s; border-radius: 0px !important;">
                                –
                            </button>
                        </form>

                        <div class="font-monospace fw-bold text-graphite flex-grow-1 text-center bg-light-block h-100 d-flex align-items-center justify-content-center border-start border-end border-subtle-gray text-uppercase small" style="letter-spacing: 0.05rem; font-size: 0.85rem;">
                            В корзине: {{ $alreadyInCart }} шт
                        </div>

                        @if($isLimitReached)
                            <button type="button" class="btn border-0 h-100 px-4 d-flex align-items-center justify-content-center text-muted font-monospace fw-bold opacity-50" disabled style="font-size: 1.4rem; cursor: not-allowed; background: #f8f9fa; border-radius: 0px !important;">
                                +
                            </button>
                        @else
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 h-100">
                                @csrf
                                <button type="submit" class="btn border-0 h-100 px-4 d-flex align-items-center justify-content-center text-graphite font-monospace fw-bold" style="font-size: 1.4rem; background: transparent; transition: background 0.15s; border-radius: 0px !important;">
                                    +
                                </button>
                            </form>
                        @endif

                    </div>
                @else
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-success w-100 text-uppercase fw-bold d-flex align-items-center justify-content-center" style="font-size: 0.85rem; letter-spacing: 0.05rem; height: 52px; background-color: #198754; border: none; border-radius: 0px !important;">
                            Добавить в корзину
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-5">
        <hr class="border-dark opacity-100 m-0 mb-4">
         
        <div class="row g-4">
            <div class="col-12 col-md-7">
                <h2 class="text-uppercase fw-bold mb-3 fs-6" style="color: #212529; letter-spacing: 0.05rem;">
                    Техническое описание модели
                </h2>
                <div class="text-secondary lh-base text-wrap pe-md-4" style="font-size: 0.9rem; text-align: justify;">
                    {{ $product->description ?? 'Описание мебельного изделия подготавливается технологическим отделом фабрики.' }}
                </div>
            </div>

            <div class="col-12 col-md-5">
                <h2 class="text-uppercase fw-bold mb-3 fs-6" style="color: #212529; letter-spacing: 0.05rem;">
                    Спецификация конструкции
                </h2>
                <div class="border-top border-subtle-gray">
                    <div class="d-flex justify-content-between py-2 border-bottom border-subtle-gray align-items-center" style="font-size: 0.85rem;">
                        <span class="text-secondary">Несущий каркас:</span>
                        <span class="fw-semibold" style="color: #212529;">МДФ / ЛДСП класса эмиссии Е1</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom border-subtle-gray align-items-center" style="font-size: 0.85rem;">
                        <span class="text-secondary">Узлы и фурнитура:</span>
                        <span class="fw-semibold" style="color: #212529;">Легированная сталь (Усиленная)</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom border-subtle-gray align-items-center" style="font-size: 0.85rem;">
                        <span class="text-secondary">Контроль геометрии:</span>
                        <span class="fw-semibold" style="color: #212529;">Лазерный ЧПУ раскрой</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom border-subtle-gray align-items-center" style="font-size: 0.85rem;">
                        <span class="text-secondary">Гарантия ОТК фабрики:</span>
                        <span class="fw-semibold" style="color: #212529;">24 месяца со дня сборки</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
