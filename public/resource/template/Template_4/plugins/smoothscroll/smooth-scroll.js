(function(window,factory){if(typeof define==='function'&&define.amd){define([],factory(window));}else if(typeof exports==='object'){module.exports=factory(window);}else{window.SmoothScroll=factory(window);}})(typeof global!=='undefined'?global:this.window||this.global,(function(window){'use strict';var supports='querySelector'in document&&'addEventListener'in window&&'requestAnimationFrame'in window&&'closest'in window.Element.prototype;var defaults={ignore:'[data-scroll-ignore]',header:null,speed:500,offset:0,easing:'easeInOutCubic',customEasing:null,before:function(){},after:function(){}};var extend=function(){var extended={};var deep=false;var i=0;var length=arguments.length;var merge=function(obj){for(var prop in obj){if(obj.hasOwnProperty(prop)){extended[prop]=obj[prop];}}};for(;i<length;i++){var obj=arguments[i];merge(obj);}
return extended;};var getHeight=function(elem){return parseInt(window.getComputedStyle(elem).height,10);};var escapeCharacters=function(id){if(id.charAt(0)==='#'){id=id.substr(1);}
var string=String(id);var length=string.length;var index=-1;var codeUnit;var result='';var firstCodeUnit=string.charCodeAt(0);while(++index<length){codeUnit=string.charCodeAt(index);if(codeUnit===0x0000){throw new InvalidCharacterError('Invalid character: the input contains U+0000.');}
if((codeUnit>=0x0001&&codeUnit<=0x001F)||codeUnit==0x007F||(index===0&&codeUnit>=0x0030&&codeUnit<=0x0039)||(index===1&&codeUnit>=0x0030&&codeUnit<=0x0039&&firstCodeUnit===0x002D)){result+='\\'+ codeUnit.toString(16)+' ';continue;}
if(codeUnit>=0x0080||codeUnit===0x002D||codeUnit===0x005F||codeUnit>=0x0030&&codeUnit<=0x0039||codeUnit>=0x0041&&codeUnit<=0x005A||codeUnit>=0x0061&&codeUnit<=0x007A){result+=string.charAt(index);continue;}
result+='\\'+ string.charAt(index);}
return'#'+ result;};var easingPattern=function(settings,time){var pattern;if(settings.easing==='easeInQuad')pattern=time*time;if(settings.easing==='easeOutQuad')pattern=time*(2- time);if(settings.easing==='easeInOutQuad')pattern=time<0.5?2*time*time:-1+(4- 2*time)*time;if(settings.easing==='easeInCubic')pattern=time*time*time;if(settings.easing==='easeOutCubic')pattern=(--time)*time*time+ 1;if(settings.easing==='easeInOutCubic')pattern=time<0.5?4*time*time*time:(time- 1)*(2*time- 2)*(2*time- 2)+ 1;if(settings.easing==='easeInQuart')pattern=time*time*time*time;if(settings.easing==='easeOutQuart')pattern=1-(--time)*time*time*time;if(settings.easing==='easeInOutQuart')pattern=time<0.5?8*time*time*time*time:1- 8*(--time)*time*time*time;if(settings.easing==='easeInQuint')pattern=time*time*time*time*time;if(settings.easing==='easeOutQuint')pattern=1+(--time)*time*time*time*time;if(settings.easing==='easeInOutQuint')pattern=time<0.5?16*time*time*time*time*time:1+ 16*(--time)*time*time*time*time;if(!!settings.customEasing)pattern=settings.customEasing(time);return pattern||time;};var getViewportHeight=function(){return Math.max(document.documentElement.clientHeight,window.innerHeight||0);};var getDocumentHeight=function(){return parseInt(window.getComputedStyle(document.documentElement).height,10);};var getEndLocation=function(anchor,headerHeight,offset){var location=0;if(anchor.offsetParent){do{location+=anchor.offsetTop;anchor=anchor.offsetParent;}while(anchor);}
location=Math.max(location- headerHeight- offset,0);return Math.min(location,getDocumentHeight()- getViewportHeight());};var getHeaderHeight=function(header){return!header?0:(getHeight(header)+ header.offsetTop);};var adjustFocus=function(anchor,endLocation,isNum){if(isNum)return;anchor.focus();if(document.activeElement.id!==anchor.id){anchor.setAttribute('tabindex','-1');anchor.focus();anchor.style.outline='none';}
window.scrollTo(0,endLocation);};var reduceMotion=function(settings){if('matchMedia'in window&&window.matchMedia('(prefers-reduced-motion)').matches){return true;}
return false;};var SmoothScroll=function(selector,options){var smoothScroll={};var settings,anchor,toggle,fixedHeader,headerHeight,eventTimeout,animationInterval;smoothScroll.cancelScroll=function(){cancelAnimationFrame(animationInterval);};smoothScroll.animateScroll=function(anchor,toggle,options){var animateSettings=extend(settings||defaults,options||{});var isNum=Object.prototype.toString.call(anchor)==='[object Number]'?true:false;var anchorElem=isNum||!anchor.tagName?null:anchor;if(!isNum&&!anchorElem)return;var startLocation=window.pageYOffset;if(animateSettings.header&&!fixedHeader){fixedHeader=document.querySelector(animateSettings.header);}
if(!headerHeight){headerHeight=getHeaderHeight(fixedHeader);}
var endLocation=isNum?anchor:getEndLocation(anchorElem,headerHeight,parseInt((typeof animateSettings.offset==='function'?animateSettings.offset():animateSettings.offset),10));var distance=endLocation- startLocation;var documentHeight=getDocumentHeight();var timeLapsed=0;var start,percentage,position;var stopAnimateScroll=function(position,endLocation){var currentLocation=window.pageYOffset;if(position==endLocation||currentLocation==endLocation||((startLocation<endLocation&&window.innerHeight+ currentLocation)>=documentHeight)){smoothScroll.cancelScroll();adjustFocus(anchor,endLocation,isNum);animateSettings.after(anchor,toggle);start=null;return true;}};var loopAnimateScroll=function(timestamp){if(!start){start=timestamp;}
timeLapsed+=timestamp- start;percentage=(timeLapsed/parseInt(animateSettings.speed,10));percentage=(percentage>1)?1:percentage;position=startLocation+(distance*easingPattern(animateSettings,percentage));window.scrollTo(0,Math.floor(position));if(!stopAnimateScroll(position,endLocation)){window.requestAnimationFrame(loopAnimateScroll);start=timestamp;}};if(window.pageYOffset===0){window.scrollTo(0,0);}
animateSettings.before(anchor,toggle);smoothScroll.cancelScroll();window.requestAnimationFrame(loopAnimateScroll);};var hashChangeHandler=function(event){var hash;try{hash=escapeCharacters(decodeURIComponent(window.location.hash));}catch(e){hash=escapeCharacters(window.location.hash);}
if(!anchor)return;anchor.id=anchor.getAttribute('data-scroll-id');smoothScroll.animateScroll(anchor,toggle);anchor=null;toggle=null;};var clickHandler=function(event){if(reduceMotion(settings))return;if(event.button!==0||event.metaKey||event.ctrlKey)return;toggle=event.target.closest(selector);if(!toggle||toggle.tagName.toLowerCase()!=='a'||event.target.closest(settings.ignore))return;if(toggle.hostname!==window.location.hostname||toggle.pathname!==window.location.pathname||!/#/.test(toggle.href))return;var hash;try{hash=escapeCharacters(decodeURIComponent(toggle.hash));}catch(e){hash=escapeCharacters(toggle.hash);}
if(hash==='#'){event.preventDefault();anchor=document.body;var id=anchor.id?anchor.id:'smooth-scroll-top';anchor.setAttribute('data-scroll-id',id);anchor.id='';if(window.location.hash.substring(1)===id){hashChangeHandler();}else{window.location.hash=id;}
return;}
anchor=document.querySelector(hash);if(!anchor)return;anchor.setAttribute('data-scroll-id',anchor.id);anchor.id='';if(toggle.hash===window.location.hash){event.preventDefault();hashChangeHandler();}};var resizeThrottler=function(event){if(!eventTimeout){eventTimeout=setTimeout((function(){eventTimeout=null;headerHeight=getHeaderHeight(fixedHeader);}),66);}};smoothScroll.destroy=function(){if(!settings)return;document.removeEventListener('click',clickHandler,false);window.removeEventListener('resize',resizeThrottler,false);smoothScroll.cancelScroll();settings=null;anchor=null;toggle=null;fixedHeader=null;headerHeight=null;eventTimeout=null;animationInterval=null;};smoothScroll.init=function(options){if(!supports)return;smoothScroll.destroy();settings=extend(defaults,options||{});fixedHeader=settings.header?document.querySelector(settings.header):null;headerHeight=getHeaderHeight(fixedHeader);document.addEventListener('click',clickHandler,false);window.addEventListener('hashchange',hashChangeHandler,false);if(fixedHeader){window.addEventListener('resize',resizeThrottler,false);}};smoothScroll.init(options);return smoothScroll;};return SmoothScroll;}));