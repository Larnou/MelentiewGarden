import Swiper from 'swiper/bundle';

export default () => {
  function initSlider(container) {
    if (!container) {
      return;
    }

    const prevText = container.querySelector('.js--control-text-prev');
    const nextText = container.querySelector('.js--control-text-next');

    // eslint-disable-next-line no-unused-vars
    const slider = new Swiper(container, {
      slidesPerView: 1,
      watchOverflow: true,
      watchSlidesProgress: true,
      allowTouchMove: false,
      watchSlidesVisibility: true,
      speed: 700,
      spaceBetween: 160,
      navigation: {
        prevEl: '.swiper-button-prev',
        nextEl: '.swiper-button-next',
      },
      on: {
        init() {
          const nextSlide = this.slides[1];
          nextText.textContent = nextSlide.querySelector('.map__title').textContent;
        },

        slideChange() {
          const nextIndex = this.realIndex + 1;
          const prevIndex = this.realIndex - 1;

          if (nextIndex < this.slides.length) {
            const nextSlide = this.slides[nextIndex];
            nextText.textContent = nextSlide.querySelector('.map__title').textContent;
          }

          if (prevIndex >= 0) {
            const prevSlide = this.slides[prevIndex];
            prevText.textContent = prevSlide.querySelector('.map__title').textContent;
          }
        },
      },
    });
  }

  const slider = document.querySelector('.js--maps-slider');
  initSlider(slider);
};
