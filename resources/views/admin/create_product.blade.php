@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- СТИЛИ СБРОСА СКРУГЛЕНИЙ И ПРОМЫШЛЕННОГО МИНИМАЛИЗМА -->
    <style>
        .rounded-0, .btn, .form-control, .form-select, .alert {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529 !important; }
        .text-muted-gray { color: #6C757D !important; }
        .bg-light-block { background-color: #F8F9FA !important; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        /* Кастомный фокус для инпутов в стиле Fluxcomfort */
        .form-control:focus, .form-select:focus {
            border-color: #212529 !important;
            box-shadow: none !important;
            background-color: #ffffff;
        }
        
        /* Кнопки */
        .btn-factory-success {
            background-color: #198754 !important;
            color: #ffffff !important;
            border: none !important;
            transition: background-color 0.15s ease-in-out;
        }
        .btn-factory-success:hover {
            background-color: #146c43 !important;
        }
        .btn-factory-outline {
            border: 1px solid #212529 !important;
            color: #212529 !important;
            background: transparent !important;
            transition: all 0.15s ease-in-out;
        }
        .btn-factory-outline:hover {
            background-color: #212529 !important;
            color: #ffffff !important;
        }
    </style>

    <!-- ВЕРХНЯЯ НАВИГАЦИОННАЯ ПАНЕЛЬ -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4 border-bottom border-subtle-gray pb-3">
        <div>
            <h1 class="fs-4 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
                Добавление новой модели мебели
            </h1>
            <span class="text-muted-gray small font-monospace text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.02rem;">
                Панель управления фабрикой / Ассортимент
            </span>
        </div>
        <a href="{{ route('admin.products') }}" class="btn btn-factory-outline btn-sm rounded-0 text-uppercase fw-bold w-100 w-sm-auto px-3 py-2" style="font-size: 0.75rem; letter-spacing: 0.05rem; min-height: 44px; display: inline-flex; align-items: center; justify-content: center;">
            ← К ассортименту
        </a>
    </div>

    <!-- ФОРМА ДОБАВЛЕНИЯ ТОВАРА -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="m-0">
        @csrf

        <div class="row g-4">
            <!-- ЛЕВАЯ СЕКЦИЯ: ТЕХНИЧЕСКИЕ ПАРАМЕТРЫ И ОПИСАНИЕ -->
            <div class="col-12 col-md-8">
                <div class="bg-light-block border border-subtle-gray p-3 p-md-4">
                    
                    <!-- Наименование изделия -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                            Наименование мебельного изделия <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" value="{{ old('name') }}" placeholder="Например: Обеденный стол Flux-M1" required>
                        @error('name')
                            <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                        @enderror
                    </div>

                    <!-- Описание и характеристики -->
                    <div class="mb-0">
                        <label for="description" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                            Техническое описание и характеристики конструкции
                        </label>
                        <textarea name="description" id="description" rows="5" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite text-wrap" placeholder="Укажите используемые материалы, особенности раскроя ЧПУ, узлы фурнитуры и нюансы сборки модели...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- ПРАВАЯ СЕКЦИЯ: ЛОГИСТИКА, СТАТУС, МЕДИА -->
            <div class="col-12 col-md-4">
                <div class="d-flex flex-column gap-4">
                    
                    <!-- БЛОК: КАТЕГОРИЗАЦИЯ И УЧЕТ -->
                    <div class="bg-light-block border border-subtle-gray p-3 p-md-4">
                        
                        <!-- Категория -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                Категория мебели <span class="text-danger">*</span>
                            </label>
                            <select name="category_id" id="category_id" class="form-select rounded-0 border-subtle-gray bg-white py-2 text-graphite" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Выберите заводскую серию...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                            @enderror
                        </div>

                        <!-- Отпускная цена -->
                        <div class="mb-3">
                            <label for="price" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                Стоимость фабрики (₽) <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="price" id="price" min="0" step="1" class="form-control rounded-0 border-subtle-gray bg-white py-2 font-monospace text-graphite" value="{{ old('price') }}" placeholder="0" required>
                            @error('price')
                                <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                            @enderror
                        </div>

                        <!-- Складской остаток -->
                        <div class="mb-0">
                            <label for="stock" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                Объем партии на складе (шт.) <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="stock" id="stock" min="0" step="1" class="form-control rounded-0 border-subtle-gray bg-white py-2 font-monospace text-graphite" value="{{ old('stock') }}" placeholder="0" required>
                            <div class="form-text text-muted-gray mt-1 font-monospace" style="font-size: 0.7rem; line-height: 1.2;">
                                [ Значение 0 переведет модель в статус «ПОД ЗАКАЗ (14 ДНЕЙ)» ]
                            </div>
                            @error('stock')
                                <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- БЛОК: ЧЕРТЕЖИ И ВИЗУАЛИЗАЦИЯ -->
                    <div class="bg-light-block border border-subtle-gray p-3 p-md-4">
                        <div class="mb-0">
                            <label for="image" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                Графический макет / Изображение
                            </label>
                            <input type="file" name="image" id="image" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" accept="image/*">
                            <div class="form-text text-muted-gray mt-1 font-monospace" style="font-size: 0.7rem; line-height: 1.2;">
                                Допустимые форматы: JPEG, PNG. Оптимальное соотношение сторон рендера — 4:3.
                            </div>
                            @error('image')
                                <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- СЕКЦИЯ ДЕЙСТВИЯ: ФИКСАЦИЯ В КАТАЛОГЕ -->
        <div class="mt-4">
            <button type="submit" class="btn btn-factory-success w-100 text-uppercase fw-bold rounded-0 py-3" style="font-size: 0.85rem; letter-spacing: 0.08rem; min-height: 52px;">
                Запустить модель в каталог фабрики
            </button>
        </div>

    </form>
</div>
@endsection
