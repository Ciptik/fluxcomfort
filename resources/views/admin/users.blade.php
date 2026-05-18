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
            Контроль доступа фабрики <span style="color: #198754;">Fluxcomfort</span>
        </h1>
        <span class="badge bg-dark px-3 py-2 text-uppercase d-none d-sm-inline-block" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
            Панель администратора
        </span>
    </div>

    <!-- МЕНЮ НАВИГАЦИИ АДМИНИСТРАТОРА -->
    <div class="mb-4 border-bottom border-subtle-gray">
        <ul class="nav nav-admin row g-0">
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link w-100 px-md-4 py-md-2" href="{{ route('admin.dashboard') }}">
                    📦 Заказы фабрики
                </a>
            </li>
            <li class="nav-item col-6 col-md-auto">
                <a class="nav-link w-100 px-md-4 py-md-2" href="{{ route('admin.products') }}">
                    🪑 Ассортимент (Товары)
                </a>
            </li>
            <li class="nav-item col-12 col-md-auto">
                <a class="nav-link active w-100 px-md-4 py-md-2 border-top border-md-0" href="{{ route('admin.users') }}">
                    👥 Пользователи
                </a>
            </li>
        </ul>
    </div>

    <!-- УВЕДОМЛЕНИЯ И ОШИБКИ БЕЗОПАСНОСТИ -->
    @if(session('success'))
        <div class="alert alert-success border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #198754 !important;" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #dc3545 !important;" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- ДЕСКТОПНАЯ СТРОГАЯ ТАБЛИЦА ПОЛЬЗОВАТЕЛЕЙ (ЭКРАНЫ >= 768px) -->
    <div class="table-responsive d-none d-md-block bg-white border border-subtle-gray">
        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
            <thead class="bg-light-block text-graphite text-uppercase small fw-bold border-bottom border-subtle-gray">
                <tr>
                    <th scope="col" class="py-3 px-4 border-subtle-gray" style="width: 10%;">ID</th>
                    <th scope="col" class="py-3 border-subtle-gray" style="width: 30%;">Имя пользователя</th>
                    <th scope="col" class="py-3 border-subtle-gray" style="width: 30%;">Email-адрес</th>
                    <th scope="col" class="py-3 text-center border-subtle-gray" style="width: 15%;">Статус роли</th>
                    <th scope="col" class="py-3 text-end px-4 border-subtle-gray" style="width: 15%;">Изменить уровень</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-bottom border-subtle-gray">
                        <td class="py-3 px-4 fw-bold text-graphite border-subtle-gray">#{{ $user->id }}</td>
                        <td class="py-3 border-subtle-gray fw-semibold text-graphite">
                            {{ $user->name }}
                            @if(Auth::id() == $user->id)
                                <span class="text-muted-gray small fw-normal ms-1">(Вы)</span>
                            @endif
                        </td>
                        <td class="py-3 border-subtle-gray text-muted-gray">{{ $user->email }}</td>
                        <td class="py-3 text-center border-subtle-gray">
                            @if(isset($user->role) && $user->role === 'admin')
                                <span class="badge bg-dark text-white px-2 py-1 text-uppercase font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05rem;">АДМИНИСТРАТОР</span>
                            @else
                                <span class="badge bg-light text-dark border border-dark-subtle px-2 py-1 text-uppercase font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05rem;">КЛИЕНТ</span>
                            @endif
                        </td>
                        <td class="py-3 text-end px-4 border-subtle-gray">
                            <form action="{{ route('admin.users.role', $user->id) }}" method="POST" class="d-flex gap-1 justify-content-end">
                                @csrf
                                <select name="role" class="form-select form-select-sm rounded-0 border-subtle-gray text-uppercase fw-bold text-graphite" style="font-size: 0.75rem; max-width: 130px;" {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                    <option value="user" {{ (!isset($user->role) || $user->role !== 'admin') ? 'selected' : '' }}>Клиент</option>
                                    <option value="admin" {{ (isset($user->role) && $user->role === 'admin') ? 'selected' : '' }}>Админ</option>
                                </select>
                                <button type="submit" class="btn btn-dark btn-sm rounded-0 px-2 text-uppercase fw-bold" style="font-size: 0.7rem;" {{ Auth::id() == $user->id ? 'disabled' : '' }}>ОК</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- МОБИЛЬНАЯ АДАПТИВНАЯ ВЕРСТКА ДЛЯ СМАРТФОНОВ (ЭКРАНЫ < 768px) -->
    <div class="d-md-none d-flex flex-column gap-3">
        @foreach($users as $user)
            <div class="border border-subtle-gray p-3 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <span class="text-graphite fw-bold fs-6">#{{ $user->id }}</span>
                        <span class="text-graphite fw-bold ms-2">
                            {{ $user->name }}
                            @if(Auth::id() == $user->id)
                                <span class="text-muted-gray small fw-normal">(Вы)</span>
                            @endif
                        </span>
                    </div>
                    <div>
                        @if(isset($user->role) && $user->role === 'admin')
                            <span class="badge bg-dark text-white px-2 py-1 text-uppercase font-monospace" style="font-size: 0.65rem;">АДМИН</span>
                        @else
                            <span class="badge bg-light text-dark border border-dark-subtle px-2 py-1 text-uppercase font-monospace" style="font-size: 0.65rem;">КЛИЕНТ</span>
                        @endif
                    </div>
                </div>

                <div class="bg-light-block p-2 mb-3 border border-subtle-gray" style="font-size: 0.85rem;">
                    <span class="text-muted-gray">Email:</span> <span class="text-graphite font-monospace">{{ $user->email }}</span>
                </div>

                <!-- Форма смены ролей под палец (>= 44px) -->
                <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <select name="role" class="form-select rounded-0 border-subtle-gray text-uppercase fw-bold text-graphite mobile-touch-target" style="font-size: 0.85rem;" {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                            <option value="user" {{ (!isset($user->role) || $user->role !== 'admin') ? 'selected' : '' }}>Клиент</option>
                            <option value="admin" {{ (isset($user->role) && $user->role === 'admin') ? 'selected' : '' }}>Админ</option>
                        </select>
                        <button type="submit" class="btn btn-dark rounded-0 text-uppercase fw-bold mobile-touch-target px-3" style="font-size: 0.75rem; letter-spacing: 0.05rem;" {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                            ОК
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
