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

  var access=window.VTPWorklistAccess;
  if(!access||!access.eventId) return;
  var box=document.createElement('div');
  box.className='vtp-worklist-pin-admin';
  var state=document.createElement('div');
  state.className='vtp-worklist-pin-state';
  state.textContent=access.configured?'Admin-PIN ist gesetzt':'Admin-PIN noch nicht gesetzt';
  box.appendChild(state);
  if(access.saved){
   var saved=document.createElement('div');
   saved.className='vtp-worklist-pin-saved';
   saved.textContent='Admin-PIN gespeichert.';
   box.appendChild(saved);
  }

  var form=document.createElement('form');
  form.method='post';
  form.action=access.actionUrl;
  form.className='vtp-worklist-pin-admin-form';
  function hidden(name,value){ var i=document.createElement('input'); i.type='hidden'; i.name=name; i.value=value; return i; }
  form.appendChild(hidden('action','vtp_save_worklist_pin'));
  form.appendChild(hidden('event_id',String(access.eventId)));
  form.appendChild(hidden('_wpnonce',access.nonce));
  var input=document.createElement('input');
  input.type='password';
  input.name='worklist_pin';
  input.inputMode='numeric';
  input.pattern='[0-9]{4,8}';
  input.minLength=4;
  input.maxLength=8;
  input.autocomplete='new-password';
  input.placeholder=access.configured?'Neuen PIN setzen':'4–8-stelligen PIN setzen';
  input.required=true;
  form.appendChild(input);
  var submit=document.createElement('button');
  submit.type='submit';
  submit.className='button';
  submit.textContent=access.configured?'PIN ändern':'PIN setzen';
  form.appendChild(submit);
  box.appendChild(form);
  var hint=document.createElement('small');
  hint.textContent='Schützt nur die ungefilterten Admin-Gesamtübersichten. Personen- und Mannschaftslinks bleiben direkt erreichbar.';
  box.appendChild(hint);
  card.appendChild(box);
 });
})();
