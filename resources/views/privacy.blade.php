@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ФИКСАЦИЯ СТИЛЕЙ FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .alert, .breadcrumb-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .text-accent-green { color: #198754; }
        
        .legal-text p {
            line-height: 1.65;
            margin-bottom: 1.25rem;
            font-size: 1rem;
        }
        .legal-text ol {
            padding-left: 1.25rem;
            margin-bottom: 1.5rem;
        }
        .legal-text li {
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }
    </style>

    <!-- НАВИГАЦИОННЫЙ МАРШРУТ -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
            <li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Главная</a></li>
            <li class="breadcrumb-item active text-graphite fw-semibold" aria-current="page">Конфиденциальность</li>
        </ol>
    </nav>

    <!-- ОГРАНИЧЕНИЕ ШИРИНЫ ДЛЯ КОМФОРТНОГО ЧТЕНИЯ -->
    <div class="row">
        <div class="col-12 col-lg-8 col-xl-7 legal-text">
            
            <!-- ЗАГОЛОВОК СТРАНИЦЫ -->
            <h1 class="text-uppercase fw-bold text-graphite mb-4 fs-3 fs-md-2" style="letter-spacing: 0.02rem; line-height: 1.2;">
                Положение об обработке личных данных пользователей мебельной фабрики Fluxcomfort (ФЗ-152)
            </h1>

            <p class="text-muted-gray small mb-4 font-monospace">
                Редакция документа действует от: {{ date('d.m.Y') }}
            </p>

            <div class="p-3 bg-light-block border-start border-3 border-dark mb-4">
                <p class="m-0 small text-graphite">
                    Настоящее положение определяет порядок сбора, систематизации и защиты персональных данных клиентов интернет-магазина <strong>Fluxcomfort</strong> в строгом соответствии с законодательством РФ.
                </p>
            </div>

            <!-- ПУНКТЫ ПОЛИТИКИ -->
            <h2 class="text-uppercase fw-bold text-graphite fs-5 mt-4 mb-3" style="letter-spacing: 0.05rem;">
                1. Цели сбора персональных данных
            </h2>
            <p>
                Обработка данных пользователей осуществляется исключительно для выполнения обязательств фабрики перед покупателем. Мы запрашиваем минимальный набор данных (ФИО, контактный телефон, адрес доставки и адрес электронной почты) строго для следующих процедур:
            </p>
            <ol>
                <li>Регистрация и идентификация личного аккаунта в системе Fluxcomfort.</li>
                <li>Производство индивидуальных мебельных заказов на мощностях фабрики.</li>
                <li>Логистика, организация адресной доставки, подъем на этаж и сборка мебели специалистами сервисной службы.</li>
                <li>Направление уведомлений о статусе готовности и транспортировки изделий.</li>
            </ol>

            <h2 class="text-uppercase fw-bold text-graphite fs-5 mt-4 mb-3" style="letter-spacing: 0.05rem;">
                2. Защита и передача информации
            </h2>
            <p>
                Администрация интернет-магазина Fluxcomfort применяет современные протоколы шифрования и организационно-технические меры для защиты информации от несанкционированного доступа.
            </p>
            <p>
                Передача личных данных третьим лицам категорически исключена, за исключением случаев, когда это прямо необходимо для исполнения договора (например, передача адреса штатной курьерской службе или банку-партнеру для оформления беспроцентной рассрочки на мебель по инициативе покупателя).
            </p>

            <h2 class="text-uppercase fw-bold text-graphite fs-5 mt-4 mb-3" style="letter-spacing: 0.05rem;">
                3. Права пользователя и отзыв данных
            </h2>
            <p>
                Каждый клиент имеет право в любой момент запросить информацию о хранящихся данных, потребовать их корректировки или полного удаления из базы данных фабрики. Отзыв согласия осуществляется путем направления заявления в свободной форме на официальную электронную почту службы клиентской поддержки Fluxcomfort.
            </p>

        </div>
    </div>
</div>
@endsection
