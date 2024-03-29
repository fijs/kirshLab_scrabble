<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title>Kirsh Lab</title>
  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="touchpunch.js"></script>
  <style>
  #sortable { 
  margin-left: 13%; 

  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 880px;
  }
  
  #sortable li { 
  box-shadow: 4px 4px 10px #888888;
  border: 0px solid; 
  border-radius: 5px; 
  margin: 10px 10px 10px 0; 
  padding: 1px; 
  padding-top: 9px; 
  float: left; 
  width: 95px; 
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
     width: 25px; height: 90px; font-size: 4em; text-align: center; }
label {
	display: none;
	}
			 #log {
	 display: none;
	 }
	 #seconds2 {
		display: none;
		}
	#info {
		display: none;
		}
		#tiletype {
	float: left;
	height: 110px;
	text-align: center;
	font-size: 40px;
	color: black;
	margin-left: 10px;
	}
	#seconds2{
	margin-left: auto;
	margin-right: auto;
	font-size: 60px;
	display: none;
	color: red;
	}
#next {
	display: none;
}

#inputText {
	display: block;
}

#tiletype {
	float: left;
	height: 110px;
	text-align: center;
	font-size: 40px;
	color: black;
	margin-left: 10px;
	}

input[type="text"] {
    width: 200px;
    height: 20px;
    font-size: 18px;
}
</style>
  	
<script type="text/javascript">

//Should be 180 for max and 170 for show
//var maxSecs = 5,
//	maxShowSecs = 3;
 
var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';
	
// ask user to confirm to leave the page
$(document).ready(function() {
    needToConfirm = true;
    window.onbeforeunload = askConfirm;
});

function askConfirm() {
    if (needToConfirm) {
        // Put your custom message here 
        return "Warning. You will not be paid if you exit or refresh the page."; 
    }
}

function setWarningOff() {
	needToConfirm = false;
}

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=maxSecs-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	//if (totalSeconds > 170)
	if (totalSeconds > maxShowSecs)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	

	//if (totalSeconds > 180)
	if (totalSeconds > maxSecs)
	{
		// set the timed outpxutut
		<?php $_SESSION['timed_out'] = 1; ?>
		
		// hide the counter
		$('#seconds2').css({
			display: 'none'
			});
		
		// hide the letters
		$('#letters').css({
			display: 'none'
			});
		
		// hide the shuffle button
		$('#shuffleButton').css({
			display: 'none'
			});
			
		// hide the input box
		$('#inputText').css({
			display: 'none'
			});
			
		// hide the tile type info
		$('#tiletype').css({
			display: 'none'
			});
			
		// hide the enterinfo box
		$('#enterinfo').css({
			display: 'none'
			});
			
		// display the button to advance
		$('#next').css({
			display: 'block'
			});

	//window.location = 'waiting_screen.php';
	}
	
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);


var count=0;
var stim2 =[];

