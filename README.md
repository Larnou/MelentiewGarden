# Работа с Картами

### [Просмотр верстки](https://larnou.github.io/MelentiewGarden/#)

## Тестирование на фронтенде
Тестирование происходит автоматически при попытке коммита \
[JS Style Guide](https://github.com/airbnb/javascript) \
[CSS Order Style Guide](https://codeguide.co/#css-declaration-order)

* Запуск тестирование вручную - `npm test`

## Основные команды для работы на фронтенде
* Установка - `npm i`
* Запуск локального сервера - `npm start`
* Сборка проекта без запуска локального сервера - `npm run build`

### HTML, JS, стили, изображения
- JS проходит через компилятор Babel и должен быть написан на ES6 и модульной структуре
- Все зависимости и плагины должны интегрироваться через npm. Стили плагина должны импортироваться в `sass/style.scss`
- Препроцессор HTML: [Pug](https://pugjs.org/api/getting-started.html)
- Препроцессор CSS: [SASS](https://sass-lang.com/)

### Фавиконки
* Генерация и вставка фавиконок в разметку - `npm run favicons`

Нарезаемая иконка должна быть минимум 70px*70px, в png. Фавиконки также вставляются в разметку во время сборки

### Картинки
* Оптимизация png и jpg - `npm run imagemin`
