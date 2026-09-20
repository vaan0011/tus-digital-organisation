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

 function field(labelText,type,fieldName,value,options){
  options=options||{};
  var label=el('label','vtp-catering-field');
  label.appendChild(el('span','vtp-catering-field-label',labelText));
  var input=document.createElement('input');
  input.type=type;
  input.dataset.field=fieldName;
  input.value=value||'';
  if(options.placeholder) input.placeholder=options.placeholder;
  if(options.required) input.required=true;
  if(options.min!=null) input.min=String(options.min);
  if(options.step!=null) input.step=String(options.step);
  if(options.list) input.setAttribute('list',options.list);
  label.appendChild(input);
  return label;
 }

 function addButton(labelText){
  var button=el('button','vtp-event-add-catering');
  button.type='button';
  button.appendChild(el('span','vtp-add-icon','+'));
  button.appendChild(el('span','vtp-add-label',labelText));
  return button;
 }

 function itemRow(item){
  item=item||{};
  var category=item.category||'drink';
  var row=el('div','vtp-catering-row'+(category==='bring'?' is-bring':''));
  row.dataset.cateringRow='1';
  row.dataset.category=category;

  var categoryInput=document.createElement('input');
  categoryInput.type='hidden';
  categoryInput.dataset.field='category';
  categoryInput.value=category;
  row.appendChild(categoryInput);

  var placeholder=category==='drink'?'z. B. Pils':(category==='bring'?'z. B. Muffins':'z. B. Bratwurst');
  row.appendChild(field('Artikel','text','name',item.name||'',{required:true,placeholder:placeholder}));
  row.appendChild(field(category==='bring'?'Menge':'Bestellmenge','number','quantity',String(item.quantity||''),{required:true,min:0.01,step:0.01}));
  row.appendChild(field('Einheit','text','unit',item.unit||'',{required:true,placeholder:category==='bring'?'z. B. Stück':'z. B. Kisten',list:'vtp-catering-units'}));
  if(category==='bring'){
   row.appendChild(field('Zuordnung','text','assignedGroup',item.assignedGroup||'',{placeholder:'z. B. C-Jugend'}));
  }
  row.appendChild(field('Notiz','text','note',item.note||'',{placeholder:'optional'}));

  var actions=el('div','vtp-catering-actions');
  var remove=el('button','vtp-event-icon-button vtp-catering-remove dashicons-before dashicons-trash');
  remove.type='button';
  remove.setAttribute('aria-label','Bewirtungseintrag löschen');
  remove.title='Bewirtungseintrag löschen';
  remove.addEventListener('click',function(){
   var list=row.parentNode;
   row.remove();
   if(list) list.dispatchEvent(new CustomEvent('vtp-catering-changed',{bubbles:true}));
  });
  actions.appendChild(remove);
  row.appendChild(actions);
  return row;
 }

 function indexRows(form){
  Array.from(form.querySelectorAll('[data-catering-row]')).forEach(function(row,i){
   var map={
    category:'catering_category['+i+']',
    name:'catering_item['+i+']',
    quantity:'catering_quantity['+i+']',
    unit:'catering_unit['+i+']',
    assignedGroup:'catering_assigned_group['+i+']',
    note:'catering_note['+i+']'
   };
   Object.keys(map).forEach(function(key){
    var input=row.querySelector('[data-field="'+key+'"]');
    if(input) input.name=map[key];
   });
  });
 }

 function emptyText(category){
  if(category==='drink') return 'Noch keine Getränke geplant.';
  if(category==='bring') return 'Noch nichts zum Mitbringen geplant.';
  return 'Noch kein Essen geplant.';
 }

 function buildGroup(category,title,buttonLabel,items){
  var group=el('div','vtp-catering-group');
  var header=el('div','vtp-catering-group-header');
  header.appendChild(el('h3','',title));
  var add=addButton(buttonLabel);
  header.appendChild(add);
  group.appendChild(header);

  var list=el('div','vtp-catering-list');
  (items||[]).forEach(function(item){ list.appendChild(itemRow(item)); });
  group.appendChild(list);
  var empty=el('p','description vtp-catering-empty',emptyText(category));
  group.appendChild(empty);

  function syncEmpty(){ empty.hidden=list.querySelectorAll('[data-catering-row]').length>0; }
  syncEmpty();
  list.addEventListener('vtp-catering-changed',syncEmpty);
  add.addEventListener('click',function(){
   list.appendChild(itemRow({category:category}));
   syncEmpty();
   var rows=list.querySelectorAll('[data-catering-row]');
   var row=rows.length?rows[rows.length-1]:null;
   var first=row&&row.querySelector('[data-field="name"]');
   if(first) first.focus();
  });

  return group;
 }

 function buildSection(data){
  var section=el('section','vtp-card vtp-event-catering-card');
  section.id='vtp-event-catering';

  var header=el('div','vtp-event-catering-header');
  header.appendChild(el('h2','','Bewirtung'));
  var toggle=el('button','vtp-event-icon-button vtp-catering-section-toggle dashicons-before dashicons-arrow-up-alt2');
  toggle.type='button';
  toggle.setAttribute('aria-label','Bewirtung einklappen');
  toggle.title='Bewirtung einklappen';
  header.appendChild(toggle);
  section.appendChild(header);

  var description=el('p','description vtp-event-catering-description','Plane Bestellungen für Getränke und Essen sowie Dinge, die Mannschaften oder Abteilungen zum Event mitbringen sollen.');
  section.appendChild(description);

  var body=el('div','vtp-event-catering-body');
  var form=document.createElement('form');
  form.method='post';
  form.action=data.actionUrl;
  function hidden(name,value){ var input=document.createElement('input'); input.type='hidden'; input.name=name; input.value=value; return input; }
  form.appendChild(hidden('action','vtp_save_event_catering'));
  form.appendChild(hidden('event_id',String(data.eventId)));
  form.appendChild(hidden('_wpnonce',data.nonce));

  var datalist=document.createElement('datalist');
  datalist.id='vtp-catering-units';
  ['Kisten','Flaschen','Liter','Stück','kg','Packungen','Kartons','Dosen','Beutel','Bleche'].forEach(function(value){
   var option=document.createElement('option'); option.value=value; datalist.appendChild(option);
  });
  form.appendChild(datalist);

  var items=data.items||[];
  var drinks=items.filter(function(item){ return item.category==='drink'; });
  var food=items.filter(function(item){ return item.category==='food'; });
  var bring=items.filter(function(item){ return item.category==='bring'; });
  form.appendChild(buildGroup('drink','Getränke','Getränk hinzufügen',drinks));
  form.appendChild(buildGroup('food','Essen','Essen hinzufügen',food));
  form.appendChild(buildGroup('bring','Mitbringen','Mitbringen hinzufügen',bring));

  var submit=el('button','button button-primary vtp-catering-save','Bewirtung speichern');
  submit.type='submit';
  form.appendChild(submit);
  form.addEventListener('submit',function(){ indexRows(form); });
  body.appendChild(form);
  section.appendChild(body);

  toggle.addEventListener('click',function(){
   var collapsed=section.classList.toggle('is-collapsed');
   toggle.classList.toggle('dashicons-arrow-up-alt2',!collapsed);
   toggle.classList.toggle('dashicons-arrow-down-alt2',collapsed);
   toggle.setAttribute('aria-label',collapsed?'Bewirtung aufklappen':'Bewirtung einklappen');
   toggle.title=collapsed?'Bewirtung aufklappen':'Bewirtung einklappen';
  });

  return section;
 }

 ready(function(){
  var data=window.VTPEventCatering;
  if(!data||!data.eventId) return;
  var anchor=document.getElementById('vtp-event-shifts')||document.getElementById('vtp-event-tasks');
  if(!anchor) return;
  anchor.insertAdjacentElement('afterend',buildSection(data));
 });
})();
