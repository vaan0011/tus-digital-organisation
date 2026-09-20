(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function esc(value){
  return String(value==null?'':value).replace(/[&<>'"]/g,function(ch){
   return {'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[ch];
  });
 }

 function hidden(name,value){
  var input=document.createElement('input');
  input.type='hidden';
  input.name=name;
  input.value=value;
  return input;
 }

 function addDays(dateString,offset){
  if(!dateString) return '';
  var parts=dateString.split('-').map(Number);
  if(parts.length!==3) return '';
  var d=new Date(Date.UTC(parts[0],parts[1]-1,parts[2]));
  d.setUTCDate(d.getUTCDate()+Number(offset||0));
  return d.toISOString().slice(0,10);
 }

 function findTemplate(templates,id){
  id=Number(id||0);
  return (templates||[]).find(function(item){ return Number(item.id)===id; }) || null;
 }

 function statusMessage(container,text,isError){
  var old=container.querySelector('.vtp-template-workflow-status');
  if(old) old.remove();
  var p=document.createElement('p');
  p.className='vtp-template-workflow-status '+(isError?'is-error':'is-success');
  p.textContent=text;
  container.prepend(p);
  return p;
 }

 function enhanceNewEvent(data){
  var form=document.querySelector('.vtp-event-create-form');
  if(!form) return;
  var picker=form.querySelector('.vtp-template-picker select');
  var name=form.querySelector('input[name="name"]');
  var start=form.querySelector('input[name="start_date"]');
  var end=form.querySelector('input[name="end_date"]');
  var submit=form.querySelector('.vtp-event-submit');
  if(!picker || !name || !start || !end || !submit) return;

  picker.disabled=false;
  picker.name='template_id';
  picker.innerHTML='';
  var none=document.createElement('option');
  none.value='0';
  none.textContent='– ohne Vorlage –';
  picker.appendChild(none);
  (data.templates||[]).forEach(function(item){
   var option=document.createElement('option');
   option.value=String(item.id);
   option.textContent=item.name;
   picker.appendChild(option);
  });

  var help=document.createElement('small');
  help.className='vtp-template-picker-help';
  picker.parentNode.appendChild(help);

  var selected=Number(data.selectedTemplateId||0);
  if(selected && findTemplate(data.templates,selected)) picker.value=String(selected);

  var autoName='';
  function recalc(){
   var template=findTemplate(data.templates,picker.value);
   if(!template){
    start.required=false;
    help.textContent='Ohne Vorlage wird ein leeres Event angelegt.';
    if(autoName && name.value===autoName) name.value='';
    autoName='';
    return;
   }
   start.required=true;
   help.textContent=template.days+' Tage · '+template.tasks+' Aufgaben · '+template.shifts+' Helferschichten · '+template.catering+' Bewirtungseinträge';
   if(name.value==='' || name.value===autoName){
    name.value=template.name;
    autoName=template.name;
   }
   if(start.value) end.value=addDays(start.value,template.eventMaxOffset||0);
  }

  picker.addEventListener('change',recalc);
  start.addEventListener('change',recalc);
  name.addEventListener('input',function(){ if(name.value!==autoName) autoName=''; });
  recalc();

  var busy=false;
  form.addEventListener('submit',async function(event){
   var template=findTemplate(data.templates,picker.value);
   if(!template || busy) return;
   event.preventDefault();
   if(!start.value){
    start.required=true;
    start.reportValidity();
    return;
   }
   if(!form.checkValidity()){
    form.reportValidity();
    return;
   }

   busy=true;
   var original=submit.textContent;
   submit.disabled=true;
   submit.textContent='Event wird aus Vorlage angelegt …';
   var status=statusMessage(form,'Event wird angelegt und anschließend mit der Vorlage befüllt …',false);

   try{
    var createResponse=await fetch(form.action,{
     method:'POST',
     body:new FormData(form),
     credentials:'same-origin',
     redirect:'follow'
    });
    if(!createResponse.ok) throw new Error('Das Event konnte nicht angelegt werden.');
    var finalUrl=new URL(createResponse.url,window.location.origin);
    var eventId=Number(finalUrl.searchParams.get('edit_event')||0);
    if(!eventId) throw new Error('Das Event wurde nicht eindeutig erkannt.');

    var applyData=new FormData();
    applyData.append('action','vtp_apply_event_template');
    applyData.append('template_id',String(template.id));
    applyData.append('event_id',String(eventId));
    applyData.append('start_date',start.value);
    applyData.append('_wpnonce',data.applyNonce);
    var applyResponse=await fetch(data.actionUrl,{
     method:'POST',
     body:applyData,
     credentials:'same-origin'
    });
    var result=await applyResponse.json();
    if(!applyResponse.ok || !result || !result.success){
     var msg=result && result.data && result.data.message ? result.data.message : 'Die Vorlage konnte nicht angewendet werden.';
     throw new Error(msg);
    }
    window.location.assign(result.data.redirect);
   } catch(error){
    status.textContent=(error&&error.message)?error.message:'Event aus Vorlage konnte nicht angelegt werden.';
    status.className='vtp-template-workflow-status is-error';
    busy=false;
    submit.disabled=false;
    submit.textContent=original;
   }
  });
 }

 function findLibraryCard(){
  var root=document.querySelector('.wrap.vtp');
  if(!root) return null;
  var heading=Array.from(root.querySelectorAll('.vtp-card h2')).find(function(h){ return h.textContent.trim()==='Vorlagen'; });
  return heading ? heading.closest('.vtp-card') : null;
 }

 function deleteForm(data,item,label){
  var form=document.createElement('form');
  form.method='post';
  form.action=data.actionUrl;
  form.className='vtp-template-delete-form';
  form.appendChild(hidden('action','vtp_delete_event_template'));
  form.appendChild(hidden('template_id',String(item.id)));
  form.appendChild(hidden('_wpnonce',item.deleteNonce||item.deleteNonce));
  var button=document.createElement('button');
  button.type='submit';
  button.className='button vtp-template-danger';
  button.textContent=label||'Vorlage löschen';
  form.appendChild(button);
  form.addEventListener('submit',function(event){
   if(!window.confirm('Vorlage wirklich dauerhaft löschen?')) event.preventDefault();
  });
  return form;
 }

 function renderLibrary(data){
  var card=findLibraryCard();
  if(!card) return;
  var heading=card.querySelector('h2');
  Array.from(card.children).forEach(function(child){ if(child!==heading) child.remove(); });
  if(data.deleted) statusMessage(card,'Vorlage gelöscht.',false);

  var intro=document.createElement('p');
  intro.className='description';
  intro.textContent='Vorlagen enthalten wiederkehrende Event-Strukturen ohne feste Jahresdaten. Du kannst sie öffnen, bearbeiten oder direkt für ein neues Event verwenden.';
  card.appendChild(intro);

  if(!(data.templates||[]).length){
   var empty=document.createElement('p');
   empty.className='vtp-event-empty';
   empty.textContent='Noch keine Event-Vorlagen vorhanden.';
   card.appendChild(empty);
   return;
  }

  var grid=document.createElement('div');
  grid.className='vtp-template-library-grid';
  (data.templates||[]).forEach(function(item){
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
   var actions=document.createElement('div');
   actions.className='vtp-template-library-actions';
   var edit=document.createElement('a');
   edit.className='button button-primary';
   edit.href=item.editUrl;
   edit.textContent='Öffnen / Bearbeiten';
   actions.appendChild(edit);
   var use=document.createElement('a');
   use.className='button';
   use.href=item.useUrl;
   use.textContent='Event aus Vorlage anlegen';
   actions.appendChild(use);
   actions.appendChild(deleteForm(data,item,'Löschen'));
   box.appendChild(actions);
   grid.appendChild(box);
  });
  card.appendChild(grid);
 }

 function editorRow(kind,item){
  item=item||{};
  var row=document.createElement('div');
  row.className='vtp-template-editor-row vtp-template-editor-row-'+kind;
  if(kind==='day'){
   row.innerHTML='<label><span>Typ</span><select name="template_day_type[]"><option value="event">Event-Tag</option><option value="setup">Aufbau</option><option value="teardown">Abbau</option></select></label>'+
    '<label><span>Tage zum Start</span><input type="number" name="template_day_offset[]" value="'+esc(item.offset_days||0)+'"></label>'+
    '<label><span>Uhrzeit</span><input type="time" name="template_day_time[]" value="'+esc(item.time||'')+'"></label>'+
    '<button type="button" class="vtp-template-row-remove" aria-label="Eintrag entfernen">×</button>';
   row.querySelector('select').value=item.type||'event';
  } else if(kind==='task'){
   row.innerHTML='<label><span>Aufgabe</span><input type="text" name="template_task_title[]" value="'+esc(item.title||'')+'" required></label>'+
    '<label><span>Kategorie</span><input type="text" name="template_task_category[]" value="'+esc(item.category||'')+'"></label>'+
    '<label><span>Fällig relativ</span><input type="number" name="template_task_due_offset[]" value="'+esc(item.due_offset_days==null?'':item.due_offset_days)+'" placeholder="z. B. -7"></label>'+
    '<label><span>Verantwortlich</span><input type="text" name="template_task_responsible[]" value="'+esc(item.responsible||'')+'"></label>'+
    '<button type="button" class="vtp-template-row-remove" aria-label="Eintrag entfernen">×</button>';
  } else if(kind==='shift'){
   row.innerHTML='<label><span>Bereich / Aufgabe</span><input type="text" name="template_shift_area[]" value="'+esc(item.area||'')+'" required></label>'+
    '<label><span>Tag relativ</span><input type="number" name="template_shift_offset[]" value="'+esc(item.offset_days||0)+'"></label>'+
    '<label><span>Von</span><input type="time" name="template_shift_start[]" value="'+esc(item.start||'')+'" required></label>'+
    '<label><span>Bis</span><input type="time" name="template_shift_end[]" value="'+esc(item.end||'')+'" required></label>'+
    '<label><span>Helfer</span><input type="number" min="1" name="template_shift_slots[]" value="'+esc(item.slots||1)+'"></label>'+
    '<label><span>Zuordnung</span><input type="text" name="template_shift_group[]" value="'+esc(item.group||'')+'"></label>'+
    '<button type="button" class="vtp-template-row-remove" aria-label="Eintrag entfernen">×</button>';
  } else if(kind==='catering'){
   row.innerHTML='<label><span>Kategorie</span><select name="template_catering_category[]"><option value="drink">Getränke</option><option value="food">Essen</option><option value="bring">Mitbringen</option></select></label>'+
    '<label><span>Artikel</span><input type="text" name="template_catering_item[]" value="'+esc(item.item||'')+'" required></label>'+
    '<label><span>Menge</span><input type="number" min="0.01" step="0.01" name="template_catering_quantity[]" value="'+esc(item.quantity||1)+'"></label>'+
    '<label><span>Einheit</span><input type="text" name="template_catering_unit[]" value="'+esc(item.unit||'Stück')+'" required></label>'+
    '<label><span>Zuordnung</span><input type="text" name="template_catering_group[]" value="'+esc(item.assigned_group||'')+'" placeholder="bei Mitbringen"></label>'+
    '<label><span>Notiz</span><input type="text" name="template_catering_note[]" value="'+esc(item.note||'')+'"></label>'+
    '<button type="button" class="vtp-template-row-remove" aria-label="Eintrag entfernen">×</button>';
   row.querySelector('select').value=item.category||'drink';
  }
  row.querySelector('.vtp-template-row-remove').addEventListener('click',function(){ row.remove(); });
  return row;
 }

 function editorSection(title,kind,items,help){
  var section=document.createElement('section');
  section.className='vtp-template-editor-section';
  var head=document.createElement('div');
  head.className='vtp-template-editor-section-head';
  var text=document.createElement('div');
  var h=document.createElement('h3');
  h.textContent=title;
  text.appendChild(h);
  if(help){
   var p=document.createElement('p');
   p.className='description';
   p.textContent=help;
   text.appendChild(p);
  }
  var add=document.createElement('button');
  add.type='button';
  add.className='button vtp-template-add-row';
  add.textContent='+ Eintrag hinzufügen';
  head.appendChild(text);
  head.appendChild(add);
  section.appendChild(head);
  var list=document.createElement('div');
  list.className='vtp-template-editor-list';
  (items||[]).forEach(function(item){ list.appendChild(editorRow(kind,item)); });
  section.appendChild(list);
  add.addEventListener('click',function(){ list.appendChild(editorRow(kind,{})); });
  return section;
 }

 function renderEditor(data){
  var card=findLibraryCard();
  var item=data.template;
  if(!card || !item) return;
  var heading=card.querySelector('h2');
  heading.textContent='Vorlage bearbeiten';
  Array.from(card.children).forEach(function(child){ if(child!==heading) child.remove(); });
  if(data.updated) statusMessage(card,'Vorlage gespeichert.',false);

  var top=document.createElement('div');
  top.className='vtp-template-editor-top';
  var back=document.createElement('a');
  back.className='button';
  back.href='?page=vtp-events&view=templates';
  back.textContent='← Zu den Vorlagen';
  var use=document.createElement('a');
  use.className='button button-primary';
  use.href=item.useUrl;
  use.textContent='Event aus Vorlage anlegen';
  top.appendChild(back);
  top.appendChild(use);
  card.appendChild(top);

  var form=document.createElement('form');
  form.method='post';
  form.action=data.actionUrl;
  form.className='vtp-template-editor-form';
  form.appendChild(hidden('action','vtp_update_event_template'));
  form.appendChild(hidden('template_id',String(item.id)));
  form.appendChild(hidden('_wpnonce',item.updateNonce));

  var nameBox=document.createElement('label');
  nameBox.className='vtp-template-name-field';
  nameBox.innerHTML='<span>Vorlagenname</span><input type="text" name="template_name" value="'+esc(item.name)+'" required>';
  form.appendChild(nameBox);
  form.appendChild(editorSection('Tage, Aufbau und Abbau','day',item.days,'0 = Event-Startdatum, -1 = ein Tag davor, +1 = ein Tag danach.'));
  form.appendChild(editorSection('Aufgaben','task',item.tasks,'Fälligkeiten werden ebenfalls relativ zum neuen Startdatum gespeichert.'));
  form.appendChild(editorSection('Helferschichten','shift',item.shifts,'Manuelle Schichten werden auf den entsprechenden relativen Event-Tag übertragen.'));
  form.appendChild(editorSection('Bewirtung','catering',item.catering,'Getränke, Essen und Mitbringen werden vollständig übernommen.'));

  var save=document.createElement('button');
  save.type='submit';
  save.className='button button-primary vtp-template-editor-save';
  save.textContent='Vorlage speichern';
  form.appendChild(save);
  card.appendChild(form);

  var danger=document.createElement('div');
  danger.className='vtp-template-editor-danger';
  var deleteItem={id:item.id,deleteNonce:item.deleteNonce};
  danger.appendChild(deleteForm(data,deleteItem,'Vorlage dauerhaft löschen'));
  card.appendChild(danger);
 }

 ready(function(){
  var data=window.VTPEventTemplateWorkflow||{};
  if(data.mode==='new') enhanceNewEvent(data);
  if(data.mode==='library') renderLibrary(data);
  if(data.mode==='editor') renderEditor(data);
 });
})();
