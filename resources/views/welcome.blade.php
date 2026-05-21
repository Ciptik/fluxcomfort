@extends('layouts.shop')

@section('content')
<section class="py-4 py-md-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-12 col-lg-7">
                <span class="text-uppercase text-success small mb-2 d-block font-monospace fw-bold" style="letter-spacing: 2px;">Архитектура интерьера // FLUX.01</span>
                <h1 class="display-5 fw-bold mb-3 text-white text-uppercase" style="letter-spacing: -1px; line-height: 1.1;">Мебельная фабрика <br>Fluxcomfort</h1>
                <p class="fs-6 mb-4 text-light opacity-75 fw-light text-wrap" style="max-width: 580px; line-height: 1.6;">
                    Проектирование и серийное производство корпусной и мягкой мебели премиального сегмента. Строгая геометрия, бескомпромиссная чистота линий и полное отсутствие визуального шума для современных пространств.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-2">
                    <a href="{{ route('catalog') }}" class="btn btn-flux-primary px-4 py-3 text-uppercase fw-bold rounded-0" style="font-size: 0.75rem; letter-spacing: 0.5px;">Перейти в каталог</a>
                    <a href="#consultation" class="btn btn-outline-light px-4 py-3 text-uppercase fw-bold rounded-0" style="font-size: 0.75rem; letter-spacing: 0.5px;">Индивидуальный проект</a>
                </div>
            </div>
            <div class="col-12 col-lg-5 d-none d-lg-block">
                <div class="border border-secondary p-4 bg-transparent d-flex align-items-center justify-content-center" style="height: 320px;">
                    <svg viewBox="0 0 200 200" width="100%" height="100%" style="max-height: 260px;">
                        <line x1="0" y1="50" x2="200" y2="50" stroke="#2D3238" stroke-width="0.5"/>
                        <line x1="0" y1="100" x2="200" y2="100" stroke="#2D3238" stroke-width="0.5"/>
                        <line x1="0" y1="150" x2="200" y2="150" stroke="#2D3238" stroke-width="0.5"/>
                        <line x1="50" y1="0" x2="50" y2="200" stroke="#2D3238" stroke-width="0.5"/>
                        <line x1="100" y1="0" x2="100" y2="200" stroke="#2D3238" stroke-width="0.5"/>
                        <line x1="150" y1="0" x2="150" y2="200" stroke="#2D3238" stroke-width="0.5"/>
                        
                        <rect x="40" y="70" width="120" height="80" fill="none" stroke="#F8F9FA" stroke-width="1.5"/>
                        <rect x="55" y="85" width="90" height="50" fill="none" stroke="#6C757D" stroke-width="1"/>
                        <line x1="50" y1="150" x2="50" y2="170" stroke="#F8F9FA" stroke-width="2"/>
                        <line x1="150" y1="150" x2="150" y2="170" stroke="#F8F9FA" stroke-width="2"/>
                        <circle cx="40" cy="70" r="3" fill="#198754"/>
                        <circle cx="160" cy="70" r="3" fill="#198754"/>
                        <text x="55" y="60" font-family="monospace" font-size="7" fill="#6C757D" letter-spacing="0.5">MODEL: FLUX-CHAIR // EXT-01</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white border-bottom border-subtle-gray py-4">
    <div class="container">
        <div class="row g-3 g-md-4">
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Собственное производство</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Полный цикл обработки материалов и сквозной контроль геометрии на каждом этапе.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Доставка и сборка</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Собственная логистическая служба бережно доставит и соберет мебель за 1 день.</p>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-start">
                <div class="me-3 mt-1"><div style="width: 8px; height: 8px; background-color: #198754;"></div></div>
                <div>
                    <h5 class="text-graphite fw-bold mb-1 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Гарантия 24 месяца</h5>
                    <p class="text-muted-gray small mb-0 text-wrap">Мы абсолютно уверены в износостойкости наших материалов и австрийской фурнитуры.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light-block border-bottom border-subtle-gray py-4 py-md-5">
    <div class="container">
        <div class="mb-4">
            <span class="text-uppercase text-muted-gray small font-monospace d-block mb-1" style="letter-spacing: 1px;">Архитектурные решения</span>
            <h2 class="text-graphite fw-bold m-0 text-uppercase fs-4" style="letter-spacing: 1px;">Интерьерные зоны</h2>
        </div>
        <div class="row g-2 g-md-3">
            <div class="col-12 col-md-4">
                <div class="p-4 bg-white border border-subtle-gray h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-3 opacity-75">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="2" y="10" width="36" height="20" stroke="#212529" stroke-width="1.5"/>
                                <line x1="12" y1="10" x2="12" y2="30" stroke="#6C757D" stroke-width="1"/>
                                <line x1="28" y1="10" x2="28" y2="30" stroke="#6C757D" stroke-width="1"/>
                                <line x1="6" y1="30" x2="6" y2="34" stroke="#212529" stroke-width="2"/>
                                <line x1="34" y1="30" x2="34" y2="34" stroke="#212529" stroke-width="2"/>
                            </svg>
                        </div>
                        <h4 class="text-graphite fw-bold text-uppercase fs-6 m-0 mb-2" style="letter-spacing: 0.5px;">Системы хранения & Гостиные</h4>
                        <p class="text-muted-gray small m-0" style="font-size: 0.8rem; line-height: 1.4;">Модульные шкафы, ТВ-тумбы, подвесные консоли и стеллажи строгой геометрии.</p>
                    </div>
                    <a href="{{ route('catalog') }}" class="text-accent text-uppercase small fw-bold font-monospace text-decoration-none mt-4 d-block" style="font-size: 0.7rem;">Смотреть серию &rarr;</a>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 bg-white border border-subtle-gray h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-3 opacity-75">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="4" y="14" width="32" height="18" stroke="#212529" stroke-width="1.5"/>
                                <rect x="4" y="6" width="6" height="8" stroke="#6C757D" stroke-width="1"/>
                                <rect x="30" y="6" width="6" height="8" stroke="#6C757D" stroke-width="1"/>
                            </svg>
                        </div>
                        <h4 class="text-graphite fw-bold text-uppercase fs-6 m-0 mb-2" style="letter-spacing: 0.5px;">Спальные гарнитуры</h4>
                        <p class="text-muted-gray small m-0" style="font-size: 0.8rem; line-height: 1.4;">Кровать с интегрированными парящими тумбами и скрытые системы гардеробных.</p>
                    </div>
                    <a href="{{ route('catalog') }}" class="text-accent text-uppercase small fw-bold font-monospace text-decoration-none mt-4 d-block" style="font-size: 0.7rem;">Смотреть серию &rarr;</a>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 bg-white border border-subtle-gray h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mb-3 opacity-75">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <rect x="4" y="16" width="32" height="14" stroke="#212529" stroke-width="1.5"/>
                                <rect x="8" y="8" width="24" height="8" stroke="#6C757D" stroke-width="1"/>
                                <line x1="4" y1="30" x2="4" y2="34" stroke="#212529" stroke-width="2"/>
                                <line x1="36" y1="30" x2="36" y2="34" stroke="#212529" stroke-width="2"/>
                            </svg>
                        </div>
                        <h4 class="text-graphite fw-bold text-uppercase fs-6 m-0 mb-2" style="letter-spacing: 0.5px;">Мягкая архитектурная мебель</h4>
                        <p class="text-muted-gray small m-0" style="font-size: 0.8rem; line-height: 1.4;">Низкопосадочные модульные диваны и кресла в износостойкой рогожке премиум-класса.</p>
                    </div>
                    <a href="{{ route('catalog') }}" class="text-accent text-uppercase small fw-bold font-monospace text-decoration-none mt-4 d-block" style="font-size: 0.7rem;">Смотреть серию &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-4 py-md-5 border-bottom border-subtle-gray">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-4 border-bottom border-subtle-gray pb-2">
            <div>
                <span class="text-uppercase text-muted-gray small font-monospace d-block mb-1" style="letter-spacing: 1px;">Выбор архитекторов</span>
                <h2 class="text-graphite fw-bold m-0 text-uppercase fs-4" style="letter-spacing: 1px;">Хиты продаж</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-decoration-none text-muted-gray small fw-bold text-uppercase d-none d-sm-block">Все товары &rarr;</a>
        </div>
        
        <div class="row g-2 g-md-4">
            @forelse($products as $product)
                <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-12">
                    <div class="p-4 border border-subtle-gray text-center bg-light-block font-monospace small text-muted-gray">
                        Каталог продукции временно обновляется. Добавьте товары в панели ИС.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-block d-sm-none mt-3">
            <a href="{{ route('catalog') }}" class="btn btn-flux-outline w-100 d-flex align-items-center justify-content-center text-uppercase fw-bold small rounded-0">Смотреть весь каталог</a>
        </div>
    </div>
