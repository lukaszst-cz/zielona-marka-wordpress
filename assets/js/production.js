(() => {
  'use strict';
  const reducedMedia = window.matchMedia('(prefers-reduced-motion: reduce)');
  const saveData = !!(navigator.connection && navigator.connection.saveData);
  const assetBase = (window.ZMTheme && window.ZMTheme.assetBase) || '';
  const forestVideoUrl = (window.ZMTheme && window.ZMTheme.forestVideo) || (assetBase + 'images/brand-review-v5/fern-moss-stream-20260919.mp4');

  function navBehavior() {
    document.querySelectorAll('.zm-mobile-menu a, .zm-offer-menu a').forEach(link => {
      link.addEventListener('click', () => link.closest('details')?.removeAttribute('open'));
    });
    document.addEventListener('click', event => {
      document.querySelectorAll('.zm-offer-menu[open], .zm-mobile-menu[open]').forEach(details => {
        if (!details.contains(event.target)) details.removeAttribute('open');
      });
    });
  }

  function forestHero() {
    const video = document.querySelector('[data-forest-video]');
    const button = document.querySelector('[data-forest-toggle]');
    if (!video || !button) return;
    const entered = Date.now();
    let paused = false, visible = true, ready = false;
    const updateButton = () => {
      if (reducedMedia.matches) {
        button.textContent = 'Spokojny widok'; button.disabled = true; button.setAttribute('aria-pressed','true');
      } else {
        button.disabled = false; button.setAttribute('aria-pressed', paused ? 'true' : 'false');
        button.textContent = paused ? '▶ Ożyw tło' : 'Ⅱ Zatrzymaj tło';
      }
    };
    const update = () => {
      updateButton();
      if (reducedMedia.matches || paused || document.hidden || !visible || saveData || Date.now()-entered < 3000) { video.pause(); return; }
      if (!video.getAttribute('src')) video.src = forestVideoUrl;
      video.play().catch(() => {});
    };
    video.addEventListener('playing', () => { if (!ready) { ready=true; video.classList.add('is-ready'); } });
    button.addEventListener('click', () => { paused=!paused; update(); });
    const observer = new IntersectionObserver(([entry]) => { visible=entry.isIntersecting; update(); });
    observer.observe(video);
    reducedMedia.addEventListener('change', update);
    document.addEventListener('visibilitychange', update);
    window.setTimeout(update, 3000);
    update();
  }

  function livingPortals() {
    document.querySelectorAll('[data-living-portal]').forEach(el => {
      let visible=false, frame=0, paused=false;
      const contact=el.dataset.livingPortal==='contact';
      const video=el.querySelector('[data-water-video]');
      const toggle=el.querySelector('[data-water-toggle]');
      const update=()=> {
        frame=0;
        const rect=el.getBoundingClientRect();
        const progress=Math.max(0,Math.min(1,(innerHeight*.85-rect.top)/(innerHeight*.6)));
        el.style.setProperty('--gather',String(reducedMedia.matches?1:progress));
      };
      const playback=()=> {
        update();
        if (!video) return;
        if (toggle) {
          toggle.disabled=reducedMedia.matches;
          toggle.setAttribute('aria-pressed',String(paused||reducedMedia.matches));
          toggle.textContent=reducedMedia.matches?'Spokojny widok':paused?'Ożyw wodę ↗':'Zatrzymaj wodę Ⅱ';
        }
        if (!visible || document.hidden || reducedMedia.matches || paused || saveData) { video.pause(); return; }
        if (!video.getAttribute('src')) video.src=forestVideoUrl;
        video.play().catch(()=>{});
      };
      const schedule=()=>{ if (visible && !frame) frame=requestAnimationFrame(update); };
      const observer=new IntersectionObserver(([entry])=>{ visible=entry.isIntersecting; playback(); });
      observer.observe(el);
      reducedMedia.addEventListener('change',playback);
      document.addEventListener('visibilitychange',playback);
      addEventListener('scroll',schedule,{passive:true}); addEventListener('resize',schedule,{passive:true});
      toggle?.addEventListener('click',()=>{paused=!paused;playback();});
      el.addEventListener('pointermove',event=>{
        if(event.pointerType!=='mouse'||reducedMedia.matches)return;
        const rect=el.getBoundingClientRect();
        el.style.setProperty('--tilt',(((event.clientX-rect.left)/rect.width-.5)*5)+'deg');
      });
      el.addEventListener('pointerleave',()=>el.style.setProperty('--tilt','0deg'));
      if (!contact) update();
      playback();
    });
  }

  function storyMotion() {
    const page=document.querySelector('.zm-v5');
    const container=page?.querySelector('.zmh-cinema');
    const holder=page?.querySelector('[data-cinema-shots]');
    const screen=page?.querySelector('.zmh-cinema-screen');
    const counter=page?.querySelector('.cinema-counter');
    const toggle=page?.querySelector('[data-story-motion-toggle]');
    if(!page||!container||!holder||!screen||!toggle)return;
    const stages=[...page.querySelectorAll('.zmh-cinema-chapters > .zmh-story')];
    const dots=[...page.querySelectorAll('.zmh-cinema-dots i')];
    stages.forEach((stage,index)=>{
      const shot=document.createElement('div'); shot.className='zmh-cine-shot'; shot.dataset.stage=String(index);
      shot.innerHTML=stage.querySelector('.zmh-visual')?.innerHTML||''; holder.append(shot);
    });
    const shots=[...holder.children];
    let frame=0,visible=false,current=-1,pointerX=0,pointerY=0,motionOff=false,enabled=!reducedMedia.matches;
    const update=()=>{
      frame=0;if(!enabled)return;
      const probe=innerHeight*.46;let active=0,local=0;
      stages.forEach((stage,index)=>{const rect=stage.getBoundingClientRect();if(rect.top<probe){active=index;local=Math.min(1,Math.max(0,(probe-rect.top)/rect.height));}});
      if(active!==current){
        current=active;
        stages.forEach((stage,index)=>{
          stage.classList.toggle('zmh-is-current',index===active);stage.classList.toggle('zmh-is-past',index<active);
          shots[index]?.classList.toggle('zmh-is-current',index===active);dots[index]?.classList.toggle('zmh-is-current',index<=active);
        });
        if(counter)counter.textContent=String(active+1).padStart(2,'0')+' / 05';
      }
      screen.style.setProperty('--film-progress',String((active+local)/Math.max(1,stages.length)));
      screen.style.setProperty('--scene-drift',String(local));
      const entry=Math.min(1,Math.max(0,(innerHeight-container.getBoundingClientRect().top)/(innerHeight*.8)));
      screen.style.setProperty('--portal-entry',String(entry));screen.style.setProperty('--pointer-x',String(pointerX));screen.style.setProperty('--pointer-y',String(pointerY));
      page.style.setProperty('--forest-drift',String(Math.min(1,scrollY/Math.max(1,container.offsetTop+container.offsetHeight))));
    };
    const applyState=()=>{
      enabled=!reducedMedia.matches&&!motionOff;page.classList.toggle('zmh-cinema-enhanced',enabled);
      toggle.disabled=reducedMedia.matches;toggle.setAttribute('aria-pressed',String(motionOff||reducedMedia.matches));
      toggle.textContent=reducedMedia.matches?'Ruch ograniczony':motionOff?'Włącz animacje':'Ogranicz ruch';
      if(!enabled)page.style.removeProperty('--forest-drift');else update();
    };
    const schedule=()=>{if(enabled&&visible&&!frame)frame=requestAnimationFrame(update);};
    const observer=new IntersectionObserver(([entry])=>{visible=entry.isIntersecting;page.classList.toggle('zmh-motion-outside',!visible);if(visible)schedule();},{rootMargin:'200px 0px'});
    observer.observe(container);
    addEventListener('scroll',schedule,{passive:true});addEventListener('resize',schedule,{passive:true});
    container.addEventListener('pointermove',event=>{if(event.pointerType!=='mouse'||!enabled)return;const rect=container.getBoundingClientRect();pointerX=Math.max(-1,Math.min(1,(event.clientX-rect.left)/rect.width*2-1));pointerY=Math.max(-1,Math.min(1,event.clientY/innerHeight*2-1));schedule();},{passive:true});
    container.addEventListener('pointerleave',()=>{pointerX=0;pointerY=0;schedule();});
    toggle.addEventListener('click',()=>{motionOff=!motionOff;applyState();});reducedMedia.addEventListener('change',applyState);applyState();
  }

  function cookieConsent() {
    const banner=document.querySelector('[data-cookie-consent]');if(!banner)return;
    const key='zm_cookie_choice_v1';
    const show=()=>{banner.hidden=false;};
    const hide=choice=>{localStorage.setItem(key,choice);banner.hidden=true;document.dispatchEvent(new CustomEvent('zm-cookie-choice',{detail:{choice}}));};
    if(!localStorage.getItem(key))show();
    banner.querySelectorAll('[data-cookie-choice]').forEach(button=>button.addEventListener('click',()=>hide(button.dataset.cookieChoice)));
    document.querySelectorAll('[data-cookie-settings]').forEach(button=>button.addEventListener('click',show));
  }

  function formSendingState() {
    document.querySelectorAll('form[action*="admin-post.php"]').forEach(form=>form.addEventListener('submit',()=>{
      const button=form.querySelector('button[type="submit"]');if(button){button.disabled=true;button.textContent='Wysyłam…';}
    }));
  }

  function init(){navBehavior();forestHero();livingPortals();storyMotion();cookieConsent();formSendingState();}
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init,{once:true});else init();
})();