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
                <div class="tag-filter js-tag-filter" data-target=".article-card">
                    <span class="tag-filter__label">Фильтровать по темам</span>
                    <div class="tag-filter__chips">
                        <button class="tag-filter__chip tag-filter__chip--active" type="button" data-tag="all" aria-pressed="true">Все</button>
                        <button class="tag-filter__chip" type="button" data-tag="tag-apple" aria-pressed="false">Яблони</button>
                        <button class="tag-filter__chip" type="button" data-tag="tag-care" aria-pressed="false">Уход за садом</button>
                    </div>
                </div>
                <div class="articles__list articles__list--grid">

                    <a class="article-card" href="/pages/articles/kak-borotsya-s-muravyami.php" data-tags="tag-apple">
                        <img class="article-card__image" src="/assets/img/background.webp" alt="Как бороться с муравьями?">
                        <h2 class="article-card__title">Как бороться с муравьями?</h2>
                        <p class="article-card__meta">Основные принципы формирующей обрезки</p>
                    </a>

                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/assets/js/main.js"></script>
</body>
</html>
