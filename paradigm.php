
<? 
session_start();
		$arr=$_SESSION['order'];	
		$input = $arr;
		$output = array_slice($input,3);
		$output2 = array_slice($input,0,3);
		array_push($output2, " ");
		$arr = array_merge($output2, $output);
		
		$arr[7] = null;
		
		if($_SESSION['status'] == 3) {
			$_SESSION['status'] = $_SESSION['status'] + 1;

		}
		
		$i=$_SESSION['status'];

		if($i<7)
		{
		$test = $arr[$i];
		$test = strtolower($test);
		
		// for testing purpose only
		 //$test = "c";
		}
		
		// connect to the database
		$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
		if (mysqli_connect_errno()) 
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
?>

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
  
  #log {
	width: 300px;
	}
	
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 880px;
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
     width: 25px; height: 90px; font-size: 4em; text-align: center; }
     
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
     width: 25px; height: 90px;  text-align: center; }
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
	
#tiletype {
	float: left;
	height: 110px;
	text-align: center;
	font-size: 40px;
	color: black;
	margin-left: 10px;
	}
	
#info {
	display: none;
	}
	
  </style>

<?php
$order="0";
switch($_SESSION['status'])
{
	case 0:
		$order="1";
		$test();
		break;
	case 0.5:
		$order="2";
		$test();
		break;
	case 1:
		$order="1";
		$test();
		break;
	case 1.5:
		$order="2";
		$test();
		break;
	case 2:
		$order="1";
		$test();
		break;
	case 2.5:
		$order="2";
		$test();
		break;
		/*
	case 3:
		//include 'break.php';
		$order="0";
		halfBreak();
		break;
		*/
	case 3:
		$order="3";
		$test();
		break;
	case 3.5:
		$order="4";
		$test();
		break;
	case 4:
		$order="3";
		$test();
		break;
	case 4.5:
		$order="4";
		$test();
		break;
	case 5:
		$order="3";
		$test();
		break;
	case 5.5:
		$order="4";
		$test();
		break;
	case 6:
		$order="3";
		$test();
		break;
	case 6.5:
		$order="4";
		$test();
		break;
	case 7:
		halfBreak();
		break;
	/*
	case 7:
		include 'done.php';
		break;
	*/
}	
?>

<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

 <script type="text/javascript">
 
 //adjust tiles according to the condition

