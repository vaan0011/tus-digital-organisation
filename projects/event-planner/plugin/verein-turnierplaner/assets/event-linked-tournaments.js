(function(){
 'use strict';

 function ready(fn){
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',fn);
  else fn();
 }

 function findTournamentCard(){
  var cards=Array.from(document.querySelectorAll('.vtp-event-edit-summary-card'));
  return cards.find(function(card){
   var heading=card.querySelector('h3');
   return heading && heading.textContent.trim()==='Verknüpfte Turniere';
  }) || null;
 }

 ready(function(){
  var data=window.VTPEventLinkedTournaments;
  if(!data) return;
  var card=findTournamentCard();
  if(!card) return;

  var heading=card.querySelector('h3');
  Array.from(card.children).forEach(function(child){
   if(child!==heading) child.remove();
  });

  if(data.items && data.items.length){
   var list=document.createElement('div');
   list.className='vtp-event-linked-tournament-list';

   data.items.forEach(function(item){
    var row=document.createElement('div');
    row.className='vtp-event-linked-tournament-item';

    var content=document.createElement('div');
    content.className='vtp-event-linked-tournament-content';
    var name=document.createElement('strong');
    name.textContent=item.name;
    content.appendChild(name);

    var meta=[item.type,item.date,item.time ? item.time+' Uhr' : ''].filter(Boolean).join(' · ');
    if(meta){
     var metaNode=document.createElement('span');
     metaNode.textContent=meta;
     content.appendChild(metaNode);
    }

    var open=document.createElement('a');
    open.className='button vtp-event-outline-button vtp-event-linked-tournament-open';
    open.href=item.url;
    open.textContent='Öffnen';
    open.setAttribute('aria-label',item.name+' im Turnierplan öffnen');

    row.appendChild(content);
    row.appendChild(open);
    list.appendChild(row);
   });
   card.appendChild(list);
  } else {
   var empty=document.createElement('p');
   empty.className='description vtp-event-linked-tournament-empty';
   empty.textContent='Noch keine Turniere verknüpft. Die Zuordnung erfolgt im Turnier unter „Event-Zuordnung“.';
   card.appendChild(empty);
  }

  var actions=document.createElement('div');
  actions.className='vtp-event-linked-tournament-actions';
  var manage=document.createElement('a');
  manage.className='button vtp-event-outline-button';
  manage.href=data.manageUrl;
  manage.textContent='Turnierplan öffnen';
  actions.appendChild(manage);
  card.appendChild(actions);
 });
})();
