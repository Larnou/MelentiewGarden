import Swiper from 'swiper/bundle';

export default () => {
  function initSlider(container) {
    if (!container) {
      return;
    }

    // eslint-disable-next-line no-unused-vars
    const slider = new Swiper(container, {
      slidesPerView: 'auto',
      watchOverflow: true,
      allowTouchMove: true,
      watchSlidesVisibility: true,
      speed: 700,
      spaceBetween: 12,
      resistanceRatio: 0,
    });
  }

  const slider = document.querySelector('.js--hero-categories');
  initSlider(slider);
};
