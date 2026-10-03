const TYPE_FROM_URL = {
  seed: 'seed',
  stone: 'stone',
  berry: 'berry',
  decor: 'decor',
  indoor: 'indoor',
  'seedling-seed': 'seed',
  'seedling-stone': 'stone',
  'seedling-berry': 'berry',
  'seedling-decor': 'decor',
  'seedling-indoor': 'indoor',
};

const cardValue = (item, name) => {
  if (name === 'type') {
    return (item.dataset.tags || '').split(/\s+/).filter(Boolean);
  }
  if (name === 'kind') return [item.dataset.kind || ''];
  return [item.dataset.season || ''];
};

const visibleOptions = (filter) => filter.options.filter((option) => !option.hidden);

const closeMenu = (filter) => {
  const { menu, root, button } = filter;
  if (!menu) return;
  menu.hidden = true;
  root.classList.remove('catalog-select--open');
  button.setAttribute('aria-expanded', 'false');
};

const openMenu = (filter, filters) => {
  const { menu, root, button } = filter;
  filters.forEach((other) => {
    if (other !== filter) closeMenu(other);
  });
  menu.hidden = false;
  root.classList.add('catalog-select--open');
  button.setAttribute('aria-expanded', 'true');
};

export default () => {
  const groups = Array.from(document.querySelectorAll('.js-catalog-filter'));
  if (!groups.length) return;

  const items = Array.from(document.querySelectorAll('.seedlings-card'));
  const empty = document.querySelector('.js-catalog-empty');
  if (!items.length) return;

  const urlType = TYPE_FROM_URL[new URLSearchParams(window.location.search).get('tag') || ''];
  const filters = new Map();

  groups.forEach((group) => {
    const name = group.dataset.catalogFilter;
    if (!name) return;

    const chips = Array.from(group.querySelectorAll('.tag-filter__chip'));
    const options = Array.from(group.querySelectorAll('.catalog-select__option'));
    const choices = chips.length ? chips : options;
    if (!choices.length) return;

    const active = new Set();
    if (name === 'type' && urlType && choices.some((choice) => choice.dataset.value === urlType)) {
      active.add(urlType);
    }
    if (!active.size) active.add('all');

    filters.set(name, {
      name,
      root: group,
      chips,
      options,
      choices,
      active,
      button: group.querySelector('.catalog-select__button'),
      menu: group.querySelector('.catalog-select__menu'),
      valueEl: group.querySelector('.catalog-select__value'),
      placeholder: group.dataset.placeholder || '',
    });
  });

  const isVisible = (item) => Array.from(filters.values()).every((filter) => {
    const { active } = filter;
    if (!active.size || active.has('all')) return true;
    return cardValue(item, filter.name).some((value) => active.has(value));
  });

  const choose = (filter, value) => {
    filter.active.clear();
    filter.active.add(value || 'all');
  };

  const syncKindOptions = () => {
    const kind = filters.get('kind');
    const type = filters.get('type');
    if (!kind || !type) return;

    const showAllTypes = !type.active.size || type.active.has('all');

    kind.options.forEach((option) => {
      const optionTypes = (option.dataset.types || '').split(/\s+/).filter(Boolean);
      const visible = option.dataset.value === 'all'
        || showAllTypes
        || optionTypes.some((tag) => type.active.has(tag));

      const node = option;
      node.hidden = !visible;
      if (!visible) kind.active.delete(option.dataset.value);
    });

    if (!kind.active.size) kind.active.add('all');
  };

  const paintSelect = (filter) => {
    if (!filter.button) return;

    const value = filter.active.values().next().value || 'all';
    const selected = filter.options.find((option) => option.dataset.value === value);
    const label = selected ? selected.textContent.trim() : filter.placeholder;
    const chosen = value !== 'all';

    const { valueEl } = filter;
    valueEl.textContent = chosen ? label : filter.placeholder;
    filter.button.setAttribute(
      'aria-label',
      chosen ? `${filter.placeholder}: ${label}` : filter.placeholder,
    );
    filter.root.classList.toggle('catalog-select--active', chosen);

    filter.options.forEach((option) => {
      const on = option.dataset.value === value;
      option.classList.toggle('catalog-select__option--active', on);
      option.setAttribute('aria-selected', on ? 'true' : 'false');
    });
  };

  const paint = () => {
    syncKindOptions();

    let shown = 0;
    items.forEach((item) => {
      const visible = isVisible(item);
      item.classList.toggle('seedlings-card--hidden', !visible);
      if (visible) shown += 1;
    });

    filters.forEach((filter) => {
      filter.chips.forEach((chip) => {
        const on = filter.active.has(chip.dataset.value);
        chip.classList.toggle('tag-filter__chip--active', on);
        chip.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
      paintSelect(filter);
    });

    if (empty) empty.hidden = shown > 0;
  };

  filters.forEach((filter) => {
    if (filter.chips.length) {
      filter.root.addEventListener('click', (event) => {
        const chip = event.target.closest('.tag-filter__chip');
        if (!chip || !filter.root.contains(chip)) return;

        const { value } = chip.dataset;
        if (!value) return;

        if (value === 'all' || filter.active.has(value)) choose(filter, 'all');
        else choose(filter, value);

        paint();
      });
      return;
    }

    filter.button.addEventListener('click', () => {
      if (filter.menu.hidden) openMenu(filter, filters);
      else closeMenu(filter);
    });

    filter.button.addEventListener('keydown', (event) => {
      if (event.key !== 'ArrowDown' && event.key !== 'ArrowUp') return;
      event.preventDefault();
      openMenu(filter, filters);
      const options = visibleOptions(filter);
      const target = event.key === 'ArrowUp' ? options[options.length - 1] : options[0];
      if (target) target.focus();
    });

    filter.menu.addEventListener('click', (event) => {
      const option = event.target.closest('.catalog-select__option');
      if (!option || option.hidden || !filter.menu.contains(option)) return;
      choose(filter, option.dataset.value || 'all');
      closeMenu(filter);
      filter.button.focus();
      paint();
    });

    filter.menu.addEventListener('keydown', (event) => {
      const options = visibleOptions(filter);
      const index = options.indexOf(document.activeElement);

      if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
        event.preventDefault();
        const next = event.key === 'ArrowDown' ? index + 1 : index - 1;
        if (next < 0) {
          filter.button.focus();
          return;
        }
        if (options[next]) options[next].focus();
        return;
      }

      if (event.key === 'Home') {
        event.preventDefault();
        if (options[0]) options[0].focus();
        return;
      }

      if (event.key === 'End') {
        event.preventDefault();
        if (options[options.length - 1]) options[options.length - 1].focus();
        return;
      }

      if (event.key === 'Escape') {
        event.preventDefault();
        closeMenu(filter);
        filter.button.focus();
      }
    });
  });

  document.addEventListener('click', (event) => {
    filters.forEach((filter) => {
      if (!filter.menu || filter.menu.hidden || filter.root.contains(event.target)) return;
      closeMenu(filter);
    });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    filters.forEach((filter) => closeMenu(filter));
  });

  paint();
};
