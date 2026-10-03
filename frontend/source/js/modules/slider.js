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
      ...(navigation ? { navigation } : {}),
    });

    return sliderInstance;
  }

  // Хиро-категории
  const heroSlider = document.querySelector('.js-hero-categories');
  initSlider(heroSlider);

  // Саженцы
  const seedlingsSlider = document.querySelector('.js-seedlings-slider');
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

  // Ярмарка
  const fairSlider = document.querySelector('.js-fair-slider');
  initSlider(fairSlider, {
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
  });

  // Статьи
  const articlesSlider = document.querySelector('.js-articles-slider');
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

  const initProductGallery = (container) => {
    const block = container.closest('.article-block');
    if (!block || block.dataset.galleryReady === 'true') return;

    const controls = block.querySelector('.article-block__slider-controls');
    const prev = controls && controls.querySelector('.article-block__arrow--prev');
    const next = controls && controls.querySelector('.article-block__arrow--next');
    const slides = Array.from(container.querySelectorAll('.swiper-slide'));
    if (!slides.length || !prev || !next) return;

    block.dataset.galleryReady = 'true';
    block.classList.add('product-gallery');

    const stage = document.createElement('div');
    stage.className = 'product-gallery__stage';
    const stageImg = document.createElement('img');
    stage.appendChild(stageImg);

    const caption = document.createElement('p');
    caption.className = 'product-gallery__caption';

    const nav = document.createElement('div');
    nav.className = 'product-gallery__nav';

    block.insertBefore(stage, container);
    nav.appendChild(prev);
    nav.appendChild(container);
    nav.appendChild(next);
    controls.remove();
    block.appendChild(nav);
    block.appendChild(caption);

    const thumbs = new Swiper(container, {
      slidesPerView: 4,
      spaceBetween: 4,
      watchOverflow: true,
      breakpoints: {
        0: {
          slidesPerView: 3,
          spaceBetween: 0,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 4,
        },
      },
    });

    let index = 0;

    const show = (nextIndex) => {
      const total = slides.length;
      index = (nextIndex + total) % total;
      const img = slides[index].querySelector('img');
      const slideCaption = slides[index].querySelector('.article-block__slide-caption');
      if (img) {
        stageImg.src = img.getAttribute('src') || '';
        stageImg.alt = img.getAttribute('alt') || '';
      }
      const text = slideCaption ? slideCaption.textContent.trim() : '';
      caption.textContent = text;
      caption.hidden = text.length === 0;
      slides.forEach((slide, slideIndex) => {
        slide.classList.toggle('is-active', slideIndex === index);
      });
      thumbs.slideTo(index);
    };

    if (slides.length < 2) {
      prev.hidden = true;
      next.hidden = true;
    }

    prev.addEventListener('click', () => show(index - 1));
    next.addEventListener('click', () => show(index + 1));
    container.addEventListener('click', (event) => {
      const slide = event.target.closest('.swiper-slide');
      if (!slide) return;
      const nextIndex = slides.indexOf(slide);
      if (nextIndex >= 0) show(nextIndex);
    });

    show(0);
  };

  // Слайдеры в статьях: галерея и галерея с подписями
  document.querySelectorAll('.js-article-gallery, .js-article-gallery-captions').forEach((container) => {
    if (container.closest('.article--product') && container.classList.contains('js-article-gallery-captions')) {
      initProductGallery(container);
      return;
    }

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
