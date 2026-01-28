export default () => {
  function toggleFilter(container) {
    if (!container) {
      return;
    }

    const toggleBtn = container.querySelector('.js--toggle-filter');
    toggleBtn.addEventListener('click', () => {
      container.classList.toggle('active');
    });
  }

  const filter = document.querySelector('.js--filter');
  toggleFilter(filter);
};
