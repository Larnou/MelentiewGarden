<?php
// Ожидаемая переменная: $activePage (home|catalog|articles|about)
$activePage = $activePage ?? '';
?>

<header class="header">
  <div class="header__container">
    <a class="header__logo" href="/index.php">
      <div class="header__logo-icon">
        <svg width="40" height="40" aria-hidden="true"><use xlink:href="#apple"></use></svg>
      </div>
      <span class="header__title">САЖЕНЦЫ-ИРКУТСК</span>
    </a>

    <button class="header__burger" type="button" aria-label="Меню" aria-controls="site-nav" aria-expanded="false">
      <span></span>
    </button>

    <nav class="header__nav" id="site-nav" aria-label="Главное меню">
      <ul class="header__menu">
        <li class="header__item">
          <a class="header__link <?= $activePage === 'home' ? 'is-active' : '' ?>" href="/index.php#news">Новости</a>
        </li>
        <li class="header__item">
          <a class="header__link <?= $activePage === 'catalog' ? 'is-active' : '' ?>" href="/pages/catalog/index.php">Каталог</a>
        </li>
        <li class="header__item">
          <a class="header__link <?= $activePage === 'articles' ? 'is-active' : '' ?>" href="/pages/articles/index.php">Статьи</a>
        </li>
        <li class="header__item">
          <a class="header__link <?= $activePage === 'history' ? 'is-active' : '' ?>" href="/pages/history.php">О нас</a>
        </li>
      </ul>
    </nav>
  </div>
</header>
