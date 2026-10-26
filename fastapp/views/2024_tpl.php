
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<meta name="google" content="notranslate" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta property="og:type" content="Secrate Message"/>
<meta property="og:url" content="https://msbbillings.in/?n=BAPAN ROY" />
<meta property="og:title" content="BAPAN ROY Sent You A Surprising Message"/>
<meta property="og:description" content="See This One👇👇"/>
<title>BAPAN ROY Sent You A Surprising Message</title>
<link rel="stylesheet" href="<?=base_url();?>wish/wish_css/pyro.css">
<link rel="stylesheet" href="<?=base_url();?>wish/wish_css/enter-name.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
 <script id="wpcp_disable_selection" type="text/javascript">
var image_save_msg='You are not allowed to save images!';
	var no_menu_msg='Context Menu disabled!';
	var smessage = "Content is protected !!";

function disableEnterKey(e)
{
	var elemtype = e.target.tagName;
	
	elemtype = elemtype.toUpperCase();
	
	if (elemtype == "TEXT" || elemtype == "TEXTAREA" || elemtype == "INPUT" || elemtype == "PASSWORD" || elemtype == "SELECT" || elemtype == "OPTION" || elemtype == "EMBED")
	{
		elemtype = 'TEXT';
	}
	
	if (e.ctrlKey){
     var key;
     if(window.event)
          key = window.event.keyCode;     //IE
     else
          key = e.which;     //firefox (97)
    //if (key != 17) alert(key);
     if (elemtype!= 'TEXT' && (key == 97 || key == 65 || key == 67 || key == 99 || key == 88 || key == 120 || key == 26 || key == 85  || key == 86 || key == 83 || key == 43 || key == 73))
     {
		if(wccp_free_iscontenteditable(e)) return true;
		show_wpcp_message('You are not allowed to copy content or view source');
		return false;
     }else
     	return true;
     }
}


/*For contenteditable tags*/
function wccp_free_iscontenteditable(e)
{
	var e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
  	
	var target = e.target || e.srcElement;

	var elemtype = e.target.nodeName;
	
	elemtype = elemtype.toUpperCase();
	
	var iscontenteditable = "false";
		
	if(typeof target.getAttribute!="undefined" ) iscontenteditable = target.getAttribute("contenteditable"); // Return true or false as string
	
	var iscontenteditable2 = false;
	
	if(typeof target.isContentEditable!="undefined" ) iscontenteditable2 = target.isContentEditable; // Return true or false as boolean

	if(target.parentElement.isContentEditable) iscontenteditable2 = true;
	
	if (iscontenteditable == "true" || iscontenteditable2 == true)
	{
		if(typeof target.style!="undefined" ) target.style.cursor = "text";
		
		return true;
	}
}

////////////////////////////////////
function disable_copy(e)
{	
	var e = e || window.event; // also there is no e.target property in IE. instead IE uses window.event.srcElement
	
	var elemtype = e.target.tagName;
	
	elemtype = elemtype.toUpperCase();
	
	if (elemtype == "TEXT" || elemtype == "TEXTAREA" || elemtype == "INPUT" || elemtype == "PASSWORD" || elemtype == "SELECT" || elemtype == "OPTION" || elemtype == "EMBED")
	{
		elemtype = 'TEXT';
	}
	
	if(wccp_free_iscontenteditable(e)) return true;
	
	var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
	
	var checker_IMG = '';
	if (elemtype == "IMG" && checker_IMG == 'checked' && e.detail >= 2) {show_wpcp_message(alertMsg_IMG);return false;}
	if (elemtype != "TEXT")
	{
		if (smessage !== "" && e.detail == 2)
			show_wpcp_message(smessage);
		
		if (isSafari)
			return true;
		else
			return false;
	}	
}

