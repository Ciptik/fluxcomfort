@extends('layouts.shop')

@section('content')
<div class="container py-3" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
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

        /* Улучшенные прямоугольные флэт-бейджи для статусов */
        .badge-status {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            padding: 6px 4px;
            display: block;
            text-align: center;
            text-transform: uppercase;
            font-family: monospace;
            border: 1px solid transparent;
        }
        .status-new { background-color: #F8F9FA !important; color: #212529 !important; border: 1px solid #DEE2E6 !important; }
        .status-awaiting-payment { background-color: #FFF3CD !important; color: #664D03 !important; border: 1px solid #FFE69C !important; }
        .status-payment-review { background-color: #6f42c1 !important; color: #FFFFFF !important; }
        .status-manufacturing { background-color: #D1E7DD !important; color: #198754 !important; border: 1px solid #198754 !important; }
        .status-delivery { background-color: #CFF4FC !important; color: #0dcaf0 !important; border: 1px solid #0dcaf0 !important; }
        .status-completed { background-color: #212529 !important; color: #FFFFFF !important; }
        .status-cancelled { background-color: #F8D7DA !important; color: #842029 !important; border: 1px solid #F5C2C7 !important; }

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
            .badge-status {
                padding: 8px 4px;
                font-size: 0.75rem;
            }
        }
    </style>

    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom border-subtle-gray">
        <h1 class="fs-4 fs-md-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.03rem;">
            Диспетчер заказов фабрики <span style="color: #198754;">Fluxcomfort</span>
        </h1>
        <span class="badge bg-dark px-3 py-2 text-uppercase d-none d-sm-inline-block" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
            Панель администратора
        </span>
    </div>

    <div class="mb-4 border-bottom border-subtle-gray">
        <ul class="nav nav-admin row g-0">
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link active w-100 px-md-4 py-md-2" href="{{ route('admin.dashboard') }}">
                    📦 Заказы фабрики
                </a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link w-100 px-md-4 py-md-2" href="{{ route('admin.products') }}">
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

    @if(session('success'))
        <div class="alert alert-success border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #198754 !important;" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="p-5 text-center bg-white border border-subtle-gray">
            <p class="text-muted-gray m-0 fs-6">Новых заказов от клиентов пока не поступало.</p>
        </div>
    @else
        <div class="table-responsive d-none d-md-block bg-white border border-subtle-gray">
            <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                <thead class="bg-light-block text-graphite text-uppercase small fw-bold border-bottom border-subtle-gray">
                    <tr>
                        <th scope="col" class="py-3 px-4 border-subtle-gray" style="width: 10%;">ID Заказа</th>
                        <th scope="col" class="py-3 border-subtle-gray" style="width: 12%;">Дата</th>
                        <th scope="col" class="py-3 border-subtle-gray" style="width: 22%;">Покупатель</th>
                        <th scope="col" class="py-3 border-subtle-gray" style="width: 12%;">Сумма</th>
                        <th scope="col" class="py-3 border-subtle-gray" style="width: 18%;">Доставка / Адрес</th>
                        <th scope="col" class="py-3 border-subtle-gray text-center" style="width: 12%;">Статус</th>
                        <th scope="col" class="py-3 text-end px-4 border-subtle-gray" style="width: 14%;">Управление цехом</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-bottom border-subtle-gray">
                            <td class="py-3 px-4 fw-bold text-graphite border-subtle-gray">#00{{ $order->id }}</td>
                            <td class="py-3 text-muted-gray border-subtle-gray">{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                            <td class="py-3 border-subtle-gray">
                                <div class="fw-bold text-graphite">{{ $order->user_name }}</div>
                                <div class="small text-muted-gray">{{ $order->user_phone }}</div>
                            </td>
                            <td class="py-3 fw-bold border-subtle-gray fs-6" style="color: #198754;">
                                {{ number_format($order->total_price, 0, '.', ' ') }} ₽
                            </td>
                            <td class="py-3 border-subtle-gray text-graphite">
                                <span class="small fw-bold text-uppercase d-block mb-1">
                                    {{ $order->delivery_type === 'delivery' ? '🚛 Доставка' : '🏭 Самовывоз' }}
                                </span>
                                <span class="small text-muted-gray d-block text-truncate" style="max-width: 200px;" title="{{ $order->address }}">
                                    {{ $order->address }}
                                </span>
                            </td>
                            <td class="py-3 text-center border-subtle-gray">
                                @if($order->status === 'new')
                                    <span class="badge-status status-new">ПОЛУЧЕН</span>
                                @elseif($order->status === 'awaiting_payment')
                                    <span class="badge-status status-awaiting-payment">ОЖИДАНИЕ</span>
                                @elseif($order->status === 'payment_review')
                                    <span class="badge-status status-payment-review">СВЕРКА</span>
                                @elseif($order->status === 'manufacturing')
                                    <span class="badge-status status-manufacturing">В ЦЕХУ</span>
                                @elseif($order->status === 'delivery')
                                    <span class="badge-status status-delivery">В ПУТИ</span>
                                @elseif($order->status === 'completed')
                                    <span class="badge-status status-completed">ВЫДАН</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge-status status-cancelled">ОТМЕНЕН</span>
                                @else
                                    <span class="badge-status bg-secondary text-white">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="py-3 text-end px-4 border-subtle-gray">
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="d-flex gap-1 justify-content-end">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm rounded-0 border-subtle-gray text-uppercase fw-bold text-graphite" style="font-size: 0.75rem; max-width: 150px;">
                                        <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Получен</option>
                                        <option value="awaiting_payment" {{ $order->status === 'awaiting_payment' ? 'selected' : '' }}>Ожидание оплаты</option>
                                        <option value="payment_review" {{ $order->status === 'payment_review' ? 'selected' : '' }}>Проверка чека</option>
                                        <option value="manufacturing" {{ $order->status === 'manufacturing' ? 'selected' : '' }}>В производство</option>
                                        <option value="delivery" {{ $order->status === 'delivery' ? 'selected' : '' }}>В доставку</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Выполнен</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отменен</option>
                                    </select>
                                    <button type="submit" class="btn btn-dark btn-sm rounded-0 px-2 text-uppercase fw-bold" style="font-size: 0.7rem;">ОК</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-md-none d-flex flex-column gap-3">
            @foreach($orders as $order)
                <div class="border border-subtle-gray p-3 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <span class="text-graphite fw-bold fs-5">#00{{ $order->id }}</span>
                            <span class="text-muted-gray small ms-2">{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</span>
                        </div>
                        <div class="fs-5 fw-bold" style="color: #198754;">
                            {{ number_format($order->total_price, 0, '.', ' ') }} ₽
                        </div>
                    </div>

                    <div class="mb-3">
                        @if($order->status === 'new')
                            <span class="badge-status status-new">ПОЛУЧЕН</span>
                        @elseif($order->status === 'awaiting_payment')
                            <span class="badge-status status-awaiting-payment">ОЖИДАНИЕ</span>
                        @elseif($order->status === 'payment_review')
                            <span class="badge-status status-payment-review">СВЕРКА ПЛАТЕЖА</span>
                        @elseif($order->status === 'manufacturing')
                            <span class="badge-status status-manufacturing">В ЦЕХУ</span>
                        @elseif($order->status === 'delivery')
                            <span class="badge-status status-delivery">В ПУТИ</span>
                        @elseif($order->status === 'completed')
                            <span class="badge-status status-completed">ВЫДАН</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge-status status-cancelled">ОТМЕНЕН</span>
                        @else
                            <span class="badge-status bg-secondary text-white">{{ $order->status }}</span>
                        @endif
                    </div>

                    <div class="bg-light-block p-2 mb-3 border border-subtle-gray" style="font-size: 0.85rem;">
                        <div class="mb-1">
                            <span class="text-muted-gray">Покупатель:</span> <strong class="text-graphite">{{ $order->user_name }}</strong>
                        </div>
                        <div class="mb-1">
                            <span class="text-muted-gray">Тел:</span> <a href="tel:{{ $order->user_phone }}" class="text-graphite fw-semibold text-decoration-none">{{ $order->user_phone }}</a>
                        </div>
                        <div class="pt-1 border-top border-subtle-gray mt-1">
                            <span class="text-muted-gray text-uppercase fw-bold" style="font-size: 0.75rem;">
                                {{ $order->delivery_type === 'delivery' ? '🚛 Доставка' : '🏭 Самовывоз' }}
                            </span>
                            @if($order->address)
                                <div class="text-graphite small lh-sm mt-1">{{ $order->address }}</div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select rounded-0 border-subtle-gray text-uppercase fw-bold text-graphite mobile-touch-target" style="font-size: 0.85rem;">
                                <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Получен</option>
                                <option value="awaiting_payment" {{ $order->status === 'awaiting_payment' ? 'selected' : '' }}>Ожидание оплаты</option>
                                <option value="payment_review" {{ $order->status === 'payment_review' ? 'selected' : '' }}>Проверка чека</option>
                                <option value="manufacturing" {{ $order->status === 'manufacturing' ? 'selected' : '' }}>В производство</option>
                                <option value="delivery" {{ $order->status === 'delivery' ? 'selected' : '' }}>В доставку</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Выполнен</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отменен</option>
                            </select>
                            <button type="submit" class="btn btn-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                ОК
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
