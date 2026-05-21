@props(['product'])

<div class="card border border-subtle-gray w-100 d-flex flex-column bg-white h-100">
    <div class="position-relative bg-light-block overflow-hidden border-bottom border-light">
        <img src="{{ $product->image_path ? asset($product->image_path) : 'data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%25%22 height=%22160%22><rect width=%22100%25%22 height=%22100%25%22 fill=%22%23F8F9FA%22/><text x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2212%22 fill=%22%236C757D%22>Fluxcomfort</text></svg>' }}"
             class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}" loading="lazy">
        <div class="position-absolute top-0 start-0 m-2">
            @if($product->stock > 0)
                <span class="badge badge-in-stock px-2 py-1 small text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">В наличии</span>
            @else
                <span class="badge badge-on-order px-2 py-1 small text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Под заказ</span>
            @endif
        </div>
    </div>

    <div class="card-body p-2 p-md-3 d-flex flex-column justify-content-between flex-grow-1">
        <div>
            <h3 class="card-title text-graphite fw-bold mb-1 fs-6 text-truncate text-uppercase" style="letter-spacing: 0.5px;" title="{{ $product->name }}">
                {{ $product->name }}
            </h3>
            <p class="card-text text-muted-gray mb-3 small text-wrap d-none d-sm-block" style="line-height: 1.4;">
                {{ Str::limit($product->description, 55, '...') }}
            </p>
        </div>

        <div class="mt-auto">
            <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between pt-2 border-top border-light gap-2">
                <span class="fs-5 fw-bold text-graphite">
                    {{ number_format($product->price, 0, '.', ' ') }} ₽
                </span>

                <div class="w-100">
                    @if(session('cart') && array_key_exists($product->id, session('cart')))
                        <div class="d-flex align-items-center justify-content-between border border-subtle-gray p-0 bg-light-block w-100" style="height: 44px;">
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="m-0 h-100 w-25">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link text-graphite w-100 h-100 p-0 text-decoration-none fw-bold border-0 d-flex align-items-center justify-content-center">—</button>
                            </form>
                            <div class="text-graphite fw-bold small text-center flex-grow-1">{{ session('cart')[$product->id]['quantity'] }} шт</div>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 h-100 w-25">
                                @csrf
                                <button type="submit" class="btn btn-link text-graphite w-100 h-100 p-0 text-decoration-none fw-bold border-0 d-flex align-items-center justify-content-center">+</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="m-0 w-100">
                            @csrf
                            @if($product->stock > 0)
                                <button type="submit" class="btn btn-flux-primary w-100 text-uppercase fw-bold btn-sm d-flex align-items-center justify-content-center" style="font-size: 0.72rem; letter-spacing: 0.5px;">В корзину</button>
                            @else
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-flux-outline w-100 text-uppercase fw-bold btn-sm d-flex align-items-center justify-content-center" style="font-size: 0.72rem; letter-spacing: 0.5px;">Предзаказ</a>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
