<?php
	/*connect to database*/
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	//empty array 
	$stim=array(" ", " ", " "," "," "," "," "); 
	//get the word to display from database table 'A'
	$result = $mysqli->query("SELECT * FROM  `A` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'");
	$stim_original = $mysqli->query("SELECT * FROM  `A` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'")->fetch_object()->word;

	while ($row = $result->fetch_assoc())
	{
		$stim=str_split($row['stim']);
	}
	
	$_SESSION['static'] = $_SESSION['static'] + 1;
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
   
 #sortable li.blank{
    /* background: green;
     color: green;*/
     box-shadow: 0px 0px 0px #888888; 
     background-size: 30px 100px;
     padding: 1px; 
     padding-top: 9px;
     border: 0px solid;  
     float: left; 
     margin-left: 10px;
     border-radius: 0px;
     font-size: 2px;
     width: 25px; height: 90px; text-align: center;
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

<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

 <script type="text/javascript">
 // converts php array into javascript */
var stims = '<?php echo $stim[0].','.$stim[1].','.$stim[2].','.$stim[3].','.$stim[4].','.$stim[5].','.$stim[6]; ?>';

// determines what pressing spacebar does
/*
$( window ).keypress(function() {
  if (e.keyCode == 0 || e.keyCode == 32) {
	  document.getElementsByName("inputBox").value = "";
  }
});
*/

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
			
			processInput(inputValue);
        	document.getElementById("inputBox").value = "";
        }
		document.getElementById("inputBox").focus();
    });
});

//stores the actual stimulus which appears eg in shuffle condition it stores all shuffled words
function load()
{
$("#info").load("process-a.php?stim="+stims+"&status=<?php echo $_SESSION['status']; ?>"); 
}

function shiftFocus() {
	document.getElementById("inputBox").focus();
}

// stores inputted words to "data-input" table using POST method (stim original is the WORD from which the stimulus is formed)
function processInput(input) {
	var request = $.ajax({
					url: "processInput-a.php",
					type: "POST",
					data: {stim:"<?php echo $stim_original; ?>", input:input, time:Math.round(((new Date().getTime()-start)/1000)*1000)/1000, status:<?php echo $_SESSION['status']; ?> }
				});
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

/*display contents of the array */
var stim = [
	"<li class='ui-state-default'><?php echo $stim[0]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[1]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[2]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[3]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[4]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[5]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[6]; ?></li>",
	];

//Should be 180 for max and 170 for show
var maxSecs = 5,
	maxShowSecs = 3;

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    //set time to a value of 100
    time += 100;
    //take the floor of 1/10th
    elapsed = Math.floor(time / 100) / 10;
    //checks is the rounded value of elapsed is equivalent to the floor of 1/10th (yes)
    if(Math.round(elapsed) == elapsed) {
	//adds the STRING .0 to it
	 elapsed += '.0'; }
	//conversts time stamp in milli seconds to seconds
	rounded=performance.now() / 1000;
	/*supposed to give the difference of the time they have been on the page and the time stamp,
		I beleive this is inaccurate */
	rounded=maxSecs-Math.round(rounded);
	//display the CSS/html qualities to the rounded number
	seconds2.innerHTML = rounded;
        //checks the total milliseconds once again, and converts them to seconds
	totalSeconds=performance.now() / 1000;

	//if we have reached the maxShowSec threshold 
	if (totalSeconds > maxShowSecs)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}


	// to set the duration of static 
	if (totalSeconds > maxSecs)
	{
		// set the timed output
		<?php $_SESSION['timed_out'] = 1; ?>
		
		// hide the counter
		$('#seconds2').css({
			display: 'none'
			});
		
		// hide the letters
		$('#sortable').css({
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

  </script>
</head>

<body onload="load()" onclick="shiftFocus()">

<div id="tiletype" style="width:100%; margin-left: auto; margin-right: auto; text-align: center;
                          font-size: 50px; margin-bottom: 100px; margin-top: 10%;" >
Tiles are fixed
</div>

<div style="clear:both"></div>

<div id="info"></div>
</h1>

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
<div id="enterinfo">
Type word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<div id="seconds2" align="center">0</div>
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
<div id="debug">
</div>
</center>
<audio autoplay>
  <source src="static.mp3" type="audio/ogg">

</audio>
</body>
</html>
