<?php
$pageTitle = 'Яблоня · Фламинго';
$pageDescription = 'Осенний сорт яблони Фламинго: крупные жёлтые плоды с румянцем, зимостойкость, селекция Т.Ф. Корниенко (Барнаул).';
$activePage = 'catalog';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/../../includes/head.php'; ?>

<body class="body">
    <?php include __DIR__ . '/../../includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main class="main main--article">
<section class="article article--product">
            <div class="article__container"><a class="article__back" href="/pages/catalog.php">← Назад к каталогу</a>
                <h1 class="article__title">Яблоня · Фламинго</h1>
                <div class="article-block article-block--heading-text">
                    <h2 class="article-block__heading">Характеристики</h2>
                </div>
                <div class="article-block article-block--list article-block--list-unordered">
                    <ul class="article-block__list">
                        <li>Плоды крупные, массой 100–120 г, жёлтые с лёгким румянцем, хорошего вкуса. Мякоть плотная, сочная.</li>
                        <li>Хранятся 2–3 месяца.</li>
                        <li>Дерево невысокое, компактное.</li>
                        <li>Сорт урожайный, зимостойкий.</li>
                    </ul>
                </div>
                <div class="article-block article-block--text">
                    <div class="article-block__content">
                        <p>Селекция Т.Ф. Корниенко (Барнаул).</p>
                    </div>
                </div>
                <div class="article-block article-block--slider-captions">
                    <div class="article-block__slider swiper js-article-gallery-captions">
                        <div class="article-block__slider-wrapper swiper-wrapper">
                            <div class="article-block__slide swiper-slide"><img src="/assets/img/pages/catalog/flamingo/fl-1.jpg" alt="">
                                <p class="article-block__slide-caption">Внешний вид яблок</p>
                            </div>
                            <div class="article-block__slide swiper-slide"><img src="/assets/img/pages/catalog/flamingo/fl-2.jpg" alt="Вид на сад">
                                <p class="article-block__slide-caption">Размер яблок</p>
                            </div>
                            <div class="article-block__slide swiper-slide"><img src="/assets/img/pages/catalog/flamingo/fl-3.jpg" alt="Плоды">
                                <p class="article-block__slide-caption">Вес яблок</p>
                            </div>
                        </div>
                    </div>
                    <div class="article-block__slider-controls"><button class="article-block__arrow article-block__arrow--prev" type="button" aria-label="Назад"><span>◀</span></button><button class="article-block__arrow article-block__arrow--next" type="button" aria-label="Вперёд"><span>▶</span></button></div>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>

</html>
