@extends('layouts.shop')

@section('content')
<div class="container py-4 py-md-5" style="color: #212529; font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- ФИКСАЦИЯ СТИЛЕЙ FLUXCOMFORT -->
    <style>
        .rounded-0, .btn, .card, .breadcrumb-item {
            border-radius: 0px !important;
        }
        .text-graphite { color: #212529; }
        .text-muted-gray { color: #6C757D; }
        .bg-light-block { background-color: #F8F9FA; }
        .border-subtle-gray { border-color: #DEE2E6 !important; }
        .text-accent-green { color: #198754; }
        .border-accent-green { border-color: #198754 !important; }
        
        .delivery-content p {
            line-height: 1.6;
            margin-bottom: 1rem;
        }
    </style>

    <!-- НАВИГАЦИОННЫЙ МАРШРУТ -->
    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
        <ol class="breadcrumb small text-uppercase m-0" style="letter-spacing: 0.05rem;">
            <li class="breadcrumb-item"><a href="/" class="text-muted-gray text-decoration-none">Главная</a></li>
            <li class="breadcrumb-item active text-graphite fw-semibold" aria-current="page">Доставка и сборка</li>
        </ol>
    </nav>

    <!-- ЗАГОЛОВОК СТРАНИЦЫ -->
    <div class="pb-2 mb-4 border-bottom border-subtle-gray">
        <h1 class="text-uppercase fw-bold text-graphite m-0 fs-3 fs-md-2" style="letter-spacing: 0.02rem;">
            Условия сборки, подъема и доставки мебели
        </h1>
    </div>

    <div class="row g-4 delivery-content">
        <!-- ЛЕВАЯ КОЛОНКА: СЕТКА С ТАРИФАМИ И ЛОГИСТИКОЙ -->
        <div class="col-12 col-md-7 col-lg-8">
            
            <p class="text-graphite mb-4">
                Фабрика мебели <strong>Fluxcomfort</strong> осуществляет полный цикл сервисного обслуживания: от бережной транспортировки готовых изделий на специализированных автомобилях до профессионального монтажа у вас дома.
            </p>

            <!-- БЛОК 1: САМОВЫВОЗ -->
            <div class="mb-4">
                <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-2" style="letter-spacing: 0.03rem;">
                    1. Самовывоз со склада фабрики
                </h3>
                <p>
                    Вы можете бесплатно забрать готовую мебель самостоятельно непосредственно с центрального логистического терминала фабрики. Отгрузка производится только при наличии документа, удостоверяющего личность, либо оригинала договора купли-продажи.
                </p>
                <div class="p-3 bg-light-block border border-subtle-gray">
                    <span class="d-block small text-muted-gray text-uppercase font-monospace mb-1">Адрес терминала:</span>
                    <span class="d-block fw-bold text-graphite mb-2">Промышленный проезд, д. 12, стр. 4 (Зона погрузки №2)</span>
                    <span class="d-block small text-muted-gray text-uppercase font-monospace mb-1">Часы работы:</span>
                    <span class="d-block text-graphite">Пн — Сб: с 09:00 до 19:00, Вс: выходной день.</span>
                </div>
            </div>

            <!-- БЛОК 2: ДОСТАВКА -->
            <div class="mb-4">
                <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-2" style="letter-spacing: 0.03rem;">
                    2. Тарифы на курьерскую доставку
                </h3>
                <p>
                    Транспортировка корпусной и мягкой мебели требует специальных условий фиксации в кузове. Мы доставляем заказы собственным автопарком:
                </p>
                <div class="table-responsive bg-white border border-subtle-gray mb-3">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 0.9rem;">
                        <thead class="bg-light-block text-graphite text-uppercase small fw-bold">
                            <tr>
                                <th scope="col" class="py-2 px-3 border-subtle-gray">Зона доставки</th>
                                <th scope="col" class="py-2 px-3 text-end border-subtle-gray" style="width: 140px;">Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-3 border-subtle-gray">В пределах городской черты (до подъезда)</td>
                                <td class="py-2 px-3 text-end fw-bold text-graphite border-subtle-gray">1 500 ₽</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-3 border-subtle-gray">За пределы города (дополнительно за каждый км)</td>
                                <td class="py-2 px-3 text-end text-graphite border-subtle-gray">+ 40 ₽/км</td>
                            </tr>
                            <tr class="bg-light-block">
                                <td class="py-2 px-3 border-subtle-gray fw-semibold text-accent-green">При заказе на сумму от 150 000 ₽</td>
                                <td class="py-2 px-3 text-end fw-bold text-accent-green border-subtle-gray">БЕСПЛАТНО</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- БЛОК 3: ПОДЪЕМ И СБОРКА -->
            <div class="mb-4">
                <h3 class="text-uppercase fw-bold text-graphite fs-5 mb-2" style="letter-spacing: 0.03rem;">
                    3. Подъем на этаж и профессиональная сборка
                </h3>
                <p>
                    Сборка производится штатными мастерами фабрики в день доставки либо в течение 24 часов после нее. На мебель, собранную нашими специалистами, действует расширенная заводская гарантия.
                </p>
                <ul>
                    <li class="mb-1"><strong>Ручной подъем крупногабаритных упаковок:</strong> 250 ₽ / этаж за каждую крупную коробку (при отсутствии или неисправности грузового лифта).</li>
                    <li class="mb-1"><strong>Монтаж и сборка:</strong> составляет строго 10% от общей розничной стоимости изделия, но не менее 3 000 ₽ за весь гарнитур.</li>
                </ul>
            </div>

        </div>

        <!-- ПРАВАЯ КОЛОНКА: СТРОГАЯ КАРТОЧКА ВАЖНОЙ ИНФОРМАЦИИ -->
        <div class="col-12 col-md-5 col-lg-4">
            <div class="bg-light-block p-4 border-start border-3 border-accent-green border border-subtle-gray">
                <h4 class="text-uppercase fw-bold text-graphite fs-6 mb-3" style="letter-spacing: 0.05rem;">
                    ⚠️ Важно для приемки
                </h4>
                <p class="small text-graphite mb-2">
                    Покупатель обязан обеспечить свободный проход для проноса упаковок с мебелью. Ширина дверных проемов должна составлять не менее 80 см.
                </p>
                <p class="small text-graphite mb-0">
                    При получении внимательно осматривайте целостность зеркал, стекол и фасадов до подписания акта приема-передачи. После подписания акта претензии по механическим повреждениям (царапины, сколы) не принимаются.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
