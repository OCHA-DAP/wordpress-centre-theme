/* -----------------------------------------------
/* Author : Vincent Garreau  - vincentgarreau.com
/* MIT license: http://opensource.org/licenses/MIT
/* GitHub : https://github.com/VincentGarreau/particles.js
/* How to use? : Check the GitHub README
/* v1.0.3
/* ----------------------------------------------- */
function launchParticlesJS(a,e){var i=document.querySelector("#"+a+" > canvas");pJS={canvas:{el:i,w:i.offsetWidth,h:i.offsetHeight},particles:{color:"#fff",shape:"circle",opacity:1,size:2.5,size_random:true,nb:200,line_linked:{enable_auto:true,distance:100,color:"#fff",opacity:1,width:1,condensed_mode:{enable:true,rotateX:65000,rotateY:65000}},anim:{enable:true,speed:1},array:[]},interactivity:{enable:true,mouse:{distance:100},detect_on:"canvas",mode:"grab",line_linked:{opacity:1},events:{onclick:{enable:true,mode:"push",nb:4}}},retina_detect:false,fn:{vendors:{interactivity:{}}}};if(e){if(e.particles){var b=e.particles;if(b.color){pJS.particles.color=b.color}if(b.shape){pJS.particles.shape=b.shape}if(b.opacity){pJS.particles.opacity=b.opacity}if(b.size){pJS.particles.size=b.size}if(b.size_random==false){pJS.particles.size_random=b.size_random}if(b.nb){pJS.particles.nb=b.nb}if(b.line_linked){var j=b.line_linked;if(j.enable_auto==false){pJS.particles.line_linked.enable_auto=j.enable_auto}if(j.distance){pJS.particles.line_linked.distance=j.distance}if(j.color){pJS.particles.line_linked.color=j.color}if(j.opacity){pJS.particles.line_linked.opacity=j.opacity}if(j.width){pJS.particles.line_linked.width=j.width}if(j.condensed_mode){var g=j.condensed_mode;if(g.enable==false){pJS.particles.line_linked.condensed_mode.enable=g.enable}if(g.rotateX){pJS.particles.line_linked.condensed_mode.rotateX=g.rotateX}if(g.rotateY){pJS.particles.line_linked.condensed_mode.rotateY=g.rotateY}}}if(b.anim){var k=b.anim;if(k.enable==false){pJS.particles.anim.enable=k.enable}if(k.speed){pJS.particles.anim.speed=k.speed}}}if(e.interactivity){var c=e.interactivity;if(c.enable==false){pJS.interactivity.enable=c.enable}if(c.mouse){if(c.mouse.distance){pJS.interactivity.mouse.distance=c.mouse.distance}}if(c.detect_on){pJS.interactivity.detect_on=c.detect_on}if(c.mode){pJS.interactivity.mode=c.mode}if(c.line_linked){if(c.line_linked.opacity){pJS.interactivity.line_linked.opacity=c.line_linked.opacity}}if(c.events){var d=c.events;if(d.onclick){var h=d.onclick;if(h.enable==false){pJS.interactivity.events.onclick.enable=false}if(h.mode!="push"){pJS.interactivity.events.onclick.mode=h.mode}if(h.nb){pJS.interactivity.events.onclick.nb=h.nb}}}}pJS.retina_detect=e.retina_detect}pJS.particles.color_rgb=hexToRgb(pJS.particles.color);pJS.particles.line_linked.color_rgb_line=hexToRgb(pJS.particles.line_linked.color);if(pJS.retina_detect&&window.devicePixelRatio>1){pJS.retina=true;pJS.canvas.pxratio=window.devicePixelRatio;pJS.canvas.w=pJS.canvas.el.offsetWidth*pJS.canvas.pxratio;pJS.canvas.h=pJS.canvas.el.offsetHeight*pJS.canvas.pxratio;pJS.particles.anim.speed=pJS.particles.anim.speed*pJS.canvas.pxratio;pJS.particles.line_linked.distance=pJS.particles.line_linked.distance*pJS.canvas.pxratio;pJS.particles.line_linked.width=pJS.particles.line_linked.width*pJS.canvas.pxratio;pJS.interactivity.mouse.distance=pJS.interactivity.mouse.distance*pJS.canvas.pxratio}pJS.fn.canvasInit=function(){pJS.canvas.ctx=pJS.canvas.el.getContext("2d")};pJS.fn.canvasSize=function(){pJS.canvas.el.width=pJS.canvas.w;pJS.canvas.el.height=pJS.canvas.h;window.onresize=function(){if(pJS){pJS.canvas.w=pJS.canvas.el.offsetWidth;pJS.canvas.h=pJS.canvas.el.offsetHeight;if(pJS.retina){pJS.canvas.w*=pJS.canvas.pxratio;pJS.canvas.h*=pJS.canvas.pxratio}pJS.canvas.el.width=pJS.canvas.w;pJS.canvas.el.height=pJS.canvas.h;pJS.fn.canvasPaint();if(!pJS.particles.anim.enable){pJS.fn.particlesRemove();pJS.fn.canvasRemove();f()}}}};pJS.fn.canvasPaint=function(){pJS.canvas.ctx.fillRect(0,0,pJS.canvas.w,pJS.canvas.h)};pJS.fn.canvasRemove=function(){pJS.canvas.ctx.clearRect(0,0,pJS.canvas.w,pJS.canvas.h)};pJS.fn.particle=function(n,o,m){this.x=m?m.x:Math.random()*pJS.canvas.w;this.y=m?m.y:Math.random()*pJS.canvas.h;this.radius=(pJS.particles.size_random?Math.random():1)*pJS.particles.size;if(pJS.retina){this.radius*=pJS.canvas.pxratio}this.color=n;this.opacity=o;this.vx=-0.5+Math.random();this.vy=-0.5+Math.random();this.draw=function(){pJS.canvas.ctx.fillStyle="rgba("+this.color.r+","+this.color.g+","+this.color.b+","+this.opacity+")";pJS.canvas.ctx.beginPath();switch(pJS.particles.shape){case"circle":pJS.canvas.ctx.arc(this.x,this.y,this.radius,0,Math.PI*2,false);break;case"edge":pJS.canvas.ctx.rect(this.x,this.y,this.radius*2,this.radius*2);break;case"triangle":pJS.canvas.ctx.moveTo(this.x,this.y-this.radius);pJS.canvas.ctx.lineTo(this.x+this.radius,this.y+this.radius);pJS.canvas.ctx.lineTo(this.x-this.radius,this.y+this.radius);pJS.canvas.ctx.closePath();break}pJS.canvas.ctx.fill()}};pJS.fn.particlesCreate=function(){for(var m=0;m<pJS.particles.nb;m++){pJS.particles.array.push(new pJS.fn.particle(pJS.particles.color_rgb,pJS.particles.opacity))}};pJS.fn.particlesAnimate=function(){for(var n=0;n<pJS.particles.array.length;n++){var q=pJS.particles.array[n];q.x+=q.vx*(pJS.particles.anim.speed/2);q.y+=q.vy*(pJS.particles.anim.speed/2);if(q.x-q.radius>pJS.canvas.w){q.x=q.radius}else{if(q.x+q.radius<0){q.x=pJS.canvas.w+q.radius}}if(q.y-q.radius>pJS.canvas.h){q.y=q.radius}else{if(q.y+q.radius<0){q.y=pJS.canvas.h+q.radius}}for(var m=n+1;m<pJS.particles.array.length;m++){var o=pJS.particles.array[m];if(pJS.particles.line_linked.enable_auto){pJS.fn.vendors.distanceParticles(q,o)}if(pJS.interactivity.enable){switch(pJS.interactivity.mode){case"grab":pJS.fn.vendors.interactivity.grabParticles(q,o);break}}}}};pJS.fn.particlesDraw=function(){pJS.canvas.ctx.clearRect(0,0,pJS.canvas.w,pJS.canvas.h);pJS.fn.particlesAnimate();for(var m=0;m<pJS.particles.array.length;m++){var n=pJS.particles.array[m];n.draw("rgba("+n.color.r+","+n.color.g+","+n.color.b+","+n.opacity+")")}};pJS.fn.particlesRemove=function(){pJS.particles.array=[]};pJS.fn.vendors.distanceParticles=function(t,r){var o=t.x-r.x,n=t.y-r.y,s=Math.sqrt(o*o+n*n);if(s<=pJS.particles.line_linked.distance){var m=pJS.particles.line_linked.color_rgb_line;pJS.canvas.ctx.beginPath();pJS.canvas.ctx.strokeStyle="rgba("+m.r+","+m.g+","+m.b+","+(pJS.particles.line_linked.opacity-s/pJS.particles.line_linked.distance)+")";pJS.canvas.ctx.moveTo(t.x,t.y);pJS.canvas.ctx.lineTo(r.x,r.y);pJS.canvas.ctx.lineWidth=pJS.particles.line_linked.width;pJS.canvas.ctx.stroke();pJS.canvas.ctx.closePath();if(pJS.particles.line_linked.condensed_mode.enable){var o=t.x-r.x,n=t.y-r.y,q=o/(pJS.particles.line_linked.condensed_mode.rotateX*1000),p=n/(pJS.particles.line_linked.condensed_mode.rotateY*1000);r.vx+=q;r.vy+=p}}};pJS.fn.vendors.interactivity.listeners=function(){if(pJS.interactivity.detect_on=="window"){var m=window}else{var m=pJS.canvas.el}m.onmousemove=function(p){if(m==window){var o=p.clientX,n=p.clientY}else{var o=p.offsetX||p.clientX,n=p.offsetY||p.clientY}if(pJS){pJS.interactivity.mouse.pos_x=o;pJS.interactivity.mouse.pos_y=n;if(pJS.retina){pJS.interactivity.mouse.pos_x*=pJS.canvas.pxratio;pJS.interactivity.mouse.pos_y*=pJS.canvas.pxratio}pJS.interactivity.status="mousemove"}};m.onmouseleave=function(n){if(pJS){pJS.interactivity.mouse.pos_x=0;pJS.interactivity.mouse.pos_y=0;pJS.interactivity.status="mouseleave"}};if(pJS.interactivity.events.onclick.enable){switch(pJS.interactivity.events.onclick.mode){case"push":m.onclick=function(o){if(pJS){for(var n=0;n<pJS.interactivity.events.onclick.nb;n++){pJS.particles.array.push(new pJS.fn.particle(pJS.particles.color_rgb,pJS.particles.opacity,{x:pJS.interactivity.mouse.pos_x,y:pJS.interactivity.mouse.pos_y}))}}};break;case"remove":m.onclick=function(n){pJS.particles.array.splice(0,pJS.interactivity.events.onclick.nb)};break}}};pJS.fn.vendors.interactivity.grabParticles=function(r,q){var u=r.x-q.x,s=r.y-q.y,p=Math.sqrt(u*u+s*s);var t=r.x-pJS.interactivity.mouse.pos_x,n=r.y-pJS.interactivity.mouse.pos_y,o=Math.sqrt(t*t+n*n);if(p<=pJS.particles.line_linked.distance&&o<=pJS.interactivity.mouse.distance&&pJS.interactivity.status=="mousemove"){var m=pJS.particles.line_linked.color_rgb_line;pJS.canvas.ctx.beginPath();pJS.canvas.ctx.strokeStyle="rgba("+m.r+","+m.g+","+m.b+","+(pJS.interactivity.line_linked.opacity-o/pJS.interactivity.mouse.distance)+")";pJS.canvas.ctx.moveTo(r.x,r.y);pJS.canvas.ctx.lineTo(pJS.interactivity.mouse.pos_x,pJS.interactivity.mouse.pos_y);pJS.canvas.ctx.lineWidth=pJS.particles.line_linked.width;pJS.canvas.ctx.stroke();pJS.canvas.ctx.closePath()}};pJS.fn.vendors.destroy=function(){cancelAnimationFrame(pJS.fn.requestAnimFrame);i.remove();delete pJS};function f(){pJS.fn.canvasInit();pJS.fn.canvasSize();pJS.fn.canvasPaint();pJS.fn.particlesCreate();pJS.fn.particlesDraw()}function l(){pJS.fn.particlesDraw();pJS.fn.requestAnimFrame=requestAnimFrame(l)}f();if(pJS.particles.anim.enable){l()}if(pJS.interactivity.enable){pJS.fn.vendors.interactivity.listeners()}}window.requestAnimFrame=(function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(a){window.setTimeout(a,1000/60)}})();window.cancelRequestAnimFrame=(function(){return window.cancelAnimationFrame||window.webkitCancelRequestAnimationFrame||window.mozCancelRequestAnimationFrame||window.oCancelRequestAnimationFrame||window.msCancelRequestAnimationFrame||clearTimeout})();function hexToRgb(c){var b=/^#?([a-f\d])([a-f\d])([a-f\d])$/i;c=c.replace(b,function(e,h,f,d){return h+h+f+f+d+d});var a=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(c);return a?{r:parseInt(a[1],16),g:parseInt(a[2],16),b:parseInt(a[3],16)}:null}window.particlesJS=function(d,c){if(typeof(d)!="string"){c=d;d="particles-js"}if(!d){d="particles-js"}var b=document.createElement("canvas");b.style.width="100%";b.style.height="100%";var a=document.getElementById(d).appendChild(b);if(a!=null){launchParticlesJS(d,c)}};

/* particlesJS('dom-id', params);
/* @dom-id : set the html tag id [string, optional, default value : particles-js]
/* @params: set the params [object, optional, default values : check particles.js] */

/* config dom id (optional) + config particles params */
var numParticles = (window.innerWidth<768) ? 50 : 150;

if (document.getElementById('particles-js')) {
  particlesJS('particles-js', {
    particles: {
      color: '#fff',
      shape: 'circle', // "circle", "edge" or "triangle"
      opacity: .4,
      size: 3,
      size_random: true,
      nb: numParticles,
      line_linked: {
        enable_auto: true,
        distance: 100,
        color: '#fff',
        opacity: .7,
        width: 1,
        condensed_mode: {
          enable: false,
          rotateX: 600,
          rotateY: 600
        }
      },
      anim: {
        enable: true,
        speed: .7
      }
    },
    interactivity: {
      enable: true,
      mouse: {
        distance: 250
      },
      detect_on: 'canvas', // "canvas" or "window"
      mode: 'grab',
      line_linked: {
        opacity: .5
      },
      events: {
        onclick: {
          enable: true,
          mode: 'push', // "push" or "remove" (particles)
          nb: 8
        }
      } 
    },
    /* Retina Display Support */
    retina_detect: true
  });
}
var util = window.util = {
    getRandomID: function(min, max){
        var rand = Math.floor((Math.random() * max) + min);
        return rand;
    },

    getRandomVal: function(arr){
        var rand = arr[Math.floor(Math.random() * arr.length)];
        return rand;
    },

    removeFromArray: function(id, arr){
        var tempArray = arr;
        var pos = jQuery.inArray( id, tempArray );
        if (pos > -1) {
            tempArray.splice(pos, 1);
        }
        return tempArray;
    },

    isMobile: function(){
        var isMob = false;
        // device detection
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMob = true;
        return isMob;
    }
};
/*********************************************************************
*  #### Twitter Post Fetcher v17.0.3 ####
*  Coded by Jason Mayes 2015. A present to all the developers out there.
*  www.jasonmayes.com
*  Please keep this disclaimer with my code if you use it. Thanks. :-)
*  Got feedback or questions, ask here:
*  http://www.jasonmayes.com/projects/twitterApi/
*  Github: https://github.com/jasonmayes/Twitter-Post-Fetcher
*  Updates will be posted to this site.
*********************************************************************/
(function(root,factory){if(typeof define==='function'&&define.amd){define([],factory);}else if(typeof exports==='object'){module.exports=factory();}else{factory();}}(this,function(){var domNode='';var maxTweets=20;var parseLinks=true;var queue=[];var inProgress=false;var printTime=true;var printUser=true;var formatterFunction=null;var supportsClassName=true;var showRts=true;var customCallbackFunction=null;var showInteractionLinks=true;var showImages=false;var useEmoji=false;var targetBlank=true;var lang='en';var permalinks=true;var dataOnly=false;var script=null;var scriptAdded=false;function handleTweets(tweets){if(customCallbackFunction===null){var x=tweets.length;var n=0;var element=document.getElementById(domNode);var html='<ul>';while(n<x){html+='<li>'+tweets[n]+'</li>';n++;}
html+='</ul>';element.innerHTML=html;}else{customCallbackFunction(tweets);}}
function strip(data){return data.replace(/<b[^>]*>(.*?)<\/b>/gi,function(a,s){return s;}).replace(/class="(?!(tco-hidden|tco-display|tco-ellipsis))+.*?"|data-query-source=".*?"|dir=".*?"|rel=".*?"/gi,'');}
function targetLinksToNewWindow(el){var links=el.getElementsByTagName('a');for(var i=links.length-1;i>=0;i--){links[i].setAttribute('target','_blank');}}
function getElementsByClassName(node,classname){var a=[];var regex=new RegExp('(^| )'+classname+'( |$)');var elems=node.getElementsByTagName('*');for(var i=0,j=elems.length;i<j;i++){if(regex.test(elems[i].className)){a.push(elems[i]);}}
return a;}
function extractImageUrl(image_data){if(image_data!==undefined&&image_data.innerHTML.indexOf('data-image')>=0){var data_src=image_data.innerHTML.match(/data-image=\"([A-z0-9]+:\/\/[A-z0-9]+\.[A-z0-9]+\.[A-z0-9]+\/[A-z0-9]+\/[A-z0-9\-]+)/i)[1];return decodeURIComponent(data_src)+'.jpg';}}
var twitterFetcher={fetch:function(config){if(config.maxTweets===undefined){config.maxTweets=20;}
if(config.enableLinks===undefined){config.enableLinks=true;}
if(config.showUser===undefined){config.showUser=true;}
if(config.showTime===undefined){config.showTime=true;}
if(config.dateFunction===undefined){config.dateFunction='default';}
if(config.showRetweet===undefined){config.showRetweet=true;}
if(config.customCallback===undefined){config.customCallback=null;}
if(config.showInteraction===undefined){config.showInteraction=true;}
if(config.showImages===undefined){config.showImages=false;}
if(config.useEmoji===undefined){config.useEmoji=false;}
if(config.linksInNewWindow===undefined){config.linksInNewWindow=true;}
if(config.showPermalinks===undefined){config.showPermalinks=true;}
if(config.dataOnly===undefined){config.dataOnly=false;}
if(inProgress){queue.push(config);}else{inProgress=true;domNode=config.domId;maxTweets=config.maxTweets;parseLinks=config.enableLinks;printUser=config.showUser;printTime=config.showTime;showRts=config.showRetweet;formatterFunction=config.dateFunction;customCallbackFunction=config.customCallback;showInteractionLinks=config.showInteraction;showImages=config.showImages;useEmoji=config.useEmoji;targetBlank=config.linksInNewWindow;permalinks=config.showPermalinks;dataOnly=config.dataOnly;var head=document.getElementsByTagName('head')[0];if(script!==null){head.removeChild(script);}
script=document.createElement('script');script.type='text/javascript';if(config.list!==undefined){script.src='https://syndication.twitter.com/timeline/list?'+'callback=__twttrf.callback&dnt=false&list_slug='+
config.list.listSlug+'&screen_name='+config.list.screenName+'&suppress_response_codes=true&lang='+(config.lang||lang)+'&rnd='+Math.random();}else if(config.profile!==undefined){script.src='https://syndication.twitter.com/timeline/profile?'+'callback=__twttrf.callback&dnt=false'+'&screen_name='+config.profile.screenName+'&suppress_response_codes=true&lang='+(config.lang||lang)+'&rnd='+Math.random();}else if(config.likes!==undefined){script.src='https://syndication.twitter.com/timeline/likes?'+'callback=__twttrf.callback&dnt=false'+'&screen_name='+config.likes.screenName+'&suppress_response_codes=true&lang='+(config.lang||lang)+'&rnd='+Math.random();}else{script.src='https://cdn.syndication.twimg.com/widgets/timelines/'+
config.id+'?&lang='+(config.lang||lang)+'&callback=__twttrf.callback&'+'suppress_response_codes=true&rnd='+Math.random();}
head.appendChild(script);}},callback:function(data){if(data===undefined||data.body===undefined){inProgress=false;if(queue.length>0){twitterFetcher.fetch(queue[0]);queue.splice(0,1);}
return;}
if(!useEmoji){data.body=data.body.replace(/(<img[^c]*class="Emoji[^>]*>)|(<img[^c]*class="u-block[^>]*>)/g,'');}
if(!showImages){data.body=data.body.replace(/(<img[^c]*class="NaturalImage-image[^>]*>|(<img[^c]*class="CroppedImage-image[^>]*>))/g,'');}
if(!printUser){data.body=data.body.replace(/(<img[^c]*class="Avatar"[^>]*>)/g,'');}
var div=document.createElement('div');div.innerHTML=data.body;if(typeof(div.getElementsByClassName)==='undefined'){supportsClassName=false;}
function swapDataSrc(element){var avatarImg=element.getElementsByTagName('img')[0];avatarImg.src=avatarImg.getAttribute('data-src-2x');return element;}
var tweets=[];var authors=[];var times=[];var images=[];var rts=[];var tids=[];var permalinksURL=[];var x=0;if(supportsClassName){var tmp=div.getElementsByClassName('timeline-Tweet');while(x<tmp.length){if(tmp[x].getElementsByClassName('timeline-Tweet-retweetCredit').length>0){rts.push(true);}else{rts.push(false);}
if(!rts[x]||rts[x]&&showRts){tweets.push(tmp[x].getElementsByClassName('timeline-Tweet-text')[0]);tids.push(tmp[x].getAttribute('data-tweet-id'));if(printUser){authors.push(swapDataSrc(tmp[x].getElementsByClassName('timeline-Tweet-author')[0]));}
times.push(tmp[x].getElementsByClassName('dt-updated')[0]);permalinksURL.push(tmp[x].getElementsByClassName('timeline-Tweet-timestamp')[0]);if(tmp[x].getElementsByClassName('timeline-Tweet-media')[0]!==undefined){images.push(tmp[x].getElementsByClassName('timeline-Tweet-media')[0]);}else{images.push(undefined);}}
x++;}}else{var tmp=getElementsByClassName(div,'timeline-Tweet');while(x<tmp.length){if(getElementsByClassName(tmp[x],'timeline-Tweet-retweetCredit').length>0){rts.push(true);}else{rts.push(false);}
if(!rts[x]||rts[x]&&showRts){tweets.push(getElementsByClassName(tmp[x],'timeline-Tweet-text')[0]);tids.push(tmp[x].getAttribute('data-tweet-id'));if(printUser){authors.push(swapDataSrc(getElementsByClassName(tmp[x],'timeline-Tweet-author')[0]));}
times.push(getElementsByClassName(tmp[x],'dt-updated')[0]);permalinksURL.push(getElementsByClassName(tmp[x],'timeline-Tweet-timestamp')[0]);if(getElementsByClassName(tmp[x],'timeline-Tweet-media')[0]!==undefined){images.push(getElementsByClassName(tmp[x],'timeline-Tweet-media')[0]);}else{images.push(undefined);}}
x++;}}
if(tweets.length>maxTweets){tweets.splice(maxTweets,(tweets.length-maxTweets));authors.splice(maxTweets,(authors.length-maxTweets));times.splice(maxTweets,(times.length-maxTweets));rts.splice(maxTweets,(rts.length-maxTweets));images.splice(maxTweets,(images.length-maxTweets));permalinksURL.splice(maxTweets,(permalinksURL.length-maxTweets));}
var arrayTweets=[];var x=tweets.length;var n=0;if(dataOnly){while(n<x){arrayTweets.push({tweet:tweets[n].innerHTML,author:authors[n]?authors[n].innerHTML:'Unknown Author',author_data:{profile_url:authors[n]?authors[n].querySelector('[data-scribe="element:user_link"]').href:null,profile_image:authors[n]?authors[n].querySelector('[data-scribe="element:avatar"]').getAttribute('data-src-1x'):null,profile_image_2x:authors[n]?authors[n].querySelector('[data-scribe="element:avatar"]').getAttribute('data-src-2x'):null,screen_name:authors[n]?authors[n].querySelector('[data-scribe="element:screen_name"]').title:null,name:authors[n]?authors[n].querySelector('[data-scribe="element:name"]').title:null},time:times[n].textContent,timestamp:times[n].getAttribute('datetime').replace('+0000','Z').replace(/([\+\-])(\d\d)(\d\d)/,'$1$2:$3'),image:extractImageUrl(images[n]),rt:rts[n],tid:tids[n],permalinkURL:(permalinksURL[n]===undefined)?'':permalinksURL[n].href});n++;}}else{while(n<x){if(typeof(formatterFunction)!=='string'){var datetimeText=times[n].getAttribute('datetime');var newDate=new Date(times[n].getAttribute('datetime').replace(/-/g,'/').replace('T',' ').split('+')[0]);var dateString=formatterFunction(newDate,datetimeText);times[n].setAttribute('aria-label',dateString);if(tweets[n].textContent){if(supportsClassName){times[n].textContent=dateString;}else{var h=document.createElement('p');var t=document.createTextNode(dateString);h.appendChild(t);h.setAttribute('aria-label',dateString);times[n]=h;}}else{times[n].textContent=dateString;}}
var op='';if(parseLinks){if(targetBlank){targetLinksToNewWindow(tweets[n]);if(printUser){targetLinksToNewWindow(authors[n]);}}
if(printUser){op+='<div class="user">'+strip(authors[n].innerHTML)+'</div>';}
op+='<p class="tweet">'+strip(tweets[n].innerHTML)+'</p>';if(printTime){if(permalinks){op+='<p class="timePosted"><a href="'+permalinksURL[n]+'">'+times[n].getAttribute('aria-label')+'</a></p>';}else{op+='<p class="timePosted">'+
times[n].getAttribute('aria-label')+'</p>';}}}else{if(tweets[n].textContent){if(printUser){op+='<p class="user">'+authors[n].textContent+'</p>';}
op+='<p class="tweet">'+tweets[n].textContent+'</p>';if(printTime){op+='<p class="timePosted">'+times[n].textContent+'</p>';}}else{if(printUser){op+='<p class="user">'+authors[n].textContent+'</p>';}
op+='<p class="tweet">'+tweets[n].textContent+'</p>';if(printTime){op+='<p class="timePosted">'+times[n].textContent+'</p>';}}}
if(showInteractionLinks){op+='<p class="interact"><a href="https://twitter.com/intent/'+'tweet?in_reply_to='+tids[n]+'" class="twitter_reply_icon"'+
(targetBlank?' target="_blank">':'>')+'Reply</a><a href="https://twitter.com/intent/retweet?'+'tweet_id='+tids[n]+'" class="twitter_retweet_icon"'+
(targetBlank?' target="_blank">':'>')+'Retweet</a>'+'<a href="https://twitter.com/intent/favorite?tweet_id='+
tids[n]+'" class="twitter_fav_icon"'+
(targetBlank?' target="_blank">':'>')+'Favorite</a></p>';}
if(showImages&&images[n]!==undefined&&extractImageUrl(images[n])!==undefined){op+='<div class="media">'+'<img src="'+extractImageUrl(images[n])+'" alt="Image from tweet" />'+'</div>';}
if(showImages){arrayTweets.push(op);}else if(!showImages&&tweets[n].textContent.length){arrayTweets.push(op);}
n++;}}
handleTweets(arrayTweets);inProgress=false;if(queue.length>0){twitterFetcher.fetch(queue[0]);queue.splice(0,1);}}};window.__twttrf=twitterFetcher;window.twitterFetcher=twitterFetcher;return twitterFetcher;}));


/* ----------------------------------------------------------
 * Uncode App
 * ---------------------------------------------------------- */

(function($) {
    "use strict";
    var UNCODE = window.UNCODE || {};
    window.UNCODE = UNCODE;

    UNCODE.utils = function() {
        $('.btn-tooltip').tooltip();
        $('a').hover(function() {
            $(this).attr('data-title', $(this).attr('title'));
            $(this).removeAttr('title');
        }, function() {
            $(this).attr('title', $(this).attr('data-title'));
        });
        $('.counter').counterUp({
            delay: 10,
            time: 1500
        });
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D <small>' + SiteParameters.days + '</small> %H <small>' + SiteParameters.hours + '</small> %M <small>' + SiteParameters.minutes + '</small> %S <small>' + SiteParameters.seconds + '</small>'));
            });
        });
        var share_button_top = new Share(".share-button", {
            ui: {
                flyout: "top center",
                button_font: false,
                button_text: '',
                icon_font: false
            },
        });
        $(document).on('click', '.uncode-dot-irecommendthis', function() {
            var link = $(this),
                linkCounter = link.find('span.likes-counter');
            if (link.hasClass('active')) return false;
            var id = $(this).attr('id'),
                suffix = link.find('.dot-irecommendthis-suffix').text();
            $.post(dot_irecommendthis.ajaxurl, {
                action: 'uncode-dot-irecommendthis',
                recommend_id: id,
                suffix: suffix
            }, function(data) {
                var counter = $(data).text();
                linkCounter.html(counter);
                link.addClass('active').attr('title', 'You already recommended this');
            });
            return false;
        });

        this.get_scroll_offset = function() {

            var scroll_offset = 0;

            if ($('.menu-hide').length || $('.menu-hide-vertical').length) {
                if (UNCODE.bodyTop > UNCODE.wheight / 2) {
                    UNCODE.hideMenu(100);
                }
            }

            UNCODE.scrolling = true;

            if (($('.menu-sticky').length && !$('.menu-hide').length) || ($('.menu-sticky-vertical').length && !$('.menu-hide-vertical').length)) {
                scroll_offset += UNCODE.menuMobileHeight;
            }

            scroll_offset += UNCODE.bodyBorder;

            return scroll_offset;
        }

        $('a[href*="#"]').click(function(e) {

            var hash = (e.currentTarget).hash,
                is_scrolltop = $(e.currentTarget).hasClass('scroll-top') ? true : false,
                anchor = '';
            if ($(e.currentTarget).data('toggle') == 'tab' || $(e.currentTarget).data('toggle') == 'collapse') return;
            if ($(e.currentTarget).hasClass('woocommerce-review-link')) {
                e.preventDefault();
                if (!$('#tab-reviews').is(':visible')) {
                    $('a[href="#tab-reviews"]').trigger('click');
                }
                var calc_scroll = $('.wootabs .tab-content').offset().top;
                calc_scroll -= UNCODE.get_scroll_offset();//+ $('nav').height();

                var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                    delta = bodyTop - calc_scroll,
                    scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(delta) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
                if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

                setTimeout(function(){
                    if (scrollSpeed == 0) {
                        $('html, body').scrollTop(calc_scroll);
                        UNCODE.scrolling = false;
                    } else {
                        $('html, body').animate({
                                scrollTop: calc_scroll
                            }, scrollSpeed, 'easeInOutCubic', function() {
                                UNCODE.scrolling = false;
                            }
                        );
                    }
                }, 200);
                return;
            }
            if (hash != undefined) {
                if (location.pathname.replace(/^\//g,'') == this.pathname.replace(/^\//g,'') && location.hostname == this.hostname) {
                    var anchor = $(hash);
                    anchor = anchor.length ? anchor : this.hash.slice(1);
                }
            }

            if (is_scrolltop || anchor != '') {
                if (is_scrolltop) {
                    e.preventDefault();
                    var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                        scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(bodyTop) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
                    if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

                    if (scrollSpeed == 0) {
                        $('html, body').scrollTop(0);
                        UNCODE.scrolling = false;
                    } else {
                        $('html, body').animate({
                            scrollTop: 0
                        }, scrollSpeed, 'easeInOutCubic', function() {
                            UNCODE.scrolling = false;
                        });
                    }
                } else {
                    var scrollSection = (typeof anchor === 'string') ? $('[data-name=' + anchor + ']') : anchor;
                    $.each($('.menu-container .menu-item > a, .widget_nav_menu .menu-smart .menu-item > a'), function(index, val) {
                        var get_href = $(val).attr('href');
                        if (get_href.substring(get_href.indexOf('#')+1) == anchor) $(val).parent().addClass('active');
                        else $(val).parent().removeClass('active');
                    });
                    if (scrollSection.length) {
                        e.preventDefault();

                        if (UNCODE.menuOpened) {
                            if (UNCODE.wwidth < UNCODE.mediaQuery) window.dispatchEvent(UNCODE.menuMobileTriggerEvent);
                            else $('.mmb-container-overlay .overlay-close').trigger('click');
                        }

                        var calc_scroll = scrollSection.offset().top;
                        calc_scroll -= UNCODE.get_scroll_offset() + $('nav').height() + 40;

                        var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                            delta = bodyTop - calc_scroll,
                            scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(delta) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
                        if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

                        if (scrollSpeed == 0) {
                            $('html, body').scrollTop(calc_scroll);
                            UNCODE.scrolling = false;
                        } else {
                            $('html, body').animate({
                                scrollTop: calc_scroll
                            }, scrollSpeed, 'easeInOutCubic', function() {
                                UNCODE.scrolling = false;
                            });
                        }
                    }
                }
            }
        });
        $('.header-scrolldown').on('click', function(event) {
            event.preventDefault();
            var pageHeader = $(event.target).closest('#page-header'),
                pageHeaderTop = pageHeader.offset().top,
                pageHeaderHeight = pageHeader.outerHeight(),
                scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(pageHeaderTop + pageHeaderHeight) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
            if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

            var calc_scroll = pageHeaderTop + pageHeaderHeight;
            calc_scroll -= UNCODE.get_scroll_offset();

            if (scrollSpeed == 0) {
                $('html, body').scrollTop(calc_scroll);
                UNCODE.scrolling = false;
            } else {
                $('html, body').animate({
                    scrollTop: calc_scroll
                }, scrollSpeed, 'easeInOutCubic', function() {
                    UNCODE.scrolling = false;
                });
            }
        });
        // TAB DATA-API
        // ============
        $(document).on('click.bs.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function(e) {
            e.preventDefault()
            $(this).tab('show');
            setTimeout(function() {
                window.dispatchEvent(UNCODE.boxEvent);
            }, 300);
        });
        // COLLAPSE DATA-API
        // =================
        $(document).on('click.bs.collapse.data-api', '[data-toggle="collapse"]', function(e) {
            var $this = $(this),
                href
            var target = $this.attr('data-target') || e.preventDefault() || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
            var $target = $(target)
            var data = $target.data('bs.collapse')
            var option = data ? 'toggle' : $this.data()
            var parent = $this.attr('data-parent')
            var $parent = parent && $(parent)
            var $title = $(this).parent()
            if ($parent) {
                $parent.find('[data-toggle="collapse"][data-parent="' + parent + '"]').not($this).addClass('collapsed')
                if ($title.hasClass('active')) {
                    $title.removeClass('active');
                } else {
                    $parent.find('.panel-title').removeClass('active')
                    $title[!$target.hasClass('in') ? 'addClass' : 'removeClass']('active')
                }
            }
            $this[$target.hasClass('in') ? 'addClass' : 'removeClass']('collapsed')
        });
        // FitText
        // =================
        window.uncode_textfill = function(el, loaded) {
            if (el == undefined) el = $('body');
            $.each($('.bigtext', el), function(index, val) {
                $(val).bigtext({
                    minfontsize: 24
                });
                if (!$(val).parent().hasClass('blocks-animation') && !$(val).hasClass('animate_when_almost_visible')) $(val).css({
                    opacity: 1
                });
                setTimeout(function() {
                    if ($(val).find('.animate_when_almost_visible').length != 0) {
                        $(val).css({opacity: 1});
                    }
                }, 400);
            });
        }
        window.uncode_textfill();

        // Colomun hover effect
        // =================
        $(document).on('mouseenter', '.col-link', function(e) {
            var uncol = $(e.target).prev('.uncol'),
                el = uncol.find('.column-background');
            if (el) {
                $('.btn-container .btn', uncol).toggleClass('active');
                var elOverlay = $(el[0]).find('.block-bg-overlay');
                if (elOverlay.length) {
                    var getOpacity = $(elOverlay).css('opacity');
                    if (getOpacity != 1) {
                        getOpacity = Math.round(getOpacity * 100) / 100;
                        var newOpacity = getOpacity + .1;
                        $(elOverlay).data('data-opacity', getOpacity);
                        $(elOverlay).css('opacity', newOpacity);
                    }
                }
            }
        }).on('mouseleave', '.col-link', function(e) {
            var uncol = $(e.target).prev('.uncol'),
                el = uncol.find('.column-background');
            $('.btn-container .btn', uncol).toggleClass('active');
            if (el) {
                var elOverlay = $(el[0]).find('.block-bg-overlay');
                if (elOverlay.length) {
                    var getOpacity = $(elOverlay).data('data-opacity');
                    $(elOverlay).css('opacity', getOpacity);
                }
            }
        });

        // REVSLIDER API
        // ============
        $(window).on("load", function() {
            $('.rev_slider_wrapper').each(function(){
                var $this = jQuery(this),
                    id_array = $this.attr("id").split("_"),
                    id = id_array[2];
                if (id != undefined && id != '') {
                    $.globalEval('revapi'+id+'.bind("revolution.slide.onloaded",function (e, data) { if (jQuery(e.currentTarget).closest(".header-revslider").length) { var style = jQuery(e.currentTarget).find("li").eq(0).attr("data-skin"), scrolltop = jQuery(document).scrollTop(); if (style != undefined) UNCODE.switchColorsMenu(scrolltop, style);}})');
                    $.globalEval('revapi'+id+'.bind("revolution.slide.onchange",function (e,data) { if (jQuery(e.currentTarget).closest(".header-revslider").length) { var style = jQuery(e.currentTarget).find("li").eq(data.slideIndex - 1).attr("data-skin"), scrolltop = jQuery(document).scrollTop(); if (style != undefined) UNCODE.switchColorsMenu(scrolltop, style);}})');
                }
            });
        });
        // Admin bar
        // ============
        $(window).resize(function() {
            if ($('html').hasClass('admin-mode')) {
                var getAdminBar = $('#wpadminbar');
                if (getAdminBar.length) {
                    if (getAdminBar.css('position') !== 'hidden') {
                        var getAdminBarHeight = getAdminBar.height();
                        if (getAdminBar.css('position') === 'fixed') {
                            $('html').css({'margin-top':getAdminBarHeight + 'px','padding-top': UNCODE.bodyBorder+'px'});
                            $('.body-borders .top-border').css({'margin-top':getAdminBarHeight+'px'});
                        } else {
                            $('html').css({'padding-top':UNCODE.bodyBorder + 'px','margin-top':'0px'});
                            $('.body-borders .top-border').css({'margin-top':'0px'});
                        }
                    }
                }
            }
        });
        // Facebook
        // ===========
        this.fb_timeout = undefined;
        $(window).resize(function() {
            $('.facebook-object').each(function(index, el) {
                var el = $(el),
                    parentWidth = el.closest('.tmb').width();
                el.width(parentWidth);
            });
            if (this.fb_timeout == undefined) {
                if ($('.facebook-object').length) {
                    window.clearTimeout(this.fb_timeout);
                    this.fb_timeout = window.setTimeout(function(msg) {
                        window.dispatchEvent(UNCODE.boxEvent);
                    }, 1000);
                }
            }
        });
    }

    UNCODE.menuSystem = function() {

        function menuMobile() {
            var $mobileToggleButton = $('.mobile-menu-button'),
                $box,
                $el,
                elHeight,
                check,
                animating = false,
                stickyMobile = false;
            UNCODE.menuOpened = false;
            //browserToolbar = 56;
            $mobileToggleButton.on('click', function(event) {
                var btn = this;
                if ($(btn).hasClass('overlay-close')) return;
                event.preventDefault();
                if (UNCODE.wwidth < UNCODE.mediaQuery) {
                    $box = $(this).closest('.box-container').find('.main-menu-container'),
                        $el = $(this).closest('.box-container').find('.menu-horizontal-inner:not(.row-brand), .menu-sidebar-inner');
                    if (UNCODE.isMobile && $('.menu-wrapper.menu-sticky, .menu-wrapper.menu-hide-only, .main-header .menu-sticky-vertical, .main-header .menu-hide-only-vertical').length) {
                        stickyMobile = true;
                        elHeight = window.innerHeight - UNCODE.menuMobileHeight - (UNCODE.bodyBorder * 2) - UNCODE.adminBarHeight + 1;
                    } else {
                        elHeight = 0;
                        $.each($el, function(index, val) {
                            elHeight += $(val).outerHeight();
                        });
                    }
                    var open = function() {
                        if (!animating) {
                            animating = true;
                            UNCODE.menuOpened = true;
                            if ($('body[class*="vmenu-"], body.hmenu-center').length && ($('.menu-hide, .menu-sticky').length)) {
                                $('.main-header > .vmenu-container').css({position:'fixed', top: ($('.menu-container').outerHeight() + UNCODE.bodyBorder + UNCODE.adminBarHeight) + 'px'});
                                $('.menu-container:not(.sticky-element):not(.isotope-filters)').css({position:'fixed'});
                            }
                            if ($('body.hmenu-center').length && ($('.menu-hide, .menu-sticky').length)) {
                                $('.menu-container:not(.sticky-element):not(.isotope-filters)').css({position:'fixed', top: (UNCODE.menuMobileHeight + UNCODE.bodyBorder + UNCODE.adminBarHeight) + 'px'});
                            }
                            btn.classList.add('close');
                            $box.addClass('open-items');
                            $box.animate({
                                height: elHeight
                            }, 600, "easeInOutCirc", function() {
                                animating = false;
                                if (!stickyMobile) $box.css('height', 'auto');
                            });
                        }
                    };

                    var close = function() {
                        if (!animating) {
                            animating = true;
                            UNCODE.menuOpened = false;
                            btn.classList.remove('close');
                            btn.classList.add('closing');
                            $box.addClass('close');
                            setTimeout(function() {
                                $box.removeClass('close');
                                $box.removeClass('open-items');
                                btn.classList.remove('closing');
                            }, 500);
                            $box.animate({
                                height: 0
                            }, {
                                duration: 600,
                                easing: "easeInOutCirc",
                                complete: function(elements) {
                                    $(elements).css('height', '');
                                    animating = false;
                                    if ($('body[class*="vmenu-"]').length) $('.main-header > .vmenu-container').css('position','relative');
                                }
                            });
                        }
                    };
                    check = (!UNCODE.menuOpened) ? open() : close();
                }
            });
            window.addEventListener('menuMobileTrigged', function(e) {
                $mobileToggleButton.trigger('click');
            });
            window.addEventListener("resize", function() {
                if ($(window).width() < UNCODE.mediaQuery) {
                    if (UNCODE.isMobile) {
                        var $box = $('.box-container .main-menu-container'),
                            $el = $('.box-container .menu-horizontal-inner, .box-container .menu-sidebar-inner');
                        if ($($box).length && $($box).hasClass('open-items') && $($box).css('height') != 'auto') {
                            if ($('.menu-wrapper.menu-sticky, .menu-wrapper.menu-hide-only').length) {
                                elHeight = 0;
                                $.each($el, function(index, val) {
                                    elHeight += $(val).outerHeight();
                                });
                                elHeight = window.innerHeight - $('.menu-wrapper.menu-sticky .menu-container .row-menu-inner, .menu-wrapper.menu-hide-only .menu-container .row-menu-inner').height() - (UNCODE.bodyBorder * 2) + 1;
                                $($box).css('height', elHeight + 'px');
                            }
                        }
                    }
                } else {
                    $('.menu-hide-vertical').removeAttr('style');
                    $('.menu-container-mobile').removeAttr('style');
                    $('.vmenu-container.menu-container').removeAttr('style');
                }
            });
        };

        function menuOffCanvas() {
            $('.menu-primary .menu-button-offcanvas').click(function(event) {
                if ($(window).width() > UNCODE.mediaQuery) {
                    if ($(event.currentTarget).hasClass('close')) {
                        $(event.currentTarget).removeClass('close');
                        $(event.currentTarget).addClass('closing');
                        setTimeout(function() {
                            $(event.currentTarget).removeClass('closing');
                        }, 500);
                    } else $(event.currentTarget).addClass('close');
                }
                $('body').toggleClass('off-opened');
            });
        };
        function menuSmart() {
            if ($('[class*="menu-smart"]').length > 0) {
                $('[class*="menu-smart"]').smartmenus({
                    subIndicators: false,
                    subIndicatorsPos: 'append',
                    subMenusMinWidth: '13em',
                    subIndicatorsText: '',
                    showTimeout: 50,
                    hideTimeout: 50,
                    showFunction: function($ul, complete) {
                        $ul.fadeIn(0, 'linear', complete);
                    },
                    hideFunction: function($ul, complete) {
                        var fixIE = $('html.ie').length;
                        if (fixIE) {
                            var $rowParent = $($ul).closest('.main-menu-container');
                            $rowParent.height('auto');
                        }
                        $ul.fadeOut(0, 'linear', complete);
                    },
                    collapsibleShowFunction: function($ul, complete) {
                        $ul.slideDown(400, 'easeInOutCirc', function() {
                            12});
                    },
                    collapsibleHideFunction: function($ul, complete) {
                        $ul.slideUp(200, 'easeInOutCirc', complete);
                    },
                    hideOnClick: true
                });
            }
        };
        function menuOverlay() {
            if ($('.overlay-sequential, .menu-mobile-animated').length > 0) {
                $('.overlay-sequential .menu-smart > li, .menu-sticky .menu-container .menu-smart > li, .menu-hide.menu-container .menu-smart > li, .vmenu-container .menu-smart > li').each(function(index, el) {
                    var transDelay = (index / 20) + 0.1;
                    $(this)[0].setAttribute('style', '-webkit-transition-delay:' + transDelay + 's; -moz-transition-delay:' + transDelay + 's; -ms-transition-delay:' + transDelay + 's; -o-transition-delay:' + transDelay + 's; transition-delay:' + transDelay + 's');
                });
            }
        };
        //menuMobileButton();
        menuMobile();
        menuOffCanvas();
        menuSmart();
        menuOverlay();
    };

    UNCODE.okvideo = function() {
        var BLANK_GIF = "data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D";
        $.okvideo = function(options) {
            // if the option var was just a string, turn it into an object
            if (typeof options !== 'object') options = {
                'video': options
            };
            var base = this;
            // kick things off
            base.init = function() {
                base.options = $.extend({}, $.okvideo.options, options);
                // support older versions of okvideo
                if (base.options.video === null) base.options.video = base.options.source;
                base.setOptions();
                var target = base.options.target || $('body');
                var position = target[0] == $('body')[0] ? 'fixed' : 'absolute';
                var zIndex = base.options.controls === 3 ? -999 : "auto";
                if ($('#okplayer-' + base.options.id).length == 0) { //base.options.id = String(Math.round(Math.random() * 100000));
                    var mask = '<div id="okplayer-mask-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:-998;height:100%;width:100%;"></div>';
                    if (OKEvents.utils.isMobile()) {
                        target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:' + zIndex + ';height:100%;width:100%;"></div>');
                    } else {
                        if (base.options.controls === 3) {
                            target.append(mask)
                        }
                        if (base.options.adproof === 1) {
                            target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:-10%;top:-10%;overflow:hidden;z-index:' + zIndex + ';height:120%;width:120%;"></div>');
                        } else {
                            target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:' + zIndex + ';height:100%;width:100%;"></div>');
                        }
                    }
                    $("#okplayer-mask-" + base.options.id).css("background-image", "url(" + BLANK_GIF + ")");
                    if (base.options.playlist.list === null) {
                        if (base.options.video.provider === 'youtube') {
                            base.loadYouTubeAPI();
                        } else if (base.options.video.provider === 'vimeo') {
                            base.options.volume /= 100;
                            base.loadVimeoAPI();
                        }
                    } else {
                        base.loadYouTubeAPI();
                    }
                }
            };
            // clean the options
            base.setOptions = function() {
                // exchange 'true' for '1' and 'false' for 3
                for (var key in this.options) {
                    if (this.options[key] === true) this.options[key] = 1;
                    if (this.options[key] === false) this.options[key] = 3;
                }
                if (base.options.playlist.list === null) {
                    base.options.video = base.determineProvider();
                }
                // pass options to the window
                $(window).data('okoptions-' + base.options.id, base.options);
            };
            // insert js into the head and exectue a callback function
            base.insertJS = function(src, callback){
                var tag = document.createElement('script');
                if (callback){
                    if (tag.readyState){  //IE
                        tag.onreadystatechange = function(){
                            if (tag.readyState === "loaded" ||
                                tag.readyState === "complete"){
                                tag.onreadystatechange = null;
                                callback();
                            }
                        };
                    } else {
                        tag.onload = function() {
                            callback();
                        };
                    }
                }
                tag.src = src;
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            };
            // load the youtube api
            base.loadYouTubeAPI = function(callback) {
                base.insertJS('https://www.youtube.com/player_api');
            };
            base.loadYouTubePlaylist = function() {
                player.loadPlaylist(base.options.playlist.list, base.options.playlist.index, base.options.playlist.startSeconds, base.options.playlist.suggestedQuality);
            };
            // load the vimeo api by replacing the div with an iframe and loading js
            base.loadVimeoAPI = function() {
                var source = '//player.vimeo.com/video/' + base.options.video.id + '?api=1&title=0&byline=0&portrait=0&playbar=0&loop=' + base.options.loop + '&autoplay=' + (base.options.autoplay === 1 ? 1 : 0) + '&player_id=okplayer-' + base.options.id,
                    jIframe = $('<iframe data-src="'+source+'" frameborder="0" id="okplayer-' + base.options.id +'" style="visibility: hidden;" class="vimeo-background" />');
                $(window).data('okoptions-' + base.options.id).jobject = jIframe;
                $('#okplayer-' + base.options.id).replaceWith(jIframe[0]);
                base.insertJS('//origin-assets.vimeo.com/js/froogaloop2.min.js', function() {
                    vimeoPlayerReady(base.options.id);
                });
            };
            // is it from youtube or vimeo?
            base.determineProvider = function() {
                var a = document.createElement('a');
                a.href = base.options.video;
                if (/youtube.com/.test(base.options.video) || /youtu.be/.test(base.options.video)) {
                    var videoid = a.href.split('/')[3].toString();
                    var query = videoid.substring(videoid.indexOf('?') + 1);
                    if (query != '') {
                        var vars = query.split('&');
                        for (var i = 0; i < vars.length; i++) {
                            var pair = vars[i].split('=');
                            if (pair[0] == 'v') {
                                videoid = pair[1];
                            }
                        }
                    }
                    return {
                        "provider": "youtube",
                        "id": videoid
                    };
                } else if (/vimeo.com/.test(base.options.video)) {
                    return {
                        "provider": "vimeo",
                        "id": (a.href.split('/')[3].toString()).split('#')[0],
                    };
                } else if (/[-A-Za-z0-9_]+/.test(base.options.video)) {
                    var id = new String(base.options.video.match(/[-A-Za-z0-9_]+/));
                    if (id.length == 11) {
                        return {
                            "provider": "youtube",
                            "id": id.toString()
                        };
                    } else {
                        for (var i = 0; i < base.options.video.length; i++) {
                            if (typeof parseInt(base.options.video[i]) !== "number") {
                                throw 'not vimeo but thought it was for a sec';
                            }
                        }
                        return {
                            "provider": "vimeo",
                            "id": base.options.video
                        };
                    }
                } else {
                    throw "OKVideo: Invalid video source";
                }
            };
            base.init();
        };
        $.okvideo.options = {
            id: null,
            source: null, // Deprecate dis l8r
            video: null,
            playlist: { // eat ur heart out @brokyo
                list: null,
                index: 0,
                startSeconds: 0,
                suggestedQuality: "default" // options: small, medium, large, hd720, hd1080, highres, default
            },
            disableKeyControl: 1,
            captions: 0,
            loop: 1,
            hd: 1,
            volume: 0,
            adproof: false,
            unstarted: null,
            onFinished: null,
            onReady: null,
            onPlay: null,
            onPause: null,
            buffering: null,
            controls: false,
            autoplay: true,
            annotations: true,
            cued: null
        };
        $.fn.okvideo = function(options) {
            options.target = this;
            return this.each(function() {
                (new $.okvideo(options));
            });
        };

        $(".no-touch .uncode-video-container.video").each(function(index, el) {
            var $this = $(this),
                url = $this.attr('data-video'),
                id = $this.attr('data-id'),
                cloned = $this.closest('.owl-item');
            if (!cloned.hasClass('cloned') || cloned.length == 0) {
                $this.okvideo({
                    id: id,
                    source: url.split('#')[0],
                    time: ((url).indexOf("#") > -1) ? (url).substring((url).indexOf('#') + 1) : null,
                    autoplay: 1,
                    controls: 0,
                    volume: 0,
                    adproof: 0,
                    caller: $this,
                    hd: 1,
                    onReady: function(player) {
                        var getPlayer = player.c || player,
                            getContainer = $(getPlayer).closest('.background-element');
                        if (getContainer.length) {
                            UNCODE.initVideoComponent(getContainer[0], '.uncode-video-container.video');
                        }
                    }
                });
            }
        });
        $(".no-touch .background-video-shortcode").each(function(index, el) {
            var video_id = $(this).attr('id');
            if (typeof MediaElement === "function") {
                new MediaElement(video_id, {
                    startVolume: 0,
                    loop: true,
                    success: function(mediaElement, domObject) {
                        domObject.volume = 0;
                        $(mediaElement).data('started', false);
                        mediaElement.addEventListener('timeupdate', function(e) {
                            if (!$(e.target).data('started')) {
                                $(mediaElement).data('started', true);
                                $(mediaElement).closest('.uncode-video-container').css('opacity', '1');
                            }
                        });
                        if (!UNCODE.isMobile) {
                            setTimeout(function() {
                                UNCODE.initVideoComponent(document.body, '.uncode-video-container.video, .uncode-video-container.self-video');
                            }, 100);
                        }
                        mediaElement.play();
                    },
                    // fires when a problem is detected
                    error: function() {}
                });
            }
        });
    };

    UNCODE.disableHoverScroll = function() {

        if (!UNCODE.isMobile) {
            var body = document.body,
                timer;

            window.addEventListener('scroll', function() {
                clearTimeout(timer);
                if (body.classList)  {
                    if (!body.classList.contains('disable-hover')) {
                        body.classList.add('disable-hover')
                    }

                    timer = setTimeout(function() {
                        body.classList.remove('disable-hover')
                    }, 300);
                }
            }, false);
        }
    };


    UNCODE.isotopeLayout = function() {
        if ($('.isotope-layout').length > 0) {
            var isotopeContainersArray = [],
                typeGridArray = [],
                layoutGridArray = [],
                screenLgArray = [],
                screenMdArray = [],
                screenSmArray = [],
                transitionDuration = [],
                $filterItems = [],
                $filters = $('.isotope-filters'),
                $itemSelector = '.tmb',
                $items,
                itemMargin,
                correctionFactor = 0,
                firstLoad = true,
                isOriginLeft = $('body').hasClass('rtl') ? false : true;
            $('[class*="isotope-container"]').each(function() {
                var isoData = $(this).data(),
                    $data_lg,
                    $data_md,
                    $data_sm;
                if (isoData.lg !== undefined) $data_lg = $(this).attr('data-lg');
                else $data_lg = '1000';
                if (isoData.md !== undefined) $data_md = $(this).attr('data-md');
                else $data_md = '600';
                if (isoData.sm !== undefined) $data_sm = $(this).attr('data-sm');
                else $data_sm = '480';
                screenLgArray.push($data_lg);
                screenMdArray.push($data_md);
                screenSmArray.push($data_sm);
                transitionDuration.push($('.t-inside.animate_when_almost_visible', this).length > 0 ? 0 : '0.5s');
                if (isoData.type == 'metro') typeGridArray.push(true);
                else typeGridArray.push(false);
                if (isoData.layout !== undefined) layoutGridArray.push(isoData.layout);
                else layoutGridArray.push('masonry');
                isotopeContainersArray.push($(this));
            });
            var colWidth = function(index) {
                    $(isotopeContainersArray[index]).width('');
                    var isPx = $(isotopeContainersArray[index]).parent().hasClass('px-gutter'),
                        widthAvailable = $(isotopeContainersArray[index]).width(),
                        columnNum = 12,
                        columnWidth = 0;

                    if (isPx) {
                        columnWidth = Math.ceil(widthAvailable / columnNum);
                        $(isotopeContainersArray[index]).width(columnNum * Math.ceil(columnWidth));
                    } else {
                        columnWidth = ($('html.firefox').length) ? Math.floor(widthAvailable / columnNum) : widthAvailable / columnNum;
                    }
                    $items = $(isotopeContainersArray[index]).find('.tmb:not(.tmb-carousel)');
                    itemMargin = parseInt($(isotopeContainersArray[index]).find('.t-inside:not(.t-inside-custom)').css("margin-top"));
                    for (var i = 0, len = $items.length; i < len; i++) {
                        var $item = $($items[i]),
                            multiplier_w = $item.attr('class').match(/tmb-iso-w(\d{0,2})/),
                            multiplier_h = $item.attr('class').match(/tmb-iso-h(\d{0,2})/);

                        if (widthAvailable >= screenMdArray[index] && widthAvailable < screenLgArray[index]) {
                            if (multiplier_w != null && multiplier_w[1] !== undefined) {
                                switch (parseInt(multiplier_w[1])) {
                                    case (5):
                                    case (4):
                                    case (3):
                                        if (typeGridArray[index]) multiplier_h[1] = (6 * multiplier_h[1]) / multiplier_w[1];
                                        multiplier_w[1] = 6;
                                        break;
                                    case (2):
                                    case (1):
                                        if (typeGridArray[index]) multiplier_h[1] = (3 * multiplier_h[1]) / multiplier_w[1];
                                        multiplier_w[1] = 3;
                                        break;
                                    default:
                                        if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
                                        multiplier_w[1] = 12;
                                        break;
                                }
                            }
                        } else if (widthAvailable >= screenSmArray[index] && widthAvailable < screenMdArray[index]) {
                            if (multiplier_w != null && multiplier_w[1] !== undefined) {
                                switch (parseInt(multiplier_w[1])) {
                                    case (5):
                                    case (4):
                                    case (3):
                                    case (2):
                                    case (1):
                                        if (typeGridArray[index]) multiplier_h[1] = (6 * multiplier_h[1]) / multiplier_w[1];
                                        multiplier_w[1] = 6;
                                        break;
                                    default:
                                        if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
                                        multiplier_w[1] = 12;
                                        break;
                                }
                            }
                        } else if (widthAvailable < screenSmArray[index]) {
                            if (multiplier_w != null && multiplier_w[1] !== undefined) {
                                //if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
                                multiplier_w[1] = 12;
                                if (typeGridArray[index]) multiplier_h[1] = 12;
                            }
                        }
                        var width = multiplier_w ? Math.floor(columnWidth * multiplier_w[1]) : columnWidth,
                            height = multiplier_h ? Math['ceil']((2 * Math.ceil(columnWidth / 2)) * multiplier_h[1]) - itemMargin : columnWidth;

                        if (width >= widthAvailable) {
                            $item.css({
                                width: widthAvailable
                            });
                            if (typeGridArray[index]) {
                                $item.children().add($item.find('.backimg')).css({
                                    height: height
                                });
                            }
                        } else {
                            $item.css({
                                width: width
                            });
                            if (typeGridArray[index]) {
                                $item.children().add($item.find('.backimg')).css({
                                    height: height
                                });
                            }
                        }
                    }
                    return columnWidth;
                },
                init_isotope = function() {
                    for (var i = 0, len = isotopeContainersArray.length; i < len; i++) {
                        var isotopeSystem = $(isotopeContainersArray[i]).closest($('.isotope-system')),
                            isotopeId = isotopeSystem.attr('id'),
                            $layoutMode = layoutGridArray[i];
                        $(isotopeContainersArray[i]).isotope({
                            //resizable: true,
                            itemSelector: $itemSelector,
                            layoutMode: $layoutMode,
                            transitionDuration: transitionDuration[i],
                            masonry: {
                                columnWidth: colWidth(i)
                            },
                            vertical: {
                                horizontalAlignment: 0.5,
                            },
                            sortBy: 'original-order',
                            isOriginLeft: isOriginLeft
                        }).on('layoutComplete', onLayout($(isotopeContainersArray[i]), 0));
                        if ($(isotopeContainersArray[i]).hasClass('isotope-infinite')) {
                            //be sure to destroy infinite scroll and reinit infinite scroll each time (needed when we filter by different categories
                            $(isotopeContainersArray[i]).infinitescroll('destroy');
                            $(isotopeContainersArray[i]).data('infinitescroll', null);
                            $(isotopeContainersArray[i]).infinitescroll({
                                    navSelector: '#' + isotopeId + ' .loadmore-button', // selector for the pagination container
                                    nextSelector: '#' + isotopeId + ' .loadmore-button a', // selector for the NEXT link (to page 2)
                                    itemSelector: '#' + isotopeId + ' .isotope-layout .tmb, #' + isotopeId + ' .isotope-filters li', // selector for all items you'll retrieve
                                    animate: false,
                                    behavior: 'local',
                                    debug: false,
                                    loading: {
                                        selector: '#' + isotopeId + '.isotope-system .isotope-footer-inner',
                                        speed: 0,
                                        finished: undefined,
                                        msg: $('#' + isotopeId + ' .loadmore-button'),
                                    },
                                    errorCallback: function() {
                                        var isotope_system = $(this).closest('.isotope-system');
                                        $('.loading-button', isotope_system).hide();
                                        $('.loadmore-button', isotope_system).attr('style', 'display:none !important');
                                    }
                                },
                                // append the new items to isotope on the infinitescroll callback function.
                                function(newElements, opts) {
                                    var $isotope = $(this),
                                        isotopeId = $isotope.closest('.isotope-system').attr('id'),
                                        filters = new Array(),
                                        $loading_button = $isotope.closest('.isotope-system').find('.loading-button'),
                                        $infinite_button = $isotope.closest('.isotope-system').find('.loadmore-button'),
                                        $numPages = $('a', $infinite_button).data('pages'),
                                        delay = 300;
                                    $('a', $infinite_button).html($('a', $infinite_button).data('label'));
                                    $infinite_button.show();
                                    $loading_button.hide();
                                    if ( $numPages != undefined && opts.state.currPage == $numPages) $infinite_button.hide();
                                    $('> li', $isotope).remove();
                                    $.each($(newElements), function(index, val) {
                                        if ($(val).is("li")) {
                                            filters.push($(val)[0]);
                                        }
                                    });
                                    newElements = newElements.filter(function(x) {
                                        return filters.indexOf(x) < 0
                                    });
                                    // $.each($(filters), function(index, val) {
                                    // 	if ($('#' + isotopeId + ' a[data-filter="' + $('a', val).attr('data-filter') + '"]').length == 0) $('#' + isotopeId + ' .isotope-filters ul').append($(val));
                                    // });
                                    $isotope.isotope('reloadItems', onLayout($isotope, newElements.length));
                                });
                            if ($(isotopeContainersArray[i]).hasClass('isotope-infinite-button')) {
                                var $infinite_isotope = $(isotopeContainersArray[i]),
                                    $infinite_button = $infinite_isotope.closest('.isotope-system').find('.loadmore-button a');
                                $infinite_isotope.infinitescroll('pause');
                                $infinite_button.on('click', function(event) {
                                    event.preventDefault();
                                    var $infinite_system = $(event.target).closest('.isotope-system'),
                                        $infinite_isotope = $infinite_system.find('.isotope-container'),
                                        isotopeId = $infinite_system.attr('id');
                                    $(event.currentTarget).html('Loading…');
                                    $infinite_isotope.infinitescroll('resume');
                                    $infinite_isotope.infinitescroll('retrieve');
                                    $infinite_isotope.infinitescroll('pause');
                                });
                            }
                        }
                    }
                },
                onLayout = function(isotopeObj, startIndex) {
                    //send event that layout is rendering
                    $(document).trigger('onLayout');

                    isotopeObj.css('opacity', 1);
                    isotopeObj.closest('.isotope-system').find('.isotope-footer').css('opacity', 1);
                    setTimeout(function() {
                        window.dispatchEvent(UNCODE.boxEvent);
                        UNCODE.adaptive();
                        $(isotopeObj).find('audio,video').each(function() {
                            $(this).mediaelementplayer({
                                pauseOtherPlayers: false,
                            });
                        });
                        if ($(isotopeObj).find('.nested-carousel').length) {
                            UNCODE.carousel($(isotopeObj).find('.nested-carousel'));
                            setTimeout(function() {
                                boxAnimation($('.tmb', isotopeObj), startIndex, true, isotopeObj);
                            }, 200);
                        } else {
                            boxAnimation($('.tmb', isotopeObj), startIndex, true, isotopeObj);
                        }
                    }, 100);
                },
                boxAnimation = function(items, startIndex, sequential, container) {
                    var $allItems = items.length - startIndex,
                        showed = 0,
                        index = 0;
                    if (container.closest('.owl-item').length == 1) return false;
                    $.each(items, function(index, val) {
                        var elInner = $('> .t-inside', val);
                        if (val[0]) val = val[0];
                        if (elInner.hasClass('animate_when_almost_visible') && !elInner.hasClass('force-anim')) {
                            new Waypoint({
                                element: val,
                                handler: function() {
                                    var element = $('> .t-inside', this.element),
                                        parent = $(this.element),
                                        currentIndex = parent.index();
                                    var delay = (!sequential) ? index : ((startIndex !== 0) ? currentIndex - $allItems : currentIndex),
                                        delayAttr = parseInt(element.attr('data-delay'));
                                    if (isNaN(delayAttr)) delayAttr = 100;
                                    delay -= showed;
                                    var objTimeout = setTimeout(function() {
                                        element.removeClass('zoom-reverse').addClass('start_animation');
                                        showed = parent.index();
                                    }, delay * delayAttr)
                                    parent.data('objTimeout', objTimeout);
                                    this.destroy();
                                },
                                offset: '100%'
                            })
                        } else {
                            if (elInner.hasClass('force-anim')) {
                                elInner.addClass('start_animation');
                            } else {
                                elInner.css('opacity', 1);
                            }
                        }
                        index++;
                    });
                };
            if ($('.isotope-pagination').length > 0) {
                $('.isotope-system').on('click', '.pagination a', function(evt) {
                    evt.preventDefault();
                    var filterContainer = $(this).closest('.isotope-system').find('.isotope-filters'),
                        container = $(this).closest('.isotope-system'),
                        calc_scroll = container.closest('.uncol').offset().top - (!filterContainer.hasClass('with-bg') ? $('.filter-show-all span', filterContainer).outerHeight(true) : 0);
                    calc_scroll -= UNCODE.get_scroll_offset();

                    var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                        delta = bodyTop - calc_scroll,
                        scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(delta) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
                    if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

                    if (scrollSpeed == 0) {
                        $('html, body').scrollTop(calc_scroll);
                    } else {
                        $('html, body').animate({
                            scrollTop: calc_scroll-50
                        },{
                            easing: 'easeInOutQuad',
                            duration: scrollSpeed,
                            complete: function(){
                                UNCODE.scrolling = false;
                            }
                        });
                    }

                    loadIsotope($(this));
                    evt.preventDefault();
                });
            }
            $filters.on('click', 'a', function(evt) {
                var $filter = $(this),
                    filterContainer = $filter.closest('.isotope-filters'),
                    filterValue = $filter.attr('data-filter'),
                    container = $filter.closest('.isotope-system').find($('.isotope-layout')),
                    transitionDuration = container.data().isotope.options.transitionDuration,
                    delay = 300,
                    filterItems = [];
                if (!$filter.hasClass('active')) {
                    /** Scroll top with filtering */
                    if (filterContainer.hasClass('filter-scroll')) {
                        var calc_scroll = container.closest('.uncol').offset().top - (!filterContainer.hasClass('with-bg') ? $('.filter-show-all span', filterContainer).outerHeight(true) : 0);
                        calc_scroll -= UNCODE.get_scroll_offset();

                        var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                            delta = bodyTop - calc_scroll,
                            scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(delta) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
                        if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

                        if (scrollSpeed == 0) {
                            $('html, body').scrollTop(calc_scroll);
                            UNCODE.scrolling = false;
                        } else {
                            $('html, body').animate({
                                scrollTop: calc_scroll
                            },{
                                easing: 'easeInOutQuad',
                                duration: scrollSpeed,
                                complete: function(){
                                    UNCODE.scrolling = false;
                                }
                            });
                        }
                    }
                    if (filterValue !== undefined) {
                        $.each($('> .tmb > .t-inside', container), function(index, val) {
                            var parent = $(val).parent(),
                                objTimeout = parent.data('objTimeout');
                            if (objTimeout) {
                                $(val).removeClass('zoom-reverse').removeClass('start_animation')
                                clearTimeout(objTimeout);
                            }
                            if (transitionDuration == 0) {
                                if ($(val).hasClass('animate_when_almost_visible')) {
                                    $(val).addClass('zoom-reverse').removeClass('start_animation');
                                } else {
                                    $(val).addClass('animate_when_almost_visible zoom-reverse zoom-anim force-anim');
                                }
                            }
                        });
                        setTimeout(function() {
                            container.isotope({
                                filter: function() {
                                    var block = $(this),
                                        filterable = (filterValue == '*') || block.hasClass(filterValue),
                                        lightboxElements = $('[data-lbox^=ilightbox]', block);
                                    if (filterable) {
                                        if (lightboxElements.length) {
                                            lightboxElements.removeClass('lb-disabled');
                                            container.data('lbox', $(lightboxElements[0]).data('lbox'));
                                        }
                                        filterItems.push(block);
                                    } else {
                                        if (lightboxElements.length) lightboxElements.addClass('lb-disabled');
                                    }
                                    return filterable;
                                }
                            });
                            $('.t-inside.zoom-reverse', container).removeClass('zoom-reverse');
                        }, delay);
                        /** once filtered - start **/
                        container.isotope('once', 'arrangeComplete', function() {
                            var getLightbox = UNCODE.lightboxArray[container.data('lbox')];
                            if (typeof getLightbox === 'object') getLightbox.refresh();
                            if (transitionDuration == 0) {
                                setTimeout(function() {
                                    boxAnimation(filterItems, 0, false, container);
                                }, 100);
                            }
                            setTimeout(function() {
                                Waypoint.refreshAll();
                            }, 2000);
                        });
                        /** once filtered - end **/
                    } else {
                        $.each($('> .tmb > .t-inside', container), function(index, val) {
                            var parent = $(val).parent(),
                                objTimeout = parent.data('objTimeout');
                            if (objTimeout) {
                                $(val).removeClass('zoom-reverse').removeClass('start_animation')
                                clearTimeout(objTimeout);
                            }
                            if (transitionDuration == 0) {
                                if ($(val).hasClass('animate_when_almost_visible')) {
                                    $(val).addClass('zoom-reverse').removeClass('start_animation');
                                } else {
                                    $(val).addClass('animate_when_almost_visible zoom-reverse zoom-anim force-anim');
                                }
                            }
                        });
                        container.parent().addClass('isotope-loading');
                        loadIsotope($filter);
                    }
                }
                evt.preventDefault();
            });
            $(window).on("popstate", function(e) {
                if (e.originalEvent.state === null) return;
                var params = {};
                if (location.search) {
                    var parts = location.search.substring(1).split('&');
                    for (var i = 0; i < parts.length; i++) {
                        var nv = parts[i].split('=');
                        if (!nv[0]) continue;
                        params[nv[0]] = nv[1] || true;
                    }
                }
                if (params.id === undefined) {
                    $.each($('.isotope-system'), function(index, val) {
                        loadIsotope($(val));
                    });
                } else loadIsotope($('#' + params.id));
            });

            var loadIsotope = function($href) {
                var href = ($href.is("a") ? $href.attr('href') : location),
                    isotopeSystem = ($href.is("a") ? $href.closest($('.isotope-system')) : $href),
                    isotopeWrapper = isotopeSystem.find($('.isotope-wrapper')),
                    isotopeFooter = isotopeSystem.find($('.isotope-footer-inner')),
                    isotopeContainer = isotopeSystem.find($('.isotope-layout')),
                    isotopeId = isotopeSystem.attr('id');
                if ($href.is("a")) history.pushState({
                    myIsotope: true
                }, document.title, href);
                $.ajax({
                    url: href
                }).done(function(data) {
                    var $resultItems = $(data).find('#' + isotopeId + ' .isotope-layout').html(),
                        $resultPagination = $(data).find('#' + isotopeId + ' .pagination'),
                        $resultLoadMore = $(data).find('#' + isotopeId + ' .loadmore-button');
                    isotopeWrapper.addClass('isotope-reloaded');
                    setTimeout(function() {
                        isotopeWrapper.removeClass('isotope-loading');
                        isotopeWrapper.removeClass('isotope-reloaded');
                    }, 500);
                    $.each($('> .tmb > .t-inside', isotopeContainer), function(index, val) {
                        var parent = $(val).parent(),
                            objTimeout = parent.data('objTimeout');
                        if (objTimeout) {
                            $(val).removeClass('zoom-reverse').removeClass('start_animation')
                            clearTimeout(objTimeout);
                        }
                        if ($(val).hasClass('animate_when_almost_visible')) {
                            $(val).addClass('zoom-reverse').removeClass('start_animation');
                        } else {
                            $(val).addClass('animate_when_almost_visible zoom-reverse zoom-in force-anim');
                        }
                    });
                    $('.pagination', isotopeFooter).remove();
                    isotopeFooter.append($resultPagination);

                    $('.loadmore-button', isotopeFooter).remove();
                    isotopeFooter.append($resultLoadMore);

                    setTimeout(function() {
                        if (isotopeContainer.data('isotope')) {
                            isotopeContainer.html($resultItems).isotope('reloadItems', onLayout(isotopeContainer, 0));
                            UNCODE.adaptive();
                            var getLightbox = UNCODE.lightboxArray['ilightbox_' + isotopeContainer.closest('.isotope-system').attr('id')];
                            if (typeof getLightbox === 'object') getLightbox.refresh();
                        }
                        init_isotope();
                    }, 300);
                });
            };
            $filters.each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'a', function() {
                    $buttonGroup.find('.active').removeClass('active');
                    $(this).addClass('active');
                });
            });
            window.addEventListener('boxResized', function(e) {
                $.each($('.isotope-layout'), function(index, val) {
                    var $layoutMode = ($(this).data('layout'));
                    if ($layoutMode === undefined) $layoutMode = 'masonry';
                    if ($(this).data('isotope')) {
                        $(this).isotope({
                            itemSelector: $itemSelector,
                            layoutMode: $layoutMode,
                            transitionDuration: transitionDuration[index],
                            masonry: {
                                columnWidth: colWidth(index)
                            },
                            vertical: {
                                horizontalAlignment: 0.5,
                            },
                            sortBy: 'original-order',
                            isOriginLeft: isOriginLeft
                        });
                        $(this).isotope('unbindResize');
                    }
                    $(this).find('.mejs-video,.mejs-audio').each(function() {
                        $(this).trigger('resize');
                    });
                });
            }, false);
            init_isotope();
        };
    }

    UNCODE.lightbox = function() {
        UNCODE.lightboxArray = {};
        setTimeout(function() {
            var groupsArr = {};
            $('[data-lbox^=ilightbox]:not(.lb-disabled)').each(function() {
                var group = this.getAttribute("data-lbox"),
                    values = $(this).data();
                groupsArr[group] = values;
            });
            for (var i in groupsArr) {
                var skin = groupsArr[i].skin || 'black',
                    path = groupsArr[i].dir || 'horizontal',
                    thumbs = !groupsArr[i].notmb || false,
                    arrows = !groupsArr[i].noarr || false,
                    social = groupsArr[i].social || false,
                    deeplink = groupsArr[i].deep || false,
                    counter = $('[data-lbox="' + i + '"]:not(.lb-disabled)').length;
                if (social) social = {
                    facebook: true,
                    twitter: true,
                    googleplus: true,
                    reddit: true,
                    digg: true,
                    delicious: true
                };
                UNCODE.lightboxArray[i] = $('[data-lbox="' + i + '"]:not(.lb-disabled)').iLightBox({
                    skin: skin,
                    path: path,
                    linkId: deeplink,
                    infinite: false,
                    //fullViewPort: 'fit',
                    smartRecognition: false,
                    fullAlone: false,
                    maxScale: 1,
                    minScale: .02,
                    //fullStretchTypes: 'flash, video',
                    overlay: {
                        opacity: .94
                    },
                    controls: {
                        arrows: (counter > 1 ? arrows : false),
                        fullscreen: true,
                        thumbnail: thumbs,
                        slideshow: (counter > 1 ? true : false)
                    },
                    show: {
                        speed: 200
                    },
                    hide: {
                        speed: 200
                    },
                    social: {
                        start: false,
                        buttons: social
                    },
                    caption: {
                        start: false
                    },
                    styles: {
                        nextOpacity: 1,
                        nextScale: 1,
                        prevOpacity: 1,
                        prevScale: 1
                    },
                    effects: {
                        switchSpeed: 400
                    },
                    slideshow: {
                        pauseTime: 5000
                    },
                    thumbnails: {
                        maxWidth: 60,
                        maxHeight: 60,
                        activeOpacity: .2
                    },
                    html5video: {
                        preload: true
                    }
                });
            };
        }, 100);
    };

    UNCODE.backVideo = function() {
        $(function() {
            $.each($('.background-video-shortcode'), function() {
                var video_id = $(this).attr('id');
                if (typeof MediaElement === "function") {
                    new MediaElement(video_id, {
                        startVolume: 0,
                        loop: true,
                        success: function(mediaElement, domObject) {
                            mediaElement.play();
                            $(mediaElement).closest('.uncode-video-container').css('opacity','1');
                            domObject.volume = 0;
                        },
                        // fires when a problem is detected
                        error: function() {}
                    });
                }
            });
        });
    };

    UNCODE.carousel = function(container) {
        var $owlSelector = $('.owl-carousel-container > [class*="owl-carousel"]', container),
            values = {},
            tempTimeStamp,
            currentIndex,
            $owlInsideEqual = [];
        $owlSelector.each(function() {
            var itemID = $(this).attr('id'),
                $elSelector = $(('#' + itemID).toString());
            values['id'] = itemID;
            values['items'] = 1;
            values['columns'] = 3;
            values['fade'] = false;
            values['nav'] = false;
            values['navmobile'] = false;
            values['navskin'] = 'light';
            values['navspeed'] = 400;
            values['dots'] = false;
            values['dotsmobile'] = false;
            values['loop'] = false;
            values['autoplay'] = false;
            values['timeout'] = 3000;
            values['autoheight'] = false;
            values['margin'] = 0;
            values['lg'] = 1;
            values['md'] = 1;
            values['sm'] = 1;
            $.each($(this).data(), function(i, v) {
                values[i] = v;
            });

            if ($(this).closest('.uncode-slider').length) {
                values['navskin'] = '';
                values['navmobile'] = false;
                values['dotsmobile'] = true;
            } else {
                values['navskin'] = ' style-'+values['navskin']+' style-override';
            }

            /** Initialized */
            $elSelector.on('initialized.owl.carousel', function(event) {

                var thiis = $(event.currentTarget),
                    // get the time from the data method
                    time = thiis.data("timer-id");
                if (time) {
                    clearTimeout(time);
                }

                thiis.addClass('showControls');
                var new_time = setTimeout(function() {
                    thiis.closest('.owl-carousel-container').removeClass('owl-carousel-loading');
                    if (thiis.hasClass('owl-height-equal')) setItemsHeight(event.currentTarget);
                    if (!UNCODE.isMobile && !$elSelector.closest('.header-wrapper').length) navHover($elSelector.parent());
                    if (thiis.closest('.unequal, .unexpand').length) {
                        var rowParent = thiis.closest('.row-parent');
                        UNCODE.setRowHeight(rowParent[0], true);
                    }
                }, 350);
                // save the new time
                thiis.data("timer-id", new_time);

                var scrolltop = $(document).scrollTop();
                $(event.currentTarget).closest('.uncode-slider').find('video').removeAttr('poster');

                //if (!UNCODE.isMobile) {
                /** fix autoplay when visible **/
                if ($(event.currentTarget).data('autoplay')) {
                    $(event.currentTarget).trigger('stop.autoplay.owl');
                }
                var carouselInView = new Waypoint.Inview({
                    element: $(event.currentTarget)[0],
                    enter: function(direction) {
                        var el = $(this.element);
                        if (el.data('autoplay')) {
                            el.trigger('play.owl.autoplay');
                            el.data('stopped','false');
                        }
                    },
                    exited: function() {
                        if ($(this.element).data('autoplay')) {
                            $(this.element).trigger('stop.owl.autoplay');
                            $(this.element).data('stopped','true');
                        }
                    }
                });
                //}

                if (!$(event.currentTarget).closest('.isotope-system').length) {
                    setTimeout(function() {
                        animate_thumb($('.t-inside', el), event);
                    }, 400);
                }

                var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
                    currentIndex = $(currentItem).attr('data-index');

                $.each($('.owl-item:not(.active) .start_animation', $(event.target)), function(index, val) {
                    if ($(val).closest('.uncode-slider').length) {
                        $(val).removeClass('start_animation');
                    }
                });

                $.each($('.owl-item:not(.active)', event.currentTarget), function(index, val) {
                    if ($(val).hasClass('cloned')) {
                        $('.t-entry-visual-cont > a', $(val)).attr('data-lbox-clone', true);
                    }
                    if ($(val).attr('data-index') != currentIndex) {
                        $('.start_animation:not(.t-inside)', val).removeClass('start_animation');
                    }
                    if ($(val).attr('data-index') == currentIndex) {
                        $('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
                    }
                });

                if ($(event.currentTarget).closest('.uncode-slider').length) {
                    var el = $(event.currentTarget).closest('.row-parent')[0];
                    if ($(el).data('imgready')) {
                        firstLoaded(el, event);
                    } else {
                        el.addEventListener("imgLoaded", function(el) {
                            firstLoaded(el.target, event);
                        }, false);
                    }
                    var transHeight = $('.hmenu .menu-transparent.menu-primary .menu-container').height() - UNCODE.bodyBorder;
                    if (transHeight != null) {
                        setTimeout(function() {
                            $(event.currentTarget).closest('.uncode-slider').find('.owl-prev, .owl-next').css('paddingTop', transHeight / 2 + 'px');
                        }, 100);
                    }
                } else {
                    var el = $(event.currentTarget);
                    el.closest('.uncode-slider').addClass('slider-loaded');
                }

                setTimeout(function() {
                    window.uncode_textfill(thiis);
                    if ($(event.currentTarget).closest('.uncode-slider').length) {
                        if ($(event.currentTarget).data('autoplay')) pauseOnHover(event.currentTarget);
                    }
                }, 500);

                if ($(event.currentTarget).closest('.unequal').length) {
                    $owlInsideEqual.push($(event.currentTarget).closest('.row-parent'));
                }

            });

            /** Resizing */
            $elSelector.on('resized.owl.carousel', function(event) {
                if ($(this).closest('.nested-carousel').length) {
                    setTimeout(function() {
                        window.dispatchEvent(UNCODE.boxEvent);
                    }, 200);
                }
                if ($(event.currentTarget).hasClass('owl-height-equal')) setItemsHeight(event.currentTarget);
            });

            /** Change */
            $elSelector.on('change.owl.carousel', function(event) {
                if (!UNCODE.isMobile) UNCODE.owlStopVideo(event.currentTarget);
            });

            /** Changed */
            $elSelector.on('changed.owl.carousel', function(event) {
                if (tempTimeStamp != event.timeStamp) {
                    var scrolltop = $(document).scrollTop();
                    var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[(event.item.index != null) ? event.item.index : 0];
                    if ($(event.currentTarget).closest('.row-slider').length) {
                        if (currentItem == undefined) {
                            currentItem = $(event.currentTarget).children()[0];
                        }
                        if ($(currentItem).closest('#page-header').length) {
                            if ($('.row-container > .row > .row-inner > div > .style-dark', currentItem).closest('.uncode-slider').length) {
                                UNCODE.switchColorsMenu(scrolltop, 'dark');
                            } else if ($('.row-container > .row > .row-inner > div > .style-light', currentItem).closest('.uncode-slider').length) {
                                UNCODE.switchColorsMenu(scrolltop, 'light');
                            }
                        }
                    }
                }
                tempTimeStamp = event.timeStamp;
            });

            $elSelector.on('translate.owl.carousel', function(event) {
                if (UNCODE.isMobile) {
                    $(event.currentTarget).addClass('owl-translating');
                }
            });

            /** Translated */
            $elSelector.on('translated.owl.carousel', function(event) {

                var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
                    currentIndex = $(currentItem).attr('data-index');

                if (!UNCODE.isMobile) {
                    UNCODE.owlPlayVideo(event.currentTarget);
                }

                setTimeout(function() {
                    var lastDelayElems = animate_elems($('.owl-item.active', event.currentTarget));
                    var lastDelayThumb = animate_thumb($('.owl-item.active .t-inside', event.currentTarget), event);
                    if ($(event.currentTarget).closest('.uncode-slider').length && $(event.currentTarget).data('autoplay')) {
                        if (lastDelayElems == undefined) lastDelayElems = 0;
                        if (lastDelayThumb == undefined) lastDelayThumb = 0;
                        var maxDelay = Math.max(lastDelayElems, lastDelayThumb);
                        $(event.currentTarget).trigger('stop.owl.autoplay');
                        setTimeout(function() {
                            if (!$(event.currentTarget).hasClass('owl-mouseenter') && $(event.currentTarget).data('stopped') != 'true') $(event.currentTarget).trigger('play.owl.autoplay');
                        }, maxDelay);
                    }
                }, 200);

                $.each($('.owl-item:not(.active) .start_animation', $(event.target)), function(index, val) {
                    if ($(val).closest('.uncode-slider').length) {
                        $(val).removeClass('start_animation');
                    }
                });

                $.each($('.owl-item:not(.active)', event.currentTarget), function(index, val) {
                    if ($(val).attr('data-index') != currentIndex) {
                        $('.start_animation:not(.t-inside)', val).removeClass('start_animation');
                    }
                    if ($(val).attr('data-index') == currentIndex) {
                        $('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
                    }
                });

                if (UNCODE.isMobile) {
                    $(event.currentTarget).removeClass('owl-translating');
                }

                // } else {
                // 	$(event.currentTarget).removeClass('owl-translating');
                // }
            });

            /** Init carousel */
            $elSelector.owlCarousel({
                items: values['items'],
                animateOut: (values['fade'] == true) ? 'fadeOut' : null,
                nav: values['nav'],
                dots: values['dots'],
                loop: values['loop'],
                margin: 0,
                video: true,
                autoWidth: false,
                autoplay: false,
                autoplayTimeout: values['timeout'],
                autoplaySpeed: values['navspeed'],
                autoplayHoverPause: $(this).closest('.uncode-slider').length ? false : true,
                autoHeight: ($(this).hasClass('owl-height-equal') || $(this).hasClass('owl-height-auto')) ? true : values['autoheight'],
                rtl: $('body').hasClass('rtl') ? true : false,
                fluidSpeed: true,
                navSpeed: values['navspeed'],
                navClass: [ 'owl-prev'+values['navskin'], 'owl-next'+values['navskin'] ],
                navText: ['<div class="owl-nav-container btn-default btn-hover-nobg"><i class="fa fa-fw fa-angle-left"></i></div>', '<div class="owl-nav-container btn-default btn-hover-nobg"><i class="fa fa-fw fa-angle-right"></i></div>'],
                navContainer: values['nav'] ? $elSelector : false,
                responsiveClass: true,
                responsiveBaseElement: '.box-container',
                responsive: {
                    0: {
                        items: values['sm'],
                        nav: values['navmobile'],
                        dots: values['dotsmobile']
                    },
                    480: {
                        items: values['sm'],
                        nav: values['navmobile'],
                        dots: values['dotsmobile']
                    },
                    570: {
                        items: values['md'],
                        nav: values['navmobile'],
                        dots: values['dotsmobile']
                    },
                    960: {
                        items: values['lg']
                    }
                },
            });

            setTimeout(function() {
                for (var i = $owlInsideEqual.length - 1; i >= 0; i--) {
                    UNCODE.setRowHeight($owlInsideEqual[i]);
                };
            }, 300);
        });

        function firstLoaded(el, event) {
            var el = $(el),
                uncode_slider = el.find('.uncode-slider');
            el.find('.owl-carousel').css('opacity', 1);
            uncode_slider.addClass('slider-loaded');
            window.uncode_textfill(el.find('.owl-item.active'));
            //if (!UNCODE.isMobile) {
            setTimeout(function() {
                var lastDelayElems = animate_elems(el.find('.owl-item.active'));
                var lastDelayThumb = animate_thumb(el.find('.owl-item.active .t-inside'), event);
                if (uncode_slider.length && el.find('.owl-carousel').data('autoplay')) {
                    if (lastDelayElems == undefined) lastDelayElems = 0;
                    if (lastDelayThumb == undefined) lastDelayThumb = 0;
                    var maxDelay = Math.max(lastDelayElems, lastDelayThumb);
                    $('> .owl-carousel', uncode_slider).trigger('stop.owl.autoplay');
                    setTimeout(function() {
                        $('> .owl-carousel', uncode_slider).trigger('play.owl.autoplay');
                    }, maxDelay);
                }
            }, 500);
            //}
        }

        function navHover(el) {
            var $owlCont = el,
                $owlPrev = $owlCont.find('.owl-prev'),
                $owlNext = $owlCont.find('.owl-next'),
                $owlDots = $owlCont.find('.owl-dots-inside .owl-dots'),
                $owlPagination = $owlCont.next(),
                owlPrevW = $owlPrev.outerWidth(),
                owlNextW = $owlNext.outerWidth(),
                owlDotsH = $owlDots.innerHeight(),
                owlTime = 400,
                owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
            $owlPrev.css("margin-left", -owlPrevW);
            $owlNext.css("margin-right", -owlNextW);
            if (!owlNested) $owlDots.css("bottom", -owlDotsH);
            $owlCont.mouseenter(function() {
                owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
                $owlPrev.css({
                    marginLeft: 0
                });
                $owlNext.css({
                    marginRight: 0
                });
                if (!owlNested) {
                    $owlDots.css({
                        opacity: 1,
                        bottom: 0
                    });
                }
            }).mouseleave(function() {
                owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
                $owlPrev.css({
                    marginLeft: -owlPrevW
                });
                $owlNext.css({
                    marginRight: -owlNextW
                });
                if (!owlNested) {
                    $owlDots.css({
                        opacity: 1,
                        bottom: -owlDotsH
                    });
                }
            });
        };

        function animate_elems($this) {
            var lastDelay;
            $.each($('.animate_when_almost_visible:not(.t-inside)', $this), function(index, val) {
                var element = $(val),
                    delayAttr = element.attr('data-delay');
                if (delayAttr == undefined) delayAttr = 0;
                setTimeout(function() {
                    element.addClass('start_animation');
                }, delayAttr);
                lastDelay = delayAttr;
            });
            return lastDelay;
        }

        function animate_thumb(items, event) {
            var lastDelay,
                itemIndex,
                tempIndex = ($(event.currentTarget).data('tempIndex') == undefined) ? $('.owl-item.active', event.currentTarget).first().index() : $(event.currentTarget).data('tempIndex'),
                numActives = $('.owl-item.active', event.currentTarget).length;
            $(event.currentTarget).data('tempIndex', event.item.index);
            $.each(items, function(index, val) {
                var parent = $(val).closest('.owl-item');
                if (!$(val).hasClass('start_animation')) {
                    if (parent.hasClass('active')) {
                        var thumbInView = new Waypoint.Inview({
                            element: val,
                            enter: function(direction) {
                                var element = $(this.element),
                                    delayAttr = parseInt(element.attr('data-delay')),
                                    itemIndex = element.closest('.owl-item').index() + 1,
                                    diffItem = Math.abs(itemIndex - tempIndex) - 1;
                                if (itemIndex > tempIndex) {
                                    $(event.currentTarget).data('tempIndex', itemIndex);
                                }
                                if (isNaN(delayAttr)) delayAttr = 100;
                                $('.owl-item.cloned[data-index="'+(element.closest('.owl-item').data('index'))+'"] .t-inside', event.currentTarget).addClass('start_animation');
                                var objTimeout = setTimeout(function() {
                                    element.addClass('start_animation');
                                }, diffItem * delayAttr);
                                lastDelay = diffItem * delayAttr;
                                parent.data('objTimeout', objTimeout);
                                this.destroy();
                            }
                        });
                    }
                }
            });
            return lastDelay;
        }

        function setItemsHeight(item) {
            $.each($('.owl-item', item), function(index, val) {
                var availableThumbHeight = $('.t-inside', $(val)).height(),
                    innerThumbHeight = $('.t-entry-text-tc', $(val)).outerHeight(),
                    difference = availableThumbHeight - innerThumbHeight;
                if ($('.tmb-content-under', val).length) {
                    var visualPart = $('.t-entry-visual', val);
                    if (visualPart.length) {
                        difference -= $('.t-entry-visual', val).height();
                    }
                }
                $('.t-entry > *:last-child', val).css( 'transform', 'translateY('+difference+'px)' );
            });
        }

        function pauseOnHover(slider) {
            $('.owl-dots, .owl-prev, .owl-next', slider).on({
                mouseenter: function () {
                    $(slider).addClass('owl-mouseenter');
                    $(slider).trigger('stop.owl.autoplay');
                },
                mouseleave: function () {
                    $(slider).removeClass('owl-mouseenter')
                    $(slider).trigger('play.owl.autoplay');
                }
            });
        }
    };

    UNCODE.owlPlayVideo = function(carousel) {
        var player, iframe;
        $('.owl-item.active .uncode-video-container', carousel).each(function(index, val) {
            var content = $(val).html();
            if (content == '') {
                var getCloned = $('.owl-item:not(.active) .uncode-video-container[data-id="'+$(this).attr('data-id')+'"]').children().first().clone();
                $(val).append(getCloned);
            }
            if ($(this).attr('data-provider') == 'vimeo') {
                iframe = $(this).find('iframe');
                player = $f(iframe[0]);
                player.api('play');
            } else if ($(this).attr('data-provider') == 'youtube') {
                if (youtubePlayers[$(this).attr('data-id')] != undefined) youtubePlayers[$(this).attr('data-id')].playVideo();
            } else {
                var player = $(this).find('video');
                if (player.length) {
                    $(this).find('video')[0].volume = 0;
                    $(this).find('video')[0].play();
                    $(val).css('opacity', 1);
                }
            }
        });
    };

    UNCODE.owlStopVideo = function(carousel) {
        $('.owl-item .uncode-video-container', carousel).each(function(index, val) {
            var player, iframe;
            if ($(this).attr('data-provider') == 'vimeo') {
                iframe = $(this).find('iframe');
                player = $f(iframe[0]);
                player.api('pause');
            } else if ($(this).attr('data-provider') == 'youtube') {
                if (youtubePlayers[$(this).attr('data-id')] != undefined) youtubePlayers[$(this).attr('data-id')].pauseVideo();
            } else {
                var player = $(this).find('video');
                if (player.length) {
                    $(this).find('video')[0].volume = 0;
                    $(this).find('video')[0].play();
                }
            }
        });
    };

    UNCODE.animations = function() {
        //if (!UNCODE.isMobile) {
        $.each($('.header-content-inner'), function(index, val) {
            var element = $(val),
                transition = '';
            if (element.hasClass('top-t-bottom')) transition = 'top-t-bottom';
            if (element.hasClass('bottom-t-top')) transition = 'bottom-t-top';
            if (element.hasClass('left-t-right')) transition = 'left-t-right';
            if (element.hasClass('right-t-left')) transition = 'right-t-left';
            if (element.hasClass('zoom-in')) transition = 'zoom-in';
            if (element.hasClass('zoom-out')) transition = 'zoom-out';
            if (element.hasClass('alpha-anim')) transition = 'alpha-anim';
            if (transition != '') {
                $(val).removeClass(transition);
                var container = element,
                    containerDelay = container.attr('data-delay'),
                    containerSpeed = container.attr('data-speed'),
                    items = $('.header-title > *, .post-info', container);
                $.each(items, function(index, val) {
                    var element = $(val),
                        //speedAttr = (containerSpeed == undefined) ? containerSpeed : '',
                        delayAttr = (containerDelay != undefined) ? containerDelay : 400;
                    if (!element.hasClass('animate_when_almost_visible')) {
                        delayAttr = Number(delayAttr) + (400 * index);
                        if (containerSpeed != undefined) element.attr('data-speed', containerSpeed);
                        element.addClass(transition + ' animate_when_almost_visible').attr('data-delay', delayAttr);
                    }
                });
                container.css('opacity', 1);
            }
        });
        //}

        if (!window.waypoint_animation) {
            window.waypoint_animation = function() {
                $.each($('.animate_when_almost_visible:not(.start_animation):not(.t-inside), .tmb-media .animate_when_almost_visible:not(.start_animation)'), function(index, val) {
                    var run = true;
                    if ($(val).closest('.owl-carousel').length > 0) run = false;
                    if (run) {
                        new Waypoint({
                            element: val,
                            handler: function() {
                                var element = $(this.element),
                                    index = element.index(),
                                    delayAttr = element.attr('data-delay');
                                if (delayAttr == undefined) delayAttr = 0;
                                setTimeout(function() {
                                    element.addClass('start_animation');
                                }, delayAttr);
                                this.destroy();
                            },
                            offset: '90%'
                        });
                    }
                });
            }
        }
        setTimeout(function() {
            window.waypoint_animation();
        }, 100);
    }

    UNCODE.tapHover = function() {

        var $el = $('html.touch .tmb:not(.tmb-no-double-tap) .t-entry-visual-cont > a'), //.length //html.touch a.btn
            elClass = "hover";

        $el.on("click", function(e) { // cambia click con touch start 'touchstart'
            var link = $(this);
            if (link.hasClass(elClass)) {
                return true;
            } else {
                link.addClass("hover");
                $el.not(this).removeClass(elClass);
                e.preventDefault();
                return false;
            }
        });
    };


    UNCODE.onePage = function(isMobile) {
        var current = 0,
            last = 0,
            lastScrollTop = 0,
            forceScroll = false,
            lastScrolled = 0,
            isSectionscroller = ($('.main-onepage').length) ? true : false,
            getOffset = (($('.menu-sticky .menu-container:not(.menu-hide)').length && ($(window).width() > UNCODE.mediaQuery)) ? $('.menu-sticky .menu-container:not(.menu-hide)').outerHeight() : 0);

        function init_onepage() {
            if (isSectionscroller && !isMobile) {
                $("<ul class='onepage-pagination'></ul>").prependTo("body");
            }
            last = $('.onepage-section').length - 1;
            $.each($('div[data-parent=true]'), function(index, val) {
                $(this).attr('data-section', index);
                if (isMobile) return;
                var sectionDown = new Waypoint({
                    element: val,
                    handler: function(direction) {
                        if (direction == 'down') {
                            changeMenuActive(this.element, index);
                        }
                    },
                    offset: 1 + getOffset
                });
                var sectionUp = new Waypoint({
                    element: val,
                    handler: function(direction) {
                        if (direction == 'up') {
                            changeMenuActive(this.element, index);
                        }
                    },
                    offset: -1 + getOffset
                });

                if (isSectionscroller) {
                    var label;
                    if ($(this).attr('data-label') != undefined) label = $(this).attr('data-label');
                    else label = '';
                    var getName = $(this).attr('data-name');
                    if (getName == undefined) getName = index;
                    if (label != '') {
                        label = '<span class="cd-label style-accent-bg border-accent-color">' + label + '</span>';
                        $('ul.onepage-pagination').append("<li><a class='one-dot-link' data-index='" + (index) + "' href='#" + (getName) + "'><span class='cd-dot-cont'><span class='cd-dot'></span></span>"+label+"</a></li>");
                    }
                }
            });

            if (isSectionscroller) {
                $.each($('ul.onepage-pagination li'), function(index, val) {
                    var $this = $(val);
                    $this.on('click', function(evt) {
                        var el = $('a', evt.currentTarget);
                        current = lastScrolled = parseInt(el.attr('data-index'));
                        lastScrolled += 1;
                        scrollBody(current);
                    });
                });
            }

            var goToSection = parseInt((window.location.hash).replace(/[^\d.]/g, ''));
            if (isNaN(goToSection) && window.location.hash != undefined && window.location.hash != '') {
                goToSection = String(window.location.hash).replace(/^#/, "");
                goToSection = Number($('[data-name=' + goToSection + ']').attr('data-section'));
            }

            if (typeof goToSection === 'number' && !isNaN(goToSection)) {
                current = lastScrolled = goToSection;
                setTimeout(function() {
                    scrollBody(goToSection);
                }, 500);
            }

        }

        function changeMenuActive(section, index) {
            current = lastScrolled = parseInt($(section).attr('data-section'));
            if (isSectionscroller) {
                var newSection = $('.onepage-pagination li a[data-index=' + index + ']');
                if (newSection.length) {
                    $('ul.onepage-pagination li a').removeClass('is-selected');
                    newSection.addClass('is-selected');
                }
            }
            var getName = $('[data-section=' + index + ']').attr('data-name');
            if (getName != undefined) {
                $.each($('.menu-container .menu-item > a, .widget_nav_menu .menu-smart .menu-item > a'), function(i, val) {
                    var get_href = $(val).attr('href');
                    if (get_href != undefined && get_href.substring(get_href.indexOf('#')+1) == getName) {
                        $(val).closest('ul').find('.active').removeClass('active');
                        $(val).parent().addClass('active');
                    }
                });
            }
        }

        if (isSectionscroller) {
            $(window).on('scroll', function() {
                var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'];
                if (bodyTop == 0) {
                    $('ul.onepage-pagination li a').removeClass('is-selected');
                    $('.onepage-pagination li a[data-index=0]').addClass('is-selected');
                    var getName = $('[data-section=0]').attr('data-name');
                    if (getName != undefined) {
                        $.each($('.menu-container .menu-item > a'), function(i, val) {
                            var get_href = $(val).attr('href');
                            if (get_href != undefined && get_href.substring(get_href.indexOf('#')+1) == getName) {
                                $(val).closest('ul').find('.active').removeClass('active');
                                $(val).parent().addClass('active');
                            }
                        });
                    }
                } else if ((window.innerHeight + bodyTop) >= $('.box-container').height()) {
                    var lastSection = $('.onepage-pagination li a[data-index="' + last +'"]');
                    if (lastSection.length) {
                        $('ul.onepage-pagination li a').removeClass('is-selected');
                        lastSection.addClass('is-selected');
                    }
                }
            });
        }

        var scrollBody = function(index) {
            $('ul.onepage-pagination li a').removeClass('is-selected');
            $('.onepage-pagination li a[data-index=' + index + ']').addClass('is-selected');
            var body = $("html, body"),
                bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
                delta = bodyTop - $('[data-section=' + index + ']').offset().top,
                scrollTo = $('[data-section=' + index + ']').offset().top;
            scrollTo -= UNCODE.get_scroll_offset();

            var scrollSpeed = (SiteParameters.constant_scroll == 'on') ? Math.abs(delta) / parseFloat(SiteParameters.scroll_speed) : SiteParameters.scroll_speed;
            if (scrollSpeed < 1000 && SiteParameters.constant_scroll == 'on') scrollSpeed = 1000;

            if (index != 0) {
                UNCODE.scrolling = true;
            }
            if (scrollSpeed == 0) {
                body.scrollTop((delta > 0) ? scrollTo - 0.1 : scrollTo);
                UNCODE.scrolling = false;
            } else {
                body.animate({
                    scrollTop: (delta > 0) ? scrollTo - 0.1 : scrollTo
                }, scrollSpeed, 'easeInOutQuad', function() {
                    setTimeout(function(){
                        UNCODE.scrolling = false;
                    }, 100);
                });
            }

        };

        init_onepage();
    };

    UNCODE.stickyElements = function() {
        if (!UNCODE.isMobile) {
            setTimeout(function() {
                if ($('.sticky-element').length) {
                    var getRowPadding = $('.sticky-element.sticky-sidebar').closest('.row-parent').css("padding-top"),
                        sideOffset = (getRowPadding != undefined) ? parseInt(getRowPadding.replace("px", "")) : 0;
                    sideOffset += UNCODE.bodyBorder;
                    if (UNCODE.adminBarHeight > 0) sideOffset += UNCODE.adminBarHeight;
                    if ($('.menu-sticky .menu-container:not(.menu-hide)').length) {
                        if ($('.menu-shrink').length) {
                            sideOffset += $('.navbar-brand').data('minheight') + 36;
                        } else sideOffset += ($('body.hmenu-center').length ? $('#masthead .menu-container').outerHeight() : parseInt(UNCODE.menuMobileHeight));
                    }
                    if ($(window).width() > UNCODE.mediaQuery) {
                        $(".sticky-element").stick_in_parent({
                            sticky_class: 'is_stucked',
                            offset_top: sideOffset,
                            bottoming: true,
                            inner_scrolling: false
                        });
                    }
                    $(window).on('resize', function(event) {
                        if ($(window).width() > UNCODE.mediaQuery) {
                            $(".sticky-element").stick_in_parent({
                                sticky_class: 'is_stucked',
                                offset_top: sideOffset,
                                bottoming: true,
                                inner_scrolling: false
                            });
                        } else {
                            $(".sticky-element").trigger("sticky_kit:detach");
                        }
                    });
                }
            }, 1000);
        }
    };

    UNCODE.scrollEnance = function() {
        //
        // SmoothScroll for websites v1.4.4 (Balazs Galambosi)
        // http://www.smoothscroll.net/
        //
        // Licensed under the terms of the MIT license.
        //
        // You may use it in your theme if you credit me.
        // It is also free to use on any individual website.
        //
        // Exception:
        // The only restriction is to not publish any
        // extension for browsers or native application
        // without getting a written permission first.
        //
        UNCODE.navigating = false;
        (function () {

            // Scroll Variables (tweakable)
            var defaultOptions = {

                // Scrolling Core
                frameRate        : 150, // [Hz]
                animationTime    : 500, // [ms]
                stepSize         : 100, // [px]

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm   : true,
                pulseScale       : 4,
                pulseNormalize   : 1,

                // Acceleration
                accelerationDelta : 50,  // 50
                accelerationMax   : 3,   // 3

                // Keyboard Settings
                keyboardSupport   : true,  // option
                arrowScroll       : 50,    // [px]

                // Other
                touchpadSupport   : false, // ignore touchpad by default
                fixedBackground   : true,
                excluded          : ''
            };

            var options = defaultOptions;


            // Other Variables
            var isExcluded = false;
            var isFrame = false;
            var direction = { x: 0, y: 0 };
            var initDone  = false;
            var root = document.documentElement;
            var activeElement;
            var observer;
            var refreshSize;
            var deltaBuffer = [];
            var isMac = /^Mac/.test(navigator.platform);

            var key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32,
                pageup: 33, pagedown: 34, end: 35, home: 36 };
            var arrowKeys = { 37: 1, 38: 1, 39: 1, 40: 1 };

            /***********************************************
             * INITIALIZE
             ***********************************************/

            /**
             * Tests if smooth scrolling is allowed. Shuts down everything if not.
             */
            function initTest() {
                if (options.keyboardSupport) {
                    addEvent('keydown', keydown);
                }
            }

            /**
             * Sets up scrolls array, determines if frames are involved.
             */
            function init() {

                if (initDone || !document.body) return;

                initDone = true;

                var body = document.body;
                var html = document.documentElement;
                var windowHeight = window.innerHeight;
                var scrollHeight = body.scrollHeight;

                // check compat mode for root element
                root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
                activeElement = body;

                initTest();

                // Checks if this script is running in a frame
                if (top != self) {
                    isFrame = true;
                }

                /**
                 * Please duplicate this radar for a Safari fix!
                 * rdar://22376037
                 * https://openradar.appspot.com/radar?id=4965070979203072
                 *
                 * Only applies to Safari now, Chrome fixed it in v45:
                 * This fixes a bug where the areas left and right to
                 * the content does not trigger the onmousewheel event
                 * on some pages. e.g.: html, body { height: 100% }
                 */
                else if (scrollHeight > windowHeight &&
                    (body.offsetHeight <= windowHeight ||
                    html.offsetHeight <= windowHeight)) {

                    var fullPageElem = document.createElement('div');
                    fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                        'top:0; left:0; right:0; height:' +
                        root.scrollHeight + 'px';
                    document.body.appendChild(fullPageElem);

                    // DOM changed (throttled) to fix height
                    var pendingRefresh;
                    refreshSize = function () {
                        if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
                        pendingRefresh = setTimeout(function () {
                            if (isExcluded) return; // could be running after cleanup
                            fullPageElem.style.height = '0';
                            fullPageElem.style.height = root.scrollHeight + 'px';
                            pendingRefresh = null;
                        }, 500); // act rarely to stay fast
                    };

                    setTimeout(refreshSize, 10);

                    addEvent('resize', refreshSize);

                    // TODO: attributeFilter?
                    var config = {
                        attributes: true,
                        childList: true,
                        characterData: false
                        // subtree: true
                    };

                    observer = new MutationObserver(refreshSize);
                    observer.observe(body, config);

                    if (root.offsetHeight <= windowHeight) {
                        var clearfix = document.createElement('div');
                        clearfix.style.clear = 'both';
                        body.appendChild(clearfix);
                    }
                }

                // disable fixed background
                if (!options.fixedBackground && !isExcluded) {
                    body.style.backgroundAttachment = 'scroll';
                    html.style.backgroundAttachment = 'scroll';
                }
            }

            /**
             * Removes event listeners and other traces left on the page.
             */
            function cleanup() {
                observer && observer.disconnect();
                removeEvent(wheelEvent, wheel);
                removeEvent('mousedown', mousedown);
                removeEvent('keydown', keydown);
                removeEvent('resize', refreshSize);
                removeEvent('load', init);
            }


            /************************************************
             * SCROLLING
             ************************************************/

            var que = [];
            var pending = false;
            var lastScroll = Date.now();

            /**
             * Pushes scroll actions to the scrolling queue.
             */
            function scrollArray(elem, left, top) {

                directionCheck(left, top);

                if (options.accelerationMax != 1) {
                    var now = Date.now();
                    var elapsed = now - lastScroll;
                    if (elapsed < options.accelerationDelta) {
                        var factor = (1 + (50 / elapsed)) / 2;
                        if (factor > 1) {
                            factor = Math.min(factor, options.accelerationMax);
                            left *= factor;
                            top  *= factor;
                        }
                    }
                    lastScroll = Date.now();
                }

                // push a scroll command
                que.push({
                    x: left,
                    y: top,
                    lastX: (left < 0) ? 0.99 : -0.99,
                    lastY: (top  < 0) ? 0.99 : -0.99,
                    start: Date.now()
                });

                // don't act if there's a pending queue
                if (pending) {
                    return;
                }

                var scrollWindow = (elem === document.body);

                var step = function (time) {

                    var now = Date.now();
                    var scrollX = 0;
                    var scrollY = 0;

                    for (var i = 0; i < que.length; i++) {

                        var item = que[i];
                        var elapsed  = now - item.start;
                        var finished = (elapsed >= options.animationTime);

                        // scroll position: [0, 1]
                        var position = (finished) ? 1 : elapsed / options.animationTime;

                        // easing [optional]
                        if (options.pulseAlgorithm) {
                            position = pulse(position);
                        }

                        // only need the difference
                        var x = (item.x * position - item.lastX) >> 0;
                        var y = (item.y * position - item.lastY) >> 0;

                        // add this to the total scrolling
                        scrollX += x;
                        scrollY += y;

                        // update last values
                        item.lastX += x;
                        item.lastY += y;

                        // delete and step back if it's over
                        if (finished) {
                            que.splice(i, 1); i--;
                        }
                    }

                    // scroll left and top
                    if (scrollWindow) {
                        window.scrollBy(scrollX, scrollY);
                    }
                    else {
                        if (scrollX) elem.scrollLeft += scrollX;
                        if (scrollY) elem.scrollTop  += scrollY;
                    }

                    // clean up if there's nothing left to do
                    if (!left && !top) {
                        que = [];
                    }

                    if (que.length) {
                        requestFrame(step, elem, (1000 / options.frameRate + 1));
                    } else {
                        pending = false;
                    }
                };

                // start a new queue of actions
                requestFrame(step, elem, 0);
                pending = true;
            }


            /***********************************************
             * EVENTS
             ***********************************************/

            /**
             * Mouse wheel handler.
             * @param {Object} event
             */
            function wheel(event) {

                if (!initDone) {
                    init();
                }

                var target = event.target;
                var overflowing = overflowingAncestor(target);

                // use default if there's no overflowing
                // element or default action is prevented
                // or it's a zooming event with CTRL
                if (!overflowing || event.defaultPrevented || event.ctrlKey) {
                    return true;
                }

                // leave embedded content alone (flash & pdf)
                if (isNodeName(activeElement, 'embed') ||
                    (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
                    isNodeName(activeElement, 'object') ||
                    target.shadowRoot) {
                    return true;
                }

                var deltaX = -event.wheelDeltaX || event.deltaX || 0;
                var deltaY = -event.wheelDeltaY || event.deltaY || 0;

                if (isMac) {
                    if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
                        deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
                    }
                    if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
                        deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
                    }
                }

                // use wheelDelta if deltaX/Y is not available
                if (!deltaX && !deltaY) {
                    deltaY = -event.wheelDelta || 0;
                }

                // line based scrolling (Firefox mostly)
                if (event.deltaMode === 1) {
                    deltaX *= 40;
                    deltaY *= 40;
                }

                // check if it's a touchpad scroll that should be ignored
                if (!options.touchpadSupport && isTouchpad(deltaY)) {
                    return true;
                }

                // scale by step size
                // delta is 120 most of the time
                // synaptics seems to send 1 sometimes
                if (Math.abs(deltaX) > 1.2) {
                    deltaX *= options.stepSize / 120;
                }
                if (Math.abs(deltaY) > 1.2) {
                    deltaY *= options.stepSize / 120;
                }

                scrollArray(overflowing, deltaX, deltaY);

                if (Math.abs(deltaX) > 10 && !UNCODE.navigating) {
                    if (deltaX > 0) {
                        UNCODE.navigating = true;
                        window.history.forward();
                    } else {
                        UNCODE.navigating = true;
                        window.history.back();
                    }
                } else event.preventDefault();
                scheduleClearCache();
            }

            /**
             * Keydown event handler.
             * @param {Object} event
             */
            function keydown(event) {

                var target   = event.target;
                var modifier = event.ctrlKey || event.altKey || event.metaKey ||
                    (event.shiftKey && event.keyCode !== key.spacebar);

                // our own tracked active element could've been removed from the DOM
                if (!document.body.contains(activeElement)) {
                    activeElement = document.activeElement;
                }

                // do nothing if user is editing text
                // or using a modifier key (except shift)
                // or in a dropdown
                // or inside interactive elements
                var inputNodeNames = /^(textarea|select|embed|object)$/i;
                var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
                if ( event.defaultPrevented ||
                    inputNodeNames.test(target.nodeName) ||
                    isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
                    isNodeName(activeElement, 'video') ||
                    isInsideYoutubeVideo(event) ||
                    target.isContentEditable ||
                    modifier ) {
                    return true;
                }

                // [spacebar] should trigger button press, leave it alone
                if ((isNodeName(target, 'button') ||
                    isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
                    event.keyCode === key.spacebar) {
                    return true;
                }

                // [arrwow keys] on radio buttons should be left alone
                if (isNodeName(target, 'input') && target.type == 'radio' &&
                    arrowKeys[event.keyCode])  {
                    return true;
                }

                var shift, x = 0, y = 0;
                var elem = overflowingAncestor(activeElement);
                var clientHeight = elem.clientHeight;

                if (elem == document.body) {
                    clientHeight = window.innerHeight;
                }

                switch (event.keyCode) {
                    case key.up:
                        y = -options.arrowScroll;
                        break;
                    case key.down:
                        y = options.arrowScroll;
                        break;
                    case key.spacebar: // (+ shift)
                        shift = event.shiftKey ? 1 : -1;
                        y = -shift * clientHeight * 0.9;
                        break;
                    case key.pageup:
                        y = -clientHeight * 0.9;
                        break;
                    case key.pagedown:
                        y = clientHeight * 0.9;
                        break;
                    case key.home:
                        y = -elem.scrollTop;
                        break;
                    case key.end:
                        var damt = elem.scrollHeight - elem.scrollTop - clientHeight;
                        y = (damt > 0) ? damt+10 : 0;
                        break;
                    case key.left:
                        x = -options.arrowScroll;
                        break;
                    case key.right:
                        x = options.arrowScroll;
                        break;
                    default:
                        return true; // a key we don't care about
                }

                scrollArray(elem, x, y);
                event.preventDefault();
                scheduleClearCache();
            }

            /**
             * Mousedown event only for updating activeElement
             */
            function mousedown(event) {
                activeElement = event.target;
            }


            /***********************************************
             * OVERFLOW
             ***********************************************/

            var uniqueID = (function () {
                var i = 0;
                return function (el) {
                    return el.uniqueID || (el.uniqueID = i++);
                };
            })();

            var cache = {}; // cleared out after a scrolling session
            var clearCacheTimer;

            //setInterval(function () { cache = {}; }, 10 * 1000);

            function scheduleClearCache() {
                clearTimeout(clearCacheTimer);
                clearCacheTimer = setInterval(function () { cache = {}; }, 1*1000);
            }

            function setCache(elems, overflowing) {
                for (var i = elems.length; i--;)
                    cache[uniqueID(elems[i])] = overflowing;
                return overflowing;
            }

            //  (body)                (root)
            //         | hidden | visible | scroll |  auto  |
            // hidden  |   no   |    no   |   YES  |   YES  |
            // visible |   no   |   YES   |   YES  |   YES  |
            // scroll  |   no   |   YES   |   YES  |   YES  |
            // auto    |   no   |   YES   |   YES  |   YES  |

            function overflowingAncestor(el) {
                var elems = [];
                var body = document.body;
                var rootScrollHeight = root.scrollHeight;
                do {
                    var cached = cache[uniqueID(el)];
                    if (cached) {
                        return setCache(elems, cached);
                    }
                    elems.push(el);
                    if (rootScrollHeight === el.scrollHeight) {
                        var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
                        var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
                        if (isFrame && isContentOverflowing(root) ||
                            !isFrame && isOverflowCSS) {
                            return setCache(elems, getScrollRoot());
                        }
                    } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
                        return setCache(elems, el);
                    }
                } while (el = el.parentElement);
            }

            function isContentOverflowing(el) {
                return (el.clientHeight + 10 < el.scrollHeight);
            }

            // typically for <body> and <html>
            function overflowNotHidden(el) {
                var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
                return (overflow !== 'hidden');
            }

            // for all other elements
            function overflowAutoOrScroll(el) {
                var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
                return (overflow === 'scroll' || overflow === 'auto');
            }


            /***********************************************
             * HELPERS
             ***********************************************/

            function addEvent(type, fn) {
                window.addEventListener(type, fn, false);
            }

            function removeEvent(type, fn) {
                window.removeEventListener(type, fn, false);
            }

            function isNodeName(el, tag) {
                return (el.nodeName||'').toLowerCase() === tag.toLowerCase();
            }

            function directionCheck(x, y) {
                x = (x > 0) ? 1 : -1;
                y = (y > 0) ? 1 : -1;
                if (direction.x !== x || direction.y !== y) {
                    direction.x = x;
                    direction.y = y;
                    que = [];
                    lastScroll = 0;
                }
            }

            var deltaBufferTimer;

            if (window.localStorage && localStorage.SS_deltaBuffer) {
                deltaBuffer = localStorage.SS_deltaBuffer.split(',');
            }

            function isTouchpad(deltaY) {
                if (!deltaY) return;
                if (!deltaBuffer.length) {
                    deltaBuffer = [deltaY, deltaY, deltaY];
                }
                deltaY = Math.abs(deltaY);
                deltaBuffer.push(deltaY);
                deltaBuffer.shift();
                clearTimeout(deltaBufferTimer);
                deltaBufferTimer = setTimeout(function () {
                    if (window.localStorage) {
                        localStorage.SS_deltaBuffer = deltaBuffer.join(',');
                    }
                }, 1000);
                return !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100);
            }

            function isDivisible(n, divisor) {
                return (Math.floor(n / divisor) == n / divisor);
            }

            function allDeltasDivisableBy(divisor) {
                return (isDivisible(deltaBuffer[0], divisor) &&
                isDivisible(deltaBuffer[1], divisor) &&
                isDivisible(deltaBuffer[2], divisor));
            }

            function isInsideYoutubeVideo(event) {
                var elem = event.target;
                var isControl = false;
                if (document.URL.indexOf ('www.youtube.com/watch') != -1) {
                    do {
                        isControl = (elem.classList &&
                        elem.classList.contains('html5-video-controls'));
                        if (isControl) break;
                    } while (elem = elem.parentNode);
                }
                return isControl;
            }

            var requestFrame = (function () {
                return (window.requestAnimationFrame       ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame    ||
                function (callback, element, delay) {
                    window.setTimeout(callback, delay || (1000/60));
                });
            })();

            var MutationObserver = (window.MutationObserver ||
            window.WebKitMutationObserver ||
            window.MozMutationObserver);

            var getScrollRoot = (function() {
                var SCROLL_ROOT;
                return function() {
                    if (!SCROLL_ROOT) {
                        var dummy = document.createElement('div');
                        dummy.style.cssText = 'height:10000px;width:1px;';
                        document.body.appendChild(dummy);
                        var bodyScrollTop  = document.body.scrollTop;
                        var docElScrollTop = document.documentElement.scrollTop;
                        window.scrollBy(0, 3);
                        if (document.body.scrollTop != bodyScrollTop)
                            (SCROLL_ROOT = document.body);
                        else
                            (SCROLL_ROOT = document.documentElement);
                        window.scrollBy(0, -3);
                        document.body.removeChild(dummy);
                    }
                    return SCROLL_ROOT;
                };
            })();


            /***********************************************
             * PULSE (by Michael Herf)
             ***********************************************/

            /**
             * Viscous fluid with a pulse for part and decay for the rest.
             * - Applies a fixed force over an interval (a damped acceleration), and
             * - Lets the exponential bleed away the velocity over a longer interval
             * - Michael Herf, http://stereopsis.com/stopping/
             */
            function pulse_(x) {
                var val, start, expx;
                // test
                x = x * options.pulseScale;
                if (x < 1) { // acceleartion
                    val = x - (1 - Math.exp(-x));
                } else {     // tail
                    // the previous animation ended here:
                    start = Math.exp(-1);
                    // simple viscous drag
                    x -= 1;
                    expx = 1 - Math.exp(-x);
                    val = start + (expx * (1 - start));
                }
                return val * options.pulseNormalize;
            }

            function pulse(x) {
                if (x >= 1) return 1;
                if (x <= 0) return 0;

                if (options.pulseNormalize == 1) {
                    options.pulseNormalize /= pulse_(1);
                }
                return pulse_(x);
            }


            /***********************************************
             * FIRST RUN
             ***********************************************/

            var userAgent = window.navigator.userAgent;
            var isEdge    = /Edge/.test(userAgent); // thank you MS
            var isChrome  = /chrome/i.test(userAgent) && !isEdge;
            var isSafari  = /safari/i.test(userAgent) && !isEdge;
            var isMobile  = /mobile/i.test(userAgent);
            var isIEWin7  = /Windows NT 6.1/i.test(userAgent) && /rv:11/i.test(userAgent);
            var isEnabledForBrowser = (isChrome || isSafari || isIEWin7) && !isMobile;

            var wheelEvent;
            if ('onwheel' in document.createElement('div'))
                wheelEvent = 'wheel';
            else if ('onmousewheel' in document.createElement('div'))
                wheelEvent = 'mousewheel';

            if (wheelEvent && isEnabledForBrowser) {
                addEvent(wheelEvent, wheel);
                addEvent('mousedown', mousedown);
                addEvent('load', init);
            }


            /***********************************************
             * PUBLIC INTERFACE
             ***********************************************/

            function SmoothScroll(optionsToSet) {
                for (var key in optionsToSet)
                    if (defaultOptions.hasOwnProperty(key))
                        options[key] = optionsToSet[key];
            }
            SmoothScroll.destroy = cleanup;

            if (window.SmoothScrollOptions) // async API
                SmoothScroll(window.SmoothScrollOptions);

            if (typeof define === 'function' && define.amd)
                define(function() {
                    return SmoothScroll;
                });
            else if ('object' == typeof exports)
                module.exports = SmoothScroll;
            else
                window.SmoothScroll = SmoothScroll;

        })();
    };

    UNCODE.twentytwenty = function() {

        if (!$('.twentytwenty-container').length) return;

        // jquery.event.move
        //
        // 1.3.6
        //
        // Stephen Band
        //
        // Triggers 'movestart', 'move' and 'moveend' events after
        // mousemoves following a mousedown cross a distance threshold,
        // similar to the native 'dragstart', 'drag' and 'dragend' events.
        // Move events are throttled to animation frames. Move event objects
        // have the properties:
        //
        // pageX:
        // pageY:   Page coordinates of pointer.
        // startX:
        // startY:  Page coordinates of pointer at movestart.
        // distX:
        // distY:  Distance the pointer has moved since movestart.
        // deltaX:
        // deltaY:  Distance the finger has moved since last event.
        // velocityX:
        // velocityY:  Average velocity over last few events.


        (function (module) {
            if (typeof define === 'function' && define.amd) {
                // AMD. Register as an anonymous module.
                define(['jquery'], module);
            } else {
                // Browser globals
                module(jQuery);
            }
        })(function(jQuery, undefined){

            var // Number of pixels a pressed pointer travels before movestart
                // event is fired.
                threshold = 6,

                add = jQuery.event.add,

                remove = jQuery.event.remove,

                // Just sugar, so we can have arguments in the same order as
                // add and remove.
                trigger = function(node, type, data) {
                    jQuery.event.trigger(type, data, node);
                },

                // Shim for requestAnimationFrame, falling back to timer. See:
                // see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
                requestFrame = (function(){
                    return (
                        window.requestAnimationFrame ||
                        window.webkitRequestAnimationFrame ||
                        window.mozRequestAnimationFrame ||
                        window.oRequestAnimationFrame ||
                        window.msRequestAnimationFrame ||
                        function(fn, element){
                            return window.setTimeout(function(){
                                fn();
                            }, 25);
                        }
                    );
                })(),

                ignoreTags = {
                    textarea: true,
                    input: true,
                    select: true,
                    button: true
                },

                mouseevents = {
                    move: 'mousemove',
                    cancel: 'mouseup dragstart',
                    end: 'mouseup'
                },

                touchevents = {
                    move: 'touchmove',
                    cancel: 'touchend',
                    end: 'touchend'
                };


            // Constructors

            function Timer(fn){
                var callback = fn,
                    active = false,
                    running = false;

                function trigger(time) {
                    if (active){
                        callback();
                        requestFrame(trigger);
                        running = true;
                        active = false;
                    }
                    else {
                        running = false;
                    }
                }

                this.kick = function(fn) {
                    active = true;
                    if (!running) { trigger(); }
                };

                this.end = function(fn) {
                    var cb = callback;

                    if (!fn) { return; }

                    // If the timer is not running, simply call the end callback.
                    if (!running) {
                        fn();
                    }
                    // If the timer is running, and has been kicked lately, then
                    // queue up the current callback and the end callback, otherwise
                    // just the end callback.
                    else {
                        callback = active ?
                            function(){ cb(); fn(); } :
                            fn ;

                        active = true;
                    }
                };
            }


            // Functions

            function returnTrue() {
                return true;
            }

            function returnFalse() {
                return false;
            }

            function preventDefault(e) {
                e.preventDefault();
            }

            function preventIgnoreTags(e) {
                // Don't prevent interaction with form elements.
                if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

                e.preventDefault();
            }

            function isLeftButton(e) {
                // Ignore mousedowns on any button other than the left (or primary)
                // mouse button, or when a modifier key is pressed.
                return (e.which === 1 && !e.ctrlKey && !e.altKey);
            }

            function identifiedTouch(touchList, id) {
                var i, l;

                if (touchList.identifiedTouch) {
                    return touchList.identifiedTouch(id);
                }

                // touchList.identifiedTouch() does not exist in
                // webkit yet… we must do the search ourselves...

                i = -1;
                l = touchList.length;

                while (++i < l) {
                    if (touchList[i].identifier === id) {
                        return touchList[i];
                    }
                }
            }

            function changedTouch(e, event) {
                var touch = identifiedTouch(e.changedTouches, event.identifier);

                // This isn't the touch you're looking for.
                if (!touch) { return; }

                // Chrome Android (at least) includes touches that have not
                // changed in e.changedTouches. That's a bit annoying. Check
                // that this touch has changed.
                if (touch.pageX === event.pageX && touch.pageY === event.pageY) { return; }

                return touch;
            }


            // Handlers that decide when the first movestart is triggered

            function mousedown(e){
                var data;

                if (!isLeftButton(e)) { return; }

                data = {
                    target: e.target,
                    startX: e.pageX,
                    startY: e.pageY,
                    timeStamp: e.timeStamp
                };

                add(document, mouseevents.move, mousemove, data);
                add(document, mouseevents.cancel, mouseend, data);
            }

            function mousemove(e){
                var data = e.data;

                checkThreshold(e, data, e, removeMouse);
            }

            function mouseend(e) {
                removeMouse();
            }

            function removeMouse() {
                remove(document, mouseevents.move, mousemove);
                remove(document, mouseevents.cancel, mouseend);
            }

            function touchstart(e) {
                var touch, template;

                // Don't get in the way of interaction with form elements.
                if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

                touch = e.changedTouches[0];

                // iOS live updates the touch objects whereas Android gives us copies.
                // That means we can't trust the touchstart object to stay the same,
                // so we must copy the data. This object acts as a template for
                // movestart, move and moveend event objects.
                template = {
                    target: touch.target,
                    startX: touch.pageX,
                    startY: touch.pageY,
                    timeStamp: e.timeStamp,
                    identifier: touch.identifier
                };

                // Use the touch identifier as a namespace, so that we can later
                // remove handlers pertaining only to this touch.
                add(document, touchevents.move + '.' + touch.identifier, touchmove, template);
                add(document, touchevents.cancel + '.' + touch.identifier, touchend, template);
            }

            function touchmove(e){
                var data = e.data,
                    touch = changedTouch(e, data);

                if (!touch) { return; }

                checkThreshold(e, data, touch, removeTouch);
            }

            function touchend(e) {
                var template = e.data,
                    touch = identifiedTouch(e.changedTouches, template.identifier);

                if (!touch) { return; }

                removeTouch(template.identifier);
            }

            function removeTouch(identifier) {
                remove(document, '.' + identifier, touchmove);
                remove(document, '.' + identifier, touchend);
            }


            // Logic for deciding when to trigger a movestart.

            function checkThreshold(e, template, touch, fn) {
                var distX = touch.pageX - template.startX,
                    distY = touch.pageY - template.startY;

                // Do nothing if the threshold has not been crossed.
                if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

                triggerStart(e, template, touch, distX, distY, fn);
            }

            function handled() {
                // this._handled should return false once, and after return true.
                this._handled = returnTrue;
                return false;
            }

            function flagAsHandled(e) {
                e._handled();
            }

            function triggerStart(e, template, touch, distX, distY, fn) {
                var node = template.target,
                    touches, time;

                touches = e.targetTouches;
                time = e.timeStamp - template.timeStamp;

                // Create a movestart object with some special properties that
                // are passed only to the movestart handlers.
                template.type = 'movestart';
                template.distX = distX;
                template.distY = distY;
                template.deltaX = distX;
                template.deltaY = distY;
                template.pageX = touch.pageX;
                template.pageY = touch.pageY;
                template.velocityX = distX / time;
                template.velocityY = distY / time;
                template.targetTouches = touches;
                template.finger = touches ?
                    touches.length :
                    1 ;

                // The _handled method is fired to tell the default movestart
                // handler that one of the move events is bound.
                template._handled = handled;

                // Pass the touchmove event so it can be prevented if or when
                // movestart is handled.
                template._preventTouchmoveDefault = function() {
                    e.preventDefault();
                };

                // Trigger the movestart event.
                trigger(template.target, template);

                // Unbind handlers that tracked the touch or mouse up till now.
                fn(template.identifier);
            }


            // Handlers that control what happens following a movestart

            function activeMousemove(e) {
                var timer = e.data.timer;

                e.data.touch = e;
                e.data.timeStamp = e.timeStamp;
                timer.kick();
            }

            function activeMouseend(e) {
                var event = e.data.event,
                    timer = e.data.timer;

                removeActiveMouse();

                endEvent(event, timer, function() {
                    // Unbind the click suppressor, waiting until after mouseup
                    // has been handled.
                    setTimeout(function(){
                        remove(event.target, 'click', returnFalse);
                    }, 0);
                });
            }

            function removeActiveMouse(event) {
                remove(document, mouseevents.move, activeMousemove);
                remove(document, mouseevents.end, activeMouseend);
            }

            function activeTouchmove(e) {
                var event = e.data.event,
                    timer = e.data.timer,
                    touch = changedTouch(e, event);

                if (!touch) { return; }

                // Stop the interface from gesturing
                e.preventDefault();

                event.targetTouches = e.targetTouches;
                e.data.touch = touch;
                e.data.timeStamp = e.timeStamp;
                timer.kick();
            }

            function activeTouchend(e) {
                var event = e.data.event,
                    timer = e.data.timer,
                    touch = identifiedTouch(e.changedTouches, event.identifier);

                // This isn't the touch you're looking for.
                if (!touch) { return; }

                removeActiveTouch(event);
                endEvent(event, timer);
            }

            function removeActiveTouch(event) {
                remove(document, '.' + event.identifier, activeTouchmove);
                remove(document, '.' + event.identifier, activeTouchend);
            }


            // Logic for triggering move and moveend events

            function updateEvent(event, touch, timeStamp, timer) {
                var time = timeStamp - event.timeStamp;

                event.type = 'move';
                event.distX =  touch.pageX - event.startX;
                event.distY =  touch.pageY - event.startY;
                event.deltaX = touch.pageX - event.pageX;
                event.deltaY = touch.pageY - event.pageY;

                // Average the velocity of the last few events using a decay
                // curve to even out spurious jumps in values.
                event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
                event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
                event.pageX =  touch.pageX;
                event.pageY =  touch.pageY;
            }

            function endEvent(event, timer, fn) {
                timer.end(function(){
                    event.type = 'moveend';

                    trigger(event.target, event);

                    return fn && fn();
                });
            }


            // jQuery special event definition

            function setup(data, namespaces, eventHandle) {
                // Stop the node from being dragged
                //add(this, 'dragstart.move drag.move', preventDefault);

                // Prevent text selection and touch interface scrolling
                //add(this, 'mousedown.move', preventIgnoreTags);

                // Tell movestart default handler that we've handled this
                add(this, 'movestart.move', flagAsHandled);

                // Don't bind to the DOM. For speed.
                return true;
            }

            function teardown(namespaces) {
                remove(this, 'dragstart drag', preventDefault);
                remove(this, 'mousedown touchstart', preventIgnoreTags);
                remove(this, 'movestart', flagAsHandled);

                // Don't bind to the DOM. For speed.
                return true;
            }

            function addMethod(handleObj) {
                // We're not interested in preventing defaults for handlers that
                // come from internal move or moveend bindings
                if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
                    return;
                }

                // Stop the node from being dragged
                add(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid, preventDefault, undefined, handleObj.selector);

                // Prevent text selection and touch interface scrolling
                add(this, 'mousedown.' + handleObj.guid, preventIgnoreTags, undefined, handleObj.selector);
            }

            function removeMethod(handleObj) {
                if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
                    return;
                }

                remove(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid);
                remove(this, 'mousedown.' + handleObj.guid);
            }

            jQuery.event.special.movestart = {
                setup: setup,
                teardown: teardown,
                add: addMethod,
                remove: removeMethod,

                _default: function(e) {
                    var event, data;

                    // If no move events were bound to any ancestors of this
                    // target, high tail it out of here.
                    if (!e._handled()) { return; }

                    function update(time) {
                        updateEvent(event, data.touch, data.timeStamp);
                        trigger(e.target, event);
                    }

                    event = {
                        target: e.target,
                        startX: e.startX,
                        startY: e.startY,
                        pageX: e.pageX,
                        pageY: e.pageY,
                        distX: e.distX,
                        distY: e.distY,
                        deltaX: e.deltaX,
                        deltaY: e.deltaY,
                        velocityX: e.velocityX,
                        velocityY: e.velocityY,
                        timeStamp: e.timeStamp,
                        identifier: e.identifier,
                        targetTouches: e.targetTouches,
                        finger: e.finger
                    };

                    data = {
                        event: event,
                        timer: new Timer(update),
                        touch: undefined,
                        timeStamp: undefined
                    };

                    if (e.identifier === undefined) {
                        // We're dealing with a mouse
                        // Stop clicks from propagating during a move
                        add(e.target, 'click', returnFalse);
                        add(document, mouseevents.move, activeMousemove, data);
                        add(document, mouseevents.end, activeMouseend, data);
                    }
                    else {
                        // We're dealing with a touch. Stop touchmove doing
                        // anything defaulty.
                        e._preventTouchmoveDefault();
                        add(document, touchevents.move + '.' + e.identifier, activeTouchmove, data);
                        add(document, touchevents.end + '.' + e.identifier, activeTouchend, data);
                    }
                }
            };

            jQuery.event.special.move = {
                setup: function() {
                    // Bind a noop to movestart. Why? It's the movestart
                    // setup that decides whether other move events are fired.
                    add(this, 'movestart.move', jQuery.noop);
                },

                teardown: function() {
                    remove(this, 'movestart.move', jQuery.noop);
                }
            };

            jQuery.event.special.moveend = {
                setup: function() {
                    // Bind a noop to movestart. Why? It's the movestart
                    // setup that decides whether other move events are fired.
                    add(this, 'movestart.moveend', jQuery.noop);
                },

                teardown: function() {
                    remove(this, 'movestart.moveend', jQuery.noop);
                }
            };

            add(document, 'mousedown.move', mousedown);
            add(document, 'touchstart.move', touchstart);

            // Make jQuery copy touch event properties over to the jQuery event
            // object, if they are not already listed. But only do the ones we
            // really need. IE7/8 do not have Array#indexOf(), but nor do they
            // have touch events, so let's assume we can ignore them.
            if (typeof Array.prototype.indexOf === 'function') {
                (function(jQuery, undefined){
                    var props = ["changedTouches", "targetTouches"],
                        l = props.length;

                    while (l--) {
                        if (jQuery.event.props.indexOf(props[l]) === -1) {
                            jQuery.event.props.push(props[l]);
                        }
                    }
                })(jQuery);
            };
        });

        $.fn.twentytwenty = function(options) {
            var options = $.extend({default_offset_pct: 0.5, orientation: 'horizontal'}, options);
            return this.each(function() {

                var sliderPct = options.default_offset_pct;
                var container = $(this);
                var sliderOrientation = options.orientation;
                var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
                var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';

                container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
                container.append("<div class='twentytwenty-overlay'></div>");
                var beforeImg = container.find("img:first");
                var afterImg = container.find("img:last");
                container.append("<div class='twentytwenty-handle style-accent-bg border-accent-color'></div>");
                var slider = container.find(".twentytwenty-handle");
                slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
                slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
                container.addClass("twentytwenty-container");
                beforeImg.addClass("twentytwenty-before");
                afterImg.addClass("twentytwenty-after");

                var overlay = container.find(".twentytwenty-overlay");
                overlay.append("<div class='twentytwenty-before-label'></div>");
                overlay.append("<div class='twentytwenty-after-label'></div>");

                var calcOffset = function(dimensionPct) {
                    var w = beforeImg.width();
                    var h = beforeImg.height();
                    return {
                        w: w+"px",
                        h: h+"px",
                        cw: (dimensionPct*w)+"px",
                        ch: (dimensionPct*h)+"px"
                    };
                };

                var adjustContainer = function(offset) {
                    if (sliderOrientation === 'vertical') {
                        beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
                    }
                    else {
                        beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
                    }
                    container.css("height", offset.h);
                };

                var adjustSlider = function(pct) {
                    var offset = calcOffset(pct);
                    slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
                    adjustContainer(offset);
                }

                $(window).on("resize.twentytwenty", function(e) {
                    adjustSlider(sliderPct);
                });

                var offsetX = 0,
                    offsetY = 0,
                    imgWidth = 0,
                    imgHeight = 0;

                slider.on("movestart", function(e) {
                    if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
                        e.preventDefault();
                    }
                    else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
                        e.preventDefault();
                    }
                    container.addClass("active");
                    offsetX = container.offset().left;
                    offsetY = container.offset().top;
                    imgWidth = beforeImg.width();
                    imgHeight = beforeImg.height();
                });

                slider.on("moveend", function(e) {
                    container.removeClass("active");
                });

                slider.on("move", function(e) {
                    if (container.hasClass("active")) {
                        sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
                        if (sliderPct < 0) {
                            sliderPct = 0;
                        }
                        if (sliderPct > 1) {
                            sliderPct = 1;
                        }
                        adjustSlider(sliderPct);
                    }
                });

                container.find("img").on("mousedown", function(event) {
                    event.preventDefault();
                });

                $(window).trigger("resize.twentytwenty");
            });
        };

        $('.twentytwenty-container').twentytwenty();

    }

    UNCODE.init = function() {
        UNCODE.utils();
        UNCODE.menuSystem();
        UNCODE.okvideo();
        UNCODE.tapHover();
        UNCODE.isotopeLayout();
        UNCODE.lightbox();
        UNCODE.backVideo();
        UNCODE.carousel($('body'));
        UNCODE.animations();
        UNCODE.stickyElements();
        UNCODE.twentytwenty();
        UNCODE.disableHoverScroll();
        UNCODE.onePage(UNCODE.isMobile);
        if ($('body.smooth-scroller').length) {
            setTimeout(function(){
                UNCODE.scrollEnance();
            }, 300);
        }
    }
    UNCODE.init();
})(jQuery);

