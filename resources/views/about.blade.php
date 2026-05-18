@extends('layouts.shop')

@section('content')
<div class="container py-3 py-md-5" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ИНЖЕНЕРНЫЕ СТИЛИ И СБРОС ОКРУГЛЕНИЙ FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .badge, .alert, .breadcrumb-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .text-accent-green { color: #198754; }
        
        /* Особый стиль для крупных цифр */
        .industrial-number {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.05rem;
        }
        @media (min-width: 768px) {
            .industrial-number {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- НАВИГАЦИОННЫЙ МАРШРУТ -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
            <li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Главная</a></li>
            <li class="breadcrumb-item active text-graphite fw-semibold" aria-current="page">О фабрике</li>
        </ol>
    </nav>

    <!-- БЛОК 1: МАНИФЕСТ И ПРОИЗВОДСТВЕННЫЙ КОМПЛЕКС -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-5">
            <span class="badge bg-dark px-3 py-2 text-uppercase mb-2 font-monospace" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
                Since 2018 / Полный цикл
            </span>
            <h1 class="text-uppercase fw-bold text-graphite m-0 fs-2 fs-md-1" style="letter-spacing: 0.02rem; line-height: 1.1;">
                Производственный комплекс Fluxcomfort
            </h1>
        </div>
        <div class="col-12 col-md-7 d-flex align-items-center">
            <div class="border-start border-3 border-dark ps-3 ps-md-4 py-1">
                <p class="fs-5 text-graphite mb-2 fw-semibold lh-sm">
                    Мы проектируем и производим модульную архитектуру для жизни, контролируя каждый этап от распила плит до финальной сборки мягких каркасов.
                </p>
                <p class="text-muted-gray m-0" style="font-size: 0.95rem; line-height: 1.6;">
                    Собственные производственные мощности позволяют Fluxcomfort полностью исключить посредников. Конструкторское бюро фабрики разрабатывает мебель по принципам строгого функционализма: жесткая геометрия, отсутствие скрытых пустот, долговечные материалы и абсолютная утилитарность каждого элемента.
                </p>
            </div>
        </div>
    </div>

    <!-- БЛОК 2: ЦИФРЫ ПРЕДПРИЯТИЯ (СТРОГАЯ СЕТКА БЕЗ СБОКУ-РАМОК) -->
    <div class="mb-5 bg-light-block p-4 p-md-5 border border-subtle-gray">
        <span class="d-block small text-muted-gray text-uppercase font-monospace mb-4" style="letter-spacing: 0.1rem;">
            // Спецификация мощностей предприятия
        </span>
        <div class="row g-4 text-center text-md-start">
            <div class="col-12 col-md-4 border-bottom border-subtle-gray pb-3 pb-md-0 border-md-bottom-0">
                <div class="industrial-number text-graphite mb-2">4 500 <span class="fs-4 fw-normal text-muted-gray">м²</span></div>
                <div class="text-uppercase fw-bold text-graphite font-monospace small" style="letter-spacing: 0.05rem;">Площадь цехов</div>
                <div class="text-muted-gray small mt-1">Оптимизированные технологические линии и автоматизированные логистические доки.</div>
            </div>
            <div class="col-12 col-md-4 border-bottom border-subtle-gray pb-3 pb-md-0 border-md-bottom-0">
                <div class="industrial-number text-accent-green mb-2">ЧПУ</div>
                <div class="text-uppercase fw-bold text-graphite font-monospace small" style="letter-spacing: 0.05rem;">Австрия, Германия</div>
                <div class="text-muted-gray small mt-1">Парк высокоточных станков гарантирует идеальную подгонку деталей с допуском до 0.1 мм.</div>
            </div>
            <div class="col-12 col-md-4">
                <div class="industrial-number text-graphite mb-2">&gt; 12К</div>
                <div class="text-uppercase fw-bold text-graphite font-monospace small" style="letter-spacing: 0.05rem;">Выпущено моделей</div>
                <div class="text-muted-gray small mt-1">Надежные изделия, которые прямо сейчас успешно эксплуатируются в частных и коммерческих интерьерах.</div>
            </div>
        </div>
    </div>

    <!-- БЛОК 3: НАШИ ПРИНЦИПЫ (3 СТРОГИЕ КОЛОНКИ С РАМКАМИ BORDER-DARK) -->
    <div class="mt-4">
        <h2 class="text-uppercase fw-bold text-graphite mb-4 fs-4 text-center text-md-start" style="letter-spacing: 0.05rem;">
            Стандарты и регламенты производства
        </h2>
        <div class="row g-3 g-lg-4">
            
            <!-- Принцип 1 -->
            <div class="col-12 col-md-4">
                <div class="border border-dark p-4 h-100 d-flex flex-column justify-content-between bg-white">
                    <div>
                        <span class="text-accent-green font-monospace fw-bold d-block mb-2">[ 01 ]</span>
                        <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-3" style="letter-spacing: 0.02rem; line-height: 1.2;">
                            Экологичность материалов E1
                        </h3>
                        <p class="text-muted-gray m-0 small" style="line-height: 1.5;">
                            Мы используем ЛДСП и МДФ плиты исключительно европейского стандарта безопасности с классом эмиссии E1. Наша мебель полностью гипоаллергенна, не имеет резкого химического запаха и абсолютно безопасна для жилых комнат, спален и детских пространств.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Принцип 2 -->
            <div class="col-12 col-md-4">
                <div class="border border-dark p-4 h-100 d-flex flex-column justify-content-between bg-white">
                    <div>
                        <span class="text-accent-green font-monospace fw-bold d-block mb-2">[ 02 ]</span>
                        <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-3" style="letter-spacing: 0.02rem; line-height: 1.2;">
                            Надежность фурнитуры
                        </h3>
                        <p class="text-muted-gray m-0 small" style="line-height: 1.5;">
                            Петли, направляющие и скрытые крепежные элементы подбираются под повышенные статические нагрузки. Системы плавного закрывания и доводчики рассчитаны минимум на 80 000 циклов открытия-закрытия, сохраняя плавность хода на годы вперед.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Принцип 3 -->
            <div class="col-12 col-md-4">
                <div class="border border-dark p-4 h-100 d-flex flex-column justify-content-between bg-white">
                    <div>
                        <span class="text-accent-green font-monospace fw-bold d-block mb-2">[ 03 ]</span>
                        <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-3" style="letter-spacing: 0.02rem; line-height: 1.2;">
                            Строгий контроль ОТК
                        </h3>
                        <p class="text-muted-gray m-0 small" style="line-height: 1.5;">
                            Каждое изделие перед передачей в службу логистики проходит ручную контрольную сборку на специальном стенде фабрики. Мы проверяем плоскостность поверхностей, соосность присадочных отверстий и отсутствие дефектов защитной кромки.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
