(() => {
  const root = document.documentElement;
  const button = document.querySelector('[data-motion-toggle]');
  if (button) {
    const label = button.querySelector('span:last-child');
    const setPaused = (paused) => {
      root.classList.toggle('motion-paused', paused);
      button.classList.toggle('is-paused', paused);
      button.setAttribute('aria-pressed', paused ? 'true' : 'false');
      if (label) label.textContent = paused ? 'Wznów tło' : 'Zatrzymaj tło';
    };
    button.addEventListener('click', () => setPaused(!root.classList.contains('motion-paused')));
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) setPaused(true);
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) entry.target.classList.add('live-visible');
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.live-step-copy,.live-demo-window,.live-form-demo,.live-voucher-demo,.live-flow-demo,.live-project-grid>a,.live-coop-steps article')
    .forEach((el) => {
      el.classList.add('live-reveal');
      observer.observe(el);
    });
})();