//////////////////////////////////////////
function disable_copy_ie()
{
	var e = e || window.event;
	var elemtype = window.event.srcElement.nodeName;
	elemtype = elemtype.toUpperCase();
	if(wccp_free_iscontenteditable(e)) return true;
	if (elemtype == "IMG") {show_wpcp_message(alertMsg_IMG);return false;}
	if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "OPTION" && elemtype != "EMBED")
	{
		return false;
	}
}	
function reEnable()
{
	return true;
}
document.onkeydown = disableEnterKey;
document.onselectstart = disable_copy_ie;
if(navigator.userAgent.indexOf('MSIE')==-1)
{
	document.onmousedown = disable_copy;
	document.onclick = reEnable;
}
function disableSelection(target)
{
    //For IE This code will work
    if (typeof target.onselectstart!="undefined")
    target.onselectstart = disable_copy_ie;
    
    //For Firefox This code will work
    else if (typeof target.style.MozUserSelect!="undefined")
    {target.style.MozUserSelect="none";}
    
    //All other  (ie: Opera) This code will work
    else
    target.onmousedown=function(){return false}
    target.style.cursor = "default";
}
//Calling the JS function directly just after body load
window.onload = function(){disableSelection(document.body);};

//////////////////special for safari Start////////////////
var onlongtouch;
var timer;
var touchduration = 1000; //length of time we want the user to touch before we do something

var elemtype = "";
function touchstart(e) {
	var e = e || window.event;
  // also there is no e.target property in IE.
  // instead IE uses window.event.srcElement
  	var target = e.target || e.srcElement;
	
	elemtype = window.event.srcElement.nodeName;
	
	elemtype = elemtype.toUpperCase();
	
	if(!wccp_pro_is_passive()) e.preventDefault();
	if (!timer) {
		timer = setTimeout(onlongtouch, touchduration);
	}
}

function touchend() {
    //stops short touches from firing the event
    if (timer) {
        clearTimeout(timer);
        timer = null;
    }
	onlongtouch();
}

onlongtouch = function(e) { //this will clear the current selection if anything selected
	
	if (elemtype != "TEXT" && elemtype != "TEXTAREA" && elemtype != "INPUT" && elemtype != "PASSWORD" && elemtype != "SELECT" && elemtype != "EMBED" && elemtype != "OPTION")	
	{
		if (window.getSelection) {
			if (window.getSelection().empty) {  // Chrome
			window.getSelection().empty();
			} else if (window.getSelection().removeAllRanges) {  // Firefox
			window.getSelection().removeAllRanges();
			}
		} else if (document.selection) {  // IE?
			document.selection.empty();
		}
		return false;
	}
};

document.addEventListener("DOMContentLoaded", function(event) { 
    window.addEventListener("touchstart", touchstart, false);
    window.addEventListener("touchend", touchend, false);
});

function wccp_pro_is_passive() {

  var cold = false,
  hike = function() {};

  try {
	  const object1 = {};
  var aid = Object.defineProperty(object1, 'passive', {
  get() {cold = true}
  });
  window.addEventListener('test', hike, aid);
  window.removeEventListener('test', hike, aid);
  } catch (e) {}

  return cold;
}
/*special for safari End*/
</script>
<script id="wpcp_disable_Right_Click" type="text/javascript">
document.ondragstart = function() { return false;}
	function nocontext(e) {
	   return false;
	}
	document.oncontextmenu = nocontext;
</script>
<style>
.unselectable
{
-moz-user-select:none;
-webkit-user-select:none;
cursor: default;
}
html
{
-webkit-touch-callout: none;
-webkit-user-select: none;
-khtml-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
-webkit-tap-highlight-color: rgba(0,0,0,0);
}
</style>
<script id="wpcp_css_disable_selection" type="text/javascript">
var e = document.getElementsByTagName('body')[0];
if(e)
{
	e.setAttribute('unselectable',on);
}
</script>

<script type="text/javascript">! function (){
	var t;
	try{for (t=0; 10 > t; ++t)
		history.pushState({}, "", "");
	onpopstate=function (t)
	{
		t.state && alert('Click on the GO button by entering your name in the box below 👇👇 ');
		}}
		catch (o){}}();</script>
<style>
body{
background: #0919ac;
margin:0;
text-align: center;
}
 *{
margin:0;
padding:0;
}
img{
border: none;
}
.vikas{background-image:url();background-repeat:no-repeat;background-attachment:fixed;background-position:top}
	
