<?php 
 session_start();

	// import configuration settings
	require 'configuration.php';
	//$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
$query= "INSERT INTO `data`(`stim`,`status`,`demographics_id`,`paradigm_time`,`time`,`condition`) VALUES ('".$_GET['stim']."','".$_GET['status']."','".$_SESSION['demographics_id']."','".$_GET['time']."',now(),'moving')";
//$query= "INSERT INTO `data_test`(`stim`,`status`,`demographics_id`,`paradigm_time`,`time`,`condition`) VALUES ('".$_GET['stim']."','".$_GET['status']."','".$_SESSION['demographics_id']."','".$_GET['time']."',now(),'moving')";
$mysqli->query($query); 
echo $query;
mysqli_close($con);
?>