/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.9.0
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/slick
    Repo: http://github.com/kenwheeler/slick
  Issues: http://github.com/kenwheeler/slick/issues

 */
(function(i){"use strict";"function"==typeof define&&define.amd?define(["jquery"],i):"undefined"!=typeof exports?module.exports=i(require("jquery")):i(jQuery)})(function(i){"use strict";var e=window.Slick||{};e=function(){function e(e,o){var s,n=this;n.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:i(e),appendDots:i(e),arrows:!0,asNavFor:null,prevArrow:'<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',nextArrow:'<button class="slick-next" aria-label="Next" type="button">Next</button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(e,t){return i('<button type="button" />').text(t+1)},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",edgeFriction:.35,fade:!1,focusOnSelect:!1,focusOnChange:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",mobileFirst:!1,pauseOnHover:!0,pauseOnFocus:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rows:1,rtl:!1,slide:"",slidesPerRow:1,slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,useTransform:!0,variableWidth:!1,vertical:!1,verticalSwiping:!1,waitForAnimate:!0,zIndex:1e3},n.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,scrolling:!1,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,swiping:!1,$list:null,touchObject:{},transformsEnabled:!1,unslicked:!1},i.extend(n,n.initials),n.activeBreakpoint=null,n.animType=null,n.animProp=null,n.breakpoints=[],n.breakpointSettings=[],n.cssTransitions=!1,n.focussed=!1,n.interrupted=!1,n.hidden="hidden",n.paused=!0,n.positionProp=null,n.respondTo=null,n.rowCount=1,n.shouldClick=!0,n.$slider=i(e),n.$slidesCache=null,n.transformType=null,n.transitionType=null,n.visibilityChange="visibilitychange",n.windowWidth=0,n.windowTimer=null,s=i(e).data("slick")||{},n.options=i.extend({},n.defaults,o,s),n.currentSlide=n.options.initialSlide,n.originalSettings=n.options,"undefined"!=typeof document.mozHidden?(n.hidden="mozHidden",n.visibilityChange="mozvisibilitychange"):"undefined"!=typeof document.webkitHidden&&(n.hidden="webkitHidden",n.visibilityChange="webkitvisibilitychange"),n.autoPlay=i.proxy(n.autoPlay,n),n.autoPlayClear=i.proxy(n.autoPlayClear,n),n.autoPlayIterator=i.proxy(n.autoPlayIterator,n),n.changeSlide=i.proxy(n.changeSlide,n),n.clickHandler=i.proxy(n.clickHandler,n),n.selectHandler=i.proxy(n.selectHandler,n),n.setPosition=i.proxy(n.setPosition,n),n.swipeHandler=i.proxy(n.swipeHandler,n),n.dragHandler=i.proxy(n.dragHandler,n),n.keyHandler=i.proxy(n.keyHandler,n),n.instanceUid=t++,n.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,n.registerBreakpoints(),n.init(!0)}var t=0;return e}(),e.prototype.activateADA=function(){var i=this;i.$slideTrack.find(".slick-active").attr({"aria-hidden":"false"}).find("a, input, button, select").attr({tabindex:"0"})},e.prototype.addSlide=e.prototype.slickAdd=function(e,t,o){var s=this;if("boolean"==typeof t)o=t,t=null;else if(t<0||t>=s.slideCount)return!1;s.unload(),"number"==typeof t?0===t&&0===s.$slides.length?i(e).appendTo(s.$slideTrack):o?i(e).insertBefore(s.$slides.eq(t)):i(e).insertAfter(s.$slides.eq(t)):o===!0?i(e).prependTo(s.$slideTrack):i(e).appendTo(s.$slideTrack),s.$slides=s.$slideTrack.children(this.options.slide),s.$slideTrack.children(this.options.slide).detach(),s.$slideTrack.append(s.$slides),s.$slides.each(function(e,t){i(t).attr("data-slick-index",e)}),s.$slidesCache=s.$slides,s.reinit()},e.prototype.animateHeight=function(){var i=this;if(1===i.options.slidesToShow&&i.options.adaptiveHeight===!0&&i.options.vertical===!1){var e=i.$slides.eq(i.currentSlide).outerHeight(!0);i.$list.animate({height:e},i.options.speed)}},e.prototype.animateSlide=function(e,t){var o={},s=this;s.animateHeight(),s.options.rtl===!0&&s.options.vertical===!1&&(e=-e),s.transformsEnabled===!1?s.options.vertical===!1?s.$slideTrack.animate({left:e},s.options.speed,s.options.easing,t):s.$slideTrack.animate({top:e},s.options.speed,s.options.easing,t):s.cssTransitions===!1?(s.options.rtl===!0&&(s.currentLeft=-s.currentLeft),i({animStart:s.currentLeft}).animate({animStart:e},{duration:s.options.speed,easing:s.options.easing,step:function(i){i=Math.ceil(i),s.options.vertical===!1?(o[s.animType]="translate("+i+"px, 0px)",s.$slideTrack.css(o)):(o[s.animType]="translate(0px,"+i+"px)",s.$slideTrack.css(o))},complete:function(){t&&t.call()}})):(s.applyTransition(),e=Math.ceil(e),s.options.vertical===!1?o[s.animType]="translate3d("+e+"px, 0px, 0px)":o[s.animType]="translate3d(0px,"+e+"px, 0px)",s.$slideTrack.css(o),t&&setTimeout(function(){s.disableTransition(),t.call()},s.options.speed))},e.prototype.getNavTarget=function(){var e=this,t=e.options.asNavFor;return t&&null!==t&&(t=i(t).not(e.$slider)),t},e.prototype.asNavFor=function(e){var t=this,o=t.getNavTarget();null!==o&&"object"==typeof o&&o.each(function(){var t=i(this).slick("getSlick");t.unslicked||t.slideHandler(e,!0)})},e.prototype.applyTransition=function(i){var e=this,t={};e.options.fade===!1?t[e.transitionType]=e.transformType+" "+e.options.speed+"ms "+e.options.cssEase:t[e.transitionType]="opacity "+e.options.speed+"ms "+e.options.cssEase,e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},e.prototype.autoPlay=function(){var i=this;i.autoPlayClear(),i.slideCount>i.options.slidesToShow&&(i.autoPlayTimer=setInterval(i.autoPlayIterator,i.options.autoplaySpeed))},e.prototype.autoPlayClear=function(){var i=this;i.autoPlayTimer&&clearInterval(i.autoPlayTimer)},e.prototype.autoPlayIterator=function(){var i=this,e=i.currentSlide+i.options.slidesToScroll;i.paused||i.interrupted||i.focussed||(i.options.infinite===!1&&(1===i.direction&&i.currentSlide+1===i.slideCount-1?i.direction=0:0===i.direction&&(e=i.currentSlide-i.options.slidesToScroll,i.currentSlide-1===0&&(i.direction=1))),i.slideHandler(e))},e.prototype.buildArrows=function(){var e=this;e.options.arrows===!0&&(e.$prevArrow=i(e.options.prevArrow).addClass("slick-arrow"),e.$nextArrow=i(e.options.nextArrow).addClass("slick-arrow"),e.slideCount>e.options.slidesToShow?(e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"),e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.prependTo(e.options.appendArrows),e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.appendTo(e.options.appendArrows),e.options.infinite!==!0&&e.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true")):e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({"aria-disabled":"true",tabindex:"-1"}))},e.prototype.buildDots=function(){var e,t,o=this;if(o.options.dots===!0&&o.slideCount>o.options.slidesToShow){for(o.$slider.addClass("slick-dotted"),t=i("<ul />").addClass(o.options.dotsClass),e=0;e<=o.getDotCount();e+=1)t.append(i("<li />").append(o.options.customPaging.call(this,o,e)));o.$dots=t.appendTo(o.options.appendDots),o.$dots.find("li").first().addClass("slick-active")}},e.prototype.buildOut=function(){var e=this;e.$slides=e.$slider.children(e.options.slide+":not(.slick-cloned)").addClass("slick-slide"),e.slideCount=e.$slides.length,e.$slides.each(function(e,t){i(t).attr("data-slick-index",e).data("originalStyling",i(t).attr("style")||"")}),e.$slider.addClass("slick-slider"),e.$slideTrack=0===e.slideCount?i('<div class="slick-track"/>').appendTo(e.$slider):e.$slides.wrapAll('<div class="slick-track"/>').parent(),e.$list=e.$slideTrack.wrap('<div class="slick-list"/>').parent(),e.$slideTrack.css("opacity",0),e.options.centerMode!==!0&&e.options.swipeToSlide!==!0||(e.options.slidesToScroll=1),i("img[data-lazy]",e.$slider).not("[src]").addClass("slick-loading"),e.setupInfinite(),e.buildArrows(),e.buildDots(),e.updateDots(),e.setSlideClasses("number"==typeof e.currentSlide?e.currentSlide:0),e.options.draggable===!0&&e.$list.addClass("draggable")},e.prototype.buildRows=function(){var i,e,t,o,s,n,r,l=this;if(o=document.createDocumentFragment(),n=l.$slider.children(),l.options.rows>0){for(r=l.options.slidesPerRow*l.options.rows,s=Math.ceil(n.length/r),i=0;i<s;i++){var d=document.createElement("div");for(e=0;e<l.options.rows;e++){var a=document.createElement("div");for(t=0;t<l.options.slidesPerRow;t++){var c=i*r+(e*l.options.slidesPerRow+t);n.get(c)&&a.appendChild(n.get(c))}d.appendChild(a)}o.appendChild(d)}l.$slider.empty().append(o),l.$slider.children().children().children().css({width:100/l.options.slidesPerRow+"%",display:"inline-block"})}},e.prototype.checkResponsive=function(e,t){var o,s,n,r=this,l=!1,d=r.$slider.width(),a=window.innerWidth||i(window).width();if("window"===r.respondTo?n=a:"slider"===r.respondTo?n=d:"min"===r.respondTo&&(n=Math.min(a,d)),r.options.responsive&&r.options.responsive.length&&null!==r.options.responsive){s=null;for(o in r.breakpoints)r.breakpoints.hasOwnProperty(o)&&(r.originalSettings.mobileFirst===!1?n<r.breakpoints[o]&&(s=r.breakpoints[o]):n>r.breakpoints[o]&&(s=r.breakpoints[o]));null!==s?null!==r.activeBreakpoint?(s!==r.activeBreakpoint||t)&&(r.activeBreakpoint=s,"unslick"===r.breakpointSettings[s]?r.unslick(s):(r.options=i.extend({},r.originalSettings,r.breakpointSettings[s]),e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),l=s):(r.activeBreakpoint=s,"unslick"===r.breakpointSettings[s]?r.unslick(s):(r.options=i.extend({},r.originalSettings,r.breakpointSettings[s]),e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e)),l=s):null!==r.activeBreakpoint&&(r.activeBreakpoint=null,r.options=r.originalSettings,e===!0&&(r.currentSlide=r.options.initialSlide),r.refresh(e),l=s),e||l===!1||r.$slider.trigger("breakpoint",[r,l])}},e.prototype.changeSlide=function(e,t){var o,s,n,r=this,l=i(e.currentTarget);switch(l.is("a")&&e.preventDefault(),l.is("li")||(l=l.closest("li")),n=r.slideCount%r.options.slidesToScroll!==0,o=n?0:(r.slideCount-r.currentSlide)%r.options.slidesToScroll,e.data.message){case"previous":s=0===o?r.options.slidesToScroll:r.options.slidesToShow-o,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide-s,!1,t);break;case"next":s=0===o?r.options.slidesToScroll:o,r.slideCount>r.options.slidesToShow&&r.slideHandler(r.currentSlide+s,!1,t);break;case"index":var d=0===e.data.index?0:e.data.index||l.index()*r.options.slidesToScroll;r.slideHandler(r.checkNavigable(d),!1,t),l.children().trigger("focus");break;default:return}},e.prototype.checkNavigable=function(i){var e,t,o=this;if(e=o.getNavigableIndexes(),t=0,i>e[e.length-1])i=e[e.length-1];else for(var s in e){if(i<e[s]){i=t;break}t=e[s]}return i},e.prototype.cleanUpEvents=function(){var e=this;e.options.dots&&null!==e.$dots&&(i("li",e.$dots).off("click.slick",e.changeSlide).off("mouseenter.slick",i.proxy(e.interrupt,e,!0)).off("mouseleave.slick",i.proxy(e.interrupt,e,!1)),e.options.accessibility===!0&&e.$dots.off("keydown.slick",e.keyHandler)),e.$slider.off("focus.slick blur.slick"),e.options.arrows===!0&&e.slideCount>e.options.slidesToShow&&(e.$prevArrow&&e.$prevArrow.off("click.slick",e.changeSlide),e.$nextArrow&&e.$nextArrow.off("click.slick",e.changeSlide),e.options.accessibility===!0&&(e.$prevArrow&&e.$prevArrow.off("keydown.slick",e.keyHandler),e.$nextArrow&&e.$nextArrow.off("keydown.slick",e.keyHandler))),e.$list.off("touchstart.slick mousedown.slick",e.swipeHandler),e.$list.off("touchmove.slick mousemove.slick",e.swipeHandler),e.$list.off("touchend.slick mouseup.slick",e.swipeHandler),e.$list.off("touchcancel.slick mouseleave.slick",e.swipeHandler),e.$list.off("click.slick",e.clickHandler),i(document).off(e.visibilityChange,e.visibility),e.cleanUpSlideEvents(),e.options.accessibility===!0&&e.$list.off("keydown.slick",e.keyHandler),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().off("click.slick",e.selectHandler),i(window).off("orientationchange.slick.slick-"+e.instanceUid,e.orientationChange),i(window).off("resize.slick.slick-"+e.instanceUid,e.resize),i("[draggable!=true]",e.$slideTrack).off("dragstart",e.preventDefault),i(window).off("load.slick.slick-"+e.instanceUid,e.setPosition)},e.prototype.cleanUpSlideEvents=function(){var e=this;e.$list.off("mouseenter.slick",i.proxy(e.interrupt,e,!0)),e.$list.off("mouseleave.slick",i.proxy(e.interrupt,e,!1))},e.prototype.cleanUpRows=function(){var i,e=this;e.options.rows>0&&(i=e.$slides.children().children(),i.removeAttr("style"),e.$slider.empty().append(i))},e.prototype.clickHandler=function(i){var e=this;e.shouldClick===!1&&(i.stopImmediatePropagation(),i.stopPropagation(),i.preventDefault())},e.prototype.destroy=function(e){var t=this;t.autoPlayClear(),t.touchObject={},t.cleanUpEvents(),i(".slick-cloned",t.$slider).detach(),t.$dots&&t.$dots.remove(),t.$prevArrow&&t.$prevArrow.length&&(t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.prevArrow)&&t.$prevArrow.remove()),t.$nextArrow&&t.$nextArrow.length&&(t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display",""),t.htmlExpr.test(t.options.nextArrow)&&t.$nextArrow.remove()),t.$slides&&(t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function(){i(this).attr("style",i(this).data("originalStyling"))}),t.$slideTrack.children(this.options.slide).detach(),t.$slideTrack.detach(),t.$list.detach(),t.$slider.append(t.$slides)),t.cleanUpRows(),t.$slider.removeClass("slick-slider"),t.$slider.removeClass("slick-initialized"),t.$slider.removeClass("slick-dotted"),t.unslicked=!0,e||t.$slider.trigger("destroy",[t])},e.prototype.disableTransition=function(i){var e=this,t={};t[e.transitionType]="",e.options.fade===!1?e.$slideTrack.css(t):e.$slides.eq(i).css(t)},e.prototype.fadeSlide=function(i,e){var t=this;t.cssTransitions===!1?(t.$slides.eq(i).css({zIndex:t.options.zIndex}),t.$slides.eq(i).animate({opacity:1},t.options.speed,t.options.easing,e)):(t.applyTransition(i),t.$slides.eq(i).css({opacity:1,zIndex:t.options.zIndex}),e&&setTimeout(function(){t.disableTransition(i),e.call()},t.options.speed))},e.prototype.fadeSlideOut=function(i){var e=this;e.cssTransitions===!1?e.$slides.eq(i).animate({opacity:0,zIndex:e.options.zIndex-2},e.options.speed,e.options.easing):(e.applyTransition(i),e.$slides.eq(i).css({opacity:0,zIndex:e.options.zIndex-2}))},e.prototype.filterSlides=e.prototype.slickFilter=function(i){var e=this;null!==i&&(e.$slidesCache=e.$slides,e.unload(),e.$slideTrack.children(this.options.slide).detach(),e.$slidesCache.filter(i).appendTo(e.$slideTrack),e.reinit())},e.prototype.focusHandler=function(){var e=this;e.$slider.off("focus.slick blur.slick").on("focus.slick","*",function(t){var o=i(this);setTimeout(function(){e.options.pauseOnFocus&&o.is(":focus")&&(e.focussed=!0,e.autoPlay())},0)}).on("blur.slick","*",function(t){i(this);e.options.pauseOnFocus&&(e.focussed=!1,e.autoPlay())})},e.prototype.getCurrent=e.prototype.slickCurrentSlide=function(){var i=this;return i.currentSlide},e.prototype.getDotCount=function(){var i=this,e=0,t=0,o=0;if(i.options.infinite===!0)if(i.slideCount<=i.options.slidesToShow)++o;else for(;e<i.slideCount;)++o,e=t+i.options.slidesToScroll,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;else if(i.options.centerMode===!0)o=i.slideCount;else if(i.options.asNavFor)for(;e<i.slideCount;)++o,e=t+i.options.slidesToScroll,t+=i.options.slidesToScroll<=i.options.slidesToShow?i.options.slidesToScroll:i.options.slidesToShow;else o=1+Math.ceil((i.slideCount-i.options.slidesToShow)/i.options.slidesToScroll);return o-1},e.prototype.getLeft=function(i){var e,t,o,s,n=this,r=0;return n.slideOffset=0,t=n.$slides.first().outerHeight(!0),n.options.infinite===!0?(n.slideCount>n.options.slidesToShow&&(n.slideOffset=n.slideWidth*n.options.slidesToShow*-1,s=-1,n.options.vertical===!0&&n.options.centerMode===!0&&(2===n.options.slidesToShow?s=-1.5:1===n.options.slidesToShow&&(s=-2)),r=t*n.options.slidesToShow*s),n.slideCount%n.options.slidesToScroll!==0&&i+n.options.slidesToScroll>n.slideCount&&n.slideCount>n.options.slidesToShow&&(i>n.slideCount?(n.slideOffset=(n.options.slidesToShow-(i-n.slideCount))*n.slideWidth*-1,r=(n.options.slidesToShow-(i-n.slideCount))*t*-1):(n.slideOffset=n.slideCount%n.options.slidesToScroll*n.slideWidth*-1,r=n.slideCount%n.options.slidesToScroll*t*-1))):i+n.options.slidesToShow>n.slideCount&&(n.slideOffset=(i+n.options.slidesToShow-n.slideCount)*n.slideWidth,r=(i+n.options.slidesToShow-n.slideCount)*t),n.slideCount<=n.options.slidesToShow&&(n.slideOffset=0,r=0),n.options.centerMode===!0&&n.slideCount<=n.options.slidesToShow?n.slideOffset=n.slideWidth*Math.floor(n.options.slidesToShow)/2-n.slideWidth*n.slideCount/2:n.options.centerMode===!0&&n.options.infinite===!0?n.slideOffset+=n.slideWidth*Math.floor(n.options.slidesToShow/2)-n.slideWidth:n.options.centerMode===!0&&(n.slideOffset=0,n.slideOffset+=n.slideWidth*Math.floor(n.options.slidesToShow/2)),e=n.options.vertical===!1?i*n.slideWidth*-1+n.slideOffset:i*t*-1+r,n.options.variableWidth===!0&&(o=n.slideCount<=n.options.slidesToShow||n.options.infinite===!1?n.$slideTrack.children(".slick-slide").eq(i):n.$slideTrack.children(".slick-slide").eq(i+n.options.slidesToShow),e=n.options.rtl===!0?o[0]?(n.$slideTrack.width()-o[0].offsetLeft-o.width())*-1:0:o[0]?o[0].offsetLeft*-1:0,n.options.centerMode===!0&&(o=n.slideCount<=n.options.slidesToShow||n.options.infinite===!1?n.$slideTrack.children(".slick-slide").eq(i):n.$slideTrack.children(".slick-slide").eq(i+n.options.slidesToShow+1),e=n.options.rtl===!0?o[0]?(n.$slideTrack.width()-o[0].offsetLeft-o.width())*-1:0:o[0]?o[0].offsetLeft*-1:0,e+=(n.$list.width()-o.outerWidth())/2)),e},e.prototype.getOption=e.prototype.slickGetOption=function(i){var e=this;return e.options[i]},e.prototype.getNavigableIndexes=function(){var i,e=this,t=0,o=0,s=[];for(e.options.infinite===!1?i=e.slideCount:(t=e.options.slidesToScroll*-1,o=e.options.slidesToScroll*-1,i=2*e.slideCount);t<i;)s.push(t),t=o+e.options.slidesToScroll,o+=e.options.slidesToScroll<=e.options.slidesToShow?e.options.slidesToScroll:e.options.slidesToShow;return s},e.prototype.getSlick=function(){return this},e.prototype.getSlideCount=function(){var e,t,o,s,n=this;return s=n.options.centerMode===!0?Math.floor(n.$list.width()/2):0,o=n.swipeLeft*-1+s,n.options.swipeToSlide===!0?(n.$slideTrack.find(".slick-slide").each(function(e,s){var r,l,d;if(r=i(s).outerWidth(),l=s.offsetLeft,n.options.centerMode!==!0&&(l+=r/2),d=l+r,o<d)return t=s,!1}),e=Math.abs(i(t).attr("data-slick-index")-n.currentSlide)||1):n.options.slidesToScroll},e.prototype.goTo=e.prototype.slickGoTo=function(i,e){var t=this;t.changeSlide({data:{message:"index",index:parseInt(i)}},e)},e.prototype.init=function(e){var t=this;i(t.$slider).hasClass("slick-initialized")||(i(t.$slider).addClass("slick-initialized"),t.buildRows(),t.buildOut(),t.setProps(),t.startLoad(),t.loadSlider(),t.initializeEvents(),t.updateArrows(),t.updateDots(),t.checkResponsive(!0),t.focusHandler()),e&&t.$slider.trigger("init",[t]),t.options.accessibility===!0&&t.initADA(),t.options.autoplay&&(t.paused=!1,t.autoPlay())},e.prototype.initADA=function(){var e=this,t=Math.ceil(e.slideCount/e.options.slidesToShow),o=e.getNavigableIndexes().filter(function(i){return i>=0&&i<e.slideCount});e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({"aria-hidden":"true",tabindex:"-1"}).find("a, input, button, select").attr({tabindex:"-1"}),null!==e.$dots&&(e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function(t){var s=o.indexOf(t);if(i(this).attr({role:"tabpanel",id:"slick-slide"+e.instanceUid+t,tabindex:-1}),s!==-1){var n="slick-slide-control"+e.instanceUid+s;i("#"+n).length&&i(this).attr({"aria-describedby":n})}}),e.$dots.attr("role","tablist").find("li").each(function(s){var n=o[s];i(this).attr({role:"presentation"}),i(this).find("button").first().attr({role:"tab",id:"slick-slide-control"+e.instanceUid+s,"aria-controls":"slick-slide"+e.instanceUid+n,"aria-label":s+1+" of "+t,"aria-selected":null,tabindex:"-1"})}).eq(e.currentSlide).find("button").attr({"aria-selected":"true",tabindex:"0"}).end());for(var s=e.currentSlide,n=s+e.options.slidesToShow;s<n;s++)e.options.focusOnChange?e.$slides.eq(s).attr({tabindex:"0"}):e.$slides.eq(s).removeAttr("tabindex");e.activateADA()},e.prototype.initArrowEvents=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.off("click.slick").on("click.slick",{message:"previous"},i.changeSlide),i.$nextArrow.off("click.slick").on("click.slick",{message:"next"},i.changeSlide),i.options.accessibility===!0&&(i.$prevArrow.on("keydown.slick",i.keyHandler),i.$nextArrow.on("keydown.slick",i.keyHandler)))},e.prototype.initDotEvents=function(){var e=this;e.options.dots===!0&&e.slideCount>e.options.slidesToShow&&(i("li",e.$dots).on("click.slick",{message:"index"},e.changeSlide),e.options.accessibility===!0&&e.$dots.on("keydown.slick",e.keyHandler)),e.options.dots===!0&&e.options.pauseOnDotsHover===!0&&e.slideCount>e.options.slidesToShow&&i("li",e.$dots).on("mouseenter.slick",i.proxy(e.interrupt,e,!0)).on("mouseleave.slick",i.proxy(e.interrupt,e,!1))},e.prototype.initSlideEvents=function(){var e=this;e.options.pauseOnHover&&(e.$list.on("mouseenter.slick",i.proxy(e.interrupt,e,!0)),e.$list.on("mouseleave.slick",i.proxy(e.interrupt,e,!1)))},e.prototype.initializeEvents=function(){var e=this;e.initArrowEvents(),e.initDotEvents(),e.initSlideEvents(),e.$list.on("touchstart.slick mousedown.slick",{action:"start"},e.swipeHandler),e.$list.on("touchmove.slick mousemove.slick",{action:"move"},e.swipeHandler),e.$list.on("touchend.slick mouseup.slick",{action:"end"},e.swipeHandler),e.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},e.swipeHandler),e.$list.on("click.slick",e.clickHandler),i(document).on(e.visibilityChange,i.proxy(e.visibility,e)),e.options.accessibility===!0&&e.$list.on("keydown.slick",e.keyHandler),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().on("click.slick",e.selectHandler),i(window).on("orientationchange.slick.slick-"+e.instanceUid,i.proxy(e.orientationChange,e)),i(window).on("resize.slick.slick-"+e.instanceUid,i.proxy(e.resize,e)),i("[draggable!=true]",e.$slideTrack).on("dragstart",e.preventDefault),i(window).on("load.slick.slick-"+e.instanceUid,e.setPosition),i(e.setPosition)},e.prototype.initUI=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.show(),i.$nextArrow.show()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.show()},e.prototype.keyHandler=function(i){var e=this;i.target.tagName.match("TEXTAREA|INPUT|SELECT")||(37===i.keyCode&&e.options.accessibility===!0?e.changeSlide({data:{message:e.options.rtl===!0?"next":"previous"}}):39===i.keyCode&&e.options.accessibility===!0&&e.changeSlide({data:{message:e.options.rtl===!0?"previous":"next"}}))},e.prototype.lazyLoad=function(){function e(e){i("img[data-lazy]",e).each(function(){var e=i(this),t=i(this).attr("data-lazy"),o=i(this).attr("data-srcset"),s=i(this).attr("data-sizes")||r.$slider.attr("data-sizes"),n=document.createElement("img");n.onload=function(){e.animate({opacity:0},100,function(){o&&(e.attr("srcset",o),s&&e.attr("sizes",s)),e.attr("src",t).animate({opacity:1},200,function(){e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")}),r.$slider.trigger("lazyLoaded",[r,e,t])})},n.onerror=function(){e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"),r.$slider.trigger("lazyLoadError",[r,e,t])},n.src=t})}var t,o,s,n,r=this;if(r.options.centerMode===!0?r.options.infinite===!0?(s=r.currentSlide+(r.options.slidesToShow/2+1),n=s+r.options.slidesToShow+2):(s=Math.max(0,r.currentSlide-(r.options.slidesToShow/2+1)),n=2+(r.options.slidesToShow/2+1)+r.currentSlide):(s=r.options.infinite?r.options.slidesToShow+r.currentSlide:r.currentSlide,n=Math.ceil(s+r.options.slidesToShow),r.options.fade===!0&&(s>0&&s--,n<=r.slideCount&&n++)),t=r.$slider.find(".slick-slide").slice(s,n),"anticipated"===r.options.lazyLoad)for(var l=s-1,d=n,a=r.$slider.find(".slick-slide"),c=0;c<r.options.slidesToScroll;c++)l<0&&(l=r.slideCount-1),t=t.add(a.eq(l)),t=t.add(a.eq(d)),l--,d++;e(t),r.slideCount<=r.options.slidesToShow?(o=r.$slider.find(".slick-slide"),e(o)):r.currentSlide>=r.slideCount-r.options.slidesToShow?(o=r.$slider.find(".slick-cloned").slice(0,r.options.slidesToShow),e(o)):0===r.currentSlide&&(o=r.$slider.find(".slick-cloned").slice(r.options.slidesToShow*-1),e(o))},e.prototype.loadSlider=function(){var i=this;i.setPosition(),i.$slideTrack.css({opacity:1}),i.$slider.removeClass("slick-loading"),i.initUI(),"progressive"===i.options.lazyLoad&&i.progressiveLazyLoad()},e.prototype.next=e.prototype.slickNext=function(){var i=this;i.changeSlide({data:{message:"next"}})},e.prototype.orientationChange=function(){var i=this;i.checkResponsive(),i.setPosition()},e.prototype.pause=e.prototype.slickPause=function(){var i=this;i.autoPlayClear(),i.paused=!0},e.prototype.play=e.prototype.slickPlay=function(){var i=this;i.autoPlay(),i.options.autoplay=!0,i.paused=!1,i.focussed=!1,i.interrupted=!1},e.prototype.postSlide=function(e){var t=this;if(!t.unslicked&&(t.$slider.trigger("afterChange",[t,e]),t.animating=!1,t.slideCount>t.options.slidesToShow&&t.setPosition(),t.swipeLeft=null,t.options.autoplay&&t.autoPlay(),t.options.accessibility===!0&&(t.initADA(),t.options.focusOnChange))){var o=i(t.$slides.get(t.currentSlide));o.attr("tabindex",0).focus()}},e.prototype.prev=e.prototype.slickPrev=function(){var i=this;i.changeSlide({data:{message:"previous"}})},e.prototype.preventDefault=function(i){i.preventDefault()},e.prototype.progressiveLazyLoad=function(e){e=e||1;var t,o,s,n,r,l=this,d=i("img[data-lazy]",l.$slider);d.length?(t=d.first(),o=t.attr("data-lazy"),s=t.attr("data-srcset"),n=t.attr("data-sizes")||l.$slider.attr("data-sizes"),r=document.createElement("img"),r.onload=function(){s&&(t.attr("srcset",s),n&&t.attr("sizes",n)),t.attr("src",o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"),l.options.adaptiveHeight===!0&&l.setPosition(),l.$slider.trigger("lazyLoaded",[l,t,o]),l.progressiveLazyLoad()},r.onerror=function(){e<3?setTimeout(function(){l.progressiveLazyLoad(e+1)},500):(t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"),l.$slider.trigger("lazyLoadError",[l,t,o]),l.progressiveLazyLoad())},r.src=o):l.$slider.trigger("allImagesLoaded",[l])},e.prototype.refresh=function(e){var t,o,s=this;o=s.slideCount-s.options.slidesToShow,!s.options.infinite&&s.currentSlide>o&&(s.currentSlide=o),s.slideCount<=s.options.slidesToShow&&(s.currentSlide=0),t=s.currentSlide,s.destroy(!0),i.extend(s,s.initials,{currentSlide:t}),s.init(),e||s.changeSlide({data:{message:"index",index:t}},!1)},e.prototype.registerBreakpoints=function(){var e,t,o,s=this,n=s.options.responsive||null;if("array"===i.type(n)&&n.length){s.respondTo=s.options.respondTo||"window";for(e in n)if(o=s.breakpoints.length-1,n.hasOwnProperty(e)){for(t=n[e].breakpoint;o>=0;)s.breakpoints[o]&&s.breakpoints[o]===t&&s.breakpoints.splice(o,1),o--;s.breakpoints.push(t),s.breakpointSettings[t]=n[e].settings}s.breakpoints.sort(function(i,e){return s.options.mobileFirst?i-e:e-i})}},e.prototype.reinit=function(){var e=this;e.$slides=e.$slideTrack.children(e.options.slide).addClass("slick-slide"),e.slideCount=e.$slides.length,e.currentSlide>=e.slideCount&&0!==e.currentSlide&&(e.currentSlide=e.currentSlide-e.options.slidesToScroll),e.slideCount<=e.options.slidesToShow&&(e.currentSlide=0),e.registerBreakpoints(),e.setProps(),e.setupInfinite(),e.buildArrows(),e.updateArrows(),e.initArrowEvents(),e.buildDots(),e.updateDots(),e.initDotEvents(),e.cleanUpSlideEvents(),e.initSlideEvents(),e.checkResponsive(!1,!0),e.options.focusOnSelect===!0&&i(e.$slideTrack).children().on("click.slick",e.selectHandler),e.setSlideClasses("number"==typeof e.currentSlide?e.currentSlide:0),e.setPosition(),e.focusHandler(),e.paused=!e.options.autoplay,e.autoPlay(),e.$slider.trigger("reInit",[e])},e.prototype.resize=function(){var e=this;i(window).width()!==e.windowWidth&&(clearTimeout(e.windowDelay),e.windowDelay=window.setTimeout(function(){e.windowWidth=i(window).width(),e.checkResponsive(),e.unslicked||e.setPosition()},50))},e.prototype.removeSlide=e.prototype.slickRemove=function(i,e,t){var o=this;return"boolean"==typeof i?(e=i,i=e===!0?0:o.slideCount-1):i=e===!0?--i:i,!(o.slideCount<1||i<0||i>o.slideCount-1)&&(o.unload(),t===!0?o.$slideTrack.children().remove():o.$slideTrack.children(this.options.slide).eq(i).remove(),o.$slides=o.$slideTrack.children(this.options.slide),o.$slideTrack.children(this.options.slide).detach(),o.$slideTrack.append(o.$slides),o.$slidesCache=o.$slides,void o.reinit())},e.prototype.setCSS=function(i){var e,t,o=this,s={};o.options.rtl===!0&&(i=-i),e="left"==o.positionProp?Math.ceil(i)+"px":"0px",t="top"==o.positionProp?Math.ceil(i)+"px":"0px",s[o.positionProp]=i,o.transformsEnabled===!1?o.$slideTrack.css(s):(s={},o.cssTransitions===!1?(s[o.animType]="translate("+e+", "+t+")",o.$slideTrack.css(s)):(s[o.animType]="translate3d("+e+", "+t+", 0px)",o.$slideTrack.css(s)))},e.prototype.setDimensions=function(){var i=this;i.options.vertical===!1?i.options.centerMode===!0&&i.$list.css({padding:"0px "+i.options.centerPadding}):(i.$list.height(i.$slides.first().outerHeight(!0)*i.options.slidesToShow),i.options.centerMode===!0&&i.$list.css({padding:i.options.centerPadding+" 0px"})),i.listWidth=i.$list.width(),i.listHeight=i.$list.height(),i.options.vertical===!1&&i.options.variableWidth===!1?(i.slideWidth=Math.ceil(i.listWidth/i.options.slidesToShow),i.$slideTrack.width(Math.ceil(i.slideWidth*i.$slideTrack.children(".slick-slide").length))):i.options.variableWidth===!0?i.$slideTrack.width(5e3*i.slideCount):(i.slideWidth=Math.ceil(i.listWidth),i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0)*i.$slideTrack.children(".slick-slide").length)));var e=i.$slides.first().outerWidth(!0)-i.$slides.first().width();i.options.variableWidth===!1&&i.$slideTrack.children(".slick-slide").width(i.slideWidth-e)},e.prototype.setFade=function(){var e,t=this;t.$slides.each(function(o,s){e=t.slideWidth*o*-1,t.options.rtl===!0?i(s).css({position:"relative",right:e,top:0,zIndex:t.options.zIndex-2,opacity:0}):i(s).css({position:"relative",left:e,top:0,zIndex:t.options.zIndex-2,opacity:0})}),t.$slides.eq(t.currentSlide).css({zIndex:t.options.zIndex-1,opacity:1})},e.prototype.setHeight=function(){var i=this;if(1===i.options.slidesToShow&&i.options.adaptiveHeight===!0&&i.options.vertical===!1){var e=i.$slides.eq(i.currentSlide).outerHeight(!0);i.$list.css("height",e)}},e.prototype.setOption=e.prototype.slickSetOption=function(){var e,t,o,s,n,r=this,l=!1;if("object"===i.type(arguments[0])?(o=arguments[0],l=arguments[1],n="multiple"):"string"===i.type(arguments[0])&&(o=arguments[0],s=arguments[1],l=arguments[2],"responsive"===arguments[0]&&"array"===i.type(arguments[1])?n="responsive":"undefined"!=typeof arguments[1]&&(n="single")),"single"===n)r.options[o]=s;else if("multiple"===n)i.each(o,function(i,e){r.options[i]=e});else if("responsive"===n)for(t in s)if("array"!==i.type(r.options.responsive))r.options.responsive=[s[t]];else{for(e=r.options.responsive.length-1;e>=0;)r.options.responsive[e].breakpoint===s[t].breakpoint&&r.options.responsive.splice(e,1),e--;r.options.responsive.push(s[t])}l&&(r.unload(),r.reinit())},e.prototype.setPosition=function(){var i=this;i.setDimensions(),i.setHeight(),i.options.fade===!1?i.setCSS(i.getLeft(i.currentSlide)):i.setFade(),i.$slider.trigger("setPosition",[i])},e.prototype.setProps=function(){var i=this,e=document.body.style;i.positionProp=i.options.vertical===!0?"top":"left",
"top"===i.positionProp?i.$slider.addClass("slick-vertical"):i.$slider.removeClass("slick-vertical"),void 0===e.WebkitTransition&&void 0===e.MozTransition&&void 0===e.msTransition||i.options.useCSS===!0&&(i.cssTransitions=!0),i.options.fade&&("number"==typeof i.options.zIndex?i.options.zIndex<3&&(i.options.zIndex=3):i.options.zIndex=i.defaults.zIndex),void 0!==e.OTransform&&(i.animType="OTransform",i.transformType="-o-transform",i.transitionType="OTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.MozTransform&&(i.animType="MozTransform",i.transformType="-moz-transform",i.transitionType="MozTransition",void 0===e.perspectiveProperty&&void 0===e.MozPerspective&&(i.animType=!1)),void 0!==e.webkitTransform&&(i.animType="webkitTransform",i.transformType="-webkit-transform",i.transitionType="webkitTransition",void 0===e.perspectiveProperty&&void 0===e.webkitPerspective&&(i.animType=!1)),void 0!==e.msTransform&&(i.animType="msTransform",i.transformType="-ms-transform",i.transitionType="msTransition",void 0===e.msTransform&&(i.animType=!1)),void 0!==e.transform&&i.animType!==!1&&(i.animType="transform",i.transformType="transform",i.transitionType="transition"),i.transformsEnabled=i.options.useTransform&&null!==i.animType&&i.animType!==!1},e.prototype.setSlideClasses=function(i){var e,t,o,s,n=this;if(t=n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden","true"),n.$slides.eq(i).addClass("slick-current"),n.options.centerMode===!0){var r=n.options.slidesToShow%2===0?1:0;e=Math.floor(n.options.slidesToShow/2),n.options.infinite===!0&&(i>=e&&i<=n.slideCount-1-e?n.$slides.slice(i-e+r,i+e+1).addClass("slick-active").attr("aria-hidden","false"):(o=n.options.slidesToShow+i,t.slice(o-e+1+r,o+e+2).addClass("slick-active").attr("aria-hidden","false")),0===i?t.eq(t.length-1-n.options.slidesToShow).addClass("slick-center"):i===n.slideCount-1&&t.eq(n.options.slidesToShow).addClass("slick-center")),n.$slides.eq(i).addClass("slick-center")}else i>=0&&i<=n.slideCount-n.options.slidesToShow?n.$slides.slice(i,i+n.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"):t.length<=n.options.slidesToShow?t.addClass("slick-active").attr("aria-hidden","false"):(s=n.slideCount%n.options.slidesToShow,o=n.options.infinite===!0?n.options.slidesToShow+i:i,n.options.slidesToShow==n.options.slidesToScroll&&n.slideCount-i<n.options.slidesToShow?t.slice(o-(n.options.slidesToShow-s),o+s).addClass("slick-active").attr("aria-hidden","false"):t.slice(o,o+n.options.slidesToShow).addClass("slick-active").attr("aria-hidden","false"));"ondemand"!==n.options.lazyLoad&&"anticipated"!==n.options.lazyLoad||n.lazyLoad()},e.prototype.setupInfinite=function(){var e,t,o,s=this;if(s.options.fade===!0&&(s.options.centerMode=!1),s.options.infinite===!0&&s.options.fade===!1&&(t=null,s.slideCount>s.options.slidesToShow)){for(o=s.options.centerMode===!0?s.options.slidesToShow+1:s.options.slidesToShow,e=s.slideCount;e>s.slideCount-o;e-=1)t=e-1,i(s.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t-s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");for(e=0;e<o+s.slideCount;e+=1)t=e,i(s.$slides[t]).clone(!0).attr("id","").attr("data-slick-index",t+s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");s.$slideTrack.find(".slick-cloned").find("[id]").each(function(){i(this).attr("id","")})}},e.prototype.interrupt=function(i){var e=this;i||e.autoPlay(),e.interrupted=i},e.prototype.selectHandler=function(e){var t=this,o=i(e.target).is(".slick-slide")?i(e.target):i(e.target).parents(".slick-slide"),s=parseInt(o.attr("data-slick-index"));return s||(s=0),t.slideCount<=t.options.slidesToShow?void t.slideHandler(s,!1,!0):void t.slideHandler(s)},e.prototype.slideHandler=function(i,e,t){var o,s,n,r,l,d=null,a=this;if(e=e||!1,!(a.animating===!0&&a.options.waitForAnimate===!0||a.options.fade===!0&&a.currentSlide===i))return e===!1&&a.asNavFor(i),o=i,d=a.getLeft(o),r=a.getLeft(a.currentSlide),a.currentLeft=null===a.swipeLeft?r:a.swipeLeft,a.options.infinite===!1&&a.options.centerMode===!1&&(i<0||i>a.getDotCount()*a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,t!==!0&&a.slideCount>a.options.slidesToShow?a.animateSlide(r,function(){a.postSlide(o)}):a.postSlide(o))):a.options.infinite===!1&&a.options.centerMode===!0&&(i<0||i>a.slideCount-a.options.slidesToScroll)?void(a.options.fade===!1&&(o=a.currentSlide,t!==!0&&a.slideCount>a.options.slidesToShow?a.animateSlide(r,function(){a.postSlide(o)}):a.postSlide(o))):(a.options.autoplay&&clearInterval(a.autoPlayTimer),s=o<0?a.slideCount%a.options.slidesToScroll!==0?a.slideCount-a.slideCount%a.options.slidesToScroll:a.slideCount+o:o>=a.slideCount?a.slideCount%a.options.slidesToScroll!==0?0:o-a.slideCount:o,a.animating=!0,a.$slider.trigger("beforeChange",[a,a.currentSlide,s]),n=a.currentSlide,a.currentSlide=s,a.setSlideClasses(a.currentSlide),a.options.asNavFor&&(l=a.getNavTarget(),l=l.slick("getSlick"),l.slideCount<=l.options.slidesToShow&&l.setSlideClasses(a.currentSlide)),a.updateDots(),a.updateArrows(),a.options.fade===!0?(t!==!0?(a.fadeSlideOut(n),a.fadeSlide(s,function(){a.postSlide(s)})):a.postSlide(s),void a.animateHeight()):void(t!==!0&&a.slideCount>a.options.slidesToShow?a.animateSlide(d,function(){a.postSlide(s)}):a.postSlide(s)))},e.prototype.startLoad=function(){var i=this;i.options.arrows===!0&&i.slideCount>i.options.slidesToShow&&(i.$prevArrow.hide(),i.$nextArrow.hide()),i.options.dots===!0&&i.slideCount>i.options.slidesToShow&&i.$dots.hide(),i.$slider.addClass("slick-loading")},e.prototype.swipeDirection=function(){var i,e,t,o,s=this;return i=s.touchObject.startX-s.touchObject.curX,e=s.touchObject.startY-s.touchObject.curY,t=Math.atan2(e,i),o=Math.round(180*t/Math.PI),o<0&&(o=360-Math.abs(o)),o<=45&&o>=0?s.options.rtl===!1?"left":"right":o<=360&&o>=315?s.options.rtl===!1?"left":"right":o>=135&&o<=225?s.options.rtl===!1?"right":"left":s.options.verticalSwiping===!0?o>=35&&o<=135?"down":"up":"vertical"},e.prototype.swipeEnd=function(i){var e,t,o=this;if(o.dragging=!1,o.swiping=!1,o.scrolling)return o.scrolling=!1,!1;if(o.interrupted=!1,o.shouldClick=!(o.touchObject.swipeLength>10),void 0===o.touchObject.curX)return!1;if(o.touchObject.edgeHit===!0&&o.$slider.trigger("edge",[o,o.swipeDirection()]),o.touchObject.swipeLength>=o.touchObject.minSwipe){switch(t=o.swipeDirection()){case"left":case"down":e=o.options.swipeToSlide?o.checkNavigable(o.currentSlide+o.getSlideCount()):o.currentSlide+o.getSlideCount(),o.currentDirection=0;break;case"right":case"up":e=o.options.swipeToSlide?o.checkNavigable(o.currentSlide-o.getSlideCount()):o.currentSlide-o.getSlideCount(),o.currentDirection=1}"vertical"!=t&&(o.slideHandler(e),o.touchObject={},o.$slider.trigger("swipe",[o,t]))}else o.touchObject.startX!==o.touchObject.curX&&(o.slideHandler(o.currentSlide),o.touchObject={})},e.prototype.swipeHandler=function(i){var e=this;if(!(e.options.swipe===!1||"ontouchend"in document&&e.options.swipe===!1||e.options.draggable===!1&&i.type.indexOf("mouse")!==-1))switch(e.touchObject.fingerCount=i.originalEvent&&void 0!==i.originalEvent.touches?i.originalEvent.touches.length:1,e.touchObject.minSwipe=e.listWidth/e.options.touchThreshold,e.options.verticalSwiping===!0&&(e.touchObject.minSwipe=e.listHeight/e.options.touchThreshold),i.data.action){case"start":e.swipeStart(i);break;case"move":e.swipeMove(i);break;case"end":e.swipeEnd(i)}},e.prototype.swipeMove=function(i){var e,t,o,s,n,r,l=this;return n=void 0!==i.originalEvent?i.originalEvent.touches:null,!(!l.dragging||l.scrolling||n&&1!==n.length)&&(e=l.getLeft(l.currentSlide),l.touchObject.curX=void 0!==n?n[0].pageX:i.clientX,l.touchObject.curY=void 0!==n?n[0].pageY:i.clientY,l.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(l.touchObject.curX-l.touchObject.startX,2))),r=Math.round(Math.sqrt(Math.pow(l.touchObject.curY-l.touchObject.startY,2))),!l.options.verticalSwiping&&!l.swiping&&r>4?(l.scrolling=!0,!1):(l.options.verticalSwiping===!0&&(l.touchObject.swipeLength=r),t=l.swipeDirection(),void 0!==i.originalEvent&&l.touchObject.swipeLength>4&&(l.swiping=!0,i.preventDefault()),s=(l.options.rtl===!1?1:-1)*(l.touchObject.curX>l.touchObject.startX?1:-1),l.options.verticalSwiping===!0&&(s=l.touchObject.curY>l.touchObject.startY?1:-1),o=l.touchObject.swipeLength,l.touchObject.edgeHit=!1,l.options.infinite===!1&&(0===l.currentSlide&&"right"===t||l.currentSlide>=l.getDotCount()&&"left"===t)&&(o=l.touchObject.swipeLength*l.options.edgeFriction,l.touchObject.edgeHit=!0),l.options.vertical===!1?l.swipeLeft=e+o*s:l.swipeLeft=e+o*(l.$list.height()/l.listWidth)*s,l.options.verticalSwiping===!0&&(l.swipeLeft=e+o*s),l.options.fade!==!0&&l.options.touchMove!==!1&&(l.animating===!0?(l.swipeLeft=null,!1):void l.setCSS(l.swipeLeft))))},e.prototype.swipeStart=function(i){var e,t=this;return t.interrupted=!0,1!==t.touchObject.fingerCount||t.slideCount<=t.options.slidesToShow?(t.touchObject={},!1):(void 0!==i.originalEvent&&void 0!==i.originalEvent.touches&&(e=i.originalEvent.touches[0]),t.touchObject.startX=t.touchObject.curX=void 0!==e?e.pageX:i.clientX,t.touchObject.startY=t.touchObject.curY=void 0!==e?e.pageY:i.clientY,void(t.dragging=!0))},e.prototype.unfilterSlides=e.prototype.slickUnfilter=function(){var i=this;null!==i.$slidesCache&&(i.unload(),i.$slideTrack.children(this.options.slide).detach(),i.$slidesCache.appendTo(i.$slideTrack),i.reinit())},e.prototype.unload=function(){var e=this;i(".slick-cloned",e.$slider).remove(),e.$dots&&e.$dots.remove(),e.$prevArrow&&e.htmlExpr.test(e.options.prevArrow)&&e.$prevArrow.remove(),e.$nextArrow&&e.htmlExpr.test(e.options.nextArrow)&&e.$nextArrow.remove(),e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden","true").css("width","")},e.prototype.unslick=function(i){var e=this;e.$slider.trigger("unslick",[e,i]),e.destroy()},e.prototype.updateArrows=function(){var i,e=this;i=Math.floor(e.options.slidesToShow/2),e.options.arrows===!0&&e.slideCount>e.options.slidesToShow&&!e.options.infinite&&(e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false"),e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false"),0===e.currentSlide?(e.$prevArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled","false")):e.currentSlide>=e.slideCount-e.options.slidesToShow&&e.options.centerMode===!1?(e.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")):e.currentSlide>=e.slideCount-1&&e.options.centerMode===!0&&(e.$nextArrow.addClass("slick-disabled").attr("aria-disabled","true"),e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled","false")))},e.prototype.updateDots=function(){var i=this;null!==i.$dots&&(i.$dots.find("li").removeClass("slick-active").end(),i.$dots.find("li").eq(Math.floor(i.currentSlide/i.options.slidesToScroll)).addClass("slick-active"))},e.prototype.visibility=function(){var i=this;i.options.autoplay&&(document[i.hidden]?i.interrupted=!0:i.interrupted=!1)},i.fn.slick=function(){var i,t,o=this,s=arguments[0],n=Array.prototype.slice.call(arguments,1),r=o.length;for(i=0;i<r;i++)if("object"==typeof s||"undefined"==typeof s?o[i].slick=new e(o[i],s):t=o[i].slick[s].apply(o[i].slick,n),"undefined"!=typeof t)return t;return o}});
(function($) {
	$('.ocha-services').on('click', function() {
		$('.ocha-header .dropdown-menu').toggle();
	});

	//inject particle background to header
	$('#particles-js').prependTo('.header-wrapper .uncol');

	//override parent theme forcing z-index
	$('.slideshow-modal-overlay').css('z-index', 3001);
	$('nav').css('z-index', 1001);
	$('.mobile-nav-toggle').css('z-index', 1002);
	$('.ocha-header .dropdown-menu').css('z-index', 1003);
	$('.modal-support-form').css('z-index', 1004);
	$('.post-body .post-after .tmb .t-entry-visual .t-entry-visual-overlay').css('z-index', 4);
	$('.post-body .post-after .tmb .t-entry-visual .t-overlay-wrap').css('z-index', 5);

	//capture search term
	var searchTerm = window.location.href.split('s=')[1];
	if (searchTerm!=undefined) {
		searchTerm = searchTerm.split('&')[0];
		//searchTerm = searchTerm.replace('+',' ');
		searchTerm = searchTerm.replace(/\+/g,' ');
		$('.header-main-container .search-container .search-field').val(decodeURIComponent(searchTerm));
	}

	//set height of content blocks on homepage
	setContentBlockHeight();
	$(window).resize(function() {
		setContentBlockHeight();
	});

	$(document).on('onLayout', function() {
		setContentBlockHeight();
	});

	function setContentBlockHeight() {
		var block = $('.home').find('.content-block--inner');
		var blockSize = block.width();
		block.css('height', blockSize);
		setTimeout(function() {
 			$('.slick-slideshow').css('opacity', 1);
		}, 1500);
		

		var archiveBlock = $('.category-article, .category-case-study, .tag').find('.t-inside');
		var archiveBlockWidth = archiveBlock.width() + 'px';
		archiveBlock.css('height', archiveBlockWidth);
	}

	//reset search placeholder text
	//$('.search-container input').attr('placeholder', 'Press enter to search');

	//click event for latest press blocks on homepage
	$('.latest-press-module .content-block--inner').on('click', function() {
		window.open($(this).find('a').attr('href'), '_blank');
	})

	//click event for video blocks on homepage
	$('.latest-stories-module .video-title').on('click', function() {
		var vid = $(this).closest('.content-block').find('iframe').attr('src');
		vid = vid.replace('embed', 'watch');
		if (vid!=undefined) window.open(vid, '_blank');
		return false;
	})

	//wpDataTables -- clicking on entire table row triggers row expand
	$('.wpDataTable tr').on('click', function() {
		$(this).find('.responsiveExpander').click();
	})

	//*********** TWITTER CONTENT BLOCK ***********//
    var TWITTER_DURATION = 5000;

	function twitterDataReady(data){
		//console.log(data);
		var processedTweets = [];
		for (var i = 0; i < data.length; i++){
			var dataTweet = data[i];
			processedTweets.push({
				"tweet": dataTweet.tweet,
				"tid": dataTweet.tid,
				"link": dataTweet.permalinkURL,
				"author": dataTweet.author
			});
		}
        $(document).trigger("tweetReady", { "tweets": processedTweets });
	}

	var tweetArray = [];
	var tweetID;
    var configList = {
        "profile": {"screenName": 'humdata'},
        // "domId": 'exampleList',
        "maxTweets": 10,
        "enableLinks": false,
        "showUser": true,
        "showTime": true,
        "showImages": true,
		"customCallback": twitterDataReady,
		"dataOnly": true
    };
    twitterFetcher.fetch(configList);

    //build tweet display
    $(document).on( 'tweetReady', function(e, data) {
        tweetArray = data.tweets;
        tweetID = util.getRandomID(0, tweetArray.length-1);
        getTweet();
    });

    function getTweet(){
        var val = tweetArray[tweetID];
        if (val!==undefined) {
	        tweetID = (tweetID==tweetArray.length-1) ? 0 : tweetID+1;
	        $('.tweet .tweet-text span').html(val.tweet);
	        $('.tweet .author').html(val.author);
	        $('.tweet a:not(.twitter-logo)').attr('href',val.link);
        }
    }

    setInterval(function(){
        $.when($('.tweet .tweet-content').animate({
            'opacity': '0',
            'marginTop': '+40px'
        }, 750)).done(function(){
            getTweet();
            $('.tweet .tweet-content').css('marginTop', '-40px');
            $('.tweet .tweet-content').animate({
                'opacity': '1',
                'marginTop': '0'
            }, 600)
        });
    }, TWITTER_DURATION);


	//*********** MAIN NAVIGATION EVENTS ***********//
	//sticky nav
	$(window).on('scroll', function() {
		if ($(this).scrollTop() > $('.ocha-header').height()) {
			$('nav').addClass('sticky');
			$('.ocha-header .dropdown-menu').css('display', 'none');
		}
		else {
			$('nav').removeClass('sticky');
		}
	});

	//show nav drawer
    $('.main-nav > .item').on('mouseover', function() {
		$('nav').addClass('active');
	});

    //hide nav drawer
    $('nav').on('mouseleave', function() {
		$('nav').removeClass('active');
	});

    //toggle mobile nav
	$('.mobile-nav-toggle').on('click', function() {
		if ($('nav').hasClass('active')) {
			$('nav').removeClass('active');
			$('.mobile-nav-toggle').removeClass('expanded');
  			$('body').removeClass('mobile-nav-open');
		}
		else {
			$('nav').addClass('active');
			$('.mobile-nav-toggle').addClass('expanded');
  			$('body').addClass('mobile-nav-open');
		}
	});

   
	//*********** SLIDESHOW CONTENT BLOCK ***********//
    var SLIDESHOW_DURATION = 3000;
	var slideshowClicked = false;

    function Slideshow(slider) {
	  	this.slider = slider;
	  	this.slides = slider.children();
		this.currSlideIndex = 0;
	}

	Slideshow.prototype.init = function(dur) {
		var duration = (dur!=undefined) ? dur : SLIDESHOW_DURATION;
	  	var self = this;
	  	$(this.slides[this.currSlideIndex]).removeClass('fadeIn');
        this.currSlideIndex++;
        if (this.currSlideIndex == this.slides.length) {
            this.currSlideIndex = 0;
        }
        $(this.slides[this.currSlideIndex]).addClass('fadeIn');

        setTimeout(function() {
            self.init();
        }, duration);
	}

	function initSlideshow() {
		var delay = 0;
		$('.slideshow-container').each(function(index) {
			var dur = SLIDESHOW_DURATION;
			if (!$(this).find('img').hasClass('fadeIn')) {
				var slide = new Slideshow($(this));
				dur += 300*index;
				slide.init(dur);
			}
		});

		//handle slideshow click, launch modal
		$('.slideshow, .slideshow-title').unbind('click').click(function(e) {
			slideshowClicked = true;
			var slideshowContainer = '';
			var slideshowCaption = {};

			if ($(this).attr('class').indexOf('t-entry')>-1) { //from category page
				if ($(this).attr('class').indexOf('slideshow-title')>-1) {
					slideshowContainer = $(this).parent().parent().find('.slideshow-container');
					slideshowCaption.title = $(this).find('.t-entry-title span').text();
					slideshowCaption.author = $(this).find('.author').text();
				}
				else {
					slideshowContainer = $(this).find('.slideshow-container');
					slideshowCaption.title = $(this).parent().find('.t-entry-text .t-entry-title span').text();
					slideshowCaption.author = $(this).parent().find('.t-entry-text .author').text();
				}
			}
			else { //from homepage
				if ($(this).attr('class').indexOf('slideshow-title')>-1) {
					slideshowContainer = $(this).parent().parent().find('.slideshow-container');
					slideshowCaption.title = $(this).find('.label').text();
					slideshowCaption.author = $(this).parent().find('.source').text();
				}
				else {
					slideshowContainer = $(this).find('.slideshow-container');
					slideshowCaption.title = $(this).parent().find('.content-block--content .slideshow-title .label').text();
					slideshowCaption.author = $(this).parent().find('.content-block--content .source').text();
				}
			}
			var slideshowID = slideshowContainer.attr('id');
			createSlideshowModal(slideshowContainer.children(), slideshowID, slideshowCaption);
			e.preventDefault();
		});
		$('.search .slideshow + .t-entry-text').unbind('click').click(function(e) {
			slideshowClicked = true;
			var slideshowID = $(this).parent().find('.slideshow-container').attr('id');
			createSlideshowModal($(this).parent().find('.slideshow-container').children(), slideshowID);
			e.preventDefault();
		});
	}

	//initialize any slideshow elements on page load
	initSlideshow();

	//check for new slideshow elements after load more or filtering
	$(document).on( 'onLayout', initSlideshow);
	
	//detect if location is direct link to slideshow
	if (window.location.href.indexOf('slideshow=') != -1) {
		var url = window.location.href;
		var id = url.split('slideshow=')[1];
		id = id.split('&')[0];
		var slideshowContainer = $('#'+id);
		var slides = $(slideshowContainer).children();
		var slideshowContent = '';
		var slideshowCaption = {};
		if (url.indexOf('category') != -1) { //on category page
			slideshowContent = $(slideshowContainer).closest('.slideshow').parent().find('.t-entry-text');
			slideshowCaption = {title: $(slideshowContent).find('.t-entry-title').text(), author: $(slideshowContent).find('.author').text()};
		}
		else { //on homepage
			slideshowContent = $(slideshowContainer).closest('.slideshow').parent().find('.content-block--content');
			slideshowCaption = {title: $(slideshowContent).find('.label').text(), author: $(slideshowContent).find('.source').text()};
		}

		if (slides.length>0) {
			createSlideshowModal($('#'+id).children(), null, slideshowCaption);
		}
	}


	//*********** SLIDESHOW MODAL ***********//
	var slideIndex = 1;
	function createSlideshowModal(slides, id, caption) {
		$('.slideshow-modal-overlay').show();
		$('<div class="slideshow-caption"><div class="title">'+caption.title+'</div><div class="author">'+caption.author+'</div><div class="counter">1/'+slides.length+'</div></div>').prependTo('.slides');
		slides.clone().prependTo('.slides');
		
		$('.slides').find('img:nth-child(1)').show();
		slideIndex = 1;

		//update url with slideshow id
		addSlideshowID(id);
	}
	function showSlideModal(dir) {
		var slides = $('.slides > img');
		if (dir=='next')
			slideIndex = (slideIndex < slides.length) ? slideIndex+1 : 1;
		else
			slideIndex = (slideIndex <= 1) ? slides.length : slideIndex-1;
		$('.slides').find('img').hide();
		$('.slides').find('img:nth-child('+slideIndex+')').show();
		$('.slides').find('.counter').text(slideIndex+'/'+slides.length)
	}
	function addSlideshowID(id) {
		if (history.pushState && id!=undefined) {
			//var cat = (window.location.href.indexOf('ucat') > -1) ? '' : '&ucat=110';
			var urlAppend = (window.location.href.indexOf('?') > -1) ? '&' : '?';
			var newurl = window.location.href + urlAppend + 'slideshow=' + id;// + cat;
			window.history.pushState({path:newurl},'',newurl);
		}
	}
	function removeSlideshowID() {
		if (history.pushState && window.location.href.indexOf('&slideshow=') > -1) {
			var newurl = window.location.href;
			newurl = newurl.substring(0, newurl.indexOf('&slideshow='));
			window.history.pushState({path:newurl},'',newurl);
		}
		if (history.pushState && window.location.href.indexOf('?slideshow=') > -1) {
			var newurl = window.location.href;
			newurl = newurl.substring(0, newurl.indexOf('?slideshow='));
			//if (!slideshowClicked) newurl = newurl + '?ucat=110';
			window.history.pushState({path:newurl},'',newurl);
		}
	}

	$('.slideshow-modal-overlay .close').on('click', function(e) {
		//close the modal and remove the slides
		$('.slideshow-modal-overlay').hide();
		$('.slides').empty();

		removeSlideshowID();
	});
	$('.slideshow-modal-overlay .slideshow-btn').on('click', function(e) {
		//get next slide
		showSlideModal($(this).attr('data-dir'));
	});

   
	//*********** IMPACT VISUALS GALLERY ***********//
	$('.visuals-gallery .gallery-btn').on('click', function(e) {
		var totalSlides = $('.visuals-gallery .visual').length;
		var currSlide = $('.visuals-gallery .visual.active');
		var nextSlide;
		if ($(this).hasClass('next-btn')) {
			nextSlide = (currSlide.index()<totalSlides-1) ? currSlide.next() : nextSlide = $('.visuals-gallery .visual:first-child');
		}
		else {
			nextSlide = (currSlide.index()==0) ? nextSlide = $('.visuals-gallery .visual:last-child') : currSlide.prev();
		}
		$('.visuals-gallery .visual').removeClass('active').fadeOut();
		nextSlide.addClass('active').fadeIn();

		var nextID = nextSlide.index()+1;
		$('.visuals-gallery .dot').removeClass('active');
		$('.visuals-gallery .dot:nth-child('+nextID+')').addClass('active');
	});

	$('.visuals-gallery .dot-indicator .dot').on('click', function(e) {
		var currID = $('.visuals-gallery .visual.active').index();
		var nextID = $(this).index() + 1;
		$('.visuals-gallery .visual').removeClass('active').fadeOut();
		$('.visuals-gallery .visual:nth-child('+nextID+')').addClass('active').fadeIn();
		$('.visuals-gallery .dot').removeClass('active');
		$('.visuals-gallery .dot:nth-child('+nextID+')').addClass('active');
	});


	//*********** SLICK SLIDESHOWS ***********//
	function initSlickSlideshow() {
	    $('.slick-slideshow').slick({
  			dots: true,
  			slidesToShow: 3,
  			slidesToScroll: 3,
			responsive: [
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: true
					}
				}
			]
	    });
	}
	initSlickSlideshow();


	//*********** CAROUSEL YOUTUBE PLAYERS ***********//
	var playerDivs = document.querySelectorAll('.video');
	var playerDivsArr = [].slice.call(playerDivs);
	var players = new Array(playerDivsArr.length);

	// create yt players
	readyYoutube();
	function readyYoutube(){
	    if ((typeof YT !== "undefined") && YT && YT.Player){
	        onYouTubeIframeAPIReady();
	    }
	    else {
	        setTimeout(readyYoutube, 100);
	    }
	}

	function onYouTubeIframeAPIReady() {
	  	playerDivsArr.forEach(function(e, i) { 
		  	var iframeID = $(e).find('iframe').attr('id');
		  	if (iframeID!==null && iframeID!=='') {
			    players[i] = new YT.Player(iframeID, {
			      	events: {
				 		'onReady': onPlayerReady,
		      			'onStateChange': onPlayerStateChange
		      		}
			    })
			}
	  	});

	  	//stop all videos when slideshow is swiped
	    // $('.slick-slideshow').on('swipe', function() {		
		//   	playerDivsArr.forEach(function(e, i) { 
		// 	  	var iframeID = $(e).find('iframe').attr('id');
		// 	  	if (iframeID!==null && iframeID!=='') {
		// 		    players[i].stopVideo();
		// 		}
		//   	});
		// });
	}

	function onPlayerReady(event) {
		var link = $(event.target.a).parent().closest('.video').find('a');
		var slide = $(event.target.a).parent();
		var slideOverlay = $(slide).find('.slide-overlay');
		link.on('click', function(e) {
			e.preventDefault();
			event.target.playVideo();
		});
	}

	function onPlayerStateChange(event) {
		var slide = $(event.target.a).parent();
		var slideOverlay = $(slide).find('.slide-overlay');
		if (event.data===2) {
			$(slideOverlay).fadeIn();
		}
	}
  

})(jQuery);


(function($) {
	//global mixpanel event function to be called from individual templates
	var mpTrack = window.mpTrack = {
		RW_URL: '',

		pageView: function(pageTitle, pageType){
			var mixpanelTrackData = {
				'page title': pageTitle,
				'page type': pageType
			};
			mixpanel.track('page view', mixpanelTrackData);
			//console.log(mixpanelTrackData);
		}
	}

	//track ocha header link clicks
	$('.ocha-services-menu a').on('click', function(event) {
		trackLink($(this), 'ocha-header', 'blank');
    });

	//track main nav link clicks
	$('.main-nav a').on('click', function(event) {
		trackLink($(this), 'main nav');
    });

	//track footer link clicks
	$('.contact-module a, .site-footer a').on('click', function(event) {
		trackLink($(this), 'footer');
    });

    //track blog links to pdf files
	$('.single-post a').on('click', function(event) {
		// var fileType = destURL.substr(destURL.lastIndexOf(".")+1)
		// if (fileType=='pdf') trackLink($(this), 'blog', target);
		var destURL = $(this).attr('href');
		mixpanel.track('link click', { 'destionation url': destURL, 'link type': 'blog', 'page title': document.title });
    });

    function trackLink(link, type) {
    	var destURL = $(link).attr('href');
    	mixpanel.track('link click', { 'destionation url': destURL, 'link type': type, 'page title': document.title });
        
        //var cb = generate_callback($(link), target);
        //mixpanel.track('link click', { 'destionation url': destURL, 'link type': type, 'page title': document.title }, cb);
        //setTimeout(cb, 500);
    }

    function generate_callback(a, target) {
        return function() {
        	if (target=='blank') {
        		window.open(a.attr('href'));
        	}
        	else {
           		window.location = a.attr('href');
        	}
        }
    }

    //track content block views on home page
    $('.home .content-block a').on('click', function() {
    	var title = ($(this).hasClass('title')) ? $(this).find('.label').text() : $(this).parent().parent().find('.label').text();
    	var category = ($(this).hasClass('title')) ? $(this).parent().parent().find('.category-tag').text() : $(this).parent().find('div[class*=category]').text();
    	mpTrack.pageView(title, category.toLowerCase());
    });

    //track slideshow views on category page
    $('.category .slideshow a, .slideshow-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.slideshow').parent().find('.t-entry .t-entry-title span').text();
    	mpTrack.pageView(title, 'slideshow');
    });

    //track dataviz views on category page
    $('.category .dataviz a, .dataviz-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.dataviz').parent().find('.t-entry .t-entry-title span').text();
		mpTrack.pageView(title, 'dataviz');
    });

    //track dataviz views on category page
    $('.category .announcement a, .announcement-title a').on('click', function() {
    	var title = ($(this).parent().hasClass('t-entry-title')) ? $(this).find('span').text() : $(this).closest('.announcement').parent().find('.t-entry .t-entry-title span').text();
		mpTrack.pageView(title, 'announcement');
    });

    //track article views on category page
    $('.category .article-title a').on('click', function() {
    	var title = $(this).find('.label').text();
		mpTrack.pageView(title, 'article');
    });

    //track article views on category page
    $('.category .casestudy-title a').on('click', function() {
    	var title = $(this).find('.label').text();
		mpTrack.pageView(title, 'casestudy');
    });

    //track video views on category page
    var playerDivs = document.querySelectorAll('.video');
	var playerDivsArr = [].slice.call(playerDivs);
	var players = new Array(playerDivsArr.length);

	// create yt players
	readyYoutube()
	function readyYoutube(){
	    if ((typeof YT !== "undefined") && YT && YT.Player){
	        onYouTubeIframeAPIReady();
	    }
	    else {
	        setTimeout(readyYoutube, 100);
	    }
	}
	function onYouTubeIframeAPIReady() {
	  playerDivsArr.forEach(function(e, i) { 
	  	var iframeID = $(e).find('iframe').attr('id');
	  	if (iframeID!==null && iframeID!=='') {
		    players[i] = new YT.Player(iframeID, {
		      	events: {
	      			'onStateChange': onPlayerStateChange
	      		}
		    })
		}
	  });
	}

	function onPlayerStateChange(event) {
		var title = $(event.target.a).parent().closest('.video').parent().find('.t-entry .t-entry-title').text();
		title = (title!=='') ? title : $(event.target.a).closest('.content-block').find('.label').text();
		if (event.data===1) {
			mpTrack.pageView(title, 'video');
		}
	}
})(jQuery);


