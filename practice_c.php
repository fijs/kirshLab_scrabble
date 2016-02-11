<? session_start(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title>Kirsh Lab</title>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="touchpunch.js"></script>
  <style>
  
  #sortable { 
  margin-top: 10px; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 790px;
  }
  
  #sortable li { 
  box-shadow: 4px 4px 10px #888888;
  border: 0px solid; 
  border-radius: 5px; 
  background: #FFDEAD; 
  margin: 10px 10px 10px 0; 
  padding: 1px; 
  padding-top: 9px; 
  float: left; 
  width: 100px; 
  height: 90px; 
  font-size: 4em; 
  text-align: center; 
  background: url("tile.jpg");
  background-size: 103px 100px;
  }
   
  #sortable li#blank{
     background: #FFfdead;
     box-shadow: 0px 0px 0px #888888; 
     background: url("tile.jpg");
     background-size: 30px 100px;
     padding: 1px; 
     padding-top: 9px;
     border: 0px solid;  
     float: left; 
     margin-left: 10px;
     border-radius: 0px;
     width: 25px; height: 90px; font-size: 4em; text-align: center; 
  }
  
  label {
	display: none;
  }
			 
   #log {
	display: none;
   }
	 
   #seconds2 {
	font-size: 60px;
	display: none;
	color: red;
	margin-left: auto;
	margin-right: auto;
   }
   
   #info {
	display: none;
	}
	
#tiletype {
  float: left;
  text-align: center;
  font-size: 40px;
  color: black;
  margin-left: auto;
  margin-right: auto;
}
	
#next {
  display: none;
  width: 200px;
  margin-right: auto;
  margin-left: auto;
}

#inputText {
	display: block;
	margin-right: auto;
	margin-left: auto;
	width: 200px;
}

input[type="text"] {
    width: 200px;
    height: 20px;
    font-size: 18px;
}
#enterinfo {
	margin-right: auto;
	margin-left: auto;
	width: 200px;
	text-align: center;
	}
#shuffle {
	margin-right: auto;
	margin-left: auto;
}
</style>
  
<script type="text/javascript">

