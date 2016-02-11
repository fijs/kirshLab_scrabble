<?php
	$_SESSION['status']+=.5;
	$_SESSION['timed_out'] = 1;	
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
<script src="js.js"></script>
<style>
#tiletype {
	margin-left: auto;
	margin-right: auto;
	width: 300px;
	height: 110px;
	margin-top: 50px;
	display: block;
	margin-bottom: -160px;
	text-align: center;
	font-size: 40px;
	color: green;
	}
	#seconds2{
	margin-left: auto;
	margin-right: auto;
	font-size: 60px;
	display: none;
	color: red;
	}
</style>

<script type="text/javascript">

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
        return "Your experiment will be void if you exit or refresh the page. Would you still like to leave the page?"; 
    }
}

function setNTC() {
	needToConfirm = false;
}

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=195-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;
	if (totalSeconds > 185)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	
	if (totalSeconds > 195)
	{

	//window.location = 'paradigm.php';
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);
</script>
</head>

<body>
<div id="header">
	
	<div style='float: right; padding-right: 20px; padding-top: 25px;'>
	Kirsh Laboratory [Participant
<?php
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$query= '';
	$result = $mysqli->query("SELECT demographics_id FROM demographics ORDER BY demographics_id DESC LIMIT 1");
	echo "#000";
	while ($row = $result->fetch_assoc())
	{
		echo $row['demographics_id'];
	}
	echo "]  - ";
	echo date('l jS \of F Y h:i:s A'); 
	?>
	</div>
</div>
<center>
<h1>Halfway done! Please take 3 minute break before advancing.<br></h1>
<div id="seconds2">0</div>
<video width="840" height="480" autoplay controls>
  <source src="sp.mp4" type="video/mp4" autoplay>
</video>
<div style=clear:both></div>
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
    border:none;" onclick=setNTC()>Next</button></a>
<br>
<br>

