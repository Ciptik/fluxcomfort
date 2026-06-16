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

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center border-bottom border-dark pb-3 mb-4 gap-3">
        <div>
            <span class="text-uppercase text-muted font-monospace small" style="font-size: 0.7rem; letter-spacing: 1px;">BACK-OFFICE // КОНТРОЛЬ СИСТЕМЫ</span>
            <h1 class="text-uppercase fw-bold text-graphite m-0 fs-3" style="letter-spacing: -0.5px;">Управление заказами фабрики</h1>
        </div>
        <div class="d-flex gap-2 w-100 w-md-auto">
            <a href="{{ route('admin.products') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 py-2 fs-6 flex-grow-1 flex-md-grow-0" style="letter-spacing: 0.05rem;">📦 Товары</a>
            <a href="{{ route('admin.users') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 py-2 fs-6 flex-grow-1 flex-md-grow-0" style="letter-spacing: 0.05rem;">👥 Пользователи</a>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="p-4 border border-subtle-gray bg-light-block text-center font-monospace text-muted-gray small">
            [ НА ТЕКУЩИЙ МОМЕНТ ЗАКАЗЫ В СИСТЕМЕ FLUXCOMFORT ОТСУТСТВУЮТ ]
        </div>
    @else
        <div class="d-flex flex-column gap-3">
            @foreach($orders as $order)
                <div class="bg-white p-3 border border-subtle-gray">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 pb-2 border-bottom border-light">
                        <div>
                            <span class="font-monospace fw-bold text-uppercase text-graphite fs-5">Заказ #{{ $order->id }}</span>
                            <span class="text-muted-gray font-monospace small ms-md-2" style="font-size: 0.85rem;">от {{ date('d.m.Y H:i', strtotime($order->created_at)) }}</span>
                        </div>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="text-muted-gray font-monospace small" style="font-size: 0.85rem;">Покупатель: <strong>{{ $order->user_name }}</strong> ({{ $order->user_email }})</span>
                            <span class="badge rounded-0 px-2 py-1 font-monospace text-uppercase text-white" style="font-size: 0.7rem; background-color: #212529;">{{ $order->status }}</span>
                        </div>
                    </div>

                    <div class="ps-2 border-start border-dark border-2 font-monospace fs-6 text-muted-gray my-3">
                        @foreach($order->items as $item)
                            <div class="mb-1">
                                — {{ $item->product_name }} x{{ $item->quantity }}_
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-3 pt-2">
                        <div class="font-monospace fw-bold text-graphite align-self-center fs-5">
                            ИТОГО: <span class="text-success">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</span>
                        </div>

                        <div class="d-flex gap-2">
                            <form action="{{ route('admin.orders.status.update', $order->id) }}" method="POST" class="m-0 flex-grow-1 flex-sm-grow-0">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select name="status" class="form-select rounded-0 font-monospace text-uppercase fw-bold text-graphite mobile-touch-target fs-6">
                                        <option value="new" {{ $order->status === 'new' ? 'selected' : '' }}>Получен</option>
                                        <option value="awaiting_payment" {{ $order->status === 'awaiting_payment' ? 'selected' : '' }}>Ожидание оплаты</option>
                                        <option value="payment_review" {{ $order->status === 'payment_review' ? 'selected' : '' }}>Проверка чека</option>
                                        <option value="manufacturing" {{ $order->status === 'manufacturing' ? 'selected' : '' }}>В производство</option>
                                        <option value="delivery" {{ $order->status === 'delivery' ? 'selected' : '' }}>В доставку</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Выполнен</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Отменен</option>
                                    </select>
                                    <button type="submit" class="btn btn-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 fs-6" style="letter-spacing: 0.05rem;">
                                        ОК
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" class="m-0" onsubmit="return confirm('Удалить заказ #{{ $order->id }} безвозвратно?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3 fs-6" style="height: 42px; letter-spacing: 0.05rem;">
                                    🗑️ Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
