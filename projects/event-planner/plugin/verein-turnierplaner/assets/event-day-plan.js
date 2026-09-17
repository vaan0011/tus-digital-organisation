(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function escapeHtml(value){
  return String(value==null?'':value)
   .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
   .replace(/"/g,'&quot;').replace(/'/g,'&#039;');
 }

 function addDays(value,days){
  if(!value) return '';
  var date=new Date(value+'T00:00:00');
  if(isNaN(date.getTime())) return '';
  date.setDate(date.getDate()+days);
  var y=date.getFullYear();
  var m=String(date.getMonth()+1).padStart(2,'0');
  var d=String(date.getDate()).padStart(2,'0');
  return y+'-'+m+'-'+d;
 }

 function longDate(value){
  if(!value) return 'Datum offen';
  var date=new Date(value+'T00:00:00');
  if(isNaN(date.getTime())) return value;
  return date.toLocaleDateString('de-DE',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
 }

 function uniqueRef(){
  return 'tmp-'+Date.now()+'-'+Math.random().toString(36).slice(2,9);
 }

 function option(value,current,label){
  return '<option value="'+escapeHtml(value)+'"'+(value===current?' selected':'')+'>'+escapeHtml(label||value)+'</option>';
 }

 function programRow(item,dayRef,date){
  item=item||{};
  var type=item.type||'Programmpunkt';
  var visibility=item.visibility||'public';
  return '<div class="vtp-program-row">'+
   '<input type="time" name="start_time[]" value="'+escapeHtml((item.start||'').slice(0,5))+'" aria-label="Start">'+
   '<input type="time" name="end_time[]" value="'+escapeHtml((item.end||'').slice(0,5))+'" aria-label="Ende">'+
   '<select name="item_type[]">'+
    option('Aufbau',type)+option('Abbau',type)+option('Programmpunkt',type)+option('Musik',type)+option('Spiel',type)+
   '</select>'+
   '<input type="text" name="title[]" value="'+escapeHtml(item.title||'')+'" placeholder="Titel">'+
   '<select name="visibility[]" aria-label="Sichtbarkeit">'+
    option('public',visibility,'öffentlich')+option('private',visibility,'nicht öffentlich')+option('ticket',visibility,'Eintrittskarte')+option('members',visibility,'Mitglieder')+
   '</select>'+
   '<input type="hidden" name="item_date[]" value="'+escapeHtml(date||'')+'">'+
   '<input type="hidden" name="item_day_ref[]" value="'+escapeHtml(dayRef)+'">'+
   '<button type="button" class="vtp-icon-btn vtp-remove-program" title="Programmpunkt entfernen">✕</button>'+
  '</div>';
 }

 function linkedRow(tournament){
  var meta=[(tournament.time||'').slice(0,5),tournament.title||''].filter(Boolean).join(' · ');
  return '<div class="vtp-linked-row"><strong>Verknüpftes Turnier:</strong> '+escapeHtml(meta)+'</div>';
 }

 function dayCard(day,items,linked){
  var ref=day.ref||('id-'+day.id);
  var rows=(items||[]).map(function(item){ return programRow(item,ref,day.date); }).join('');
  var linkedRows=(linked||[]).map(linkedRow).join('');
  return '<div class="vtp-day-card" data-day-ref="'+escapeHtml(ref)+'" data-day-type="'+escapeHtml(day.type||'event')+'">'+
   '<input type="hidden" name="event_day_id[]" value="'+escapeHtml(day.id||0)+'">'+
   '<input type="hidden" name="event_day_ref[]" value="'+escapeHtml(ref)+'">'+
   '<input type="hidden" name="event_day_type[]" value="'+escapeHtml(day.type||'event')+'">'+
   '<div class="vtp-day-head"><h3></h3><p class="vtp-day-actions">'+
    '<label>Datum <input type="date" class="vtp-day-date" name="event_day[]" value="'+escapeHtml(day.date||'')+'" required></label> '+
    '<button type="button" class="button vtp-toggle-day">Einklappen</button> '+
    '<button type="button" class="button vtp-duplicate-day">Tag duplizieren</button> '+
    '<button type="button" class="button vtp-add-program">Programmpunkt hinzufügen</button> '+
    '<button type="button" class="button vtp-remove-day">Tag entfernen</button>'+
   '</p></div><div class="vtp-day-body"><div class="vtp-program-rows">'+rows+linkedRows+'</div></div></div>';
 }

 function cardType(card){ return card && card.dataset.dayType ? card.dataset.dayType : 'event'; }
 function cardRef(card){ return card && card.dataset.dayRef ? card.dataset.dayRef : ''; }
 function cardDate(card){ var input=card&&card.querySelector('.vtp-day-date'); return input?input.value:''; }

 function syncCard(card){
  if(!card) return;
  var date=cardDate(card);
  var ref=cardRef(card);
  card.querySelectorAll('input[name="item_date[]"]').forEach(function(input){ input.value=date; });
  card.querySelectorAll('input[name="item_day_ref[]"]').forEach(function(input){ input.value=ref; });
 }

 function applyHeadings(box){
  var eventNo=0;
  box.querySelectorAll('.vtp-day-card').forEach(function(card){
   var type=cardType(card);
   var heading=card.querySelector('.vtp-day-head h3');
   if(!heading) return;
   var prefix;
   if(type==='setup') prefix='Aufbau';
   else if(type==='teardown') prefix='Abbau';
   else { eventNo++; prefix='Tag '+eventNo; }
   heading.textContent=prefix+' – '+longDate(cardDate(card));
   syncCard(card);
  });
 }

 function datesFor(box,type){
  return Array.from(box.querySelectorAll('.vtp-day-card')).filter(function(card){
   return !type || cardType(card)===type;
  }).map(cardDate).filter(Boolean).sort();
 }

 function createDay(type,date,item){
  return {
   id:0,
   ref:uniqueRef(),
   type:type,
   date:date,
   items:item?[item]:[]
  };
 }

 ready(function(){
  var data=window.VTPEventDayPlan;
  if(!data) return;
  var box=document.getElementById('vtp-event-days');
  if(!box) return;
  var form=box.closest('form');
  if(!form) return;

  var itemsByDay={};
  (data.items||[]).forEach(function(item){
   var key=String(item.dayId||0);
   if(!itemsByDay[key]) itemsByDay[key]=[];
   itemsByDay[key].push(item);
  });

  var linkedByDate={};
  (data.linkedTournaments||[]).forEach(function(tournament){
   if(!linkedByDate[tournament.date]) linkedByDate[tournament.date]=[];
   linkedByDate[tournament.date].push(tournament);
  });

  var html='';
  (data.days||[]).forEach(function(day){
   var linked=day.type==='event' ? (linkedByDate[day.date]||[]) : [];
   html+=dayCard({id:day.id,ref:'id-'+day.id,type:day.type,date:day.date},itemsByDay[String(day.id)]||[],linked);
  });
  box.innerHTML=html;

  var addRow=form.querySelector('.vtp-event-add-row');
  var addDay=document.getElementById('vtp-add-day');
  if(!addRow){
   addRow=document.createElement('div');
   addRow.className='vtp-event-add-row';
   form.insertBefore(addRow,box);
  }
  addRow.classList.add('vtp-event-day-actions-top');

  if(addDay){
   addDay.textContent='Neuen Tag hinzufügen';
   addDay.classList.add('vtp-event-add-day');
   addRow.appendChild(addDay);
  }

  function makeSpecialButton(label,type){
   var button=document.createElement('button');
   button.type='button';
   button.className='button vtp-event-add-day vtp-event-add-special';
   button.textContent=label;
   button.dataset.dayType=type;
   addRow.appendChild(button);
   return button;
  }

  var addSetup=makeSpecialButton('Aufbau hinzufügen','setup');
  var addTeardown=makeSpecialButton('Abbau hinzufügen','teardown');

  function insertDay(day,position){
   var linked=day.type==='event' ? (linkedByDate[day.date]||[]) : [];
   var wrap=document.createElement('div');
   wrap.innerHTML=dayCard(day,day.items||[],linked);
   var card=wrap.firstElementChild;
   if(position==='first') box.insertBefore(card,box.firstChild);
   else if(position==='before-teardown'){
    var teardown=Array.from(box.querySelectorAll('.vtp-day-card')).find(function(c){ return cardType(c)==='teardown'; });
    if(teardown) box.insertBefore(card,teardown); else box.appendChild(card);
   } else box.appendChild(card);
   applyHeadings(box);
   return card;
  }

  if(addDay){
   addDay.addEventListener('click',function(event){
    event.preventDefault();
    event.stopPropagation();
    var eventDates=datesFor(box,'event');
    var base=eventDates.length?eventDates[eventDates.length-1]:(data.startDate||'');
    var next=base?addDays(base,1):'';
    insertDay(createDay('event',next,null),'before-teardown');
   });
  }

  addSetup.addEventListener('click',function(){
   var allDates=datesFor(box);
   var base=allDates.length?allDates[0]:(data.startDate||'');
   var date=base?addDays(base,-1):'';
   insertDay(createDay('setup',date,{type:'Aufbau',title:'Aufbau',visibility:'public'}),'first');
  });

  addTeardown.addEventListener('click',function(){
   var allDates=datesFor(box);
   var base=allDates.length?allDates[allDates.length-1]:(data.endDate||data.startDate||'');
   var date=base?addDays(base,1):'';
   insertDay(createDay('teardown',date,{type:'Abbau',title:'Abbau',visibility:'public'}),'last');
  });

  document.addEventListener('click',function(event){
   var addProgram=event.target.closest && event.target.closest('.vtp-add-program');
   if(addProgram){
    window.setTimeout(function(){
     var card=addProgram.closest('.vtp-day-card');
     if(!card) return;
     var rows=card.querySelectorAll('.vtp-program-row');
     var row=rows[rows.length-1];
     if(!row) return;
     var type=row.querySelector('select[name="item_type[]"]');
     var title=row.querySelector('input[name="title[]"]');
     if(type && !row.querySelector('input[name="item_day_ref[]"]')) type.value='Programmpunkt';
     if(title && !row.querySelector('input[name="item_day_ref[]"]')) title.value='';
     if(!row.querySelector('input[name="item_day_ref[]"]')){
      var hidden=document.createElement('input');
      hidden.type='hidden'; hidden.name='item_day_ref[]'; hidden.value=cardRef(card);
      row.appendChild(hidden);
     }
     syncCard(card);
     applyHeadings(box);
    },0);
   }

   if(event.target.closest && (event.target.closest('.vtp-remove-day') || event.target.closest('.vtp-toggle-day'))){
    window.setTimeout(function(){ applyHeadings(box); },0);
   }
  });

  document.addEventListener('change',function(event){
   if(event.target.matches && event.target.matches('#vtp-event-days .vtp-day-date')){
    var card=event.target.closest('.vtp-day-card');
    syncCard(card);
    window.setTimeout(function(){ applyHeadings(box); },0);
   }
  });

  form.addEventListener('submit',function(){
   box.querySelectorAll('.vtp-day-card').forEach(syncCard);
  });

  applyHeadings(box);
 });
})();
