<?php		
	session_start();
	// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey 
	if(!isset($_SESSION['qid']))
    {
    	header("location: index.php");
    }
	require 'configuration.php';
	
	/*$last = $_SESSION['last'];
	$output = "<script>console.log( 'LAST VISITED: " . $last . "' );</script>";
	$curr = $_SESSION['current'];
	$output2 = "<script>console.log( 'CURRENT INDEX: " . $curr . "' );</script>";
	echo $output2;
	echo $output;*/
	$_SESSION['current']=2;
	if($_SESSION['current'] <= $_SESSION['last']){
		//$output="<script>console.log( 'test' );</script>";
		//echo $output;
			// delete data
			$delete_q = "DELETE FROM `demographics_test` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `data-input` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			$delete_q = "DELETE FROM `qualtrics` WHERE `demographics_id`='".$_SESSION['demographics_id']."'";
			$mysqli->query($delete_q);
			
			//echo "<script>console.log( 'test2222' );</script>";
			session_destroy();
			//echo "<script>console.log( '3333' );</script>";
			header("location: index.php");
	}
		
	$_SESSION['last']=2;
		
		/*
	// check if user refreshed or backspaced or closed/reopened tab
	if($_SESSION['current']==1){
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
		else{
			$_SESSION['current'] = 2;
		}
		
		
	}*/
?>

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
	Kirsh Laboratory Participant
	<?php
		require 'configuration.php';
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

