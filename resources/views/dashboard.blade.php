<x-app-layout>
    <!-- ПОДКЛЮЧЕНИЕ BOOTSTRAP ДЛЯ ИЗОЛЯЦИИ СТИЛЕЙ КБ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Сброс глобальных фонов Breeze, чтобы вернуть чистый белый премиальный фон */
        body, .min-h-screen, main {
            background-color: #ffffff !important;
        }
        
        /* Принудительный сброс скруглений под суровый минимализм Fluxcomfort */
        .rounded-0, .btn, .card, .badge, .form-control, .form-select, .table, .list-group-item, .alert {
            border-radius: 0px !important;
        }
        
        /* Фирменные утилиты палитры Fluxcomfort */
        .text-graphite { color: #212529 !important; }
        .text-muted-gray { color: #6C757D !important; }
        .bg-light-block { background-color: #F8F9FA !important; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        /* Кнопки */
        .btn-accent { 
            background-color: #198754 !important; 
            color: #ffffff !important; 
            border: none !important;
        }
        .btn-accent:hover { 
            background-color: #146c43 !important; 
        }
        .btn-outline-dark {
            border: 1px solid #212529 !important;
            color: #212529 !important;
            background: transparent !important;
        }
        .btn-outline-dark:hover {
            background-color: #212529 !important;
            color: #ffffff !important;
        }
        
        /* Убираем лишние тени от Breeze */
        .shadow, .shadow-sm, .shadow-md, .shadow-lg {
            box-shadow: none !important;
        }

        /* Интеграция кастомных бейджей под спецификацию ERP */
        .badge-erp {
            font-size: 0.7rem !important;
            letter-spacing: 0.05rem !important;
            padding: 5px 10px !important;
            font-weight: 700 !important;
            display: inline-block;
        }

        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 44px;
            }
        }
    </style>

    <!-- ОСНОВНОЙ КОНТЕНТ ЛИЧНОГО КАБИНЕТА -->
    <div class="container py-4 py-md-5">
        <div class="row">
            <div class="col-12 mx-auto" style="max-width: 1140px;">
                
                <!-- БЕЗОПАСНОСТЬ И СЕССИИ (УВЕДОМЛЕНИЯ) -->
                @if(session('success'))
                    <div class="alert alert-success rounded-0 mb-4 border-0 border-start border-success border-4 p-3 fs-6 text-graphite bg-light-block" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ВЕРХНЯЯ ПАНЕЛЬ: ЗАГОЛОВОК И НАВИГАЦИЯ -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom border-subtle-gray gap-3">
                    <div>
                        <span class="text-muted-gray text-uppercase font-monospace small d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                            Профиль Клиента / Фабрика
                        </span>
                        <h1 class="fs-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
                            Личный кабинет: {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <a href="/catalog" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-4 d-inline-flex align-items-center justify-content-center mobile-touch-target w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem; height: 44px;">
                        ← В каталог мебели
                    </a>
                </div>

                <!-- 1. ОТЕЦ СТРУКТУРЫ — ВЕРХНИЙ БЛОК (ПАСПОРТ КЛИЕНТА) -->
                <div class="bg-white border border-subtle-gray p-3 p-md-4 mb-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-3">
                        <div class="text-uppercase fw-bold text-graphite font-monospace" style="font-size: 0.8rem; letter-spacing: 0.05rem;">
                            🗂️ Регистрационные данные
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm rounded-0 text-uppercase fw-bold w-100 w-md-auto mobile-touch-target d-inline-flex align-items-center justify-content-center" style="font-size: 0.7rem; letter-spacing: 0.05rem; padding: 4px 12px; height: 32px;">
                            ⚙️ Редактировать профиль
                        </a>
                    </div>
                    
                    <div class="row g-3 fs-6">
                        <div class="col-12 col-sm-6 col-md-3 border-start border-subtle-gray ps-3">
                            <span class="text-muted-gray small d-block text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.05rem;">ФИО Клиента</span> 
                            <strong class="text-graphite text-wrap">{{ Auth::user()->name }}</strong>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 border-start border-subtle-gray ps-3">
                            <span class="text-muted-gray small d-block text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.05rem;">Email адрес</span> 
                            <strong class="text-graphite text-break">{{ Auth::user()->email }}</strong>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 border-start border-subtle-gray ps-3">
                            <span class="text-muted-gray small d-block text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.05rem;">Контактный телефон</span> 
                            <strong class="text-graphite">{{ Auth::user()->phone ?? 'Не указан' }}</strong>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 border-start border-subtle-gray ps-3">
                            <span class="text-muted-gray small d-block text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.05rem;">Адрес доставки</span> 
                            <strong class="text-graphite text-wrap">{{ Auth::user()->address ?? 'Не указан' }}</strong>
                        </div>
                    </div>
                </div>

                <!-- 2. СЕРДЦЕ СТРАНИЦЫ — НИЖНИЙ БЛОК (ИСТОРИЯ ЗАКАЗОВ) -->
                <div class="mb-2">
                    <h2 class="fs-5 text-uppercase fw-bold text-graphite mb-3" style="letter-spacing: 0.05rem;">
                        История заказов
                    </h2>

                    @if($orders->isEmpty())
                        <!-- ПУСТОЕ СОСТОЯНИЕ -->
                        <div class="border border-subtle-gray p-5 text-center bg-white">
                            <p class="text-muted-gray mb-4 fs-6">В вашей истории пока нет активных или завершенных заказов.</p>
                            <a href="/catalog" class="btn btn-accent rounded-0 px-4 py-3 text-uppercase fw-bold mobile-touch-target" style="letter-spacing: 0.05rem; font-size: 0.8rem;">
                                Перейти к каталогу мебели
                            </a>
                        </div>
                    @else
                        
                        <!-- A) ДЕСКТОПНЫЙ ИНТЕРФЕЙС (ЭКРАНЫ >= 768px) -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-bordered border-subtle-gray align-middle bg-white mb-0" style="font-size: 0.9rem;">
                                <thead class="bg-light-block text-graphite text-uppercase small fw-bold" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                                    <tr>
                                        <th scope="col" class="py-3 border-subtle-gray ps-3">Заказ</th>
                                        <th scope="col" class="py-3 border-subtle-gray">Дата оформления</th>
                                        <th scope="col" class="py-3 border-subtle-gray">Доставка и адресная логистика</th>
                                        <th scope="col" class="py-3 border-subtle-gray text-center" style="width: 280px;">Статус и управление ERP</th>
                                        <th scope="col" class="py-3 border-subtle-gray text-end pe-3">Сумма</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="py-3 border-subtle-gray ps-3 fw-bold text-graphite">
                                                #00{{ $order->id }}
                                            </td>
                                            <td class="py-3 border-subtle-gray text-muted-gray font-monospace">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}
                                            </td>
                                            <td class="py-3 border-subtle-gray text-graphite text-wrap">
                                                <span class="fw-semibold">{{ $order->delivery_type == 'pickup' ? '🧱 Самовывоз' : '🚚 Доставка' }}</span>
                                                @if($order->address)
                                                    <div class="small text-muted-gray mt-1">{{ $order->address }}</div>
                                                @endif
                                            </td>
                                            <td class="py-3 border-subtle-gray text-center">
                                                <div class="d-flex flex-column align-items-center gap-2">
                                                    @switch($order->status)
                                                        @case('new')
                                                            <span class="badge badge-erp bg-light text-dark border border-secondary-subtle">⏳ ПРОВЕРКА</span>
                                                            @break
                                                        @case('awaiting_payment')
                                                            <span class="badge badge-erp bg-warning text-dark">⚠️ ОЖИДАЕТ ОПЛАТЫ</span>
                                                            <form action="{{ route('orders.pay', $order->id) }}" method="POST" class="d-inline w-100 px-3">
                                                                @csrf
                                                                <button type="submit" class="btn btn-accent btn-sm rounded-0 text-uppercase fw-bold w-100 font-monospace" style="font-size: 0.65rem; padding: 4px 8px;">💳 Я оплатил</button>
                                                            </form>
                                                            @break
                                                        @case('payment_review')
                                                            <span class="badge badge-erp bg-info text-dark">🔍 ПРОВЕРКА ПЛАТЕЖА</span>
                                                            @break
                                                        @case('processing')
                                                            <span class="badge badge-erp bg-success-subtle border text-success" style="border-color: #198754 !important; color: #198754 !important;">🔨 В СБОРКЕ (ЦЕХ)</span>
                                                            @break
                                                        @case('delivery')
                                                            <span class="badge badge-erp bg-info-subtle border text-info" style="border-color: #0dcaf0 !important; color: #0dcaf0 !important;">🚛 В ДОСТАВКЕ</span>
                                                            @break
                                                        @case('completed')
                                                            <span class="badge badge-erp bg-dark text-white">✔️ ЗАВЕРШЕН</span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge badge-erp bg-danger-subtle border text-danger" style="border-color: #dc3545 !important; color: #dc3545 !important;">❌ ОТМЕНЕН</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-erp bg-light text-dark border">{{ strtoupper($order->status) }}</span>
                                                    @endswitch
                                                </div>
                                            </td>
                                            <td class="py-3 border-subtle-gray text-end pe-3 fw-bold text-graphite fs-5 font-monospace">
                                                {{ number_format($order->total_price, 2, '.', ' ') }} ₽
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- B) МОБИЛЬНЫЙ ИНТЕРФЕЙС (ЭКРАНЫ < 768px) -->
                        <div class="d-md-none d-flex flex-column gap-3">
                            @foreach($orders as $order)
                                <div class="border border-subtle-gray p-3 bg-white">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <span class="text-graphite fw-bold fs-5">#00{{ $order->id }}</span>
                                            <div class="text-muted-gray small font-monospace">{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}</div>
                                        </div>
                                        <div>
                                            @switch($order->status)
                                                @case('new')
                                                    <span class="badge badge-erp bg-light text-dark border border-secondary-subtle">⏳ ПРОВЕРКА</span>
                                                    @break
                                                @case('awaiting_payment')
                                                    <span class="badge badge-erp bg-warning text-dark">⚠️ ОЖИДАЕТ ОПЛАТЫ</span>
                                                    @break
                                                @case('payment_review')
                                                    <span class="badge badge-erp bg-info text-dark">🔍 ПРОВЕРКА ПЛАТЕЖА</span>
                                                    @break
                                                @case('processing')
                                                    <span class="badge badge-erp bg-success-subtle border text-success" style="border-color: #198754 !important; color: #198754 !important;">🔨 В СБОРКЕ</span>
                                                    @break
                                                @case('delivery')
                                                    <span class="badge badge-erp bg-info-subtle border text-info" style="border-color: #0dcaf0 !important; color: #0dcaf0 !important;">🚛 ДОСТАВКА</span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge badge-erp bg-dark text-white">✔️ ЗАВЕРШЕН</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-erp bg-danger-subtle border text-danger" style="border-color: #dc3545 !important; color: #dc3545 !important;">❌ ОТМЕНЕН</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-erp bg-light text-dark border">{{ strtoupper($order->status) }}</span>
                                            @endswitch
                                        </div>
                                    </div>

                                    <div class="mb-3 bg-light-block p-2 border-start border-subtle-gray">
                                        <span class="small text-muted-gray d-block text-uppercase font-monospace" style="font-size: 0.6rem; letter-spacing: 0.05rem;">Логистика:</span>
                                        <span class="text-graphite fw-semibold small">{{ $order->delivery_type == 'pickup' ? '🧱 Самовывоз со склада' : '🚚 Доставка на адрес' }}</span>
                                        @if($order->address)
                                            <p class="text-muted-gray small mb-0 mt-1 text-wrap" style="line-height: 1.3; font-size: 0.8rem;">{{ $order->address }}</p>
                                        @endif
                                    </div>

                                    <!-- ИНТЕГРИРОВАННАЯ ФОРМА ОПЛАТЫ ДЛЯ МОБИЛЬНОЙ ВЕРСИИ -->
                                    @if($order->status === 'awaiting_payment')
                                        <div class="mb-3">
                                            <form action="{{ route('orders.pay', $order->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-accent w-100 rounded-0 text-uppercase fw-bold mobile-touch-target font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05rem; height: 44px;">
                                                    💳 Я оплатил заказ
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top border-subtle-gray">
                                        <span class="small text-muted-gray text-uppercase font-monospace" style="font-size: 0.65rem; letter-spacing: 0.05rem;">Итого к оплате:</span>
                                        <span class="fs-5 fw-bold text-graphite font-monospace">{{ number_format($order->total_price, 2, '.', ' ') }} ₽</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
