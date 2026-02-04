export default () => {
  const TABLET_BREAKPOINT = 1078;

  const header = document.querySelector('.header');
  const btn = document.querySelector('.header__burger');
  const nav = document.querySelector('.header__nav');

  if (!header || !btn || !nav) return;

  const links = nav.querySelectorAll('.header__link');

  const focus = (el) => {
    if (!el) return;

    try {
      el.focus({ preventScroll: true });
    } catch (err) {
      el.focus();
    }
  };

  const isOpen = () => header.classList.contains('is-open');

  const toggle = (open) => {
    header.classList.toggle('is-open', open);
    btn.setAttribute('aria-expanded', open);
    document.body.classList.toggle('no-scroll', open);

    if (open) {
      const first = nav.querySelector('a');

      if (first) {
        focus(first);
      }
    } else {
      focus(btn);
    }
  };

  btn.addEventListener('click', () => toggle(!isOpen()));

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') toggle(false);
  });

  document.addEventListener('click', (e) => {
    if (isOpen() && !header.contains(e.target)) toggle(false);
  });

  links.forEach((link) => {
    link.addEventListener('click', () => toggle(false));
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > TABLET_BREAKPOINT) toggle(false);
  });
};
