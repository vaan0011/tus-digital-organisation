(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function normalize(value){ return String(value||'').trim().toLocaleLowerCase('de-DE'); }

 function matchingRow(list,candidate){
  var rows=Array.from(list.querySelectorAll('[data-shift-row]'));
  return rows.find(function(row){
   var area=row.querySelector('[data-field="area"]');
   var date=row.querySelector('[data-field="date"]');
   var start=row.querySelector('[data-field="start"]');
   return area && date && start &&
    normalize(area.value)===normalize(candidate.label) &&
    date.value===candidate.date &&
    start.value===candidate.start;
  });
 }

 function formatDate(value){
  var m=/^(\d{4})-(\d{2})-(\d{2})$/.exec(value||'');
  return m ? m[3]+'.'+m[2]+'.'+m[1] : value||'';
 }

 ready(function(){
  var data=window.VTPEventShifts;
  var candidates=(data&&data.operationShiftCandidates)||[];
  if(!candidates.length) return;

  var section=document.getElementById('vtp-event-shifts');
  if(!section) return;
  var form=section.querySelector('form');
  var list=section.querySelector('.vtp-shift-list');
  var actions=section.querySelector('.vtp-shift-top-actions');
  var add=section.querySelector('.vtp-event-add-shift');
  if(!form || !list || !actions || !add) return;

  var panel=document.createElement('div');
  panel.className='vtp-shift-plan-import';

  var intro=document.createElement('div');
  intro.className='vtp-shift-plan-import-copy';
  var title=document.createElement('strong');
  title.textContent='Aus Ablaufplan übernehmen';
  var description=document.createElement('span');
  description.textContent='Aufbau und Abbau übernehmen Datum und Startzeit aus dem Ablaufplan. Endzeit und Helferzahl kannst du anschließend anpassen.';
  intro.appendChild(title);
  intro.appendChild(description);
  panel.appendChild(intro);

  var buttons=document.createElement('div');
  buttons.className='vtp-shift-plan-import-buttons';
  panel.appendChild(buttons);

  function syncButtons(){
   Array.from(buttons.querySelectorAll('[data-operation-index]')).forEach(function(button){
    var index=Number(button.dataset.operationIndex);
    var candidate=candidates[index];
    var exists=matchingRow(list,candidate);
    button.disabled=!!exists;
    button.classList.toggle('is-imported',!!exists);
    var label=button.querySelector('.vtp-shift-plan-import-label');
    if(label) label.textContent=candidate.label+(exists?' bereits übernommen':' übernehmen');
   });
  }

  candidates.forEach(function(candidate,index){
   var button=document.createElement('button');
   button.type='button';
   button.className='button vtp-shift-plan-import-button';
   button.dataset.operationIndex=String(index);

   var label=document.createElement('span');
   label.className='vtp-shift-plan-import-label';
   label.textContent=candidate.label+' übernehmen';
   var meta=document.createElement('span');
   meta.className='vtp-shift-plan-import-meta';
   meta.textContent=formatDate(candidate.date)+' · '+candidate.start+' Uhr';
   button.appendChild(label);
   button.appendChild(meta);

   button.addEventListener('click',function(){
    var existing=matchingRow(list,candidate);
    if(existing){
     existing.scrollIntoView({behavior:'smooth',block:'center'});
     return;
    }

    add.click();
    var rows=list.querySelectorAll('[data-shift-row]');
    var row=rows.length?rows[rows.length-1]:null;
    if(!row) return;

    var area=row.querySelector('[data-field="area"]');
    var date=row.querySelector('[data-field="date"]');
    var start=row.querySelector('[data-field="start"]');
    var end=row.querySelector('[data-field="end"]');
    if(area) area.value=candidate.label;
    if(date) date.value=candidate.date;
    if(start) start.value=candidate.start;
    if(area) area.dispatchEvent(new Event('input',{bubbles:true}));
    if(date) date.dispatchEvent(new Event('change',{bubbles:true}));
    if(start) start.dispatchEvent(new Event('change',{bubbles:true}));

    syncButtons();
    row.scrollIntoView({behavior:'smooth',block:'center'});
    if(end) end.focus();
   });

   buttons.appendChild(button);
  });

  actions.insertAdjacentElement('afterend',panel);
  syncButtons();
  list.addEventListener('input',syncButtons);
  list.addEventListener('change',syncButtons);
  list.addEventListener('vtp-shifts-changed',syncButtons);
 });
})();
