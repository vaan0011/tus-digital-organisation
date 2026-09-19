(function(){
 'use strict';
 function ready(fn){ if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn); else fn(); }
 ready(function(){
  var data=window.VTPEventEdit;
  if(!data||!data.event) return;
  var cards=Array.from(document.querySelectorAll('.vtp-event-edit-summary-card'));
  var card=cards.find(function(item){ var h=item.querySelector('h3'); return h&&h.textContent.trim()==='Öffentliche Seite'; });
  if(!card||card.dataset.vtpWorklistLinks==='1') return;
  card.dataset.vtpWorklistLinks='1';
  var heading=card.querySelector('h3');
  if(heading) heading.textContent='Öffentliche Seiten';
  var existing=card.querySelector('a.button');
  var links=document.createElement('div');
  links.className='vtp-event-public-links';
  if(existing) links.appendChild(existing);
  function add(label,url){
   if(!url) return;
   var a=document.createElement('a');
   a.className='button vtp-event-outline-button';
   a.target='_blank';
   a.rel='noopener noreferrer';
   a.href=url;
   a.textContent=label;
   links.appendChild(a);
  }
  add('Aufgabenliste',data.event.tasksUrl);
  add('Schichten / Mitbringen',data.event.teamworkUrl);
  card.appendChild(links);
 });
})();
