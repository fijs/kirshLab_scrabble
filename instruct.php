	<?		session_start(); ?>
<!DOCTYPE html>


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

div.lists {
   width: 62%; 
   margin-left: 250px; 
   margin-right: auto; 
   margin-bottom: 30px; 
} 
	ul{
		
    font-size: 24px;
	 margin: 0; 
	 padding: 0;
}

.style1 {
	margin-top: 0px;
	margin-bottom: 3px;
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
	require 'configuration.php';
/*
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	*/
	$query= '';
	$result = $mysqli->query("SELECT demographics_id FROM demographics ORDER BY demographics_id DESC LIMIT 1");
	echo "#000";
	while ($row = $result->fetch_assoc())
	{
		echo $row['demographics_id'];
	}
	
	echo $_SESSION['demographics_id'];
	echo "]  - ";
	echo date('l jS \of F Y h:i:s A'); 
	?>
	</div>
</div>


<center>
<br>
<div style="width:80%; margin-left: auto; 
margin-right: auto; text-align: center; font-size: 36px; 
margin-bottom: 10px; margin-top: 10px;">Welcome! Please read these instructions before continuing to the practice sessions.</div>
</center>

<div class="lists">

<ul>
<li>We are trying to understand how people think when playing scrabble
<li>You will see a tray of scrabble tiles and be asked to type in all words larger than 2 letters that you can find.
</div>
<div class="lists">
<center><img src="tilesimg.jpg" width="400" height="66"></center>
</div>
<div class="lists">
<ul>
<li>The experiment will take a total of 40 minutes with a 3 minute break after 20 minutes.
<li>Please do not leave your computer before the 20 minute break as that will invalidate the experiment.
<li>At the end you will be given the code you need to collect your payment from mechanical turk.
</ul>
</div>


<div style="clear:both"></div>
<div id="info"></div>
</h1>
<center>

<h1>Press the begin button to start the practice sessions</h1>
<br>
<div style=clear:both></div>
<a href=practice_a.php><button type="button" style="
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

