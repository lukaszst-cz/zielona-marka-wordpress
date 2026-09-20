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

  document.querySelectorAll('[data-demo-assistant]').forEach((assistant) => {
    const panel = assistant.querySelector('[data-demo-toggle]') ? assistant.querySelector('#demo-kontakt-panel') : null;
    const toggle = assistant.querySelector('[data-demo-toggle]');
    const close = assistant.querySelector('[data-demo-close]');
    const goalStep = assistant.querySelector('[data-demo-step="goal"]');
    const industryStep = assistant.querySelector('[data-demo-step="industry"]');
    const formStep = assistant.querySelector('[data-demo-step="form"]');
    const goalLabel = assistant.querySelector('[data-demo-goal-label]');
    const industryLabel = assistant.querySelector('[data-demo-industry-label]');
    const goalInput = assistant.querySelector('[data-demo-goal-input]');
    const industryInput = assistant.querySelector('[data-demo-industry-input]');
    const prices = assistant.querySelector('[data-demo-prices]');
    let goal = '';
    let industry = '';

    const setOpen = (open) => {
      if (!panel || !toggle) return;
      panel.hidden = !open;
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      assistant.classList.toggle('is-open', open);
    };

    const showStep = (name) => {
      if (goalStep) goalStep.hidden = name !== 'goal';
      if (industryStep) industryStep.hidden = name !== 'industry';
      if (formStep) formStep.hidden = name !== 'form';
    };

    if (toggle) toggle.addEventListener('click', () => setOpen(panel ? panel.hidden : true));
    if (close) close.addEventListener('click', () => setOpen(false));

    document.querySelectorAll('[data-open-demo-kontakt]').forEach((button) => {
      button.addEventListener('click', () => setOpen(true));
    });

    assistant.querySelectorAll('[data-demo-goal]').forEach((button) => {
      button.addEventListener('click', () => {
        goal = button.getAttribute('data-demo-goal') || '';
        if (goalLabel) goalLabel.textContent = goal;
        if (goalInput) goalInput.value = goal;
        if (prices) prices.hidden = goal !== 'Ceny i terminy';
        showStep('industry');
      });
    });

    assistant.querySelectorAll('[data-demo-industry]').forEach((button) => {
      button.addEventListener('click', () => {
        industry = button.getAttribute('data-demo-industry') || '';
        if (industryLabel) industryLabel.textContent = industry;
        if (industryInput) industryInput.value = industry;
        showStep('form');
      });
    });

    assistant.querySelectorAll('[data-demo-back]').forEach((button) => {
      button.addEventListener('click', () => {
        const back = button.getAttribute('data-demo-back');
        if (back === 'goal') {
          goal = '';
          industry = '';
          if (goalInput) goalInput.value = '';
          if (industryInput) industryInput.value = '';
          showStep('goal');
        } else {
          industry = '';
          if (industryInput) industryInput.value = '';
          showStep('industry');
        }
      });
    });
  });
});