//Should be 180 for max and 170 for show
var maxSecs = 5,
	maxShowSecs = 3;

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=maxSecs-Math.round(rounded);
// 	if (rounded < 0) {
// 		$('#seconds2').css({
// 			display: 'none'
// 			});
// 	}
	
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	if (totalSeconds > maxShowSecs)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	

	if (totalSeconds > maxSecs)
	{
		$('#seconds2').css({
			display: 'none'
			});
		$('#shuffle').css({
			display: 'none'
			});
		$('#next').css({
			display: 'block'
			});
			
		//window.location = 'begin.php';

	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

		// BEGIN INPUT WORD LOGIC

var inputValue="";

// ask user to confirm to leave the page
$(document).ready(function() {
    needToConfirm = true;
    window.onbeforeunload = askConfirm;
});

$(document).ready(function(e){
    $("input").keypress(function(e){
		// ignore space bar in the textbox
	$('input').keyup(function(e) {
    str = $(this).val();
    str = str.replace(/\s/g,'');
    $(this).val(str);
	
	if(e.keyCode == 32) {
			maybeshuffle();
		}
		
	});
		
		// initiated when return is pressed
    	if (e.keyCode == 0 || e.keyCode == 13) {
    		inputValue = document.getElementById("inputBox").value;
			inputValue = inputValue.trim();
			
    		// for debug only
    		//$("#debug").text(inputValue);
			
			//processInput(inputValue);
        	document.getElementById("inputBox").value = "";
        }
		document.getElementById("inputBox").focus();
    });
});

function shiftFocus() {
document.getElementById("inputBox").focus();
}

function askConfirm() {
    if (needToConfirm) {
        // Put your custom message here 
        return "Warning. You will not be paid if you exit or refresh the page."; 
    }
}

function setWarningOff() {
	needToConfirm = false;
}

		// END INPUT WORD LOGIC


// BEGIN OLD PRACTICE_C CODE

var shufflecount=0;
var count=0;
var stim =["N", "E", "T","W","O","R","K"];
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
function shufflearr(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};
var lastshuffle=0;
function maybeshuffle(){
shufflearr(stim);
document.getElementById('letters').innerHTML = "<ul id='sortable'><li class='ui-state-default'>"+stim[0]+"</li><li class='ui-state-default'>"+stim[1]+"</li><li class='ui-state-default'>"+stim[2]+"</li><li class='ui-state-default'>"+stim[3]+"</li><li class='ui-state-default'>"+stim[4]+"</li><li class='ui-state-default'>"+stim[5]+"</li><li class='ui-state-default'>"+stim[6]+"</li></ul>";
	var outputme = stim[0]+"," +stim[1]+"," +stim[2]+"," +stim[3]+"," +stim[4]+"," +stim[5]+"," +stim[6];
    var mydiv = document.getElementById("log");
      mydiv.appendChild(document.createElement("hr"));
    mydiv.appendChild(document.createElement("br"));
    totalSeconds=performance.now() / 1000;
    mydiv.appendChild(document.createTextNode(outputme + " " + totalSeconds));
     mydiv.appendChild(document.createElement("hr"));
    mydiv.appendChild(document.createElement("br"));
	lastshuffle=totalSeconds=performance.now() / 1000;
}

function shuffle() {
	requestshuffle=totalSeconds=performance.now() / 1000;
	if(requestshuffle-lastshuffle>1)
	{
	maybeshuffle();
	}else{

	}
	shufflecount++;
	if(shufflecount==3){
//		window.location = 'timeline.php'
		}

}

function load()
{
}

</script>

<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()">
<!-- 
<div id="tiletype">Practice Shuffling the Tiles</div><div style="clear:both"></div>
<div style="margin-left: 400px; margin-right: auto; margin-bottom: -300px; margin-top: -20px;">
<ul style="font-size: 24px;">
 -->
<div id="tiletype" style="width: 100%; text-align: center; margin-top: 40px; margin-left: auto; margin-right: auto;">
Practice session for the shuffle condition</div><div style="clear:both"></div>
<div id="info"></div>
<div style="margin-left: 225px; margin-right: auto; margin-bottom: 30px; ">
<ul style="font-size: 24px;">
<li>This is the shuffle condition</li> 
<li>As before, type out words that you see and press enter</li>
<li>Pressing the grey bar will randomly shuffle the tiles</li>
<li>Please practice finding words for the full 2 minutes</li>
<li>When you're done click next to begin the experiment</li>
</ul>
</div>


<div id="letters"> 
<ul id="sortable">

<?php 
$stim=array("N", "E", "T","W","O","R","K"); 
shuffle($stim);
$start_li="<li class='ui-state-default'>";
$close_li="</li>";
$i = 0;
while ($i<=6) {
echo $start_li.$stim[$i].$close_li;
//if ($i==2){
//	   echo "<li id='blank'> </li>";
//}
//if ($i==3){
//	   echo "<li id='blank'> </li>";
//}

$i++;
}
?>
</ul>
</div>

<div style="clear:both"></div><br><br>
<div id="enterinfo" style="font-size: 16px;">
Type word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<div style=clear:both></div><br>
<center>	
<button id="shuffle" type="button" style="background-color: grey;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none" onclick="maybeshuffle()">Shuffle</button>

</div>
<div id="seconds2" align="center"></div>
<div id="next"><br>
<a href=begin.php><button type="button" style="
  background-color: green;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-size: 40px;
    text-decoration: none;
    cursor: pointer;
    width: 200px;
    border:none;" onclick="setWarningOff()">Next</button></a>
</div>
<div id="log"><?php echo $stim[0].", ".$stim[1].", ".$stim[2].", ".$stim[3].", ".$stim[4].", ".$stim[5].", ".$stim[6]." 0.0";
?>

</div>

<audio autoplay>
  <source src="shuffle.mp3" type="audio/ogg">

</audio>


</body>
</html>
