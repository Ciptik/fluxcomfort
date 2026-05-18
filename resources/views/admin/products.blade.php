@extends('layouts.shop')

@section('content')
<div class="container py-3" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ПРИНУДИТЕЛЬНЫЙ СБРОС ОКРУГЛЕНИЙ ДЛЯ ВСЕХ КОМПОНЕНТОВ ПАНЕЛИ -->
    <style>
        .rounded-0, .btn, .form-select, .badge, .table, .card, .alert, .nav-link {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        /* Стили для кастомных вкладок управления */
        .nav-admin .nav-link {
            color: #212529;
            border: 1px solid transparent;
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.05rem;
            transition: none;
        }
        .nav-admin .nav-link.active {
            background-color: #212529 !important;
            color: #FFFFFF !important;
            border-color: #212529 !important;
        }
        .nav-admin .nav-link:not(.active):hover {
            background-color: #F8F9FA;
            border-color: #DEE2E6;
            color: #212529;
        }

        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 44px;
            }
            .nav-admin .nav-link {
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                height: 46px;
                font-size: 0.7rem;
                padding: 5px 2px;
            }
        }
    </style>

    <!-- ЗАГОЛОВОК ПАНЕЛИ -->
    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom border-subtle-gray">
        <h1 class="fs-4 fs-md-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.03rem;">
            Управление ассортиментом <span style="color: #198754;">Fluxcomfort</span>
        </h1>
        <span class="badge bg-dark px-3 py-2 text-uppercase d-none d-sm-inline-block" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
            Панель администратора
        </span>
    </div>

    <!-- МЕНЮ НАВИГАЦИИ АДМИНИСТРАТОРА (ТЕПЕРЬ В ПОЛНОМ СОГЛАСИИ) -->
    <div class="mb-4 border-bottom border-subtle-gray">
        <ul class="nav nav-admin row g-0">
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link w-100 px-md-4 py-md-2" href="{{ route('admin.dashboard') }}">
                    📦 Заказы фабрики
                </a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link active w-100 px-md-4 py-md-2" href="{{ route('admin.products') }}">
                    🪑 Ассортимент (Товары)
                </a>
            </li>
            <li class="nav-item col-12 col-md-auto">
                <a class="nav-link w-100 px-md-4 py-md-2 border-top border-md-0" href="{{ route('admin.users') }}">
                    👥 Пользователи
                </a>
            </li>
        </ul>
    </div>

    <!-- УВЕДОМЛЕНИЯ ОБ УСПЕШНЫХ ДЕЙСТВИЯХ -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #198754 !important;" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- ДЕСКТОПНАЯ СТРОГАЯ ТАБЛИЦА ТОВАРОВ (ЭКРАНЫ >= 768px) -->
    <div class="table-responsive d-none d-md-block bg-white border border-subtle-gray">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
            <thead class="bg-light-block text-graphite text-uppercase small fw-bold border-bottom border-subtle-gray">
                <tr>
                    <th scope="col" class="py-3 px-4 border-subtle-gray" style="width: 80px;">ID</th>
                    <th scope="col" class="py-3 border-subtle-gray">Наименование модели</th>
                    <th scope="col" class="py-3 border-subtle-gray">Категория</th>
                    <th scope="col" class="py-3 border-subtle-gray">Цена</th>
                    <th scope="col" class="py-3 text-center border-subtle-gray" style="width: 180px;">Склад (Остаток)</th>
                    <th scope="col" class="py-3 text-end px-4 border-subtle-gray" style="width: 150px;">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-bottom border-subtle-gray">
                        <td class="py-3 px-4 text-muted-gray border-subtle-gray">#{{ $product->id }}</td>
                        <td class="py-3 fw-bold text-graphite border-subtle-gray">{{ $product->name }}</td>
                        <td class="py-3 border-subtle-gray">
                            <span class="badge bg-light text-dark border border-dark-subtle px-2 py-1 text-uppercase font-monospace" style="font-size: 0.7rem;">
                                {{ $product->category_name }}
                            </span>
                        </td>
                        <td class="py-3 border-subtle-gray fw-bold fs-6" style="color: #198754;">
                            {{ number_format($product->price, 0, '.', ' ') }} ₽
                        </td>
                        <td class="py-3 text-center border-subtle-gray">
                            @if($product->stock > 0)
                                <span class="fw-bold" style="color: #198754;">{{ $product->stock }} шт.</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1 text-uppercase font-monospace" style="font-size: 0.7rem;">НЕТ</span>
                            @endif
                        </td>
                        <td class="py-3 text-end px-4 border-subtle-gray">
                            <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="btn btn-outline-dark btn-sm rounded-0 text-uppercase fw-bold px-3" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                ✏️ Изменить
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- МОБИЛЬНАЯ АДАПТИВНАЯ ВЕРСТКА КАРТОЧКАМИ (ЭКРАНЫ < 768px) -->
    <div class="d-md-none d-flex flex-column gap-3">
        @foreach($products as $product)
            <div class="border border-subtle-gray p-3 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <span class="text-muted-gray small d-block mb-1">#{{ $product->id }}</span>
                        <h2 class="text-graphite fw-bold fs-5 mb-1">{{ $product->name }}</h2>
                        <span class="badge bg-light text-dark border border-dark-subtle px-2 py-0.5 text-uppercase font-monospace" style="font-size: 0.65rem;">
                            {{ $product->category_name }}
                        </span>
                    </div>
                    <div class="fs-5 fw-bold text-end" style="color: #198754;">
                        {{ number_format($product->price, 0, '.', ' ') }} ₽
                    </div>
                </div>

                <div class="bg-light-block p-2 mb-3 border border-subtle-gray d-flex justify-content-between align-items-center" style="font-size: 0.85rem;">
                    <span class="text-muted-gray">Остаток на фабрике:</span>
                    @if($product->stock > 0)
                        <strong class="text-graphite fw-bold fs-6">{{ $product->stock }} шт.</strong>
                    @else
                        <strong class="text-danger text-uppercase font-monospace small fw-bold">Нет на складе</strong>
                    @endif
                </div>

                <!-- Кнопка действия с тач-зоной под палец (44px) -->
                <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="btn btn-dark w-100 rounded-0 text-uppercase fw-bold mobile-touch-target d-flex align-items-center justify-content-center" style="font-size: 0.8rem; letter-spacing: 0.05rem;">
                    ✏️ Редактировать модель
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
