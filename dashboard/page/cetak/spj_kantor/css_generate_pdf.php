<?php
$mpdf->progbar_altHTML = '<html>
<body>
<style>
@-moz-keyframes page1 {
0%   { -moz-transform: translateY(0px); -moz-animation-timing-function: linear;}
100% { -moz-transform: translateY(125px); }			
}
@-webkit-keyframes page1 {
0%   { -webkit-transform: translateY(0px); -webkit-animation-timing-function: linear;}
100% { -webkit-transform: translateY(125px); }		
}

.printerWrapper { 
position: relative;
width: 100%;
height: 500px;
margin-top: 2%;
margin-left: -3%;
}

.paperWrapper {
position: absolute;
top: 50%;
left: 45%;
margin-left: -100px;
height: 110px;
width: 350px;
margin-top: -250px;
z-index: 1000;
}

.paperIn {
position: absolute;
top:0%;
left: 57%;
margin-left: -90px;
height: 123px;
width: 131px;
margin-top: 12px;  
/*color*/
background-color: #d6d7e1;
-webkit-box-shadow: 0 0 6px rgba(0,0,0,.34);
-moz-box-shadow: 0 0 6px rgba(0,0,0,.34);
box-shadow: 0 0 6px rgba(0,0,0,.34);
background-image: -webkit-linear-gradient(bottom, #fafafc, #fff 71%);
background-image: -moz-linear-gradient(bottom, #fafafc, #fff 71%);
background-image: -o-linear-gradient(bottom, #fafafc, #fff 71%);
background-image: -ms-linear-gradient(bottom, #fafafc, #fff 71%);
background-image: linear-gradient(to top, #fafafc, #fff 71%);
/*text*/
color: #777;
text-transform: uppercase;
text-align: center;
padding-top: 0.1em;
-webkit-box-sizing: border-box;
 -moz-box-sizing: border-box;
      box-sizing: border-box;
font-family: "Oswald";
font-size: 1.8em;
}

.page1 {
z-index: 250;
/*animation*/
-moz-animation: page1 3s infinite;
-webkit-animation: page1 3s infinite;
}
.page2 {
z-index: 245;
}

.paperInsert {
position: absolute;
top:0%;
left: 58%;
margin-left: -115px;
height: 75px;
width: 175px;
margin-top: 60px;
z-index: 150;  
/*color*/
-webkit-border-radius: 5px 5px 0 0/8px 8px 0 0;
-moz-border-radius: 5px 5px 0 0/8px 8px 0 0;
border-radius: 5px 5px 0 0/8px 8px 0 0;
background-color: #fff;
-webkit-box-shadow: 0 -2px 0 2px rgba(0,0,0,.4);
-moz-box-shadow: 0 -2px 0 2px rgba(0,0,0,.4);
box-shadow: 0 -2px 0 2px rgba(0,0,0,.4);
background-image: -webkit-linear-gradient(bottom, #151617, #3a3f3f 51%, #515859);
background-image: -moz-linear-gradient(bottom, #151617, #3a3f3f 51%, #515859);
background-image: -o-linear-gradient(bottom, #151617, #3a3f3f 51%, #515859);
background-image: -ms-linear-gradient(bottom, #151617, #3a3f3f 51%, #515859);
background-image: linear-gradient(to top, #151617, #3a3f3f 51%, #515859);
}

.paperSlot {
position: absolute;
top:120%;
left: 54.5%;
margin-left: -115px;
background: #000;
z-index: 350;
height: 5px;
width: 200px;
border-radius: 50%;
}

.paperHide {
position: absolute;
top:122.9%;
left: 58%;
margin-left: -115px;
background: #CDCED0;
z-index: 300;
height: 75px;
width: 175px;
}

.printerTop {
position:absolute;
top: 37%;
left: 45%;
margin-left: -100px;
margin-top: -75px;  
vertical-align: middle;
z-index: 100;  
/*border*/
border-bottom: 70px solid #CDCED0;
border-left: 40px solid transparent;
border-right: 40px solid transparent;
border-top-left-radius:30px;
border-top-right-radius:30px;
height: 0;
width: 269px;
}

.printerTop:after {
content:" ";
left:0px;
top:-3px;
position:absolute;
background: #CDCED0;
border-radius: 10px 10px 0 0;
width:269px;
height:5px;
display:block;
}

.printerBody {
position: absolute;
top: 50%;
left: 45%;
margin-left: -100px;
height: 110px;
width: 350px;
margin-top: -75px;
border-top: 1px solid #cdced0;
z-index: 1000;  
/*color*/
border-radius: 10px;
background-color: #fff;
background-image: -webkit-linear-gradient(bottom, #fff, #f0f0f3 47%, #b3b4b9);
background-image: -moz-linear-gradient(bottom, #fff, #f0f0f3 47%, #b3b4b9);
background-image: -o-linear-gradient(bottom, #fff, #f0f0f3 47%, #b3b4b9);
background-image: -ms-linear-gradient(bottom, #fff, #f0f0f3 47%, #b3b4b9);
background-image: linear-gradient(to top, #fff, #f0f0f3 47%, #b3b4b9);  
/*box shadow*/
-webkit-box-shadow: 0px 1px 1px rgba(180, 180, 180, 1) inset, 0px 1px 3px rgba(0, 0, 0, .25), 0px 0px 0px 4px rgba(77, 77, 77, .1), 0px 5px 3px rgba(200, 200, 200, .2);
box-shadow: 2px 3px 4px rgba(255, 2555, 255, 1) inset, 0px 1px 3px rgba(0, 0, 0, .25), 0px 2px 1px rgba(200, 200, 200, 1);
}

.bayWrapper {
position: absolute;
top: 50%;
left: 45%;
margin-left: -100px;
height: 110px;
width: 350px;
margin-top: -250px;
z-index: 1000;
}

.lightLarge, .lightSmall {
position: absolute;
top: 180%;
left: 110%;
margin-left: -100px;
padding: 2px;
border-radius: 50px;
display: inline-block;
background: #1A1A1A;
background: -moz-linear-gradient(top, #1A1A1A 0%, #4D4D4D 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #1A1A1A), color-stop(100%, #4D4D4D));
background: -webkit-linear-gradient(top, #4D4D4D 0%, #fAfAfA 100%);
background: -o-linear-gradient(top, #1A1A1A 0%, #4D4D4D 100%);
background: -ms-linear-gradient(top, #1A1A1A 0%, #4D4D4D 100%);
background: -webkit-linear-gradient(to bottom, #fAfAfA 0%, #4D4D4D 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#1a1a1a", endColorstr="#4d4d4d",GradientType=0 );
}

.light {
z-index: 1400;
width: 13px;
height: 13px;
border-radius: 50px;
/*color*/
background-color: #31e2fc;
background-image: -webkit-gradient(radial, 50% 100%,0,50% 100%,200, from(rgb(30, 152, 199)),to(rgb(49, 226, 252)));
background-image: -webkit-radial-gradient(50% 80%, rgb(49, 226, 252), rgb(30, 152, 199));
background-image: -moz-radial-gradient(50% 80%, rgb(49, 226, 252), rgb(30, 152, 199));
background-image: -o-radial-gradient(50% 80%, rgb(49, 226, 252), rgb(30, 152, 199));
background-image: -ms-radial-gradient(50% 80%, rgb(49, 226, 252), rgb(30, 152, 199));
background-image: radial-gradient(50% 80%, rgb(49, 226, 252), rgb(30, 152, 199));
-webkit-box-shadow: 0px 1px 1px rgba(180, 180, 180, 0.8) inset, 0px 0px 0px 2px rgba(255, 255, 255, .1), 0px 5px 3px rgba(200, 200, 200, .45);
-box-shadow: 0px 1px 1px rgba(180, 180, 180, 0.8) inset, 0px 0px 0px 2px rgba(255, 255, 255, 1), 0px 5px 3px rgba(200, 200, 200, .45);
}

.lightSmall {
position: absolute;
top: 181%;
left: 117%;
margin-left: -100px;
}

.lightSmall > .light {
width: 9px;
height: 9px;
/*color*/
background-color: #6f6f79;
background-image: -webkit-gradient(radial, 50% 100%,0,50% 100%,200, from(rgb(82, 82, 92)), to(rgb(111, 111, 121)));
background-image: -webkit-radial-gradient(50% 80%, rgb(111, 111, 121), rgb(82, 82, 92));
background-image: -moz-radial-gradient(50% 80%, rgb(111, 111, 121), rgb(82, 82, 92));
background-image: -o-radial-gradient(50% 80%, rgb(111, 111, 121), rgb(82, 82, 92));
background-image: -ms-radial-gradient(50% 80%, rgb(111, 111, 121), rgb(82, 82, 92));
background-image: radial-gradient(50% 80%, rgb(111, 111, 121), rgb(82, 82, 92));
}

.facePlate {
position: absolute;
top:165%;
left: 47%;
margin-left: -90px;
height: 98px;
width: 200px;
margin-top: 12px;
z-index: 1500;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
/*color*/
background-color: #d6d7e1;
background-image: -webkit-linear-gradient(left, #1b1d1d 1%, #515859 50%, #1b1d1d 99%);
background-image: -moz-linear-gradient(left, #1b1d1d, #515859 51%, #1b1d1d);
background-image: -o-linear-gradient(left, #1b1d1d, #515859 51%, #1b1d1d);
background-image: -ms-linear-gradient(left, #1b1d1d, #515859 51%, #1b1d1d);
background-image: linear-gradient(to right, #1b1d1d, #515859 15%, #1b1d1d);
-box-shadow: 0px 1px 1px rgba(180, 180, 180, 1) inset, 0px 1px 3px rgba(0, 0, 0, .25), 0px 0px 0px 1px rgba(77, 77, 77, .75), 0px 5px 3px rgba(200, 200, 200, .2);
-webkit-box-shadow: 0px 1px 1px rgba(180, 180, 180, 1) inset, 0px 1px 3px rgba(0, 0, 0, .25), 0px 0px 0px 1px rgba(77, 77, 77, .75), 0px 5px 3px rgba(200, 200, 200, .2);
}

.bayOpening {
position: absolute;
top:225%;
left: 54%;
margin-left: -90px;
height: 30px;
width: 150px;
margin-top: 12px;
z-index: 1600;
/*color*/
background-color: #000;
-webkit-box-shadow: 0 -2px 0 0px rgba(255, 255, 255,.5);
-moz-box-shadow: 0 -2px 0 0px rgba(255, 255, 255,.5);
box-shadow: 0 -2px 0 0px rgba(255, 255, 255,.5);
}

.bayTray {
position:absolute;
top: 320%;
left: 51%;
margin-left: -100px;
margin-top: -75px;  
vertical-align: middle;
z-index: 1600;
/*border*/
border-bottom: 60px solid #555;
border-left: 30px solid transparent;
border-right: 30px solid transparent;
border-top-left-radius:30px;
border-top-right-radius:30px;
height: 0;
width: 133px;
}

.bayTray:after {
content:" ";
left:-30px;
top: 60px;
position:absolute;
background: #000;
border-radius: 0;
width:193px;
height:5px;
display:block;
}

.paperOut {
position:absolute;
top: 320%;
left: 51%;
margin-left: -100px;
margin-top: -75px;  
vertical-align: middle;
z-index: 1900;
/*border*/
border-bottom: 80px solid #fff;
border-left: 30px solid transparent;
border-right: 30px solid transparent;
border-top-left-radius:30px;
border-top-right-radius:30px;
height: 0;
width: 133px;
}

.paperOut:before {
content:" ";
left:0px;
top: -17px;
position:absolute;
background: #c0c1c8;
border-radius: 0;
width:133px;
height:17px;
display:block;
}

.paperOutShadow {
position:absolute;
top: 320%;
left: 50.4%;
margin-left: -100px;
margin-top: -75px;  
vertical-align: middle;
z-index: 1800;
/*border*/
border-bottom: 84px solid rgba(192, 193, 200, .5);
border-left: 30px solid transparent;
border-right: 30px solid transparent;
border-top-left-radius:30px;
border-top-right-radius:30px;
height: 0;
width: 137px;
}
</style>
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
<div class="printerWrapper">
<div class="paperWrapper">
<div class="paperIn page1">Loading...</div>
<div class="paperIn page2">Loading...</div>
<div class="paperInsert"></div>
<div class="paperSlot"></div>
<div class="paperHide"></div>    
</div>
<div class="printerTop"></div>
<div class="printerBody"></div>
<div class="bayWrapper">
<div class="lightLarge">
  <div class="light">
  </div>
</div>
<div class="lightSmall">
  <div class="light">
  </div>
</div>
<div class="facePlate"></div>
<div class="bayOpening"></div>
<div class="bayTray"></div>
<div class="paperOut"></div>
<div class="paperOutShadow"></div>
</div>
</div>
<div style="margin-top: -10em; text-align: center; font-family: Verdana; font-size: 12px;">
<img style="vertical-align: middle" src="loading.gif" />
Mohon menunggu..... Sedang Proses Generate PDF.....
</div>
</body>
</html>';
