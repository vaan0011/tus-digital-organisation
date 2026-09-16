(function(){
 'use strict';

 function normalizeUrl(value){
  value=(value || '').trim();
  if(!value) return '';
  if(value.indexOf('//')===0) return 'https:' + value;
  if(!/^https?:\/\//i.test(value)) return 'https://' + value;
  return value;
 }

 function prepare(input){
  if(!input || input.dataset.vtpUrlPrepared==='1') return;
  input.dataset.vtpUrlPrepared='1';
  input.type='text';
  input.inputMode='url';
  input.autocapitalize='none';
  input.spellcheck=false;
  input.addEventListener('blur',function(){
   if(input.value.trim()) input.value=normalizeUrl(input.value);
  });
 }

 function prepareAll(root){
  (root || document).querySelectorAll('input[type="url"], input[data-vtp-url]').forEach(prepare);
 }

 document.addEventListener('DOMContentLoaded',function(){
  prepareAll(document);
 });

 document.addEventListener('focusin',function(event){
  var input=event.target;
  if(input && input.matches && input.matches('input[type="url"], input[data-vtp-url]')) prepare(input);
 });

 document.addEventListener('submit',function(event){
  if(!event.target || !event.target.matches('form')) return;
  event.target.querySelectorAll('input[data-vtp-url-prepared="1"]').forEach(function(input){
   if(input.value.trim()) input.value=normalizeUrl(input.value);
  });
 },true);
})();
