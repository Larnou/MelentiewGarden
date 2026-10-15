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

  // Ярмарка: фото статичное, объявления сменяются
  const fairSliderEl = document.querySelector('.js-fair-slider');
  const fairSlider = initSlider(fairSliderEl, {
    slidesPerView: 1,
    spaceBetween: 0,
    speed: 500,
    pagination: {
      el: '.fair__dots',
      clickable: true,
    },
    a11y: {
      paginationBulletMessage: 'Ярмарка {{index}}',
    },
  });

  if (fairSlider) {
    let fairTimer;
    const playFair = () => {
      window.clearInterval(fairTimer);
      fairTimer = window.setInterval(() => {
        if (fairSlider.isEnd) fairSlider.slideTo(0);
        else fairSlider.slideNext();
      }, 5000);
    };
    const stopFair = () => window.clearInterval(fairTimer);

    playFair();
    fairSlider.el.addEventListener('mouseenter', stopFair);
    fairSlider.el.addEventListener('mouseleave', playFair);
    fairSlider.el.addEventListener('focusin', stopFair);
    fairSlider.el.addEventListener('focusout', playFair);

    let fairWidth = 0;
    const fairObserver = new ResizeObserver(() => {
      const nextWidth = fairSlider.el.clientWidth;
      if (nextWidth === fairWidth) return;
      fairWidth = nextWidth;
      fairSlider.update();
    });
    fairObserver.observe(fairSlider.el);
  }

  // Статьи: слайдер на главной больше не используется

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

  const chevron = (direction) => {
    const path = direction === 'prev' ? 'M10 3 5 8l5 5' : 'M6 3l5 5-5 5';
    return `
      <svg width="18" height="18" viewBox="0 0 16 16" fill="none" aria-hidden="true">
        <path d="${path}" stroke="currentColor" stroke-width="1.8"
          stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    `;
  };

  const ensureLightbox = () => {
    let lightbox = document.querySelector('.product-lightbox');
    if (lightbox) return lightbox;

    lightbox = document.createElement('div');
    lightbox.className = 'product-lightbox';
    lightbox.hidden = true;
    lightbox.innerHTML = `
      <div class="product-lightbox__dialog" role="dialog" aria-modal="true" aria-label="Фото сорта">
        <button class="product-lightbox__close" type="button" aria-label="Закрыть">
          <svg width="18" height="18" viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <path d="M3.5 3.5 12.5 12.5M12.5 3.5 3.5 12.5"
              stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
          </svg>
        </button>
        <button class="product-lightbox__nav product-lightbox__nav--prev" type="button"
          aria-label="Предыдущее фото">${chevron('prev')}</button>
        <img class="product-lightbox__image" alt="">
        <button class="product-lightbox__nav product-lightbox__nav--next" type="button"
          aria-label="Следующее фото">${chevron('next')}</button>
      </div>
    `;
    document.body.appendChild(lightbox);
    return lightbox;
  };

  const initSeedlingGallery = (root) => {
    const stageImg = root.querySelector('.product__stage-image');
    const thumbs = Array.from(root.querySelectorAll('.product__thumb'));
    const prev = root.querySelector('.product__nav--prev');
    const next = root.querySelector('.product__nav--next');
    const zoom = root.querySelector('.product__zoom');
    if (!stageImg) return;

    const slides = thumbs.length
      ? thumbs.map((thumb) => ({
        src: thumb.dataset.src || '',
        alt: thumb.dataset.alt || '',
      }))
      : [{
        src: stageImg.getAttribute('src') || '',
        alt: stageImg.getAttribute('alt') || '',
      }];

    let index = 0;
    let opener = null;
    const lightbox = ensureLightbox();
    const lightboxImg = lightbox.querySelector('.product-lightbox__image');
    const lightboxPrev = lightbox.querySelector('.product-lightbox__nav--prev');
    const lightboxNext = lightbox.querySelector('.product-lightbox__nav--next');
    const lightboxClose = lightbox.querySelector('.product-lightbox__close');
    const several = slides.length > 1;

    lightboxPrev.hidden = !several;
    lightboxNext.hidden = !several;

    const paint = () => {
      const slide = slides[index];
      stageImg.src = slide.src;
      stageImg.alt = slide.alt;
      thumbs.forEach((thumb, thumbIndex) => {
        const active = thumbIndex === index;
        thumb.classList.toggle('is-active', active);
        thumb.setAttribute('aria-pressed', active ? 'true' : 'false');
        if (active) thumb.scrollIntoView({ block: 'nearest', inline: 'nearest' });
      });
      if (lightbox.hidden) return;
      lightboxImg.src = slide.src;
      lightboxImg.alt = slide.alt;
    };

    const show = (nextIndex) => {
      const total = slides.length;
      index = (nextIndex + total) % total;
      paint();
    };

    const closeLightbox = () => {
      lightbox.hidden = true;
      document.body.classList.remove('product-lightbox-open');
      if (opener) opener.focus();
    };

    const openLightbox = (trigger) => {
      opener = trigger || zoom;
      lightbox.hidden = false;
      document.body.classList.add('product-lightbox-open');
      paint();
      lightboxClose.focus();
    };

    if (prev) prev.addEventListener('click', () => show(index - 1));
    if (next) next.addEventListener('click', () => show(index + 1));
    thumbs.forEach((thumb, thumbIndex) => {
      thumb.addEventListener('click', () => show(thumbIndex));
    });
    if (zoom) zoom.addEventListener('click', () => openLightbox(zoom));
    stageImg.addEventListener('click', () => openLightbox(zoom || stageImg));

    root.addEventListener('keydown', (event) => {
      if (lightbox.hidden === false) return;
      if (event.key === 'ArrowLeft') {
        event.preventDefault();
        show(index - 1);
      }
      if (event.key === 'ArrowRight') {
        event.preventDefault();
        show(index + 1);
      }
    });

    if (!lightbox.dataset.bound) {
      lightbox.dataset.bound = 'true';
      lightbox.addEventListener('click', (event) => {
        if (event.target.closest('button, img')) return;
        closeLightbox();
      });
      lightboxClose.addEventListener('click', closeLightbox);
      lightboxPrev.addEventListener('click', () => show(index - 1));
      lightboxNext.addEventListener('click', () => show(index + 1));
      document.addEventListener('keydown', (event) => {
        if (lightbox.hidden) return;
        if (event.key === 'Escape') {
          event.preventDefault();
          closeLightbox();
        }
        if (event.key === 'ArrowLeft') {
          event.preventDefault();
          show(index - 1);
        }
        if (event.key === 'ArrowRight') {
          event.preventDefault();
          show(index + 1);
        }
      });
    }
  };

  document.querySelectorAll('.js-product-gallery').forEach(initSeedlingGallery);

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
