
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting)e.target.classList.add('visible')}),{threshold:.16});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

const scrollSteps=[...document.querySelectorAll('.scroll-step')];
const states=[...document.querySelectorAll('.stage-state')];
const rails=[...document.querySelectorAll('.progress-rail i')];
const storyObserver=new IntersectionObserver(entries=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      const i=Number(entry.target.dataset.stage||0);
      scrollSteps.forEach((s,n)=>s.classList.toggle('active',n===i));
      states.forEach((s,n)=>s.classList.toggle('active',n===i));
      rails.forEach((r,n)=>r.classList.toggle('active',n===i));
    }
  })
},{threshold:.58,rootMargin:"-12% 0px -12% 0px"});
scrollSteps.forEach(s=>storyObserver.observe(s));



const contactForm=document.querySelector('.contact-card');
const areaSelect=contactForm?.querySelector('select[name="area"]');
const formIntent=contactForm?.querySelector('.form-intent');
document.querySelectorAll('.intent-link').forEach(link=>{
  link.addEventListener('click',()=>{
    const area=link.dataset.area;
    if(areaSelect && area){
      areaSelect.value=area;
      if(formIntent) formIntent.textContent=`Wybrano: ${area}. Możesz zmienić ten wybór w formularzu.`;
    }
  });
});

function handlePrototypeSubmit(event){
  event.preventDefault();
  const form=event.currentTarget;
  if(!form.reportValidity()) return false;
  form.querySelector('.form-body').hidden=true;
  form.querySelector('.form-success').hidden=false;
  form.querySelector('.form-success').scrollIntoView({behavior:'smooth',block:'center'});
  return false;
}
function resetPrototypeForm(){
  const form=document.querySelector('.contact-card');
  if(!form) return;
  form.querySelector('.form-body').hidden=false;
  form.querySelector('.form-success').hidden=true;
}

const mobileContactBar=document.querySelector('.mobile-contact-bar');
function updateMobileContactBar(){
  if(!mobileContactBar) return;
  if(window.innerWidth>760){mobileContactBar.classList.remove('is-visible');return;}
  const contact=document.querySelector('#kontakt');
  const contactTop=contact?contact.getBoundingClientRect().top:Infinity;
  const shouldShow=window.scrollY>window.innerHeight*.72 && contactTop>window.innerHeight*.42;
  mobileContactBar.classList.toggle('is-visible',shouldShow);
}
window.addEventListener('scroll',updateMobileContactBar,{passive:true});
window.addEventListener('resize',updateMobileContactBar);
updateMobileContactBar();