.mainContainer {
    background-image: url(https://msbbillings.in/wish/wish_css/img/msb.jpeg);
max-width: 450px;
min-height: 200px;
margin: 0 auto;
text-align: center;
padding: 15px;
color: #999;
padding-bottom: 60px;
box-shadow: 0 0 10px 1px rgba(0,0,0,.14), 0 1px 14px 2px rgba(0,0,0,.12), 0 0 5px -3px rgba(0,0,0,.3);
background-image: ;}

.topline{
font-size: 27px;
color:red;
font-weight: bold;
text-shadow: 1px 1px 3px blue, 1px 1px 3px blue, -1px -1px 3px blue, -1px -1px 3px black;
}

#demo{
color: #de290b;
font-size: 19px;
text-shadow:8px 8px 16px; 
font-weight: bold;
animation: pulse 2s infinite;
width:100%;
margin: 5px;
}

.leftcurtain{
width: 50%;
height: 120%;
top: 0px;
left: 0px;
position: absolute;
z-index: 2;
}
.rightcurtain{
width: 50%;
height: 120%;
right: 0px;
top: 0px;
position: absolute;
z-index: 3;
}
.rightcurtain img, .leftcurtain img{
width: 100%;
height: 100%;
}
.logo{
margin: 0px auto;
margin-top: 150px;
}
.rope{
position: absolute;
top: 10px;
left: 23%;
z-index: 4;
}
} 
.centered {
position: absolute;
top: 70%;
left: 55%;
transform: translate(-50%, -50%);
}
a.rope
{
text-decoration:none;
}
.m1{position:fixed;left:1%; width:auto;height:100%;top:1%;color:#000;}
.m2{position:fixed;right:1%; width:auto;height:100%;top:1%;color:#000;}

#name {
-webkit-text-stroke: 1.3px red;
text-stroke: 1.3px red;
margin-bottom: 5px;
font-size: 45px;
padding: 0 10px;
font-family: 'Teko', sans-serif;
background: url(https://msbbillings.in/wish/wish_css/img/127.gif);
-webkit-text-fill-color: transparent;
-webkit-background-clip: text;
animation: name 4s infinite, slide 15s linear infinite; 
-webkit-animation: name 4s infinite, slide 15s linear infinite;
} 
@-webkit-keyframes slide {
from { background-position: 0 0; }
to { background-position: -500px 0; }
}
@keyframes slide {
from { background-position: 0 0; }
to { background-position: -500px 0; }} 

@keyframes bgchange {
0% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); 
background-size: 400% 400%;
background-position: 0% 50%;
}
50% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); 
background-size: 400% 400%;
background-position: 100% 50%;
}
100% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
 background-size: 400% 400%;
background-position: 0% 50%;
}}
@-webkit-keyframes bgchange {
0% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); 
background-size: 400% 400%;
background-position: 0% 50%;
}
50% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); 
background-size: 400% 400%;
background-position: 100% 50%;
}
100% {background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
 background-size: 400% 400%;
background-position: 0% 50%;
}}

