import Swiper from 'swiper/bundle';

export default () => {
  function initSlider(container, options = {}) {
    if (!container) {
      return null;
    }

    const {
      prevSelector,
      nextSelector,
      ...swiperOptions
    } = options;

    let navigation;

    if (prevSelector || nextSelector) {
      const root = container.closest('section') || container.parentElement;

      navigation = {
        prevEl: prevSelector && root ? root.querySelector(prevSelector) : null,
        nextEl: nextSelector && root ? root.querySelector(nextSelector) : null,
      };
    }

    // eslint-disable-next-line no-unused-vars
    const sliderInstance = new Swiper(container, {
      slidesPerView: 'auto',
      watchOverflow: true,
      allowTouchMove: true,
      watchSlidesVisibility: true,
      speed: 700,
      // spaceBetween: 12,
      resistanceRatio: 0,
      ...swiperOptions,
      ...(navigation ? {navigation} : {}),
    });

    return sliderInstance;
  }

  // Хиро-категории
  const heroSlider = document.querySelector('.js--hero-categories');
  initSlider(heroSlider);

  // Саженцы
  const seedlingsSlider = document.querySelector('.js--seedlings-slider');
  initSlider(seedlingsSlider, {
    slidesPerView: 3,
    spaceBetween: 24,
    prevSelector: '.seedlings__arrow--prev',
    nextSelector: '.seedlings__arrow--next',
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1080: {
        slidesPerView: 3,
      },
    },
  });

  // Статьи
  const articlesSlider = document.querySelector('.js--articles-slider');
  initSlider(articlesSlider, {
    slidesPerView: 2,
    spaceBetween: 24,
    prevSelector: '.articles__arrow--prev',
    nextSelector: '.articles__arrow--next',
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
    },
  });

  // Слайдеры в статьях: галерея и галерея с подписями
  document.querySelectorAll('.js--article-gallery, .js--article-gallery-captions').forEach((container) => {
    const block = container.closest('.article-block');
    if (!block) return;

    const slides = container.querySelectorAll('.swiper-slide');
    const controls = block.querySelector('.article-block__slider-controls');
    const hasMultipleSlides = slides.length > 1;

    if (!hasMultipleSlides && controls) {
      controls.style.display = 'none';
    }

    initSlider(container, {
      slidesPerView: 1,
      spaceBetween: 16,
      ...(hasMultipleSlides ? {
        prevSelector: '.article-block__arrow--prev',
        nextSelector: '.article-block__arrow--next',
      } : {}),
    });
  });
};
