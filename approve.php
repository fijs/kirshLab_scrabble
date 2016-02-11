<?php 
	$demo_id = $_POST['demo_id'];
	//echo "<p>demo_id = $demo_id is approved</p>";
	echo "Successfully updated database!";
	
	// update database
	$mysqli = new mysqli("localhost","root", "paintFRAME!", "scrabble");
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$query= '';
	$result = $mysqli->query("UPDATE demographics SET approved = 1 WHERE demographics_id = $demo_id");
?>