@extends('layouts.shop')

@section('content')
<div class="container py-3" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ПРИНУДИТЕЛЬНЫЙ СБРОС ОКРУГЛЕНИЙ ДЛЯ ВСЕХ КОМПОНЕНТОВ ФОРМЫ -->
    <style>
        .rounded-0, .btn, .form-control, .form-select, .badge, .alert {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        .form-control, .form-select {
            border: 1px solid #DEE2E6;
            color: #212529;
            padding: 0.6rem 0.75rem;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
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
                Панель администратора / Доступ
            </span>
            <h1 class="fs-4 fs-md-3 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.03rem;">
                Редактирование профиля: {{ $user->name }}
            </h1>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-dark rounded-0 text-uppercase fw-bold px-3 d-inline-flex align-items-center justify-content-center mobile-touch-target w-100 w-sm-auto" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
            ← Назад к списку
        </a>
    </div>

    <!-- ВЫВОД ГЛОБАЛЬНЫХ ОШИБОК ИЛИ УВЕДОМЛЕНИЙ СЕССИИ -->
    @if(session('error'))
        <div class="alert alert-danger border-0 bg-light-block border-start border-3 text-graphite mb-4" style="border-color: #dc3545 !important;" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- ГЛАВНАЯ ФОРМА МОДЕРНИЗАЦИИ ДАННЫХ -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="needs-validation">
        @csrf
        @method('PUT')

        <div class="bg-light-block border border-subtle-gray p-3 p-md-4 mb-4">
            <div class="row g-3">
                
                <!-- ФИО ПОЛЬЗОВАТЕЛЯ -->
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">ФИО Пользователя *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-control rounded-0 @error('name') border-danger @enderror" 
                           value="{{ old('name', $user->name) }}" 
                           required>
                    @error('name')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- ПРАВА ДОСТУПA / РОЛЬ -->
                <div class="col-12 col-md-6">
                    <label for="role" class="form-label">Права доступа / Роль *</label>
                    <select id="role" 
                            name="role" 
                            class="form-select rounded-0 @error('role') border-danger @enderror" 
                            required 
                            {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Клиент</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Администратор</option>
                    </select>
                    @if(Auth::id() == $user->id)
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <span class="text-muted-gray d-block mt-1 font-monospace" style="font-size: 0.65rem;">
                            ВЫ НЕ МОЖЕТЕ ИЗМЕНИТЬ СОБСТВЕННУЮ РОЛЬ БЕЗОПАСНОСТИ
                        </span>
                    @endif
                    @error('role')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- ЭЛЕКТРОННАЯ ПОЧТА -->
                <div class="col-12 col-md-6">
                    <label for="email" class="form-label">Электронная почта *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control rounded-0 font-monospace @error('email') border-danger @enderror" 
                           value="{{ old('email', $user->email) }}" 
                           required>
                    @error('email')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- НОМЕР ТЕЛЕФОНА -->
                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label">Номер телефона</label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           class="form-control rounded-0 font-monospace @error('phone') border-danger @enderror" 
                           value="{{ old('phone', $user->phone) }}" 
                           placeholder="+7 (999) 000-00-00">
                    @error('phone')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- АДРЕС ДОСТАВКИ -->
                <div class="col-12">
                    <label for="address" class="form-label">Адрес доставки фабричной мебели</label>
                    <input type="text" 
                           id="address" 
                           name="address" 
                           class="form-control rounded-0 @error('address') border-danger @enderror" 
                           value="{{ old('address', $user->address) }}" 
                           placeholder="Укажите город, улицу, дом, квартиру...">
                    @error('address')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

                <!-- РАЗДЕЛИТЕЛЬ ДЛЯ БЕЗОПАСНОСТИ -->
                <div class="col-12 pt-2">
                    <hr class="m-0 border-subtle-gray">
                </div>

                <!-- НОВЫЙ ПАРОЛЬ -->
                <div class="col-12">
                    <label for="password" class="form-label">Новый пароль аккаунта</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control rounded-0 font-monospace @error('password') border-danger @enderror" 
                           placeholder="Оставьте пустым, если не хотите менять">
                    <span class="text-muted-gray d-block mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                        ЗАПОЛНЯТЬ ТОЛЬКО ПРИ ПРИНУДИТЕЛЬНОМ СБРОСЕ ПАРОЛЯ СОТРУДНИКА ИЛИ КЛИЕНТА
                    </span>
                    @error('password')
                        <div class="text-danger fw-bold mt-1 font-monospace" style="font-size: 0.65rem; letter-spacing: 0.02rem;">
                            {{ mb_toUpperCase($message) }}
                        </div>
                    @enderror
                </div>

            </div>
        </div>

        <!-- МОНУМЕНТАЛЬНАЯ КНОПКА ОТПРАВКИ -->
        <button type="submit" class="btn btn-dark w-100 rounded-0 text-uppercase fw-bold btn-submit-mobile d-flex align-items-center justify-content-center" style="font-size: 0.8rem; letter-spacing: 0.08rem; height: 52px; background-color: #212529;">
            Сохранить изменения в базе данных
        </button>
    </form>
</div>
@endsection
