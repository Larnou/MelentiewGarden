export default () => {
  const groups = document.querySelectorAll('.js-tag-filter');
  if (!groups.length) return;

  const params = new URLSearchParams(window.location.search);
  const urlTag = params.get('tag');

  groups.forEach((group) => {
    const targetSelector = group.dataset.target;
    if (!targetSelector) return;

    const chips = Array.from(group.querySelectorAll('.tag-filter__chip'));
    if (!chips.length) return;

    const items = Array.from(document.querySelectorAll(targetSelector));
    if (!items.length) return;

    const hiddenClass = targetSelector.includes('seedlings-card')
      ? 'seedlings-card--hidden'
      : 'article-card--hidden';

    const applyFilter = (activeTags) => {
      items.forEach((item) => {
        const tags = (item.dataset.tags || '')
          .split(/\s+/)
          .filter(Boolean);

        const useAll = !activeTags.size || activeTags.has('all');
        const visible = useAll || tags.some((tag) => activeTags.has(tag));
        item.classList.toggle(hiddenClass, !visible);
      });
    };

    const updateChipsView = (activeTags) => {
      chips.forEach((chip) => {
        const tag = chip.dataset.tag;
        if (!tag) return;
        const isActive = activeTags.has(tag);
        chip.classList.toggle('tag-filter__chip--active', isActive);
        chip.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });
    };

    // Инициализация набора активных тегов
    const activeTags = new Set();
    const allChip = group.querySelector('.tag-filter__chip[data-tag="all"]') || chips[0];

    if (urlTag) {
      const chipFromUrl = chips.find((chip) => chip.dataset.tag === urlTag);
      if (chipFromUrl) {
        activeTags.add(urlTag);
      }
    }

    // Если из URL ничего не выбрали, включаем "Все"
    if (!activeTags.size && allChip && allChip.dataset.tag) {
      activeTags.add(allChip.dataset.tag);
    }

    updateChipsView(activeTags);
    applyFilter(activeTags);

    group.addEventListener('click', (event) => {
      const chip = event.target.closest('.tag-filter__chip');
      if (!chip || !group.contains(chip)) return;

      const tag = chip.dataset.tag;
      if (!tag) return;

      // Обработка мультивыбора
      if (tag === 'all') {
        // Клик по "Все" — сбрасываем остальные
        activeTags.clear();
        activeTags.add('all');
      } else {
        // Переключаем конкретный тег
        if (activeTags.has(tag)) {
          activeTags.delete(tag);
        } else {
          activeTags.add(tag);
        }

        // Если есть хоть один реальный тег, выключаем "all"
        if (activeTags.size) {
          activeTags.delete('all');
        }

        // Если в итоге ничего не выбрано — возвращаемся к "all"
        if (!activeTags.size && allChip && allChip.dataset.tag) {
          activeTags.add(allChip.dataset.tag);
        }
      }

      updateChipsView(activeTags);
      applyFilter(activeTags);
    });
  });
}

