<?php 
 session_start();
$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
$query= "INSERT INTO `data`(`stim`,`status`,`demographics_id`,`time`,`condition`) VALUES ('".$_GET['stim']."','".$_GET['status']."','".$_SESSION['demographics_id']."',now(),'static')";
//$query= "INSERT INTO `data_test`(`stim`,`status`,`demographics_id`,`time`,`condition`) VALUES ('".$_GET['stim']."','".$_GET['status']."','".$_SESSION['demographics_id']."',now(),'static')";
$mysqli->query($query); 
echo $query;
mysqli_close($con);
?>
