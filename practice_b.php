<?php 
	session_start(); 
	// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey 
	if(!isset($_SESSION['qid']))
    {
    	header("location: index.php");
    }
	
	require 'configuration.php';
	$_SESSION['current']=4;
	if($_SESSION['current'] <= $_SESSION['last']){
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			session_destroy();
			header("location: index.php");
	}
	$_SESSION['last']=4;
	
	$array=array("-", "A", "P", "R","I","Y","N","G", "--"); 
	$stim=array("A", "P", "R","I","Y","N","G");
?>
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
#log {
	width: 300px;
}

  #sortable { 
  margin-top: auto; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 880px;
  text-align: center;
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
	text-align: center;
  }
   
 #sortable li.blank{
    background: green;
    color: green;
    box-shadow: 0px 0px 0px #888888; 
    background-size: 30px 100px;
    padding: 1px; 
    padding-top: 9px;
    border: 0px solid;  
    float: left; 
    margin-left: 10px;
    border-radius: 0px;
    font-size: 2px;
    width: 25px;
    height: 90px; 
    text-align: center;
 }

 #log {
   display: none;
 }

 label {
	display: none;
 }

 #seconds2{
   margin-left: auto;
   margin-right: auto;
   font-size: 60px;
   display: none;
   color: red;
  }

 #info {
width: 62%; 
margin-left: 225px; 
margin-right: auto; 
margin-bottom: 30px;
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
   height: 30px;
   font-size: 14px;
 }
 
 #enterinfo {
   margin-right: auto;
   margin-left: auto;
   width: 200px;
   text-align: center;
 }

 #tiletype {
   width: 100%;
   margin-left: auto;
   margin-right: auto;
   margin-bottom: 40px;
   margin-top:50px;
   text-align: center;
   font-size: 40px;
   color: black;
 }

 #nextbutton{
   display: none;
 }

</style>
<!-- php code to create an array called 'array' containing the letters of 'PRAYING'-->

<!-- the following javascript functions are similar to practice_a.php functiosn where you can refer to for comments -->
<script type="text/javascript">

//Should be 180 for max and 170 for show
//var maxSecs = 5,
	//maxShowSecs = 3;

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
	seconds2.innerHTML = rounded;
	if (rounded < 0) {
		$('#seconds2').css({
			display: 'none'
			});
	}

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
		$('#next').css({
			display: 'block'
			});
	//window.location = 'practice_a.php';
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

function load()
{
	//dummy
}

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
			if(e.keyCode == 13){
        	document.getElementById("inputBox").value = "";
			}
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

/* interactive sorting function. This function is called when the user tries to relocate a piece on the board
   essentially what it's doing is replacing the positions of the letters in the 'array' created above and redisplaying them*/
$(function() {
    $( "#sortable" ).sortable({
    start: function(event, ui) {
		console.log(event);
    },
    update : function () {
      // 
      var order = $('#sortable').sortable('serialize'); 
		totalSeconds=performance.now() / 1000;
	  replaceme = order.replace(/let/g," ");
	  replaceme = replaceme.replace(/\]/g," ");
	  replaceme = replaceme.replace(/\[/g," ");
	  replaceme = replaceme.replace(/\=/g," ");
	  replaceme = replaceme.replace(/\&/g,",");
	  replaceme = replaceme.replace(/0/g,"<?php echo $array[0]; ?>");
	  replaceme = replaceme.replace(/1/g,"<?php echo $array[1]; ?>");
	  replaceme = replaceme.replace(/2/g,"<?php echo $array[2]; ?>");
  	  replaceme = replaceme.replace(/3/g,"<?php echo $array[3]; ?>");
	  replaceme = replaceme.replace(/4/g,"<?php echo $array[4]; ?>");
	  replaceme = replaceme.replace(/5/g,"<?php echo $array[5]; ?>");
	  replaceme = replaceme.replace(/6/g,"<?php echo $array[6]; ?>");
	  replaceme = replaceme.replace(/7/g,"<?php echo $array[7]; ?>");
	  replaceme = replaceme.replace(/8/g,"<?php echo $array[8]; ?>");
  	  replaceme = replaceme.replace(/ /g,"");


//	  var container = document.getElementById('log');
//	  container.innerHTML = order;  


	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(replaceme));
	  mydiv.appendChild(document.createElement("br"));  
   	  totalSeconds=performance.now()/1000;
 
	  mydiv.appendChild(document.createTextNode(totalSeconds));
	  mydiv.appendChild(document.createElement("hr"));   


	}
});
    $( "#sortable" ).disableSelection();

});
function asdf(which)
{
	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(which + " is starting to move"));
	  mydiv.appendChild(document.createElement("br"));   
	  totalSeconds=performance.now() / 1000;
	  mydiv.appendChild(document.createTextNode(totalSeconds));
	  mydiv.appendChild(document.createElement("hr"));   


}


  </script>
  <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()">

<div id="tiletype">
Practice session for the interactive condition</div>
<div style="clear:both"></div>
<div id="info">
<ul style="font-size: 24px;">
<li>This is the interactive condition.</li>
<li>Now you can move the tiles</li>
<li>Use the green separator bars if you want to group tiles into clusters</li>
<li>Practice finding and typing words for 2 minutes.</li>
<li>Press the next button when you see it to go to the final practice session</li>
</ul>
</div>

<div id="letters"> 
<ul id="sortable">


<?php 
	$close_li="</li>";
	$i = 0;
	/*displays the 'PRAYING' letters contained in 'array '*/
	while ($i<=8) {
	if($array[$i]=="-" || $array[$i]=="--"){
	$start_li="<li class='blank' onmousedown=\"asdf('".$array[$i]."_blank')\" id='let_".$i."'>";
		}else{
	$start_li="<li class='ui-state-default' onmousedown=\"asdf('".$array[$i]."')\" id='let_".$i."'>";
	}
	echo $start_li.$array[$i].$close_li;
	//if ($i==2){
	//	   echo "<li name='test' id='blank'> </li>";
	//}
	//if ($i==3){
	//	   echo "<li id='blank'> </li>";
	//}

	$i++;
	}
?>

</ul>
</div>


<div style=clear:both></div>
<div id="enterinfo" style="font-size: 16px;">
Type word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<div id="seconds2" align="center"></div>
<div id="next">
<br>

<a href=practice_c.php><button type="button" style="
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

<div id="log">
<? echo $array[0].", ".$array[1].", ".$array[2].", ".$array[3].", ".$array[4].", ".$array[5].", ".$array[6].", ".$array[7].", ".$array[8]."<br>0.00<br><hr>";?>

</div><br><br>
<div style=clear:both></div>
<br>

<audio autoplay>
  <source src="interactive.mp3" type="audio/ogg">

</audio>
</body>
</html>
