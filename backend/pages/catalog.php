<?php
$pageTitle = 'Каталог саженцев';
$pageDescription = 'Полный список саженцев сада Мелентьевых';
$activePage = 'catalog';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/../includes/head.php'; ?>

<body class="body">
    <?php include __DIR__ . '/../includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="main main--article">
        <section class="seedlings seedlings--page">
            <div class="seedlings__container">
                <div class="seedlings__header">
                    <h1 class="seedlings__title">Каталог саженцев</h1>
                </div>
                <div class="tag-filter js-tag-filter" data-target=".seedlings-card"><span class="tag-filter__label">Фильтровать по типам</span>
                    <div class="tag-filter__chips"><button class="tag-filter__chip tag-filter__chip--active" type="button" data-tag="all" aria-pressed="true">Все</button><button class="tag-filter__chip" type="button" data-tag="seed" aria-pressed="false">Семечковые</button><button class="tag-filter__chip" type="button" data-tag="stone" aria-pressed="false">Косточковые</button><button class="tag-filter__chip" type="button" data-tag="berry" aria-pressed="false">Ягодные</button><button class="tag-filter__chip" type="button" data-tag="decor" aria-pressed="false">Декоративные</button><button class="tag-filter__chip" type="button" data-tag="indoor" aria-pressed="false">Комнатные</button></div>
                </div>
                <div class="seedlings__list seedlings__list--grid"><a class="seedlings-card" href="/pages/catalog/flamingo.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/flamingo/fl-1.jpg" alt="Яблоня сорт Фламинго">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Фламинго</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/podarok-sadovodam.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/podarok-sadovodam/ps-1.jpg" alt="Яблоня сорт Подарок садоводам">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Подарок садоводам</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/altayskoye-nalivnoye.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/altayskoye-nalivnoye/an-2.jpg" alt="Яблоня сорт Алтайское наливное">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Алтайское наливное</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/barnaulskoe-rumyanoe.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/barnaulskoe-rumyanoe/br1.jpg" alt="Яблоня сорт Барнаульское румяное">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Барнаульское румяное</h2>
                        <p class="seedlings-card__subtitle">Поздне-летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/sinapchik.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/sinapchik/s4.jpg" alt="Яблоня сорт Синапчик">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Синапчик</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/altayskoye-rumyanoe.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/altayskoye-rumyanoe/ar2.jpg" alt="Яблоня сорт Алтайское румяное">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Алтайское румяное</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/amurskoe-krasnoe.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/amurskoe-krasnoe/ak1.jpg" alt="Яблоня сорт Амурское красное">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Амурское красное</h2>
                        <p class="seedlings-card__subtitle">Ранне-осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/yunga.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/yunga/u2.jpg" alt="Яблоня сорт Юнга">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Юнга</h2>
                        <p class="seedlings-card__subtitle">Поздне-летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/sharik.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/sharik/s3.jpg" alt="Яблоня сорт Шарик">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Шарик</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/nomernaya-80-60.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/nomernaya-80-60/n81.jpg" alt="Яблоня сорт Номерная 80-60">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Номерная 80-60</h2>
                        <p class="seedlings-card__subtitle">Зимний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/krasnaya-gorka.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/krasnaya-gorka/kg1.jpg" alt="Яблоня сорт Красная горка">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Красная горка</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/mana.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/mana/m1.jpg" alt="Яблоня сорт Мана">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Мана</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/alenushka.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/alenushka/al2.jpg" alt="Яблоня сорт Алёнушка">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Алёнушка</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/sonechka.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/sonechka/s1.jpg" alt="Яблоня сорт Сонечка (155-7-6)">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Сонечка</h2>
                        <p class="seedlings-card__subtitle">155-7-6 · летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/alpek.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/alpek/al1.jpg" alt="Яблоня сорт Алпек">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Алпек</h2>
                        <p class="seedlings-card__subtitle">Ранне-осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/zhebrovskoe.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/zhebrovskoe/zh1.jpg" alt="Яблоня сорт Жебровское">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Жебровское</h2>
                        <p class="seedlings-card__subtitle">Ранне-осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/osennaya-radost-altaya.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/osennaya-radost-altaya/aro1.jpg" alt="Яблоня сорт Осенняя радость Алтая">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Осенняя радость Алтая</h2>
                        <p class="seedlings-card__subtitle">Ранне-осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/krasnoyarskoe-sladkoe.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/krasnoyarskoe-sladkoe/ks1.jpg" alt="Яблоня сорт Красноярское сладкое">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Красноярское сладкое</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/lada.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/lada/la1.jpg" alt="Яблоня сорт Лада">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Лада</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/domestik-alba.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/domestik-alba/da1.jpg" alt="Яблоня сорт Доместик Альба">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Доместик Альба</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт · полукультурка</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/uralskoye-nalivnoye.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/uralskoye-nalivnoye/un1.jpg" alt="Яблоня сорт Уральское наливное">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Уральское наливное</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/podruga.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/podruga/po1.jpg" alt="Яблоня сорт Подруга">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Подруга</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/ermolaeva-23.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/ermolaeva-23/er1.jpg" alt="Яблоня сорт Ермолаева-23">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Ермолаева-23</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/podarok-bamu.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/podarok-bamu/pb1.jpg" alt="Яблоня сорт Подарок БАМу">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Подарок БАМу</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/manaraga.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/manaraga/mg2.jpg" alt="Яблоня сорт Манарага">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Манарага</h2>
                        <p class="seedlings-card__subtitle">Зимний сорт · колоновидная</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/makovetskogo.php" data-tags="decor seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/makovetskogo/mk1.jpg" alt="Яблоня сорт Маковецкого">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Маковецкого</h2>
                        <p class="seedlings-card__subtitle">Декоративный сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/ola.php" data-tags="decor seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/ola/ol1.jpg" alt="Яблоня сорт Ола">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Ола</h2>
                        <p class="seedlings-card__subtitle">Декоративный сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/malinovka.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/malinovka/ml1.jpg" alt="Яблоня сорт Малиновка">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Малиновка</h2>
                        <p class="seedlings-card__subtitle">Осенний сорт · стланец</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/belyy-naliv.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/belyy-naliv/bn1.jpg" alt="Яблоня сорт Белый налив">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Белый налив</h2>
                        <p class="seedlings-card__subtitle">Ранне-осенний сорт · стланец</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/sverdlovchanin.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/sverdlovchanin/sv1.jpg" alt="Яблоня сорт Свердловчанин">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Свердловчанин</h2>
                        <p class="seedlings-card__subtitle">Зимний сорт · стланец</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/visyashchego.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/visyashchego/vi1.jpg" alt="Яблоня сорт Висящего">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Висящего</h2>
                        <p class="seedlings-card__subtitle">Зимний сорт · стланец</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a><a class="seedlings-card" href="/pages/catalog/melba.php" data-tags="seed"><img class="seedlings-card__image" src="/assets/img/pages/catalog/melba/mb1.jpg" alt="Яблоня сорт Мельба (Мелба)">
                        <h2 class="seedlings-card__title">ЯБЛОНЯ · Мельба</h2>
                        <p class="seedlings-card__subtitle">Летний сорт</p>
                        <p class="seedlings-card__price">от 800 ₽</p>
                    </a></div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
