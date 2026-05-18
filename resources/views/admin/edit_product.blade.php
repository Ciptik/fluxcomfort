@extends('layouts.shop')

@section('content')
<div class="container py-3" style="color: #212529; font-family: system-ui, -apple-system, sans-serif; max-width: 650px;">
    
    <!-- ПРИНУДИТЕЛЬНЫЙ СБРОС ОКРУГЛЕНИЙ И ЕДИНЫЕ СТИЛИ ФОРМЫ -->
    <style>
        .rounded-0, .btn, .form-control, .alert, .badge {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        .form-control {
            border: 1px solid #DEE2E6;
            color: #212529;
            padding: 0.6rem 0.75rem;
            font-size: 0.9rem;
        }
        .form-control:focus {
            border-color: #212529;
            box-shadow: none;
            background-color: #FFFFFF;
        }
        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05rem;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
            color: #212529;
        }
        
        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 44px;
            }
            .btn-submit-mobile {
                height: 48px;
                font-size: 0.85rem !important;
            }
        }
    </style>

    <!-- ЗАГОЛОВОК СЕКЦИИ И НАВИГАЦИЯ НАЗАД -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-2 mb-4 border-bottom border-subtle-gray gap-2">
        <div>
            <span class="text-muted-gray text-uppercase font-monospace small d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Панель администратора / Ассортимент
            </span>
            <h1 class="fs-4 fs-md-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.03rem;">
                Редактирование: <span style="color: #198754;">{{ $product->name }}</span>
            </h1>
        </div>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-3 d-inline-flex align-items-center justify-content-center mobile-touch-target w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
            ← К ассортименту
        </a>
    </div>

    <!-- ВЫВОД ГЛОБАЛЬНЫХ ОШИБОК ИЛИ УВЕДОМЛЕНИЙ СЕССИИ -->
    @if(session('error'))
        <div class="alert alert-danger border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #dc3545 !important;" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- ГЛАВНАЯ ФОРМА МОДЕРНИЗАЦИИ ДАННЫХ ТОВАРА -->
    <form action="{{ url('/admin/products/' . $product->id . '/update') }}" method="POST" class="needs-validation">
        @csrf
        
        <div class="bg-light-block border border-subtle-gray p-3 p-md-4 mb-4">
            <div class="row g-3">
                
                <!-- НАЗВАНИЕ МОДЕЛИ -->
                <div class="col-12">
                    <label for="name" class="form-label">Название модели мебели *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control rounded-0 @error('name') border-danger @enderror" 
                           value="{{ old('name', $product->name) }}" 
                           required>
                    @error('name')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- ЦЕНА ТОВАРА -->
                <div class="col-12 col-md-6">
                    <label for="price" class="form-label">Цена (₽) *</label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           class="form-control rounded-0 font-monospace @error('price') border-danger @enderror" 
                           value="{{ old('price', $product->price) }}" 
                           required 
                           min="0">
                    @error('price')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- ОСТАТОК НА СКЛАДЕ -->
                <div class="col-12 col-md-6">
                    <label for="stock" class="form-label">Доступно на складе (шт) *</label>
                    <input type="number" 
                           id="stock" 
                           name="stock" 
                           class="form-control rounded-0 font-monospace @error('stock') border-danger @enderror" 
                           value="{{ old('stock', $product->stock) }}" 
                           required 
                           min="0">
                    @error('stock')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- ХАРАКТЕРИСТИКИ / ОПИСАНИЕ -->
                <div class="col-12">
                    <label for="description" class="form-label">Описание / Характеристики материала</label>
                    <textarea id="description" 
                              name="description" 
                              class="form-control rounded-0 @error('description') border-danger @enderror" 
                              rows="5" 
                              style="resize: vertical;">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

            </div>
        </div>

        <!-- МОНУМЕНТАЛЬНАЯ ГРАФИТОВАЯ КНОПКА ОТПРАВКИ -->
        <button type="submit" class="btn btn-dark w-100 rounded-0 text-uppercase fw-bold btn-submit-mobile d-flex align-items-center justify-content-center" style="font-size: 0.8rem; letter-spacing: 0.08rem; height: 52px; background-color: #212529;">
            Сохранить изменения в базе данных
        </button>
    </form>
</div>
@endsection
