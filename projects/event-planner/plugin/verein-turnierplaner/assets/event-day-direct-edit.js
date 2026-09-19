(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function simplifyDayCards(box){
  if(!box) return;

  box.querySelectorAll('.vtp-day-card').forEach(function(card){
   var date=card.querySelector('.vtp-day-date');
   if(date){
    date.readOnly=false;
    date.classList.remove('is-locked');
   }

   var time=card.querySelector('.vtp-day-time');
   if(time){
    time.readOnly=false;
    time.classList.remove('is-locked');
   }

   card.querySelectorAll('.vtp-edit-day,.vtp-save-day').forEach(function(button){
    button.remove();
   });
  });
 }

 ready(function(){
  var box=document.getElementById('vtp-event-days');
  if(!box) return;

  var observer=new MutationObserver(function(){
   window.setTimeout(function(){ simplifyDayCards(box); },0);
  });
  observer.observe(box,{childList:true,subtree:true});

  window.setTimeout(function(){ simplifyDayCards(box); },0);
 });
})();
