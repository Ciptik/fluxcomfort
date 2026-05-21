<x-app-layout>
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

        /* Премиальные текстовые бейджи статусов без рамок и скруглений */
        .badge-flux {
            font-size: 0.65rem !important;
            letter-spacing: 0.08rem !important;
            padding: 6px 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            display: inline-block;
        }

        /* Интерактивная строка заказа */
        .order-row-link {
            text-decoration: none !important;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #DEE2E6 !important;
        }
        .order-row-link:hover {
            background-color: #F8F9FA !important;
        }

        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 44px;
            }
        }
    </style>

    <div class="container py-4 py-md-5">
        <div class="row">
            <div class="col-12 mx-auto" style="max-width: 1140px;">
                
                @if(session('success'))
                    <div class="alert alert-success rounded-0 mb-4 border-0 border-start border-success border-4 p-3 fs-6 text-graphite bg-light-block" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center pb-3 mb-4 border-bottom border-subtle-gray gap-3">
                    <div>
                        <span class="text-muted-gray text-uppercase font-monospace small d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                            Профиль Клиента // Информационная панель
                        </span>
                        <h1 class="fs-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
                            Личный кабинет: {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <a href="/catalog" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-4 d-inline-flex align-items-center justify-content-center mobile-touch-target w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem; height: 44px;">
                        ← В каталог мебели
                    </a>
                </div>

                <div class="bg-white border border-subtle-gray p-3 p-md-4 mb-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
                        <div class="text-uppercase fw-bold text-graphite font-monospace" style="font-size: 0.8rem; letter-spacing: 0.05rem;">
                            🗂 Регистрационные спецификации
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark btn-sm rounded-0 text-uppercase fw-bold w-100 w-md-auto mobile-touch-target d-inline-flex align-items-center justify-content-center" style="font-size: 0.7rem; letter-spacing: 0.05rem; padding: 4px 12px; height: 32px;">
                            ⚙ Изменить параметры
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

                <div class="mb-2">
                    <h2 class="fs-5 text-uppercase fw-bold text-graphite mb-3" style="letter-spacing: 0.05rem;">
                        Архив и мониторинг заказов
                    </h2>

                    @if($orders->isEmpty())
                        <div class="border border-subtle-gray p-5 text-center bg-white">
                            <p class="text-muted-gray mb-4 fs-6">В вашей персональной истории пока нет оформленных заказов.</p>
                            <a href="/catalog" class="btn btn-accent rounded-0 px-4 py-3 text-uppercase fw-bold mobile-touch-target" style="letter-spacing: 0.05rem; font-size: 0.8rem;">
                                Перейти к каталогу мебели
                            </a>
                        </div>
                    @else
                        
                        <div class="d-none d-md-flex row px-3 pb-2 text-uppercase fw-bold text-muted-gray font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                            <div class="col-md-2">Документ</div>
                            <div class="col-md-2">Дата</div>
                            <div class="col-md-4">Логистический статус</div>
                            <div class="col-md-2 text-center">Этап ERP</div>
                            <div class="col-md-2 text-end">Сумма</div>
                        </div>

                        <div class="d-flex flex-column">
                            @foreach($orders as $order)
                                <a href="{{ url('/orders/' . $order->id) }}" class="order-row-link text-dark p-3 bg-white">
                                    <div class="row align-items-center g-3">
                                        
                                        <div class="col-6 col-md-2">
                                            <span class="d-md-none text-muted-gray small d-block font-monospace text-uppercase" style="font-size: 0.6rem;">Заказ:</span>
                                            <span class="fw-bold text-graphite fs-6">#00{{ $order->id }}</span>
                                        </div>

                                        <div class="col-6 col-md-2 text-end text-md-start">
                                            <span class="d-md-none text-muted-gray small d-block font-monospace text-uppercase" style="font-size: 0.6rem;">Оформлен:</span>
                                            <span class="text-muted-gray font-monospace">{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}</span>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <span class="d-md-none text-muted-gray small d-block font-monospace text-uppercase" style="font-size: 0.6rem; mb-1">Способ получения:</span>
                                            <div class="text-graphite small">
                                                <span class="fw-semibold">{{ $order->delivery_type == 'pickup' ? '🧱 Самовывоз из цеха' : '🚚 Адресная доставка' }}</span>
                                                @if($order->address)
                                                    <span class="text-muted-gray d-block text-truncate" style="max-width: 100%; font-size: 0.8rem;">{{ $order->address }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-2 text-md-center">
                                            <span class="d-md-none text-muted-gray small d-block font-monospace text-uppercase mb-1" style="font-size: 0.6rem;">Состояние:</span>
                                            @switch($order->status)
                                                @case('new')
                                                    <span class="badge-flux bg-light text-dark border border-secondary-subtle">⏳ Спецификация</span>
                                                    @break
                                                @case('awaiting_payment')
                                                    <span class="badge-flux text-dark" style="background-color: #ffeeba;">⚠ Счёт выставлен</span>
                                                    @break
                                                @case('payment_review')
                                                    <span class="badge-flux text-white" style="background-color: #6f42c1;">🔍 Сверка банка</span>
                                                    @break
                                                @case('manufacturing')
                                                    <span class="badge-flux text-white" style="background-color: #1e4620;">🔨 В производстве</span>
                                                    @break
                                                @case('processing')
                                                    <span class="badge-flux text-dark" style="background-color: #e2e3e5;">📦 Упаковка / Склад</span>
                                                    @break
                                                @case('delivery')
                                                    <span class="badge-flux text-dark" style="background-color: #cff4fc;">🚛 Отгружен</span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge-flux text-white" style="background-color: #212529;">✔ Закрыт</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge-flux text-white" style="background-color: #dc3545;">❌ Аннулирован</span>
                                                    @break
                                                @default
                                                    <span class="badge-flux bg-light text-dark border">{{ $order->status }}</span>
                                            @endswitch
                                        </div>

                                        <div class="col-6 col-md-2 text-end">
                                            <span class="d-md-none text-muted-gray small d-block font-monospace text-uppercase" style="font-size: 0.6rem;">Стоимость:</span>
                                            <span class="fw-bold text-graphite font-monospace fs-5">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</span>
                                        </div>

                                    </div>
                                </a>
                            @endforeach
                        </div>

                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
