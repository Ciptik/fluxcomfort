@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-4">

    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-end justify-content-between pb-3 mb-3 border-bottom border-subtle-gray">
        <div>
            <x-breadcrumbs :links="['Главная' => '/', 'Каталог' => '#']" />
            <h1 class="text-graphite fw-bold m-0 text-uppercase fs-3" style="letter-spacing: 1px;">Каталог продукции</h1>
        </div>
        <span class="text-muted-gray small mt-2 mt-md-0 font-monospace">Доступно: {{ $products->total() }} моделей</span>
    </div>

    <div class="row g-2 mb-3 align-items-center justify-content-between">
        <div class="col-12 col-md-auto d-md-none">
            <button class="btn btn-flux-outline w-100 text-uppercase fw-bold btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilterSidebar">
                Параметры фильтрации
            </button>
        </div>
        <div class="col-12 col-md-4 col-lg-3 ms-auto">
            <form method="GET" action="{{ route('catalog') }}" id="sortForm">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="price_from" value="{{ request('price_from') }}">
                <input type="hidden" name="price_to" value="{{ request('price_to') }}">
                <input type="hidden" name="in_stock" value="{{ request('in_stock') }}">
                <select class="form-select border-subtle-gray text-graphite small text-uppercase font-monospace" name="sort" onchange="document.getElementById('sortForm').submit();">
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>По умолчанию</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Сначала дешевле</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Сначала дороже</option>
                </select>
            </form>
        </div>
    </div>

    <div class="d-md-none mb-3 overflow-auto" style="white-space: nowrap;">
        <div class="d-inline-flex gap-2 pb-2">
            <a href="{{ route('catalog', request()->except('category')) }}" class="btn {{ !request('category') ? 'btn-flux-dark' : 'btn-flux-outline' }} btn-sm text-uppercase fw-bold px-3">Все модели</a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog', array_merge(request()->query(), ['category' => $cat->slug])) }}" class="btn {{ request('category') == $cat->slug ? 'btn-flux-dark' : 'btn-flux-outline' }} btn-sm text-uppercase fw-bold px-3">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    <div class="row g-4">
        <aside class="col-md-4 col-lg-3 d-none d-md-block">
            <form method="GET" action="{{ route('catalog') }}" class="p-3 bg-light-block border border-subtle-gray">
                @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                <div class="mb-4">
                    <h5 class="text-graphite fw-bold text-uppercase mb-2 font-monospace" style="font-size:0.75rem;">Категория мебели</h5>
                    <div class="list-group border border-subtle-gray rounded-0">
                        <a href="{{ route('catalog', request()->except('category')) }}" class="list-group-item list-group-item-action text-uppercase small py-2 px-3 {{ !request('category') ? 'bg-dark text-white' : 'text-graphite bg-white' }} border-0">Все модели</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('catalog', array_merge(request()->query(), ['category' => $cat->slug])) }}" class="list-group-item list-group-item-action text-uppercase small py-2 px-3 border-0 border-top border-subtle-gray {{ request('category') == $cat->slug ? 'bg-dark text-white' : 'text-graphite bg-white' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="text-graphite fw-bold text-uppercase mb-2 font-monospace" style="font-size:0.75rem;">Цена, ₽</h5>
                    <div class="d-flex align-items-center gap-2">
                        <input type="number" class="form-control form-control-sm text-center small" name="price_from" placeholder="от" value="{{ request('price_from') }}">
                        <span class="text-muted-gray">—</span>
                        <input type="number" class="form-control form-control-sm text-center small" name="price_to" placeholder="до" value="{{ request('price_to') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input rounded-0" type="checkbox" name="in_stock" value="1" id="filter_stock" {{ request('in_stock') ? 'checked' : '' }}>
                        <label class="form-check-label text-graphite small text-uppercase font-monospace" for="filter_stock">Только в наличии</label>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-flux-primary btn-sm py-2 text-uppercase fw-bold">Применить фильтр</button>
                    <a href="{{ route('catalog') }}" class="btn btn-flux-outline btn-sm py-2 text-uppercase fw-bold">Сбросить всё</a>
                </div>
            </form>
        </aside>

        <main class="col-12 col-md-8 col-lg-9">
            <div class="row g-2 g-md-3">
                @forelse($products as $product)
                    <div class="col-6 col-md-6 col-lg-4 d-flex align-items-stretch">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div class="col-12 py-5 text-center bg-light-block border border-subtle-gray">
                        <p class="text-muted-gray m-0 font-monospace text-uppercase">Моделей с такими критериями не найдено.</p>
                        <a href="{{ route('catalog') }}" class="btn btn-flux-outline btn-sm mt-3 text-uppercase fw-bold">Сбросить фильтры</a>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center mt-4 pt-3 border-top border-light">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </main>
    </div>
</div>

<div class="offcanvas offcanvas-start border-end border-subtle-gray bg-white rounded-0" tabindex="-1" id="mobileFilterSidebar" style="width: 290px;">
    <div class="offcanvas-header border-bottom border-subtle-gray py-3">
        <h5 class="offcanvas-title text-graphite fw-bold text-uppercase fs-6 m-0">Фильтры</h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-3">
        </div>
</div>
@endsection
