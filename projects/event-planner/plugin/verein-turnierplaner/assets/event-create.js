(function($){
 'use strict';

 function addSponsorRow(){
  var template=document.getElementById('vtp-sponsor-row-template');
  var list=document.querySelector('[data-sponsor-list]');
  if(!template || !list) return;
  list.insertAdjacentHTML('beforeend',template.innerHTML.replace(/__INDEX__/g,String(list.children.length)));
 }

 function ensureSponsorRow(){
  var list=document.querySelector('[data-sponsor-list]');
  if(list && !list.querySelector('[data-sponsor-row]')) addSponsorRow();
 }

 function openMediaPicker(button){
  if(typeof wp==='undefined' || !wp.media) return;
  var row=button.closest('[data-sponsor-row]');
  if(!row) return;
  var idInput=row.querySelector('[data-logo-id]');
  var label=row.querySelector('[data-logo-label]');
  var frame=wp.media({
   title:'Sponsorlogo auswählen',
   button:{text:'Logo verwenden'},
   library:{type:'image'},
   multiple:false
  });
  frame.on('select',function(){
   var attachment=frame.state().get('selection').first().toJSON();
   if(idInput) idInput.value=attachment.id || '';
   if(label) label.textContent=attachment.filename || attachment.title || 'Logo ausgewählt';
  });
  frame.open();
 }

 document.addEventListener('click',function(event){
  var addButton=event.target.closest('[data-action="add-sponsor"]');
  if(addButton){
   event.preventDefault();
   addSponsorRow();
   return;
  }

  var mediaButton=event.target.closest('.vtp-sponsor-media-button');
  if(mediaButton){
   event.preventDefault();
   openMediaPicker(mediaButton);
   return;
  }

  var removeButton=event.target.closest('.vtp-remove-sponsor');
  if(removeButton){
   event.preventDefault();
   var row=removeButton.closest('[data-sponsor-row]');
   if(row) row.remove();
   ensureSponsorRow();
  }
 });
})(jQuery);