<?php

	// import configuration settings
	require 'configuration.php';

	$stim = [];

	$result = $mysqli->query("SELECT * FROM  `C` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'");
	$stim_original = $mysqli->query("SELECT * FROM  `C` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'")->fetch_object()->word;

	while ($row = $result->fetch_assoc())
	{
		
		echo "stim2.push('".$row['stim']."');"."\r\n";

	}

	$result = $mysqli->query("SELECT * FROM  `C` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."' AND `shuffle`=1");
	while ($row = $result->fetch_assoc())
	{
		$stim=str_split($row['stim']);
	}
	
	$_SESSION['shuffle'] = $_SESSION['shuffle'] + 1;
?>

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

var lastshuffle=0;
function maybeshuffle(){

if(count>94){
  count=0;
}

temp = stim2[count];
count++;
stim = temp.split("");

document.getElementById('letters').innerHTML = "<ul id='sortable'><li class='ui-state-default'>"
                                               +stim[0]+"</li><li class='ui-state-default'>"+stim[1]+"</li><li class='ui-state-default'>"
                                               +stim[2]+"</li><li class='ui-state-default'>"+stim[3]+"</li><li class='ui-state-default'>"
                                               +stim[4]+"</li><li class='ui-state-default'>"+stim[5]+"</li><li class='ui-state-default'>"
                                               +stim[6]+"</li></ul>";

  //This is done to let outputme be more readable in the mysql data base
  var outputme = stim[0]+"," +stim[1]+"," +stim[2]+"," +stim[3]+"," +stim[4]+
                 "," +stim[5]+"," +stim[6];
  var mydiv = document.getElementById("log");

  mydiv.appendChild(document.createElement("hr"));
  mydiv.appendChild(document.createElement("br"));

  totalSeconds=performance.now() / 1000;

  mydiv.appendChild(document.createTextNode(outputme + " " + totalSeconds));
  mydiv.appendChild(document.createElement("hr"));
  mydiv.appendChild(document.createElement("br"));

  $("#info").load("process-c.php?stim="+outputme+"&time="+totalSeconds+
  "&status=<?php echo $_SESSION['status']; ?>"); 
  
  lastshuffle = totalSeconds=performance.now() / 1000;
  document.getElementById("inputBox").focus();
}

function shuffle() {
  requestshuffle = totalSeconds=performance.now() / 1000;
  if(requestshuffle -lastshuffle>1) {
    maybeshuffle();
  } else {
    }
}

// process input when return is pressed
$(document).ready(function(e){
    
  // ignore space bar in the textbox
  $('input').keyup(function(e) {
  str = $(this).val();
  str = str.replace(/\s/g,'');
  $(this).val(str);
	
  if(e.keyCode == 32) {
    maybeshuffle();
  }
		
  });

$("input").keypress(function(e){
  // initiated when space bar is pressed
  if (e.keyCode == 0 || e.keyCode == 13 || e.keyCode == 32) {
  inputValue = document.getElementById("inputBox").value;
	       inputValue = inputValue.trim();
			
  // for debug only
  //$("#debug").text(inputValue);
  // filter out the empty input
  if(inputValue != "") {
    processInput(inputValue);
  }
  document.getElementById("inputBox").value = "";
  }
  document.getElementById("inputBox").focus();
  });

});

function load() {
  $("#info").load("process-c.php?stim='<?php echo $stim[0].','.$stim[1].','.$stim[2].','.$stim[3].','.$stim[4].','.$stim[5].','.$stim[6]; ?>
  '&time=0&status = <?php echo $_SESSION['status']; ?>"); 
}

function shiftFocus() {
	document.getElementById("inputBox").focus();
}

// stores input to "data-input" table using POST method
function processInput(input) {
  var request = $.ajax( {
  url: "processInput-c.php",
  type: "POST",
  data: {stim:"<?php echo $stim_original; ?>", input: input, time: Math.round(((new Date().getTime()-start)/1000)*1000)/1000, status:<?php echo $_SESSION['status']; ?> }});
}

//  $(function() {
//    $( "#sortable" ).sortable({
 //   start: function(event, ui) {
//        ui.item.startPos = ui.item.index();
//    },
//    stop: function(event, ui) {
//	var mydiv = document.getElementById("log");
//	stim[9] = stim[ui.item.index()];
//	stim[ui.item.index()] = stim[ui.item.startPos];
//	stim[ui.item.startPos] = stim[9];
//	var replaceme = stim[0]+stim[1]+stim[2]+stim[3]+stim[4]+stim[5]+stim[6]+stim[7]+stim[8];
//	replaceme = replaceme.replace(/<li class='ui-state-default'>/g,"");
//	replaceme = replaceme.replace(/<\/li>/g,"");
//	outputme = replaceme.replace(/<li id='blank'>/g, "&");
  //  var mydiv = document.getElementById("log");
  //  mydiv.appendChild(document.createTextNode("asdf"));
      
    //}

//});
 //   $( "#sortable" ).disableSelection();

//});

</script>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()" onclick="shiftFocus()"><br><br>
<div id="tiletype" style="width:100%; float:left">You can shuffle the tiles</div><div style="clear:both;"></div>
<div id="info"></div>
<div id="testing">
</div>

<center>
<div id="next">
<br><br><br><br><br><br><br><br><br><br>
<a href=experiment.php><button type="button" style="
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

<div id="letters">
<ul id="sortable">

<?php 
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
</center>

<div style=clear:both></div>
<br>
<center>	
<div id="enterinfo">
Type word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<br><br><br><br>
<div id="shuffleButton">
<button type="button" style="background-color: grey;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none" onclick="maybeshuffle()">Press SpaceBar to Shuffle</button>
</div>
<div style="clear:both"></div>
<br><br>
<center>
<div id="seconds2">0</div>

<div id="log">
<?php echo $stim[0].", ".$stim[1].", ".$stim[2].", ".$stim[3].", ".$stim[4].", ".$stim[5].", ".$stim[6]." 0.0";?>
</div>

<br><br><br><br><br>

<audio autoplay>
  <source src="shuffle.mp3" type="audio/ogg">
</audio>

</body>
</html>
