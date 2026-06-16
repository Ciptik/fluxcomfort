<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Глобальная концепция светлой темы Fluxcomfort */
body, .min-h-screen, main {
    background-color: #ffffff !important;
}

/* Полный отказ от скруглений углов (Суровый минимализм) */
.rounded-0, .btn, .form-control, .progress, .progress-bar, .alert, .badge, .list-group-item {
    border-radius: 0px !important;
}

/* Избавление от теней Tailwind / Breeze для чистоты структуры */
.shadow, .shadow-sm, .shadow-md, .shadow-lg {
    box-shadow: none !important;
}

/* Цветовая палитра и elements */
.text-graphite { color: #212529 !important; }
.text-muted-gray { color: #6C757D !important; }
.bg-light-block { background-color: #F8F9FA !important; }
.border-subtle-gray { border-color: #DEE2E6 !important; }

/* Хвойно-зеленый акцент (Успех/Оплата/Действие) */
.btn-accent {
    background-color: #198754 !important;
    color: #ffffff !important;
    border: none !important;
    min-height: 44px; /* Touch Target требование */
}
.btn-accent:hover {
    background-color: #146c43 !important;
    color: #ffffff !important;
}
.text-accent { color: #198754 !important; }
.bg-accent { background-color: #198754 !important; }

/* Кастомный минималистичный трекер статусов без скруглений */
.step-tracker {
    display: flex;
    justify-content: space-between;
    position: relative;
    background: #dee2e6;
    height: 2px;
}
.step-item {
    position: relative;
    top: -6px;
    width: 14px;
    height: 14px;
    background-color: #dee2e6;
    transition: all 0.3s ease;
}
.step-item.active {
    background-color: #198754;
    outline: 4px solid rgba(25, 135, 84, 0.15);
}
.step-label {
    font-size: 0.7rem;
    letter-spacing: 0.05em;
    white-space: nowrap;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    color: #6C757D;
}
.step-item.active .step-label {
    color: #212529;
    font-weight: 700;
}

/* Адаптивность таблиц под мобильные дисплеи */
@media (max-width: 767.98px) {
    .responsive-table-row {
        border-bottom: 1px solid #DEE2E6;
        padding: 12px 0;
    }
    .step-label {
        display: none; /* Скрытие подписей трекера на экранах < 768px во избежание наслоения */
    }
    .step-tracker {
        height: 4px;
    }
    .step-item {
        top: -5px;
        width: 14px;
        height: 14px;
    }
}
</style>

<div class="container py-4 py-md-5">
<div class="row">
<div class="col-12 mx-auto" style="max-width: 960px;">

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-subtle-gray">
<a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase font-monospace" style="letter-spacing: 0.05em;">
← В Личный кабинет
</a>
<a href="{{ route('catalog') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase font-monospace" style="letter-spacing: 0.05em;">
В Каталог магазина →
</a>
</div>

<div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-baseline mb-4 mb-md-5 gap-1">
<h1 class="fs-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05em;">
Заказ #{{ $order->id }}
</h1>
<span class="text-muted-gray small font-monospace">
Оформлен: {{ date('d.m.Y в H:i', strtotime($order->created_at)) }}
</span>
</div>

@if(session('success'))
<div class="alert alert-success rounded-0 font-monospace small mb-4">
{{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger rounded-0 font-monospace small mb-4">
{{ session('error') }}
</div>
@endif

<div class="card rounded-0 border-subtle-gray bg-light-block mb-5">
<div class="card-body py-4 px-3 px-md-5">
<div class="text-uppercase small font-monospace fw-bold text-muted-gray mb-4 text-center text-md-start" style="font-size: 0.75rem; letter-spacing: 0.05em;">
Текущий этап обработки заказа
</div>

<div class="my-3 mx-2">
<div class="step-tracker">
<div class="step-item {{ $order->status === 'new' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">1. Проверка</div>
</div>
<div class="step-item {{ $order->status === 'awaiting_payment' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">2. Оплата</div>
</div>
<div class="step-item {{ $order->status === 'payment_review' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">3. Сверка</div>
</div>
<div class="step-item {{ $order->status === 'manufacturing' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">4. Фабрика</div>
</div>
<div class="step-item {{ $order->status === 'delivery' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">5. Доставка</div>
</div>
<div class="step-item {{ $order->status === 'completed' ? 'active' : '' }}">
<div class="step-label font-monospace text-uppercase">6. Готово</div>
</div>
</div>
</div>

<div class="d-block d-md-none text-center mt-4 pt-2">
<span class="badge bg-dark rounded-0 px-3 py-2 text-uppercase font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05em;">
Статус:
@if($order->status === 'new') Проверка спецификации
@elseif($order->status === 'awaiting_payment') Ожидание оплаты
@elseif($order->status === 'payment_review') Сверка платежа
@elseif($order->status === 'manufacturing') В производстве
@elseif($order->status === 'delivery') Передан в доставку
@elseif($order->status === 'completed') Выполнен
@endif
</span>
</div>
</div>
</div>

<div class="mb-5">
@if($order->status === 'new')
<div class="p-3 bg-light-block border border-subtle-gray text-graphite">
<div class="d-flex align-items-start gap-2">
<span class="text-muted-gray fw-bold font-monospace">INFO //</span>
<p class="m-0 small text-wrap">
Менеджер фабрики <strong>FluxComfort</strong> проверяет наличие необходимых материалов на складе и технологическую спецификацию выбранной мебели. Реквизиты для перевода средств появятся здесь сразу после одобрения заказа.
</p>
</div>
</div>
@endif

@if($order->status === 'awaiting_payment')
<div class="p-4 border border-subtle-gray bg-white">
<h3 class="fs-6 text-uppercase fw-bold text-graphite mb-3 font-monospace" style="letter-spacing: 0.05em;">
Реквизиты для оплаты заказа ручным переводом:
</h3>
<div class="p-3 bg-light-block border border-subtle-gray font-monospace mb-4 small text-graphite">
<div class="mb-1"><strong>Получатель:</strong> ООО "ФлаксКомфорт"</div>
<div class="mb-1"><strong>ИНН / КПП:</strong> 7700000000 / 770001001</div>
<div class="mb-1"><strong>Расчетный счет:</strong> 40702810000000001234</div>
<div class="mb-1"><strong>Банк:</strong> АО "Альфа-Банк", г. Москва</div>
<div class="mb-1"><strong>БИК:</strong> 044525593</div>
<div class="mt-2 text-accent fw-bold">Назначение платежа: Оплата по заказу №{{ $order->id }}</div>
</div>

<form method="post" action="{{ route('orders.pay', $order->id) }}">
@csrf
<button type="submit" class="btn btn-accent btn-touch text-uppercase fw-bold w-100 font-monospace" style="font-size: 0.8rem; letter-spacing: 0.05em;">
Подтвердить платеж (Я оплатил)
</button>
</form>
</div>
@endif

@if($order->status === 'payment_review')
<div class="p-3 bg-light-block border border-subtle-gray text-graphite">
<div class="d-flex align-items-start gap-2">
<span class="text-muted-gray fw-bold font-monospace">WAIT //</span>
<p class="m-0 small text-wrap">
Ваш платеж успешно отправлен на проверку. Бухгалтерия мебельной фабрики верифицирует банковскую выписку. Как только зачисление подтвердится, мы запустим изготовление мебели. Ожидайте уведомления.
</p>
</div>
</div>
@endif

@if($order->status === 'manufacturing' || $order->status === 'delivery' || $order->status === 'completed')
<div class="p-3 border border-success bg-white text-graphite">
<div class="d-flex align-items-center gap-2">
<span class="text-accent fw-bold font-monospace">✓ SUCCESS //</span>
<p class="m-0 small text-wrap text-accent fw-bold">
Заказ успешно оплачен. Финансовые средства в полном объеме зачислены на расчетный счет фабрики.
</p>
</div>
</div>
@endif
</div>

<h2 class="fs-5 text-uppercase fw-bold text-graphite mb-3 font-monospace" style="letter-spacing: 0.05em;">
Состав заказа
</h2>

<div class="border border-subtle-gray bg-white mb-5">
<div class="d-none d-md-flex row g-0 bg-light-block p-3 border-bottom border-subtle-gray text-uppercase font-monospace small text-muted-gray fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05em;">
<div class="col-6">Наименование мебели</div>
<div class="col-2 text-center">Цена</div>
<div class="col-2 text-center">Кол-во</div>
<div class="col-2 text-end">Итого</div>
</div>

@foreach($items as $item)
<div class="row g-0 align-items-center p-3 responsive-table-row">
<div class="col-12 col-md-6 d-flex align-items-center mb-2 mb-md-0">
<div class="border border-subtle-gray bg-light-block text-center" style="width: 70px; height: 70px; flex-shrink: 0;">
<img src="{{ $item->image_path ? asset($item->image_path) : 'https://via.placeholder.com/70' }}" alt="{{ $item->product_name }}" class="img-fluid rounded-0 h-100 object-fit-cover">
</div>
<div class="ms-3">
<div class="fw-bold text-graphite text-wrap small">{{ $item->product_name }}</div>
<div class="text-muted-gray font-monospace" style="font-size: 0.75rem;">Код модели: #{{ $item->product_id }}</div>
</div>
</div>

<div class="col-4 col-md-2 text-start text-md-center">
<span class="d-inline d-md-none text-muted-gray small">Цена: </span>
<span class="text-graphite font-monospace small">{{ number_format($item->price, 0, '.', ' ') }} ₽</span>
</div>

<div class="col-4 col-md-2 text-center">
<span class="d-inline d-md-none text-muted-gray small">Кол-во: </span>
<span class="text-graphite font-monospace small">{{ $item->quantity }} шт.</span>
</div>

<div class="col-4 col-md-2 text-end">
<span class="d-inline d-md-none text-muted-gray small">Всего: </span>
<span class="fw-bold text-graphite font-monospace small">{{ number_format($item->price * $item->quantity, 0, '.', ' ') }} ₽</span>
</div>
</div>
@endforeach

<div class="p-3 bg-light-block d-flex justify-content-between align-items-center border-top border-subtle-gray">
<div class="fs-6 fw-bold text-uppercase text-graphite font-monospace" style="letter-spacing: 0.05em;">Итого к оплате:</div>
<div class="fs-4 fw-bold text-accent font-monospace">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</div>
</div>
</div>

<div class="card rounded-0 border-subtle-gray bg-white mb-4">
<div class="card-body p-4">
<h3 class="fs-6 text-uppercase fw-bold text-graphite mb-3 font-monospace" style="letter-spacing: 0.05em;">
Информация о доставке
</h3>
<div class="row g-3 text-graphite">
<div class="col-12 col-md-4">
<div class="text-uppercase small font-monospace fw-bold text-muted-gray" style="font-size: 0.65rem; letter-spacing: 0.05em;">Получатель:</div>
<div class="small mt-1 fw-bold">{{ Auth::user()->name }}</div>
<div class="small text-muted-gray font-monospace">{{ Auth::user()->email }}</div>
</div>
<div class="col-12 col-md-8">
<div class="text-uppercase small font-monospace fw-bold text-muted-gray" style="font-size: 0.65rem; letter-spacing: 0.05em;">Адрес доставки мебельных изделий:</div>
<div class="small mt-1 fw-bold text-wrap">{{ $order->address }}</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</x-app-layout>
