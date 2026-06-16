<x-app-layout>
    <!-- ПОДКЛЮЧЕНИЕ BOOTSTRAP ДЛЯ ИЗОЛЯЦИИ СТИЛЕЙ КБ -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        /* Глобальный сброс фонов под концепцию Fluxcomfort */
        body, .min-h-screen, main {
            background-color: #ffffff !important;
        }
        
        /* Суровый минимализм: тотальный отказ от скруглений */
        .rounded-0, .btn, .form-control, .alert, .modal-content {
            border-radius: 0px !important;
        }
        
        /* Убираем тени Breeze для чистоты структуры */
        .shadow, .shadow-sm, .shadow-md, .shadow-lg {
            box-shadow: none !important;
        }

        /* Принудительная высота инпутов и кнопок на мобильных (Touch Target) */
        .form-control, .btn-touch {
            min-height: 44px;
        }

        .text-graphite { color: #212529 !important; }
        .text-muted-gray { color: #6C757D !important; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        
        /* Хвойно-зеленый акцент */
        .btn-accent {
            background-color: #198754 !important;
            color: #ffffff !important;
            border: none !important;
        }
        .btn-accent:hover {
            background-color: #146c43 !important;
            color: #ffffff !important;
        }
    </style>

    <div class="container py-4 py-md-5">
        <div class="row">
            <div class="col-12 mx-auto" style="max-width: 720px;">
                
                <!-- НАВИГАЦИОННАЯ ШАПКА -->
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom border-subtle-gray">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase font-monospace" style="letter-spacing: 0.05rem;">
                        ← В Личный кабинет
                    </a>
                    <a href="/catalog" class="text-decoration-none text-muted-gray small fw-bold text-uppercase font-monospace" style="letter-spacing: 0.05rem;">
                        В Каталог магазина →
                    </a>
                </div>

                <!-- ЗАГОЛОВОК СТРАНИЦЫ -->
                <h1 class="fs-3 text-uppercase fw-bold text-graphite mb-5" style="letter-spacing: 0.05rem;">
                    Настройки профиля
                </h1>

                <!-- ПОДФОРМА 1: ИНФОРМАЦИЯ ПРОФИЛЯ -->
                <div class="py-4 border-bottom border-subtle-gray">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- ПОДФОРМА 2: СМЕНА ПАРОЛЯ -->
                <div class="py-4 border-bottom border-subtle-gray">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- ПОДФОРМА 3: УДАЛЕНИЕ АККАУНТА -->
                <div class="py-4">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
