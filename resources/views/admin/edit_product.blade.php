@extends('layouts.shop')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="pb-2 mb-4 border-bottom border-dark">
        <a href="{{ route('admin.products') }}" class="text-decoration-none text-dark small fw-bold text-uppercase">← Вернуться к списку</a>
        <h1 class="h3 fw-bold text-uppercase mt-2 mb-0">Редактирование: {{ $product->name }}</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-0 mb-4 border-0">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-4 border border-secondary-subtle shadow-sm">
        <form action="{{ url('/admin/products/' . $product->id . '/update') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted">Название модели мебели</label>
                <input type="text" name="name" class="form-control rounded-0" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label small fw-bold text-uppercase text-muted">Цена (₽)</label>
                    <input type="number" name="price" class="form-control rounded-0" value="{{ old('price', $product->price) }}" required min="0">
                </div>
                <div class="col-6">
                    <label class="form-label small fw-bold text-uppercase text-muted">Доступно на складе (шт)</label>
                    <input type="number" name="stock" class="form-control rounded-0" value="{{ old('stock', $product->stock) }}" required min="0">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase text-muted">Описание / Характеристики материала</label>
                <textarea name="description" class="form-control rounded-0" rows="5">{{ old('description', $product->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success rounded-0 w-100 py-2.5 text-uppercase fw-bold border-0">
                Сохранить изменения в базе
            </button>
        </form>
    </div>
</div>
@endsection
