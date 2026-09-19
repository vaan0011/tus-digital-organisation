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
  description.textContent='Speichere den aktuellen Plan als wiederverwendbare Vorlage, archiviere das Event oder lösche es endgültig.';
  card.appendChild(description);

  var body=document.createElement('div');
  body.className='vtp-event-finalize-body';
  var actions=document.createElement('div');
  actions.className='vtp-event-finalize-actions';

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

  body.appendChild(actions);

  if(data.templateSaved){
   var success=document.createElement('p');
   success.className='vtp-finalize-success';
   success.textContent='Vorlage gespeichert bzw. aktualisiert.';
   body.insertBefore(success,actions);
  }

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
