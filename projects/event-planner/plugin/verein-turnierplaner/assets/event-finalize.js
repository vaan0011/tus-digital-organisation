(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function hidden(name,value){
  var input=document.createElement('input');
  input.type='hidden';
  input.name=name;
  input.value=value;
  return input;
 }

 function findFormByAction(action){
  return Array.from(document.querySelectorAll('form')).find(function(form){
   var field=form.querySelector('input[name="action"]');
   return field && field.value===action;
  }) || null;
 }

 function prepareForm(form,label){
  if(!form) return null;
  if(typeof form.checkValidity==='function' && !form.checkValidity()){
   if(typeof form.reportValidity==='function') form.reportValidity();
   throw new Error('Bitte prüfe die Eingaben im Bereich „'+label+'“.');
  }

  // Die einzelnen Arbeitsblöcke bereiten beim submit ihre dynamischen Felder
  // (Sortierung, Array-Namen usw.) vor. Wir lösen genau diese bestehende
  // Submit-Logik aus, verhindern aber die normale Navigation des Browsers.
  var prevent=function(event){ event.preventDefault(); };
  form.addEventListener('submit',prevent,true);
  try{
   form.dispatchEvent(new Event('submit',{bubbles:true,cancelable:true}));
  } finally {
   form.removeEventListener('submit',prevent,true);
  }

  if(typeof form.checkValidity==='function' && !form.checkValidity()){
   if(typeof form.reportValidity==='function') form.reportValidity();
   throw new Error('Bitte prüfe die Eingaben im Bereich „'+label+'“.');
  }
  return new FormData(form);
 }

 async function responseErrorDetail(response){
  try{
   var text=await response.text();
   if(!text) return '';
   var detail=text;
   if(/<[^>]+>/.test(text)){
    var doc=new DOMParser().parseFromString(text,'text/html');
    detail=(doc.body && doc.body.textContent) ? doc.body.textContent : text;
   }
   detail=detail.replace(/\s+/g,' ').trim();
   if(detail.length>220) detail=detail.slice(0,217)+'…';
   return detail;
  } catch(e){
   return '';
  }
 }

 async function saveForm(form,label){
  var payload=prepareForm(form,label);
  if(!payload) return;

  // Erfolgreiche WordPress-Save-Handler antworten mit einem Redirect zurück zur
  // Eventseite. Beim Gesamtspeicher folgen wir diesem Redirect bewusst nicht:
  // Sonst würde die komplette Eventseite nach jedem einzelnen Block im
  // Hintergrund neu gerendert. Der Redirect selbst ist bereits das
  // Erfolgssignal des bestehenden Save-Handlers.
  var response=await fetch(form.action,{
   method:(form.method||'post').toUpperCase(),
   body:payload,
   credentials:'same-origin',
   redirect:'manual'
  });

  if(response.type==='opaqueredirect' || (response.status>=300 && response.status<400)) return;
  if(response.ok) return;

  var detail=await responseErrorDetail(response);
  throw new Error('„'+label+'“ konnte nicht gespeichert werden.'+(detail?' '+detail:''));
 }

 function reloadAsSaved(){
  var url=new URL(window.location.href);
  ['saved','tasks_saved','shifts_saved','catering_saved','template_saved','event_all_saved'].forEach(function(key){ url.searchParams.delete(key); });
  url.searchParams.set('event_all_saved','1');
  url.hash='vtp-event-finalize';
  window.location.assign(url.toString());
 }

 async function saveEntireEvent(button,status){
  var steps=[
   ['vtp_save_event','Veranstaltungsdaten'],
   ['vtp_save_event_tasks','Aufgaben'],
   ['vtp_save_event_catering','Bewirtung'],
   // Helferschichten bewusst vor dem Ablaufplan speichern. Der Ablaufplan
   // synchronisiert danach Aufbau/Abbau und darf nicht von einem älteren
   // Schichtformular wieder überschrieben werden.
   ['vtp_save_event_shifts','Helferschichten'],
   ['vtp_save_event_items','Ablaufplan und Programmpunkte']
  ];

  var forms=steps.map(function(step){ return [findFormByAction(step[0]),step[1]]; }).filter(function(step){ return !!step[0]; });
  if(!forms.length){
   status.textContent='Es wurden keine speicherbaren Event-Bereiche gefunden.';
   status.className='vtp-finalize-save-status is-error';
   status.hidden=false;
   return;
  }

  var original=button.textContent;
  button.disabled=true;
  button.setAttribute('aria-busy','true');
  button.textContent='Event wird gespeichert …';
  status.hidden=true;

  try{
   for(var i=0;i<forms.length;i++) await saveForm(forms[i][0],forms[i][1]);
   reloadAsSaved();
  } catch(error){
   status.textContent=(error && error.message) ? error.message : 'Event konnte nicht vollständig gespeichert werden.';
   status.className='vtp-finalize-save-status is-error';
   status.hidden=false;
   button.disabled=false;
   button.removeAttribute('aria-busy');
   button.textContent=original;
  }
 }

 function enhanceFinalBlock(data){
  var root=document.querySelector('.wrap.vtp');
  if(!root) return;

  var heading=Array.from(root.querySelectorAll('.vtp-card h2')).find(function(h){
   return h.textContent.trim()==='Archivieren / Löschen';
  });
  if(!heading) return;

  var card=heading.closest('.vtp-card');
  if(!card || card.dataset.vtpFinalizeEnhanced==='1') return;
  card.dataset.vtpFinalizeEnhanced='1';

  var forms=Array.from(card.querySelectorAll('form'));
  var archiveForm=forms.find(function(form){
   var action=form.querySelector('input[name="action"]');
   return action && (action.value==='vtp_archive_event' || action.value==='vtp_restore_event');
  });
  var deleteForm=forms.find(function(form){
   var action=form.querySelector('input[name="action"]');
   return action && action.value==='vtp_delete_event';
  });

  card.className='vtp-card vtp-event-finalize-card';
  card.id='vtp-event-finalize';
  card.innerHTML='';

  var header=document.createElement('div');
  header.className='vtp-event-finalize-header';
  var title=document.createElement('h2');
  title.textContent='Event abschließen';
  var toggle=document.createElement('button');
  toggle.type='button';
  toggle.className='vtp-event-icon-button vtp-finalize-toggle dashicons-before dashicons-arrow-up-alt2';
  toggle.setAttribute('aria-label','Event abschließen einklappen');
  toggle.title='Event abschließen einklappen';
  header.appendChild(title);
  header.appendChild(toggle);
  card.appendChild(header);

  var description=document.createElement('p');
  description.className='description vtp-event-finalize-description';
  description.textContent='Speichere den vollständigen aktuellen Arbeitsstand, lege eine wiederverwendbare Vorlage an, archiviere das Event oder lösche es endgültig.';
  card.appendChild(description);

  var body=document.createElement('div');
  body.className='vtp-event-finalize-body';
  var actions=document.createElement('div');
  actions.className='vtp-event-finalize-actions';

  var saveButton=document.createElement('button');
  saveButton.type='button';
  saveButton.className='button button-primary vtp-finalize-action vtp-finalize-save';
  saveButton.textContent='Event speichern';
  actions.appendChild(saveButton);

  var templateForm=document.createElement('form');
  templateForm.method='post';
  templateForm.action=data.actionUrl;
  templateForm.appendChild(hidden('action','vtp_save_event_template'));
  templateForm.appendChild(hidden('event_id',String(data.eventId)));
  templateForm.appendChild(hidden('_wpnonce',data.nonce));
  var templateButton=document.createElement('button');
  templateButton.type='submit';
  templateButton.className='button vtp-finalize-action vtp-finalize-template';
  templateButton.textContent='Als Vorlage speichern';
  templateForm.appendChild(templateButton);
  actions.appendChild(templateForm);

  if(archiveForm){
   var archiveButton=archiveForm.querySelector('button,input[type="submit"]');
   if(archiveButton){
    archiveButton.classList.remove('button-primary','delete');
    archiveButton.classList.add('vtp-finalize-action','vtp-finalize-archive');
   }
   actions.appendChild(archiveForm);
  }

  if(deleteForm){
   var deleteButton=deleteForm.querySelector('button,input[type="submit"]');
   if(deleteButton){
    deleteButton.classList.remove('button-primary','delete');
    deleteButton.classList.add('vtp-finalize-action','vtp-finalize-danger');
   }
   actions.appendChild(deleteForm);
  }

  var status=document.createElement('p');
  status.className='vtp-finalize-save-status';
  status.hidden=true;
  body.appendChild(status);
  body.appendChild(actions);

  if(new URL(window.location.href).searchParams.get('event_all_saved')==='1'){
   var saved=document.createElement('p');
   saved.className='vtp-finalize-success';
   saved.textContent='Event vollständig gespeichert.';
   body.insertBefore(saved,status);
  }

  if(data.templateSaved){
   var success=document.createElement('p');
   success.className='vtp-finalize-success';
   success.textContent='Vorlage gespeichert bzw. aktualisiert.';
   body.insertBefore(success,status);
  }

  saveButton.addEventListener('click',function(){ saveEntireEvent(saveButton,status); });

  card.appendChild(body);

  toggle.addEventListener('click',function(){
   var collapsed=card.classList.toggle('is-collapsed');
   toggle.classList.toggle('dashicons-arrow-up-alt2',!collapsed);
   toggle.classList.toggle('dashicons-arrow-down-alt2',collapsed);
   toggle.setAttribute('aria-label',collapsed?'Event abschließen aufklappen':'Event abschließen einklappen');
   toggle.title=collapsed?'Event abschließen aufklappen':'Event abschließen einklappen';
  });

  var anchor=document.getElementById('vtp-event-catering') || document.getElementById('vtp-event-shifts');
  if(anchor && anchor.parentNode){
   anchor.insertAdjacentElement('afterend',card);
  }
 }

 function renderLibrary(data){
  var root=document.querySelector('.wrap.vtp');
  if(!root) return;
  var heading=Array.from(root.querySelectorAll('.vtp-card h2')).find(function(h){
   return h.textContent.trim()==='Vorlagen';
  });
  if(!heading) return;
  var card=heading.closest('.vtp-card');
  if(!card) return;

  Array.from(card.children).forEach(function(child){ if(child!==heading) child.remove(); });
  var templates=data.templates||[];
  if(!templates.length){
   var empty=document.createElement('p');
   empty.className='vtp-event-empty';
   empty.textContent='Noch keine Event-Vorlagen vorhanden.';
   card.appendChild(empty);
   return;
  }

  var intro=document.createElement('p');
  intro.className='description';
  intro.textContent='Gespeicherte Vorlagen enthalten die wiederkehrende Event-Struktur ohne feste Jahresdaten.';
  card.appendChild(intro);

  var grid=document.createElement('div');
  grid.className='vtp-template-library-grid';
  templates.forEach(function(item){
   var box=document.createElement('article');
   box.className='vtp-template-library-item';
   var h=document.createElement('h3');
   h.textContent=item.name;
   box.appendChild(h);
   var meta=document.createElement('p');
   meta.textContent=item.days+' Tage · '+item.tasks+' Aufgaben · '+item.shifts+' Helferschichten · '+item.catering+' Bewirtungseinträge';
   box.appendChild(meta);
   var updated=document.createElement('small');
   updated.textContent='Zuletzt aktualisiert: '+item.updated;
   box.appendChild(updated);
   grid.appendChild(box);
  });
  card.appendChild(grid);
 }

 ready(function(){
  var data=window.VTPEventFinalize||{};
  if(data.mode==='edit') enhanceFinalBlock(data);
  if(data.mode==='library') renderLibrary(data);
 });
})();
