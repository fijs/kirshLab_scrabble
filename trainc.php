<?		session_start(); ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
<style>
#tiletype {
	width: 300px;
	height: 110px;
	margin-top: 50px;
	display: block;
	margin-bottom: -160px;
	text-align: center;
	font-size: 40px;
	color: green;
	}
#seconds2 {
	display: none;
	}
</style>
 <script type="text/javascript">

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function instance()
{
    time += 100;
    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }
	rounded=performance.now() / 1000;
	rounded=13-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	if (totalSeconds > 13)
	{
	window.location = 'practice_c.php';

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
  <source src="train_c-1.mp4" type="video/mp4" autoplay>
</video>
<br>
</body>
