<? 
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$stim=array("S", "A", "M","P","L","E","S"); 
	$result = $mysqli->query("SELECT * FROM  `A` WHERE  `order` ='".$order."' AND `group` ='".$_SESSION['groupnum']."'");
	while ($row = $result->fetch_assoc())
	{
		$stim=str_split($row['stim']);
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
  #sortable { 
  margin-top: 20%; 
  margin-left: auto; 
  margin-right: auto; 
  cursor: pointer; 
  list-style-type: none; 
  padding: 0; 
  width: 820px;}
  
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
#info {
	display: none;
	}


  </style>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">

 <script type="text/javascript">
var stims = '<?php echo $stim[0]; ?>'+','+'<?php echo $stim[1]; ?>'+','+'<?php echo $stim[2]; ?>'+','+'<?php echo $stim[3]; ?>'+','+'<?php echo $stim[4]; ?>'+','+'<?php echo $stim[5]; ?>'+','+'<?php echo $stim[6]; ?>';

function load()
{

$("#info").load("process-a.php?stim="+stims+"&status=<?php echo $_SESSION['status']; ?>"); 


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
	rounded=20-Math.round(rounded);
	seconds2.innerHTML = rounded;

	totalSeconds=performance.now() / 1000;

	if (totalSeconds > 10)
	{
		$('#seconds2').css({
			display: 'block'
			});
	}	


	if (totalSeconds > 20)
	{

	window.location = 'waiting_screen.php';
	}
    var diff = (new Date().getTime() - start) - time;
    window.setTimeout(instance, (100 - diff));
}

window.setTimeout(instance, 100);

  </script>
</head>
<body onload="load()">
<div id="tiletype">Tiles are fixed</div>
<div id="info"></div>
</h1>



<div id="letters"> 
<ul id="sortable">
<?php 
shuffle($stim);
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
</html>