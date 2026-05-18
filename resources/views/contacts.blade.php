@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-5" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ИНЖЕНЕРНЫЕ СТИЛИ И СБРОС ОКРУГЛЕНИЙ FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .form-control, .form-label, .breadcrumb-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .text-accent-green { color: #198754; }
        
        /* Стилизация полей ввода для строгого минимализма */
        .form-control-flux {
            background-color: #FFFFFF;
            border: 1px solid #DEE2E6;
            color: #212529;
            font-size: 0.95rem;
            transition: none;
        }
        .form-control-flux:focus {
            border-color: #212529;
            box-shadow: none;
            background-color: #FFFFFF;
        }

        .btn-flux-submit {
            background-color: #212529;
            color: #FFFFFF;
            border: 1px solid #212529;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.05rem;
            transition: none;
        }
        .btn-flux-submit:hover {
            background-color: #000000;
            border-color: #000000;
            color: #FFFFFF;
        }

        /* Оптимизация кликабельности для мобильных */
        @media (max-width: 767.98px) {
            .mobile-touch-target {
                min-height: 44px;
            }
        }
    </style>

    <!-- НАВИГАЦИОННЫЙ МАРШРУТ -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
            <li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Главная</a></li>
            <li class="breadcrumb-item active text-graphite fw-semibold" aria-current="page">Контакты</li>
        </ol>
    </nav>

    <!-- ЗАГОЛОВОК СТРАНИЦЫ -->
    <div class="pb-2 mb-4 border-bottom border-subtle-gray">
        <h1 class="text-uppercase fw-bold text-graphite m-0 fs-2 fs-md-1" style="letter-spacing: 0.02rem;">
            Связь с производством и офисом
        </h1>
    </div>

    <!-- ДВУХКОЛОНОЧНЫЙ ИНЖЕНЕРНЫЙ МАКЕТ -->
    <div class="row g-4 g-lg-5">
        
        <!-- ЛЕВАЯ КОЛОНКА: РЕКВИЗИТЫ, КАНАЛЫ СВЯЗИ И ФОРМА -->
        <div class="col-12 col-md-5">
            
            <!-- Информационный блок -->
            <div class="mb-4">
                <h2 class="text-uppercase fw-bold text-graphite fs-5 mb-3" style="letter-spacing: 0.03rem;">
                    Центральный офис и склад
                </h2>
                
                <div class="mb-3">
                    <span class="d-block small text-muted-gray text-uppercase font-monospace mb-1">Адрес комплекса:</span>
                    <strong class="d-block text-graphite lh-sm">г. Москва, ул. Производственная, д. 12, стр. 4</strong>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-12 col-sm-6 col-md-12">
                        <span class="d-block small text-muted-gray text-uppercase font-monospace mb-1">Отдел продаж:</span>
                        <a href="tel:+74950000000" class="d-block text-graphite fw-bold text-decoration-none">+7 (495) 000-00-00</a>
                        <a href="mailto:info@fluxcomfort.ru" class="d-block text-muted-gray small">info@fluxcomfort.ru</a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-12">
                        <span class="d-block small text-muted-gray text-uppercase font-monospace mb-1">Часы отгрузки склада:</span>
                        <span class="d-block text-graphite">Пн — Сб: с 09:00 до 19:00</span>
                        <span class="d-block text-danger small font-monospace">Воскресенье — выходной</span>
                    </div>
                </div>
            </div>

            <!-- Форма связи с технологом -->
            <div class="p-3 bg-light-block border border-subtle-gray">
                <h3 class="text-uppercase fw-bold text-graphite fs-6 mb-3" style="letter-spacing: 0.05rem;">
                    // Форма связи с технологом
                </h3>
                
                <form action="{{ route('contacts.messages.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-2">
                        <label for="name" class="visually-hidden">Ваше имя</label>
                        <input type="text" name="name" id="name" required class="form-control form-control-flux rounded-0 mobile-touch-target" placeholder="Имя или Название организации">
                    </div>

                    <div class="mb-2">
                        <label for="email" class="visually-hidden">Email-адрес</label>
                        <input type="email" name="email" id="email" required class="form-control form-control-flux rounded-0 mobile-touch-target" placeholder="Email-адрес для ответа">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="visually-hidden">Суть технического запроса</label>
                        <textarea name="message" id="message" rows="4" required class="form-control form-control-flux rounded-0" placeholder="Опишите суть запроса, требуемые размеры мебели или спецификацию фурнитуры..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-flux-submit w-100 rounded-0 mobile-touch-target d-flex align-items-center justify-content-center" style="font-size: 0.85rem;">
                        Отправить запрос
                    </button>

                    <!-- СООТВЕТСТВИЕ ФЗ-152 -->
                    <span class="d-block text-muted-gray mt-2 font-monospace text-wrap" style="font-size: 0.68rem; line-height: 1.3;">
                        Нажимая кнопку, вы подтверждаете согласие на обработку персональных данных в соответствии с ФЗ-152 для обработки данного обращения.
                    </span>
                </form>
            </div>

        </div>

        <!-- ПРАВАЯ КОЛОНКА: ИНТЕРАКТИВНАЯ КАРТА ПРОЕЗДА -->
        <div class="col-12 col-md-7 d-flex flex-column">
            <span class="d-block small text-muted-gray text-uppercase font-monospace mb-2" style="letter-spacing: 0.05rem;">
                Схема проезда для грузового и легкового транспорта:
            </span>
            
            <div class="w-100 border border-dark flex-grow-1 position-relative bg-light-block d-flex align-items-center justify-content-center" style="min-height: 350px; aspect-ratio: 16/10;">
                
                <!-- ИНТЕРАКТИВНЫЙ IFRAME С КАРТОЙ (Для продакшена раскомментировать код ниже, заменив ссылку на нужную геометрию) -->
                <!-- 
                <iframe src="https://yandex.ru/map-widget/v1/?id-вашей-метки" width="100%" height="100%" class="position-absolute top-0 start-0 border-0" allowfullscreen="true" style="object-fit: cover;"></iframe>
                -->

                <!-- СТРОГАЯ МИНИМАЛИСТИЧНАЯ ЗАГЛУШКА ДЛЯ РАЗРАБОТКИ -->
                <div class="text-center p-4">
                    <div class="text-accent-green fs-4 mb-2">🗺️</div>
                    <span class="text-graphite fw-bold text-uppercase d-block mb-1" style="font-size: 0.85rem; letter-spacing: 0.05rem;">
                        Интерактивная карта проезда
                    </span>
                    <span class="text-muted-gray font-monospace small d-block">
                        к складу и фабрике FLUXCOMFORT
                    </span>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
