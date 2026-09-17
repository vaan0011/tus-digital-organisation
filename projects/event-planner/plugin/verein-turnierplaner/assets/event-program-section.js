(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function setState(card,button,collapsed){
  card.classList.toggle('is-section-collapsed',collapsed);
  button.setAttribute('aria-expanded',collapsed?'false':'true');
  button.classList.remove('dashicons-arrow-up-alt2','dashicons-arrow-down-alt2');
  button.classList.add(collapsed?'dashicons-arrow-down-alt2':'dashicons-arrow-up-alt2');
  button.setAttribute('aria-label',collapsed?'Ablaufplanung aufklappen':'Ablaufplanung einklappen');
  button.title=collapsed?'Ablaufplanung aufklappen':'Ablaufplanung einklappen';
 }

 ready(function(){
  var card=document.querySelector('.vtp-event-program-card');
  if(!card || card.dataset.vtpSectionCollapse==='1') return;
  card.dataset.vtpSectionCollapse='1';

  var heading=card.querySelector(':scope > h2');
  if(!heading) return;

  var header=document.createElement('div');
  header.className='vtp-event-program-section-header';
  heading.insertAdjacentElement('beforebegin',header);
  header.appendChild(heading);

  var toggle=document.createElement('button');
  toggle.type='button';
  toggle.className='vtp-event-icon-button vtp-event-program-section-toggle dashicons-before dashicons-arrow-up-alt2';
  toggle.setAttribute('aria-expanded','true');
  toggle.setAttribute('aria-label','Ablaufplanung einklappen');
  toggle.title='Ablaufplanung einklappen';
  header.appendChild(toggle);

  toggle.addEventListener('click',function(){
   setState(card,toggle,!card.classList.contains('is-section-collapsed'));
  });
 });
})();
