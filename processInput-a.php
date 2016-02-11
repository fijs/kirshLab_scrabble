<?php 
 session_start();
// determine the condition order
$conditionOrder = "STATIC".$_SESSION['static'];
$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
$query= "INSERT INTO `data-input`(`stim`,`status`,`demographics_id`,`time`,`condition`,`word`,`paradigm_time`) VALUES ('".$_POST['stim']."','".$_POST['status']."','".$_SESSION['demographics_id']."',now(),'".$conditionOrder."','".$_POST['input']."','".$_POST['time']."')";
$mysqli->query($query);
echo $query;
mysqli_close($con);
?>