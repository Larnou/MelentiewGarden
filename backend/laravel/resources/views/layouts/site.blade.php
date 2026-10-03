<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/icons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="body">
    <div style="display:none">
        {!! file_get_contents(public_path('assets/img/sprite.svg')) !!}
    </div>

    <header class="header">
        <div class="header__container">
            <a class="header__logo" href="{{ route('home') }}">
                <div class="header__logo-icon">
                    <x-svg name="apple" :width="40" :height="40" />
                </div>
                <span class="header__title">{{ config('site.brand') }}</span>
            </a>

            <button class="header__burger" type="button" aria-label="Меню" aria-controls="site-nav" aria-expanded="false">
                <span></span>
            </button>

            <nav class="header__nav" id="site-nav" aria-label="Главное меню">
                <ul class="header__menu">
                    @foreach (config('site.nav') as $item)
                        <li class="header__item">
                            <a class="header__link" href="{{ $isMain ? $item['main'] : $item['other'] }}">{{ $item['label'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </header>

    <main class="main{{ $mainClass ?? '' }}">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer__container">
            <div class="footer__brand">
                <a class="footer__logo footer__logo--address" href="{{ route('home') }}">
                    <div class="footer__logo-icon">
                        <x-svg name="apple" :width="40" :height="40" />
                    </div>
                    <div class="footer__title">{{ config('site.brand') }}</div>
                </a>
                <p class="footer__address">{{ config('site.address') }}</p>
            </div>

            <div class="footer__contacts">
                <div class="footer__section-title">НАШИ КОНТАКТЫ</div>
                <a class="footer__logo footer__logo--contacts" href="{{ config('site.phone.href') }}" title="{{ config('site.phone.title') }}">
                    <div class="footer__logo-icon">
                        <x-svg name="telephone" :width="40" :height="40" />
                    </div>
                    <span class="footer__title">{{ config('site.phone.label') }}</span>
                </a>
                <a class="footer__logo footer__logo--contacts" href="{{ config('site.email.href') }}" title="{{ config('site.email.title') }}">
                    <div class="footer__logo-icon">
                        <x-svg name="email" :width="40" :height="40" />
                    </div>
                    <span class="footer__title">{{ config('site.email.label') }}</span>
                </a>
            </div>

            <div class="footer__community">
                <div class="footer__section-title">НАШЕ СООБЩЕСТВО</div>
                <a class="footer__logo footer__logo--group" href="{{ config('site.telegram.href') }}" target="_blank" rel="noopener">
                    <div class="footer__logo-icon">
                        <x-svg name="telegram" :width="40" :height="40" />
                    </div>
                    <span class="footer__title">{{ config('site.telegram.label') }}</span>
                </a>
                <a class="footer__logo footer__logo--group" href="{{ config('site.max.href') }}" target="_blank" rel="noopener">
                    <div class="footer__logo-icon">
                        <x-svg name="max" :width="40" :height="40" />
                    </div>
                    <span class="footer__title">{{ config('site.max.label') }}</span>
                </a>
                <a class="footer__logo footer__logo--group" href="{{ config('site.ok.href') }}" target="_blank" rel="noopener">
                    <div class="footer__logo-icon">
                        <x-svg name="ok" :width="40" :height="40" />
                    </div>
                    <span class="footer__title">{{ config('site.ok.label') }}</span>
                </a>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__bottom-container">
                <div class="footer__legal-links">
                    <a class="footer__link" href="{{ route('home') }}">Пользовательское соглашение</a>
                    <span class="footer__divider"></span>
                    <a class="footer__link" href="{{ route('home') }}">Политика конфиденциальности</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
