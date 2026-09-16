(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function button(label,url,extraClass){
  var a=document.createElement('a');
  a.className='button vtp-event-edit-nav-button'+(extraClass?' '+extraClass:'');
  a.href=url;
  a.textContent=label;
  return a;
 }

 function findCardByHeading(root,label){
  var headings=Array.from(root.querySelectorAll('.vtp-card h2'));
  var heading=headings.find(function(h){ return h.textContent.trim()===label; });
  return heading ? heading.closest('.vtp-card') : null;
 }

 function statusCard(metric,label,status,state){
  var div=document.createElement('div');
  div.className='vtp-event-progress-card is-'+state;
  div.innerHTML='<div class="vtp-event-progress-metric">'+metric+'</div><div class="vtp-event-progress-label">'+label+'</div><div class="vtp-event-progress-state">'+status+'</div>';
  return div;
 }

 function buildSummary(root,data,legacyEditor){
  var section=document.createElement('section');
  section.className='vtp-card vtp-event-edit-summary';
  var title=document.createElement('h2');
  title.textContent='Event bearbeiten';
  section.appendChild(title);

  var grid=document.createElement('div');
  grid.className='vtp-event-edit-summary-grid';

  var eventCard=document.createElement('div');
  eventCard.className='vtp-event-edit-summary-card';
  eventCard.innerHTML='<div class="vtp-event-edit-card-head"><h3>Veranstaltungsdaten</h3><button type="button" class="vtp-event-icon-button vtp-edit-event-data dashicons-before dashicons-edit" aria-label="Veranstaltungsdaten bearbeiten" title="Veranstaltungsdaten bearbeiten"></button></div>'+
   '<strong class="vtp-event-edit-name"></strong><span class="vtp-event-edit-date"></span><span class="vtp-event-edit-location"></span>';
  eventCard.querySelector('.vtp-event-edit-name').textContent=data.event.name;
  eventCard.querySelector('.vtp-event-edit-date').textContent=data.event.dateLabel;
  eventCard.querySelector('.vtp-event-edit-location').textContent=data.event.location;
  grid.appendChild(eventCard);

  var publicCard=document.createElement('div');
  publicCard.className='vtp-event-edit-summary-card';
  publicCard.innerHTML='<h3>Öffentliche Seite</h3><a class="button vtp-event-outline-button" target="_blank" rel="noopener noreferrer">Programm öffnen</a>';
  publicCard.querySelector('a').href=data.event.publicUrl;
  grid.appendChild(publicCard);

  var tournamentCard=document.createElement('div');
  tournamentCard.className='vtp-event-edit-summary-card';
  tournamentCard.innerHTML='<h3>Verknüpfte Turniere</h3>';
  if(data.linkedTournaments && data.linkedTournaments.length){
   var list=document.createElement('ul');
   list.className='vtp-event-linked-list';
   data.linkedTournaments.forEach(function(t){
    var li=document.createElement('li');
    var meta=[t.date,t.time ? t.time+' Uhr' : ''].filter(Boolean).join(' · ');
    li.innerHTML='<strong></strong>'+(meta?'<span></span>':'');
    li.querySelector('strong').textContent=t.name;
    if(meta) li.querySelector('span').textContent=meta;
    list.appendChild(li);
   });
   tournamentCard.appendChild(list);
  } else {
   var empty=document.createElement('p');
   empty.className='description';
   empty.textContent='Noch keine Turniere verknüpft.';
   tournamentCard.appendChild(empty);
  }
  grid.appendChild(tournamentCard);
  section.appendChild(grid);

  section.querySelector('.vtp-edit-event-data').addEventListener('click',function(){
   legacyEditor.classList.toggle('is-open');
   this.classList.toggle('is-active');
   if(legacyEditor.classList.contains('is-open')){
    legacyEditor.scrollIntoView({behavior:'smooth',block:'start'});
    var first=legacyEditor.querySelector('input[name="name"]');
    if(first) window.setTimeout(function(){ first.focus(); },250);
   }
  });

  return section;
 }

 function buildProgress(data){
  var p=data.progress;
  var section=document.createElement('section');
  section.className='vtp-card vtp-event-progress-section';
  var grid=document.createElement('div');
  grid.className='vtp-event-progress-grid';

  grid.appendChild(statusCard(String(p.days),'Tage','Event erstellt','done'));

  var programDone=!!p.programPublished;
  grid.appendChild(statusCard(String(p.programCount),'Programmpunkte',programDone?'veröffentlicht':'noch nicht veröffentlicht',programDone?'done':'open'));

  var taskMetric=p.tasksAvailable ? (p.tasksDone+'/'+p.tasksTotal) : '0';
  var taskStatus=p.tasksAvailable ? (p.tasksTotal>0 && p.tasksDone>=p.tasksTotal ? 'erledigt' : 'noch offen') : 'noch nicht geplant';
  var taskDone=p.tasksAvailable && p.tasksTotal>0 && p.tasksDone>=p.tasksTotal;
  grid.appendChild(statusCard(taskMetric,'Aufgaben',taskStatus,taskDone?'done':'open'));

  var shiftsDone=p.shiftsTotal>0 && p.shiftsFull>=p.shiftsTotal;
  var shiftsStatus=p.shiftsTotal===0 ? 'noch nicht geplant' : (shiftsDone ? 'belegt' : ((p.shiftsTotal-p.shiftsFull)+' offen'));
  grid.appendChild(statusCard(p.shiftsFull+'/'+p.shiftsTotal,'Schichten',shiftsStatus,shiftsDone?'done':'open'));

  var helpersDone=p.helpersNeeded>0 && p.helpersFilled>=p.helpersNeeded;
  var helpersStatus=p.helpersNeeded===0 ? 'noch nicht geplant' : (helpersDone ? 'organisiert' : (Math.max(0,p.helpersNeeded-p.helpersFilled)+' offen'));
  grid.appendChild(statusCard(p.helpersFilled+'/'+p.helpersNeeded,'Helfer',helpersStatus,helpersDone?'done':'open'));

  section.appendChild(grid);
  return section;
 }

 function iconizeToggle(button,collapsed){
  button.textContent='';
  button.classList.add('vtp-event-icon-button','dashicons-before');
  button.classList.remove('dashicons-arrow-up-alt2','dashicons-arrow-down-alt2');
  button.classList.add(collapsed?'dashicons-arrow-down-alt2':'dashicons-arrow-up-alt2');
  button.setAttribute('aria-label',collapsed?'Tag aufklappen':'Tag einklappen');
  button.title=collapsed?'Tag aufklappen':'Tag einklappen';
 }

 function enhanceDays(programCard){
  var form=programCard.querySelector('form');
  var box=programCard.querySelector('#vtp-event-days');
  if(!form || !box) return;

  var existingAdd=form.querySelector('#vtp-add-day');
  if(existingAdd && !existingAdd.dataset.moved){
   existingAdd.dataset.moved='1';
   existingAdd.classList.add('vtp-event-add-day');
   existingAdd.textContent='Neuen Tag hinzufügen';
   var addRow=document.createElement('div');
   addRow.className='vtp-event-add-row';
   addRow.appendChild(existingAdd);
   form.insertBefore(addRow,box);
   var oldP=Array.from(form.querySelectorAll('p')).find(function(p){ return p.contains(existingAdd) && p!==addRow; });
   if(oldP && oldP.childElementCount===0) oldP.remove();
  }

  function enhanceCard(card){
   if(card.dataset.vtpUiEnhanced==='1') return;
   card.dataset.vtpUiEnhanced='1';
   card.classList.add('is-collapsed','vtp-event-day-card');

   var head=card.querySelector('.vtp-day-head');
   var actions=card.querySelector('.vtp-day-actions');
   var body=card.querySelector('.vtp-day-body');
   var date=card.querySelector('.vtp-day-date');
   if(!head || !actions || !body || !date) return;

   date.readOnly=true;
   date.classList.add('is-locked');

   var toggle=actions.querySelector('.vtp-toggle-day');
   var duplicate=actions.querySelector('.vtp-duplicate-day');
   var addProgram=actions.querySelector('.vtp-add-program');
   var remove=actions.querySelector('.vtp-remove-day');
   if(duplicate) duplicate.hidden=true;

   if(toggle) iconizeToggle(toggle,true);

   var edit=document.createElement('button');
   edit.type='button';
   edit.className='vtp-event-icon-button vtp-edit-day dashicons-before dashicons-edit';
   edit.setAttribute('aria-label','Tag bearbeiten');
   edit.title='Tag bearbeiten';

   var save=document.createElement('button');
   save.type='button';
   save.className='vtp-event-icon-button vtp-save-day dashicons-before dashicons-saved';
   save.setAttribute('aria-label','Programm speichern');
   save.title='Programm speichern';

   if(remove){
    remove.textContent='';
    remove.classList.add('vtp-event-icon-button','dashicons-before','dashicons-trash');
    remove.setAttribute('aria-label','Tag löschen');
    remove.title='Tag löschen';
   }

   if(toggle) toggle.insertAdjacentElement('afterend',edit); else actions.prepend(edit);
   edit.insertAdjacentElement('afterend',save);

   if(addProgram){
    addProgram.textContent='Programmpunkt hinzufügen';
    addProgram.classList.add('vtp-event-add-program');
    body.insertBefore(addProgram,body.firstChild);
   }

   edit.addEventListener('click',function(){
    date.readOnly=false;
    date.classList.remove('is-locked');
    card.classList.add('is-editing');
    try{ date.showPicker ? date.showPicker() : date.focus(); }catch(e){ date.focus(); }
   });

   save.addEventListener('click',function(){
    date.readOnly=true;
    date.classList.add('is-locked');
    card.classList.remove('is-editing');
    if(form.requestSubmit) form.requestSubmit(); else form.submit();
   });
  }

  Array.from(box.querySelectorAll('.vtp-day-card')).forEach(enhanceCard);

  var observer=new MutationObserver(function(){
   Array.from(box.querySelectorAll('.vtp-day-card')).forEach(enhanceCard);
  });
  observer.observe(box,{childList:true,subtree:false});

  document.addEventListener('click',function(e){
   var toggle=e.target.closest && e.target.closest('.vtp-toggle-day');
   if(toggle){
    window.setTimeout(function(){
     var card=toggle.closest('.vtp-day-card');
     iconizeToggle(toggle,card && card.classList.contains('is-collapsed'));
    },0);
   }
   if(e.target && e.target.id==='vtp-add-day'){
    window.setTimeout(function(){ Array.from(box.querySelectorAll('.vtp-day-card')).forEach(enhanceCard); },0);
   }
  });
 }

 ready(function(){
  var data=window.VTPEventEdit;
  if(!data || !data.event) return;
  var root=document.querySelector('.wrap.vtp.vtp-modern');
  if(!root || root.classList.contains('vtp-event-edit-v1')) return;
  root.classList.add('vtp-event-edit-v1');

  var h1=root.querySelector('h1');
  if(h1) h1.textContent='Events: TuS Veranstaltungen bearbeiten';
  if(h1 && !root.querySelector('.vtp-event-edit-subtitle')){
   var subtitle=document.createElement('p');
   subtitle.className='description vtp-event-edit-subtitle';
   subtitle.textContent='Veranstaltungen bearbeiten, planen, veröffentlichen, archivieren oder löschen.';
   h1.insertAdjacentElement('afterend',subtitle);
  }

  var nav=root.querySelector('.vtp-view-tabs');
  if(nav){
   nav.innerHTML='';
   nav.classList.add('vtp-event-edit-nav');
   nav.appendChild(button('neues Event',data.navigation.new));
   nav.appendChild(button('aktive Events',data.navigation.overview));
   nav.appendChild(button('Vorlagen',data.navigation.templates));
   nav.appendChild(button('Archiv',data.navigation.archive));
  }

  var legacyEditor=Array.from(root.querySelectorAll('.vtp-card.vtp-wide')).find(function(card){
   var heading=card.querySelector('h2');
   return heading && heading.textContent.trim()==='Event bearbeiten';
  });
  if(!legacyEditor) return;
  legacyEditor.classList.add('vtp-event-data-editor');

  var publicCard=findCardByHeading(root,'Öffentliche Seiten');
  var linkedCard=findCardByHeading(root,'Verknüpfte Turniere');
  if(publicCard && publicCard.parentElement) publicCard.parentElement.classList.add('vtp-event-legacy-top-grid');
  if(linkedCard && linkedCard.parentElement) linkedCard.parentElement.classList.add('vtp-event-legacy-top-grid');

  var oldStatus=findCardByHeading(root,'Event-Status');
  if(oldStatus) oldStatus.classList.add('vtp-event-legacy-status');

  var summary=buildSummary(root,data,legacyEditor);
  legacyEditor.insertAdjacentElement('beforebegin',summary);
  summary.insertAdjacentElement('afterend',buildProgress(data));

  var programCard=findCardByHeading(root,'Event-Ablauf');
  if(programCard){
   programCard.classList.add('vtp-event-program-card');
   var heading=programCard.querySelector('h2');
   if(heading) heading.textContent='Programmpunkte und Ablaufplanung';
   var description=programCard.querySelector(':scope > .description');
   if(description) description.textContent='Plane die Event-Tage und klappe einen Tag auf, um dessen Programmpunkte zu bearbeiten.';
   enhanceDays(programCard);
  }
 });
})();
