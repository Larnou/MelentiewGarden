/**
 * Класс <tt>GeoJSONData<tt> создаёт отформатированные данные необходимые
 * для создания Яндекс.Карт из сырых данных для объявления объекта, используемого в Яндекс.Карты Конструктор,
 * полученных со стороны бекэнда
 */
// eslint-disable-next-line import/prefer-default-export
export class GeoJSONData {
  constructor(rawData) {
    this.rawData = rawData;
  }

  /**
   * Метод <tt>setGeometryData()<tt> задаёт геометрические параметры маркера: его тип и координаты
   * @param element маркер, для которого задаются данные
   * @returns {{}} словарь, содержащий в себе отформатированные данные
   */
  // eslint-disable-next-line class-methods-use-this
  setGeometryData(element) {
    const data = {};

    data.type = 'Point';
    data.coordinates = [element.coordinates[1], element.coordinates[0]];

    return data;
  }

  /**
   * Метод <tt>setBalloonContent()<tt> задёт цвет для кластерного отображения иконки маркера при отдалении экрана
   * @param key ключ, по которому выбирается цвет
   * @returns {*} значение цвета в формате HEX-code
   */
  // eslint-disable-next-line class-methods-use-this
  setBalloonContent(key) {
    const balloonContents = {
      frontend: 'В этих домиках, фронтендеры набирают ману, чтобы постигать мощь JS',
      office: 'Мы — агентство Адикт. Сильны в сложной разработке, любим дизайн и брендинг, делаем хорошую '
        + 'интернет-рекламу.',
      backend: 'Эти товарищи способны вообще на всё, нет серьёзно на всё. Но для этого им нужно набраться энергии и '
        + 'выпить тёплый чай',
      manager: 'Знаете про швейцарский нож? Который с кучей разных инструментов. В этих домиках менеджеры открывают '
        + 'новые инструменты для себя',
      design: 'Лучше всех знает про синтезирование, но для эффективной работы нужно искать вдохновение. '
        + 'В этих домиках они его находят, чтобы всем показать на что они способны',
    };

    return balloonContents[key];
  }

  /**
   * Метод <tt>setClusterColor()<tt> задаёт цвет отображения иконки маркера
   * @param key ключ, по которому выбирается цвет
   * @returns {*} значение цвета в формате HEX-code
   */
  // eslint-disable-next-line class-methods-use-this
  setClusterColor(key) {
    const colors = {
      office: '#7DBCCA',
      frontend: '#846075',
      backend: '#FE5F55',
      manager: '#545775',
      design: '#FCA311',
    };

    return colors[key];
  }

  /**
   * Метод <tt>setPropertiesData()<tt> задаёт дополнительные параметры для маркера
   * @param element маркер, для которого задаются данные
   * @returns {{}} словарь, содержащий в себе отформатированные данные
   */
  // eslint-disable-next-line class-methods-use-this
  setPropertiesData(element) {
    const data = {};

    data.description = this.setBalloonContent(element.type);
    data.iconCaption = element.type;
    data['marker-color'] = this.setClusterColor(element.type);

    return data;
  }

  /**
   * Метод <tt>setMetaData()<tt> задаёт meta-данные для geojson-файла
   * @returns {{}} словарь, содержащий в себе отформатированные данные
   */
  // eslint-disable-next-line class-methods-use-this
  setMetaData() {
    const data = {};

    data.name = 'Карта нашего офиса';
    data.creator = 'Yandex Map Constructor';
    data.description = 'Хотел узнать где кто живёт? Тогда тебе сюда';

    return data;
  }

  /**
   * Метод <tt>getFormattedJSON()<tt> возвращает отформатированный набор данных,
   * объектов, содержащий в себе параметры необходимые для отображения маркера на карте
   * @returns {*[]} возвращаемый словарь
   */
  getFormattedJSON() {
    const formattedJSON = [];

    for (let i = 0; i < this.rawData.length; i += 1) {
      const currentMark = {};
      const currentElement = this.rawData[i];

      currentMark.type = 'Feature';
      currentMark.geometry = this.setGeometryData(currentElement);
      currentMark.properties = this.setPropertiesData(currentElement);

      formattedJSON.push(currentMark);
    }

    return formattedJSON;
  }

  /**
   * Метод <tt>getGeoJson()<tt> возвращает отформатированный набор данных,
   * содержащий в себе параметры необходимые для вставки в файл и последующего
   * использования в конструкторе Яндекс.Карты
   * @returns {{}} возвращаемый словарь
   */
  getGeoJson() {
    const geojson = {};

    geojson.type = 'FeatureCollection';
    geojson.metadata = this.setMetaData();
    geojson.features = this.getFormattedJSON();

    return geojson;
  }
}
