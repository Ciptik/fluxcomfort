@extends('layouts.shop')

@section('content')
<div class="container py-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    @if(session('success'))
        <div class="alert alert-success rounded-0 border-0 font-monospace mb-4 p-3" style="background-color: #d1e7dd; color: #0f5132;">
            // {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger rounded-0 border-0 font-monospace mb-4 p-3" style="background-color: #f8d7da; color: #842029;">
            // {{ session('error') }}
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center border-bottom border-dark pb-3 mb-4 gap-3">
        <div>
            <span class="text-uppercase text-muted font-monospace small" style="font-size: 0.7rem; letter-spacing: 1px;">PRODUCTION // КАТАЛОГ СИСТЕМЫ</span>
            <h1 class="text-uppercase fw-bold text-graphite m-0 fs-3" style="letter-spacing: -0.5px;">Контроль моделей мебели</h1>
        </div>
        <div class="d-flex gap-2 w-100 w-sm-auto">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 py-2 fs-6" style="letter-spacing: 0.05rem;">🔙 Заказы</a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 py-2 fs-6" style="letter-spacing: 0.05rem;">➕ Новая модель</a>
        </div>
    </div>

    <div class="table-responsive border border-subtle-gray">
        <table class="table table-striped m-0 align-middle font-monospace fs-6">
            <thead class="table-dark text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Название</th>
                    <th class="p-3">Цена</th>
                    <th class="p-3">Склад</th>
                    <th class="p-3 text-end">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="p-3 fw-bold">#{{ $product->id }}</td>
                    <td class="p-3 text-uppercase text-graphite fw-bold">{{ $product->name }}</td>
                    <td class="p-3">{{ number_format($product->price, 0, '.', ' ') }} ₽</td>
                    <td class="p-3">{{ $product->stock }} шт.</td>
                    <td class="p-3 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-3 py-1 fs-6">
                                📝 Редактировать
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="m-0" onsubmit="return confirm('Удалить товар {{ $product->name }} из каталога?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-3 py-1 fs-6">
                                    🗑️ Удалить
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
