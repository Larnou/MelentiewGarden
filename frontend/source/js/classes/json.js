/**
 * Класс <tt>JSONData<tt> создаёт отформатированные данные необходимые
 * для создания Яндекс.Карт из сырых данных, полученных со стороны бекэнда
 */
// eslint-disable-next-line import/prefer-default-export
export class JSONData {
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
    data.coordinates = element.coordinates;

    return data;
  }

  /**
   * Метод <tt>setPropertiesData()<tt> задаёт дополнительные параметры для маркера
   * @param element маркер, для которого задаются данные
   * @returns {{}} словарь, содержащий в себе отформатированные данные
   */
  // eslint-disable-next-line class-methods-use-this
  setPropertiesData(element) {
    const data = {};

    data.clusterCaption = element.type;
    data.balloonContent = element.name;
    data.iconCaption = element.type;
    data.balloonPanelMaxMapArea = 0;

    return data;
  }

  /**
   * Метод <tt>setClusterColor()<tt> задёт цвет для кластерного отображения иконки маркера при отдалении экрана
   * @param key ключ, по которому выбирается цвет
   * @returns {*} значение цвета в формате HEX-code
   */
  // eslint-disable-next-line class-methods-use-this
  setClusterColor(key) {
    const colors = {
      home: '#4D60C2',
      park: '#1E7231',
      shop: '#E9A261',
      train: '#8B5E34',
      airport: '#71C5D8',
      landmark: '#A0C82E',
    };

    return colors[key];
  }

  /**
   * Метод <tt>setOptionData()<tt> задаёт параметры для визуализации маркера на карте
   * @param element маркер, для которого задаются данные
   * @returns {{}} словарь, содержащий в себе отформатированные данные
   */
  // eslint-disable-next-line class-methods-use-this
  setOptionData(element) {
    const data = {};

    data.preset = 'islands#violetCircleDotIconWithCaption';
    data.iconLayout = 'default#image';
    data.iconImageHref = `./img/sprite/map-${element.type}.svg`;
    data.iconImageSize = [24, 24];
    data.iconImageOffset = [-15, -20];
    data.iconColor = this.setClusterColor(element.type);

    return data;
  }

  /**
   * Метод <tt>getFormattedJSON()<tt> возвращает отформатированный набор данных,
   * содержащий в себе параметры необходимые для отображения маркера на карте
   * @returns {*[]} возвращаемый словарь
   */
  getFormattedJSON() {
    const formattedJSON = [];

    for (let i = 0; i < this.rawData.length; i += 1) {
      const currentMark = {};
      const currentElement = this.rawData[i];

      currentMark.geometry = this.setGeometryData(currentElement);
      currentMark.properties = this.setPropertiesData(currentElement);
      currentMark.options = this.setOptionData(currentElement);
      currentMark.type = currentElement.type;

      formattedJSON.push(currentMark);
    }

    return formattedJSON;
  }
}
