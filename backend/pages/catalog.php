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
                    </a></div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
