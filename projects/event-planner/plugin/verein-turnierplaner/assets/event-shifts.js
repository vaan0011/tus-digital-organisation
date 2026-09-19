(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function el(tag,className,text){
  var node=document.createElement(tag);
  if(className) node.className=className;
  if(text!=null) node.textContent=text;
  return node;
 }

 function pad(n){ return String(n).padStart(2,'0'); }
 function timeToMinutes(value){
  var m=/^(\d{2}):(\d{2})$/.exec(value||'');
  return m ? Number(m[1])*60+Number(m[2]) : NaN;
 }
 function minutesToTime(value){ return pad(Math.floor(value/60))+':'+pad(value%60); }

 function progressCard(label){
  return Array.from(document.querySelectorAll('.vtp-event-progress-card')).find(function(card){
   var item=card.querySelector('.vtp-event-progress-label');
   return item && item.textContent.trim()===label;
  });
 }

 function syncProgress(list){
  var rows=Array.from(list.querySelectorAll('[data-shift-row]'));
  var total=rows.length, full=0, needed=0, filled=0;
  rows.forEach(function(row){
   var slots=Math.max(1,Number(row.querySelector('[data-field="slots"]').value||1));
   var signups=Math.max(0,Number(row.dataset.signups||0));
   needed+=slots;
   filled+=Math.min(signups,slots);
   if(signups>=slots) full++;
  });

  var shiftCard=progressCard('Schichten');
  if(shiftCard){
   shiftCard.classList.remove('is-neutral','is-active','is-warning','is-done','is-critical');
   var metric=shiftCard.querySelector('.vtp-event-progress-metric');
   var state=shiftCard.querySelector('.vtp-event-progress-state');
   if(metric) metric.textContent=full+'/'+total;
   if(total===0){ shiftCard.classList.add('is-neutral'); if(state) state.textContent='noch nicht geplant'; }
   else if(full>=total){ shiftCard.classList.add('is-done'); if(state) state.textContent='belegt'; }
   else if(full>0){ shiftCard.classList.add('is-warning'); if(state) state.textContent=(total-full)+' offen'; }
   else { shiftCard.classList.add('is-active'); if(state) state.textContent='geplant'; }
  }

  var helperCard=progressCard('Helfer');
  if(helperCard){
   helperCard.classList.remove('is-neutral','is-active','is-warning','is-done','is-critical');
   var helperMetric=helperCard.querySelector('.vtp-event-progress-metric');
   var helperState=helperCard.querySelector('.vtp-event-progress-state');
   if(helperMetric) helperMetric.textContent=filled+'/'+needed;
   if(needed===0){ helperCard.classList.add('is-neutral'); if(helperState) helperState.textContent='noch nicht geplant'; }
   else if(filled>=needed){ helperCard.classList.add('is-done'); if(helperState) helperState.textContent='organisiert'; }
   else if(filled>0){ helperCard.classList.add('is-warning'); if(helperState) helperState.textContent=(needed-filled)+' offen'; }
   else { helperCard.classList.add('is-active'); if(helperState) helperState.textContent='Bedarf geplant'; }
  }
 }

 function field(labelText,type,fieldName,value,options){
  options=options||{};
  var label=el('label','vtp-shift-field');
  label.appendChild(el('span','vtp-shift-field-label',labelText));
  var input=document.createElement('input');
  input.type=type;
  input.dataset.field=fieldName;
  input.value=value||'';
  if(options.placeholder) input.placeholder=options.placeholder;
  if(options.required) input.required=true;
  if(options.min!=null) input.min=String(options.min);
  if(options.step!=null) input.step=String(options.step);
  label.appendChild(input);
  return label;
 }

 function shiftRow(shift){
  shift=shift||{};
  var row=el('div','vtp-shift-row');
  row.dataset.shiftRow='1';
  row.dataset.signups=String(shift.signups||0);

  var id=document.createElement('input');
  id.type='hidden'; id.dataset.field='id'; id.value=shift.id||'';
  row.appendChild(id);

  row.appendChild(field('Bereich / Aufgabe','text','area',shift.area||'',{required:true,placeholder:'z. B. Ausschank'}));
  row.appendChild(field('Datum','date','date',shift.date||'',{required:true}));
  row.appendChild(field('Von','time','start',shift.start||'',{required:true}));
  row.appendChild(field('Bis','time','end',shift.end||'',{required:true}));
  row.appendChild(field('Helfer','number','slots',String(shift.slots||2),{required:true,min:1,step:1}));
  row.appendChild(field('Zuordnung','text','group',shift.group||'',{placeholder:'optional'}));

  var occupancy=el('div','vtp-shift-occupancy');
  occupancy.appendChild(el('span','vtp-shift-field-label','Belegt'));
  occupancy.appendChild(el('strong','',String(shift.signups||0)+' / '+String(shift.slots||2)));
  row.appendChild(occupancy);

  var actions=el('div','vtp-shift-actions');
  var remove=el('button','vtp-event-icon-button vtp-shift-remove dashicons-before dashicons-trash');
  remove.type='button';
  remove.setAttribute('aria-label','Helferschicht löschen');
  remove.title='Helferschicht löschen';
  actions.appendChild(remove);
  row.appendChild(actions);

  var slots=row.querySelector('[data-field="slots"]');
  slots.addEventListener('input',function(){ occupancy.querySelector('strong').textContent=String(shift.signups||0)+' / '+String(Math.max(1,Number(slots.value||1))); });
  remove.addEventListener('click',function(){
   var signups=Number(row.dataset.signups||0);
   if(signups>0 && !window.confirm('Für diese Schicht gibt es bereits '+signups+' Anmeldung(en). Beim Speichern werden diese ebenfalls gelöscht. Schicht wirklich entfernen?')) return;
   var parent=row.parentNode;
   row.remove();
   if(parent) parent.dispatchEvent(new CustomEvent('vtp-shifts-changed',{bubbles:true}));
  });
  return row;
 }

 function indexRows(form){
  Array.from(form.querySelectorAll('[data-shift-row]')).forEach(function(row,i){
   var map={id:'shift_id['+i+']',area:'shift_area['+i+']',date:'shift_date['+i+']',start:'shift_start['+i+']',end:'shift_end['+i+']',slots:'shift_slots['+i+']',group:'shift_group['+i+']'};
   Object.keys(map).forEach(function(key){
    var input=row.querySelector('[data-field="'+key+'"]');
    if(input) input.name=map[key];
   });
  });
 }

 function sortRows(list){
  var rows=Array.from(list.querySelectorAll('[data-shift-row]'));
  rows.sort(function(a,b){
   function value(row,key){ var input=row.querySelector('[data-field="'+key+'"]'); return input?input.value:''; }
   return (value(a,'date')+'|'+value(a,'start')+'|'+value(a,'area')).localeCompare(value(b,'date')+'|'+value(b,'start')+'|'+value(b,'area'));
  });
  rows.forEach(function(row){ list.appendChild(row); });
 }

 function addButton(label){
  var button=el('button','vtp-event-add-shift');
  button.type='button';
  button.appendChild(el('span','vtp-add-icon','+'));
  button.appendChild(el('span','vtp-add-label',label));
  return button;
 }

 function generatorPanel(data,onGenerate){
  var panel=el('div','vtp-shift-generator');
  panel.hidden=true;
  panel.appendChild(el('h3','', 'Schichtserie generieren'));
  panel.appendChild(el('p','description','Erzeuge mehrere aufeinanderfolgende Schichten für denselben Bereich. Die erzeugten Zeilen können vor dem Speichern einzeln angepasst werden.'));

  var grid=el('div','vtp-shift-generator-grid');
  var area=field('Bereich / Aufgabe','text','generatorArea','',{placeholder:'z. B. Ausschank'});
  var date=field('Datum','date','generatorDate',data.eventStart||'');
  var start=field('Von','time','generatorStart','');
  var end=field('Bis','time','generatorEnd','');
  var slots=field('Helfer je Schicht','number','generatorSlots','2',{min:1,step:1});
  var group=field('Zuordnung','text','generatorGroup','',{placeholder:'optional'});
  grid.appendChild(area); grid.appendChild(date); grid.appendChild(start); grid.appendChild(end); grid.appendChild(slots); grid.appendChild(group);

  var blockLabel=el('label','vtp-shift-field');
  blockLabel.appendChild(el('span','vtp-shift-field-label','Blocklänge'));
  var select=document.createElement('select');
  select.dataset.field='generatorBlock';
  [[60,'1 Stunde'],[90,'1,5 Stunden'],[120,'2 Stunden'],[180,'3 Stunden'],['custom','Eigene Dauer']].forEach(function(pair){
   var option=document.createElement('option'); option.value=String(pair[0]); option.textContent=pair[1]; if(pair[0]===120) option.selected=true; select.appendChild(option);
  });
  blockLabel.appendChild(select);
  grid.appendChild(blockLabel);

  var custom=field('Eigene Dauer (Min.)','number','generatorCustom','',{min:15,step:15});
  custom.hidden=true;
  grid.appendChild(custom);
  panel.appendChild(grid);

  var error=el('p','vtp-shift-generator-error'); error.hidden=true; panel.appendChild(error);
  var apply=el('button','button button-primary vtp-shift-generate-apply','Serie übernehmen');
  apply.type='button'; panel.appendChild(apply);

  select.addEventListener('change',function(){ custom.hidden=select.value!=='custom'; });
  apply.addEventListener('click',function(){
   var get=function(name){ var input=panel.querySelector('[data-field="'+name+'"]'); return input?input.value:''; };
   var areaValue=get('generatorArea').trim(), dateValue=get('generatorDate'), startValue=get('generatorStart'), endValue=get('generatorEnd');
   var slotsValue=Math.max(1,Number(get('generatorSlots')||1)), groupValue=get('generatorGroup').trim();
   var block=select.value==='custom'?Number(get('generatorCustom')||0):Number(select.value||0);
   var from=timeToMinutes(startValue), to=timeToMinutes(endValue);
   var message='';
   if(!areaValue) message='Bitte einen Bereich oder eine Aufgabe angeben.';
   else if(!dateValue) message='Bitte ein Datum auswählen.';
   else if(!Number.isFinite(from)||!Number.isFinite(to)||to<=from) message='Bitte einen gültigen Zeitraum angeben.';
   else if(!Number.isFinite(block)||block<15) message='Bitte eine gültige Blocklänge ab 15 Minuten wählen.';
   if(message){ error.textContent=message; error.hidden=false; return; }
   error.hidden=true;
   var generated=[];
   for(var cursor=from;cursor<to;cursor+=block){
    var next=Math.min(cursor+block,to);
    generated.push({area:areaValue,date:dateValue,start:minutesToTime(cursor),end:minutesToTime(next),slots:slotsValue,group:groupValue,signups:0});
   }
   onGenerate(generated);
  });
  return panel;
 }

 function buildSection(data){
  var section=el('section','vtp-card vtp-event-shifts-card');
  section.id='vtp-event-shifts';

  var header=el('div','vtp-event-shifts-header');
  header.appendChild(el('h2','', 'Helferschichten'));
  var toggle=el('button','vtp-event-icon-button vtp-shift-section-toggle dashicons-before dashicons-arrow-up-alt2');
  toggle.type='button'; toggle.setAttribute('aria-label','Helferschichten einklappen'); toggle.title='Helferschichten einklappen';
  header.appendChild(toggle); section.appendChild(header);

  var description=el('p','description vtp-event-shifts-description','Plane Helferschichten direkt oder generiere mehrere Zeitblöcke für einen Bereich.');
  section.appendChild(description);

  var body=el('div','vtp-event-shifts-body');
  var form=document.createElement('form'); form.method='post'; form.action=data.actionUrl;
  function hidden(name,value){ var input=document.createElement('input'); input.type='hidden'; input.name=name; input.value=value; return input; }
  form.appendChild(hidden('action','vtp_save_event_shifts'));
  form.appendChild(hidden('event_id',String(data.eventId)));
  form.appendChild(hidden('_wpnonce',data.nonce));

  var actions=el('div','vtp-shift-top-actions');
  var add=addButton('Schicht hinzufügen');
  var generateToggle=el('button','button vtp-shift-generator-toggle','Schichtserie generieren'); generateToggle.type='button';
  actions.appendChild(add); actions.appendChild(generateToggle); form.appendChild(actions);

  var list=el('div','vtp-shift-list');
  (data.shifts||[]).forEach(function(item){ list.appendChild(shiftRow(item)); });

  var generator=generatorPanel(data,function(items){
   items.forEach(function(item){ list.appendChild(shiftRow(item)); });
   sortRows(list); syncEmpty(); syncProgress(list);
  });
  form.appendChild(generator);
  form.appendChild(list);

  var empty=el('p','vtp-shift-empty description','Noch keine Helferschichten geplant.'); form.appendChild(empty);
  var submit=el('button','button button-primary vtp-shift-save','Helferschichten speichern'); submit.type='submit'; form.appendChild(submit);
  body.appendChild(form); section.appendChild(body);

  function syncEmpty(){ empty.hidden=list.querySelectorAll('[data-shift-row]').length>0; }
  syncEmpty(); syncProgress(list);

  add.addEventListener('click',function(){
   var row=shiftRow({date:data.eventStart||'',slots:2,signups:0});
   list.appendChild(row); syncEmpty(); syncProgress(list);
   var first=row.querySelector('[data-field="area"]'); if(first) first.focus();
  });
  generateToggle.addEventListener('click',function(){
   generator.hidden=!generator.hidden;
   generateToggle.classList.toggle('is-active',!generator.hidden);
   if(!generator.hidden){ var first=generator.querySelector('[data-field="generatorArea"]'); if(first) first.focus(); }
  });
  list.addEventListener('vtp-shifts-changed',function(){ syncEmpty(); syncProgress(list); });
  list.addEventListener('input',function(e){ if(e.target && e.target.dataset.field==='slots') syncProgress(list); });
  form.addEventListener('submit',function(){ sortRows(list); indexRows(form); });

  toggle.addEventListener('click',function(){
   var collapsed=section.classList.toggle('is-collapsed');
   toggle.classList.toggle('dashicons-arrow-up-alt2',!collapsed);
   toggle.classList.toggle('dashicons-arrow-down-alt2',collapsed);
   toggle.setAttribute('aria-label',collapsed?'Helferschichten aufklappen':'Helferschichten einklappen');
   toggle.title=collapsed?'Helferschichten aufklappen':'Helferschichten einklappen';
  });
  return section;
 }

 ready(function(){
  var data=window.VTPEventShifts;
  if(!data || !data.eventId || document.getElementById('vtp-event-shifts')) return;
  var anchor=document.getElementById('vtp-event-tasks') || document.querySelector('.vtp-event-program-card');
  if(!anchor) return;
  var section=buildSection(data);
  anchor.insertAdjacentElement('afterend',section);
  if(window.location.hash==='#vtp-event-shifts') window.setTimeout(function(){ section.scrollIntoView({behavior:'smooth',block:'start'}); },100);
 });
})();
