<?php 
	session_start(); 
	// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey  
	if(!isset($_SESSION['qid']))
    {
    	header("location: index.php");
    }
	
	 // Set experiment key to be checked through the experiment
    $_SESSION['expKey'] = 'DINGLEDONGLES';
	
	require 'configuration.php';
	$_SESSION['current']=6;
	if($_SESSION['current'] <= $_SESSION['last']){
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			session_destroy();
			header("location: index.php");
	}
	$_SESSION['last']=6;
	
   
	
?>

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

<!-- 
Until now, we had been manually controlling where the experiment went. 
And here we finally pass control to experiment.php
 -->
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