</section>

<section class="bg-light-block border-bottom border-subtle-gray py-4 py-md-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-12 col-md-6">
                <span class="text-uppercase text-accent small font-monospace fw-bold d-block mb-1" style="letter-spacing: 1px;">Стандарты экологии</span>
                <h2 class="text-graphite fw-bold text-uppercase fs-4 mb-3" style="letter-spacing: 0.5px;">Материалы конструкционного уровня</h2>
                <p class="text-muted-gray small mb-3" style="line-height: 1.6; font-size: 0.85rem;">
                    Каждое изделие фабрики Fluxcomfort проектируется с расчетом на экстремальные эксплуатационные нагрузки. Мы полностью исключили использование токсичных смол и кромок сомнительного происхождения.
                </p>
                <div class="row g-2 font-monospace text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                    <div class="col-6 text-wrap"><span class="text-graphite fw-bold">// Плиты EGGER (Австрия)</span></div>
                    <div class="col-6 text-wrap"><span class="text-graphite fw-bold">// Системы Blum Move</span></div>
                    <div class="col-6 text-wrap"><span class="text-graphite fw-bold">// ПУР-влагостойкие швы</span></div>
                    <div class="col-6 text-wrap"><span class="text-graphite fw-bold">// Скрытый крепеж полного цикла</span></div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-4 bg-white border border-subtle-gray text-center">
                    <div class="fs-1 fw-bold text-success font-monospace mb-1">E0.5</div>
                    <div class="text-graphite text-uppercase fw-bold small font-monospace mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">Наивысший класс безопасности плит</div>
                    <p class="text-muted-gray small m-0 mx-auto" style="max-width: 340px; font-size: 0.8rem; line-height: 1.4;">Наша мебель сертифицирована для использования в детских комнатах и медицинских учреждениях. Полное отсутствие эмиссии вредных веществ.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="consultation" class="bg-white py-4 py-md-5">
    <div class="container">
        <div class="p-4 bg-light-block border border-subtle-gray">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6">
                    <h3 class="text-graphite fw-bold text-uppercase fs-5 mb-2" style="letter-spacing: 0.5px;">Консультация штатного технолога</h3>
                    <p class="text-muted-gray small m-0" style="font-size: 0.8rem; line-height: 1.5;">
                        Есть готовый дизайн-проект или эскиз? Загрузите его спецификацию или оставьте телефон — наш инженер-технолог свяжется с вами, проверит конструктив на соответствие жестким нагрузкам и составит точную смету.
                    </p>
                </div>
                <div class="col-12 col-lg-6">
                    <form action="#" method="POST" class="row g-2 m-0" onclick="event.preventDefault(); alert('Режим демонстрации: Форма захвата данных валидна.');">
                        <div class="col-12 col-sm-5">
                            <input type="text" class="form-control rounded-0 border-subtle-gray py-2" placeholder="ИМЯ" style="font-size: 0.8rem; height: 44px;" required>
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="tel" class="form-control rounded-0 border-subtle-gray py-2" placeholder="+7 (___) ___-__-__" style="font-size: 0.8rem; height: 44px;" required>
                        </div>
                        <div class="col-12 col-sm-3">
                            <button type="submit" class="btn btn-flux-primary w-100 rounded-0 text-uppercase fw-bold h-100 py-2 py-sm-0" style="font-size: 0.72rem; letter-spacing: 0.5px; min-height: 44px;">Отправить</button>
                        </div>
                    </form>
                    <span class="text-muted-gray d-block mt-2 font-monospace" style="font-size: 0.6rem;">* Нажимая кнопку, вы соглашаетесь с условиями хранения персональных данных.</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
