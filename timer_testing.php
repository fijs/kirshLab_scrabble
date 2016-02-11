
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title>Self-adjusting timer examples</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<style type="text/css">
		html, body
		{
			background:#fff;
			color:#000;
			font:normal normal normal 1em/1.4 verdana,sans-serif;
		}
		form
		{
			float:left;
			border:1px solid gray;
			background:#eee;
			width:240px;
			margin:0 10px 10px 0;
		}

		form fieldset

		{

			border:none;

			padding:10px 10px 0 10px;

		}

		form label

		{

			display:block;

			float:left;

			clear:both;

			width:210px;

			margin:0 0 5px 0;

		}

		form label span

		{

			display:block;

			float:left;

			width:140px;

		}

		form input

		{

			width:60px;

			font-size:0.88em;

		}

		form button

		{

			padding:2px 8px;

			font-size:1em;

			background:#ddd;

			border:1px outset #bbb;

			margin:0 0 10px 0;

		}

	

	</style>



</head>



<body>


<script type="text/javascript">
     function myCallback(json) {
          alert(new Date(json.dateString));
     }
</script>
<script type="text/javascript" src="http://timeapi.org/utc/now.json?callback=myCallback"></script>


<h1>Time Sample<br>
<div id="seconds1">0</div>
</h1>

<h1>New Timer<br>
<div id="seconds2">0</div>
</h1>


	<script type="text/javascript">
var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

function timestamp()
{
seconds1.innerHTML = performance.now() / 1000;
}
function instance()
{
    time += 100;

    elapsed = Math.floor(time / 100) / 10;
    if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }

    document.title = elapsed;
	seconds2.innerHTML = performance.now() / 1000;
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

	</script>
<h1>Old Timer
<div id="seconds">0</div>
</h1>
    <script type="text/javascript">
		var secondsLabel = document.getElementById("seconds");
        var totalSeconds = 0;
        setInterval(setTime, 10);
		//document.getElementById('ding').play();
  function setTime()
{
    ++totalSeconds;
    secondsLabel.innerHTML = (totalSeconds/100);
	if ((totalSeconds/100) > 1500000)
	{
	window.location = 'waiting_screen.php';
	}
	return totalSeconds/100;


}      
    </script> 
<a  style='font-size: 40px; color:white;' href=# onmouseover="timestamp();">
<div style='background-color:red;color:white; text-align:center'>
Mouse Over for Time Sample</a>
</div>
</body>

</html>

