<?		session_start(); ?>

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
	width: 300px;
	height: 110px;
	margin-top: 50px;
	display: block;
	margin-bottom: -160px;
	text-align: center;
	font-size: 40px;
	color: black;
	}
#seconds2 {
	display: none;
	}
</style>
 <script type="text/javascript">

function load()
{
}
var stim = [
	"<li class='ui-state-default'><?php echo $stim[0]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[1]; ?></li>",
	"<li class='ui-state-default'><?php echo $stim[2]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[3]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[4]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[5]; ?></li>", 
	"<li class='ui-state-default'><?php echo $stim[6]; ?></li>",
	];


var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=12-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	if (totalSeconds > 12)
	{
	window.location = 'practice_b.php';

	}	


	if (totalSeconds > 5)
	{

	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

  </script>
</head>

<body>
<div id="seconds2">0</div>


<center>
<video width="100%" height="100%" autoplay>
  <source src="b-train.mp4" type="video/mp4" autoplay>
</video>
<div style=clear:both></div><br><br>
<br>
<br>

