/**
 * Плавная прокрутка по якорным ссылкам (в т.ч. с учётом фиксированного хедера).
 * Обрабатывает клики по a[href^="#"] на той же странице.
 */
export default () => {
  document.addEventListener('click', (e) => {
    const link = e.target.closest('a[href^="#"]');
    if (!link || !link.hash) return;

    const href = link.getAttribute('href');
    if (href === '#') return;

    const targetId = href.slice(1);
    const target = document.getElementById(targetId);
    if (!target || target === document.body) return;

    // Только если ссылка ведёт на текущую страницу (не на другой документ)
    const baseUrl = (url) => url.split('#')[0].replace(/\/$/, '') || '/';
    const isSamePage = baseUrl(link.href) === baseUrl(window.location.href);

    if (!isSamePage) return;

    e.preventDefault();
    target.scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    });
  });
};
