/**
 * Класс <tt>YandexMap<tt> используется для генерации Яндекс.Карты и её взаимодействия с фильтром
 */
// eslint-disable-next-line import/prefer-default-export
export class YandexMap {
  constructor(id, data) {
    this.yandexMap = this.createMap(id);
    this.data = data;
    this.markers = this.createMarkers();
    this.claster = this.createCluster();
  }

  /**
   * Метод <tt>createMap()<tt> создаёт карту с базовыми параметрами
   * @param id контейнера, в котором будет создана карта
   * @returns {*} объект ymaps.Map с базовыми параметрами
   */
  // eslint-disable-next-line class-methods-use-this
  createMap(id) {
    const options = {
      center: [52.288770783011806, 104.26826330351393],
      zoom: 14.5,
      controls: ['zoomControl'],
    };

    return new ymaps.Map(id, options);
  }

  /**
   * Метод <tt>createCluster()<tt> создаёт кластер с заданными маркерами
   * @returns {ymaps.Clusterer} объект ymaps.Clusterer
   */
  // eslint-disable-next-line class-methods-use-this
  createCluster() {
    const clusterer = new ymaps.Clusterer({
      clusterIconLayout: 'default#pieChart',
      clusterIconPieChartRadius: 25,
      clusterIconPieChartCoreRadius: 10,
      clusterIconPieChartStrokeWidth: 3,
      hasBalloon: false,
      clusterDisableClickZoom: true,
    });
    const myGeoObjects = this.markers;
    clusterer.add(myGeoObjects);

    return clusterer;
  }

  /**
   * Метод <tt>setCustomBalloonTemplate()<tt> задаёт кастомный шаблон сообщения, появляющегося при клике на маркер
   * @param key ключ, по которому выбирается конкретный шаблон
   * @returns {*} шаблон для отображения balloon
   */
  // eslint-disable-next-line class-methods-use-this
  setCustomBalloonTemplate(key) {
    const balloonContents = {
      frontend: '<div class="balloon">'
        + '<h1 class="balloon__title">Фронтенд</h1>'
        + '<p class="balloon__text">В этих домиках, фронтендеры набирают ману, чтобы постигать мощь JS</p>'
        + '<p><a href="https://adict.ru" target="_blank" class="balloon__link">adict.ru</a></p>'
        + '</div>',
      office: '<div class="balloon">'
        + '<h1 class="balloon__title">Адикт</h1>'
        + '<p class="balloon__text">Мы — агентство Адикт. Сильны в сложной разработке,\n'
        + 'любим дизайн и брендинг, делаем хорошую интернет-рекламу. '
        + '</p>'
        + '<p><a href="https://adict.ru" target="_blank" class="balloon__link">adict.ru</a></p>'
        + '</div>',
      backend: '<div class="balloon">'
        + '<h1 class="balloon__title">Бекэнд</h1>'
        + '<p class="balloon__text">Эти товарищи способны вообще на всё, нет серьёзно на всё. Но для этого им  \n'
        + 'нужно набраться энергии и выпить тёплый чай</p>'
        + '<p><a href="https://adict.ru" target="_blank" class="balloon__link">adict.ru</a></p>'
        + '</div>',
      manager: '<div class="balloon">'
        + '<h1 class="balloon__title">Менеджер</h1>'
        + '<p class="balloon__text">Знаете про швейцарский нож? Который с кучей разных инструментов. В этих домиках \n'
        + 'менеджеры открывают новые инструменты для себя</p>'
        + '<p><a href="https://adict.ru" target="_blank" class="balloon__link">adict.ru</a></p>'
        + '</div>',
      design: '<div class="balloon">'
        + '<h1 class="balloon__title">Дизайнер</h1>'
        + '<p class="balloon__text">Лучше всех знает про синтезирование, но для эффективной работы нужно искать \n'
        + 'вдохновение. В этих домиках они его находят, чтобы всем показать на что они способны</p>'
        + '<p><a href="https://adict.ru" target="_blank" class="balloon__link">adict.ru</a></p>'
        + '</div>',
    };

    const BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
      balloonContents[key], {
        build() {
          BalloonContentLayout.superclass.build.call(this);
        },
        clear() {
          BalloonContentLayout.superclass.clear.call(this);
        },
      },
    );

