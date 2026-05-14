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
            <section class="hero" style="--hero-bg: url('/assets/img/pages/example/background.webp')">
                <div class="hero__overlay"></div>
                <div class="hero__container">
                    <div class="hero__content">
                        <h2 class="hero__title">Сад Мелентьевых</h2>
                        <p class="hero__subtitle">Мы выращиваем только проверенные урожайные сорта<br>адаптированные к сибирским морозам</p>
                        <div class="hero__slider swiper js-hero-categories">
                            <div class="hero__slider-container swiper-wrapper"><a class="hero__slider-slide swiper-slide" href="/pages/catalog.php?tag=seedling-seed">Семечковые</a><a class="hero__slider-slide swiper-slide" href="/pages/catalog.php?tag=seedling-stone">Косточковые</a><a class="hero__slider-slide swiper-slide" href="/pages/catalog.php?tag=seedling-berry">Ягодные</a><a class="hero__slider-slide swiper-slide" href="/pages/catalog.php?tag=seedling-decor">Декоративные</a><a class="hero__slider-slide swiper-slide" href="/pages/catalog.php?tag=seedling-indoor">Комнатные</a></div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="fair" id="news">
                <div class="fair__container">
                    <div class="fair__label">Ярмарки саженцев</div>
                    <div class="fair__card">
                        <div class="fair__image-wrapper"><img class="fair__image" src="/assets/img/pages/exposition_banner.jpg" alt="Фотографии ярмарок"></div>
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
                        <div class="seedlings__list swiper-wrapper"><a class="seedlings-card swiper-slide" href="/pages/catalog/flamingo.php"><img class="seedlings-card__image" src="/assets/img/pages/catalog/flamingo/fl-1.jpg" alt="Яблоня сорт Фламинго">
                                <h3 class="seedlings-card__title">ЯБЛОНЯ</h3>
                                <p class="seedlings-card__subtitle">Фламинго · осенний сорт</p>
                                <p class="seedlings-card__price">от 800 ₽</p>
                            </a><a class="seedlings-card swiper-slide" href="/pages/catalog/podarok-sadovodam.php"><img class="seedlings-card__image" src="/assets/img/pages/catalog/podarok-sadovodam/ps-1.jpg" alt="Яблоня сорт Подарок садоводам">
                                <h3 class="seedlings-card__title">ЯБЛОНЯ</h3>
                                <p class="seedlings-card__subtitle">Подарок садоводам · осенний сорт</p>
                                <p class="seedlings-card__price">от 800 ₽</p>
                            </a></div>
                    </div>
                    <div class="seedlings__controls"><button class="seedlings__arrow seedlings__arrow--prev" type="button" aria-label="Предыдущие саженцы"><span>◀</span></button><a class="seedlings__more-button" href="/pages/catalog.php">Посмотреть больше</a><button class="seedlings__arrow seedlings__arrow--next" type="button" aria-label="Следующие саженцы"><span>▶</span></button></div>
                </div>
            </section>
            <section class="articles" id="articles">
                <div class="articles__container">
                    <div class="articles__header">
                        <h2 class="articles__title">Статьи</h2>
                    </div>
                    <div class="articles__slider swiper js-articles-slider">
                        <div class="articles__list swiper-wrapper">
                            <a class="article-card swiper-slide" href="/pages/articles/pravila-posadki-sadovoy-zemlyaniki.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/pravila-posadki-sadovoy-zemlyaniki/sajenci.png" alt="Правила посадки садовой земляники">
                                <h3 class="article-card__title">Правила посадки садовой земляники</h3>
                                <p class="article-card__meta">Грядка, схема посадки, мульча и укрытие на зиму</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/zonirovanie.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/zonirovanie/zones.png" alt="Микроклиматическое зонирование сада">
                                <h3 class="article-card__title">Зонирование</h3>
                                <p class="article-card__meta">Пять микроклиматических зон по Еремеевой Т.В. для выбора сортов и агротехники</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/opylenie.php" data-tags="apple"><img class="article-card__image" src="/assets/img/pages/articles/opylenie/opilenie.png" alt="Опыление яблони и груши">
                                <h3 class="article-card__title">Опыление</h3>
                                <p class="article-card__meta">Два сорта рядом, перекрёстное опыление и роль ветра с насекомыми</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/sakura.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/sakura/sakura.jpg" alt="Розовое весеннее цветение в саду">
                                <h3 class="article-card__title">Сакура</h3>
                                <p class="article-card__meta">Махровый миндаль трёхлопастный вместо вишни и сливы, зимовка и обрезка</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/belit-stvoly-derevev.php" data-tags="apple care"><img class="article-card__image" src="/assets/img/pages/articles/belit-stvoly-derevev/stvol.png" alt="Стволы яблонь: побелка и уход">
                                <h3 class="article-card__title">Белить стволы деревьев</h3>
                                <p class="article-card__meta">Почему нельзя белить молодые яблони осенью и как осматривать стволы весной</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/posadka-sazhencev.php" data-tags="apple care"><img class="article-card__image" src="/assets/img/pages/articles/posadka-sazhencev/posadka.jpg" alt="Посадка саженца плодового дерева">
                                <h3 class="article-card__title">Посадка саженцев</h3>
                                <p class="article-card__meta">Закрытая корневая система, яма, холмик в Сибири, колышки и мульча</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/podgotovka-maliny-k-zime.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/podgotovka-maliny-k-zime/podgotovka.jpg" alt="Малина: подготовка к зиме">
                                <h3 class="article-card__title">Подготовка малины к зиме</h3>
                                <p class="article-card__meta">Пригибание крупноплодных сортов, укрытие без картона и сорт «Жёлтый гигант»</p>
                            </a><a class="article-card swiper-slide" href="/pages/articles/sosedi.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/sosedi/sosedi.jpg" alt="Совместимые кустарники в саду">
                                <h3 class="article-card__title">Соседи</h3>
                                <p class="article-card__meta">Жимолость, крыжовник и смородина рядом; яблоня, груша и малина — плохие соседи</p>
                            </a></div>
                    </div>
                    <div class="articles__controls"><button class="articles__arrow articles__arrow--prev" type="button" aria-label="Предыдущие статьи"><span>◀</span></button><a class="articles__more-button" href="/pages/articles.php">Посмотреть больше</a><button class="articles__arrow articles__arrow--next" type="button" aria-label="Следующие статьи"><span>▶</span></button></div>
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
                                <p class="advantages__item-text">Саженцы растут в тех же условиях, в которых будут жить у вас:
                                    один и тот же климат, те же ветра и зимы.</p>
                            </div>
                        </div>
                        <div class="advantages__item">
                            <div class="advantages__icon"><span>2</span></div>
                            <div class="advantages__content">
                                <h3 class="advantages__item-title">Проверенные зимостойкие сорта</h3>
                                <p class="advantages__item-text">Оставляем только сорта, которые пережили не одну зиму и
                                    показали стабильные урожаи.</p>
                            </div>
                        </div>
                        <div class="advantages__item">
                            <div class="advantages__icon"><span>3</span></div>
                            <div class="advantages__content">
                                <h3 class="advantages__item-title">Помогаем подобрать саженцы под участок</h3>
                                <p class="advantages__item-text">Подскажем, какие яблони, груши и другие культуры лучше подойдут
                                    под ваши условия и опыт.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="history" id="history">
                <div class="history__container">
                    <h2 class="history__title">История нашего сада</h2>
                    <div class="history__content">
                        <div class="history__image-wrapper"><img class="history__image" src="/assets/img/pages/Lyudmila_Mikhailovna.jpg" alt="Людмила Михайловна в саду"></div>
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
