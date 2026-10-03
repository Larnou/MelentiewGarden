@extends('layouts.site')

@section('content')
    <section class="hero">
        <div class="hero__overlay"></div>
        <div class="hero__container">
            <div class="hero__content">
                <h1 class="hero__title">Сад Мелентьевых</h1>
                <p class="hero__subtitle">
                    Мы выращиваем только проверенные урожайные сорта
                    <br>
                    адаптированные к сибирским морозам
                </p>

                <div class="hero__slider swiper js-hero-categories">
                    <div class="hero__slider-container swiper-wrapper">
                        <a class="hero__slider-slide swiper-slide" href="{{ route('catalog.index', ['tag' => 'seed']) }}">Семечковые</a>
                        <a class="hero__slider-slide swiper-slide" href="{{ route('catalog.index', ['tag' => 'stone']) }}">Косточковые</a>
                        <a class="hero__slider-slide swiper-slide" href="{{ route('catalog.index', ['tag' => 'berry']) }}">Ягодные</a>
                        <a class="hero__slider-slide swiper-slide" href="{{ route('catalog.index', ['tag' => 'decor']) }}">Декоративные</a>
                        <a class="hero__slider-slide swiper-slide" href="{{ route('catalog.index', ['tag' => 'indoor']) }}">Комнатные</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="fair" id="news">
        <div class="fair__container">
            <div class="fair__label">Ярмарки саженцев</div>
            <div class="fair__card">
                <div class="fair__image-wrapper">
                    <img class="fair__image" src="{{ asset('assets/img/pages/exposition_banner.jpg') }}" alt="Фотографии ярмарок">
                </div>
                <div class="fair__slider swiper js-fair-slider">
                    <div class="fair__list swiper-wrapper">
                        <div class="fair__content swiper-slide">
                            <h3 class="fair__title">Музей-усадьба В.П. Сукачева</h3>
                            <p class="fair__date">Май, сентябрь</p>
                            <p class="fair__description">ул. Декабрьских Событий 112, около танка</p>
                        </div>
                        <div class="fair__content swiper-slide">
                            <h3 class="fair__title">Остановка Волжская</h3>
                            <p class="fair__date">Май, август, сентябрь</p>
                            <p class="fair__description">ул. Волжская 14Б, рядом с рынком "Волжский"</p>
                        </div>
                        <div class="fair__content swiper-slide">
                            <h3 class="fair__title">СибЭкспоЦентр</h3>
                            <p class="fair__date">20 - 22 августа, с 10:00 до 17:00</p>
                            <p class="fair__description">ул. Байкальская 253А, около 3-го павильона</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="seedlings" id="catalog">
        <div class="seedlings__container">
            <div class="seedlings__header">
                <h2 class="seedlings__title">Саженцы</h2>
            </div>
            <div class="seedlings__slider swiper js-seedlings-slider">
                <div class="seedlings__list swiper-wrapper">
                    @foreach ($seedlings as $seedling)
                        <a class="seedlings-card swiper-slide" href="{{ route('catalog.show', $seedling->slug) }}">
                            <img class="seedlings-card__image" src="{{ asset('storage/'.$seedling->cover_path) }}" alt="{{ $seedling->cover_alt }}">
                            <h3 class="seedlings-card__title">{{ $seedling->home_title }}</h3>
                            <p class="seedlings-card__subtitle">{{ $seedling->home_subtitle }}</p>
                            <p class="seedlings-card__price">{{ $seedling->price }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="seedlings__controls">
                <button class="seedlings__arrow seedlings__arrow--prev" type="button" aria-label="Предыдущие саженцы"><span>◀</span></button>
                <a class="seedlings__more-button" href="{{ route('catalog.index') }}">Посмотреть больше</a>
                <button class="seedlings__arrow seedlings__arrow--next" type="button" aria-label="Следующие саженцы"><span>▶</span></button>
            </div>
        </div>
    </section>

    <section class="articles" id="articles">
        <div class="articles__container">
            <div class="articles__header">
                <h2 class="articles__title">Статьи</h2>
            </div>
            <div class="articles__slider swiper js-articles-slider">
                <div class="articles__list swiper-wrapper">
                    @foreach ($articles as $article)
                        <a class="article-card swiper-slide" href="{{ route('articles.show', $article->slug) }}" data-tags="{{ implode(' ', $article->tags ?? []) }}">
                            <img class="article-card__image" src="{{ asset('storage/'.$article->cover_path) }}" alt="{{ $article->cover_alt }}">
                            <h3 class="article-card__title">{{ $article->title }}</h3>
                            <p class="article-card__meta">{{ $article->meta }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="articles__controls">
                <button class="articles__arrow articles__arrow--prev" type="button" aria-label="Предыдущие статьи"><span>◀</span></button>
                <a class="articles__more-button" href="{{ route('articles.index') }}">Посмотреть больше</a>
                <button class="articles__arrow articles__arrow--next" type="button" aria-label="Следующие статьи"><span>▶</span></button>
            </div>
        </div>
    </section>

    <section class="advantages">
        <div class="advantages__container">
            <div class="advantages__header">
                <h2 class="advantages__title">Наши преимущества</h2>
                <p class="advantages__subtitle">Почему саженцы из нашего сада надёжнее рынка</p>
            </div>
            <div class="advantages__list">
                <div class="advantages__item">
                    <div class="advantages__icon"><span>1</span></div>
                    <div class="advantages__content">
                        <h3 class="advantages__item-title">Выращиваем в своём саду</h3>
                        <p class="advantages__item-text">Саженцы растут в тех же условиях, в которых будут жить у вас: один и тот же климат, те же ветра и зимы.</p>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon"><span>2</span></div>
                    <div class="advantages__content">
                        <h3 class="advantages__item-title">Проверенные зимостойкие сорта</h3>
                        <p class="advantages__item-text">Оставляем только сорта, которые пережили не одну зиму и показали стабильные урожаи.</p>
                    </div>
                </div>
                <div class="advantages__item">
                    <div class="advantages__icon"><span>3</span></div>
                    <div class="advantages__content">
                        <h3 class="advantages__item-title">Помогаем подобрать саженцы под участок</h3>
                        <p class="advantages__item-text">Подскажем, какие яблони, груши и другие культуры лучше подойдут под ваши условия и опыт.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="history" id="history">
        <div class="history__container">
            <h2 class="history__title">История нашего сада</h2>
            <div class="history__content">
                <div class="history__image-wrapper">
                    <img class="history__image" src="{{ asset('assets/img/pages/Lyudmila_Mikhailovna.jpg') }}" alt="Людмила Михайловна в саду">
                </div>
                <div class="history__text">
                    <p class="history__paragraph">История сада началась много лет назад. Его основательница Мелентьева Людмила Михайловна по образованию была физиком-электронщиком и работала в конструкторском бюро радиосвязи. Именно там произошло знакомство с Геннадием Тимофеевичем Рыковым — участником клуба садоводов-опытников им. А.К. Томсона, который познакомил её с искусством прививки яблонь и груш и передал черенки первых сортов.</p>
                    <p class="history__paragraph">Когда были выделены участки в Мельничной пади, появились первые деревья. Одной из первых стала яблоня «Аленушка» — зимостойкий сорт красноярской селекции. С этого момента началось формирование сада.</p>
                    <p class="history__paragraph">Более 20 лет основательница участвовала в работе клуба садоводов им. А.К. Томсона, где проводились наблюдения за различными сортами яблонь и груш, изучались их урожайность, вкусовые качества и зимостойкость.</p>
                    <p class="history__paragraph">Сегодня сад расположен недалеко от Первомайского в Иркутске. На участке растет более 100 яблонь и груш. Основу коллекции составляют сорта алтайского селекционера Тамары Федоровны Корниенко.</p>
                    <p class="history__paragraph">Деревья прививаются на местные подвои, благодаря чему они хорошо переносят сибирский климат, отличаются долговечностью и стабильным плодоношением.</p>
                    <p class="history__paragraph">Сегодня дело основательницы продолжается — сад живёт и развивается, сохраняя лучшие сорта яблонь и груш, проверенные многолетним опытом.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
