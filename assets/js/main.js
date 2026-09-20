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

  document.querySelectorAll('[data-status-form]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const input = form.querySelector('input[name="code"]');
      const clean = input ? input.value.trim().toUpperCase() : '';
      if (!clean) return;
      window.location.href = '/status/' + encodeURIComponent(clean);
    });
  });

  document.querySelectorAll('[data-industry-demo]').forEach((demo) => {
    const configNode = document.querySelector('[data-demo-config]');
    let config = { stages: [], newName: 'Nowy rekord', newValue: 0 };
    try {
      if (configNode) config = JSON.parse(configNode.textContent || '{}');
    } catch (error) {}

    const log = demo.querySelector('[data-demo-log]');
    const rowsWrap = demo.querySelector('[data-demo-rows]');

    const addLog = (message) => {
      if (!log) return;
      const p = document.createElement('p');
      p.innerHTML = '<i></i> ' + message;
      log.prepend(p);
      while (log.children.length > 5) log.removeChild(log.lastElementChild);
    };

    const refreshStats = () => {
      const rows = Array.from(demo.querySelectorAll('[data-demo-row]'));
      const stages = Math.max(1, config.stages.length - 1);
      const totalStage = rows.reduce((sum, row) => sum + Number(row.getAttribute('data-stage') || 0), 0);
      const totalValue = rows.reduce((sum, row) => sum + Number(row.getAttribute('data-value') || 0), 0);
      const progressed = rows.filter((row) => Number(row.getAttribute('data-stage') || 0) >= 3).length;
      const values = [
        String(rows.length),
        Math.round((totalStage / Math.max(1, rows.length * stages)) * 100) + '%',
        new Intl.NumberFormat('pl-PL').format(totalValue) + ' zł',
        String(progressed)
      ];
      demo.querySelectorAll('[data-demo-stat]').forEach((node) => {
        node.textContent = values[Number(node.getAttribute('data-demo-stat') || 0)] || '0';
      });
    };

    const bindRow = (row) => {
      const button = row.querySelector('[data-demo-advance]');
      if (!button) return;
      button.addEventListener('click', () => {
        const current = Number(row.getAttribute('data-stage') || 0);
        const next = Math.min(config.stages.length - 1, current + 1);
        row.setAttribute('data-stage', String(next));
        const label = row.querySelector('[data-stage-label]');
        const bar = row.querySelector('[data-stage-bar]');
        if (label) label.textContent = config.stages[next] || '';
        if (bar) bar.style.width = (((next + 1) / Math.max(1, config.stages.length)) * 100) + '%';
        if (next >= config.stages.length - 1) {
          button.textContent = 'Gotowe';
          button.disabled = true;
        }
        addLog((row.getAttribute('data-id') || 'Rekord') + ': ' + (config.stages[next] || '') + '. Wykonano następne zadania procesu');
        refreshStats();
      });
    };

    demo.querySelectorAll('[data-demo-row]').forEach(bindRow);

    const add = demo.querySelector('[data-demo-add]');
    if (add && rowsWrap) add.addEventListener('click', () => {
      const count = demo.querySelectorAll('[data-demo-row]').length;
      const id = ((demo.getAttribute('data-industry') || 'DE').slice(0, 2).toUpperCase()) + '-' + (300 + count);
      const row = document.createElement('article');
      row.className = 'industry-row';
      row.setAttribute('data-demo-row', '');
      row.setAttribute('data-id', id);
      row.setAttribute('data-stage', '0');
      row.setAttribute('data-value', String(config.newValue || 0));
      row.innerHTML = '<div><b>nowe</b><small>' + id + '</small></div><div><strong>' + (config.newName || 'Nowy rekord') + '</strong><small>Dane z formularza strony</small></div><span data-stage-label>' + (config.stages[0] || '') + '</span><div><i data-stage-bar style="width:' + (100 / Math.max(1, config.stages.length)) + '%"></i></div><button type="button" data-demo-advance>Następny etap →</button>';
      rowsWrap.appendChild(row);
      bindRow(row);
      addLog(id + ': formularz utworzył rekord i powiadomił zespół');
      refreshStats();
    });

    refreshStats();
  });
});
