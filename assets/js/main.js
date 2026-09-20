document.addEventListener('DOMContentLoaded', () => {
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const productionMedia = 'https://zielona-marka.pl/brand-review-v5/fern-moss-stream-20260919.mp4';

  document.querySelectorAll('.mobile-menu a, .zm-mobile-menu a').forEach((link) => {
    link.addEventListener('click', () => {
      const details = link.closest('details');
      if (details) details.removeAttribute('open');
    });
  });

  document.querySelectorAll('.zm-nav details').forEach((details) => {
    details.addEventListener('toggle', () => {
      if (!details.open) return;
      document.querySelectorAll('.zm-nav details').forEach((other) => {
        if (other !== details) other.removeAttribute('open');
      });
    });
  });

  document.addEventListener('click', (event) => {
    if (event.target.closest('.zm-nav details')) return;
    document.querySelectorAll('.zm-nav details[open]').forEach((details) => details.removeAttribute('open'));
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    document.querySelectorAll('.zm-nav details[open]').forEach((details) => details.removeAttribute('open'));
  });

  document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      const id = link.getAttribute('href');
      if (!id || id === '#') return;
      const target = document.querySelector(id);
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: reducedMotion.matches ? 'auto' : 'smooth' });
      history.replaceState(null, '', id);
    });
  });

  const forestVideo = document.querySelector('[data-zm-forest-video]');
  const forestControl = document.querySelector('[data-zm-film-control]');
  if (forestVideo && forestControl) {
    let paused = false;
    let visible = true;
    const entered = Date.now();
    const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;

    const updateForest = () => {
      const reduced = reducedMotion.matches;
      forestControl.disabled = reduced;
      forestControl.setAttribute('aria-pressed', (paused || reduced) ? 'true' : 'false');
      forestControl.textContent = reduced ? 'Spokojny widok' : (paused ? '▶ Ożyw tło' : 'Ⅱ Zatrzymaj tło');

      if (reduced || paused || document.hidden || !visible || (connection && connection.saveData) || Date.now() - entered < 3000) {
        forestVideo.pause();
        return;
      }
      if (!forestVideo.getAttribute('src')) forestVideo.src = productionMedia;
      forestVideo.play().catch(() => {});
    };

    forestVideo.addEventListener('playing', () => forestVideo.classList.add('is-ready'));
    forestControl.addEventListener('click', () => {
      paused = !paused;
      updateForest();
    });

    const observer = new IntersectionObserver(([entry]) => {
      visible = entry.isIntersecting;
      updateForest();
    });
    observer.observe(forestVideo);

    const introTimer = window.setTimeout(updateForest, 3000);
    reducedMotion.addEventListener('change', updateForest);
    document.addEventListener('visibilitychange', updateForest);
    updateForest();

    window.addEventListener('beforeunload', () => {
      window.clearTimeout(introTimer);
      observer.disconnect();
      forestVideo.pause();
    }, { once: true });
  }

  document.querySelectorAll('[data-zm-assembly]').forEach((root) => {
    let visible = false;
    let frame = 0;
    const update = () => {
      frame = 0;
      const rect = root.getBoundingClientRect();
      const progress = Math.max(0, Math.min(1, (innerHeight * 0.85 - rect.top) / (innerHeight * 0.6)));
      root.style.setProperty('--gather', String(reducedMotion.matches ? 1 : progress));
    };
    const schedule = () => {
      if (visible && !frame) frame = requestAnimationFrame(update);
    };
    const observer = new IntersectionObserver(([entry]) => {
      visible = entry.isIntersecting;
      update();
    });
    observer.observe(root);
    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });
    reducedMotion.addEventListener('change', update);
    root.addEventListener('pointermove', (event) => {
      if (event.pointerType !== 'mouse' || reducedMotion.matches) return;
      const rect = root.getBoundingClientRect();
      root.style.setProperty('--tilt', (((event.clientX - rect.left) / rect.width - 0.5) * 5) + 'deg');
    });
    root.addEventListener('pointerleave', () => root.style.setProperty('--tilt', '0deg'));
    update();
  });

  const waterRoot = document.querySelector('[data-zm-water-portal]');
  const waterVideo = document.querySelector('[data-zm-water-video]');
  const waterControl = document.querySelector('[data-zm-water-control]');
  if (waterRoot && waterVideo && waterControl) {
    let visible = false;
    let paused = false;
    let frame = 0;

    const updateGather = () => {
      frame = 0;
      const rect = waterRoot.getBoundingClientRect();
      const progress = Math.max(0, Math.min(1, (innerHeight * 0.85 - rect.top) / (innerHeight * 0.6)));
      waterRoot.style.setProperty('--gather', String(reducedMotion.matches ? 1 : progress));
    };

    const playback = () => {
      const reduced = reducedMotion.matches;
      waterControl.disabled = reduced;
      waterControl.setAttribute('aria-pressed', (paused || reduced) ? 'true' : 'false');
      waterControl.textContent = reduced ? 'Spokojny widok' : (paused ? 'Ożyw wodę ↗' : 'Zatrzymaj wodę Ⅱ');
      updateGather();
      if (!visible || document.hidden || reduced || paused) {
        waterVideo.pause();
        return;
      }
      const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
      if (connection && connection.saveData) return;
      if (!waterVideo.getAttribute('src')) waterVideo.src = productionMedia;
      waterVideo.play().catch(() => {});
    };

    const observer = new IntersectionObserver(([entry]) => {
      visible = entry.isIntersecting;
      playback();
    });
    observer.observe(waterRoot);

    const schedule = () => {
      if (visible && !frame) frame = requestAnimationFrame(updateGather);
    };
    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });
    document.addEventListener('visibilitychange', playback);
    reducedMotion.addEventListener('change', playback);
    waterControl.addEventListener('click', () => {
      paused = !paused;
      playback();
    });
    waterRoot.addEventListener('pointermove', (event) => {
      if (event.pointerType !== 'mouse' || reducedMotion.matches) return;
      const rect = waterRoot.getBoundingClientRect();
      waterRoot.style.setProperty('--tilt', (((event.clientX - rect.left) / rect.width - 0.5) * 5) + 'deg');
    });
    waterRoot.addEventListener('pointerleave', () => waterRoot.style.setProperty('--tilt', '0deg'));
    playback();
  }

  const motionRoot = document.querySelector('.zm-v5');
  const cinema = motionRoot && motionRoot.querySelector('.zmh-cinema');
  const cinemaScreen = motionRoot && motionRoot.querySelector('.zmh-cinema-screen');
  const shotsHolder = motionRoot && motionRoot.querySelector('.zmh-cinema-shots');
  const motionToggle = motionRoot && motionRoot.querySelector('[data-zm-motion-toggle]');
  if (motionRoot && cinema && cinemaScreen && shotsHolder) {
    const stages = Array.from(motionRoot.querySelectorAll('.zmh-cinema-chapters > .zmh-story'));
    const counter = motionRoot.querySelector('.cinema-counter');
    const dots = Array.from(motionRoot.querySelectorAll('.zmh-cinema-dots i'));
    let motionOff = false;
    let frame = 0;
    let visible = false;
    let current = -1;
    let pointerX = 0;
    let pointerY = 0;

    shotsHolder.replaceChildren();
    stages.forEach((stage, index) => {
      const shot = document.createElement('div');
      shot.className = 'zmh-cine-shot';
      shot.dataset.stage = String(index);
      const visual = stage.querySelector('.zmh-visual');
      shot.innerHTML = visual ? visual.innerHTML : '';
      shotsHolder.append(shot);
    });
    const shots = Array.from(shotsHolder.children);

    const isEnabled = () => !reducedMotion.matches && !motionOff;

    const update = () => {
      frame = 0;
      const probe = window.innerHeight * 0.46;
      let active = 0;
      let local = 0;

      stages.forEach((stage, index) => {
        const rect = stage.getBoundingClientRect();
        if (rect.top < probe) {
          active = index;
          local = Math.min(1, Math.max(0, (probe - rect.top) / rect.height));
        }
      });

      if (active !== current) {
        current = active;
        stages.forEach((stage, index) => {
          stage.classList.toggle('zmh-is-current', index === active);
          stage.classList.toggle('zmh-is-past', index < active);
          if (shots[index]) shots[index].classList.toggle('zmh-is-current', index === active);
          if (dots[index]) dots[index].classList.toggle('zmh-is-current', index <= active);
        });
        if (counter) counter.textContent = String(active + 1).padStart(2, '0') + ' / 05';
      }

      cinemaScreen.style.setProperty('--film-progress', String((active + local) / stages.length));
      cinemaScreen.style.setProperty('--scene-drift', String(local));
      const entry = Math.min(1, Math.max(0, (window.innerHeight - cinema.getBoundingClientRect().top) / (window.innerHeight * 0.8)));
      cinemaScreen.style.setProperty('--portal-entry', String(entry));
      cinemaScreen.style.setProperty('--pointer-x', String(pointerX));
      cinemaScreen.style.setProperty('--pointer-y', String(pointerY));
      motionRoot.style.setProperty('--forest-drift', String(Math.min(1, window.scrollY / Math.max(1, cinema.offsetTop + cinema.offsetHeight))));
    };

    const refreshPreference = () => {
      const enabled = isEnabled();
      motionRoot.classList.toggle('zmh-cinema-enhanced', enabled);
      if (motionToggle) {
        motionToggle.disabled = reducedMotion.matches;
        motionToggle.setAttribute('aria-pressed', (motionOff || reducedMotion.matches) ? 'true' : 'false');
        motionToggle.textContent = reducedMotion.matches ? 'Ruch ograniczony' : (motionOff ? 'Włącz animacje' : 'Ogranicz ruch');
      }
      if (enabled) update();
      else {
        window.cancelAnimationFrame(frame);
        frame = 0;
        motionRoot.style.removeProperty('--forest-drift');
      }
    };

    const schedule = () => {
      if (isEnabled() && visible && !frame) frame = window.requestAnimationFrame(update);
    };

    const pointerMove = (event) => {
      if (event.pointerType !== 'mouse' || !isEnabled()) return;
      const rect = cinema.getBoundingClientRect();
      pointerX = Math.max(-1, Math.min(1, (event.clientX - rect.left) / rect.width * 2 - 1));
      pointerY = Math.max(-1, Math.min(1, event.clientY / window.innerHeight * 2 - 1));
      schedule();
    };

    const observer = new IntersectionObserver(([entry]) => {
      visible = entry.isIntersecting;
      motionRoot.classList.toggle('zmh-motion-outside', !visible);
      if (visible) schedule();
    }, { rootMargin: '200px 0px' });
    observer.observe(cinema);

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });
    cinema.addEventListener('pointermove', pointerMove, { passive: true });
    cinema.addEventListener('pointerleave', () => {
      pointerX = 0;
      pointerY = 0;
      schedule();
    });
    reducedMotion.addEventListener('change', refreshPreference);
    if (motionToggle) motionToggle.addEventListener('click', () => {
      motionOff = !motionOff;
      refreshPreference();
    });
    refreshPreference();
  }

  document.querySelectorAll('[data-estimator]').forEach((box) => {
    const type = box.querySelector('[data-estimator-type]');
    const copy = box.querySelector('[data-estimator-copy]');
    const google = box.querySelector('[data-estimator-google]');
    const value = box.querySelector('[data-estimator-value]');
    const update = () => {
      const total = Number(type ? type.value : 0) + (copy && copy.checked ? 650 : 0) + (google && google.checked ? 490 : 0);
      if (value) value.textContent = new Intl.NumberFormat('pl-PL').format(total) + ' zł';
    };
    [type, copy, google].forEach((field) => { if (field) field.addEventListener('change', update); });
    update();
  });

  document.querySelectorAll('[data-demo-assistant]').forEach((assistant) => {
    const panel = assistant.querySelector('[role="dialog"]');
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
    document.querySelectorAll('[data-open-demo-assistant], [data-open-demo-kontakt]').forEach((button) => {
      button.addEventListener('click', () => setOpen(true));
    });

    assistant.querySelectorAll('[data-demo-goal]').forEach((button) => {
      button.addEventListener('click', () => {
        const goal = button.getAttribute('data-demo-goal') || '';
        if (goalLabel) goalLabel.textContent = goal;
        if (goalInput) goalInput.value = goal;
        if (prices) prices.hidden = goal !== 'Ceny i terminy';
        showStep('industry');
      });
    });

    assistant.querySelectorAll('[data-demo-industry]').forEach((button) => {
      button.addEventListener('click', () => {
        const industry = button.getAttribute('data-demo-industry') || '';
        if (industryLabel) industryLabel.textContent = industry;
        if (industryInput) industryInput.value = industry;
        showStep('form');
      });
    });

    assistant.querySelectorAll('[data-demo-back]').forEach((button) => {
      button.addEventListener('click', () => {
        const back = button.getAttribute('data-demo-back');
        showStep(back === 'goal' ? 'goal' : 'industry');
      });
    });
  });

  document.querySelectorAll('[data-status-form]').forEach((form) => {
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const input = form.querySelector('input[name="code"]');
      const clean = input ? input.value.trim().toUpperCase() : '';
      if (clean) window.location.href = '/status/' + encodeURIComponent(clean);
    });
  });

  document.querySelectorAll('[data-industry-demo]').forEach((demo) => {
    const configNode = document.querySelector('[data-demo-config]');
    let config = { stages: [], newName: 'Nowy rekord', newValue: 0 };
    try { if (configNode) config = JSON.parse(configNode.textContent || '{}'); } catch (error) {}

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
      const values = [String(rows.length), Math.round((totalStage / Math.max(1, rows.length * stages)) * 100) + '%', new Intl.NumberFormat('pl-PL').format(totalValue) + ' zł', String(progressed)];
      demo.querySelectorAll('[data-demo-stat]').forEach((node) => { node.textContent = values[Number(node.getAttribute('data-demo-stat') || 0)] || '0'; });
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
