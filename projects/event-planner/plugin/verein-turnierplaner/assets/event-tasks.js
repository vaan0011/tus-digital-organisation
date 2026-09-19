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

 function updateProgress(total,done){
  var cards=Array.from(document.querySelectorAll('.vtp-event-progress-card'));
  var card=cards.find(function(c){
   var label=c.querySelector('.vtp-event-progress-label');
   return label && label.textContent.trim()==='Aufgaben';
  });
  if(!card) return;

  var metric=card.querySelector('.vtp-event-progress-metric');
  var state=card.querySelector('.vtp-event-progress-state');
  card.classList.remove('is-neutral','is-active','is-warning','is-done','is-critical');

  if(metric) metric.textContent=total>0 ? done+'/'+total : '0';
  if(total===0){
   card.classList.add('is-neutral');
   if(state) state.textContent='noch nicht geplant';
  } else if(done>=total){
   card.classList.add('is-done');
   if(state) state.textContent='erledigt';
  } else if(done>0){
   card.classList.add('is-warning');
   if(state) state.textContent=(total-done)+' offen';
  } else {
   card.classList.add('is-active');
   if(state) state.textContent='geplant';
  }
 }

 function taskRow(task){
  task=task||{};
  var row=el('div','vtp-task-row');
  row.dataset.taskRow='1';

  var id=document.createElement('input');
  id.type='hidden'; id.dataset.field='id'; id.value=task.id||'';
  row.appendChild(id);

  var source=document.createElement('input');
  source.type='hidden'; source.dataset.field='source'; source.value=task.source||'manual';
  row.appendChild(source);

  var doneWrap=el('label','vtp-task-done');
  var done=document.createElement('input');
  done.type='checkbox'; done.dataset.field='done'; done.checked=!!task.done;
  var doneText=el('span','', 'Erledigt');
  doneWrap.appendChild(done); doneWrap.appendChild(doneText);
  row.appendChild(doneWrap);

  function field(labelText,type,field,value,placeholder){
   var label=el('label','vtp-task-field');
   label.appendChild(el('span','vtp-task-field-label',labelText));
   var input=document.createElement('input');
   input.type=type;
   input.dataset.field=field;
   input.value=value||'';
   if(placeholder) input.placeholder=placeholder;
   if(field==='title') input.required=true;
   label.appendChild(input);
   return label;
  }

  row.appendChild(field('Aufgabe','text','title',task.title,'z. B. Ausschankgenehmigung beantragen'));
  row.appendChild(field('Kategorie','text','category',task.category,'optional'));
  row.appendChild(field('Fällig','date','dueDate',task.dueDate,''));
  row.appendChild(field('Verantwortlich','text','responsible',task.responsible,'optional'));

  var actions=el('div','vtp-task-actions');
  var remove=el('button','vtp-event-icon-button vtp-task-remove dashicons-before dashicons-trash');
  remove.type='button';
  remove.setAttribute('aria-label','Aufgabe löschen');
  remove.title='Aufgabe löschen';
  actions.appendChild(remove);
  row.appendChild(actions);

  remove.addEventListener('click',function(){ row.remove(); });
  return row;
 }

 function indexRows(form){
  Array.from(form.querySelectorAll('[data-task-row]')).forEach(function(row,i){
   var map={
    id:'task_id['+i+']',
    title:'task_title['+i+']',
    category:'task_category['+i+']',
    dueDate:'task_due_date['+i+']',
    responsible:'task_responsible['+i+']',
    done:'task_done['+i+']',
    source:'task_source['+i+']'
   };
   Object.keys(map).forEach(function(key){
    var input=row.querySelector('[data-field="'+key+'"]');
    if(input) input.name=map[key];
   });
  });
 }

 function buildSection(data){
  var section=el('section','vtp-card vtp-event-tasks-card');
  section.id='vtp-event-tasks';

  var header=el('div','vtp-event-tasks-header');
  var headingWrap=el('div','vtp-event-tasks-heading');
  headingWrap.appendChild(el('h2','', 'Aufgaben und Organisation'));
  header.appendChild(headingWrap);

  var toggle=el('button','vtp-event-icon-button vtp-task-section-toggle dashicons-before dashicons-arrow-up-alt2');
  toggle.type='button';
  toggle.setAttribute('aria-label','Aufgaben einklappen');
  toggle.title='Aufgaben einklappen';
  header.appendChild(toggle);
  section.appendChild(header);

  section.appendChild(el('p','description vtp-event-tasks-description','Plane die organisatorischen Aufgaben dieses Events und halte Verantwortlichkeit sowie Fälligkeit fest.'));

  var body=el('div','vtp-event-tasks-body');
  var form=document.createElement('form');
  form.method='post';
  form.action=data.actionUrl;

  function hidden(name,value){
   var input=document.createElement('input');
   input.type='hidden'; input.name=name; input.value=value;
   return input;
  }
  form.appendChild(hidden('action','vtp_save_event_tasks'));
  form.appendChild(hidden('event_id',String(data.eventId)));
  form.appendChild(hidden('_wpnonce',data.nonce));

  var add=el('button','vtp-event-add-task');
  add.type='button';
  add.appendChild(el('span','vtp-add-icon','+'));
  add.appendChild(el('span','vtp-add-label','Aufgabe hinzufügen'));
  form.appendChild(add);

  var list=el('div','vtp-task-list');
  (data.tasks||[]).forEach(function(task){ list.appendChild(taskRow(task)); });
  form.appendChild(list);

  var empty=el('p','vtp-task-empty description','Noch keine Organisationsaufgaben geplant.');
  form.appendChild(empty);

  var submit=el('button','button button-primary vtp-task-save','Aufgaben speichern');
  submit.type='submit';
  form.appendChild(submit);
  body.appendChild(form);
  section.appendChild(body);

  function syncEmpty(){ empty.hidden=list.querySelectorAll('[data-task-row]').length>0; }
  syncEmpty();

  add.addEventListener('click',function(){
   var row=taskRow({source:'manual'});
   list.appendChild(row);
   syncEmpty();
   var title=row.querySelector('[data-field="title"]');
   if(title) title.focus();
  });

  list.addEventListener('click',function(){ window.setTimeout(syncEmpty,0); });
  form.addEventListener('submit',function(){ indexRows(form); });

  toggle.addEventListener('click',function(){
   var collapsed=section.classList.toggle('is-collapsed');
   toggle.classList.toggle('dashicons-arrow-up-alt2',!collapsed);
   toggle.classList.toggle('dashicons-arrow-down-alt2',collapsed);
   toggle.setAttribute('aria-label',collapsed?'Aufgaben aufklappen':'Aufgaben einklappen');
   toggle.title=collapsed?'Aufgaben aufklappen':'Aufgaben einklappen';
  });

  return section;
 }

 ready(function(){
  var data=window.VTPEventTasks;
  if(!data || !data.eventId) return;

  updateProgress(Number(data.total||0),Number(data.done||0));

  var program=document.querySelector('.vtp-event-program-card');
  if(!program || document.getElementById('vtp-event-tasks')) return;
  var section=buildSection(data);
  program.insertAdjacentElement('afterend',section);

  if(window.location.hash==='#vtp-event-tasks'){
   window.setTimeout(function(){ section.scrollIntoView({behavior:'smooth',block:'start'}); },100);
  }
 });
})();
