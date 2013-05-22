<!DOCTYPE html>

<html>
<head>
    <title>Atare</title>
    <style>

/* Basic Styles */

* { margin: 0; padding: 0; }
body { overflow-x: hidden; color: #222; font-family: helvetica, arial; line-height: 1.2; } a:active { outline: none;}
.nextbutton, .backbutton { position: absolute; top: 0; height: 100%; width: 50%; }
.nextbutton { cursor: url('right.png'), e-resize; right: 0; }
.backbutton { cursor: url('left.png'), w-resize; left: 0; }
h1 { text-align: center; padding: 0 50px; margin-top: 150px; font-size: 50px; }
img { margin: 0 auto; display: block; margin-top: 50px;}



/* Top Navigation.  */

table { 
display: table;
width: 100%; 
cellspacing: 0; 
border-collapse: collapse;
position: fixed;
z-index: 5000;
top: -1px;
left: 0;
right: 0;
}


table a {
line-height: 54px;
font-family: helvetica, arial;
font-size: 11px;
font-weight: bold;
text-decoration: none;
color: #aaa;
display: block;
text-align: center;
margin: 0;
background-color: #111;
-moz-transition: all 1s; 
-webkit-transition: all 1s; 
-o-transition: all 1s; 
transition: all 1s; 
}

#a1:target #p1,
#a2:target #p2,
#a3:target #p3 { background-color: green; color: #fff; }

table a:hover {
background-color: #444;
-moz-transition: background 0s; 
-webkit-transition: background 0s; 
-o-transition: background 0s; 
transition: background 0s; 
}


</style>

    <meta name="description" content="your site description here" />
    <meta name="keywords" content="your keywords here" />
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="lightbox/source/jquery.fancybox.css" />
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" /><![endif]-->
    <script src="jquery-1.8.3.min.js"></script>
    <script src="lightbox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script src="lightbox/source/jquery.fancybox.js"></script>
<script src="lightbox/source/jquery.fancybox.pack.js"></script>
<script src="jquery.joverlay.min.js"></script>




    <script src="jquery.animateNumbers.js"></script>
</head>

<body>
<div id="wrapper">
    <div class="color-bar">
         <ul>
         <li class="color1"></li>
         <li class="color2"></li>
         <li class="color3"></li>
         <li class="color4"></li>
         <li class="color5"></li>
         <li class="color6"></li>
         <li class="color7"></li>
         </ul>
     </div>


<style>


/* The Basic Style for all Pages */

.page { 
position: absolute;
top:; 
width: 100%; 
height: 100%; 
}



/* The Pages */

#i1 { left: 0%; background-color: #fff; }
#i1 { left: 100%; background-color: #fff; }
#i2 { left: 200%; background-color: #bbb; }
#i3 { left: 300%; background-color: #777; }



/* The Transition Effect */

.page { 
-webkit-transition: -webkit-transform 0.8s;
-moz-transition: -moz-transform 0.8s;
-o-transition: -o-transform 0.8s;
transition: transform 0.8s;
}



/* The Sliding Action */
/* TranslateX for better Performance. Translate3D for better Performance on Ipad. */

#a1:target .page { -webkit-transform: translateX(-100%); -moz-transform: translateX(-100%); -o-transform: translateX(-100%); transform: translateX(-100%); }
#a2:target .page { -webkit-transform: translateX(-200%); -moz-transform: translateX(-200%); -o-transform: translateX(-200%); transform: translateX(-200%); }
#a3:target .page { -webkit-transform: translateX(-300%); -moz-transform: translateX(-300%); -o-transform: translateX(-300%); transform: translateX(-300%); }



/* The First Page - Initial Positioning without Anchor */

.page { 
-webkit-transform: translateX(-100%); -moz-transform: translateX(-100%); -o-transform: translateX(-100%); transform: translateX(-100%);
}


</style>


<!-- This is for the ipad. Check it there too. -->

<script> 
 function BlockMove(event) {
  // Tell Safari not to move the window.
  event.preventDefault() ;
 }
</script> 
<body ontouchmove="BlockMove(event);"> 

<!-- These divs are used for anchor-jumps with the pseudoclass :target -->

<div id="a1">
 <div id="a2">
  <div id="a3">



   <!-- Top Navigation. Ya, tables are evil. -->

   <table> 
    <tr> 
     <td><a href="#a1" id="p1">1</a></td> 
     <td><a href="#a2" id="p2">2</a></td> 
     <td><a href="#a3" id="p3">3</a></td> 
    </tr> 
   </table>



   <!-- Fallback -->

   <div id="i0" class="page">

    <h1>Your browser sucks.</h1>

   </div>



   <!-- First Page #a1 -->

   <div id="i1" class="page">

    <a href="#a3" class="backbutton"></a>
    <a href="#a2" class="nextbutton"></a>

    <h1></h1>
    <img src="info/DESIGN2.png" width=700px>

   </div>



   <!-- Second Page #a2 -->

   <div id="i2" class="page">

    <a href="#a1" class="backbutton"></a>
    <a href="#a3" class="nextbutton"></a>

     <img src="info/DESIGN3.png" width=700px>

   </div>



   <!-- Third Page #a3 -->

   <div id="i3" class="page">

    <a href="#a2" class="backbutton"></a>
    <a href="#a1" class="nextbutton"></a>

    <h1>Check the Source Code</h1>

     <img src="info/DESIGN4.png" width=700px>

   </div>



  </div>
 </div>
</div>


<!-- The End -->

































































<!-- SZM VERSION="1.5" --> 
<script type="text/javascript"> 
<!-- 
var IVW="http://vicecom.ivwbox.de/cgi-bin/ivw/CP/a-designmadeingermany;"; 
document.write("<img src=\""+IVW+"?r="+escape(document.referrer)+"&d="+(Math.random()*100000)+"\" width=\"1\" height=\"1\" alt=\"szmtag\" />"); 
//--> 
</script> 
<noscript> 
<img src="http://vicecom.ivwbox.de/cgi-bin/ivw/CP/a-designmadeingermany;" width="1" height="1" alt="szmtag" /> 
</noscript> 
<!-- /SZM -->

<!--SZMFRABO VERSION="1.2" -->
<script type="Text/Javascript">
<!--
var szmvars="vicecom//CP//a-designmadeingermany"; // -->

</script>
<script src="http://vicecom.ivwbox.de/2004/01/survey.js" type="Text/Javascript">
</script>
<!-- /SZMFRABO --> 
 
<!-- Begin comScore Tag --> 
<script> 
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "8568956" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script> 
<noscript> 
  <img src="http://b.scorecardresearch.com/p?c1=2&c2=8568956&cv=2.0&cj=1" />
</noscript> 
<!-- End comScore Tag --> 
 
<script type="text/javascript"> 
 var _gaq = _gaq || [];
 _gaq.push(['_setAccount', 'UA-670025-3']);
 _gaq.push(['_trackPageview']);
 _gaq.push(['_trackPageLoadTime']);
 
 (function() {
   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();
</script> 


    
   
    
    
</div> <!-- Middle End -->   
<div id="footer">

<div id="rights">Copyright &copy; 2011 .  All Rights Reserved.</div> <!-- Rights End -->  
</div> <!-- Footer End -->


    
</div> <!-- Wrapper End -->

</body>
</html>
