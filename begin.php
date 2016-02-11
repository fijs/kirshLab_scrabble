<?		session_start(); ?>
<!DOCTYPE html>
<!-- this page is pretty self explanatory. just loads the begin button -->

<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>Kirsh Lab</title>
<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo rand(1,1000000) ?>" media="screen">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="touchpunch.js"></script>
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
</style>
</head>

<script type="text/javascript">

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

</script>

<body>
<div id="header">
	
	<div style='float: right; padding-right: 20px; padding-top: 25px;'>
	Kirsh Laboratory [Participant
<?php
/*
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
	*/
	echo $_SESSION['demographics_id'];
	echo "]  - ";
	echo date('l jS \of F Y h:i:s A'); 
	?>
	</div>
</div>


<center>
<br><br><br><br><br><br><br><br><br>
<h1>Press the begin button to start.</h1>
<br><br><br>
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
    border:none;" onclick="setWarningOff()">Begin</button></a>
<br>
<br>

