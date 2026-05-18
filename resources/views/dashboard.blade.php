@extends('layouts.app')

@section('content')
<div class="container py-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- СТИЛИ ДЛЯ ПРИНУДИТЕЛЬНОГО СБРОСА СКРУГЛЕНИЙ (КОНЦЕПТ СТРОГОГО МИНИМАЛИЗМА) -->
    <style>
        .rounded-0, .btn, .card, .badge, .form-control, .table, .list-group-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .btn-accent { 
            background-color: #198754; 
            color: #ffffff; 
            border: none;
        }
        .btn-accent:hover { 
            background-color: #146c43; 
            color: #ffffff;
        }
        .btn-outline-dark {
            border: 1px solid #212529;
            color: #212529;
            background: transparent;
        }
        .btn-outline-dark:hover {
            background-color: #212529;
            color: #ffffff;
        }
    </style>

    <!-- ЗАГОЛОВОК СТРАНИЦЫ -->
    <h1 class="fs-3 fs-md-2 mb-4 text-uppercase fw-bold text-graphite border-bottom border-subtle-gray pb-2">
        Личный кабинет: {{ Auth::user()->name }}
    </h1>

    <!-- ВЕРХНИЙ БЛОК: ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ -->
    <div class="bg-light-block border border-subtle-gray p-3 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-8">
                <div class="row g-2 fs-6">
                    <div class="col-12 col-sm-4">
                        <span class="text-muted-gray small d-block d-sm-inline">Email:</span> 
                        <strong class="text-graphite">{{ Auth::user()->email }}</strong>
                    </div>
                    <div class="col-12 col-sm-4">
                        <span class="text-muted-gray small d-block d-sm-inline">Телефон:</span> 
                        <strong class="text-graphite">{{ Auth::user()->phone ?? 'Не указан' }}</strong>
                    </div>
                    <div class="col-12 col-sm-4">
                        <span class="text-muted-gray small d-block d-sm-inline">Адрес:</span> 
                        <strong class="text-graphite">{{ Auth::user()->address ?? 'Не указан' }}</strong>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-md-end">
                <a href="#" class="btn btn-outline-dark btn-sm rounded-0 w-100 w-md-auto py-2 px-3 text-uppercase fw-semibold" style="font-size: 0.8rem; letter-spacing: 0.05rem;">
                    Редактировать профиль
                </a>
            </div>
        </div>
    </div>

    <!-- БЛОК: ИСТОРИЯ ЗАКАЗОВ -->
    <div class="mb-2">
        <h2 class="fs-5 text-uppercase fw-bold text-graphite mb-3" style="letter-spacing: 0.05rem;">
            История заказов
        </h2>

        @if($orders->isEmpty())
            <!-- ПУСТОЕ СОСТОЯНИЕ -->
            <div class="border border-subtle-gray p-4 text-center bg-white">
                <p class="text-muted-gray mb-3 fs-6">У вас пока нет активных заказов на мебель.</p>
                <a href="/catalog" class="btn btn-accent rounded-0 px-4 py-2 text-uppercase fw-semibold btn-sm" style="letter-spacing: 0.05rem;">
                    Перейти в каталог
                </a>
            </div>
        @else
            <!-- ДЕСКТОПНАЯ ТАБЛИЦА (ЭКРАНЫ >= 768px) -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-bordered border-subtle-gray align-middle bg-white mb-0" style="font-size: 0.95rem;">
                    <thead class="bg-light-block text-graphite text-uppercase small fw-bold">
                        <tr>
                            <th scope="col" class="py-3 border-subtle-gray ps-3">Заказ</th>
                            <th scope="col" class="py-3 border-subtle-gray">Дата оформления</th>
                            <th scope="col" class="py-3 border-subtle-gray">Тип получения и адрес</th>
                            <th scope="col" class="py-3 border-subtle-gray text-center">Статус</th>
                            <th scope="col" class="py-3 border-subtle-gray text-end pe-3">Итоговая сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="py-3 border-subtle-gray ps-3 fw-bold text-graphite">
                                    №00{{ $order->id }}
                                </td>
                                <td class="py-3 border-subtle-gray text-muted-gray">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}
                                </td>
                                <td class="py-3 border-subtle-gray text-graphite">
                                    <span class="fw-semibold">{{ $order->delivery_type == 'pickup' ? 'Самовывоз' : 'Доставка' }}</span>
                                    @if($order->address)
                                        <div class="small text-muted-gray mt-1">{{ $order->address }}</div>
                                    @endif
                                </td>
                                <td class="py-3 border-subtle-gray text-center">
                                    @if($order->status === 'new')
                                        <span class="badge bg-secondary text-white px-2 py-1 text-uppercase rounded-0 font-monospace small" style="font-size: 0.75rem;">ПОЛУЧЕН ФАБРИКОЙ</span>
                                    @elseif($order->status === 'manufacturing')
                                        <span class="badge px-2 py-1 text-uppercase rounded-0 font-monospace small" style="background-color: #198754; color: #fff; font-size: 0.75rem;">В ПРОИЗВОДСТВЕ</span>
                                    @elseif($order->status === 'delivery')
                                        <span class="badge bg-dark text-white px-2 py-1 text-uppercase rounded-0 font-monospace small" style="font-size: 0.75rem;">ПЕРЕДАН В ДОСТАВКУ</span>
                                    @elseif($order->status === 'completed')
                                        <span class="badge bg-black text-white px-2 py-1 text-uppercase rounded-0 font-monospace small" style="font-size: 0.75rem;">ВЫПОЛНЕН</span>
                                    @endif
                                </td>
                                <td class="py-3 border-subtle-gray text-end pe-3 fw-bold text-graphite fs-5">
                                    {{ number_format($order->total_price, 0, '.', ' ') }} ₽
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- МОБИЛЬНЫЙ СПИСОК КАРТОЧЕК (ЭКРАНЫ < 768px) -->
            <div class="d-md-none d-flex flex-column gap-3">
                @foreach($orders as $order)
                    <div class="border border-subtle-gray p-3 bg-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="text-graphite fw-bold fs-5 block">№00{{ $order->id }}</span>
                                <div class="text-muted-gray small">{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}</div>
                            </div>
                            <div>
                                @if($order->status === 'new')
                                    <span class="badge bg-secondary text-white px-2 py-1 text-uppercase rounded-0 font-monospace" style="font-size: 0.7rem;">ПОЛУЧЕН ФАБРИКОЙ</span>
                                @elseif($order->status === 'manufacturing')
                                    <span class="badge px-2 py-1 text-uppercase rounded-0 font-monospace" style="background-color: #198754; color: #fff; font-size: 0.7rem;">В ПРОИЗВОДСТВЕ</span>
                                @elseif($order->status === 'delivery')
                                    <span class="badge bg-dark text-white px-2 py-1 text-uppercase rounded-0 font-monospace" style="font-size: 0.7rem;">ПЕРЕДАН В ДОСТАВКУ</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge bg-black text-white px-2 py-1 text-uppercase rounded-0 font-monospace" style="font-size: 0.7rem;">ВЫПОЛНЕН</span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-2 border-subtle-gray">

                        <div class="mb-2">
                            <span class="small text-muted-gray d-block">Тип получения:</span>
                            <span class="text-graphite fw-semibold small">{{ $order->delivery_type == 'pickup' ? 'Самовывоз' : 'Доставка' }}</span>
                            @if($order->address)
                                <p class="text-muted-gray small mb-0 mt-1" style="line-height: 1.2;">{{ $order->address }}</p>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top border-subtle-gray">
                            <span class="small text-muted-gray">Итого:</span>
                            <span class="fs-5 fw-bold text-graphite">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
