<?php
$pageTitle = 'Статьи сада Мелентьевых';
$pageDescription = 'Подборка статей о посадке, уходе и подготовке сада к зиме';
$activePage = 'articles';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/../includes/head.php'; ?>

<body class="body">
    <?php include __DIR__ . '/../includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <main class="main main--article">
        <section class="articles articles--page">
            <div class="articles__container">
                <div class="articles__header">
                    <h1 class="articles__title">Все статьи</h1>
                    <p class="articles__subtitle">Собрали материалы о посадке, уходе и подготовке сада к нашим сибирским условиям.</p>
                </div>
                <div class="tag-filter js-tag-filter" data-target=".article-card"><span class="tag-filter__label">Фильтровать по темам</span>
                    <div class="tag-filter__chips"><button class="tag-filter__chip tag-filter__chip--active" type="button" data-tag="all" aria-pressed="true">Все</button><button class="tag-filter__chip" type="button" data-tag="apple" aria-pressed="false">Яблони</button><button class="tag-filter__chip" type="button" data-tag="care" aria-pressed="false">Уход за садом</button></div>
                </div>
                <div class="articles__list articles__list--grid">
                    <a class="article-card" href="/pages/articles/pravila-posadki-sadovoy-zemlyaniki.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/pravila-posadki-sadovoy-zemlyaniki/sajenci.png" alt="Правила посадки садовой земляники">
                        <h2 class="article-card__title">Правила посадки садовой земляники</h2>
                        <p class="article-card__meta">Грядка, схема посадки, мульча и укрытие на зиму</p>
                    </a><a class="article-card" href="/pages/articles/zonirovanie.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/zonirovanie/zones.png" alt="Микроклиматическое зонирование сада">
                        <h2 class="article-card__title">Зонирование</h2>
                        <p class="article-card__meta">Пять микроклиматических зон по Еремеевой Т.В. для выбора сортов и агротехники</p>
                    </a><a class="article-card" href="/pages/articles/opylenie.php" data-tags="apple"><img class="article-card__image" src="/assets/img/pages/articles/opylenie/opilenie.png" alt="Опыление яблони и груши">
                        <h2 class="article-card__title">Опыление</h2>
                        <p class="article-card__meta">Два сорта рядом, перекрёстное опыление и роль ветра с насекомыми</p>
                    </a><a class="article-card" href="/pages/articles/sakura.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/sakura/sakura.jpg" alt="Розовое весеннее цветение в саду">
                        <h2 class="article-card__title">Сакура</h2>
                        <p class="article-card__meta">Махровый миндаль трёхлопастный вместо вишни и сливы, зимовка и обрезка</p>
                    </a><a class="article-card" href="/pages/articles/belit-stvoly-derevev.php" data-tags="apple care"><img class="article-card__image" src="/assets/img/pages/articles/belit-stvoly-derevev/stvol.png" alt="Стволы яблонь: побелка и уход">
                        <h2 class="article-card__title">Белить стволы деревьев</h2>
                        <p class="article-card__meta">Почему нельзя белить молодые яблони осенью и как осматривать стволы весной</p>
                    </a><a class="article-card" href="/pages/articles/posadka-sazhencev.php" data-tags="apple care"><img class="article-card__image" src="/assets/img/pages/articles/posadka-sazhencev/posadka.jpg" alt="Посадка саженца плодового дерева">
                        <h2 class="article-card__title">Посадка саженцев</h2>
                        <p class="article-card__meta">Закрытая корневая система, яма, холмик в Сибири, колышки и мульча</p>
                    </a><a class="article-card" href="/pages/articles/podgotovka-maliny-k-zime.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/podgotovka-maliny-k-zime/podgotovka.jpg" alt="Малина: подготовка к зиме">
                        <h2 class="article-card__title">Подготовка малины к зиме</h2>
                        <p class="article-card__meta">Пригибание крупноплодных сортов, укрытие без картона и сорт «Жёлтый гигант»</p>
                    </a><a class="article-card" href="/pages/articles/sosedi.php" data-tags="care"><img class="article-card__image" src="/assets/img/pages/articles/sosedi/sosedi.jpg" alt="Совместимые кустарники в саду">
                        <h2 class="article-card__title">Соседи</h2>
                        <p class="article-card__meta">Жимолость, крыжовник и смородина рядом; яблоня, груша и малина — плохие соседи</p>
                    </a></div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
