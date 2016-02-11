<?php 
session_start();

  	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
		if($_GET['setup']==0)
		{
		$query="UPDATE `timesync` SET `timesend`=".$_GET['timesend']." WHERE `demographics_id`=".$_GET['demo_id']." AND `loc` = '".$_SESSION['prog']."'";
//		echo $query;
		}
		if($_GET['setup']==1)
		{

		$query="INSERT INTO `timesync`(`timesend`, `demographics_id`, `loc`) VALUES (".$_GET['timesend'].",".$_GET['demo_id'].",'".$_SESSION['prog']."')";
		echo $query;
		}
		$mysqli->query($query);

?>
