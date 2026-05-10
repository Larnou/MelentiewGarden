<?php
$pageTitle = 'Сад Мелентьевых';
$pageDescription = 'Мы выращиваем только проверенные урожайные сорта, адаптированные к сибирским морозам.';
$activePage = 'home';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/includes/head.php'; ?>
<body class="body">
    <?php include __DIR__ . '/includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="main">
        <section class="hero" style="--hero-bg: url('img/background.webp')">
            <div class="hero__overlay"></div>
            <div class="hero__container">
                <div class="hero__content">
                    <h2 class="hero__title">Сад Мелентьевых</h2>
                    <p class="hero__subtitle">Мы выращиваем только проверенные урожайные сорта<br>адаптированные к сибирским морозам</p>
                    <div class="hero__slider swiper js-hero-categories">
                        <div class="hero__slider-container swiper-wrapper">
                            <a class="hero__slider-slide swiper-slide" href="catalog.html?tag=seedling-seed">Семечковые</a>
                            <a class="hero__slider-slide swiper-slide" href="catalog.html?tag=seedling-stone">Косточковые</a>
                            <a class="hero__slider-slide swiper-slide" href="catalog.html?tag=seedling-berry">Ягодные</a>
                            <a class="hero__slider-slide swiper-slide" href="catalog.html?tag=seedling-decor">Декоративные</a>
                            <a class="hero__slider-slide swiper-slide" href="catalog.html?tag=seedling-indoor">Комнатные</a>
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
                        <img class="fair__image" src="assets/img/pages/news_banner.jpg" alt="Фотографии ярмарок">
                    </div>
                    <div class="fair__slider swiper js-fair-slider">
                        <div class="fair__list swiper-wrapper">
                            <div class="fair__content swiper-slide">
                                <h3 class="fair__title">Музей-усадьба В.П. Сукачева</h3>
                                <p class="fair__date">Дата и время уточняются</p>
                                <p class="fair__description">ул. Декабрьских Событий 112, около танка</p>
                            </div>
                            <div class="fair__content swiper-slide">
                                <h3 class="fair__title">Остановка Волжская</h3>
                                <p class="fair__date">Дата и время уточняются</p>
                                <p class="fair__description">ул. Волжская 14Б, рядом с рынком "Волжский"</p>
                            </div>
                            <div class="fair__content swiper-slide">
                                <h3 class="fair__title">СибЭкспоЦентр</h3>
                                <p class="fair__date">21–23 августа · 10:00–18:00</p>
                                <p class="fair__description">ул. Байкальская 253А, около 3-го павильона</p>
                            </div>
                        </div>
                    </div>
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

                        <a class="article-card swiper-slide" href="/pages/articles/kak-borotsya-s-muravyami.php" data-tags="tag-apple">
                            <img class="article-card__image" src="/assets/img/background.webp" alt="Как бороться с муравьями?">
                            <h3 class="article-card__title">Как бороться с муравьями?</h3>
                            <p class="article-card__meta">Основные принципы формирующей обрезки</p>
                        </a>

                    </div>
                </div>
                <div class="articles__controls">
                    <button class="articles__arrow articles__arrow--prev" type="button" aria-label="Предыдущие статьи">
                        <span>◀</span>
                    </button>
                    <a class="articles__more-button" href="/pages/articles.php">Посмотреть больше</a>
                    <button class="articles__arrow articles__arrow--next" type="button" aria-label="Следующие статьи">
                        <span>▶</span>
                    </button>
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
                        <div class="advantages__icon">
                            <span>1</span>
                        </div>
                        <div class="advantages__content">
                            <h3 class="advantages__item-title">Выращиваем в своём саду</h3>
                            <p class="advantages__item-text">
                                Саженцы растут в тех же условиях, в которых будут жить у вас: один и тот же климат, те же ветра и зимы.
                            </p>
                        </div>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages__icon">
                            <span>2</span>
                        </div>
                        <div class="advantages__content">
                            <h3 class="advantages__item-title">Проверенные зимостойкие сорта</h3>
                            <p class="advantages__item-text">
                                Оставляем только сорта, которые пережили не одну зиму и показали стабильные урожаи.
                            </p>
                        </div>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages__icon">
                            <span>3</span>
                        </div>
                        <div class="advantages__content">
                            <h3 class="advantages__item-title">Помогаем подобрать саженцы под участок</h3>
                            <p class="advantages__item-text">
                                Подскажем, какие яблони, груши и другие культуры лучше подойдут под ваши условия и опыт.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="history" id="about">
            <div class="history__container">
                <h2 class="history__title">История нашего сада</h2>
                <div class="history__content">
                    <div class="history__image-wrapper"><img class="history__image" src="assets/img/pages/history/about.jpg" alt="Людмила Михайловна в саду"></div>
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
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
