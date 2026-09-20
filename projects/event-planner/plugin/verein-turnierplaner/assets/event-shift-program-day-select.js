(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function formatProgramDay(value){
  var match=/^(\d{4})-(\d{2})-(\d{2})$/.exec(value||'');
  if(!match) return value||'';
  var date=new Date(Date.UTC(Number(match[1]),Number(match[2])-1,Number(match[3])));
  try{
   return new Intl.DateTimeFormat('de-DE',{
    weekday:'long',
    day:'2-digit',
    month:'2-digit',
    year:'numeric',
    timeZone:'UTC'
   }).format(date);
  } catch(e){
   return match[3]+'.'+match[2]+'.'+match[1];
  }
 }

 function init(){
  var data=window.VTPEventShifts||{};
  var input=document.querySelector('.vtp-shift-generator [data-field="generatorDate"]');
  if(!input || input.dataset.programDaySelectReady==='1') return;
  input.dataset.programDaySelectReady='1';

  var windows=data.programWindows||{};
  var dates=Object.keys(windows).filter(function(date){
   var item=windows[date]||{};
   return /^\d{4}-\d{2}-\d{2}$/.test(date) && item.start && item.end;
  }).sort();

  var label=input.closest('.vtp-shift-field');
  var labelText=label ? label.querySelector('.vtp-shift-field-label') : null;
  if(labelText) labelText.textContent='Programmtag';

  var select=document.createElement('select');
  select.dataset.field='generatorProgramDay';
  select.setAttribute('aria-label','Programmtag auswählen');

  if(dates.length){
   dates.forEach(function(date){
    var option=document.createElement('option');
    option.value=date;
    option.textContent=formatProgramDay(date);
    select.appendChild(option);
   });

   var selected=dates.indexOf(input.value)>=0 ? input.value : dates[0];
   select.value=selected;
   input.value=selected;
  } else {
   var empty=document.createElement('option');
   empty.value='';
   empty.textContent='Noch keine Programmtage verfügbar';
   select.appendChild(empty);
   select.disabled=true;
   input.value='';
  }

  input.hidden=true;
  input.setAttribute('aria-hidden','true');
  input.tabIndex=-1;
  input.insertAdjacentElement('afterend',select);

  function sync(){
   input.value=select.value;
   input.dispatchEvent(new Event('change',{bubbles:true}));
  }

  select.addEventListener('change',sync);
  sync();

  if(!dates.length){
   var hint=document.querySelector('.vtp-shift-generator .vtp-shift-program-hint');
   if(hint) hint.textContent='Im Ablaufplan gibt es noch keinen Programmtag mit vollständiger Start- und Endzeit.';
  }
 }

 ready(function(){
  window.setTimeout(init,0);
 });
})();
