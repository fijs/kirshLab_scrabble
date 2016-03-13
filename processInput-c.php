<?php 
 session_start();
 $conditionOrder = "SHUFFLE".$_SESSION['shuffle'];

	// import configuration settings
	require 'configuration.php';
	//$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
$query= "INSERT INTO `data-input`(`stim`,`status`,`demographics_id`,`time`,`condition`,`word`,`paradigm_time`) VALUES ('".$_POST['stim']."','".$_POST['status']."','".$_SESSION['demographics_id']."',now(),'".$conditionOrder."','".$_POST['input']."','".$_POST['time']."')";
$mysqli->query($query); 
echo $query;
mysqli_close($con);
?>