@props(['product'])

@php
    // Получаем текущую корзину из сессии
    $cart = session()->get('cart', []);
    // Проверяем, сколько единиц этого конкретного товара уже добавлено
    $alreadyInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
    // Флаг: достигнут ли лимит склада
    $isLimitReached = (isset($product->stock) && $alreadyInCart >= $product->stock);
@endphp

<div class="card product-card h-100 bg-white border border-subtle-gray d-flex flex-column w-100" style="transition: border-color 0.15s ease-in-out;">
    <div class="position-relative overflow-hidden bg-light-block border-bottom border-subtle-gray" style="height: 220px;">
        <a href="{{ route('catalog.show', $product->id) }}" class="d-block h-100 w-100">
            <img src="{{ !empty($product->image_path) ? asset($product->image_path) : 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>' }}" 
                 class="w-100 h-100 object-fit-cover" 
                 alt="{{ $product->name }}"
                 onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22100%25%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2210%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>';">
        </a>
    </div>

    <div class="card-body p-3 d-flex flex-column flex-grow-1">
        <div class="mb-1">
            <a href="{{ route('catalog.show', $product->id) }}" class="text-graphite text-decoration-none text-uppercase fw-bold small d-block text-truncate" style="letter-spacing: 0.5px;">
                {{ $product->name }}
            </a>
        </div>
        
        <p class="text-muted-gray small mb-3 flex-grow-1 opacity-75" style="font-size: 0.78rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
            {{ $product->description ?? 'Архитектурное решение фабрики Fluxcomfort.' }}
        </p>

        <div class="pt-2 border-top border-subtle-gray mt-auto">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="font-monospace text-graphite fw-bold" style="font-size: 1.05rem;">
                    {{ number_format($product->price, 0, '.', ' ') }} ₽
                </span>
                
                <span class="font-monospace small {{ $product->stock <= 0 ? 'text-danger' : 'text-muted-gray' }}" style="font-size: 0.65rem;">
                    @if($product->stock <= 0)
                        Нет в наличии
                    @else
                        Склад: {{ $product->stock }} шт.
                    @endif
                </span>
            </div>

            <div class="d-grid" style="min-height: 38px;">
                @if($product->stock <= 0)
                    <button type="button" class="btn btn-secondary py-2 text-uppercase fw-bold small opacity-50" disabled style="font-size: 0.68rem; cursor: not-allowed; border-radius:0px;">
                        Нет в наличии
                    </button>
                @elseif($alreadyInCart > 0)
                    <div class="d-flex align-items-center justify-content-between border border-subtle-gray bg-white w-100" style="height: 38px;">
                        
                        <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="m-0 h-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn border-0 h-100 px-3 d-flex align-items-center justify-content-center text-graphite font-monospace fw-bold" style="font-size: 1.1rem; background: transparent; transition: background 0.1s;">
                                –
                            </button>
                        </form>

                        <div class="font-monospace fw-bold text-graphite small flex-grow-1 text-center bg-light-block h-100 d-flex align-items-center justify-content-center border-start border-end border-subtle-gray">
                            {{ $alreadyInCart }} шт
                        </div>

                        @if($isLimitReached)
                            <button type="button" class="btn border-0 h-100 px-3 d-flex align-items-center justify-content-center text-muted font-monospace fw-bold opacity-50" disabled style="font-size: 1.1rem; cursor: not-allowed; background: #e9ecef;">
                                +
                            </button>
                        @else
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 h-100">
                                @csrf
                                <button type="submit" class="btn border-0 h-100 px-3 d-flex align-items-center justify-content-center text-graphite font-monospace fw-bold" style="font-size: 1.1rem; background: transparent; transition: background 0.1s;">
                                    +
                                </button>
                            </form>
                        @endif

                    </div>
                @else
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 d-grid">
                        @csrf
                        <button type="submit" class="btn btn-flux-primary py-2 text-uppercase fw-bold small" style="font-size: 0.68rem; height: 38px;">
                            + Добавить
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .product-card:hover {
        border-color: #212529 !important;
    }
    .product-card .btn:hover:not(:disabled) {
        background-color: #f8f9fa !important;
    }
</style>
