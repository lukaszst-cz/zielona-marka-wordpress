document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.mobile-menu a').forEach((link) => {
    link.addEventListener('click', () => {
      const details = link.closest('details');
      if (details) details.removeAttribute('open');
    });
  });

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const id = link.getAttribute('href');
      if (!id || id === '#') return;
      const target = document.querySelector(id);
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({
        behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth'
      });
      history.replaceState(null, '', id);
    });
  });

  document.querySelectorAll('[data-estimator]').forEach((box) => {
    const type = box.querySelector('[data-estimator-type]');
    const copy = box.querySelector('[data-estimator-copy]');
    const google = box.querySelector('[data-estimator-google]');
    const value = box.querySelector('[data-estimator-value]');

    const update = () => {
      const total = Number(type ? type.value : 0)
        + (copy && copy.checked ? 650 : 0)
        + (google && google.checked ? 490 : 0);
      if (value) value.textContent = new Intl.NumberFormat('pl-PL').format(total) + ' zł';
    };

    [type, copy, google].forEach((field) => {
      if (field) field.addEventListener('change', update);
    });
    update();
  });
});
