(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 ready(function(){
  var obsoleteTitles=[
   'Helferbedarf für das Event',
   'Helferschichten generieren',
   'Schichtübersicht'
  ];

  Array.from(document.querySelectorAll('.vtp-card')).forEach(function(card){
   var heading=card.querySelector('h2');
   if(!heading) return;
   if(obsoleteTitles.indexOf(heading.textContent.trim())!==-1){
    card.remove();
   }
  });
 });
})();
