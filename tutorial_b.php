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
  margin-top: 5%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 100%;}
  
  #sortable li { 
  box-shadow: 4px 4px 10px #888888;
  border: 0px solid; 
  border-radius: 5px; 
  background: #FFDEAD; 
  margin: 1.5% 1.5% 10% 0.5%; 
  
  padding-top: 22px; 
  float: left; 
  width: 7.5%; 
  height: 7.5%; 
  font-size: 4em; 
  text-align: center; 
  background: url("tile.jpg");
  background-size: 103px 100px;
  }
   
 #sortable li.blank{
     background: green;
     color: green;
     box-shadow: 0px 0px 0px #888888; 
  background-size: 30px 100px;
     padding: 0.2%; 
     padding-top: 11%;
     border: 0px solid;  
     float: left; 
     margin-left: 10px;
     border-radius: 0px;
     font-size: 2px;
     width: 8%; height: 100%;  text-align: center; }
	 #log {
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
#next {
	display: none;
}

#inputText {
	display: block;
}

input[type="text"] {
    width: 200px;
    height: 20px;
    font-size: 18px;
}
  </style>


<?php 
	$array=array(" ", " ", " "," "," "," "," ", "-", "--"); 
shuffle($array);
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$stim=array("S", "A", "M","P","L","E","S"); 
	$order=rand(1,12);
	$result = $mysqli->query("SELECT * FROM  `B` WHERE  `order` ='".$order."'");
	$stim_original = $mysqli->query("SELECT * FROM  `B` WHERE  `order` ='".$order."'")->fetch_object()->word;
	while ($row = $result->fetch_assoc())
	{
		$array=str_split($row['stim']);
		array_unshift($array, "-");
		array_push($array,"--");
	}
	
	//$_SESSION['interactive'] = $_SESSION['interactive'] + 1;
?>

 <script type="text/javascript">
 
var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';
	
var inputValue="";

// ask user to confirm to leave the page
$(document).ready(function() {
    needToConfirm = true;
    window.onbeforeunload = askConfirm;
});

// process input when return is pressed
$(document).ready(function(e){
	// ignore space bar in the textbox
	$('input').keyup(function() {
    str = $(this).val();
    str = str.replace(/\s/g,'');
    $(this).val(str);
	});

    $("input").keypress(function(e){
		// initiated when space bar is pressed
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
	if (totalSeconds > 170)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	


	//if (totalSeconds > 180)
	if (totalSeconds > 10)
	{
		// set the timed output
		//<?php $_SESSION['timed_out'] = 1; ?>
		
		// hide the counter
		$('#seconds2').css({
			display: 'none'
			});
		
		// hide the letters
		$('#letters').css({
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

function load()
{
//$("#info").load("process-b.php?stim=<?php echo $array[0].','.$array[1].','.$array[2].','.$array[3].','.$array[4].','.$array[5].','.$array[6].','.$array[7].','.$array[8]; ?>&time=0&status=<?php echo $_SESSION['status']; ?>"); 
}

function shiftFocus() {
	document.getElementById("inputBox").focus();
}

// stores input to "data-input" table using POST method
function processInput(input) {
	// var request = $.ajax({
// 					url: "processInput-b.php",
// 					type: "POST",
// 					data: {stim:"<?php echo $stim_original; ?>", input:input, time:Math.round(((new Date().getTime()-start)/1000)*1000)/1000, status:<?php echo $_SESSION['status']; ?> }
// 				});
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
		//$("#info").load("process-b.php?stim="+replaceme+"%20new&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 


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
		//$("#info").load("process-b.php?stim="+which+"%20init%20move&status=<?php echo $_SESSION['status']; ?>&time="+totalSeconds); 

}


  </script>
  <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

</head>
<body onload="load()" onclick="shiftFocus()"><br><br>
<div id="tiletype" style="width:100%; float:left">You can move the tiles or spaces</div><div style="clear:both;"></div>

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
</center>

<div id="info"></div>

<center>
<div id="letters"> 
<ul id="sortable">

<?php 
$close_li="</li>";
$i = 0;
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
</center>

<div style=clear:both></div>
<center>
<br>
<div id="enterinfo">
Type word and press enter
</div><br>
<div id="inputText">
	<input type=text id="inputBox" style="text-align: center;" autofocus>
</div>
<div id="seconds2">0</div>

<div id="log">
<? echo $array[0].", ".$array[1].", ".$array[2].", ".$array[3].", ".$array[4].", ".$array[5].", ".$array[6].", ".$array[7].", ".$array[8]."<br>0.00<br><hr>";?>

</div>



<br><br><br><br>
<audio autoplay>
  <source src="interactive.mp3" type="audio/ogg">

</audio>
</body>
</html>