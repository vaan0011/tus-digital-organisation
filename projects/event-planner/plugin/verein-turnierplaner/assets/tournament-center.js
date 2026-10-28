(function(){
 'use strict';
 function ready(){
  var nav=document.querySelector('.vtp-tournament-workspaces');
  if(!nav) return;
  // Navigational shortcuts only: never hide tournament functionality.
  var groups={
   organisation:'turnierdaten',
   teilnehmer:'teams',
   spielplan:'spielplan',
   spieltag:'turnierleitung'
  };
  var buttons=nav.querySelectorAll('[data-vtp-tournament-tab]');
  // Recover any previously hidden content (for example after partial page updates).
  document.querySelectorAll('[data-vtp-tournament-panel]').forEach(function(panel){
   panel.hidden=false;
   panel.removeAttribute('data-vtp-tournament-panel');
  });
  buttons.forEach(function(button){
   button.setAttribute('aria-pressed','false');
   button.addEventListener('click',function(){
    var key=button.getAttribute('data-vtp-tournament-tab');
    var target=document.getElementById(groups[key]);
    if(!target) return;
    buttons.forEach(function(item){ item.setAttribute('aria-pressed',String(item===button)); });
    var box=target.closest('.vtp-top-grid');
    (box&&key==='organisation'?box:target).scrollIntoView({behavior:'smooth',block:'start'});
    if(history.replaceState) history.replaceState(null,'','#'+target.id);
   });
  });
  // Existing deep links to Teams, Groups, Referees, etc. remain usable.
 }
 if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',ready);
 else ready();
})();
