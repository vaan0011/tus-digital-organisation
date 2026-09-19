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
  var row=el('div','vtp-catering-row');
  row.dataset.cateringRow='1';
  row.dataset.category=item.category||'drink';

  var category=document.createElement('input');
  category.type='hidden';
  category.dataset.field='category';
  category.value=row.dataset.category;
  row.appendChild(category);

  row.appendChild(field('Artikel','text','name',item.name||'',{required:true,placeholder:row.dataset.category==='drink'?'z. B. Pils':'z. B. Bratwurst'}));
  row.appendChild(field('Bestellmenge','number','quantity',String(item.quantity||''),{required:true,min:0.01,step:0.01}));
  row.appendChild(field('Einheit','text','unit',item.unit||'',{required:true,placeholder:'z. B. Kisten',list:'vtp-catering-units'}));
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
    note:'catering_note['+i+']'
   };
   Object.keys(map).forEach(function(key){
    var input=row.querySelector('[data-field="'+key+'"]');
    if(input) input.name=map[key];
   });
  });
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
  var empty=el('p','description vtp-catering-empty',category==='drink'?'Noch keine Getränke geplant.':'Noch kein Essen geplant.');
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

  var description=el('p','description vtp-event-catering-description','Plane, welche Getränke und Speisen in welcher Menge für das Event bestellt werden müssen.');
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
  ['Kisten','Flaschen','Liter','Stück','kg','Packungen','Kartons','Dosen','Beutel'].forEach(function(value){
   var option=document.createElement('option'); option.value=value; datalist.appendChild(option);
  });
  form.appendChild(datalist);

  var items=data.items||[];
  var drinks=items.filter(function(item){ return item.category==='drink'; });
  var food=items.filter(function(item){ return item.category==='food'; });
  form.appendChild(buildGroup('drink','Getränke','Getränk hinzufügen',drinks));
  form.appendChild(buildGroup('food','Essen','Essen hinzufügen',food));

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