    return BalloonContentLayout;
  }

  /**
   * Метод <tt>createMarkers()<tt> создаёт сохранённый список всех маркеров, для последующего
   * восстановления во время работы фильтра
   * @returns {*[]} массив маркеров
   */
  createMarkers() {
    const myGeoObjects = [];

    for (let i = 0; i < this.data.length; i += 1) {
      const currentMark = this.data[i];
      const { type } = currentMark;

      // Добавление кастомного Balloon на маркер при клике

      console.log(currentMark)
      const dataForBallon = {
        name: currentMark.properties.balloonContent,
        description: '',
      }

      // currentMark.options.balloonContentLayout = this.setCustomBalloonTemplate(type);

      const { coordinates } = currentMark.geometry;
      const { properties } = currentMark;
      const { options } = currentMark;

      myGeoObjects[i] = new ymaps.Placemark(coordinates, properties, options);
    }

    return myGeoObjects;
  }

  /**
   * Метод <tt>addCollections()<tt> добавляет маркеры, соответствующие заданному ключу категорий
   * @param keyList список ключей (выбранных пунктов)
   */
  addCollections(keyList) {
    this.markers.forEach((mark) => {
      // eslint-disable-next-line no-underscore-dangle
      const markType = mark.properties._data.clusterCaption;

      if (keyList.includes(markType)) {
        this.claster.add(mark);
      }
    });
  }

  /**
   * Метод <tt>removeAllCollections()<tt> удаляет все маркеры с кластера
   */
  removeAllCollections() {
    this.claster.removeAll();
    this.addCollections('office');
  }

  /**
   * Метод <tt>initMarks()<tt> добавляет все метки на карту при первом открытии карты
   */
  initMarks() {
    this.yandexMap.geoObjects.add(this.claster);
  }

  /**
   * Метод <tt>updateKeyList()<tt> обновляет список ключей, при работе с фильтром
   * @param buttons массив кнопок фильтра
   * @returns {*[]} список выбранных категорий
   */
  // eslint-disable-next-line class-methods-use-this
  updateKeyList(buttons) {
    const keyList = [];
    buttons.forEach((button) => {
      if (button.classList.contains('active')) {
        keyList.push(button.dataset.type);
      }
    });

    if (keyList.length === 0) {
      buttons.forEach((button) => {
        keyList.push(button.dataset.type);
      });
    }

    return keyList;
  }

  /**
   * Событие <tt>onClickFilter()<tt>, вызываемые при нажатии на кнопку фильтра
   * @param filterButtons список кнопок фильтра
   * @param filterOption кнопка, по которой произошло нажатие
   */
  onClickFilter(filterButtons, filterOption) {
    filterOption.classList.toggle('active');
    this.removeAllCollections();
    const keys = this.updateKeyList(filterButtons);
    this.addCollections(keys);
  }

  /**
   * Метод <tt>initFilter()<tt> инициализирует фильтр
   */
  initFilter(visibility) {
    this.initMarks();

    const filter = document.querySelector('.js--filter');
    if (visibility) {
      const filterButtons = filter.querySelectorAll('.js--filter-btn');
      filterButtons.forEach((btn) => {
        btn.addEventListener('click', () => this.onClickFilter(filterButtons, btn));
      });
    } else {
      filter.classList.add('hidden');
    }
  }

  /**
   * Метод <tt>createFullMap()<tt> инициализирует большую карту в заданном контейнере
   * с указанием расположения офиса, без размещения метки офиса
   */
  createFullMap(options) {
    const mapCenter = [52.27687669227004, 104.29767546002795];
    this.yandexMap.setCenter(mapCenter);
    this.yandexMap.setZoom(13);

    if (options.show1kmRound) {
      const circleCenter = [52.288770783011806, 104.26826330351393];
      const circleOptions = {
        fillColor: '#7DBCCA',
        fillOpacity: 0.3,
        strokeWidth: 0,
      };
      const circle = new ymaps.Circle([circleCenter, 1000], {}, circleOptions);

      this.yandexMap.geoObjects.add(circle);
    }

    this.initMarks();
    this.initFilter(options.showFilter);
  }
}