function load()
{
$("#info").load("<?php echo $loadString; ?>"); 
}

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=180-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	//if (totalSeconds > 170)
	if (totalSeconds > 2)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	


	//if (totalSeconds > 180)
	if(totalSeconds > 4)
	{

	//window.location = 'waiting_screen.php';
	wait();
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

// only called from interactive condition
function asdf(which)
{
	  var mydiv = document.getElementById("log");
	  mydiv.appendChild(document.createTextNode(which + " is starting to move"));
	  mydiv.appendChild(document.createElement("br"));   
		totalSeconds=performance.now() / 1000;
	  mydiv.appendChild(document.createTextNode(totalSeconds));
	  mydiv.appendChild(document.createElement("hr"));   
		$("#info").load("process-b.php?stim="+which+"%20init%20move&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 

}

window.setTimeout(instance, 100);

// functions below are used for shuffle condition only
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
		count++;
		temp=stim2[count];
		stim=temp.split("");
		document.getElementById('letters').innerHTML = "<ul id='sortable'><li class='ui-state-default'>"+stim[0]+"</li><li class='ui-state-default'>"+stim[1]+"</li><li class='ui-state-default'>"+stim[2]+"</li><li class='ui-state-default'>"+stim[3]+"</li><li class='ui-state-default'>"+stim[4]+"</li><li class='ui-state-default'>"+stim[5]+"</li><li class='ui-state-default'>"+stim[6]+"</li></ul>";
		var outputme = stim[0]+"," +stim[1]+"," +stim[2]+"," +stim[3]+"," +stim[4]+"," +stim[5]+"," +stim[6];
		var mydiv = document.getElementById("log");
		mydiv.appendChild(document.createElement("hr"));
		mydiv.appendChild(document.createElement("br"));
		totalSeconds=performance.now() / 1000;
		mydiv.appendChild(document.createTextNode(outputme + " " + totalSeconds));
		mydiv.appendChild(document.createElement("hr"));
		mydiv.appendChild(document.createElement("br"));
		$("#info").load("process-c.php?stim="+outputme+"&time="+totalSeconds+"&status=<?php echo $_SESSION['status']; ?>"); 
		lastshuffle=totalSeconds=performance.now() / 1000;
	}

	function shuffle() {
		requestshuffle=totalSeconds=performance.now() / 1000;
		if(requestshuffle-lastshuffle>1)
		{
			maybeshuffle();
		}else{

		}
	}
	
	// function used to display waiting screen
	function wait() {
		var nextState = document.getElementById("nextState");	//will be used to display information to the user
		var pressAnyKey = document.getElementById("pressAnyKey");
		var tiles = document.getElementById("letters");		//represents the tiles and letters
		var shuffleButton = document.getElementById("shuffleButton");
		var center = document.getElementById("center");
		var conditionStatement = document.getElementById("tiletype");
		
		//hide the count
		$('#seconds2').css({
			display: 'none'
			});
			
		//hide the shuffle button and condition statement
		shuffleButton.style.display = "none";
		conditionStatement.style.display = "none";
		
		// get the next condition
			var state = <?php echo $i;?>;
			
			var cond = "";
			if(state == 3) {
				cond = "BREAK";

			}
			else if(state < 6.5 && state != 3) {
				cond = "<?php echo $arr[$i+0.5]; ?>";
				//cond = "<?php echo $arr[$i]; ?>";
			}
			else {
				cond = "DONE";

			}
			
		if(cond == "A") {
			nextState.innerHTML = ("<br><br><br><br><br><br><br><br><br><font size=\"30\">Next tile condition is <strong>STATIC</strong><br>The tiles will be fixed</font><br>");
		}
		
		else if(cond == "B") {
			nextState.innerHTML = ("<br><br><br><br><br><br><br><br><br><font size=\"30\">Next tile condition is <strong>INTERACTIVE</strong><br>You will be able to move the tiles</font><br>");
		}
		
		else if(cond == "C") {
			nextState.innerHTML = ("<br><br><br><br><br><br><br><br><br><font size=\"30\">Next tile condition is <strong>SHUFFLE</strong><br>You will be able to shuffle the tiles</font><br>");
		}
		
		else if(cond == "DONE") {
			nextState.innerHTML = ("<br><br><br><br><br><br><br><br><br><font size=\"30\">You are done!<br>Thank you for participating.</font><br>");

		}
		
		else {
			nextState.innerHTML = ("Break time!<br>You are halfway done! Please watch the following short video and relax<br>");
			document.getElementById("breakVideo").style.display="block";
			//play video
			var vid = $('#breakVideo').get(0);
			vid.play();
		}
		
		// display
		tiles.style.display = "none";
		if(cond != "DONE"){
			pressAnyKey.innerHTML = "<br><strong><font size=\"30\">Press Any Key to Continue</font></strong>";	// display this to the user
		}
		
		// reload the page when user presses any key
		$(document).keypress(function(){
			location.reload();
		});  
	}

  </script>
</head>
<body onload="load()">

<script>

var cond = <?php echo $condition; ?>;

	// used in order to make interactive tiles move and update SQL whenever the user drags a tile
	
	if(cond == 2) {
		$(function() {
			$( "#sortable" ).sortable({
				start: function(event, ui) {
					console.log(event);
				},
				update : function () { 
				var order = $('#sortable').sortable('serialize'); 
				totalSeconds=performance.now() / 1000;
				replaceme = order.replace(/let/g," ");
				replaceme = replaceme.replace(/\]/g," ");
				replaceme = replaceme.replace(/\[/g," ");
				replaceme = replaceme.replace(/\=/g," ");
				replaceme = replaceme.replace(/\&/g,",");
				replaceme = replaceme.replace(/0/g,"<?php echo $stim[0]; ?>");
				replaceme = replaceme.replace(/1/g,"<?php echo $stim[1]; ?>");
				replaceme = replaceme.replace(/2/g,"<?php echo $stim[2]; ?>");
				replaceme = replaceme.replace(/3/g,"<?php echo $stim[3]; ?>");
				replaceme = replaceme.replace(/4/g,"<?php echo $stim[4]; ?>");
				replaceme = replaceme.replace(/5/g,"<?php echo $stim[5]; ?>");
				replaceme = replaceme.replace(/6/g,"<?php echo $stim[6]; ?>");
				replaceme = replaceme.replace(/7/g,"<?php echo $stim[7]; ?>");
				replaceme = replaceme.replace(/8/g,"<?php echo $stim[8]; ?>");
				replaceme = replaceme.replace(/ /g,"");

				$("#info").load("process-b.php?stim="+replaceme+"%20new&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 


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
	}
	
	
</script>

<div id="tiletype"><?php echo $conditionDisplay;?></div><div style="clear:both"></div>
<div id="info"></div>
</h1>



<div id="letters"> 
<ul id="sortable">
	<?php 
		$j = 0;
		while ($j<=$maxIndex) {
			// condition 2 represents interactive. Only executed for interactive condition
			if($condition == 2) {
				if($stim[$j]=="-" || $stim[$j]=="--"){
					$start_li="<li class='blank' onmousedown=\"asdf('".$stim[$j]."_blank')\" id='let_".$j."'>";
				}else{
					$start_li="<li class='ui-state-default' onmousedown=\"asdf('".$stim[$j]."')\" id='let_".$j."'>";
				}
			}
			echo $start_li.$stim[$j].$close_li;
			$j++;
		}
	?>
</ul>

</div>
<div style="clear:both"></div><br><br>
<center>

<button type="button" id="shuffleButton" style="<?php echo $buttonStyle; ?>" onclick="maybeshuffle()">Shuffle</button>

<div id="seconds2">0</div>
<div id="nextState"></div>
<video id="breakVideo" style="display:none;" width="840" height="480" controls>
  <source src="sp.mp4" type="video/mp4">
</video>
<div id="pressAnyKey"></div>
<div id="log">
<? 
	if ($condition == 2) {
		echo $stim[0].", ".$stim[1].", ".$stim[2].", ".$stim[3].", ".$stim[4].", ".$stim[5].", ".$stim[6].", ".$stim[7].", ".$stim[8]."<br>0.00<br><hr>";
	}
	
	else if ($condition == 3) {
		echo $stim[0].", ".$stim[1].", ".$stim[2].", ".$stim[3].", ".$stim[4].", ".$stim[5].", ".$stim[6]." 0.0";

	}
?>

</div>
</center>
<audio autoplay>
  <source src="<?php echo $mp3;?>" type="audio/ogg">

</audio>
</body>
</html>


<?php

	$_SESSION['status']+=.5;
	
	// static condition
	function a() {
		$GLOBALS['stim']=array(" ", " ", " "," "," "," "," ");
		$result = $GLOBALS['mysqli']->query("SELECT * FROM  `A` WHERE  `order` ='".$GLOBALS['order']."' AND `group` ='".$_SESSION['groupnum']."'");
		while ($row = $result->fetch_assoc())
		{
			$GLOBALS['stim']=str_split($row['stim']);
		}
		$stim = $GLOBALS['stim'];	
	
		$GLOBALS['condition'] = 1;	// 1 represents static
		$GLOBALS['conditionDisplay'] = "Tiles are fixed";
		$GLOBALS['mp3'] = "static.mp3";
		$GLOBALS['loadString'] = "process-a.php?stim=$stim[0],$stim[1],$stim[2],$stim[3],$stim[4],$stim[5],$stim[6]&status=".$_SESSION['status'];
		$GLOBALS['start_li'] = "<li class='ui-state-default'>";
		$GLOBALS['close_li'] = "</li>";
		$GLOBALS['maxIndex'] = 6;
		$GLOBALS['buttonStyle'] = 'background-color: grey; display: none;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none';
	}
	
	// interactive condition
	function b() {
		$GLOBALS['stim']=array(" ", " ", " "," "," "," "," ", "-", "--");
		shuffle($GLOBALS['stim']);
		$result = $GLOBALS['mysqli']->query("SELECT * FROM  `B` WHERE  `order` ='".$GLOBALS['order']."' AND `group` ='".$_SESSION['groupnum']."'");
		while ($row = $result->fetch_assoc())
		{
			$GLOBALS['stim']=str_split($row['stim']);
			array_unshift($GLOBALS['stim'], "-");
			array_push($GLOBALS['stim'],"--");
		}
		$stim = $GLOBALS['stim'];
	
		$GLOBALS['condition'] = 2;
		$GLOBALS['conditionDisplay'] = "You can move the tiles or spaces";
		$GLOBALS['mp3'] = "interactive.mp3";
		$GLOBALS['loadString'] = "process-b.php?stim=$stim[0],$stim[1],$stim[2],$stim[3],$stim[4],$stim[5],$stim[6],$stim[7],$stim[8]&time=0&status=".$_SESSION['status'];
		$GLOBALS['close_li'] = "</li>";
		$GLOBALS['maxIndex'] = 8;
		$GLOBALS['buttonStyle'] = 'background-color: grey; display: none;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none';
	}
	
	
	// shuffle condition
	function c() {
		echo '<script>';
		echo 'var stim2 = [];';
		echo 'var count = 0;';
		
		$result = $GLOBALS['mysqli']->query("SELECT * FROM  `C` WHERE  `order` ='".$GLOBALS['order']."' AND `group` ='".$_SESSION['groupnum']."'");
		
		while ($row = $result->fetch_assoc())
		{
			//array_push($GLOBALS['stim2'], $row['stim']);
			echo "stim2.push('".$row['stim']."');"."\r\n";
		}
		echo '</script>';
		
		$result = $GLOBALS['mysqli']->query("SELECT * FROM  `C` WHERE  `order` ='".$GLOBALS['order']."' AND `group` ='".$_SESSION['groupnum']."' AND `shuffle`=1");
		while ($row = $result->fetch_assoc())
		{
			$GLOBALS['stim']=str_split($row['stim']);
		}
		
		$stim = $GLOBALS['stim'];
		
		$GLOBALS['conditionDisplay'] = "You can shuffle the tiles";
		$GLOBALS['mp3'] = "shuffle.mp3";
		$GLOBALS['condition'] = 3;
		$GLOBALS['loadString'] = "process-c.php?stim=$stim[0],$stim[1],$stim[2],$stim[3],$stim[4],$stim[5],$stim[6]&time=0&status=".$_SESSION['status'];
		$GLOBALS['start_li'] = "<li class='ui-state-default'>";
		$GLOBALS['close_li'] = "</li>";
		$GLOBALS['maxIndex'] = 6;
		$GLOBALS['buttonStyle'] = 'background-color: grey;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none';
	}
	
	function halfBreak() {
		$GLOBALS['stim']=array(" ", " ", " "," "," "," "," ");
		/*
		$result = $GLOBALS['mysqli']->query("SELECT * FROM  `A` WHERE  `order` ='".$GLOBALS['order']."' AND `group` ='".$_SESSION['groupnum']."'");
		while ($row = $result->fetch_assoc())
		{
			$GLOBALS['stim']=str_split($row['stim']);
		}
		*/
		$stim = $GLOBALS['stim'];	
		
	
		$GLOBALS['condition'] = 0;
		$GLOBALS['conditionDisplay'] = "";
		$GLOBALS['mp3'] = "";
		$GLOBALS['loadString'] = "";
		$GLOBALS['start_li'] = "";
		$GLOBALS['close_li'] = "";
		$GLOBALS['maxIndex'] = 0;
		$GLOBALS['buttonStyle'] = 'background-color: grey; display: none;
    -moz-border-radius: 5px;  -webkit-border-radius: 5px;   border-radius:6px;
    padding: 10px;    color: #fff;    font-size: 40px;    text-decoration: none;
    cursor: pointer;   padding-left: 50px;    padding-right: 50px;   border:none';
	}
?>