.wishMessage h1 {
font-size: 30px;
color: rgba(225,225,225,.1);
background-image: url(wubackgr.jpeg);
background-repeat: repeat-x ;
-webkit-background-clip: text; 
color:transparent ;
-webkit-animation: slide 15s linear infinite;
-webkit-text-stroke: 1px red;
animation: slide 15s linear infinite;
text-stroke: 1px red;
}
.slideshow{
padding: 10px 1px;
width:70%;
border-radius:10px;
margin:5px;
font-size:22px;
color: blue;
border: 10px solid transparent;
border-image: url(https://msbbillings.in/wish/wish_css/img/border1.png) 30 round;
}

.glow{
font-family: 'ranga' cursive;
-webkit-text-stroke: 1px black;
text-stroke: 1px black;
width:90%;
padding: 0 10px;
font-size:30px;
font-weight:900; 
margin-bottom:20px;
text-align:center;
background-image: url(https://msbbillings.in/wish/wish_css/img/input.gif);
webkit-text-fill-color: transparent;
-webkit-background-clip: text;
animation : swing 4s infinite;
-webkit-animation : swing 4s infinite;
}

h1 {
display: inline-block;
font-size: 30px;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}   

.happyholimixcolor {
	font-size:22px; 
	
	background-color: ;
 font-weight:bold;
	}
	
#loading {
         -webkit-animation: rotation-star 5s infinite linear;
         animation: rotation-star 5s infinite linear;
         }
         @-webkit-keyframes rotation-star {
         from {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
         }
         to {
         -webkit-transform: rotate(359deg);
         transform: rotate(359deg);
         }
         }
         @-keyframes rotation-star{
         from {
         -webkit-transform: rotate(0deg);
         transform: rotate(0deg);
         }
         to {
         -webkit-transform: rotate(359deg);
         transform: rotate(359deg);
         }
         }

.mixcolor1{ color:#048505;}
.mixcolor2{ color:#a71780;}
.mixcolor3{ color:#c00909;}
.mixcolor4{ color:#6666ff;}
.mixcolor5{ color:#c9850d;}
.mixcolor6{ color:#de290b;}
.mixcolor7{ color: #ff1aff;}
.mixcolor8{ color:green;}
.mixcolor9{ color:red;}


.mch1 {
  font-size: 22px;
  text-shadow: 1px 1px 3px #ff0037, 1px 1px 3px #ff0037, -1px -1px 3px #ff0037, -1px -1px 3px #ff0037;
color: #FFC107;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?=base_url();?>wish/wish_css/slider.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() { $curtainopen = false; $(".rope").click(function(){ $(this).blur(); if ($curtainopen == false){ $(this).stop().animate({top: '-171%' }, {queue:false, duration:350, easing:'easeOutBounce'}); $(".leftcurtain").stop().animate({width:'1px'}, 2000 ); $(".rightcurtain").stop().animate({width:'1px'},2000 ); $curtainopen = true; }else{ $(this).stop().animate({top: '-40px' }, {queue:false, duration:350, easing:'easeOutBounce'}); document.write(''); $(".leftcurtain").stop().animate({width:'50%'}, 2000 ); $(".rightcurtain").stop().animate({width:'51%'}, 2000 ); $curtainopen = false; } return false; }); });
</script>
</head>
<body>
	
<audio id="audiocracker" src="<?=base_url();?>wish/wish_css/img/dhamaka.mp3" autostart="false"></audio>
<script>
    function PlaySound() {
          var sound = document.getElementById("audiocracker");
          sound.play()
      }
    </script>

<div class="leftcurtain"><img src="<?=base_url();?>wish/wish_css/img/door1.png"/></div>
<div class="rightcurtain"><img src="<?=base_url();?>wish/wish_css/img/door2.png"/></div>
<a class="rope" href="" onclick="PlaySound()">
<div class="topline"><br><b>Touch Here<br><img src="<?=base_url();?>wish/wish_css/img/arrow.gif" width="50px" height="130px%"></div>
<div style="background-image: url(); background-size: 50%; background-position: center; background-repeat: no-repeat;">
<img id="" src="<?=base_url();?>wish/wish_css/img/bell.png" style="max-width:60%; width: 70%; animation:swing 2s infinite;" /></div></div>
</a>
<marquee class="m1" behavior="scroll" direction="up" scrolldelay="7"> <br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="250px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="250px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
</marquee>
<marquee class="m2" behavior="scroll" direction="down" scrolldelay="5"><br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/tech.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/><br><br>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br><br>
</marquee>

<div class="mainContainer">
	
<br><center>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9386363064129842"
     crossorigin="anonymous"></script>
<!-- mahakal -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:50px"
     data-ad-client="ca-pub-9386363064129842"
     data-ad-slot="7535089132"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center><br><br>

<div style="animation: swing 2s infinite;">
<h1 id="name">
<!--BAPAN ROY-->
</h1></div><br>
	<img src="<?=base_url();?>wish/wish_css/img/fireworks-9713_512.gif" style="animation: tada 2s infinite" width="35%"><br><br>
<p id="demo"></p>
<div class="pyro"><div class="before"></div></div>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/>
<img src="<?=base_url();?>wish/wish_css/img/0.png" height="150px" width="20px"/>
<img src="<?=base_url();?>wish/wish_css/img/2.png" height="150px" width="20px"/>
<img src="<?=base_url();?>wish/wish_css/img/5.png" height="150px" width="20px"/><br/><br/><br/><br/><br/>
<!--<h3 class="glow">-->
    <!--BAPAN ROY-->
   <span height="150px" width="20px" class="glow"> 2025</span>
<!--</h3>-->
<!--<img src="<?=base_url();?>wish/wish_css/img/2025.gif" width="80%" style="animation: tada 2s infinite"><br>-->
<br><center>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9386363064129842"
     crossorigin="anonymous"></script>
<!-- mahakal -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:50px"
     data-ad-client="ca-pub-9386363064129842"
     data-ad-slot="7535089132"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</center><br><br>
 <img src="<?=base_url();?>wish/wish_css/img/change-of-year-16398_256.gif" width="80%" style="animation: pulse 2s infinite"><br>
<div class="happyholimixcolor">
<p style="text-shadow: 1px 1px 3px black, 1px 1px 3px black, -1px -1px 3px black, -1px -1px 3px black;color:#ff9933">I hope your New Year celebrations</p>
<p style="text-shadow: 1px 1px 3px black, 1px 1px 3px black, -1px -1px 3px black, -1px -1px 3px black;color:red">are full of love and laughter.</p>
<span style="text-shadow: 1px 1px 3px silver, 1px 1px 3px silver, -1px -1px 3px silver, -1px -1px 3px silver;color:#000080">Wishing you all a fun-filled  </span> </p>
<p style="color:purple">and healthy 2025!</p>
<p style="text-shadow: 1px 1px 3px black, 1px 1px 3px black, -1px -1px 3px black, -1px -1px 3px black;color:red">!!🎉wishing you happy new year🎉!! </p>🍾🎁🧑🍾🎁🧑🍾
</div>
	

</center><br>
<h1 class="glow">॥ Happy New Year 2025॥</h1>
 <center>
<div class="slideshow">
   <marquee><b><i>
       <!--BAPAN ROY-->
   Wishing You A Very Happy New Year 2025"</b></i></marquee>
</div></center>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9386363064129842"
     crossorigin="anonymous"></script>
<!-- responshiv -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9386363064129842"
     data-ad-slot="9002472644"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<center>

<br>
<h1 class="glow">
    <!--BAPAN ROY-->
    2025<br/>
    www.msbbillings.in<br/>Medical Billing Software<br/>Cable Billing Software<br/>Internet Billing Software
</h1>

<br><br>
<!--<form method="POST" action="ready.php">-->
<!--<div class="enter-name">-->
<!--<input class="animated pulse infinite" type="name" required="" maxlength="50" name="n" placeholder="enter your name 👇👇...">-->
<!--<button class="btn animated shake infinite" type="submit"><span>👉</span> Go</button>-->
<!--</div></form>-->
<script> 
var countDownDate=new Date("jan 1, 2025 00:00:00").getTime(),x=setInterval(function(){var e=(new Date).getTime(),o=countDownDate-e,t=Math.floor(o/864e5),n=Math.floor(o%864e5/36e5),a=Math.floor(o%36e5/6e4),l=Math.floor(o%6e4/1e3);document.getElementById("demo").innerHTML=""+t+"<font color='#048505'> Days,</font> "+n+"<font color='#a71780'> Hours,</font> "+a+"<font color='#6666ff'> Min,<br></font> "+l+"<font color='#c9850d'> Seconds,</font> <font color='#ff1aff'> Before</font>",o<0&&(clearInterval(x),document.getElementById("demo").innerHTML="")},1e3);
</script>
</body>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-192731202-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-192731202-1');
</script>
<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'},{'ap':'cpsh-oh'},{'server':'bom1plzcpnl498924'},{'dcenter':'bom1'},{'cp_id':'9133620'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.</script><script src='https://img1.wsimg.com/traffic-assets/js/tccl.min.js'></script></html>