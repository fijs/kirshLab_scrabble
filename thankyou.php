<?php
	//session start is a key php variable
	session_start();
	// Check if they come from qualtrics.php (which is where we redirect from the qualtrics survey) 
	if(!isset($_SESSION['expKey']))
	{
		header("location: index.php");
	}
	// Set session var for them to get paid
	$_SESSION['keyToPay'] = 'NOTHING BETTER THAN COLD HARD CACHE';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<style>
.message {
  float = center;
	margin-top: 5%;
	margin-left: auto;
	margin-right: auto;
  padding: 5px;
  width: 900px;
 
  font-size: 30px; 
	display: block; 
	color: black; 
} 
.message:first-line {
    font-size: 40px;
}	
.message2 {
 
  	margin-left: auto;
	margin-right: auto;
	margin-top: 5%;
  padding: 5px;
  width: 700px;
} 
.message3 {
 
  	margin-left: auto;
	margin-right: auto;
  padding: 5px;
  width: 200px;
} 
#button {

	background-color: green;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius:6px;
    color: #fff;
    font-size: 40px;
    text-decoration: none;
    cursor: pointer;
    width: 200px;
    border:none; 
	margin-left: auto;
	margin-right: auto;
}
</style>
</head>
<body>



<div class= "message"><center>
		
		Thank you for completing the experiment!</br>
		Please continue to receive your unique code required for your payment</center>
		</div>
	<div class= "message2">		<img alt="" src="thy.jpg"></div>
<div class= "message3">	
<a href=done.php><button type="button" id="button"
onclick="setWarningOff()">Continue</button></a></div>
		

</body>
</html>