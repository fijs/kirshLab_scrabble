<? session_start(); ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title>Kirsh Lab</title>
  <!--resources and libraries used in this file -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script src="touchpunch.js"></script>
  <!-- how things appear. each item in <style> refers to an element's ID in the html code -->
  <style>
  
  #sortable { 
	margin-top: 10px;
        cursor: pointer;
        list-style-type:none;
        width: 790px;
	padding: 0px;
	margin-left: auto;
	margin-right: auto;
  }

  #sortable li { 
	box-shadow: 4px 4px 10px #888888;
	border: 0px solid;
	border-radius: 5px; 
	margin: 10px 10px 10px 0;
        padding: 1px;
	padding-top: 9px; 
	/*display: block*/
	float: left;
	width: 100px;
	height: 90px;
	font-size: 4em; 
	text-align: center; 
	/*list-style-type:none;*/
	/*margin-left: 0px;*/
	background: url("tile.jpg");
	background-size: 103px 100px;
  }
  
 #sortable li.blank{
    background: #FFfdead;
    box-shadow: 0px 0px 0px #888888; 
    background: url("tile.jpg");
    background-size: 30px 100px;
    padding: 1px; 
    padding-top: 9px;
    border: 0px solid;  
    float: left; 
    border-radius: 0px;
    margin-left: 10px;
    width: 25px;
    height: 90px; 
    font-size: 4em; 
    text-align: center;
}

label {
	display: none;
	}

#seconds2{
	font-size: 50px;
	display: none;
	color: red;
	margin-left: auto;
	margin-right: auto;
	}

#info {
	display: none;
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
</style>

<? 
	// //session_start();
// 	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
// 	if (mysqli_connect_errno()) 
// 	{
// 		printf("Connect failed: %s\n", mysqli_connect_error());
// 		exit();
// 	}
	//creates a php array called stim, containing letters of 'SAMPLES'
 	$stim=array("S", "A", "M","P","L","E","S");
// 	//$order=rand(1,12); 
// 	//$result = $mysqli->query("SELECT * FROM  `A` WHERE  `order` ='".$order."'");
// 	//while ($row = $result->fetch_assoc())
// 	//{
// 	//	$stim=str_split($row['stim']);
// 	//}
?>

<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">



<!-- begin javascript-->
<script type="text/javascript">
/*uses javascript with nested php to convert each php element in the array to a javascript variable-*/
var stims = '<?php echo $stim[0]; ?>'+','+'<?php echo $stim[1]; ?>'+','+'<?php echo $stim[2]; ?>'+','+'<?php echo $stim[3]; ?>'+','+'<?php echo $stim[4]; ?>'+','+'<?php echo $stim[5]; ?>'+','+'<?php echo $stim[6]; ?>';
//Should be 180 for max and 170 for show
var maxSecs = 5,
	maxShowSecs = 3;
//gets the current date/time and saves it into start variable.
var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';
/* function to round time elapsed. for certain constraints of elapsed time, it will display different css indicated by #xxxxx which are defined at the beginning*/
function instance()
{
	time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
        //sets rounded to a time stamp in millisenconds, divided by 1000 to get seconds
	rounded=performance.now() / 1000;
	rounded=maxSecs-Math.round(rounded); 
	seconds2.innerHTML = rounded;
	if (rounded < 0) {
		$('#seconds2').css({
			display: 'none'
			});
	}
        //gets the total amount of seconds 
	totalSeconds=performance.now() / 1000;
        
	//checks if totSec is greater than 10
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
                //
		$('#next').css({
			display: 'block'
			});
	//window.location = 'practice_b.php';
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

var inputValue="";

// ask user to confirm to leave the page
$(document).ready(function() {
    needToConfirm = true;
    window.onbeforeunload = askConfirm;
});

/* i believe this validates/formats user input */
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
		/* if keyCode 0 OR 13 is pressed (keyboard ENTER) then reset the input field box along with source code variables*/
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

/*var stim = [
	"<li class='ui-state-default'><?php echo $stim[0]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[1]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[2]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[3]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[4]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[5]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[6]; ?></li>",
	];
*/
/* JAVASCRIPT ENDS HERE*/


</script>

</head>
<body onclick="shiftFocus()">

<div style="width:80%; margin-left: auto; 
margin-right: auto; text-align: center; font-size: 36px; 
margin-bottom: 40px; margin-top: 50px;">This is the practice session for the static condition </div>


<div style="width: 62%; margin-left: 225px;  margin-right: auto; margin-bottom: 30px; ">
<ul style="font-size: 24px;" >
<li>This is the static condition</li>
<li>The tiles don't move</li>
<li>Practice typing in valid words made from the tiles.</li>
<li>All english words greater than 2 letters are valid.</li>
<li>When you press enter we save your word and it is cleared.</li>
<li>Practice for 2 minutes here, but the real conditions are 3 minutes long.</li>
<li>Please practice for the full 2 minutes</li>
<li>Press the next button when you see it to go to the next condition.</li>

</ul>
</div>
<div style="clear:both"></div>
<div id="info"></div>
</h1>

<!-- uses php and a loop to continuously create an unordered list (ul) items consisting of the letters in stim array (SAMPLES)-->
<ul id="sortable">
<?php 
$start_li="<li class='ui-state-default'>";
$close_li="</li>";
$i = 0;
while ($i<=6) {
echo $start_li.$stim[$i].$close_li;
$i++;
}
?>

<!--I believe its the button for the inputs -->
</ul>
</div>
<div style="clear:both"></div><br><br>
<div id="enterinfo" style="font-size: 16px;">
Type a word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<div id="seconds2" align="center"></div>
<div id="next">
<br>

<!--Making the button to go to the next practice page -->
<a href=practice_b.php><button type="button" style="
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
<div id="debug">
</div>
</center>
<audio autoplay>
  <source src="static.mp3" type="audio/ogg">

</audio>
</body>
</html>

  
<!-- OLD CODE 
</head>
<body onload="load()">
<div id="tiletype">Tiles are fixed</div><div style="clear:both"></div>
<div id="info"></div>
</h1>



<div id="letters"> 
<ul id="sortable">


<?php 
$start_li="<li class='ui-state-default'>";
$close_li="</li>";
$i = 0;
while ($i<=6) {
echo $start_li.$stim[$i].$close_li;
$i++;
}
?>


</ul>
</div>
<div style="clear:both"></div><br><br>
<center>
<div id="seconds2">0</div>
</center>
</body>
/html>
 -->
