<?php
$pageTitle = 'Опыление';
$pageDescription = 'Зачем сажать два сорта яблони или груши рядом: перекрёстное опыление, роль ветра и насекомых, урожайность.';
$activePage = 'articles';
?>

<!DOCTYPE html>
<html lang="ru">
<?php include __DIR__ . '/../../includes/head.php'; ?>

<body class="body">
    <?php include __DIR__ . '/../../includes/svg-sprite.php'; ?>
    <?php include __DIR__ . '/../../includes/header.php'; ?>

    <main class="main main--article">
<section class="article">
            <div class="article__container"><a class="article__back" href="/pages/articles.php">← Назад к статьям</a>
                <h1 class="article__title">Опыление</h1>
                <p class="article__meta">Два сорта рядом — лучше урожай у яблони, груши и других плодовых</p>
                <div class="article-block article-block--text">
                    <div class="article-block__content">
                        <p>Для хорошего урожая груши, яблони и других плодовых рекомендуется сажать два разных сорта
                            рядом друг с другом. Большинство сортов не самоплодные или только частично самоплодные,
                            поэтому перекрёстное опыление между разными сортами значительно увеличивает урожайность.</p>
                        <p>Растения опыляются ветром и насекомыми. Если рядом нет другого сорта, то опыление может
                            быть недостаточным.</p>
                    </div>
                </div>
                <div class="article-block article-block--slider-captions">
                    <div class="article-block__slider swiper js-article-gallery-captions">
                        <div class="article-block__slider-wrapper swiper-wrapper">
                            <div class="article-block__slide swiper-slide"><img src="/assets/img/pages/articles/opylenie/opilenie.png" alt="Как происходит опыление">
                                <p class="article-block__slide-caption">Как происходит опыление</p>
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
