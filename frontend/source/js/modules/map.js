import { JSONData } from '../classes/json';
import { YandexMap } from '../classes/ymaps';
import { GeoJSONData } from '../classes/geojson';

export default () => {
  const DATA = [
    {
      name: 'Мой дом',
      type: 'home',
      coordinates: [52.29164343171608, 104.24956988877872],
    },

    {
      name: 'Парк "Парижской Комунны"',
      type: 'park',
      coordinates: [52.287785210220584, 104.24925884563669],
    },
    {
      name: 'Роща "Звездочка"',
      type: 'park',
      coordinates: [52.27352418169792, 104.26050694853043],
    },
    {
      name: 'Иерусалимская гора',
      type: 'park',
      coordinates: [52.27606061060547, 104.29835595574741],
    },
    {
      name: 'Парк "Остров Юность"',
      type: 'park',
      coordinates: [52.271302006817436, 104.27621451536504],
    },
    {
      name: 'Парк "Полуостров Конный"',
      type: 'park',
      coordinates: [52.265713143966885, 104.28281534120275],
    },

    {
      name: 'ТК "Комсомолл"',
      type: 'shop',
      coordinates: [52.28321766786576, 104.31069621011386],
    },
    {
      name: 'ТК "130 Квартал"',
      type: 'shop',
      coordinates: [52.256031131353204, 104.24649392959822],
    },
    {
      name: 'TK "Новый"',
      type: 'shop',
      coordinates: [52.24181783145301, 104.2743312283342],
    },
    {
      name: 'ЖД Вокзал',
      type: 'train',
      coordinates: [52.29136071742607, 104.28432238595039],
    },
    {
      name: 'Аэропорт',
      type: 'airport',
      coordinates: [52.27059250304151, 104.25908250850405],
    },
    {
      name: 'Ленд 1',
      type: 'landmark',
      coordinates: [52.25805295606605, 104.26043327741705],
    },
    {
      name: 'Ленд 2',
      type: 'landmark',
      coordinates: [52.26947616962614, 104.26047894022595],
    },
    {
      name: 'Ленд 3',
      type: 'landmark',
      coordinates: [52.276865822026934, 104.30812476330269],
    },
    {
      name: 'Ленд 4',
      type: 'landmark',
      coordinates: [52.26241939611313, 104.30093814609481],
    },
  ];

  function initMainMap(initGeoJson) {
    const mainMapContainer = document.querySelector('#map');
    const dataJSON = new JSONData(DATA).getFormattedJSON();

    if (mainMapContainer) {
      const yandexMap = new YandexMap('map', dataJSON);
      yandexMap.createFullMap({
        show1kmRound: true,
        showFilter: true,
      });
    }

    if (initGeoJson) {
      const geoJson = new GeoJSONData(DATA).getGeoJson();
      // eslint-disable-next-line no-console
      console.log('Вводные данные для редактирования файла data.geojson, представлены ниже');
      // eslint-disable-next-line no-console
      console.log(geoJson);
    }
  }

  ymaps.ready(() => initMainMap(true));
};
