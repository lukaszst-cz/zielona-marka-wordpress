document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('.menu-toggle');
  const menu = document.querySelector('.site-menu');

  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      menu.classList.toggle('is-open', !open);
      document.body.classList.toggle('menu-open', !open);
    });

    menu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        toggle.setAttribute('aria-expanded', 'false');
        menu.classList.remove('is-open');
        document.body.classList.remove('menu-open');
      });
    });
  }

  const header = document.querySelector('[data-header]');
  if (header) {
    const updateHeader = () => header.classList.toggle('is-scrolled', window.scrollY > 12);
    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });
  }

  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reducedMotion) {
    const scene = document.querySelector('.hero-scene');
    if (scene) {
      scene.addEventListener('pointermove', (event) => {
        const rect = scene.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width - 0.5;
        const y = (event.clientY - rect.top) / rect.height - 0.5;
        scene.style.setProperty('--rx', String(y * -4) + 'deg');
        scene.style.setProperty('--ry', String(x * 5) + 'deg');
      });
      scene.addEventListener('pointerleave', () => {
        scene.style.setProperty('--rx', '0deg');
        scene.style.setProperty('--ry', '0deg');
      });
    }
  }
});