(function($) {
	//faq events
	$('.accordion').find('.btn').on('click', function () {
		var isOpen = ($(this).parent().hasClass('open')) ? true : false;
		var acc = $(this).closest('.accordion');
		acc.find('[data-toggle="collapse"]').parent().removeClass('open');
		if (!isOpen) $(this).parent().addClass('open');
  		var items = $('.collapse');

  		for (var i=0; i<items.length; i++) {
  			var target = $(this).attr('data-target').split('#')[1];
  			if (items[i].id!=target) {
  				$(items[i]).removeClass('in');
  			}
  		}
  	});

	// create yt players
	readyYoutube();
	function readyYoutube(){
		if ((typeof YT !== "undefined") && YT && YT.Player){
			onYouTubeIframeAPIReady();
		}
		else {
			setTimeout(readyYoutube, 100);
		}
	}
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('overviewFeatureVideo', {
			events: {
				//'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			}
		});
	}

	function onPlayerStateChange(e) {
		if (e.data == YT.PlayerState.PLAYING) {
			playing = true;
			$('.feature-media-caption').fadeOut();
		}
		else if (e.data == YT.PlayerState.PAUSED || e.data == YT.PlayerState.ENDED) {
			playing = false;
			$('.feature-media-caption').fadeIn();
		}
	}
})(jQuery);

