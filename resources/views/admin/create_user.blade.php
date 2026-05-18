@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-4" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- СТИЛИ СБРОСА СКРУГЛЕНИЙ И СУРОВОГО МИНИМАЛИЗМА FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .form-control, .form-select, .alert {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529 !important; }
        .text-muted-gray { color: #6C757D !important; }
        .bg-light-block { background-color: #F8F9FA !important; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        /* Инженерный фокус для полей ввода */
        .form-control:focus, .form-select:focus {
            border-color: #212529 !important;
            box-shadow: none !important;
            background-color: #ffffff;
        }
        
        /* Кнопки управления */
        .btn-factory-dark {
            background-color: #212529 !important;
            color: #ffffff !important;
            border: 1px solid #212529 !important;
            transition: background-color 0.15s ease-in-out;
        }
        .btn-factory-dark:hover {
            background-color: #000000 !important;
            border-color: #000000 !important;
        }
        .btn-factory-outline {
            border: 1px solid #212529 !important;
            color: #212529 !important;
            background: transparent !important;
            transition: all 0.15s ease-in-out;
        }
        .btn-factory-outline:hover {
            background-color: #212529 !important;
            color: #ffffff !important;
        }
    </style>

    <!-- ВЕРХНЯЯ НАВИГАЦИОННАЯ ПАНЕЛЬ -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4 border-bottom border-subtle-gray pb-3">
        <div>
            <h1 class="fs-4 text-uppercase fw-bold text-graphite m-0" style="letter-spacing: 0.05rem;">
                Регистрация новой учетной записи
            </h1>
            <span class="text-muted-gray small font-monospace text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.02rem;">
                Панель управления фабрикой / Пользователи
            </span>
        </div>
        <a href="{{ route('admin.users') }}" class="btn btn-factory-outline btn-sm rounded-0 text-uppercase fw-bold w-100 w-sm-auto px-3 py-2" style="font-size: 0.75rem; letter-spacing: 0.05rem; min-height: 44px; display: inline-flex; align-items: center; justify-content: center;">
            ← К списку пользователей
        </a>
    </div>

    <!-- ФОРМА СОЗДАНИЯ ПОЛЬЗОВАТЕЛЯ -->
    <form action="{{ route('admin.users.store') }}" method="POST" class="m-0">
        @csrf

        <div class="bg-light-block border border-subtle-gray p-3 p-md-4">
            <div class="row g-3">
                
                <!-- ФИО Пользователя -->
                <div class="col-12 col-md-8">
                    <label for="name" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        ФИО Пользователя <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" value="{{ old('name') }}" placeholder="Иванов Иван Иванович" required>
                    @error('name')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

                <!-- Права доступа / Роль -->
                <div class="col-12 col-md-4">
                    <label for="role" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        Права доступа / Роль <span class="text-danger">*</span>
                    </label>
                    <select name="role" id="role" class="form-select rounded-0 border-subtle-gray bg-white py-2 text-graphite" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Выберите роль в системе...</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Покупатель (По умолчанию)</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Администратор цеха</option>
                    </select>
                    @error('role')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

                <!-- Электронная почта -->
                <div class="col-12 col-md-4">
                    <label for="email" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        Электронная почта <span class="text-danger">*</span>
                    </label>
                    <input type="email" name="email" id="email" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" value="{{ old('email') }}" placeholder="example@fluxcomfort.ru" required>
                    @error('email')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

                <!-- Номер телефона -->
                <div class="col-12 col-md-4">
                    <label for="phone" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        Номер телефона
                    </label>
                    <input type="text" name="phone" id="phone" class="form-control rounded-0 border-subtle-gray bg-white py-2 font-monospace text-graphite" value="{{ old('phone') }}" placeholder="+7 (999) 000-00-00">
                    @error('phone')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

                <!-- Пароль аккаунта -->
                <div class="col-12 col-md-4">
                    <label for="password" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        Пароль аккаунта <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="password" id="password" minlength="6" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" placeholder="••••••••" required>
                    <div class="form-text text-muted-gray mt-1 font-monospace" style="font-size: 0.65rem; line-height: 1.2;">
                        [ МИНИМУМ 6 СИМВОЛОВ ]
                    </div>
                    @error('password')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

                <!-- Адрес доставки по умолчанию -->
                <div class="col-12">
                    <label for="address" class="form-label text-uppercase small fw-bold text-graphite mb-2" style="font-size: 0.75rem; letter-spacing: 0.05rem;">
                        Адрес доставки по умолчанию
                    </label>
                    <input type="text" name="address" id="address" class="form-control rounded-0 border-subtle-gray bg-white py-2 text-graphite" value="{{ old('address') }}" placeholder="г. Москва, ул. Строителей, д. 8, кв. 12">
                    @error('address')
                        <div class="text-danger small text-uppercase font-monospace mt-1" style="font-size: 0.7rem;">{{ Str::upper($message) }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <!-- КНОПКА ДЕЙСТВИЯ -->
        <div class="mt-4">
            <button type="submit" class="btn btn-factory-dark w-100 text-uppercase fw-bold rounded-0 py-3" style="font-size: 0.85rem; letter-spacing: 0.08rem; min-height: 52px;">
                Создать профиль в системе
            </button>
        </div>

    </form>
</div>
@endsection
